@inject('myFonction', 'App\myFonction')
@extends("layouts/Main", [
    $title = "VC BM",
    $sb_title = "Point de vente"
])
@section('container')






<div class="modal fade" id="modal-lg-prod" style="text-align: center">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="ligne_article_title">
            Product Title
        </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="purchasing-price"> Prix de vente </label>
                <input type="number"   class="form-control" id="sellingprice" name="purchasingPrice" placeholder="Prix D'achat">
              </div>

              <div class="form-group">
                <label for="priceOfSaling"> Quantité </label>
                <input type="number" min=1 value="1" class="form-control" id="quantity" name="priceOfSaling" placeholder="Designation type produit ">
              </div>

              <div class="form-group">
                <label for="discount"> Remise </label>
                <input type="number" class="form-control" id="discount" name="discount" placeholder="Designation type produit ">
              </div>

              <div class="form-group">
                <label for="avance"> Avance </label>
                <input type="number" class="form-control" id="avance" name="avance" placeholder="Designation type produit ">
              </div>

              <div class="form-group">
                <label for="totalPrice"> total </label>
                <input type="number" readonly class="form-control" id="totalPrice" name="totalPrice" placeholder="Designation type produit ">
              </div>

        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
          <button type="button" id="addbtn" class="btn btn-success">Ajouter</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>







  <div class="container-fluid">

    <div class="row">
      <div class="col-7">

        <!-- /.card -->

        <div class="card">
          <div class="card-header">
            <h3 class="card-title"> <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-lg">
                <i class="fas fa-plus"></i>  Ajouter un Produit
            </button></h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="pointOfSale" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>#  </th>
                <th>CODE PRODUIT</th>
                <th>DESIGNATION </th>
                <th>PRIX ACHAT </th>
                <th>PRIX VENTE </th>
                <th>MARQUE </th>

                <th>COULEUR </th>
                <th>TYPE  </th>

              </tr>
              </thead>
              <tbody>
            @php
                $id = 1;
            @endphp
            @foreach ($products as $key=>$produit )

                <tr>
                    <td><button id="{{ $produit->productCode }}"
                                onclick="selectProduct({{ $produit }})"
                                class="btn btn-secondary"
                                data-toggle="modal"
                                data-target="#modal-lg-prod"> <i class="fas fa-plus"></i></button></td>
                    <td>{{$produit->productCode}}</td>
                    <td>{{ $produit->Designation }}</td>
                    <td>{{$produit->purchasePrice}}</td>
                    <td>{{ $produit->sellingPrice }}</td>
                    <td>{{$produit->marque}}</td>
                    <td>{{ $produit->color    }}</td>
                    <td>{{ $produit->label    }}</td>


                </tr>



              @php
                    $id ++;
                @endphp
              @endforeach

              </tbody>
              <tfoot>
                <tr>
                    <th>#  </th>
                    <th>CODE PRODUIT</th>
                    <th>DESIGNATION </th>
                    <th>PRIX A </th>
                    <th>PRIX VENTE </th>
                    <th>MARQUE </th>

                    <th>COULEUR </th>
                    <th>TYPE  </th>

                  </tr>
              </tfoot>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->








      <div class="col-4">

        <!-- /.card -->

        <div class="card">
          <div class="card-header">
            <h3 class="card-title"> Article dans le panier</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="pointOfSle" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>N°</th>
              
                <th>DESIGNATION </th>
                <th>QUANTITE</th>
                <th>PU  </th>
                <th>Prix Total  </th>
              </tr>
              </thead>
              <tbody id="articleTAdded">
            
       

              
             

              </tbody>
              <tfoot>
                <tr>
                    <th>N°</th>
              

                    <th>PRIX VENTE </th>
                    <th>MARQUE </th>
                    <th>DESCRIPTION </th>


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
















