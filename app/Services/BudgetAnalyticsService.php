<?php

namespace App\Services;

use App\PostBudgetaire;
use App\Prevision;
use App\Realisation;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class BudgetAnalyticsService
{
    public function getRealTimeSnapshot(string $exerciceCode, ?Carbon $asOf = null): array
    {
        $asOf = $asOf?->copy()->endOfDay() ?? Carbon::now()->endOfDay();
        $periodStart = Carbon::create($asOf->year, 1, 1)->startOfDay();
        $periodEnd = $asOf->copy();

        $totalForecast = (float) Prevision::query()
            ->where('isDelete', 0)
            ->where('exercicePrevi', $exerciceCode)
            ->sum('montantPrevision');

        $totalActual = (float) Realisation::query()
            ->join('prevision', 'prevision.idPrevision', '=', 'realisation.codePrevision')
            ->where('realisation.isDelete', 0)
            ->where('prevision.exercicePrevi', $exerciceCode)
            ->whereDate('dateRea', '<=', $periodEnd->toDateString())
            ->sum('montantRea');

        $daysElapsed = max(1, $periodStart->diffInDays($periodEnd) + 1);
        $daysInPeriod = $periodStart->copy()->endOfYear()->diffInDays($periodStart) + 1;
        $averageDailySpend = $totalActual / $daysElapsed;
        $projectedActual = $averageDailySpend * $daysInPeriod;

        $snapshot = [
            'as_of' => $periodEnd->toDateString(),
            'total_forecast' => $totalForecast,
            'total_actual' => $totalActual,
            'remaining_budget' => $totalForecast - $totalActual,
            'completion_rate' => $totalForecast > 0 ? ($totalActual / $totalForecast) * 100 : 0.0,
            'projected_actual' => $projectedActual,
            'projected_variance' => $projectedActual - $totalForecast,
            'projected_completion_rate' => $totalForecast > 0 ? ($projectedActual / $totalForecast) * 100 : 0.0,
        ];

        $snapshot['monthly_realisation'] = $this->monthlyRealisation($exerciceCode, $periodStart, $periodEnd)->toArray();

        return $snapshot;
    }

    public function compareActualVsForecast(string $exerciceCode, ?Carbon $startDate = null, ?Carbon $endDate = null): array
    {
        $endDate = $endDate?->copy() ?? Carbon::now();
        $startDate = $startDate?->copy() ?? $endDate->copy()->startOfYear();

        $forecasts = Prevision::query()
            ->select('codePostBudgetaire', DB::raw('SUM(montantPrevision) as forecast'))
            ->where('isDelete', 0)
            ->where('exercicePrevi', $exerciceCode)
            ->groupBy('codePostBudgetaire')
            ->get()
            ->keyBy('codePostBudgetaire');

        $actuals = Realisation::query()
            ->select('prevision.codePostBudgetaire', DB::raw('SUM(montantRea) as actual'))
            ->join('prevision', 'prevision.idPrevision', '=', 'realisation.codePrevision')
            ->where('realisation.isDelete', 0)
            ->where('prevision.exercicePrevi', $exerciceCode)
            ->whereDate('dateRea', '>=', $startDate->toDateString())
            ->whereDate('dateRea', '<=', $endDate->toDateString())
            ->groupBy('prevision.codePostBudgetaire')
            ->get()
            ->pluck('actual', 'codePostBudgetaire');

        $codes = $forecasts->keys()->merge($actuals->keys())->unique()->values();

        $posts = PostBudgetaire::query()
            ->whereIn('numCompte', $codes)
            ->get()
            ->keyBy('numCompte');

        return $codes
            ->map(function (string $code) use ($forecasts, $actuals, $posts) {
                $forecastRow = $forecasts->get($code);
                $forecast = $forecastRow ? (float) $forecastRow->forecast : 0.0;
                $actual = (float) ($actuals[$code] ?? 0.0);
                $variance = $forecast - $actual;

                return [
                    'num_compte' => $code,
                    'intitule' => optional($posts->get($code))->intitulePost,
                    'forecast' => $forecast,
                    'actual' => $actual,
                    'variance' => $variance,
                    'variance_rate' => $forecast !== 0.0 ? ($variance / $forecast) * 100 : 0.0,
                    'realisation_rate' => $forecast !== 0.0 ? ($actual / $forecast) * 100 : 0.0,
                ];
            })
            ->sortByDesc('actual')
            ->values()
            ->toArray();
    }

    public function simulateScenario(string $exerciceCode, array $adjustments, ?Carbon $startDate = null, ?Carbon $endDate = null): array
    {
        $baseline = collect($this->compareActualVsForecast($exerciceCode, $startDate, $endDate))
            ->keyBy('num_compte');

        $normalized = $this->normalizeAdjustments($adjustments);
        $codes = $baseline->keys()->merge(array_keys($normalized))->unique()->values();

        $results = [];
        $totals = [
            'baseline_forecast' => 0.0,
            'scenario_forecast' => 0.0,
            'actual' => 0.0,
            'adjustment' => 0.0,
        ];

        foreach ($codes as $code) {
            $baselineRow = $baseline[$code] ?? [
                'forecast' => 0.0,
                'actual' => 0.0,
                'intitule' => null,
            ];

            $adjustment = (float) ($normalized[$code] ?? 0.0);
            $scenarioForecast = $baselineRow['forecast'] + $adjustment;
            $actual = $baselineRow['actual'];

            $totals['baseline_forecast'] += $baselineRow['forecast'];
            $totals['scenario_forecast'] += $scenarioForecast;
            $totals['actual'] += $actual;
            $totals['adjustment'] += $adjustment;

            $results[] = [
                'num_compte' => $code,
                'intitule' => $baselineRow['intitule'],
                'baseline_forecast' => $baselineRow['forecast'],
                'actual' => $actual,
                'adjustment' => $adjustment,
                'scenario_forecast' => $scenarioForecast,
                'scenario_remaining' => $scenarioForecast - $actual,
                'scenario_rate' => $scenarioForecast !== 0.0 ? ($actual / $scenarioForecast) * 100 : 0.0,
            ];
        }

        $totals['baseline_remaining'] = $totals['baseline_forecast'] - $totals['actual'];
        $totals['scenario_remaining'] = $totals['scenario_forecast'] - $totals['actual'];

        return [
            'lines' => $results,
            'totals' => $totals,
        ];
    }

    public function detectAlerts(string $exerciceCode, float $threshold = 1.0, ?Carbon $startDate = null, ?Carbon $endDate = null): array
    {
        $comparisons = $this->compareActualVsForecast($exerciceCode, $startDate, $endDate);

        return collect($comparisons)
            ->filter(function (array $line) use ($threshold) {
                if ($line['forecast'] <= 0.0) {
                    return false;
                }

                $ratio = $line['actual'] / $line['forecast'];

                return $ratio >= $threshold;
            })
            ->map(function (array $line) {
                $ratio = $line['forecast'] > 0 ? $line['actual'] / $line['forecast'] : 0;

                return array_merge($line, [
                    'severity' => $this->classifySeverity($ratio),
                    'overrun' => $line['actual'] - $line['forecast'],
                ]);
            })
            ->values()
            ->toArray();
    }

    public function generateReportData(string $exerciceCode, ?Carbon $startDate = null, ?Carbon $endDate = null): array
    {
        $asOf = $endDate?->copy() ?? Carbon::now();
        $snapshot = $this->getRealTimeSnapshot($exerciceCode, $asOf);
        $comparison = $this->compareActualVsForecast($exerciceCode, $startDate, $endDate ?? $asOf);

        return [
            'snapshot' => $snapshot,
            'comparison' => $comparison,
            'alerts' => $this->detectAlerts($exerciceCode, 1.0, $startDate, $endDate ?? $asOf),
            'top_variances' => collect($comparison)
                ->sortBy('variance')
                ->take(5)
                ->values()
                ->toArray(),
        ];
    }

    protected function monthlyRealisation(string $exerciceCode, Carbon $start, Carbon $end): Collection
    {
        $expression = $this->monthExpression('dateRea');

        return Realisation::query()
            ->selectRaw($expression . ' as period, SUM(montantRea) as total')
            ->join('prevision', 'prevision.idPrevision', '=', 'realisation.codePrevision')
            ->where('realisation.isDelete', 0)
            ->where('prevision.exercicePrevi', $exerciceCode)
            ->whereDate('dateRea', '>=', $start->toDateString())
            ->whereDate('dateRea', '<=', $end->toDateString())
            ->groupBy('period')
            ->orderBy('period')
            ->get()
            ->pluck('total', 'period');
    }

    protected function monthExpression(string $column): string
    {
        return match (DB::connection()->getDriverName()) {
            'sqlite' => "strftime('%Y-%m', $column)",
            'pgsql' => "to_char($column, 'YYYY-MM')",
            default => "DATE_FORMAT($column, '%Y-%m')",
        };
    }

    protected function normalizeAdjustments(array $adjustments): array
    {
        $normalized = [];

        foreach ($adjustments as $key => $value) {
            if (is_array($value) && isset($value['num_compte'])) {
                $delta = $value['delta'] ?? $value['adjustment'] ?? 0;
                $normalized[$value['num_compte']] = (float) $delta;
                continue;
            }

            if (is_string($key)) {
                $normalized[$key] = (float) $value;
                continue;
            }
        }

        return $normalized;
    }

    protected function classifySeverity(float $ratio): string
    {
        if ($ratio >= 1.2) {
            return 'critical';
        }

        if ($ratio >= 1.0) {
            return 'warning';
        }

        return 'info';
    }
}
