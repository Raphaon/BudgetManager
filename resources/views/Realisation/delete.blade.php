<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../css/bootstrap.css">
    <link rel="stylesheet" href="../../css/dataTables.bootstrap.css">
    <link rel="stylesheet" href="../../css/style.css">
    <meta name="_token" content="{{ csrf_token() }}">

    <title>DataTables Realisation</title>
</head>
<body>
    <div class="container">
        <div class="row panel">
            <div class="panel-content">
                <div class="panel-heading">
                    <div class="panel-title">
                      @foreach ($realisation as $values )
                      {{ $values->refferenceRea}}  {{ $values->intitulePost }}
                      @endforeach

                    </div>
                </div>
               <div class="panel-content" style="display:inline-block;  width:100%"><br>
                <div class="panel" style=" width:50%; display:inline-block">
                        @foreach ($realisation as $values )
                            <label for="">Numero de Compte : {{ $values->numCompte }}</label><br><br>
                            <label for="">Intitule : {{ $values->intitulePost }}</label><br><br>
                            <label for="">Montant : {{ $values->montantRea }}</label><br><br>
                            <label for="">Date de realisation : {{ $values->dateRea }}</label><br><br>
                            <label for="">observationRea : {{ $values->observationRea }}</label>
                        @endforeach
                    </div>
                        <div class="panel panel-item" style="width:50% ; float:right; vertical-align:top;">
                                <div class="content mt-3" style=" dispalay:inline-bock">
                                        <div class="animated fadeIn" >
                                            <div class="row" >

                                                    <div class="col-lg-6">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="card card-title"><h4 class="mb-3">Diagramme</h4></div>

                                                                <canvas id="pieChart"></canvas>
                                                            </div>
                                                        </div>
                                                    </div><!-- /# column -->

                                            </div>

                                        </div><!-- .animated -->
                                    </div><!-- .content -->
                        </div>
                </div>




                    </div><!-- /#right-panel -->
               </div>

                <div class="panel-footer">

                </div>
            </div>
        </div>
    </div>
    <div>

       </div>

    <script src="../../js/jquery-3.3.1.min.js"></script>
    <script src="../../assets/chart-js/jquery-2.1.4.min.js"></script>
    <script src="../../js/bootstrap.js"></script>
    <script src="../../js/jquery.dataTables.js"></script>
    <script src="../../js/dataTables.bootstrap.js"></script>
    <script src="../../js/scriptCategorie.js"></script>
    <script src="../../assets/chart-js/Chart.bundle.js"></script>
    <script src="../../assets/chart-js/chartjs-init.js"></script>
</body>
</html>
