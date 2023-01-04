@inject('myFonction', 'App\myFonction')
@extends("layouts/Main", [
    $title = "VC BM",
    $sb_title = "Gestion des Produits"
])
@section('container')





  <div class="container-fluid">

    <div class="row">
      <div class="col-12">
        
        <!-- /.card -->

        <div class="card">
          <div class="card-header">
            <h3 class="card-title"> <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-lg">
                <i class="fas fa-plus"></i>  Ajouter un Produit 
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
                <th>PRIX ACHAT </th>
                <th>PRIX VENTE </th>
                <th>MARQUE </th>
                <th>DESCRIPTION </th>
                <th>COULEUR </th>
                <th>TYPE  </th>
                <th>#</th>
              </tr>
              </thead>
              <tbody>
            @php
                $id = 1;
            @endphp
            @foreach ($products as $key=>$produit )
              
              <tr>
                <td>{{ $id }}</td>
                <td>{{$produit->productCode}}</td>
                <td>{{ $produit->Designation }}</td>
                <td>{{$produit->purchasePrice}}</td>
                <td>{{ $produit->sellingPrice }}</td>
                <td>{{$produit->marque}}</td>
                <td>{{ $produit->description    }}</td>
                <td>{{ $produit->color    }}</td>
                <td>{{ $produit->label    }}</td>
                <td> 
                    <a href="{{ route('show_user', ['slug'=>$produit->codeType]) }}" class="btn btn-secondary"> <i class="fas fa-eye"></i></a>
                    <a href="{{ route('edit_user', ['slug'=>$produit->codeType]) }}" class="btn btn-primary"> <i class="fas fa-pencil-alt"></i></a>
                    <a href="{{ route('delete_user', ['slug'=>$produit->codetype]) }}" class="btn btn-danger"> <i class="fas fa-trash-alt"></i></a>
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
                    <th>PRIX A </th>
                    <th>PRIX VENTE </th>
                    <th>MARQUE </th>
                    <th>DESCRIPTION </th>
                    <th>COULEUR </th>
                    <th>TYPE  </th>
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
         <form method="POST" action="{{ route('save_products') }}">
            {{ csrf_field() }}
        <div class="modal-header">
          <h4 class="modal-title">Nouveau Produit  </h4>
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
                        <label for="FullName">Code Produit  </label>
                        <input type="text" class="form-control" name="codeproduct" id="FullName" placeholder="code produit  ">
                      </div>
                      <div class="form-group">
                        <label for="login">Designation </label>
                        <input type="text" class="form-control" id="login" name="designation" placeholder="Designation produit ">
                      </div>
                      <div class="form-group">
                        <label for="purchasing-price"> Prix Achat </label>
                        <input type="number" class="form-control" id="purchasing-price" name="purchasingPrice" placeholder="Prix D'achat">
                      </div>

                      <div class="form-group">
                        <label for="priceOfSaling"> Prix vente </label>
                        <input type="number" class="form-control" id="priceOfSaling" name="priceOfSaling" placeholder="Designation type produit ">
                      </div>

                      <div class="form-group">
                        <label for="marque"> Marque </label>
                        <input type="text" class="form-control" id="brand" name="brand" placeholder="Designation type produit ">
                      </div>

                      <div class="form-group">
                        <label for="description"> Description </label>
                        <textarea cols="30" rows="10"  class="form-control" id="description" name="description" placeholder="Description ">
                        </textarea>
                      </div>
                      <div class="form-group">
                        <label for="color"> Couleur </label>
                        <input type="color" class="form-control" id="color" name="color" placeholder="Designation type produit ">
                      </div>
                      

                      <div class="form-group">
                        <label for="typeProd">Type de produits </label>
                        <select class="form-control" name="typeProd" id="typeProd">
                            <option value="">Selectionner son type</option>
                            @foreach ($typeProducts as $key=>$type )
                                <option value="{{ $type->codeType }}"> {{ $type->label }} </option>
                            @endforeach
                        </select>
                      
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
















