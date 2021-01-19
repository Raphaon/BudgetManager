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
    <h1> {{ "CMN // ".$agence->nomAg }} </h1>
</header>
<hr>
    <div class="container" >
            <table class="table table-striped" border="1">
                    <caption><h2>Mouvement de la periode Du  {{ $debut }} Au {{ $fin}} Compte : @if($lePost=='Tous')
                    {{ $lePost }}
                    @else
                        @php
                        if($lePost!=null){
                         $nomPost =  $myFonction->getPost($lePost);

                        $nomPost = $nomPost->first();
                        echo  $nomPost->intitulePost;
                         }

                        @endphp

                    @endif
                    </h2> </caption>
                    <thead>
                      <tr>
                        <th scope="col">N°</th>
                        <th scope="col">Refference</th>
                        <th scope="col">N°Compte</th>
                        <th scope="col">Libelle</th>
                        <th scope="col">Montant</th>
                        <th width="130">Observation</th>
                        <th scope="col">Date</th>
                        <th scope="col">Employe</th>
                        <th scope="col">Vise Par</th>
                      </tr>
                    </thead>
                    <tbody>
                        @php
                            $i =1;
                            $ttRea = 0;
                            $ttreliq = 0;
                            $ttTaux =0;

                        @endphp
                    @if($mouvement!=null){

                     @if($mouvement->count()>0)

                        @foreach ($mouvement as $p)
                        <tr>
                            <th scope="row">{{ $i++  }}</th>
                            <td>{{ $p->refferenceRea }}</td>
                            <td>{{ $p->codePostBudgetaire }}</td>
                            <td>{{ $p->intitulePost }}</td>
                            <td>{{ number_format($p->montantRea,2, ',', ' ')   }}</td>
                            <td>{{ $p->observationRea }}</td>
                            <td>{{ $p->dateRea }}</td>
                            <td>{{ $myFonction->getEmployee($p->effectuer_par)->nomEmp }}</td>
                            <td>{{ $myFonction->getEmployee($p->autorise_par)->nomEmp  }}</td>
                            @php
                               $ttRea = $ttRea +$p->montantRea;
                            @endphp
                        </tr>
                        @endforeach
                     @else
                        Auccune operations cette periode
                    @endif
                    @endif
                        <th>
                            <strong>


                            </strong>
                            <td colspan="3"> <b>Total :</b></td>
                            <td><b>{{ number_format($ttRea,2, ',', ' ') }}</b></td>
                            <td><b> </b></td>
                        </th>
                    </tbody>
                  </table>
    </div>
