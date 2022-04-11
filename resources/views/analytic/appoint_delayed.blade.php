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
</style>
<link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-buttons/css/buttons.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/css/select2.min.css') }}">
  <!-- Content Header (Page header) -->
  <div class="content-header" style="padding-left: 0px;">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Appointments Delayed</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="../home">Home</a></li>
            <li class="breadcrumb-item"><a href="./">Analytics</a></li>
            <li class="breadcrumb-item active">Appointments Delayed</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
{{-- Main Content --}}

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
    <div class="col-md-12">
      <h4 class="txt_heading">Appointments Delayed / Missed</h4>
      <table id="home_table" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Reg no.</th>
                <th>Patient Name</th>
                <th>Guardian Number</th>
                <th>Appointment Date</th>
                <th>Status</th>
                <th>Call Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="appoint_delayed">
        </tbody>
        <tfoot>
            <tr>
                <th>Reg no.</th>
                <th>Patient Name</th>
                <th>Guardian Number</th>
                <th>Appointment Date</th>
                <th>Status</th>
                <th>Call Status</th>
                <th>Action</th>
            </tr>
        </tfoot>
      </table>
    </div>
    </div>
    <form action="appoint_delayed/add" method="POST" id="appoint_form">
      @csrf
    <div class="row">
    <input type="hidden" name="appointment_id" id="appointment_id" value="0" class="form-control">
    <div class="col-md-4">
      <div class="form-group">
        <label>Select Status: </label>
          <select id="status" name="reason" class="form-control select2" style="width: 100%;" required>
            <option disabled selected hidden>Select Status</option>
            <option value="1">Called</option>
            <option value="2">No Response</option>
            <option value="3">Wrong Number</option>
          </select>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label>Description: </label>
        <div class="input-group">
          <input type="text" name="description" id="description" class="form-control" 
          placeholder="Enter description, if any">
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label>&nbsp;</label>
        <!-- <a class="form-control pull-right btn btn-primary" type="submit">Submit</a> -->
        <button type="submit" style="margin-bottom: 10px;" class="form-control btn btn-primary">Submit</button>
      </div>
    </div>
  </div>
  </form>
</div>

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
  var patient_id = 0, output = '', st_dt, ed_dt, url, status_dict;
  var appoint_delayed = {!! json_encode($appoint_delayed) !!};
  
  view_appoint_delayed(appoint_delayed);

  function view_appoint_delayed(appoint_delayed) {
    url = '';
    status_dict = { 0: "-", 1: "Called", 2: "No Response", 3: "Wrong Number" };
    output = '';
    for (i = 0; i < appoint_delayed.length; i++) {
      patient_id = appoint_delayed[i]['patient_id'];
      url = `../patient/${patient_id}/edit`;
      output += `<tr><td><a href="${url}" class="txt_link">Pc-${appoint_delayed[i]['inserted_at'].substr(2,2)}|${patient_id}</a></td> `;
      output += `<td>${appoint_delayed[i]['patient_name']}</td> `;
      output += `<td>${appoint_delayed[i]['guardian_number']}</td> `;
      output += `<td>${appoint_delayed[i]['appointment_date']}</td> `;
      output += `<td>Pending</td> `;
      output += `<td>${status_dict[appoint_delayed[i]['reason']]}</td> `;
      output += `<td><a class="btn btn-success " onclick="setIDFunction(${appoint_delayed[i]['appointment_id']})"><i class="fa fa-plus"></i></a></td> `;
    }
    if (output == '') {
      output = `<tr class="odd"><td valign="top" colspan="8" class="dataTables_empty">No data available in table</td></tr>`;
    }
    $('#appoint_delayed').html(output);
  }

  function setIDFunction(appointment_id)
  {
    $("#appointment_id").val(appointment_id)
  }
  // search records on date range
  function search_records() {
    st_dt = $('#start_date').val();
    ed_dt = $('#end_date').val();
    $.ajax({
      type: 'GET',
      url: '../analytic/appoint_delayed_report/' + st_dt + '/' + ed_dt,
      success: function (data) {
        view_appoint_delayed(data);
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
    $("#appoint_form").validate();
    $('#appoint_form').submit(function () {
      let appoint_id = $("#appointment_id").val();
      if (appoint_id == "0") {
        alert("Please add / select appoint before submit.");
        return false;
      }
    });
    $('#home_table').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    } );
    $('#home_table').addClass('table-responsive');
  
    // fill_data(patients_appoint);

  });

</script>
@endsection