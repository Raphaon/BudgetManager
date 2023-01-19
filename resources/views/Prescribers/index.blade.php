@inject('myFonction', 'App\myFonction')
@extends("layouts/Main", [
    $title = "VC BM",
    $sb_title = "Services / Prescribers"
])
@section('container')


  <div class="col-md-12">
    <!-- USERS LIST -->
    <div class="card">
      <div class="card-header">
        <form action="">
            <input type="text" class="form-control" placeholder="Typez un service ">
          </form>
      </div>
      <!-- /.card-header -->
      <div class="card-body p-0">
        <ul class="users-list clearfix">
          <li>
            <img src="dist/img/user1-128x128.jpg" alt="User Image">
            <a class="users-list-name" href="#">Alexander Pierce</a>
            <span class="users-list-date">Today</span>
          </li>
          <li>
            <img src="dist/img/user8-128x128.jpg" alt="User Image">
            <a class="users-list-name" href="#">Norman</a>
            <span class="users-list-date">Yesterday</span>
          </li>
          <li>
            <img src="dist/img/user7-128x128.jpg" alt="User Image">
            <a class="users-list-name" href="#">Jane</a>
            <span class="users-list-date">12 Jan</span>
          </li>
          <li>
            <img src="dist/img/user6-128x128.jpg" alt="User Image">
            <a class="users-list-name" href="#">John</a>
            <span class="users-list-date">12 Jan</span>
          </li>
          <li>
            <img src="dist/img/user2-160x160.jpg" alt="User Image">
            <a class="users-list-name" href="#">Alexander</a>
            <span class="users-list-date">13 Jan</span>
          </li>
          <li>
            <img src="dist/img/user5-128x128.jpg" alt="User Image">
            <a class="users-list-name" href="#">Sarah</a>
            <span class="users-list-date">14 Jan</span>
          </li>
          <li>
            <img src="dist/img/user4-128x128.jpg" alt="User Image">
            <a class="users-list-name" href="#">Nora</a>
            <span class="users-list-date">15 Jan</span>
          </li>
          <li>
            <img src="dist/img/user3-128x128.jpg" alt="User Image">
            <a class="users-list-name" href="#">Nadia</a>
            <span class="users-list-date">15 Jan</span>
          </li>
        </ul>
        <!-- /.users-list -->
      </div>
      <!-- /.card-body -->
      <div class="card-footer text-center">
        <a href="javascript:">View All Users</a>
      </div>
      <!-- /.card-footer -->
    </div>
    <!--/.card -->
  </div>






  
 








@endsection
















