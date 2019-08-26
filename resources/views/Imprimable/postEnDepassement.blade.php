@inject('myFonction', 'App\myFonction')
@extends("layouts/template", [
    $title = "BusinessScan",
    $sb_title = "Historique-Consommation"
])
@section('content_block')
    <div class="container"><br>
        <form action="/enDepassement" method="POST">
            <div class="form-group col-sm-9" style=" display:inline-block">
                {{ csrf_field() }}
                    <label class="control-label col-sm-2">Depassement :</label>
                    <div class="col-sm-5">
                            <select name="period" class="form-control" >
                                <option value="Annuel">Annuel</option>
                                <option value="Mensuel">Mensuel</option>
                                @for ($i = 1 ; $i<=date('m') ; $i++)
                                    <option value="{{ $i }}">{{ $i}}</option>
                                @endfor
                            </select>
                    </div>
                    <input type="submit" class="btn btn-primary" value="Valider">
            </div>
        </form>
        <a href="{{route('postEnDepassementPDF')}}" class="btn btn-default">Imprimer</a>
            <table class="table table-striped">
                    <caption><h2>Liste des posts Budgetaire en depassement
                        @if(isset($period) and !empty($period))
                        {{ $period }}
                        @else
                            du 01-01-{{ date('Y') }}  Au {{ date('Y').'-'.date('m').'-'.date('d') }}
                        @endif </h2></caption>
                    <thead>
                      <tr>
                        <th scope="col">N°</th>
                        <th scope="col">N°Compte</th>
                        <th scope="col">Libelle</th>
                        <th scope="col">Prevision</th>
                        <th scope="col">Consommation</th>
                        <th scope="col">Reliquat</th>
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
                                $previ = ($previ/12)*date('m');
                                $rea = $myFonction->ReaAnnuelPost($p->numCompte ,session('codeExo'));
                        @endphp

                        <tr>
                        @if((($rea/$previ)*100)>100)
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

                            <th scope="row">{{ $i++  }}</th>
                            <td>{{ $p->numCompte }}</td>
                            <td>{{ $p->intitulePost }}</td>
                            <td>{{ number_format($previ,2, ',', ' ')  }}</td>
                            <td>{{ number_format($rea,2, ',', ' ') }}</td>
                            <td>{{ number_format($r,2, ',', ' ')  }}</td>
                            <td>{{ number_format(($rea/$previ)*100,2, ',', ' ') }} %</td>
                        </tr>
                        @endif
                        @endforeach
                        <th>
                            <strong>
                            @php
                            if($ttPrevi!=0){
                                $ttTaux = ($ttRea/$ttPrevi)*100;
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
    @endsection
