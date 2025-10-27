<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\BudgetAnalyticsService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BudgetAnalyticsController extends Controller
{
    public function snapshot(Request $request, BudgetAnalyticsService $service)
    {
        $exercice = $this->requireExerciceCode($request);
        $asOf = $this->parseDate($request->query('as_of'));

        return response()->json(
            $service->getRealTimeSnapshot($exercice, $asOf)
        );
    }

    public function comparison(Request $request, BudgetAnalyticsService $service)
    {
        $exercice = $this->requireExerciceCode($request);
        [$start, $end] = $this->parseDateRange($request);

        return response()->json(
            $service->compareActualVsForecast($exercice, $start, $end)
        );
    }

    public function report(Request $request, BudgetAnalyticsService $service)
    {
        $exercice = $this->requireExerciceCode($request);
        [$start, $end] = $this->parseDateRange($request);

        return response()->json(
            $service->generateReportData($exercice, $start, $end)
        );
    }

    public function alerts(Request $request, BudgetAnalyticsService $service)
    {
        $exercice = $this->requireExerciceCode($request);
        [$start, $end] = $this->parseDateRange($request);
        $threshold = (float) $request->query('threshold', 1.0);

        return response()->json(
            $service->detectAlerts($exercice, $threshold, $start, $end)
        );
    }

    public function scenario(Request $request, BudgetAnalyticsService $service)
    {
        $exercice = $this->requireExerciceCode($request);
        [$start, $end] = $this->parseDateRange($request);
        $adjustments = $request->input('adjustments', []);

        if (!is_array($adjustments)) {
            return response()->json([
                'message' => 'The adjustments payload must be an array.',
            ], 422);
        }

        return response()->json(
            $service->simulateScenario($exercice, $adjustments, $start, $end)
        );
    }

    protected function requireExerciceCode(Request $request): string
    {
        $exercice = $request->query('exercice', $request->input('exercice'));

        if (!$exercice) {
            abort(422, 'The exercice parameter is required.');
        }

        return (string) $exercice;
    }

    protected function parseDate(?string $date): ?Carbon
    {
        if (!$date) {
            return null;
        }

        return Carbon::parse($date)->startOfDay();
    }

    protected function parseDateRange(Request $request): array
    {
        $start = $this->parseDate($request->query('start'));
        $end = $this->parseDate($request->query('end'));

        if ($start && $end && $end->lessThan($start)) {
            abort(422, 'The end date must be greater than or equal to the start date.');
        }

        return [$start, $end];
    }
}
