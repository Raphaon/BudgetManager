
@inject('myFonction', 'App\myFonction')
@extends("layouts/template", [
    $title = "BusinessScan",
    $sb_title = "Exercice Encours"
])
@section('content_block')
<div class="content mt-3">
    <div class="animated fadeIn">
        @if($exercice!=null)
        <h5 class="heading-title mb-1 text-secondary">Exercice Budgetaire : {{ $exercice->AnneeExecice }}</h5>
        <br>
        <div class="row">
            <div class="col">
                <section class="card">
                    <div class="card-body text-secondary">code Exercice : {{ $exercice->codeExercice  }}</div>
                </section>
            </div>
            <div class="col">
                <section class="card">
                    <div class="card-body text-secondary">Date de debut : {{ $exercice->dateDebut}}</div>
                </section>
            </div>
            <div class="col">
                <section class="card">
                    <div class="card-body text-secondary">Agence : {{ $exercice->Agence }}</div>
                </section>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <section class="card">
                    <div class="card-body text-secondary">Status de l exercice:  {{ $exercice->statusExo  }}</div>
                </section>
            </div>
            <div class="col">
                <section class="card">
                    <div class="card-body text-secondary">Annee de Exercice : {{ $exercice->AnneeExecice  }}</div>
                </section>
            </div>
            <div class="col">
                <section class="card">
                    <div class="card-body text-secondary">Date de fin : {{ $exercice->dateFin }}</div>
                </section>
            </div>
        </div>
    </div>
</div>
@else
        <h2>Il n y auccun Exerice budgetaire en cours</h2>
@endif
@endsection





