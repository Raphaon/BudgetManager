@inject('myFonction', 'App\myFonction')
@extends("layouts/Main", [
    $title = "VC BM",
    $sb_title = "Gestion des utilisateurs"
])
@section('container')





  <div class="container-fluid">

    <div class="row">
      <div class="col-12">
        
        <!-- /.card -->

        <div class="card">
          <div class="card-header">
            <h3 class="card-title"> <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-lg">
                <i class="fas fa-plus"></i>  Ajouter un Utilisateur
            </button></h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>N°</th>
                <th>User name</th>
                <th>Login</th>
                <th>Groupe</th>
                <th>#</th>
              </tr>
              </thead>
              <tbody>
            @php
                $id = 1;
            @endphp
            @foreach ($users as $key=>$user )
              
              <tr>
                <td>{{ $id }}</td>
                <td>{{$user->users_name}}</td>
                <td>{{ $user->login }}</td>
                <th>{{ $user->nom }}</th>
                <td> 
                    <a href="{{ route('show_user', ['slug'=>$user->user_id]) }}" class="btn btn-secondary"> <i class="fas fa-eye"></i></a>
                    <a href="{{ route('edit_user', ['slug'=>$user->user_id]) }}" class="btn btn-primary"> <i class="fas fa-pencil-alt"></i></a>
                    <a href="{{ route('delete_user', ['slug'=>$user->user_id]) }}" class="btn btn-danger"> <i class="fas fa-trash-alt"></i></a>
                </td>
          
              </tr>
              @php
                    $id ++;
                @endphp
              @endforeach
              
              </tbody>
              <tfoot>
              <tr>
                <th>N°</th>
                <th>User name</th>
                <th>Login</th>
                <th>Groupe</th>
                <th>#</th>
              
              </tr>
              </tfoot>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
  


  


  






  <div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <!-- form start -->
         <form method="POST" action="{{ route('new_user') }}">
            {{ csrf_field() }}
        <div class="modal-header">
          <h4 class="modal-title">Ajouter un utilisateur </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">


        
                <!-- general form elements -->
                <div class="card card-primary">
                
                  <!-- /.card-header -->
                 
                    <div class="card-body">
                      <div class="form-group">
                        <label for="FullName">Full Name </label>
                        <input type="text" class="form-control" name="fullName" id="FullName" placeholder="Enter The Full Name">
                      </div>
                      <div class="form-group">
                        <label for="login">Login </label>
                        <input type="email" class="form-control" id="login" name="login" placeholder="login or Enter email">
                      </div>

                      
                      <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                      </div>


                      <div class="form-group">
                        <label for="cpassword">Confirm Password</label>
                        <input type="password" name="cpassword" class="form-control" id="cpassword" placeholder="confirm Password">
                      </div>

                      <div class="form-group">
                        <label for="exampleSelectBorder">Question ?</label>
                        <select name="question" class=" form-control" id="exampleSelectBorder">
                            <option>Selectionner une question </option>
                          <option>Quel est le prenom de votre cousin le plus agé ? </option>
                          <option>Quel est votre livre préféré ?</option>
                          <option>Quelle est votre ville de naissance ?</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label for="reponse">Reponse </label>
                        <input type="text" class="form-control" id="reponse" name="reponse" placeholder="Enter the answer">
                      </div>


                   
                    
                    </div>
                
    
                 
                </div>

        </div>


        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">
            Enregistrer
          </button>
        </div>
      </div>
    </form>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  
 








@endsection
















