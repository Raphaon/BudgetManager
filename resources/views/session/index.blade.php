<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/dataTables.bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <meta name="_token" content="{{ csrf_token() }}">
    <title>Voucher 2.0 : Application de gestion du budget </title>
</head>
<body>



    <style>
        .blockImage
        {
            display : inline-block;
            width: 49%;
            margin:0px;
            height:100%;
            padding:0px;
        }


        .blockLogin
        {
            display : inline-block;
            width: 49%;
            margin:0px;
            height:100%;
            padding:0px;
        }


        .blockLogin img
        {
            margin:0px;
            padding:0px;
            height:100%;
            display : inline-block;
            width: 100%;
        }



        .blockImage img
        {
            margin:0px;
            padding:0px;
            height:100%;
            display : inline-block;
            width: 100%;
        }



            .container
        {
            height:560px;
            margin:0px;
            padding:0px;
            width:100%;
            border:groove;
            display:inline-block;

        }

    </style>

    <div class="container">
        <div class="panel panel-info">
            <div class="panel-heading">
                        <h1 class="panel-title">BudgetFollowUp</h1>
            </div>
            <form action="{{ route('session') }}" method="post" >
                    {{ csrf_field() }}
                <div class="panel-body">
                    <div style="text-align:center"> <h1>Login</h1></div>
                    <div class="col col-sm-7" style="margin-left:20%">
                            <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i> </span>
                                    <input type="text" name="login" class="form-control" required placeholder="Login">
                                </div><br>

                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon" ><i class="glyphicon glyphicon-lock"></i> </span>
                                    <input type="Password" name='passe' required class="form-control" placeholder="Password">
                                </div>
                                <br>
                                <div class="input-group input-group-lg">
                                        <span class="input-group-addon">Agence</span>
                                        <select name="agence" id="" class="form-control" required="true">
                                            <option value="" >Selectionner une Agence</option>
                                          @foreach ($agence as $agc)
                                              <option value="{{ $agc->codeAg }}">{{ $agc->nomAg }}</option>
                                          @endforeach
                                        </select>
                                </div><br>
                                <div class="input-group input-group-lg" style="margin-left:48%">
                                    <input type="submit" class="btn btn-info" value="Login">
                                </div>
                                <br>
                                @if(isset($erreurs) and !empty($erreurs) and $erreurs=="agences")

                                    <div class="alert alert-warning"><i class="glyphicon glyphicon-warning-sign"> </i> Veuillez selectionner une agence !!</div>

                                @elseif($erreurs=="identifiants")
                                    <div class="alert alert-danger"><strong><i class="glyphicon glyphicon-remove"></i> Echec de Connection :</strong>  login ou mot de passe incorrect</div>
                                @endif

                    </div>

                </div>

                <div class="panel-footer" style="text-align:center">
                    Copyrigth Raphaelgloire &copy;
                </div>
            </form>

        </div>


    </div>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/jquery.dataTables.js"></script>
    <script src="js/dataTables.bootstrap.js"></script>
    <script src="js/scriptCategorie.js"></script>
</body>
</html>
