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
          <h1 class="m-0"><span class="head_name"></span> Report</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="../home">Home</a></li>
            <li class="breadcrumb-item"><a href="./">Analytics</a></li>
            <li class="breadcrumb-item active"><span class="head_name"></span> Report</li>
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
    <div class="col-md-12">
      <h4 class="txt_heading">Visits By <span class="head_name"></span></h4>
      <table id="home_table" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Treatment</th>
                <th>Visits Count</th>
                <th>Followup Count</th>
                <th>Total Count</th>
            </tr>
        </thead>
        <tbody id="report_vsts">
        </tbody>
        <tfoot>
            <tr>
                <th>Treatment</th>
                <th>Visits Count</th>
                <th>Followup Count</th>
                <th>Total Count</th>
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
  var treat_type = 0, output = '', st_dt, ed_dt;
  var treatments = {1: "Casted", 2: "Tenotomy", 3: "Reassurance", 4: "New Brace", 5: "Referred"};
  var report_vsts = {!! json_encode($report_vsts) !!};
  var type = {!! json_encode($type) !!};
  var report_name = {!! json_encode($report_name) !!};
  $('.head_name').html(report_name);
  
  view_report_vsts(report_vsts);

  function view_report_vsts(report_vsts) {
    let visit_count = 0, followup_count = 0;
    output = '';
    for (i = 0; i < report_vsts.length; i++) {
      treat_type = report_vsts[i]['treatment'];
      visit_count = parseInt(report_vsts[i]['visit_count']);
      followup_count = parseInt(report_vsts[i]['followup_count']);
      output += `<tr><td>${treatments[treat_type]}</td> `;
      output += `<td>${visit_count != 0 ? visit_count : '-' }</td> `;
      output += `<td>${followup_count != 0 ? followup_count : '-' }</td> `;
      output += `<td>${visit_count + followup_count}</td></tr> `;
    }
    if (output == '') {
      output = `<tr class="odd"><td valign="top" colspan="4" class="dataTables_empty">No data available in table</td></tr>`;
    }
    $('#report_vsts').html(output);
  }

  // search records on date range
  function search_records() {
    st_dt = $('#start_date').val();
    ed_dt = $('#end_date').val();
    $.ajax({
      type: 'GET',
      url: '../analytic/casted_more_report/' + st_dt + '/' + ed_dt,
      success: function (data) {
        view_report_vsts(data);
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