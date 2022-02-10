@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
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

<form method="POST" action="visit/data">
  @csrf
  <div>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label>Select Patient: </label>
          <select id="patients" class="form-control select2" style="width: 100%;">
            <option selected disabled>Select Patient</option>
          </select>
        </div>
      </div>
    </div>  <!-- row end -->
    <div class="row">
      <div class="col-md-12 table-responsive">
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
              <!-- bilals get all visits from database when drop down data change-->
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
    </div>  <!-- row end -->
    <hr><br>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label>Total no of Cast: </label>
          <input type="text" name="no_cast" id="no_cast" class="form-control" disabled>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label>Total no of Recast: </label>
          <input type="text" name="no_recast" id="no_recast" class="form-control" disabled>
        </div>
      </div>
    </div> <!-- row end -->
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label>Date of Tenotomy: </label>
          <input type="text" name="date_tenotomy" id="date_tenotomy" class="form-control" disabled>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label>Date of Tenotomy: </label>
          <input type="text" name="date_retenotomy" id="date_retenotomy" class="form-control" disabled>
        </div>
      </div>
    </div> <!-- row end -->
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label>Time Duration: </label>
          <input type="text" name="time_tenotomy" id="time_tenotomy" class="form-control" disabled>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label>Time Duration: </label>
          <input type="text" name="time_retenotomy" id="time_retenotomy" class="form-control" disabled>
        </div>
      </div>
    </div> <!-- row end -->
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label>Date of Brace Application: </label>
          <input type="text" name="brace_app_tenotomy" id="brace_app_tenotomy" class="form-control" disabled>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label>Date of Brace Application: </label>
          <input type="text" name="brace_app_retenotomy" id="brace_app_retenotomy" class="form-control" disabled>
        </div>
      </div>
    </div> <!-- row end -->
    <hr><br>
    <div class="row">
      <div class="col-md-12 table-responsive">
        <div class="form-group">
          <table id="followup_table" class="table table-striped table-bordered" style="width:100% !important;">
            <thead class="table_followup_header">
              <tr style="text-align:center;">
                <th colspan="2">Follow up</th>
                <th rowspan="2" style="vertical-align: inherit;">RELAPSE</th>
                <th colspan="2">Abduction Brace use</th>
                <th rowspan="2" style="vertical-align: inherit;">TREATMENT</th>
                <th rowspan="2" style="vertical-align: inherit;">Next App</th>
              </tr>
              <tr style="text-align:center;">
                <th>Date</th>
                <th>Age</th>
                <th>Size</th>
                <th>Hours</th>
              </tr>
            </thead> 
            <tbody class="table_followup_body">
              <tr>
                <td>check1</td>
                <td>check1</td>
                <td>check1</td>
                <td>check1</td>
                <td>check1</td>
                <td>check1</td>
                <td>check1</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div> <!-- row end -->
  </div>
</form>
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script>
  var patients = {!! json_encode($patients) !!};
  
  view_patients(patients);

  function view_patients(patients) {
    output = '<option value="">Select Patient</option>';
    if (patients.length > 0) {
        var patientCheck = {};
        for (i = 0; i < patients.length; i++) {
          if(patientCheck[patients[i]['patient_id']] == true)
          {

          }
          else {
            patientCheck[patients[i]['patient_id']] = true;
            output += `<option value="${patients[i]['patient_id']}">${patients[i]['patient_name']},${patients[i]['guardian_number']},${patients[i]['guardian_cnic']}</option>`;
          }
        }
    } else {
        output = '<option value="-1">No Data</option>';
    }
    $('#patients').html(output);
  }
   

  $(function() {
    $(document).ready(function () {
      $('.visit_nav').addClass('active');
      $('.visits_nav').addClass('active');
      $('.select2').select2();
      $('#visit_table').DataTable();

      $('#patients').on('change', function() {
        
      })
    })
  })
</script>
@endsection