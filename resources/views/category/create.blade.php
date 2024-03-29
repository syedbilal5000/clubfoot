@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/css/select2.min.css') }}">
<style type="text/css">
  .select2-selection {
    height: unset !important;
    border: 1px solid #ced4da !important;
    border-radius: unset !important;
    padding: 0.375rem .75rem !important;
  }
</style>
  <!-- Content Header (Page header) -->
  <div class="content-header" style="padding-left: 0px;">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Add New Categories</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="home">Home</a></li>
            <li class="breadcrumb-item active">Add New Category</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

{{-- Main Content --}}

<form id="category_form" method="POST" action="add" enctype="multipart/form-data">
  @csrf
  <div class="container-fluid">
  <div>
    <!-- <h2 style="text-align:center;">Add New Follow-Up</h2> -->
    
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label>Category Name: </label><label style="color: red;"> &nbsp;*</label>
          <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name">
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label>Category Description: </label>
          <input type="text" name="description" id="description" class="form-control" placeholder="Enter Description">
        </div>
      </div>
    </div> <!-- row end -->
  </div>
  <button type="submit" style="margin-bottom: 10px;" class="form-control btn btn-primary">Submit</button>
  </div>
</form>
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/inputmask/jquery.inputmask.js') }}"></script>
<script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
<script>
  
  $(function () {
    $('.select2').select2();
    $('.expense_navs').addClass('active');
    $('.category_nav_add').addClass('active');

  });

</script>
@endsection
