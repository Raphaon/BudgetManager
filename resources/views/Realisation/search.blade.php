@inject('myFonction', 'App\myFonction')
@extends("layouts/template", [
    $title = "Voucher",
    $sb_title = "recherche -Realidation"
])
@section('content_block')

    <div class="container">
        <div class="text-center col-sm-12">
            <form action="/realisation/search" method="post" class="col-sm-12" style=" display:inline-block;">
              {{ csrf_field() }}
                <fieldset>
                    <legend>Critère de Recherche</legend>
                    <div class="form-group col-sm-9" style=" display:inline-block">
                            <label class="control-label col-sm-1">Du:</label>
                            <div class="col-sm-5">
                                <input type="date" class="form-control" name="periodDebut" required>
                                <p class="erros text-center alert alert-danger hidden"></p>
                            </div>
                    </div>
                    <div class="form-group col-sm-9" style=" display:inline-block">
                            <label class="control-label col-sm-1">Au :</label>
                            <div class="col-sm-5">
                                <input type="date" class="form-control" name="periodFin"  required>
                                <p class="erros text-center alert alert-danger hidden"></p>
                            </div>

                    </div>


                    <div class="form-group col-sm-9" style=" display:inline-block">
                            <label class="control-label col-sm-1">Post</label>
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
                    <div onclick="window.open('{{ route('SearchPrintPdf') }}')" class="btn btn-primary">Imprimer</div>
                </fieldset>


            </form>
        </div>
            <div class="col-xs-12">
                <caption>
                    <h3>
                        @if (isset($debut) and isset($fin))
                            Mouvement de la periode du : {{ $debut }} Au {{ $fin }}
                        @endif
                    </h3>

                </caption>
                    <table class="table table-striped table-bordered" id='dataTables' cellspacing='0' width="100%">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th> Refference </th>
                                    <th> N°Compte </th>
                                    <th> Libelle </th>
                                    <th> Montant Sortie</th>
                                    <th>Observation </th>
                                    <th>Effectuer par </th>
                                    <th>Autorise par</th>
                                    <th>Date </th>
                                    <th>
                                       #
                                    </th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>N°</th>
                                    <th> Refference </th>
                                    <th> N°Compte </th>
                                    <th> Libelle </th>
                                    <th> Montant Sortie</th>
                                    <th>Observation </th>
                                    <th>Effectuer par </th>
                                    <th>Autorise par</th>
                                    <th>Date </th>
                                    <th>
                                       #
                                    </th>
                                </tr>
                            </tfoot>
                            <tbody id="bodytable">
                                <?php $no =1; $totalMontant =0;?>

                                @foreach ($realisation as $key=>$value )
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $value->refferenceRea }}</td>
                                        <td>{{ $value->numCompte }}</td>
                                        <td>{{ $value->intitulePost }}</td>
                                        <td><?php $totalMontant += $value->montantRea;?>  {{  number_format($value->montantRea,2, ',', ' ')   }}</td>
                                        <td>{{ $value->observationRea }}</td>
                                        <td>{{ $myFonction->getEmployee($value->effectuer_par)->nomEmp }}</td>
                                        <td>{{ $myFonction->getEmployee($value->autorise_par)->nomEmp  }}</td>
                                        <td>{{ $value->dateRea }}</td>
                                        <td>
                                            <a class="show-modal btn btn-success" href="view/{{ $value->refferenceRea }}">
                                                <i class="glyphicon glyphicon-eye-open"></i>
                                            </a>
                                            <a class="edit-modal btn btn-warning" href="view/{{ $value->refferenceRea }}">
                                                <i class="glyphicon glyphicon-pencil"></i>
                                            </a>
                                            <a class="delete-modal delete-modal-Ag btn btn-danger" href="view/{{ $value->refferenceRea }}">
                                                <i class="glyphicon glyphicon-trash" alt="supprimer"></i>
                                            </a>
                                        </td>
                                    </tr>

                                @endforeach

                            </tbody>
                        </table>
            </div>
        </div>

    </div>
<span class="alert alert-info" style="text-align:center; display:block;">
   Montant Total realisations : {{ number_format( $totalMontant ,2, ',', ' ') }} FcFA
</span>




    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="../js/jquery.dataTables.js"></script>
    <script src="../js/dataTables.bootstrap.js"></script>
    <script src="../js/scriptCategorie.js"></script>
@endsection
