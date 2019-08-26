@inject('myFonction', 'App\myFonction')
@extends("layouts/template", [
    $title = "BusinessScan",
    $sb_title = "Nouvelle-Prevision"
])
@section('content_block')

<div class="container">
    <div class="panel panel-content col-sm-11" >
        <div class="panel panel-heading">
            <div class="panel panel-title">Nouvelle prevision</div>
        </div>

        <form role="form" class="form-horizontal" method="post" action="/prevision/new">
            {{ csrf_field() }}
        <div class="panel panel-body">


                <div class="form-group">
                    <label class="control-label col-sm-3">Libelle post:</label>
                    <div class="col-sm-5">

                       <select class="form-control" name="post">
                           @foreach ($post as $values )
                            <option value="{{ $values->numCompte }}">{{ $values->intitulePost }}</option>
                           @endforeach

                       </select>
                        <p class="erros text-center alert alert-danger hidden"></p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3">Montant :</label>
                    <div class="col-sm-5">
                        <input type="number" class="form-control" name="montant" placeholder="Entrez l'intitule de la categorie " required>
                        <p class="erros text-center alert alert-danger hidden"></p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3">Exercice :</label>
                    <div class="col-sm-5">
                       <select name="exercice" id="" class="form-control" required>
                           @foreach ( $exercice as $values )
                                 <option value="{{ $values->codeExercice }}">{{ $values->AnneeExercice }}</option>
                           @endforeach
                       </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3">Observation :</label>
                    <div class="col-sm-5">
                       <textarea class="form-control" name="observationprevi" cols="30" rows="10"></textarea>
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
<script src="../../js/jquery-3.3.1.min.js"></script>
<script src="../../js/bootstrap.js"></script>

@endsection
