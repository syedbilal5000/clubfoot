@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/css/select2.min.css') }}">
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
      <div class="col-md-6">
        <div class="form-group">
          <label>Select Patient: </label>
          <select id="samplePatient_Id" class="form-control select2" style="width: 100%;">
            <!-- bilals get all list from database -->
            <option value="Bilal hussain">Bilal hussain</option>
            <option value="Talha hussain">Talha hussain</option>
            <option value="test hussain">test hussain</option>
          </select>
        </div>
      </div>
    </div>  <!-- row end -->
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <table id="visit_table" class="table table-striped table-bordered" style="width:100% !important;">
            <thead class="table_header">
              <tr>
              <th>Side</th>
              <th>CLB</th>
              <th>MC</th>
              <th>LHC</th>
              <th>PC</th>
              <th>RE</th>
              <th>EH</th>
              <th>EH</th>
              <th>Midfoot Score</th>
              <th>Hindfoot Score</th>
              <th>Total Score</th>
              <th>Treatment</th>
              <th>Complic</th>
              <th>Next App</th>
              <th>No. of Cast</th>
              </tr>
            </thead> 
            <tbody class="table_body">
              <!-- bilals get all visits from database -->
              <tr>
              <td>Side</td>
              <td>CLB</td>
              <td>MC</td>
              <td>LHC</td>
              <td>PC</td>
              <td>RE</td>
              <td>EH</td>
              <td>EH</td>
              <td>Midfoot Score</td>
              <td>Hindfoot Score</td>
              <td>Total Score</td>
              <td>Treatment</td>
              <td>Complic</td>
              <td>Next App</td>
              <td>No. of Cast</td>
              </tr>
              <tr>
              <td>Side</td>
              <td>CLB</td>
              <td>MC</td>
              <td>LHC</td>
              <td>PC</td>
              <td>RE</td>
              <td>EH</td>
              <td>EH</td>
              <td>Midfoot Score</td>
              <td>Hindfoot Score</td>
              <td>Total Score</td>
              <td>Treatment</td>
              <td>Complic</td>
              <td>Next App</td>
              <td>No. of Cast</td>
              </tr>
            </tbody>
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
    </div>  <!-- row end -->
  </div>
</form>
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script>
  $(function() {
    $(document).ready(function () {
      $('.visit_nav').addClass('active');
      $('.select2').select2();
      $('#visit_table').DataTable();
    })
  })
</script>
@endsection