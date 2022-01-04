@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Visits</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="home">Home</a></li>
            <li class="breadcrumb-item active">Visits</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

{{-- Main Content --}}

<form method="POST" action="Visits/add">
  @csrf
  <div>
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <table id="patient_table" class="table table-bordered table-striped">
            <thead>
              <th>Name</th>
              <th>Age</th>
              <th>Phone Number</th>
              <th>Status</th>
            </thead>
            <tbody id="patient_table_body"></tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label>Appointment date: </label><label style="color: red;"> &nbsp;*</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-user"></i></span>
            <input type="date" name="appointment_date" class="form-control">
          </div>
        </div>
      </div>
  </div>
</form>

<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript">
  $(function() {
    $('.patient_nav').addClass('active');
    // $("#customerlst").html(options); 
    $('#patient_table').DataTable();
  });
</script>
@endsection