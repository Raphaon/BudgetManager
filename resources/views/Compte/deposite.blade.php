@inject('myFonction', 'App\myFonction')
@extends("layouts/template", [
    $title = "BusinessScan",
    $sb_title = "Nouvelle-Prevision"
])
@section('content_block')

<div class="container">
    <div class="panel panel-content col-sm-11" >
        <div class="panel panel-heading">
            <div class="panel panel-title">Approvisionement d'un Compte </div>
        </div>

        <form role="form" class="form-horizontal" method="post" action="/prevision/new">
            {{ csrf_field() }}
        <div class="panel panel-body">

            <div class="form-group">
                <label class="control-label col-sm-3">Date  :</label>
                <div class="col-sm-5">
                    <input type="date" class="form-control" name="dateOfTransfer" required>
                    <p class="erros text-center alert alert-danger hidden"></p>
                </div>
            </div>




                <div class="form-group">
                    <label class="control-label col-sm-3">Credit le  :</label>
                    <div class="col-sm-5">

                       <select class="form-control" name="accountCredit">
                           <option value="">Compte à crediter</option>
                           @foreach ($comptes as $values )
                            <option value="{{ $values->numCompte }}">{{ $values->accountName }}</option>
                           @endforeach
                       </select>
                        <p class="erros text-center alert alert-danger hidden"></p>
                    </div>
                </div>


                <div class="form-group">
                    <label class="control-label col-sm-3">Montant :</label>
                    <div class="col-sm-5">
                        <input type="number" class="form-control" name="amountToDebit" placeholder="Entrez l'intitule de la categorie " required>
                        <p class="erros text-center alert alert-danger hidden"></p>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3">Raison :</label>
                    <div class="col-sm-5">
                       <textarea class="form-control" name="observationprevi"  rows="5"></textarea>
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
