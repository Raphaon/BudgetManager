
@inject('myFonction', 'App\myFonction')
@extends("layouts/template", [
    $title = "BusinessScan",
    $sb_title = "Home"
])


@section('content_block')
<div class="container">
        <h3> Nouvelle Sortie de fonds</h3>
    <div class="panel panel-content col-sm-11 " >

        <div class="alert alert-warning" id='warning-alert-rea' role="alert" style="display:none">
            <strong>Atention !!!</strong> Vous allez depassez la moitier du budget pour ce mois
        </div>
        <div class="alert alert-danger" id="danger-alert-rea" role="alert" style="display:none">
            <strong>Attention ! </strong> vous avez depassez votre budget !  Autorisez cette depense entraine un resultat negatif pour la rubrique
        </div>



               @if (session()->has('addSucceedMvt'))
               <div class="alert alert-success" role="alert" >
                   {{ session('addSucceedMvt') }}
                </div>
               @endif
               @if (session()->has('errorsformPrint'))
               <div class="alert alert-danger" role="alert" >
                   {{ session('errorsformPrint') }}
                </div>
               @endif
    <div class="">
			<div class="container-fliud">
				<div class="wrapper row">
					<div class="preview col-md-6">
                        <form role="form" class="form-horizontal" method="post" action="/realisation/new">
                            {{ csrf_field() }}
                        <div class="panel panel-body">


                                <div class="form-group">
                                    <label class="control-label col-sm-4">Libelle post:</label>
                                    <div class="col-sm-8">

                                       <select class="form-control" name="post" id="rubrique_rea">
                                            <option value="">Selectionner un Post</option>
                                           @foreach ($post as $values )
                                            <option value="{{ $values->numCompte }}">{{ strtoupper($values->intitulePost) }}</option>
                                           @endforeach

                                       </select>
                                        <p class="erros text-center alert alert-danger hidden"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4">Montant sortie :</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" min=0 name="montant" id="montant_rea" placeholder="Montant de la sortie de fonds" required>
                                        <p class="erros text-center alert alert-danger hidden"></p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-4">Reliquat :</label>
                                    <div class="col-sm-8">
                                        <input type="text" readonly class="form-control" name="nouveauReliquat" id="montantReliquat">
                                    </div>
                                </div>
                                <div class="form-group">
                                        <label class="control-label col-sm-4">Nvle Realisation:</label>
                                        <div class="col-sm-8">
                                            <input type="text" readonly class="form-control" name="nouveauRealisation" id="montantnvleRealisation">
                                        </div>
                                    </div>






                                     <div class="form-group">
                                    <label class="control-label col-sm-4" >Compte :</label>
                                    <div class="col-sm-8">

                                       <select class="form-control" name="compteConcern"  required>
                                           <option value="" selected >Compte à mouvementer </option>
                                           @foreach ($comptes as $values )
                                            <option value="{{ $values->numCompte }}">{{  strtoupper($values->accountName)}}</option>
                                           @endforeach

                                       </select>
                                        <p class="erros text-center alert alert-danger hidden"></p>
                                    </div>
                                </div>











                                <div class="form-group">
                                    <label class="control-label col-sm-4" >Effectué par :</label>
                                    <div class="col-sm-8">

                                       <select class="form-control" name="employe_effectuer" id="employe_effectuer_rea"  required>
                                           <option value="" selected >Selectionner l utilisateur </option>
                                           @foreach ($employe as $values )
                                            <option value="{{ $values->matriculeEmp }}">{{ strtoupper($values->nomEmp." ".$values->prenom) }}</option>
                                           @endforeach

                                       </select>
                                        <p class="erros text-center alert alert-danger hidden"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4">Autorisé par :</label>
                                    <div class="col-sm-8">

                                       <select class="form-control" name="employe_autorise" required id="employe_autorise_rea">
                                           <option value="" selected>Selectionner un employes</option>
                                           @foreach ($employe as $values )
                                            <option value="{{ $values->matriculeEmp }}">{{ strtoupper($values->nomEmp." ".$values->prenom) }}</option>
                                           @endforeach

                                       </select>
                                        <p class="erros text-center alert alert-danger hidden"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4">Exercice :</label>
                                    <div class="col-sm-8">
                                       <select name="exercice" id="exercice_rea" class="form-control" required>
                                           @foreach ( $exo as $values )


                                                 <option value="{{ $values->codeExercice }}">{{ $values->AnneeExercice }}</option>

                                           @endforeach
                                       </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                        <label class="control-label col-sm-4">Date :</label>
                                        <div class="col-sm-8">
                                            <input type="date" class="form-control" name="datarea" id='date_rea' placeholder="Entrez l'intitule de la categorie " required>
                                        </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4">Observation :</label>
                                    <div class="col-sm-8">
                                       <textarea class="form-control" name="observationrea" id="observation_rea" cols="30" rows="10"></textarea>
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
                            <input type="submit" id='btn_submit_form_realisation' value="Valider" class="btn btn-primary" >
                            <a id="PrintPrevalidation" href="#" id='btn_submit_form_realisation' class="btn btn-default" > Imprimer</a>
                            <input type="reset" value="Annuler" class="btn btn-danger">
                        </div>
                    </form>


					</div>
					<div class="details col-md-6">
                        <h4 class="align-middle">Detail du post : <b  id="codePostBud"></b> </h4>
                        <hr>
                        <h5> Prevision annuelle : <b id="PreviAnnuel">  </b> </h5>
                        <h5> Realisation annuelle : <b id="ReaAnnuel"></b>    </h5>
                        <h5> Ecart Annuel : <b id="EcartAnnuel"></b>    </h5>
                        <h5> Taux de Consommation annuel : <b id="tauxAnnuel">test</b>    </h5>
                        <div class="progress" >
                            <div class="progress-bar" id="progressAnnuel" role="progressbar" style="width:5%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">0%</div>
                        </div>
                        <hr>
                        <h5> Prevision mensuelle : <b id="previMens"></b>   <input type="hidden" id="EcartMensuelHidden"> </h5>
                        <input type="hidden" id="realisationMensuelHidden">
                        <h5> Realisation mensuelle : <b id="reaMens"></b>    </h5>
                        <h5> Ecart mensuel: <b id="EcartMens"></b>    </h5>
                        <h5> Taux de Consommation mensuel : <b id="tauxMens"></b>    </h5>
                        <div class="progress">
                            <div class="progress-bar" id="progressMens" role="progressbar" style="width: 5%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">0%</div>
                        </div>
					</div>
				</div>
			</div>
		</div>
    </div>
