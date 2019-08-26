@inject('myFonction', 'App\myFonction')

@php
$tab_mois = array('Janvier', 'Fevrier', 'Mars','Avril','Mai','juin','juillet','Août','Septembre','Octobre','Novembre','Decembre')
@endphp
@extends("layouts/template", [
    $title = "BusinessScan",
    $sb_title = "Historique-Consommation"
])

@section('content_block')
    <div class="container">

            <form action="/realisation/search" method="post" class="col-sm-12" style=" display:inline-block;">
                {{ csrf_field() }}
                  <fieldset>
                      <legend>Critère de Recherche</legend>



                      <div class="form-group col-sm-9" style=" display:inline-block">
                            <label class="control-label col-sm-2">Exercice :</label>
                            <div class="col-sm-5">
                                    <select name="postbudgetaire" class="form-control" >
                                            @php
                                                $post =$myFonction->listPostAyantPrevi();
                                            @endphp
                                            <option value="*">Toute les operations</option>
                                            @foreach ($post as $p)
                                                 <option value="{{ $p->numCompte }}"> {{ $p->intitulePost }}</option>
                                            @endforeach

                                          </select>
                            </div>


                    </div>
                    <a class="btn btn-primary" href="{{ route('statistiqueParmoisPDF')}}">Imprimer</a>


                      <div class="form-group col-sm-9" style=" display:inline-block">
                              <label class="control-label col-sm-2">Post</label>
                              <div class="col-sm-5">
                                    <select name="postbudgetaire" class="form-control" >
                                        @php
                                            $post =$myFonction->listPostAyantPrevi();
                                        @endphp
                                        <option value="*">Toute les operations</option>
                                        @foreach ($post as $p)
                                           <option value="{{ $p->numCompte }}"> {{ $p->intitulePost }}</option>
                                        @endforeach

                                     </select>
                              </div>

                      </div>



                      <button type="submit" class="btn btn-primary"> <i class="glyphicon glyphicon-search">  </i>   </button>

                  </fieldset>


              </form>


        <table class="table table-striped">
                    <caption><h3>Statistique de Consommation budgetaire 01 JAN -  Au {{ date('d').'-'.date('M')}}</h3>
                    <br> NB : Prevision par mois  = Prevision annuel / 12</caption>
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
                        <tr>
                            @php
                                $dateDebut = date('Y').'-'.$s.'-01';
                                $dateFin = date('Y-m-t', strtotime($dateDebut));
                            @endphp
                            <td>{{ $tab_mois[$s-1] }}</td>
                            @php
                            $totalPrevi = $myFonction->TotalPreviAnnuel(session('codeExo'))/12;
                            $ttPrevi = $ttPrevi + $totalPrevi;
                            $totalrea = $myFonction->MontantReaGlobalSurPeriodDe(session('codeExo'), $dateDebut, $dateFin);
                            $ttRea = $ttRea + $totalrea;
                            $ecart = $totalPrevi - $totalrea;
                            $ttreliq =$ttreliq + $ecart;
                            @endphp
                            <td>{{  number_format($totalPrevi,2, ',', ' ')  }}</td>
                            <td>{{  number_format($totalrea,2, ',', ' ') }}</td>
                            <td>{{  number_format($ecart,2, ',', ' ') }}</td>
                            @php
                            $taux =0;
                            if($totalPrevi!=0){
                              $taux = ($totalrea/$totalPrevi)*100;
                            }

                            @endphp
                            <td>{{  number_format($taux,2, ',', ' ') }}</td>
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
    </div>


    <div id="accordion">
            <div class="card">
              <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                  <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Collapsible Group Item #1
                  </button>
                </h5>
              </div>

              <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">
                  Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven t heard of them accusamus labore sustainable VHS.
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header" id="headingTwo">
                <h5 class="mb-0">
                  <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Collapsible Group Item #2
                  </button>
                </h5>
              </div>
              <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                <div class="card-body">
                  Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven t heard of them accusamus labore sustainable VHS.
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header" id="headingThree">
                <h5 class="mb-0">
                  <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Collapsible Group Item #3
                  </button>
                </h5>
              </div>
              <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                <div class="card-body">
                  Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven t heard of them accusamus labore sustainable VHS.
                </div>
              </div>
            </div>
          </div>

          <p>
                <a class="btn btn-primary" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Toggle first element</a>
                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#multiCollapseExample2" aria-expanded="false" aria-controls="multiCollapseExample2">Toggle second element</button>
                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target=".multi-collapse" aria-expanded="false" aria-controls="multiCollapseExample1 multiCollapseExample2">Toggle both elements</button>
              </p>
              <div class="row">
                <div class="col">
                  <div class="collapse multi-collapse" id="multiCollapseExample1">
                    <div class="card card-body">
                      Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
                    </div>
                  </div>
                </div>
                <div class="col">
                  <div class="collapse multi-collapse" id="multiCollapseExample2">
                    <div class="card card-body">
                      Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
                    </div>
                  </div>
                </div>
              </div>
    @endsection
