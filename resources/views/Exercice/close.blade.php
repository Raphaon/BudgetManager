
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/dataTables.bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <meta name="_token" content="{{ csrf_token() }}">
    <title>DataTables Exercice</title>
</head>
<body>

<div class="container">
    <div class="panel panel-content col-sm-11" >
        <div class="panel panel-heading">
            <div class="panel panel-title">Ouvrir un Exercice budgetaire</div>
        </div>

        <form role="form" class="form-horizontal" method="post" action="/exercice/create">
            {{ csrf_field() }}
        <div class="panel panel-body">


                <div class="form-group">
                        <label class="control-label col-sm-3">Code Exercice :</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="codeExo" placeholder="Entrez l'intitule de la categorie " required>
                            <p class="erros text-center alert alert-danger hidden"></p>
                        </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3">Annee exercice :</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="anneeExo" placeholder="Entrez l'intitule de la categorie " required>
                        <p class="erros text-center alert alert-danger hidden"></p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3">Date de debut :</label>
                    <div class="col-sm-5">
                        <input type="date" class="form-control" name="datedebutexo" placeholder="Entrez l'intitule de la categorie " required>
                        <p class="erros text-center alert alert-danger hidden"></p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3">Date de fin :</label>
                    <div class="col-sm-5">
                        <input type="date" class="form-control"name="datefinexo" placeholder="Entrez l'intitule de la categorie " required>
                        <p class="erros text-center alert alert-danger hidden"></p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3">Agence:</label>
                    <div class="col-sm-5">

                       <select class="form-control" name="agenceexo">
                           @foreach ($agence as $values )
                            <option value="{{ $values->codeAg }}">{{ $values->nomAg }}</option>
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
<script src="../js/jquery.dataTables.js"></script>
<script src="../js/dataTables.bootstrap.js"></script>
<script src="../js/scriptCategorie.js"></script>

<script>

    $(function(){
            $('#btn_submit_exo_form').on('click', function ()
            {
                alert();
            }

    });
</script>
</body>
</html>
