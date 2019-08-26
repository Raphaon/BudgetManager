@inject('myFonction', 'App\myFonction')
@extends("layouts/template", [
    $title = "BusinessScan",
    $sb_title = "Exercice Encours"
])
    <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <link rel="stylesheet" href="../../css/bootstrap.css">
            <link rel="stylesheet" href="../../css/dataTables.bootstrap.css">
            <link rel="stylesheet" href="../../css/style.css">
            <meta name="_token" content="{{ csrf_token() }}">
    </head>
    @section('content_block')
    <div class="container">
@php
    $realisation = $realisation->first();

@endphp
    </div>
    <div class="panel panel-default col-xs-5">
            <div class="panel-heading">Modication dune operation</div>
            <div class="panel-body">
                <form action="{{ route('updateRealisation') }}" method="POST" id="formReaUpdate">
                        {{ csrf_field() }}
                    <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1">Reference</span>
                        <input type="text" name="RefferenceSortie" value="{{ $realisation->refferenceRea }}" class="form-control" readonly aria-describedby="basic-addon1">
                    </div> <br>
                    @php
                        $post = $myFonction->listPostAyantPrevi();
                    @endphp
                    <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1">Libelle Post</span>
                        <select name="codePrevisionPost" class="form-control" aria-describedby="basic-addon1">
                            @foreach($post as $p )
                                @if($p->numCompte == $realisation->numCompte)
                                    <option  selected="selected" value="{{$p->idPrevision}}">{{$p->intitulePost}}</option>
                                @else
                                    <option value="{{$p->idPrevision}}">{{$p->intitulePost}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div> <br>
                    <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1">Montant Sortie</span>
                        <input type="number" name="montantSortie" value="{{ $realisation->montantRea }}" min=0 class="form-control" aria-describedby="basic-addon1">
                    </div>
                    <br>
                    <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1">Effectuer le :</span>
                        <input type="date" name="dateRea" value="{{ $realisation->dateRea }}" class="form-control" aria-describedby="basic-addon1">
                    </div> <br>
                    <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1">Observation :</span>
                        <textarea name="observation" class="form-control" value="valider" aria-describedby="basic-addon1" cols="30" rows="3">{{  $realisation->observationRea }}</textarea>
                    </div> <br>
                    @php
                         $listEmploye = $myFonction->listEmploye();
                    @endphp
                    <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1">Effectuer par </span>

                            <select name="effectuer_par" class="form-control" aria-describedby="basic-addon1">
                                @foreach($listEmploye as $employe)
                                    @if($employe->matriculeEmp==$realisation->effectuer_par)
                                    <option selected="selected" value="{{ $employe->matriculeEmp }}">{{ $employe->nomEmp }}</option>
                                    @else
                                        <option value="{{ $employe->matriculeEmp }}">{{ $employe->nomEmp }}</option>
                                    @endif
                                @endforeach
                            </select>

                    </div> <br>
                    <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1">Autorise par :</span>
                        <select name="autorise_par" class="form-control" aria-describedby="basic-addon1">
                                @foreach($listEmploye as $employe)
                                @if($employe->matriculeEmp==$realisation->autorise_par)
                                <option selected="selected" value="{{ $employe->matriculeEmp }}">{{ $employe->nomEmp }}</option>
                                @else
                                    <option value="{{ $employe->matriculeEmp }}">{{ $employe->nomEmp }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div> <br>
                    <div class="btn-group" role="group" aria-label="...">
                        <button type="button" class="btn btn-primary" id="update">Modifier </button>
                        <button type="button" class="btn btn-danger" id="delete">Supprimer</button>
                    </div>
                    <input type="hidden" id="realisationUpgradeAction" name="realisationUpgradeAction">
                </form>
                @if (session()->has('msgUpdateRealisation'))
                <div class="alert alert-success" role="alert" >
                    {{ session('msgUpdateRealisation') }}
                 </div>
                @endif

    </div>


        <script src="../../js/jquery-3.3.1.min.js"></script>
        <script src="../../js/bootstrap.js"></script>
        <script>
            $("#delete").on('click', function(){
                $('#realisationUpgradeAction').val("delete");
                rep = confirm("Voulez Vous Vraiment Supprimer ?");
                if(rep)
                    $('#formReaUpdate').submit();

            });
            $("#update").on('click', function(){
                $('#realisationUpgradeAction').val("update");
                $('#formReaUpdate').submit();
            });
        </script>

    @endsection
