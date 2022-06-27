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

  <div class="containing_filter">
  <div class="row">
    <div class="col-md-4">
      <div class="form-group">
        <label>Filter Column: </label>
          <div class="input-group">
            <select id="key" name="key" class="form-control select2 key_filter" style="width: 100%;">
            </select>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>Condition: </label>
        <div class="input-group">
          <select id="condition" name="" class="form-control select2 condition_filter" style="width: 100%;">
            <option value="=" > equal </option>
            <option value=">" > greater </option>
            <option value="<" > less </option>
            <option value=">=" > greater equal </option>
            <option value="<=" > less equal </option>
          </select>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label>Value</label>
        <div class="input-group">
          <input type="text" name="value" id="value" placeholder="Enter fixed value" class="form-control value_filter">
        </div>
      </div>
    </div>
    <div class="col-md-2">
      <div class="form-group">
        <label>&nbsp;</label>
        <a class="form-control pull-right btn btn-success" id="add_btn" onclick="add_record()">Add</a>  
      </div>
    </div>
  </div> <!-- div row end -->
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label>&nbsp;</label>
        <a class="form-control pull-right btn btn-primary" id="update_btn" onclick="search_records()">Search</a>  
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <h3>Patient</h3>
    </div>
  </div>
  <hr>
  <div class="row">
    <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" value="p.patient_name" class="patient" name="patient_name"> &nbsp; Patient Name </label>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" value="p.father_name" class="patient" name="father_name"> &nbsp; Father Name </label>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" value="p.gender" class="patient" name="gender"> &nbsp; Gender </label>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" value="p.birth_date" class="patient" name="birth_date"> &nbsp; DOB </label>
        </div>
      </div>
    </div>
  </div> <!-- row end -->
  <div class="row">
    <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" value="p.age" class="patient" name="age"> &nbsp; age </label>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" value="p.address" class="patient" name="address"> &nbsp; Address </label>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" value="p.icr_number" class="patient" name="icr_number"> &nbsp; ICR Number </label>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" value="p.inserted_at" class="patient" name="inserted_at"> &nbsp; Registration Date </label>
        </div>
      </div>
    </div>
  </div> <!-- row end -->
  <div class="row">
    <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" value="p.guardian_name" class="patient" name="guardian_name"> &nbsp; Guardian Name </label>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" value="p.guardian_number" class="patient" name="guardian_number"> &nbsp; Guardian Number </label>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" value="p.guardian_cnic" class="patient" name="guardian_cnic"> &nbsp; Guardian CNIC </label>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" value="p.relation_to_patient" class="patient" name="relation_to_patient"> &nbsp; Guardian Relation </label>
        </div>
      </div>
    </div>
  </div> <!-- row end -->
  <div class="row">
    <div class="col-md-12">
      <h3>Diagnosis</h3>
    </div>
  </div>
  <hr>
  <div class="row">
    <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" value="pd.evaluator_name" class="patient_dia" name="evaluator_name"> &nbsp; Evaluator Name</label>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" value="pd.evaluation_date" class="patient_dia" name="evaluation_date"> &nbsp; Evaluation Date</label>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" value="pd.evaluator_title" class="patient_dia" name="evaluator_title"> &nbsp; Evaluator Title</label>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" value="pd.feet_affected" class="patient_dia" name="feet_affected"> &nbsp; Feet Affected</label>
        </div>
      </div>
    </div>
  </div> <!-- row end -->
  <div class="row">
  <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" value="pd.diagnosis" class="patient_dia" name="diagnosis"> &nbsp; Diagnosis</label>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" value="pd.other_diagnosis" class="patient_dia" name="other_diagnosis"> &nbsp; Other Diagnosis</label>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" value="pd.has_birth_deformity" class="patient_dia" name="has_birth_deformity"> &nbsp; Has Birth Deformity</label>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" value="pd.has_treated" class="patient_dia" name="has_treated"> &nbsp; Has Treated</label>
        </div>
      </div>
    </div>
  </div> <!-- row end -->
  <div class="row">
    <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" value="pd.treatments" class="patient_dia" name="treatments"> &nbsp; Treatments</label>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" value="pd.treatment_type" class="patient_dia" name="treatment_type"> &nbsp; Treatment Type</label>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" value="pd.has_diagnosed" class="patient_dia" name="has_diagnosed"> &nbsp; Has Diagnosed</label>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" value="pd.preg_week" class="patient_dia" name="preg_week"> &nbsp; pregnancy Week</label>
        </div>
      </div>
    </div>
  </div> <!-- row end -->
  <div class="row">
    <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" value="pd.has_birth_confirmed" class="patient_dia" name="has_birth_confirmed"> &nbsp; Confirmed at birth</label>
        </div>
      </div>
    </div>
  </div> <!-- row end -->
  <div class="row">
    <div class="col-md-12">
      <h3>Visit</h3>
    </div>
  </div>
  <hr>
  <div class="row">
    <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" value="v.visit_date" class="visit" name="visit_date"> &nbsp; visit_date</label>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" value="v.next_visit_date" class="visit" name="next_visit_date"> &nbsp; next_visit_date</label>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" value="v.side" class="visit" name="side"> &nbsp; side</label>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" value="v.CLB" class="visit" name="CLB"> &nbsp; CLB</label>
        </div>
      </div>
    </div>
    </div> <!-- row end -->
  <div class="row">
    <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" value="v.MC" class="visit" name="MC"> &nbsp; MC</label>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" value="v.LHT" class="visit" name="LHT"> &nbsp; LHT</label>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" value="v.PC" class="visit" name="PC"> &nbsp; PC</label>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" value="v.RE" class="visit" name="RE"> &nbsp; RE</label>
        </div>
      </div>
    </div>
    </div> <!-- row end -->
  <div class="row">
    <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" value="v.EH" class="visit" name="EH"> &nbsp; EH</label>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" value="v.mid_foot_score" class="visit" name="mid_foot_score"> &nbsp; mid_foot_score</label>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" value="v.hind_foot_score" class="visit" name="hind_foot_score"> &nbsp; hind_foot_score</label>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" value="v.total_score" class="visit" name="total_score"> &nbsp; total_score</label>
        </div>
      </div>
    </div>
    </div> <!-- row end -->
  <div class="row">
    <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" value="v.treatment" class="visit" name="treatment"> &nbsp; treatment</label>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" value="v.complication" class="visit" name="complication"> &nbsp; complication</label>
        </div>
      </div>
    </div>
  </div> <!-- row end -->
  <div class="row">
    <div class="col-md-12">
      <h3>Follow Up</h3>
    </div>
  </div>
  <hr>
  <div class="row">
    <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" name="visit_date" class="followup" value="f.visit_date"> &nbsp; visit_date</label>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" name="next_visit_date" class="followup" value="f.next_visit_date"> &nbsp; next_visit_date</label>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" name="relapse" class="followup" value="f.relapse"> &nbsp; relapse</label>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" name="size" class="followup" value="f.size"> &nbsp; size</label>
        </div>
      </div>
    </div>
  </div> <!-- row end -->
  <div class="row">
    <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" name="hours" class="followup" value="f.hours"> &nbsp; hours</label>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" name="treatment" class="followup" value="f.treatment"> &nbsp; treatment</label>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" name="is_virtual" class="followup" value="f.is_virtual"> &nbsp; is_virtual</label>
        </div>
      </div>
    </div>
  </div> <!-- row end -->
  
  <!-- <div class="row">
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
  </div> --> <!-- div row end -->
  
  <br>
  <!-- <hr> -->
  <div class="row">
    <div class="col-md-12">
      <h4 class="txt_heading">Generic / Main Report</h4>
      <table id="home_table" class="table table-striped table-bordered">
        <thead>
            <tr id="columns_h"></tr>
        </thead>
        <tbody id="main_report">
        </tbody>
        <tfoot>
            <tr id="columns_f"></tr>
        </tfoot>
      </table>
    </div>
    </div>
    <!-- <form action="main_report/add" method="POST" id="appoint_form">
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
        <button type="submit" style="margin-bottom: 10px;" class="form-control btn btn-primary">Submit</button>
      </div>
    </div>
  </div>
  </form> -->
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

  var patient_id = 0, output = '', st_dt, ed_dt, url, status_dict, keys, conditions, values, current_filter_id =2;
  var select_p = [], select_pd = [], select_v = [], select_f = [], filterations = "", selections = "", collections = "", temp = "", dct = {}, idx, column, columns = [], row;
  var main_report = {!! json_encode($main_report) !!};
  
  // view_main_report(main_report);

  function view_main_report(main_report, selections) {
    output = '', columns = [];
    console.log("Inside");
    console.log(selections);
	selections = selections.split(',');
	for (i = 0; i < selections.length; i++) {
	  idx = selections[i].indexOf('.');
	  column = selections[i].slice(idx+1, );
	  console.log(column);
	  columns.push(column);
	  output += `<th>${column}</th>`;
	}
	$('#columns_h').html(output);
	$('#columns_f').html(output);
	output = '';
	for (j = 0; j < main_report.length; j++) {
      output += "<tr>";
	  for (k = 0; k < columns.length; k++) {
	    row = main_report[j][columns[k]];
		output += `<td>${row}</td> `;
	  }
	  output += "</tr>";
	  console.log(main_report[j]);
    }
    if (output == '') {
      output = `<tr class="odd"><td valign="top" colspan="8" class="dataTables_empty">No data available in table</td></tr>`;
    }
    $('#main_report').html(output);
  }

  function setIDFunction(appointment_id)
  {
    $("#appointment_id").val(appointment_id)
  }
  // search records on query
  function search_records() {
    select_p = [], select_pd = [], select_v = [], select_f = [], filterations = "", selections = "", collections = "", temp = "", dct = {}, idx, column, columns = [], row;
	keys = Array.from($('.key_filter').get(), e => e.value);
    conditions = Array.from($('.condition_filter').get(), e => e.value);
    values = Array.from($('.value_filter').get(), e => e.value);
	for (i = 0; i < values.length; i++) {
	  filterations += keys[i] + conditions[i] + values[i] + ' AND ';
	  dct[keys[i][0]] = 1;
	}
	filterations = filterations.slice(0, -4);
	$('input.patient:checkbox:checked').each(function () {
      select_p.push($(this).val());
    });
	$('input.patient_dia:checkbox:checked').each(function () {
      select_pd.push($(this).val());
    });
    $('input.visit:checkbox:checked').each(function () {
      select_v.push($(this).val());
    });
    $('input.followup:checkbox:checked').each(function () {
      select_f.push($(this).val());
    });
	select_p = select_p.toString();
	select_pd = select_pd.toString();
	select_v = select_v.toString();
	select_f = select_f.toString();
	if (select_p != "") {
	  selections += select_p + ", ";
	  dct['p'] = 1;
	}
	if (select_pd != "") {
	  selections += select_pd + ", ";
	  dct['pd'] = 1;
	}
	if (select_v != "") {
	  selections += select_v + ", ";
	  dct['v'] = 1;
	}
	if (select_f != "") {
	  selections += select_f + ", ";
	  dct['f'] = 1;
	}
	selections = selections.slice(0, -2);
	collections = "patients p ";
	if ('pd' in dct) {
	  collections += "RIGHT JOIN patient_diagnoses pd ON pd.patient_id = p.patient_id ";
	}
	if ('v' in dct) {
	  collections += "RIGHT JOIN visit_details v ON v.patient_id = p.patient_id ";
	}
	if ('f' in dct) {
	  collections += "RIGHT JOIN followup f ON f.patient_id = p.patient_id ";
	}
	console.log(selections);
	console.log(collections);
	console.log(filterations);
	if (selections != "" && collections != "" && filterations != "") {
      $.ajax({
        type: 'GET',
        url: '../analytic/main_data/' + selections + '/' + collections + '/' + filterations,
	    dataType: 'json',
        success: function (data) {
          view_main_report(data, selections);
		  console.log(data);
        },
        error: function() { 
          console.log("none");
        }
      });
	} else {
	  alert("Select column / filter to view");
	}
  }
  function generate_option()
  {
    var data_lists = "patient_id,patient_name,father_name,gender,birth_date,address,address2,out_of_city,has_photo_consent,relation_to_patient,guardian_name,guardian_number,guardian_number_2,guardian_cnic,icr_number,donor_id,inserted_at";

    var vist_lists = "visit_date,next_visit_date,appointment_id,side,CLB,MC,LHT,PC,RE,EH,mid_foot_score,hind_foot_score,total_score,treatment,complication";

    var folow_lists = "appointment_id,visit_date_followup,next_visit_date,relapse,size,hours,treatment,is_virtual";
    var data_list = data_lists.split(",");
    var vist_list = vist_lists.split(",");
    var folow_list = folow_lists.split(",");
    var result = "";
    for (var i = data_list.length - 1; i >= 0; i--) {
        result += "<option value='p." + data_list[i] + "' > " +data_list[i]+" </option> ";
    }
    for (var i = vist_list.length - 1; i >= 0; i--) {
        result += "<option value='v." + vist_list[i] + "' > " +vist_list[i]+" </option> ";
    }
    for (var i = folow_list.length - 1; i >= 0; i--) {
        result += "<option value='f." + folow_list[i] + "' > " +folow_list[i]+" </option> ";
    }
    return result;
  }
  function delete_record(current_filter_id1)
  {
    $(".filter_row_"+current_filter_id1).remove();
  }
  function add_record()
  {
    $(".containing_filter").append('<div class="row filter_row_'+current_filter_id+'"> <div class="col-md-4"> <div class="form-group"> <label>Filter Column: </label> <div class="input-group"> <select id="key_'+current_filter_id+'" name="key_'+current_filter_id+'" class="form-control select2 key_filter" style="width: 100%;"> </select> </div> </div> </div> <div class="col-md-3"> <div class="form-group"> <label>Condition: </label> <div class="input-group"> <select id="condition_'+current_filter_id+'" name="" class="form-control select2 condition_filter" style="width: 100%;"> <option value="=" > equal </option> <option value=">" > greater </option> <option value="<" > less </option> <option value=">=" > greater equal </option> <option value="<=" > less equal </option> </select> </div> </div> </div> <div class="col-md-3"> <div class="form-group"> <label>Value</label> <div class="input-group"> <input type="text" name="value_'+current_filter_id+'" id="value_'+current_filter_id+'" placeholder="Enter fixed value" class="form-control value_filter"> </div> </div> </div> <div class="col-md-2"> <div class="form-group"> <label>&nbsp;</label> <a class="form-control pull-right btn btn-danger" id="delete_btn" onclick="delete_record('+current_filter_id+')">Delete</a> </div> </div> </div>');

    $("#key_"+current_filter_id).html(generate_option());
    current_filter_id++;
    $('.select2').select2();
  }

  $(document).ready(function() {
    // $('.appointment_nav').addClass('active');
    // $('.appointments_nav').addClass('active');
    $("#key").html(generate_option());
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