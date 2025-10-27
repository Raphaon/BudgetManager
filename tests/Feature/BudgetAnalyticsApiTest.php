<?php

namespace Tests\Feature;

use App\PostBudgetaire;
use App\Prevision;
use App\Realisation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BudgetAnalyticsApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_snapshot_endpoint_returns_snapshot_data(): void
    {
        $this->seedBudgetData();

        $response = $this->getJson('/api/budget/snapshot?exercice=2024&as_of=2024-03-31');

        $response->assertOk();
        $response->assertJsonFragment([
            'as_of' => '2024-03-31',
            'total_forecast' => 300000.0,
        ]);
    }

    public function test_scenario_endpoint_accepts_adjustments_payload(): void
    {
        $this->seedBudgetData();

        $response = $this->postJson('/api/budget/scenario', [
            'exercice' => '2024',
            'adjustments' => [
                ['num_compte' => '601', 'delta' => 1000],
            ],
        ]);

        $response->assertOk();
        $response->assertJsonPath('totals.scenario_forecast', 301000.0);
    }

    private function seedBudgetData(): void
    {
        $post1 = PostBudgetaire::create([
            'numCompte' => '601',
            'intitulePost' => 'Operations',
            'isDelete' => 0,
        ]);

        $post2 = PostBudgetaire::create([
            'numCompte' => '602',
            'intitulePost' => 'Marketing',
            'isDelete' => 0,
        ]);

        $prevision1 = Prevision::create([
            'codePostBudgetaire' => $post1->numCompte,
            'exercicePrevi' => '2024',
            'montantPrevision' => 200000,
            'isDelete' => 0,
        ]);

        $prevision2 = Prevision::create([
            'codePostBudgetaire' => $post2->numCompte,
            'exercicePrevi' => '2024',
            'montantPrevision' => 100000,
            'isDelete' => 0,
        ]);

        Realisation::create([
            'montantRea' => 100000,
            'dateRea' => '2024-01-10',
            'observationRea' => 'Initial spend',
            'codePrevision' => $prevision1->idPrevision,
            'isDelete' => 0,
        ]);

        Realisation::create([
            'montantRea' => 20000,
            'dateRea' => '2024-02-01',
            'observationRea' => 'Marketing spend',
            'codePrevision' => $prevision2->idPrevision,
            'isDelete' => 0,
        ]);
    }
}
