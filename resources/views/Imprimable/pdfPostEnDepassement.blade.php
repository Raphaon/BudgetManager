@inject('myFonction', 'App\myFonction')

@php
    $agence =$myFonction->getBranch(session("BranchCode"));
@endphp
<h1 style="text-align: center;">People Finance  /  {{ $agence->nomAg }}</h1>

<h3 style="float:  left;">
    Code Exercice : {{ session('codeExo') }} <br><br> 
    Exercice : {{date('Y')}}
 </h3>
<h6 style="float: right;">Imprimé le : {{ date('d-M-Y') }}  A {{ date('H:i:s')}}</h6>
  <br><br>
<h3>Liste des posts Budgetaire en depassement
                        @if(isset($period) and !empty($period))
                        {{ $period }}
                        @else
                            du 01-01-{{ date('Y') }}  Au {{ date('Y').'-'.date('m').'-'.date('d') }}
                        @endif</h3>
                        <hr><br><br>


<style type="text/css">
    td
    {
        font-size: 12px;
    }
</style>
    <table class="table table-striped" border="1">
                    <thead>
                      <tr>
                        <th width="15">N°</th>
                        <th scope="col" width="60">N°Compte</th>
                        <th scope="col" width="150">Libelle</th>
                        <th scope="col" width="60">Prevision</th>
                        <th scope="col" width="60">Consommation</th>
                        <th scope="col"width="60">Reliquat</th>
                        <th scope="col" width="60">Pourcentage</th>
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
                        @foreach($post as $po)
                            @php
                                $previ = $myFonction->PreviAnnuelPost($po->numCompte ,session('codeExo'));
                                    $previ = ($previ/12)*date('m');
                                    $rea = $myFonction->ReaAnnuelPost($po->numCompte ,session('codeExo'));
                                    $tauxrea = $rea/$previ*100;
                                    
                            @endphp
                        @if($tauxrea>100)
                            @if($i%2==0)
                                <tr style="background: silver;">
                            @else
                                <tr>
                            @endif
                                    @php
                                        $r =$previ - $rea;
                                        $ttRea  = $ttRea + $rea;
                                        $ttPrevi = $ttPrevi + $previ;
                                        $ttreliq= $ttreliq +$r;

                                        if($previ != 0)
                                        {
                                            $ttTaux = $ttTaux + (($rea/$previ)*100);
                                        }else
                                        {
                                            dd($previ);
                                        }
                                    @endphp
                                <td>{{ $i++}}</td>
                                <td>{{ $po->numCompte }}</td>
                                <td>{{ $po->intitulePost }}</td>
                                <td>{{ number_format($previ,2, ',', ' ')  }}</td>
                                <td>{{ number_format($rea,2, ',', ' ') }}</td>
                                <td>{{ number_format($r,2, ',', ' ')  }}</td>
                                <td>{{ number_format(($rea/$previ)*100,2, ',', ' ') }} %</td>
                            </tr>
                              @endif
                        @endforeach

                    </tbody>
                  </table>

