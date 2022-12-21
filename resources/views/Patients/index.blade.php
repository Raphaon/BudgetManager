@inject('myFonction', 'App\myFonction')
@extends("layouts/Main", [
    $title = "VC BM",
    $sb_title = "Liste des patients"
])
@section('container')





  <div class="container-fluid">

    <div class="row">
      <div class="col-12">
        
        <!-- /.card -->

        <div class="card">
          <div class="card-header">
            <h3 class="card-title"> 
                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-lg">
                    <i class="fas fa-plus"></i>  Nouveau Patient 
                </button></h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>N°</th>
                <th>Matricule</th>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Date de Naissance</th>
                <th>Sexe</th>
                <th>Telephone</th>
                <th>Profession</th>
                <th>ICE Name</th>
                <th>ICE Contact</th>
                
                <th>#</th>
              </tr>
              </thead>
              <tbody>
            @php
                $id = 1;
            @endphp
            @foreach ($patients as $key=>$patient )
              
              <tr>
                <td>{{ $id }}</td>
                <td>{{$patient->patient_matricule}}</td>
                <td>{{ $patient->patient_name }}</td>
                <th>{{ $patient->patient_surname }}</th>
                <th>{{ $patient->patient_dateNaiss }}</th>
                <th>{{ $patient->patient_gender }}</th>
                <th>{{ $patient->patient_phone }}</th>
                <th>{{ $patient->patient_profession }}</th>
                <th>{{ $patient->patient_ice_name }}</th>
                <th>{{ $patient->patient_ice_phone }}</th>
                
                <td> 
                    <a href="{{ route('show_user', ['slug'=>$patient->user_id]) }}" class="btn btn-secondary"> <i class="fas fa-eye"></i></a>
                    <a href="{{ route('edit_user', ['slug'=>$patient->user_id]) }}" class="btn btn-primary"> <i class="fas fa-pencil-alt"></i></a>
                    <a href="{{ route('delete_user', ['slug'=>$patient->user_id]) }}" class="btn btn-danger"> <i class="fas fa-trash-alt"></i></a>
                    <a href="{{ route('takeparameter', ['slug'=>$patient->patient_matricule]) }}" class="btn btn-success"> <i class="fas fa fa-user-md"></i></a>
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
                <th>Matricule</th>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Date de Naissance</th>
                <th>Sexe</th>
                <th>Telephone</th>
                <th>Profession</th>
                <th>ICE Name</th>
                <th>ICE profession</th>
                
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
         <form method="POST" action="{{ route('savePatient') }}">
            {{ csrf_field() }}
        <div class="modal-header">
          <h4 class="modal-title">Nouveau Patient </h4>
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
                        <label for="name">Nom </label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Name">
                      </div>

                      <div class="form-group">
                        <label for="surname">Prenom </label>
                        <input type="text" class="form-control" id="surname" name="surname" placeholder="Prenom">
                      </div>

                      
                      <div class="form-group">
                        <label for="dateOfBirth">Date de naissance </label>
                        <input type="date" class="form-control" name="dateOfBirth" id="dateOfBirth" >
                      </div>


                      <div class="form-group">
                        <label for="phone">Telephone</label>
                        <input type="tel" name="phone" class="form-control" id="phone" placeholder="Telephone">
                      </div>

                      <div class="form-group">
                        <label for="exampleSelectBorder">Sexe ?</label>
                        <select name="gender" class=" form-control" id="exampleSelectBorder">
                            <option value="">Selectionner le sexe</option>
                          <option value="M">  Masculin </option>
                          <option value="F"> Feminin </option>
                    
                        </select>
                      </div>

                      <div class="form-group">
                        <label for="profession">Profession </label>
                        <input type="text" class="form-control" id="profession" name="profession" placeholder="Profession">
                      </div>

                      <div class="form-group">
                        <label for="email">Email </label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                      </div>



                      <div class="form-group">
                        <label for="quarter">Quartier </label>
                        <input type="text" class="form-control" id="quarter" name="quarter" placeholder="Quartier ">
                      </div>

                      <div class="form-group">
                        <label for="loisirs">Loisirs </label>
                        <input type="text" class="form-control" id="loisirs" name="hobbies" placeholder="loisirs">
                      </div>

                      <div class="form-group">
                        <label for="ICENAME">Nom contact personne en cas de Besoin  </label>
                        <input type="text" class="form-control" id="ICENAME" name=icename" placeholder="ICE NAME">
                      </div>
                   
                      <div class="form-group">
                        <label for="ICEPHONE">Telephone contact Personne en cas de besoin  </label>
                        <input type="text" class="form-control" id="ICEPHONE" name="icephone" placeholder="ICE PHONE">
                      </div>
                    

                      <div class="form-group">
                        <label for="picture">Photo   </label>
                        <input type="file" class="form-control" id="picture" name="picture" >
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
















