@extends('layouts.admin')

@section('content')
<style type="text/css">
  .txt_link:hover { text-decoration: underline; }
  .txt_center { text-align: center; }
  .txt_heading {
    text-underline-position: under;
    text-decoration: underline;
    padding-bottom: 5px; 
    text-align: center;
  }
  .select2-selection {
    height: unset !important;
    border: 1px solid #ced4da !important;
    border-radius: unset !important;
    padding: 0.375rem .75rem !important;
  }

  .main-transaction-wrapper.card {
    box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);
    border-radius: 5px;
    margin-bottom: 20px;
  }
  .transaction-summary {
    margin-bottom: 10px;
    padding: 0px 20px;
  }
  .transaction-summary h3 {
    margin: 20px 0 10px;
    font-weight: 600;
    font-size: 20px;
    margin-bottom: 10px;
  }
  .transaction-summary h5 {
    font-size: 16px;
    font-weight: 400;
    margin-top: 18px;
    margin-bottom: 30px; 
  }
  .transaction-summary h2 {
    margin-top: 18px;
    margin-bottom: 20px;
    font-weight: 500;
    font-size: 2.5rem;
  }
  .transaction-summary p {
    line-height: 8px;
    font-size: 18px;
  }
  .transaction-summary a {
    line-height: 17px;
  }
  .transaction-summary a:hover {
    text-decoration: underline;
  }
</style>
<link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-buttons/css/buttons.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/css/select2.min.css') }}">
<!-- Content Header (Page header) -->
<div class="content-header" style="padding-left: 0px;">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Dashboard</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <!-- <li class="breadcrumb-item"><a href="../home">Home</a></li> -->
          <li class="breadcrumb-item active">Home</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
{{-- Main Content --}}
<form action="appointment/update" method="POST" id="appoint_form">
  @csrf
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-4">
        <div class="form-group">
          <label>Start Date: </label>
          <div class="input-group">
            <input type="date" name="start_date" id="start_date" class="form-control" required
            value="@php echo date('Y-m-d', strtotime ('-3 Months')); @endphp">
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label>End Date: </label>
          <div class="input-group">
            <input type="date" name="end_date" id="end_date" class="form-control" required
            value="@php echo date('Y-m-d'); @endphp">
          </div>
        </div>
      </div>
    <div class="col-md-4">
      <div class="form-group">
        <label>&nbsp;</label>
        <a class="form-control pull-right btn btn-primary" id="update_btn" onclick="search_records()">Search</a>
      </div>
    </div>
  </div> <!-- div row end -->
  <br>
  <!-- <hr> -->
  <div class="row">
    <div class="col-md-6">
      <div class="main-transaction-wrapper card">
        <div class="">
          <div class="transaction-summary">
            <h3>Appointments</h3>
            <h2><span id="all_count">0</span></h2>
            <!-- <p style="color: red"><i class="fa fa-caret-down"></i>-100% previous day</p> -->
            <p>Completed <span class="font-weight-bold"><span id="completed_count">0</span> (<span id="completed_percent">0</span>%)</span></p>
            <p>Missed <span class="font-weight-bold"><span id="cancelled_count">0</span> (<span id="cancelled_percent">0</span>%)</span></p>
            <!-- <p>No Show <span class="font-weight-bold">0 (0%)</span></p> -->
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="main-transaction-wrapper card">
        <div class="">
          <div class="transaction-summary">
            <h3>Total Visits</h3>
            <h2><span id="total_visits">0</span></h2>
            <!-- <p style="color: red"><i class="fa fa-caret-down"></i>-22% previous day</p> -->
            <p>Visit Count <span class="font-weight-bold" id="visit_count"></span></p>
            <p>Followup Count <span class="font-weight-bold" id="followup_count"></span></p>
            <!-- <p>&nbsp;</p> -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</form>

<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/ajax/libs/jszip.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/ajax/libs/pdfmake.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/ajax/libs/vfs_fonts.js') }}"></script>

<!-- Page specific script -->
<script type="text/javascript">
  var patient_id = 0, output = '', st_dt, ed_dt, status, status_count;
  var appointments = {!! json_encode($appointments) !!};
  var visits = {!! json_encode($visits) !!};
  
  view_dashboard(appointments, visits);

  // set appointments and visits stats
  function view_dashboard(appointments, visits) {
    // 1: "Done", 2: "Pending", 3: "Reject", 4: "Extend"
    status_count = { 1: 0, 2: 0, 3: 0, 4: 0 };
    for (i = 0; i < appointments.length; i++) {
      status = appointments[i]["appointment_status"];
      status_count[status] += 1;
    }
    all_count = appointments.length;
    $("#all_count").html(all_count);
    $("#completed_count").html(status_count[1]);
    $("#completed_percent").html(parseInt((status_count[1] / all_count) * 100));
    // $("#not_comp_count").html(all_count - status_count[1]);
    // $("#not_comp_percent").html(( (all_count - status_count[1]) / all_count) * 100);
    $("#cancelled_count").html(status_count[2]);
    $("#cancelled_percent").html(parseInt((status_count[2] / all_count) * 100));
    $("#total_visits").html(parseInt(visits["visit_count"]) + parseInt(visits["followup_count"]));
    $("#visit_count").html(visits["visit_count"]);
    $("#followup_count").html(visits["followup_count"]);
  }

  // search records on date range
  function search_records() {
    st_dt = $('#start_date').val();
    ed_dt = $('#end_date').val();
    $.ajax({
      type: 'GET',
      url: 'home/dashboard/' + st_dt + '/' + ed_dt,
      success: function (data) {
        view_dashboard(data["appointments"], data["visits"]);
      },
      error: function() { 
        console.log("none");
      }
    });
  }

  $(document).ready(function() {
    // $('.appointment_nav').addClass('active');
    // $('.appointments_nav').addClass('active');
    $('.select2').select2();
    $('#home_table').DataTable( {
        // dom: 'Bfrtip',
        // buttons: [
        //     'copyHtml5',
        //     'excelHtml5',
        //     'csvHtml5',
        //     'pdfHtml5'
        // ]
      } );
    $('#home_table').addClass('table-responsive');

    // fill_data(patients_appoint);

  });

</script>
@endsection