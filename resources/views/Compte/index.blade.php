@inject('myFonction', 'App\Utilities\myFonction')
@extends("layouts/template", [
    $title = "BusinessScan",
    $sb_title = "Suivi de Comptes"
])

@section('content_block')
        <div class="text-center">
            <a href="{{ route('newAccount') }}" class="create-modal btn btn-success btn-sm">
                    <i class="glyphicon glyphicon-plus"></i> Add
            </a>
            <a href="{{ route('exporterPrevision') }}" class="btn btn-default" > <i class="glyphicon glyphicon-download"></i>  Export</a>
            <a href="{{ route('importerPrevision') }}" class="btn btn-default" > <i class="glyphicon glyphicon-upload"></i>  Import</a>
        </div>

        <div class="row">
            <br>
                <h2 style="text-align:center"> Liste des Comptes</h2> </h2>
            <div class="col-xs-12">
                    <table class="table table-striped table-bordered" id='dataTables' cellspacing='0' width="100%">
                        <thead>
                                <tr>
                                    <th>N°</th>
                                    <th> N°Compte </th>
                                    <th> Libelle </th>
                                    <th> Solde</th>
                                    <th>Type Compte </th>
                                    <th>Description</th>

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
                                    <th width="100"> Solde </th>
                                    <th>Type Compte </th>
                                    <th>Description</th>


                                    <th>
                                       #
                                    </th>
                                </tr>
                            </tfoot>
                            <tbody id="bodytable">
                                <?php $no =1; $totalPrevi = 0; ?>

                                @foreach ($comptes as $key=>$value )
                                    <tr>
                                        @php

                                            $solde = $myFonction->getAccountBalance($value->numCompte);
                                        @endphp
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $value->numCompte }}</td>
                                        <td>{{ $value->accountName}}</td>
                                        <td>{{ number_format($solde,2, ',', ' ') }}</td>
                                        <td>{{ $value->typeCompte}}</td>

                                        <td>{{ $value->description }}</td>

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


            </div>
        </div>

@endsection