</div>

<style>

/*****************globals*************/




  .preview {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -webkit-flex-direction: column;
        -ms-flex-direction: column;
            flex-direction: column; }
    @media screen and (max-width: 996px) {
      .preview {
        margin-bottom: 20px; } }

  .preview-pic {
    -webkit-box-flex: 1;
    -webkit-flex-grow: 1;
        -ms-flex-positive: 1;
            flex-grow: 1; }

  .preview-thumbnail.nav-tabs {
    border: none;
    margin-top: 15px; }
    .preview-thumbnail.nav-tabs li {
      width: 18%;
      margin-right: 2.5%; }
      .preview-thumbnail.nav-tabs li img {
        max-width: 100%;
        display: block; }
      .preview-thumbnail.nav-tabs li a {
        padding: 0;
        margin: 0; }
      .preview-thumbnail.nav-tabs li:last-of-type {
        margin-right: 0; }

  .tab-content {
    overflow: hidden; }
    .tab-content img {
      width: 100%;
      -webkit-animation-name: opacity;
              animation-name: opacity;
      -webkit-animation-duration: .3s;
              animation-duration: .3s; }

  .card {
    margin-top: 50px;
    background: #eee;
    padding: 3em;
    line-height: 1.5em; }

  @media screen and (min-width: 997px) {
    .wrapper {
      display: -webkit-box;
      display: -webkit-flex;
      display: -ms-flexbox;
      display: flex; } }

  .details {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -webkit-flex-direction: column;
        -ms-flex-direction: column;
            flex-direction: column; }

  .colors {
    -webkit-box-flex: 1;
    -webkit-flex-grow: 1;
        -ms-flex-positive: 1;
            flex-grow: 1; }

  .product-title, .price, .sizes, .colors {
    text-transform: UPPERCASE;
    font-weight: bold; }

  .checked, .price span {
    color: #ff9f1a; }

  .product-title, .rating, .product-description, .price, .vote, .sizes {
    margin-bottom: 15px; }

  .product-title {
    margin-top: 0; }

  .size {
    margin-right: 10px; }
    .size:first-of-type {
      margin-left: 40px; }

  .color {
    display: inline-block;
    vertical-align: middle;
    margin-right: 10px;
    height: 2em;
    width: 2em;
    border-radius: 2px; }
    .color:first-of-type {
      margin-left: 20px; }

  .add-to-cart, .like {
    background: #ff9f1a;
    padding: 1.2em 1.5em;
    border: none;
    text-transform: UPPERCASE;
    font-weight: bold;
    color: #fff;
    -webkit-transition: background .3s ease;
            transition: background .3s ease; }
    .add-to-cart:hover, .like:hover {
      background: #b36800;
      color: #fff; }

  .not-available {
    text-align: center;
    line-height: 2em; }
    .not-available:before {
      font-family: fontawesome;
      content: "\f00d";
      color: #fff; }

  .orange {
    background: #ff9f1a; }

  .green {
    background: #85ad00; }

  .blue {
    background: #0076ad; }

  .tooltip-inner {
    padding: 1.3em; }

 }



  /*# sourceMappingURL=style.css.map */
</style>


<script src="../js/jquery-3.3.1.min.js"></script>
<script src="../js/bootstrap.js"></script>
<script src="../js/jquery.dataTables.js"></script>
<script src="../js/dataTables.bootstrap.js"></script>
<script src="../js/ScriptnouvelRealisation.js"></script>

@endsection
