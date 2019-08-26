@inject('myFonction', 'App\myFonction')
@extends("layouts/template", [
    $title = "BusinessScan",
    $sb_title = "Home"
])

@section('content_block')
<div class="container" style=" display:inline-block">
    <div class="card">
        <div class="card-header">
            @php
                $agence =$myFonction->getBranch(session("BranchCode"));
            @endphp

        </div>
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <!------ Include the above in your HEAD tag ---------->

            <div class="container" >
                <div class="row" >
                    <div class="[ col-xs-12 col-sm-offset-2 col-sm-8 ]" style="margin-left:0px; padding:0px; width:97%">
                        <ul class="event-list">
                            <li>
                                <time datetime="{{ date('Y').'-'.date('m').'-'.date('d') }}">
                                    <span class="day">{{ date('d') }}</span>
                                    <span class="month">{{ date('M') }}</span>
                                    <span class="year">{{ date('Y') }}</span>
                                    <span class="time">{{ date('Y').'-'.date('m').'-'.date('d') }}</span>
                                </time>

                                <div class="info">
                                    <h2 class="title">Agence de : {{ $agence->nomAg }}</h2><br>
                                    <p class="desc">Exercice <b>{{ session('anneeExo') }} @if(session('codeExo')=="none")  : Auccun Exercice Budgetaire n est En cours @endif</b> </p>
                                    <p class="desc">Budget de  <b>{{ $budgetSide }}</b> </p>
                                </div>
                                <div class="social">
                                    <ul>
                                        <li class="facebook" style="width:33%;"><a href="#facebook"><span class="fa fa-facebook"></span></a></li>
                                        <li class="twitter" style="width:34%;"><a href="#twitter"><span class="fa fa-twitter"></span></a></li>
                                        <li class="google-plus" style="width:33%;"><a href="#google-plus"><span class="fa fa-google-plus"></span></a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <style>
        @import url("http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,400italic");
        @import url("//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.css");
        body
        {
            background-color: rgb(220, 220, 220);
        }

        .event-list
        {
            list-style: none;
            font-family: 'Lato', sans-serif;
            margin: 0px;
            padding: 0px;
        }
        .event-list > li
        {
            background-color: rgb(255, 255, 255);
            box-shadow: 0px 0px 5px rgb(51, 51, 51);
            box-shadow: 0px 0px 5px rgba(51, 51, 51, 0.7);
            padding: 0px;
            margin: 0px 0px 20px;
        }
        .event-list > li > time {
        display: inline-block;
        width: 100%;
        color: rgb(255, 255, 255);
        background-color: rgb(197, 44, 102);
        padding: 5px;
        text-align: center;
        text-transform: uppercase;
        }
        .event-list > li:nth-child(even) > time {
        background-color: rgb(165, 82, 167);
        }
        .event-list > li > time > span {
        display: none;
        }
        .event-list > li > time > .day {
        display: block;
        font-size: 56pt;
        font-weight: 100;
        line-height: 1;
        }
        .event-list > li time > .month {
        display: block;
        font-size: 24pt;
        font-weight: 900;
        line-height: 1;
        }
        .event-list > li > img {
        width: 100%;
        }
        .event-list > li > .info {
        padding-top: 5px;
        text-align: center;
        }
        .event-list > li > .info > .title {
        font-size: 17pt;
        font-weight: 700;
        margin: 0px;
        }
        .event-list > li > .info > .desc {
        font-size: 13pt;
        font-weight: 300;
        margin: 0px;
        }
        .event-list > li > .info > ul,
        .event-list > li > .social > ul {
        display: table;
        list-style: none;
        margin: 10px 0px 0px;
        padding: 0px;
        width: 100%;
        text-align: center;
        }
        .event-list > li > .social > ul {
        margin: 0px;
        }
        .event-list > li > .info > ul > li,
        .event-list > li > .social > ul > li {
        display: table-cell;
        cursor: pointer;
        color: rgb(30, 30, 30);
        font-size: 11pt;
        font-weight: 300;
        padding: 3px 0px;
        }
        .event-list > li > .info > ul > li > a {
        display: block;
        width: 100%;
        color: rgb(30, 30, 30);
        text-decoration: none;
        }
        .event-list > li > .social > ul > li {
        padding: 0px;
        }
        .event-list > li > .social > ul > li > a {
        padding: 3px 0px;
        }
        .event-list > li > .info > ul > li:hover,
        .event-list > li > .social > ul > li:hover {
        color: rgb(30, 30, 30);
        background-color: rgb(200, 200, 200);
        }
        .facebook a,
        .twitter a,
        .google-plus a {
        display: block;
        width: 100%;
        color: rgb(75, 110, 168) !important;
        }
        .twitter a {
        color: rgb(79, 213, 248) !important;
        }
        .google-plus a {
        color: rgb(221, 75, 57) !important;
        }
        .facebook:hover a {
        color: rgb(255, 255, 255) !important;
        background-color: rgb(75, 110, 168) !important;
        }
        .twitter:hover a {
        color: rgb(255, 255, 255) !important;
        background-color: rgb(79, 213, 248) !important;
        }
        .google-plus:hover a {
        color: rgb(255, 255, 255) !important;
        background-color: rgb(221, 75, 57) !important;
        }

        @media (min-width: 768px) {
        .event-list > li {
            position: relative;
            display: block;
            width: 100%;
            height: 120px;
            padding: 0px;
        }
        .event-list > li > time,
        .event-list > li > img  {
            display: inline-block;
        }
        .event-list > li > time,
        .event-list > li > img {
            width: 120px;
            float: left;
        }
        .event-list > li > .info {
            background-color: rgb(245, 245, 245);
            overflow: hidden;
        }
        .event-list > li > time,
        .event-list > li > img {
            width: 120px;
            height: 120px;
            padding: 0px;
            margin: 0px;
        }
        .event-list > li > .info {
            position: relative;
            height: 120px;
            text-align: left;
            padding-right: 40px;
        }
        .event-list > li > .info > .title,
        .event-list > li > .info > .desc {
            padding: 0px 10px;
        }
        .event-list > li > .info > ul {
            position: absolute;
            left: 0px;
            bottom: 0px;
        }
        .event-list > li > .social {
            position: absolute;
            top: 0px;
            right: 0px;
            display: block;
            width: 40px;
        }
        .event-list > li > .social > ul {
            border-left: 1px solid rgb(230, 230, 230);
        }
        .event-list > li > .social > ul > li {
            display: block;
            padding: 0px;
        }
        .event-list > li > .social > ul > li > a {
            display: block;
            width: 40px;
            padding: 10px 0px 9px;
        }
        }
        .col-sm-12
{
    background-color: rgb(255, 255, 255);
    box-shadow: 0px 0px 5px rgb(51, 51, 51);
    box-shadow: 0px 0px 5px rgba(51, 51, 51, 0.7);
    padding: 0px;
    margin: 0px 0px 20px;
}

            </style>




        <div class="card-body">

  <div class="section col-sm-12">
        <div class="">
                <h3 class="btn btn-primary">Recapitulatif Annuel</h3>
                <hr>
                <div class="panel-body">
                        <div class="section col-sm-6" >
                                <h4>
                                      Total previsions annuelles : {{ number_format($montantTotalPrevionAnnuelle,2, ',', ' ') }} F
                                </h4><br>
                                <h4>
                                      Total realisation annuelles : {{  number_format($montantTotalRealisationAnnuelle,2, ',', ' ') }} F
                                </h4><br>
                                @php
                                if($montantTotalPrevionAnnuelle!=0)
                                {
                                  $t= ($montantTotalRealisationAnnuelle/$montantTotalPrevionAnnuelle)*100;
                                  $ecartAnnuel = $montantTotalPrevionAnnuelle -$montantTotalRealisationAnnuelle;
                                }else
                                {
                                  $t=0;
                                }


                                @endphp
                                @if($montantTotalPrevionAnnuelle!=0)
                                <h4>
                                        Ecart Annuel : {{  number_format($ecartAnnuel,2, ',', ' ') }} F
                                </h4><br>
                                <h4>
                                      Taux de realisation annuelle: {{ number_format($t,2, ',', ' ') }} %
                                </h4>

                                <input type="hidden" value="{{ $t }}" id='tauxAnnuel'>
                                @endif
                            </div>

                            <div class="section col-sm-6" style=" display:inline-block; width:450px; float:right">
                                  <canvas id="pie-chart-annuelle" width="1000" height="750"></canvas>
                            </div>
                </div>
              </div>
    </div>





    <div class="section col-sm-12">
        <div class="">

                  <h3 class="btn btn-primary">Recapitulatif mensuel</h3>
                  <hr>
                <div class="panel-body">
                        @php
                        if($montantTotalPrevionAnnuelle!=0)
                        {
                            $tm =($montantTotalRealisationMensuel/($montantTotalPrevionAnnuelle/12))*100;
                        }else
                        {
                            $tm = 0;
                        }
                        $ecartMens = ($montantTotalPrevionAnnuelle/12) - $montantTotalRealisationMensuel;

                    @endphp
                        <div class="section col-sm-6"  >
                            <h4>
                                  Total previsions mensuelle : {{ number_format($montantTotalPrevionAnnuelle/12,2, ',', ' ') }} F
                            </h4><br>
                            <h4>
                                  Total realisation mensuelle : {{ number_format($montantTotalRealisationMensuel,2, ',', ' ') }} F
                            </h4><br>
                            <h4>
                                Ecart mensuel : {{ number_format($ecartMens,2, ',', ' ') }} F
                             </h4><br>
                            <h4>
                                  Taux de realisation mensuel : {{ number_format($tm,2, ',', ' ') }} %
                            </h4>

                            <input type="hidden" value="{{ $tm }}" id="tauxmensuel">
                        </div>
                        <div class="section col-sm-6" >
                                <canvas id="pie-chart-mensuel" width="1000" height="750"></canvas>
                        </div>

                </div>
        </div>
    </div>


        <div class="section col-sm-12">
            <canvas id="bar-chart-horizontal" width="800" height="450"></canvas>
            <input type="hidden" value="test">
            <input type="hidden" id="valeurDataAnnuell" value='{{ json_encode($tabReaAnnuel) }}'>
        </div>
        <div class="section col-sm-12">
                <div>
                    <h3 class="btn btn-danger" >Alert : Post(s) budgetaire en depassement</h3>
                        <hr>
                </div>
            @foreach($post as $item)
                @php
                    $previ = $myFonction->PreviAnnuelPost($item->numCompte ,session('codeExo'));
                    $previMensuelle = ($previ/12);
                    $reaAnnuelle = $myFonction->ReaAnnuelPost($item->numCompte ,session('codeExo'));
                    $debutPeriod = date('Y').'-'.date('m').'-'.'01';
                    $finPeriode =date('Y-m-t', strtotime($debutPeriod));
                    $ecartAnnuel  = $previ -$reaAnnuelle;
                    $realisationMens = $myFonction->MontantReaPostSurPeriodDe(session('codeExo'), $debutPeriod, $finPeriode,$item->numCompte);
                    $ecartMensuel = $previMensuelle - $realisationMens;
                    if($previ!=0)
                    {
                        $tauxAnnuel = ($reaAnnuelle/$previ)*100;
                    }
                    if($previMensuelle!=0)
                    {
                        $tauxMensuel = ($realisationMens/$previMensuelle)*100;
                    }
                @endphp
                @if($tauxMensuel >=100 and $tauxAnnuel <=100 )
                <button type="button" data-toggle="popover"  class="btn btn-lg btn-warnig" data-placement="top" data-toggle="popover" title="{{ $item->numCompte.' - '.$item->intitulePost }}" data-content="N°compte : {{ $item->numCompte }} Prevision Annuelle: {{ number_format($previ,2, ',', ' ') }} Realisation Annuelle : {{ number_format($reaAnnuelle,2, ',', ' ') }} Ecart Annuel : {{ number_format($ecartAnnuel,2, ',', ' ') }}  Taux Annuel : {{ number_format($tauxAnnuel,2, ',', ' ') }}% Prevision Mensuelle : {{ number_format($previMensuelle,2, ',', ' ') }} Realisation Mensuelle : {{ number_format($realisationMens,2, ',', ' ')  }} Ecart Mensuelle : {{ number_format($ecartMensuel,2, ',', ' ')}} Taux Mensuelle : {{ number_format($tauxMensuel,2, ',', ' ') }} % "> {{ $item->intitulePost }} </button>
                @elseif(($tauxMensuel <100 and $tauxAnnuel>100) or ($tauxMensuel >100 and $tauxAnnuel>100))
                    <button type="button" data-toggle="popover"  class="btn btn-lg btn-danger" data-placement="top" data-toggle="popover" title="{{ $item->numCompte.' - '.$item->intitulePost }}" data-content="N°compte : {{ $item->numCompte }} Prevision Annuelle: {{ number_format($previ,2, ',', ' ') }} Realisation Annuelle : {{ number_format($reaAnnuelle,2, ',', ' ') }} Ecart Annuel : {{ number_format($ecartAnnuel,2, ',', ' ') }}  Taux Annuel : {{ number_format($tauxAnnuel,2, ',', ' ') }}% Prevision Mensuelle : {{ number_format($previMensuelle,2, ',', ' ') }} Realisation Mensuelle : {{ number_format($realisationMens,2, ',', ' ')  }} Ecart Mensuelle : {{ number_format($ecartMensuel,2, ',', ' ')}} Taux Mensuelle : {{ number_format($tauxMensuel,2, ',', ' ') }} % "> {{ $item->intitulePost }} </button>
                @endif

            @endforeach
            <br><br>
        </div>
    </div>
</div>
<script>
        $(document).ready(function(){
            $('[data-toggle="popover"]').popover();
        });
</script>


<script src="../../assets/chart-js/jquery-2.1.4.min.js"></script>
<script src="../../js/jquery.dataTables.js"></script>
<script src="../../js/dataTables.bootstrap.js"></script>
<script src="../../assets/chart-js/Chart.bundle.js"></script>
<script src="../../assets/chart-js/chartjs-Acceuil.js"></script>
<script src="../../assets/chart-js/pieflot.js"></script>


@stop
