@inject('myFonction', 'App\myFonction')
@extends("layouts/template", [
    $title = "BusinessScan",
    $sb_title = "Setting-Categorie"
])
@section('content_block')
    <div class="container">
        <div class="text-center">
            <a href="#" class="create-modal btn btn-success btn-sm">
                    <i class="glyphicon glyphicon-plus"></i>
            </a>
            <a href="/categorie" class="btn btn-default" > <i class="glyphicon glyphicon-refresh"></i>  Actualiser</a>
        </div>

        <div class="row">
            <div class="col-xs-12">
                    <table class="table table-striped table-bordered" id='dataTables' cellspacing='0' width="100%">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Intitule  </th>
                                    <th>
                                       #
                                    </th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>N°</th>
                                    <th>Intitule  </th>
                                    <th> # </th>
                                </tr>
                            </tfoot>
                            <tbody id="bodytable">
                                <?php $no =1;?>
                                @foreach ($categorie as $key=>$value )
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $value->intituleCat }}</td>

                                        <td>
                                            <button class="show-modal btn btn-success" onclick="showCat({{ $value->codeCat }},'{{ $value->intituleCat }}')">
                                                <i class="glyphicon glyphicon-eye-open"></i>
                                            </button>
                                            <button class="edit-modal btn btn-warning" onclick="editCat({{ $value->codeCat }},'{{ htmlspecialchars($value->intituleCat) }}')">
                                                <i class="glyphicon glyphicon-pencil"></i>
                                            </button>
                                            <button class="delete-modal delete-modal-Ag btn btn-danger"  onclick="deleteCat({{ $value->codeCat }},'{{ $value->intituleCat }}')">
                                                <i class="glyphicon glyphicon-trash" alt="supprimer"></i>
                                            </button>
                                        </td>
                                    </tr>

                                @endforeach

                            </tbody>
                        </table>
            </div>
        </div>

    </div>
    {{ csrf_field() }}

    {{-- modal add --}}

    <div id="create" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <form role="form" class="form-horizontal" method="post">

                        <div class="form-group">
                                <label class="control-label col-sm-3" for="nomAg">Intitule :</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="intitulecat" name="intitulecat" placeholder="Entrez l'intitule de la categorie " required>
                                    <p class="erros text-center alert alert-danger hidden"></p>
                                </div>
                        </div>

                        <div class="form-group">
                            <div class="alert alert-light" style="text-align:center; display:none" id='imgload'>
                                <img src="images/loading.gif"  title="Enregistrement ..." alt="Enregistrement ..." > enregistrement ...
                            </div>
                            <div id='msgform1' style="display:none"></div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <a href="/categorie" class="btn btn-default"><i class="glyphicon glyphicon-refresh"></i>Refresh </a>
                    <button type="submit" id="add-ag" class="btn btn-success">
                        <span class="glyphicon glyphicon-plus"></span> Save
                    </button>
                    <button type="button" id="add" class="btn btn-danger" data-dismiss="modal">
                            <span class="glyphicon glyphicon-remove"></span> Close
                    </button>
                </div>

                </div>
            </div>
        </div>
    </div>

{{-- edition modal form!  --}}}
    <div id="edit" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <form role="form" class="form-horizontal" method="post">

                        <div class="form-group">
                                <label class="control-label col-sm-3" for="codeAg">intitule :</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="edition-intituleCat" placeholder="Entrez le l'intitule " required>
                                    <input type="hidden" id='edition-codeCat'>
                                    <p class="erros text-center alert alert-danger hidden"></p>
                                </div>
                        </div>
                    </form>
                    <div id="form-edit-msg" style='display:none'></div>
                    <div class="alert alert-light" style="text-align:center; display:none;" id='edit-imgload'>
                        <img src="images/loading.gif"  title="Enregistrement  des modification en cour ..." alt="Modification en cour ..."  >
                        Modification en cour ...
                     </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="edit-cat" class="btn btn-success">
                        <span class="glyphicon glyphicon-save"></span> Save
                    </button>
                    <button type="button" id="add" class="btn btn-danger" data-dismiss="modal">
                            <span class="glyphicon glyphicon-remove"></span> Close
                    </button>
                </div>

                </div>
            </div>
        </div>
    </div>





    {{-- modal show --}}

    <div id='show' class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                     <p>Code :  <span id='show-codeCat'></span></p>
                     <p>intitule :  <span id='show-nomCat'></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class ='btn btn-earning' data-dismiss="modal">
                        <span class="glyphicon glyphicon-remove"></span> Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- form edit and delete  --}}

    <div id='deletecontent' class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">

                     <p class="alert alert-danger" id="delete-confirm-msg" style="text-align:center; width:100%">
                        <span class="glyphicon glyphicon-warning-sign"></span>
                          Voulez vous vraiment supprimer ?
                    </p>
                    <input type="hidden" id="delete-codeAg">
                    <input type="hidden" id="delete-nomAg">
                    <input type="hidden" id="delete-regionAg">
                    <input type="hidden" id="delete-typeAg">
                </div>
                <div id="delete-form-msg" style="display:none"></div>
                <div class="alert alert-light" style="text-align:center; display:none;" id='delete-imgload'>
                    <img src="images/loading.gif"  title="Enregistrement  des modification en cour ..." alt="Modification en cour ..."  >
                    Suppression ...
                 </div>
                <div class="modal-footer">
                    <button type="submit" id="deleteAg" class="btn btn-danger">
                        <span class="glyphicon glyphicon-trash"></span> Supprimer
                    </button>
                    <button type="button" class ='btn btn-earning' data-dismiss="modal" id="btn-delete-close-modal">
                        <span class="glyphicon glyphicon-remove"></span> Annuler
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="js/scriptCategorie.js"></script>
</body>
</html>

@endsection
