@inject('myFonction', 'App\myFonction')
@extends("layouts/template", [
    $title = "BusinessScan",
    $sb_title = "Parametrage-Post-Nouveau"
])
@section('content_block')
<div class="container">
    <div class="panel panel-content col-sm-11" >
        <div class="panel panel-heading">
            <div class="panel panel-title">Nouveau post budgetaire</div>
        </div>

        <form role="form" class="form-horizontal" method="post" action="/postbudgetaire/new">
            {{ csrf_field() }}
        <div class="panel panel-body">


                <div class="form-group">
                        <label class="control-label col-sm-3">Numero de compte :</label>
                        <div class="col-sm-5">
                            <input type="number" class="form-control" name="numCompte" placeholder="Entrez l'intitule de la categorie " required>
                            <p class="erros text-center alert alert-danger hidden"></p>
                        </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3">Libelle :</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="libelle" placeholder="Entrez l'intitule de la categorie " required>
                        <p class="erros text-center alert alert-danger hidden"></p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3">Sens :</label>
                    <div class="col-sm-5">
                       <select name="sens" id="" class="form-control">
                           <option value="Charge">Charge</option>
                           <option value="Produit">Produit</option>
                       </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3">Categorie:</label>
                    <div class="col-sm-5">

                       <select class="form-control" name="categorie">
                           @foreach ($categorie as $values )
                            <option value="{{ $values->codeCat }}">{{ $values->intituleCat }}</option>
                           @endforeach

                       </select>
                        <p class="erros text-center alert alert-danger hidden"></p>
                    </div>
                </div>

                <div class="form-group" style="margin-left:26%;">

                            @if(!empty($msg) and isset($msg))
                            <div class='alert alert-success col-sm-5' style='text-align:center;'>
                                {{ $msg }}
                            </div>
                            @endif

                </div>

        </div>
        <div class="panel panel-footer">
            <input type="submit" id='btn_submit_exo_form' value="Valider" class="btn btn-primary" >
            <input type="reset" value="Annuler" class="btn btn-danger">
        </div>
    </form>


    </div>
</div>




<script src="../js/jquery-3.3.1.min.js"></script>
<script src="../js/bootstrap.js"></script>
<script>

    $(function(){
            $('#btn_submit_exo_form').on('click', function ()
            {
                alert();
            }

    });
@endsection
