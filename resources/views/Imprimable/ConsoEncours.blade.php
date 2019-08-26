@inject('myFonction', 'App\myFonction')
@extends("layouts/template", [
    $title = "BusinessScan",
    $sb_title = "Recap-Consommation"
])
@section('content_block')
    <div class="container">
        <a class="btn btn-primary" href="javascript:void function test() {
            window.open('{{ route('pdfConsoEncours') }}')
          }()">Imprimer</a>
            <table class="table table-striped">
                    <caption><h1>Consommation Budgetaire Du 01-01-{{ session('anneeExo') }} Au {{ date('d').'-'.date('m').'-'.date('Y')}}</h1></caption>
                    <thead>
                      <tr>
                        <th scope="col">N°</th>
                        <th scope="col">N°Compte</th>
                        <th scope="col">Libelle</th>
                        <th scope="col">Prevision</th>
                        <th scope="col">Consommation</th>
                        <th scope="col">Ecart</th>
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
                            <strong>

                                @php
                                    if($ttPrevi!=0){
                                    $ttTaux = ($ttRea/$ttPrevi)* 100;
                                }
                                    
                                @endphp
                            </strong>
                            <td colspan="2"> <b>Total :</b></td>
                            <td> <b>{{ number_format($ttPrevi,2, ',', ' ') }}</b> </td>
                            <td><b>{{ number_format($ttRea,2, ',', ' ') }}</b></td>
                            <td><b>{{ number_format($ttreliq,2, ',', ' ') }}</b></td>
                            <td><b> {{  number_format($ttTaux,2, ',', ' ') }} %</b></td>
                        </th>
                    </tbody>
                  </table>
    </div>
@endSection
