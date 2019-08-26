@inject('myFonction', 'App\myFonction')
@extends("layouts/template", [
    $title = "BusinessScan",
    $sb_title = "Users setting"
])

@section('content_block')

        <div class="text-center">
            <a href="{{ route('new_user') }}" class="create-modal btn btn-success btn-sm">
                    <i class="glyphicon glyphicon-plus"></i> Add
            </a>
            <a href="{{ route('users') }}" class="btn btn-default" > <i class="glyphicon glyphicon-refresh"></i>  Refresh</a>
            <a href="users" class="btn btn-default" > <i class="glyphicon glyphicon-download"></i>  Affecter group</a>
        </div>

        <div class="row">
            <div class="col-xs-12">
                    <table class="table table-striped table-bordered" id='dataTables' cellspacing='0' width="100%">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Nom </th>
                                    <th>Prenom </th>
                                    <th>Login </th>
                                    <th>Groupe </th>

                                    <th>
                                       #
                                    </th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>

                                    <th>N°</th>
                                    <th>Nom </th>
                                    <th>Prenom </th>
                                    <th>Login </th>
                                    <th>Groupe </th>

                                    <th>
                                           #
                                    </th>
                                </tr>
                            </tfoot>
                            <tbody id="bodytable">
                                <?php $no =1;?>

                                @foreach ($users as $key=>$value )
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $value->users_name }}</td>
                                        <td>{{ $value->users_surname }}</td>
                                        <td>{{ $value->login }}</td>
                                        <td>{{ $value->nom }}</td>
                                        <td>
                                            <a class="show-modal btn btn-success" href="postbudgetaire/view/{{ $value->user_id }}">
                                                <i class="glyphicon glyphicon-eye-open"></i>
                                            </a>
                                            <a class="edit-modal btn btn-warning" href="postbudgetaire/edit/{{ $value->user_id }}">
                                                <i class="glyphicon glyphicon-pencil"></i>
                                            </a>
                                            <a class="delete-modal delete-modal-Ag btn btn-danger"  href="postbudgetaire/delete/{{ $value->user_id }}">
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
