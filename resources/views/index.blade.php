@extends('layouts/template', [
    $title = 'BusinessScan',
    $sb_title = 'Tableau de bord'
])

@php($currentMonthLabel = ucfirst(\Carbon\Carbon::now()->locale('fr')->translatedFormat('F')))

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush

@section('content_block')
    <div class="dashboard-container">
        <div class="row summary-row">
            <div class="col-xl-3 col-md-6">
                <div class="summary-card">
                    <span class="summary-label">Prévisions annuelles</span>
                    <span class="summary-value">{{ number_format($montantTotalPrevionAnnuelle, 0, ',', ' ') }} F CFA</span>
                    <div class="summary-sub">Orientation budgétaire : <strong>{{ $budgetSide ?? 'N/A' }}</strong></div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="summary-card">
                    <span class="summary-label">Réalisation annuelle</span>
                    <span class="summary-value">{{ number_format($montantTotalRealisationAnnuelle, 0, ',', ' ') }} F CFA</span>
                    <div class="progress-wrapper">
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-success" role="progressbar"
                                 style="width: {{ $annualProgress }}%" aria-valuenow="{{ $annualProgress }}"
                                 aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <span class="progress-label">{{ number_format($annualProgress, 2, ',', ' ') }}% du budget annuel</span>
                    </div>
                    <div class="summary-sub">Écart : {{ number_format($annualGap, 0, ',', ' ') }} F CFA</div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="summary-card">
                    <span class="summary-label">Réalisation mensuelle ({{ $currentMonthLabel }})</span>
                    <span class="summary-value">{{ number_format($montantTotalRealisationMensuel, 0, ',', ' ') }} F CFA</span>
                    <div class="progress-wrapper">
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-info" role="progressbar"
                                 style="width: {{ $monthlyProgress }}%" aria-valuenow="{{ $monthlyProgress }}"
                                 aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <span class="progress-label">{{ number_format($monthlyProgress, 2, ',', ' ') }}% de l'objectif mensuel</span>
                    </div>
                    <div class="summary-sub">Objectif : {{ number_format($monthlyTarget, 0, ',', ' ') }} F CFA</div>
                    <div class="summary-sub">Écart : {{ number_format($monthlyGap, 0, ',', ' ') }} F CFA</div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="summary-card accent">
                    <span class="summary-label">Posts à surveiller</span>
                    <span class="summary-value">{{ $alertPosts->count() }}</span>
                    <div class="summary-sub">Restez attentif aux postes dépassant leurs objectifs.</div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="card dashboard-card">
                    <div class="card-header">
                        Tendances mensuelles
                    </div>
                    <div class="card-body">
                        <p class="chart-subtitle">Montants en millions de F CFA</p>
                        <canvas id="realisation-line-chart" height="240"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card dashboard-card">
                    <div class="card-header">
                        Top 5 des postes budgétaires
                    </div>
                    <div class="card-body">
                        @if($topPosts->isEmpty())
                            <p class="text-muted">Aucun poste disponible pour le moment.</p>
                        @else
                            <ul class="top-posts-list">
                                @foreach($topPosts as $postStat)
                                    <li>
                                        <div class="post-title">{{ $postStat['code'] }} — {{ $postStat['label'] }}</div>
                                        <div class="post-metrics">
                                            <span>{{ number_format($postStat['realisation_annuelle'], 0, ',', ' ') }} F CFA</span>
                                            <span class="badge">{{ number_format($postStat['annual_ratio'], 1, ',', ' ') }}%</span>
                                        </div>
                                        <div class="progress progress-xs">
                                            <div class="progress-bar" role="progressbar"
                                                 style="width: {{ max(0, min(100, $postStat['annual_ratio'])) }}%"></div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="card dashboard-card">
            <div class="card-header">
                Alertes en temps réel
            </div>
            <div class="card-body">
                @if($alertPosts->isEmpty())
                    <p class="text-success no-alert">Aucune alerte en cours. Tous les postes sont dans les limites.</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Poste</th>
                                    <th>Prévision annuelle</th>
                                    <th>Réalisation annuelle</th>
                                    <th>Taux annuel</th>
                                    <th>Prévision mensuelle</th>
                                    <th>Réalisation mensuelle</th>
                                    <th>Taux mensuel</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($alertPosts as $alert)
                                    <tr class="{{ $alert['annual_ratio'] >= 100 ? 'table-danger' : 'table-warning' }}">
                                        <td>
                                            <strong>{{ $alert['code'] }}</strong>
                                            <div class="text-muted">{{ $alert['label'] }}</div>
                                        </td>
                                        <td>{{ number_format($alert['prevision_annuelle'], 0, ',', ' ') }} F CFA</td>
                                        <td>{{ number_format($alert['realisation_annuelle'], 0, ',', ' ') }} F CFA</td>
                                        <td>{{ number_format($alert['annual_ratio'], 1, ',', ' ') }}%</td>
                                        <td>{{ number_format($alert['prevision_mensuelle'], 0, ',', ' ') }} F CFA</td>
                                        <td>{{ number_format($alert['realisation_mensuelle'], 0, ',', ' ') }} F CFA</td>
                                        <td>{{ number_format($alert['monthly_ratio'], 1, ',', ' ') }}%</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

        <div class="card dashboard-card">
            <div class="card-header">
                Liste des postes budgétaires
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Compte</th>
                                <th>Intitulé</th>
                                <th>Catégorie</th>
                                <th>Exercice</th>
                                <th>Montant</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($post as $item)
                                <tr>
                                    <td>{{ $item->numCompte }}</td>
                                    <td>{{ $item->intitulePost }}</td>
                                    <td>{{ data_get($item, 'categorie', '—') }}</td>
                                    <td>{{ data_get($item, 'exercicePrevi', '—') }}</td>
                                    <td>{{ number_format(data_get($item, 'montant', data_get($item, 'montantPrevision', 0)), 0, ',', ' ') }} F CFA</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">Aucun poste budgétaire disponible.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js" integrity="sha384-AfdrqFqdpypuXn7Z1xXHDD236UMtYYV9zp1KimG++Hj6kUMlzUxr87hcPLZ9eczs" crossorigin="anonymous"></script>
    <script>
        (function () {
            var ctx = document.getElementById('realisation-line-chart');
            if (!ctx) {
                return;
            }

            var labels = @json($monthlyLabels);
            var realisations = @json($monthlyRealisation);
            var monthlyTarget = @json($monthlyTarget);

            var realisationsInMillions = realisations.map(function (value) {
                return Number((value / 1000000).toFixed(2));
            });

            var targetInMillions = labels.map(function () {
                return Number((monthlyTarget / 1000000).toFixed(2));
            });

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: 'Réalisation',
                            data: realisationsInMillions,
                            borderColor: '#2C7BE5',
                            backgroundColor: 'rgba(44, 123, 229, 0.15)',
                            tension: 0.4,
                            fill: true,
                            pointRadius: 4,
                            pointHoverRadius: 6
                        },
                        {
                            label: 'Objectif mensuel',
                            data: targetInMillions,
                            borderColor: '#E55353',
                            borderDash: [6, 6],
                            pointRadius: 0,
                            fill: false
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function (value) {
                                    return value + ' M';
                                }
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'bottom'
                        },
                        tooltip: {
                            callbacks: {
                                label: function (context) {
                                    var value = context.raw * 1000000;
                                    return context.dataset.label + ': ' + new Intl.NumberFormat('fr-FR').format(Math.round(value)) + ' F CFA';
                                }
                            }
                        }
                    }
                }
            });
        })();
    </script>
@endpush
