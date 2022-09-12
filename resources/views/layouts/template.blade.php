<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/dataTables.bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <meta name="_token" content="{{ csrf_token() }}">

    <title>Voucher - {{ $sb_title }}</title>
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container-fluid ">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{ route('home') }}">VC BM</a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li class="active"><a href="{{ route('home') }}">Aceuil <span class="sr-only">(current)</span></a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Realisation <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="{{ route('sortiefonds') }}">Sortie de fonds</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="{{ route('sortiefonds') }}">Recettes</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="{{ route('realisation') }}">List</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="{{ route('realisation') }}">Importer </a></li>
              <li role="separator" class="divider"></li>
              <li> <a href="{{ route('rechercheRealisation') }}">Rechercher</a></li>
            </ul>
          </li>
          <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Exercice<span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="{{ route('exercice') }}">Encours</a></li>
                  <li role="separator" class="divider"></li>
                  <li><a href="{{ route('realisation') }}">List</a></li>

                </ul>
            </li>

            <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Etats<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <li><a href="{{ route('statistiqueParmois') }}">Statisques par Mois</a></li>
                      <li role="separator" class="divider"></li>
                      <li><a href="{{ route('ConsoEncours') }}">Conso Encours</a></li>
                      <li role="separator" class="divider"></li>
                      <li><a href="{{ route('postEnDepassement') }}">Post En depassement</a></li>


                    </ul>
            </li>
             <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Gestion Compte<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <li><a href="{{ route('suiviCompte') }}">Comptes</a></li>
                      <li role="separator" class="divider"></li>
                      <li><a href="{{ route('historique') }}">Historique</a></li>
                      <li role="separator" class="divider"></li>
                      <li><a href="{{ route('transfer') }}">Virement</a></li>
                      <li role="separator" class="divider"></li>
                       <li><a href="{{ route('postEnDepassement') }}">Approv</a></li>


                    </ul>
            </li>
              <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Stocks Labo <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <li><a href="{{ route('suiviCompte') }}">Produits/Reactifs</a></li>
                      <li role="separator" class="divider"></li>
                      <li><a href="{{ route('ConsoEncours') }}">Bon de commande</a></li>
                      <li role="separator" class="divider"></li>
                      <li><a href="{{ route('postEnDepassement') }}">Fournisseurs</a></li>
                      <li role="separator" class="divider"></li>
                      <li><a href="{{ route('postEnDepassement') }}">Recap des commandes</a></li>
                      <li role="separator" class="divider"></li>
                      <li><a href="{{ route('postEnDepassement') }}">Synthese Conso Mens</a></li>
                      <li role="separator" class="divider"></li>
                      <li><a href="{{ route('postEnDepassement') }}">Cumul depenses</a></li>
                    </ul>
            </li>
          <li><a href="#">Link</a></li>
        </ul>
        <!--form class="navbar-form navbar-left">
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Search">
          </div>
          <button type="submit" class="btn btn-default">Submit</button>
        </form-->
        <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Parametre<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('prevision') }}">Prevision</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{ route('agence') }}">Agence</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{ route('postbudgetaire') }}">Post budgetaire</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{ route('employes') }}">Employé</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{ route('categorie') }}">Categorie</a></li>
                    </ul>
                </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Profils <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="#">Profils</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="{{ route('users') }}">Users</a></li>



              <li role="separator" class="divider"></li>
              <li> <a href="{{ route('logout') }}"> <i class="fa fa-power-off"> </i> Deconnection</a></li>
            </ul>
          </li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>
  <aside style=" margin-left:5%">
        @include('layouts/brand')
  </aside>
<div class="container">
    @yield('content_block')
</div>


  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/bootstrap.js"></script>
  <script src="js/jquery.dataTables.js"></script>
  <script src="js/dataTables.bootstrap.js"></script>
  <script src="js/scriptCategorie.js"></script>
</body>
</html>
