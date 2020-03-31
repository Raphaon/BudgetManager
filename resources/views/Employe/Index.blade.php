@inject('myFonction', 'App\myFonction')
@extends("layouts/template", [
    $title = "VC BM",
    $sb_title = "Liste Employé"
])
@section('content_block')
    <div class="container">
      <h1>Liste du Personnel</h1>
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
                                    <th>Matricule</th>
                                    <th> Nom & Prenom </th>
                                    <th> Telephone </th>
                                    <th>Mail </th>
                                    <th>
                                       #
                                    </th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>N°</th>
                                    <th>Matricule</th>
                                    <th> Nom & Prenom </th>
                                    <th> Telephone </th>
                                    <th>Mail </th>
                                    <th>
                                       #
                                    </th>
                                </tr>
                            </tfoot>
                            <tbody id="bodytable">
                                <?php $no =1;?>

                                @foreach ($employes as $key=>$value )
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $value->matriculeEmp }}</td>
                                        <td>{{ $value->nomEmp }}</td>
                                        <td>{{ $value->telephone }}</td>
                                        <td>{{ $value->mail }}</td>
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
