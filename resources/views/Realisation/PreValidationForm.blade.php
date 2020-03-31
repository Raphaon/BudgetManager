@inject('myFonction', 'App\myFonction')
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Prevalidation Sortie de fonds</title>
<style>
        $myFonction->
.body
{
    width: 100%;
    display: inline-block;
    font-size: 16px;
    font-family: 'Courier New', Courier, monospace;
}
h1,h2
{
    text-align: center;
}
table
{
    width: 100%;
}
.block
{
    display: inline-block;
    width: 100%;
    vertical-align: top;
}

.block2,.block1
{
    display: inline-block;
    width: 49%;
    border: groove;
    vertical-align: top;
}
.ligne
{
    display: block;
    border: groove;
    width: inherit;
}
.ligne .valeur
{
    display: inline-block;
    border: groove;
    width: 60%;
    float: right;
    text-align:left;
}
.ligne label
{
    display: inline-block;
    border: groove;
    width: 39%;
    float: left;
    text-align:left;
}
.end_signature
{
    text-align: right;
    bottom: 1.5cm;
    float: right;
    position: absolute;
    margin-right: 50px;
}
td
{
    line-height: 22px;
    height: 22px;
}
</style>

@php
                $agence =$myFonction->getBranch(session("BranchCode"));
@endphp
</head>
<div class="body">
        <table border="10" >
                <tr>
                    <td colspan="2">
                        <div class="header">
                            <h1 class="titre">{{ $agence->nomAg }}</h1>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        Exercice : <b>{{ session('anneeExo') }}  </b>
                        <b style="float:right"> <h3>{{ 'Le : '.date('d').'-'.date('m').'-'.date('Y').' A : '.date('H').' : '.date('i')  }}</h3> </b>
                        <h2 class="sub_title">Sortie de Fonds N° <b>{{ $reff }}</b></h2>
                        <br>
                    </td>
                </tr>
                @php

                @endphp
                <tr>
                    <td>N°Compte :</td>
                    <td><b>{{ $codePost }} </b> </td>
                </tr>
                @php
                    $post = $myFonction->getPost($codePost);
                    $post = $post->first();
                    $autorise = $myFonction->getEmployee($autoriseBy);
                    $done = $myFonction->getEmployee($doneBy);

                @endphp
                <tr>
                    <td>Libelle  :</td>
                    <td><b>{{ $post->intitulePost }} </b></td>
                </tr>

                <tr>
                    <td>Montant sortie :</td>
                    <td>{{ number_format($montantSortie,2, ',', ' ')  }}</td>
                </tr>
                 <tr>
                    <td>Effectué par : </td>
                    @if($autorise != null)
                        <td><b class="signature">{{ $autorise->nomEmp}} {{  $autorise->prenom }}</b></td>
                    @else
                         <td><b class="signature">Empty</b></td>
                    @endif
                </tr>
                <tr>
                        <td>Autorisé par : </td>
                        @if($autorise != null)
                        <td><b class="signature">{{ $done->nomEmp}} {{  $done->prenom }}</b></td>
                    @else
                         <td><b class="signature">Empty</b></td>
                    @endif
                            
                </tr>

                <tr>
                    <td>Observation :</td>
                    <td><b class="signature">{{ $observation }}</b></td>
                </tr>
            </table>
<br><br>
<div class="block">
    <div class="block1">
        @php
            $previsionAnnuelle = $myFonction->PreviAnnuelPost($codePost ,session('codeExo'));
            $realisationAnnuel = $myFonction->ReaAnnuelPost($codePost ,session('codeExo'));
            $realisationAnnuel =$realisationAnnuel + $montantSortie;
            $ecartAnnuel = $previsionAnnuelle - $realisationAnnuel;
            $tauxAnnuel = ($realisationAnnuel / $previsionAnnuelle)*100;

            //Mensuel;
            $previsionMensuelle = $previsionAnnuelle/12;
            $dateDebutMois = date('Y').'-'.date('m').'-'.'01';
            $dateFinMois  =date('Y-m-t', strtotime($dateDebutMois));
            $realisationMoisEncours = $myFonction->MontantReaPostSurPeriodDe(session('codeExo'), $dateDebutMois, $dateFinMois, $codePost);
            $realisationMoisEncours = $realisationMoisEncours + $montantSortie;
            $ecartMois = $previsionMensuelle - $realisationMoisEncours;
            $tauxMoisEncours = ($realisationMoisEncours/$previsionMensuelle)*100

        @endphp
        <h3 style="text-align:center">Recap Annuel</h3>
        <label>Prevision annuelle : <b>{{ number_format($previsionAnnuelle,2, ',', ' ')  }}</b></label> <br><br>
        <label>Realisations annuelle : <b>{{ number_format($realisationAnnuel,2, ',', ' ') }}</b></label><br><br>
        <label>Ecart Annuel : <b>{{ number_format($ecartAnnuel,2, ',', ' ') }}</b></label><br><br>
        <label>Taux de Consommation annuel : <b>{{ number_format($tauxAnnuel,2, ',', ' ') }} %</b></label>
    </div>

    <div class="block2">
        <h3 style="text-align:center">Recap Mensuel</h3>
        <label>Prevision mensuelle : <b>{{ number_format($previsionMensuelle,2, ',', ' ')  }}</b></label> <br><br>
        <label>Realisations mensuelle : <b>{{ number_format($realisationMoisEncours,2, ',', ' ')  }}</b></label><br><br>
        <label>Ecart mensuelle : <b>{{ number_format($ecartMois,2, ',', ' ')  }}</b></label><br><br>
        <label>Taux de Consommation mensuelle : <b>{{ number_format($tauxMoisEncours,2, ',', ' ')  }} %</b></label>
    </div>
</div>


<b class="end_signature" >Observation et Autorisation</b>
</div>
</div>
</html>
