@extends('wrapper')
@section('content')

 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">
      <form action="edit/{id}" method="POST">
        @csrf
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Sua thong tin user</h4>
          </div>
          <input type='hidden' id='id' name='id'>
          <div class="modal-body">
          <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Full name" name="fullnameedit" id="fullname" value="">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="email" class="form-control" placeholder="Email" name="emailedit" id="email" readonly="">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Password" name="passwordedit" id="password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Retype password" name="re_passwordedit" id="re_password">
            <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
          </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <div class="col-xs-4">
               <button type="submit" class="btn btn-primary btn-block btn-flat">UPDATE</button>
            </div>
          </div>
        </div>
        </form>
      </div>
    </div>
     <section class="content-header">
      <h1>
        Data Tables
        <small>advanced tables</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">Data tables</li>
      </ol>
    </section>
    @if(Session::has('thanhcong'))
        <div class="alert alert-success">{{Session::get('thanhcong')}} </div>
    @endif

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Hover Data Table</h3>
            </div>
            @if (session('status'))
                <div class="alert alert-success">
                   {{ session('status') }}
                </div>
            @endif
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
              <thead>  
                <tr>  
                  <td>ID</td> 
                  <td>Name</td>  
                  <td>Email</td>
                  <td><a href="{{route('adduser')}}" class="btn btn-block btn-success btn-sm, fa fa-mouse-pointer" id="add" > THÊM</a></td>
                </tr>  
              </thead>
              <tbody>
              @foreach($user as $val)
                <tr>
                    <td>{{$val->id}}</td>
                    <td>{{$val->name}}</td>
                    <td>{{$val->email}}</td>
                    <td>
                    <a href="#" class="btn btn-block btn-warning btn-xs fa fa-edit deletebtn"  data_url="{{route('deleteuser', $val->id)}}"> XOA</a>
                    <a id="edit" class="btn btn-block btn-danger btn-xs fa fa-eraser" data_url="{{route('edituser', $val->id)}}" data-toggle="modal" data-target="#myModal"> SUA</a></td>
                </tr>
              @endforeach
              </tbody>   
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
</div>
  <!-- /.content-wrapper -->
@endsection
@section('script')
<script>
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
  $(document).ready( function(){
    $('#example2').DataTable({
      'paging': true,
      'responsive': true,
    });

    $(document).on('click', '#edit', function (e) {
      e.preventDefault();
      var url = $(this).attr('data_url'); 
      $.ajax({
        url: url,
        type: "get",
        success: function (response) {
          $('#fullname').val(response.name);
          $('#email').val(response.email);
          $('#id').val(response.id);
        }
      });
    });
  });

  $(document).on('click', '.deletebtn', function (e) { //click
		e.preventDefault();
		var url = $(this).attr('data_url'); 
		$.ajax({
				url: url,
				type: "post",
				success: function (response) {
          location.reload();
          alert("Xoa user thanh cong");
				},
				error: function () {
          console.log(2);
				}
		});
  });
</script>

@endsection


