@inject('myFonction', 'App\myFonction')
@extends("layouts/template", [
    $title = "BusinessScan",
    $sb_title = "Parametrage-Post"
])
@section('content_block')
    <div class="container">
        <div class="text-center">
            <a href="{{ route('nouveauPost') }}" class="create-modal btn btn-success btn-sm">
                    <i class="glyphicon glyphicon-plus"></i> Add
            </a>
            <a href="postbudgetaire" class="btn btn-default" > <i class="glyphicon glyphicon-refresh"></i>  Refresh</a>
            <a href="postbudgetaire/export" class="btn btn-default" > <i class="glyphicon glyphicon-download"></i>  Export</a>
            <a href="postbudgetaire/import" class="btn btn-default" > <i class="glyphicon glyphicon-upload"></i>  Import</a>
        </div>

        <div class="row">
            <div class="col-xs-12">
                    <table class="table table-striped table-bordered" id='dataTables' cellspacing='0' width="100%">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th> N° de compte </th>
                                    <th> Libelle </th>
                                    <th>Sens </th>
                                    <th>Categorie </th>

                                    <th>
                                       #
                                    </th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>

                                        <th>N°</th>
                                        <th> N° de compte </th>
                                        <th> Libelle </th>
                                        <th>Sens </th>
                                        <th>Categorie </th>

                                        <th>
                                           #
                                        </th>
                                </tr>
                            </tfoot>
                            <tbody id="bodytable">
                                <?php $no =1;?>

                                @foreach ($postbudgetaire as $key=>$value )
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $value->numCompte }}</td>
                                        <td>{{ $value->intitulePost }}</td>
                                        <td>{{ $value->sensPost }}</td>
                                        <td>{{ $value->intituleCat }}</td>
                                        <td>
                                            <a class="show-modal btn btn-success" href="postbudgetaire/view/{{ $value->numCompte }}">
                                                <i class="glyphicon glyphicon-eye-open"></i>
                                            </a>
                                            <a class="edit-modal btn btn-warning" href="postbudgetaire/edit/{{ $value->numCompte }}">
                                                <i class="glyphicon glyphicon-pencil"></i>
                                            </a>
                                            <a class="delete-modal delete-modal-Ag btn btn-danger"  href="postbudgetaire/delete/{{ $value->numCompte }}">
                                                <i class="glyphicon glyphicon-trash" alt="supprimer"></i>
                                            </a>
                                        </td>
                                    </tr>

                                @endforeach

                            </tbody>
                        </table>
            </div>
        </div>

    </div>
    @endsection
