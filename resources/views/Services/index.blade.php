@inject('myFonction', 'App\myFonction')
@extends("layouts/Main", [
    $title = "VC BM",
    $sb_title = "Services"
])
@section('container')





<div class="card" >

    <div class="card-header">
        <form action="" class="form">
            <input type="text"  placeholder="Tapez le nom d'un service ici ! " class="form-control" id="serviceFilter">
        </form>
    </div>

    <div class="card-body" id="allServices">

        <a class="btn btn-app" >
            <i style="line-height: 120px" class=" fa fa-plus"></i>
        </a>

   
        
    </div>
<!-- /.card-body -->
</div>





  
 








@endsection
















