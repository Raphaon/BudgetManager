@inject('myFonction', 'App\myFonction')
@extends("layouts/template", [
    $title = "BusinessScan",
    $sb_title = "Prevision"
])

@section('content_block')
        <div class="text-center">
            <a href="{{ route('nouvellePrevision') }}" class="create-modal btn btn-success btn-sm">
                    <i class="glyphicon glyphicon-plus"></i> Add
            </a>
            <a href="{{ route('exporterPrevision') }}" class="btn btn-default" > <i class="glyphicon glyphicon-download"></i>  Export</a>
            <a href="{{ route('importerPrevision') }}" class="btn btn-default" > <i class="glyphicon glyphicon-upload"></i>  Import</a>
        </div>

        <div class="row">
            <br>
                <h2 style="text-align:center"> Liste des previsions annuelles</h2> </h2>
            <div class="col-xs-12">
                    <table class="table table-striped table-bordered" id='dataTables' cellspacing='0' width="100%">
                        <thead>
                                <tr>
                                    <th>N°</th>
                                    <th> N°Compte </th>
                                    <th> Libelle </th>
                                    <th> Montant</th>
                                    <th>Exercice </th>
                                    <th>% Sur BG </th>
                                    <th>Observation </th>

                                    <th>
                                       #
                                    </th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>N°</th>
                                    <th> N°Compte </th>
                                    <th> Libelle </th>
                                    <th width="100"> Montant </th>
                                    <th>Exercice </th>
                                    <th>% Sur BG</th>
                                    <th width="200">Observation </th>

                                    <th>
                                       #
                                    </th>
                                </tr>
                            </tfoot>
                            <tbody id="bodytable">
                                <?php $no =1; $totalPrevi = 0; ?>

                                @foreach ($prevision as $key=>$value )
                                    <tr>
                                        @php
                                            $totalPrevi = $totalPrevi + $value->montantPrevision;
                                            $preViA = $myFonction->totalPreviAnnuel(session('codeExo'));
                                            $pourcentageSurPrevi = ($value->montantPrevision/$preViA)*100;
                                        @endphp
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $value->numCompte }}</td>
                                        <td>{{ $value->intitulePost }}</td>
                                        <td>{{ number_format($value->montantPrevision,2, ',', ' ') }}</td>
                                        <td>{{ $value->AnneeExercice }}</td>
                                        <td>{{ number_format($pourcentageSurPrevi,2, ',', ' ') }}%</td>
                                        <td>{{ $value->observationPrevi }}</td>

                                        <td>
                                            <a class="show-modal btn btn-success" href="prevsion/view/{{ $value->idPrevision }}">
                                                <i class="glyphicon glyphicon-eye-open"></i>
                                            </a>
                                            <a class="edit-modal btn btn-warning" href="prevision/edit/{{ $value->idPrevision }}">
                                                <i class="glyphicon glyphicon-pencil"></i>
                                            </a>
                                            <a class="delete-modal delete-modal-Ag btn btn-danger"  href="prevision/delete/{{ $value->idPrevision }}">
                                                <i class="glyphicon glyphicon-trash" alt="supprimer"></i>
                                            </a>
                                        </td>
                                    </tr>

                                @endforeach

                            </tbody>
                        </table>

                        <div class="alert alert-info" role="alert" style="text-align:center">
                            <b> Montant Global des Previsions :  {{ number_format($totalPrevi,2, ',', ' ')  }}</b>
                            <br> <br>
                            NB % Sur BG  = Poucentage sur budget Global
                        </div>
            </div>
        </div>
  
@endsection
