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

    <title>Voucher</title>
</head>

        <header style="text-align:center">
            <h1>PEOPLE FINANCE</h1>
            <span>Arrete ministeriel N°76578576</span><br>
        </header>

    <br>
    <hr>
    <h3 style="text-align:center">Liste des realisations Globals de l annee</h3>
    <style>
        header
        {
            font-family: Arial, Helvetica, sans-serif;
            color:green;
        }
    </style>

        <div class="row">
            <div class="col-xs-12">
                    <table border="1"  class="table table-striped table-bordered" id='dataTables' cellspacing='0' width="100%">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th> Refference </th>
                                    <th> N°Compte </th>
                                    <th> Libelle </th>
                                    <th> Montant Sortie</th>
                                    <th>Prevision</th>
                                    <th>Observation </th>
                                    <th>Date </th>
                                </tr>
                            </thead>

                            <tbody id="bodytable">



                            </tbody>
                        </table>
            </div>
        </div>

<span class="alert alert-info" style="text-align:center; display:block;">
   Montant Total realisations :
</span>
<br>
<h5 style="float:right"><b>Observation</b></h5>



