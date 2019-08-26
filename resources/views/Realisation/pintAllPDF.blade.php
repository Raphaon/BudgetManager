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


                    <table border="1" class="table table-striped table-bordered" id='dataTables' cellspacing='0' width="100%">
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
                                <?php $no =1; $totalMontant =0;?>

                                @foreach ($realisation as $key=>$value )
                                    <tr>

                                        <td>{{ $no++ }}</td>
                                        <td>{{ $value->refferenceRea }}</td>
                                        <td>{{ $value->numCompte }}</td>
                                        <td>{{ $value->intitulePost }}</td>
                                        <td><?php $totalMontant += $value->montantRea;?>  {{  $value->montantRea }}</td>
                                        <td>{{ $value->montantPrevision }}</td>
                                        <td width="100" style="color:red;overflow:auto; word-wrap:break-word">{{ $value->observationRea }}</td>
                                        <td>{{ $value->dateRea }}</td>

                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="4" style="text-align:center"><strong>Total</strong></td>
                                    <td><?php $totalMontant += $value->montantRea;?>  {{  $totalMontant }}</td>
                                    <td colspan="3"></td>
                                </tr>
                            </tbody>
                        </table>
<br>
<br>
<h3 style="float:right; margin-right:150px;"><b>Observation</b></h3>

