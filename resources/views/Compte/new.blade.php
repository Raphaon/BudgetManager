@inject('myFonction', 'App\myFonction')
@extends("layouts/template", [
    $title = "BusinessScan",
    $sb_title = "Nouvelle-Prevision"
])
@section('content_block')

<div class="container">
    <div class="panel panel-content col-sm-11" >
        <div class="panel panel-heading">
            <div class="panel panel-title">Nouveau Compte</div>
        </div>

        <form role="form" class="form-horizontal" method="post" action="{{ route('storeAccount')}}">
            {{ csrf_field() }}
        <div class="panel panel-body">

            @if(Session::has('msg'))
                <p class="alert alert-info">{{ Session::get('msg') }}</p>
             @endif

                <div class="form-group">
                    <label class="control-label col-sm-3">Numero de Compte :</label>
                    <div class="col-sm-5">
                       <input  type='text' class="form-control" name="accountNumber" >
                        <p class="erros text-center alert alert-danger hidden"></p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3">Nom du Compte :</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="accountName" placeholder="Entrez le nom du Compte " required>
                        <p class="erros text-center alert alert-danger hidden"></p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3">Type de Compte :</label>
                    <div class="col-sm-5">
                       <select name="accountType" class="form-control" required>
                           <option value="Gestion">Gestion</option>
                           <option value="Production">Production</option>
                       </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3">Observation :</label>
                    <div class="col-sm-5">
                       <textarea class="form-control" name="observationAccount" cols="30" rows="10"></textarea>
                    </div>
                </div>
                <div class="form-group" style="margin-left:26%;">



                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
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
