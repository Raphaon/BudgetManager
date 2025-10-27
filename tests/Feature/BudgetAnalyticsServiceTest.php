<?php

namespace Tests\Feature;

use App\PostBudgetaire;
use App\Prevision;
use App\Realisation;
use App\Services\BudgetAnalyticsService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class BudgetAnalyticsServiceTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Carbon::setTestNow(Carbon::create(2024, 3, 31));
    }

    protected function tearDown(): void
    {
        Carbon::setTestNow();
        parent::tearDown();
    }

    public function test_snapshot_returns_expected_metrics(): void
    {
        $this->seedBudgetData();

        $service = app(BudgetAnalyticsService::class);
        $snapshot = $service->getRealTimeSnapshot('2024', Carbon::create(2024, 3, 31));

        $this->assertSame('2024-03-31', $snapshot['as_of']);
        $this->assertEquals(300000.0, $snapshot['total_forecast']);
        $this->assertEquals(150000.0, $snapshot['total_actual']);
        $this->assertEquals(150000.0, $snapshot['remaining_budget']);
        $this->assertEqualsWithDelta(50.0, $snapshot['completion_rate'], 0.01);
        $this->assertArrayHasKey('monthly_realisation', $snapshot);
        $this->assertCount(3, $snapshot['monthly_realisation']);
    }

    public function test_comparison_summarises_prevision_and_realisation(): void
    {
        $this->seedBudgetData();

        $service = app(BudgetAnalyticsService::class);
        $comparison = $service->compareActualVsForecast('2024', Carbon::create(2024, 1, 1), Carbon::create(2024, 3, 31));

        $this->assertCount(2, $comparison);
        $first = collect($comparison)->firstWhere('num_compte', '601');
        $this->assertEquals(200000.0, $first['forecast']);
        $this->assertEquals(120000.0, $first['actual']);
        $this->assertEquals(80000.0, $first['variance']);
    }

    public function test_scenario_simulation_applies_adjustments(): void
    {
        $this->seedBudgetData();

        $service = app(BudgetAnalyticsService::class);
        $scenario = $service->simulateScenario('2024', [
            '601' => 20000,
            ['num_compte' => '602', 'delta' => -5000],
        ]);

        $totals = $scenario['totals'];
        $this->assertEquals(300000.0, $totals['baseline_forecast']);
        $this->assertEquals(315000.0, $totals['scenario_forecast']);
        $this->assertEquals(150000.0, $totals['actual']);
        $this->assertEquals(15000.0, $totals['adjustment']);

        $line = collect($scenario['lines'])->firstWhere('num_compte', '601');
        $this->assertEquals(220000.0, $line['scenario_forecast']);
    }

    public function test_alert_detection_flags_threshold_breaches(): void
    {
        $this->seedBudgetData();

        // Additional realisation to push account 602 over forecast
        Realisation::create([
            'montantRea' => 90000,
            'dateRea' => '2024-03-25',
            'observationRea' => 'Extra spend',
            'codePrevision' => Prevision::where('codePostBudgetaire', '602')->first()->idPrevision,
            'isDelete' => 0,
        ]);

        $service = app(BudgetAnalyticsService::class);
        $alerts = $service->detectAlerts('2024');

        $this->assertNotEmpty($alerts);
        $overrun = collect($alerts)->firstWhere('num_compte', '602');
        $this->assertSame('critical', $overrun['severity']);
        $this->assertGreaterThan(0, $overrun['overrun']);
    }

    public function test_report_compiles_snapshot_comparison_and_alerts(): void
    {
        $this->seedBudgetData();

        $service = app(BudgetAnalyticsService::class);
        $report = $service->generateReportData('2024');

        $this->assertArrayHasKey('snapshot', $report);
        $this->assertArrayHasKey('comparison', $report);
        $this->assertArrayHasKey('alerts', $report);
        $this->assertArrayHasKey('top_variances', $report);
    }

    private function seedBudgetData(): void
    {
        PostBudgetaire::create([
            'numCompte' => '601',
            'intitulePost' => 'Operations',
            'isDelete' => 0,
        ]);

        PostBudgetaire::create([
            'numCompte' => '602',
            'intitulePost' => 'Marketing',
            'isDelete' => 0,
        ]);

        $prevision601 = Prevision::create([
            'codePostBudgetaire' => '601',
            'exercicePrevi' => '2024',
            'montantPrevision' => 200000,
            'isDelete' => 0,
        ]);

        $prevision602 = Prevision::create([
            'codePostBudgetaire' => '602',
            'exercicePrevi' => '2024',
            'montantPrevision' => 100000,
            'isDelete' => 0,
        ]);

        Realisation::create([
            'montantRea' => 70000,
            'dateRea' => '2024-01-15',
            'observationRea' => 'January spend',
            'codePrevision' => $prevision601->idPrevision,
            'isDelete' => 0,
        ]);

        Realisation::create([
            'montantRea' => 50000,
            'dateRea' => '2024-02-10',
            'observationRea' => 'February spend',
            'codePrevision' => $prevision601->idPrevision,
            'isDelete' => 0,
        ]);

        Realisation::create([
            'montantRea' => 30000,
            'dateRea' => '2024-03-05',
            'observationRea' => 'March spend',
            'codePrevision' => $prevision602->idPrevision,
            'isDelete' => 0,
        ]);
    }
}
