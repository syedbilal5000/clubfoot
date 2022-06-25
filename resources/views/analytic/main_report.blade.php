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
          <label><input type="checkbox" name="patient_name" value="1"> &nbsp; Patient Name </label>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" name="father_name" value="1"> &nbsp; Father Name </label>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" name="gender" value="1"> &nbsp; Gender </label>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" name="birth_date" value="1"> &nbsp; DOB </label>
        </div>
      </div>
    </div>
  </div> <!-- row end -->
  <div class="row">
    <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" name="age" value="1"> &nbsp; age </label>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" name="address" value="1"> &nbsp; Address </label>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" name="icr_number" value="1"> &nbsp; ICR Number </label>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" name="inserted_at" value="1"> &nbsp; Registration Date </label>
        </div>
      </div>
    </div>
  </div> <!-- row end -->
  <div class="row">
    <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" name="guardian_name" value="1"> &nbsp; Guardian Name </label>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" name="guardian_number" value="1"> &nbsp; Guardian Number </label>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" name="guardian_cnic" value="1"> &nbsp; Guardian CNIC </label>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" name="relation_to_patient" value="1"> &nbsp; Guardian Relation </label>
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
          <label><input type="checkbox" name="evaluator_name" value="1"> &nbsp; Evaluator Name</label>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" name="evaluation_date" value="1"> &nbsp; Evaluation Date</label>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" name="evaluator_title" value="1"> &nbsp; Evaluator Title</label>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" name="feet_affected" value="1"> &nbsp; Feet Affected</label>
        </div>
      </div>
    </div>
  </div> <!-- row end -->
  <div class="row">
  <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" name="diagnosis" value="1"> &nbsp; Diagnosis</label>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" name="other_diagnosis" value="1"> &nbsp; Other Diagnosis</label>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" name="has_birth_deformity" value="1"> &nbsp; Has Birth Deformity</label>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" name="has_treated" value="1"> &nbsp; Has Treated</label>
        </div>
      </div>
    </div>
  </div> <!-- row end -->
  <div class="row">
    <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" name="treatments" value="1"> &nbsp; Treatments</label>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" name="treatment_type" value="1"> &nbsp; Treatment Type</label>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" name="has_diagnosed" value="1"> &nbsp; Has Diagnosed</label>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" name="preg_week" value="1"> &nbsp; pregnancy Week</label>
        </div>
      </div>
    </div>
  </div> <!-- row end -->
  <div class="row">
    <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" name="has_birth_confirmed" value="1"> &nbsp; Confirmed at birth</label>
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
          <label><input type="checkbox" name="visit_date" value="1"> &nbsp; visit_date</label>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" name="next_visit_date" value="1"> &nbsp; next_visit_date</label>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" name="side" value="1"> &nbsp; side</label>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" name="CLB" value="1"> &nbsp; CLB</label>
        </div>
      </div>
    </div>
    </div> <!-- row end -->
  <div class="row">
    <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" name="MC" value="1"> &nbsp; MC</label>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" name="LHT" value="1"> &nbsp; LHT</label>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" name="PC" value="1"> &nbsp; PC</label>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" name="RE" value="1"> &nbsp; RE</label>
        </div>
      </div>
    </div>
    </div> <!-- row end -->
  <div class="row">
    <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" name="EH" value="1"> &nbsp; EH</label>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" name="mid_foot_score" value="1"> &nbsp; mid_foot_score</label>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" name="hind_foot_score" value="1"> &nbsp; hind_foot_score</label>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" name="total_score" value="1"> &nbsp; total_score</label>
        </div>
      </div>
    </div>
    </div> <!-- row end -->
  <div class="row">
    <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" name="treatment" value="1"> &nbsp; treatment</label>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <div class="form-check form-check-inline" style="padding-top: 5px;">
          <label><input type="checkbox" name="complication" value="1"> &nbsp; complication</label>
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

  var patient_id = 0, output = '', st_dt, ed_dt, url, status_dict, keys, conditions, values, current_filter_id =2;
  var select_p = [], select_v = [], select_f = [];
  // var appoint_delayed = {! ! json_encode($appoint_delayed) ! !};
  
  // view_appoint_delayed(appoint_delayed);

  // function view_appoint_delayed(appoint_delayed) {
  //   url = '';
  //   status_dict = { 0: "-", 1: "Called", 2: "No Response", 3: "Wrong Number" };
  //   output = '';
  //   for (i = 0; i < appoint_delayed.length; i++) {
  //     patient_id = appoint_delayed[i]['patient_id'];
  //     url = `../patient/${patient_id}/edit`;
  //     output += `<tr><td><a href="${url}" class="txt_link">Pc-${appoint_delayed[i]['inserted_at'].substr(2,2)}|${patient_id}</a></td> `;
  //     output += `<td>${appoint_delayed[i]['patient_name']}</td> `;
  //     output += `<td>${appoint_delayed[i]['guardian_number']}</td> `;
  //     output += `<td>${appoint_delayed[i]['appointment_date']}</td> `;
  //     output += `<td>Pending</td> `;
  //     output += `<td>${status_dict[appoint_delayed[i]['reason']]}</td> `;
  //     output += `<td><a class="btn btn-success " onclick="setIDFunction(${appoint_delayed[i]['appointment_id']})"><i class="fa fa-plus"></i></a></td> `;
  //   }
  //   if (output == '') {
  //     output = `<tr class="odd"><td valign="top" colspan="8" class="dataTables_empty">No data available in table</td></tr>`;
  //   }
  //   $('#appoint_delayed').html(output);
  // }

  function setIDFunction(appointment_id)
  {
    $("#appointment_id").val(appointment_id)
  }
  // search records on query
  function search_records() {
    keys = Array.from($('.key_filter').get(), e => e.value);
    conditions = Array.from($('.condition_filter').get(), e => e.value);
    values = Array.from($('.value_filter').get(), e => e.value);
    $('input.patient:checkbox:checked').each(function () {
      select_p.push($(this).val());
    });
    $('input.visit:checkbox:checked').each(function () {
      select_v.push($(this).val());
    });
    $('input.followup:checkbox:checked').each(function () {
      select_f.push($(this).val());
    });
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
  function generate_option()
  {
    var data_lists = "patient_id, patient_name, father_name, gender, birth_date, address, address2, out_of_city, has_photo_consent, relation_to_patient, guardian_name, guardian_number, guardian_number_2, guardian_cnic, icr_number, donor_id, inserted_at";
    var data_list = data_lists.split(",");
    var result = "";
    for (var i = data_list.length - 1; i >= 0; i--) {
        result += "<option value="+ data_list[i]  +" > " +data_list[i]+" </option> ";
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