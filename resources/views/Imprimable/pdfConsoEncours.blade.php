@inject('myFonction', 'App\myFonction')
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
</head>
<header style="text-align:center">
    @php
        $agence =$myFonction->getBranch(session("BranchCode"));
 @endphp
    <h1>People Finance / {{$agence->nomAg}} </h1>
    <h3 style="text-align: center;">Exercice  : {{ session('anneeExo') }}</h3>
</header>
<hr>
<div class="container">
            <h6>Imprimé le  : {{ date('Y-m-d') }} A {{ date('H-i-s') }}</h6>
            <table class="table table-striped" border="1" style="width:100%">
                    <caption><h2 style="text-align:center ; color:black">Consolidé de consommation Budgetaire Du 01-01-{{ session('anneeExo') }} Au {{ date('d').'-'.date('m').'-'.date('Y')}}</h2></caption>
                    <thead>
                      <tr>
                        <th scope="col">N°</th>
                        <th scope="col">N°Compte</th>
                        <th scope="col">Libelle</th>
                        <th scope="col">Prevision</th>
                        <th scope="col">Consommation</th>
                        <th scope="col" width="80">Ecart</th>
                        <th scope="col">Pourcentage</th>
                      </tr>
                    </thead>
                    <tbody>
                        @php
                            $i =1;
                            $ttPrevi = 0;
                            $ttRea = 0;
                            $ttreliq = 0;
                            $ttTaux =0;
                        @endphp
                        @foreach ($post as $p)
                        @php
                                $previ = $myFonction->PreviAnnuelPost($p->numCompte ,session('codeExo'));
                                $ttPrevi = $ttPrevi + $previ;
                            @endphp
                             @php
                                $rea = $myFonction->ReaAnnuelPost($p->numCompte ,session('codeExo'));
                                $ttRea  = $ttRea + $rea;
                            @endphp
                        @if(($rea/$previ)*100>100) 
                                <tr style="background: silver">
                            @else
                            <tr>
                                
                            @endif
                            <th scope="row">{{ $i++  }}</th>
                            <td>{{ $p->numCompte }}</td>
                            <td>{{ $p->intitulePost }}</td>
                            
                            <td>{{ number_format($previ,2, ',', ' ')  }}</td>
                           
                            <td>{{ number_format($rea,2, ',', ' ') }}</td>
                            @php
                               $r =$previ - $rea;
                               $ttreliq= $ttreliq +$r;
                            @endphp
                            <td>{{ number_format($r,2, ',', ' ')  }}</td>
                            @php
                               $ttTaux = $ttTaux + (($rea/$previ)*100);
                            @endphp
                            <td>{{ number_format(($rea/$previ)*100,2, ',', ' ') }} %</td>
                        </tr>
                        @endforeach
                        <th>
                            @php
                            if($ttPrevi!=0){
                            $ttTaux = ($ttRea/$ttPrevi)* 100;
                        }
                            
                        @endphp
                            <td colspan="2"> <b>Total :</b></td>
                            <td> <b>{{ number_format($ttPrevi,2, ',', ' ') }}</b> </td>
                            <td><b>{{ number_format($ttRea,2, ',', ' ') }}</b></td>
                            <td><b>{{ number_format($ttreliq,2, ',', ' ') }}</b></td>
                            <td><b> {{  number_format($ttTaux,2, ',', ' ') }} %</b></td>
                        </th>
                    </tbody>
                  </table>
    </div>
