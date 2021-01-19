 <!--div class="container">
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
    <script src="js/scriptCategorie.js"></script-->