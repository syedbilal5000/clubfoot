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

<form method="POST" action="Visits/add">
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
    <br><hr><h2 style="text-align:center;">Add New Visit</h2>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label>Date: </label>
          <input type="date" name="visit_date" id="visit_date" class="form-control">
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label>Side: </label>
          <select id="side_drop" class="form-control select2" style="width: 100%;">
            <option value="L">Left</option>
            <option value="R">Right</option>
          </select>
        </div>
      </div>
    </div><!-- row end -->
    <h5>MidFoot Score</h5>
    <div class="row">
      <div class="col-md-4">
        <div class="form-group">
          <label>CLB: </label>
          <select id="clb_drop" class="form-control select2 score_dropd" style="width: 100%;">
            <option value="0.0">0.0</option>
            <option value="0.5">0.5</option>
            <option value="1.0">1.0</option>
          </select>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label>MC: </label>
          <select id="mc_drop" class="form-control select2 score_dropd" style="width: 100%;">
            <option value="0.0">0.0</option>
            <option value="0.5">0.5</option>
            <option value="1.0">1.0</option>
          </select>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label>LHT: </label>
          <select id="lht_drop" class="form-control select2 score_dropd" style="width: 100%;">
            <option value="0.0">0.0</option>
            <option value="0.5">0.5</option>
            <option value="1.0">1.0</option>
          </select>
        </div>
      </div>
    </div> <!-- row end -->
    <h5>HindFoot Score</h5>
    <div class="row">
      <div class="col-md-4">
        <div class="form-group">
          <label>PC: </label>
          <select id="pc_drop" class="form-control select2 score_dropd" style="width: 100%;">
            <option value="0.0">0.0</option>
            <option value="0.5">0.5</option>
            <option value="1.0">1.0</option>
          </select>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label>RE: </label>
          <select id="re_drop" class="form-control select2 score_dropd" style="width: 100%;">
            <option value="0.0">0.0</option>
            <option value="0.5">0.5</option>
            <option value="1.0">1.0</option>
          </select>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label>EH: </label>
          <select id="eh_drop" class="form-control select2 score_dropd" style="width: 100%;">
            <option value="0.0">0.0</option>
            <option value="0.5">0.5</option>
            <option value="1.0">1.0</option>
          </select>
        </div>
      </div>
    </div> <!-- row end -->
    <h5>Total Score</h5>
    <div class="row">
      <div class="col-md-4">
        <div class="form-group">
          <label>Midfoot Score: </label>
          <input type="text" disabled name="midfoot_score" id="midfoot_score" class="form-control">
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label>Hindfoot Score: </label>
          <input type="text" disabled name="hindfoot_score" id="hindfoot_score" class="form-control">
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label>Total Score: </label>
          <input type="text" disabled name="total_score" id="total_score" class="form-control">
        </div>
      </div>
    </div> <!-- row end -->
    <div class="row">
      <div class="col-md-4">
        <div class="form-group">
          <label>Treatment: </label>
          <select id="treatment_drop" class="form-control select2" style="width: 100%;">
            <option value="Casted">Casted</option>
            <option value="Tenotomy">Tenotomy</option>
          </select>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label>Complications: </label>
          <input type="text" name="complications" id="complications" class="form-control">
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label>Next Appointment: </label>
          <input type="date" name="next_appointment" id="next_appointment" class="form-control" value="@php echo date('Y-m-d', strtotime('+1 week'));@endphp">
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
  function calculateScore() {
    var clb_drop = $("#clb_drop").val();
    var mc_drop = $("#mc_drop").val();
    var lht_drop = $("#lht_drop").val();
    var pc_drop = $("#pc_drop").val();
    var re_drop = $("#re_drop").val();
    var eh_drop = $("#eh_drop").val();

    var midfoot_score = parseFloat(clb_drop) + parseFloat(mc_drop) + parseFloat(lht_drop);
    var hindfoot_score = parseFloat(pc_drop) + parseFloat(re_drop) + parseFloat(eh_drop);

    $("#midfoot_score").val(midfoot_score);
    $("#hindfoot_score").val(hindfoot_score);
    $("#total_score").val(midfoot_score + hindfoot_score);

  } 

  $(function() {
    $(document).ready(function () {
      $('.visit_nav').addClass('active');
      $('.select2').select2();
      $('#visit_table').DataTable();

      $(".score_dropd").on('change', function() {
        calculateScore();
      })
    })
  })
</script>
@endsection