@inject('myFonction', 'App\myFonction')
@extends("layouts/Main", [
    $title = "VC BM",
    $sb_title = "Type de Produit"
])
@section('container')





  <div class="container-fluid">

    <div class="row">
      <div class="col-12">
        
        <!-- /.card -->

        <div class="card">
          <div class="card-header">
            <h3 class="card-title"> <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-lg">
                <i class="fas fa-plus"></i>  Ajouter un nouveau type de Produit 
            </button></h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>N°</th>
                <th>CODE PRODUIT</th>
                <th>DESIGNATION </th>
               
                <th>#</th>
              </tr>
              </thead>
              <tbody>
            @php
                $id = 1;
            @endphp
            @foreach ($typeProducts as $key=>$typePro )
              
              <tr>
                <td>{{ $id }}</td>
                <td>{{$typePro->codeType}}</td>
                <td>{{ $typePro->label }}</td>
              
                <td> 
                    <a href="{{ route('show_user', ['slug'=>$typePro->codeType]) }}" class="btn btn-secondary"> <i class="fas fa-eye"></i></a>
                    <a href="{{ route('edit_user', ['slug'=>$typePro->codeType]) }}" class="btn btn-primary"> <i class="fas fa-pencil-alt"></i></a>
                    <a href="{{ route('delete_user', ['slug'=>$typePro->codetype]) }}" class="btn btn-danger"> <i class="fas fa-trash-alt"></i></a>
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
                <th>CODE PRODUIT</th>
                <th>DESIGNATION </th>
               
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
         <form method="POST" action="{{ route('new_typeProduct') }}">
            {{ csrf_field() }}
        <div class="modal-header">
          <h4 class="modal-title">Nouveau Type de Produit  </h4>
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
                        <label for="FullName">Code Type de Produit  </label>
                        <input type="text" class="form-control" name="codeType" id="FullName" placeholder="code type de produit  ">
                      </div>
                      <div class="form-group">
                        <label for="login">Designation </label>
                        <input type="TEXT" class="form-control" id="login" name="label" placeholder="Designation type produit ">
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
















