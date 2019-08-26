

@inject('myFonction', 'App\myFonction')
@php
    $agence =$myFonction->getBranch(session("BranchCode"));
@endphp
<h1 style="text-align: center;">People Finance  /  {{ $agence->nomAg }}</h1>
@php
$tab_mois = array('Janvier', 'Fevrier', 'Mars','Avril','Mai','juin','juillet','Août','Septembre','Octobre','Novembre','Decembre')
@endphp
<h3 style="float:  left;">
	Code Exercice : {{ session('codeExo') }} <br><br> 
	Exercice : {{date('Y')}}
 </h3>
<h6 style="float: right;">Imprimé le : {{ date('d-M-Y') }}  A {{ date('H:i:s')}}</h6>
  <br><br>
<h3>Statistique de Consommation budgetaire 01 JAN -  Au {{ date('d').'-'.date('M')}}</h3>
                    	<hr><br><br>
    
  <table class="table table-striped" border="1" style="text-align: center;">
                    
        <thead>
            <tr>
	            <th >Mois</th>
	            <th >Prevision</th>
	            <th >Realisation</th>
	            <th >Ecart</th>
	            <th >Taux de consommation</th>
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
                        @for($s = 1 ; $s<=date('m'); $s++)
                        <tr >
                            @php
                                $dateDebut = date('Y').'-'.$s.'-01';
                                $dateFin = date('Y-m-t', strtotime($dateDebut));
                            @endphp
                            <td width="150">{{ $tab_mois[$s-1] }}</td>
                            @php
                            $totalPrevi = $myFonction->TotalPreviAnnuel(session('codeExo'))/12;
                            $ttPrevi = $ttPrevi + $totalPrevi;
                            $totalrea = $myFonction->MontantReaGlobalSurPeriodDe(session('codeExo'), $dateDebut, $dateFin);
                            $ttRea = $ttRea + $totalrea;
                            $ecart = $totalPrevi - $totalrea;
                            $ttreliq =$ttreliq + $ecart;
                            @endphp
                            <td width="100">{{  number_format($totalPrevi,2, ',', ' ')  }}</td>
                            <td width="100">{{  number_format($totalrea,2, ',', ' ') }}</td>
                            <td width="200">{{  number_format($ecart,2, ',', ' ') }}</td>
                            @php
                            $taux =0;
                            if($totalPrevi!=0){
                              $taux = ($totalrea/$totalPrevi)*100;
                            }

                            @endphp
                            <td width="200">{{  number_format($taux,2, ',', ' ') }}</td>
                        </tr>
                        @endfor
                        <th>
                            <b>Total</b>
                            <td> <b>{{ number_format($ttPrevi,2, ',', ' ') }}</b> </td>
                            <td><b>{{ number_format($ttRea,2, ',', ' ') }}</b></td>
                            <td><b>{{ number_format($ttreliq,2, ',', ' ') }}</b></td>
                           @php
                              if($ttPrevi!=0)
                              {
                                $ttTaux = ($ttRea/$ttPrevi)*100;
                              }
                           @endphp
                            <td><b> {{  number_format($ttTaux,2, ',', ' ') }} %</b></td>
                        </th>
                    </tbody>
                  </table>
   
