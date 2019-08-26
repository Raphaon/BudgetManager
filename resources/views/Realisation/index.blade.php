@inject('myFonction', 'App\myFonction')
@extends("layouts/template", [
    $title = "BusinessScan",
    $sb_title = "Exercice Encours"
])

@section('content_block')
        <div class="text-center">
            <a href="realisation/new" class="create-modal btn btn-success btn-sm">
                    <i class="glyphicon glyphicon-plus"></i> Add
            </a>
            <a href="{{ route('realisation') }}" class="btn btn-default" > <i class="glyphicon glyphicon-refresh"></i>  Refresh</a>
            <a href="{{ route('importrealisation') }}" class="btn btn-default" > <i class="glyphicon glyphicon-upload"></i>  Import</a>
        </div>

        <div class="row">
            <caption><h3>Liste des realisations Jan - {{ date('M') }} </h3></caption>
            <div class="col-xs-12">
                    <table class="table table-striped table-bordered" id='dataTables' cellspacing='0' width="100%">

                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th> Refference </th>
                                    <th> N°Compte </th>
                                    <th> Libelle </th>
                                    <th> Montant Sortie</th>
                                    <th>Observation </th>
                                    <th>Effectuer par </th>
                                    <th>Autorise par</th>
                                    <th>Date </th>
                                    <th>
                                       #
                                    </th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>N°</th>
                                    <th> Refference </th>
                                    <th> N°Compte </th>
                                    <th> Libelle </th>
                                    <th> Montant Sortie</th>
                                    <th>Observation </th>
                                    <th>Effectuer par </th>
                                    <th>Autorise par</th>
                                    <th>Date </th>
                                    <th>
                                       #
                                    </th>
                                </tr>
                            </tfoot>
                            <tbody id="bodytable">
                                <?php $no =1; $totalMontant =0;?>

                                @foreach ($realisation as $key=>$value )
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $value->refferenceRea }}</td>
                                        <td>{{ $value->numCompte }}</td>
                                        <td>{{ $value->intitulePost }}</td>
                                        <td><?php $totalMontant += $value->montantRea;?>  {{ number_format($value->montantRea,2, ',', ' ')   }}</td>
                                        <td>{{ $value->observationRea }}</td>
                                        <td>{{ $myFonction->getEmployee($value->effectuer_par)->nomEmp }}</td>
                                        <td>{{ $myFonction->getEmployee($value->autorise_par)->nomEmp  }}</td>
                                        <td>{{ $value->dateRea }}</td>
                                        <td>
                                            <a class="show-modal btn btn-success" href="realisation/view/{{ $value->refferenceRea }}">
                                                <i class="glyphicon glyphicon-eye-open"></i>
                                            </a>
                                            <a class="edit-modal btn btn-warning" href="realisation/view/{{ $value->refferenceRea }}">
                                                <i class="glyphicon glyphicon-pencil"></i>
                                            </a>
                                            <a class="delete-modal delete-modal-Ag btn btn-danger"  href="realisation/view/{{ $value->refferenceRea }}">
                                                <i class="glyphicon glyphicon-trash" alt="supprimer"></i>
                                            </a>
                                        </td>
                                    </tr>

                                @endforeach

                            </tbody>
                        </table>
            </div>
        </div>

<span class="alert alert-info" style="text-align:center; display:block;">
   Montant Total realisations : {{ number_format($totalMontant,2, ',', ' ')  }}
</span>
@endsection
