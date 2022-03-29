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
          <h1 class="m-0">Casted More Report</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="../home">Home</a></li>
            <li class="breadcrumb-item"><a href="./">Analytics</a></li>
            <li class="breadcrumb-item active">Casted More Report</li>
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
    <!-- <div class="col-md-4">
      <div class="form-group">
        <label>Select Status: </label>
        <select id="status_text" name="change_status" class="form-control select2" style="width: 100%;">
          <option value="0" selected>Select </option>
          <option value="2">Pending</option>
          <option value="3">Reject</option>
          <option disabled title="Not Allowed" value="4">Extend</option>
          <option disabled title="Not Allowed"  value="1">Done</option>
        </select>
      </div>
    </div> -->
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
      <h4 class="txt_heading">Casted Visits More Than Seven</h4>
      <table id="home_table" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Reg no.</th>
                <th>Patient Name</th>
                <th>Guardian Number</th>
                <th>Total Visits</th>
                <th>First Visit</th>
                <th>Last Visit</th>
                <th>First Score</th>
                <th>Last Score</th>
            </tr>
        </thead>
        <tbody id="appoint_delayed">
        </tbody>
        <tfoot>
            <tr>
                <th>Reg no.</th>
                <th>Patient Name</th>
                <th>Guardian Number</th>
                <th>Total Visits</th>
                <th>First Visit</th>
                <th>Last Visit</th>
                <th>First Score</th>
                <th>Last Score</th>
            </tr>
        </tfoot>
      </table>
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
  var patient_id = 0, output = '', st_dt, ed_dt;
  var appoint_delayed = {!! json_encode($appoint_delayed) !!};
  
  view_appoint_delayed(appoint_delayed);

  function view_appoint_delayed(appoint_delayed) {
    let url = '';
    output = '';
    for (i = 0; i < appoint_delayed.length; i++) {
      patient_id = appoint_delayed[i]['patient_id'];
      url = `patient/${patient_id}/edit`;
      output += `<tr><td><a href="${url}" class="txt_link">${patient_id}</a></td> `;
      output += `<td>${appoint_delayed[i]['patient_name']}</td> `;
      output += `<td>${appoint_delayed[i]['guardian_number']}</td> `;
      output += `<td class="txt_center">${appoint_delayed[i]['total_visits']}</td> `;
      output += `<td>${appoint_delayed[i]['first_visit']}</td> `;
      output += `<td>${appoint_delayed[i]['last_visit']}</td> `;
      output += `<td class="txt_center">${appoint_delayed[i]['first_visit_score']}</td> `;
      output += `<td class="txt_center">${appoint_delayed[i]['last_visit_score']}</td></tr>`;
    }
    if (output == '') {
      output = `<tr class="odd"><td valign="top" colspan="8" class="dataTables_empty">No data available in table</td></tr>`;
    }
    $('#appoint_delayed').html(output);
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