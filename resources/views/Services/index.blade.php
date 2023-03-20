@inject('myFonction', 'App\myFonction')
@extends("layouts/Main", [
    $title = "VC BM",
    $sb_title = "Gestion des services"
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
                    <i class="fas fa-plus"></i>  Créer un service 
                </button></h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>N°</th>
                <th>Code Service</th>
                <th>Nom</th>
                <th>Abrevaition </th>
              
                
                <th>#</th>
              </tr>
              </thead>
              <tbody>
            @php
                $id = 1;
            @endphp
            @foreach ($services as $key=>$service )
              
              <tr>
                <td>{{ $id }}</td>
                <td>{{$service->serviceCode}}</td>
                <td>{{$service->serviceName}}</td>
                <td>{{$service->serviceAbreviation}}</td>
            
                
                <td> 
                    <a href="{{ route('show_user', ['slug'=>$service->id]) }}" class="btn btn-secondary"> <i class="fas fa-eye"></i></a>
                    <a href="{{ route('edit_user', ['slug'=>$service->id]) }}" class="btn btn-primary"> <i class="fas fa-pencil-alt"></i></a>
                    <a href="{{ route('delete_user', ['slug'=>$service->id]) }}" class="btn btn-danger"> <i class="fas fa-trash-alt"></i></a>
                    <a href="{{ route('takeparameter', ['slug'=>$service->id]) }}" class="btn btn-success"> <i class="fas fa fa-user-md"></i></a>
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
                <th>Code Service</th>
                <th>Nom</th>
                <th>Abrevaition </th>
              
                
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
          <h4 class="modal-title">Creation d'un nouveau service</h4>
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
                        <label for="name">Code Service</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Name">
                      </div>

                      <div class="form-group">
                        <label for="surname">Nom du service  </label>
                        <input type="text" class="form-control" id="surname" name="surname" placeholder="Prenom">
                      </div>

                      
                     


                      

                  

                      <div class="form-group">
                        <label for="profession">Abrevaition </label>
                        <input type="text" class="form-control" id="profession" name="profession" placeholder="Profession">
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
















