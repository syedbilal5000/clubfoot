@extends('layouts.admin')

@section('content')
<style type="text/css">
  .fc-view>table {
    background-color: white;
  }
  .select2-selection {
    height: unset !important;
    border: 1px solid #ced4da !important;
    border-radius: unset !important;
    padding: 0.375rem .75rem !important;
  }
</style>
<link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('adminlte/plugins/dataTables-buttons/css/buttons.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/css/select2.min.css') }}">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Appointments</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="home">Home</a></li>
            <li class="breadcrumb-item active">Appointment Page</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
{{-- Main Content --}}
<form action="appointment/update" method="POST" id="appoint_form">
  @csrf
<div class="content">
<div class="container-fluid">
  <div class="row">
    <div class="col-md-4">
      <div class="form-group">
        <label>Date (MM/DD/YYYY): </label>
        <div class="input-group">
          <input type="date" name="change_date" class="form-control" id="date_text" required
          value="@php echo date('Y-m-d');@endphp">
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label>Status: </label>
        <select id="status_text" name="change_status" class="form-control select2" style="width: 100%;">
          <option value="">Select </option>
          <option value="2">Pending</option>
          <option value="1">Done</option>
          <option value="3">Reject</option>
          <option value="4">Extend</option>
        </select>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label>&nbsp;</label>
        <a class="form-control pull-right btn btn-primary" onclick="update_bulk_record()">Update All</a>
      </div>
    </div>
  </div> <!-- div row end -->
  <br><hr>
  <div class="row">
    <div class="col-md-9"></div>
    <div class="col-md-3">
      <div class="form-group">
        <label>Select Status: </label>
        <select id="status_drop" class="form-control select2" style="width: 100%;">
          <option value="Pending">Pending</option>
          <option value="Done">Done</option>
          <option value="Reject">Reject</option>
          <option value="Extend">Extend</option>
        </select>
      </div>
    </div>
  </div> <!-- div row end -->
  <div class="row">
    <div class="col-md-12">
      <table id="appoint_table" class="table table-striped table-bordered" style="width:100% !important;">
        <thead>
            <tr>
                <th>
                  <div class="form-check form-check-inline">
                    <label> <input class="form-check-input" type="checkbox" name="" value="" id="select_all"> Select All </label>
                  </div>
                </th>
                <th>Registration Number</th>
                <th>Patient Name</th>
                <th>Guardian CNIC</th>
                <th>Guardian Number</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody id="appoint_table_body">
            <!-- <tr>
                <td>Donna Snider</td>
                <td>Customer Support</td>
                <td>New York</td>
                <td>27</td>
                <td>27</td>
                <td>2011/01/25</td>                
            </tr> -->
        </tbody>
        <tfoot>
            <tr>
                <th></th>
                <th>Registration Number</th>
                <th>Patient Name</th>
                <th>Guardian CNIC</th>
                <th>Guardian Number</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
        </tfoot>
      </table>
      <input type="hidden" name="appoint_ids[]" id="appoint_ids">
      <input type="hidden" name="is_date" value="0" id="is_date">
      <input type="hidden" name="is_status" value="0" id="is_status">
    </form>
    </div>
  </div> <!-- row end -->
</div>

<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/dataTables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/dataTables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/ajax/libs/jszip.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/ajax/libs/pdfmake.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/ajax/libs/vfs_fonts.js') }}"></script>

<!-- Page specific script -->
<script type="text/javascript">
  var date_changed = false;
  $(function () {
    $('.appointment_nav').addClass('active');
    $('.appointments_nav').addClass('active');
    $('.select2').select2();

    $("#date_text").on('change', function() {
      date_changed = true;
    })
    $("#select_all").on('change', function() {
      var items = document.getElementsByName('all_appointment_check');
      for (var i = 0; i < items.length; i++) {
        // console.log(items[i]);
        if (items[i].type == 'checkbox') {
          console.log(items[i]);
          items[i].checked = $("#select_all").is(":checked");
          console.log(items[i]);
        }
      }
    });
    $("#status_drop").on('change', function() {
      let status = $("#status_drop").val();
      @inject('service', 'App\\Http\\Controllers\\HomeController')

      var data = "";
      if(status == "Pending")
        data = {!! json_encode($service->get_data_appoint("Pending")) !!};
      else if(status == "Done")
        data = {!! json_encode($service->get_data_appoint("Done")) !!};
      else if(status == "Reject")
        data = {!! json_encode($service->get_data_appoint("Reject")) !!};
      else if(status == "Extend")
        data = {!! json_encode($service->get_data_appoint("Extend")) !!};
      fill_data(data) //bilals
    })
    
    var patients_appoint = {!! json_encode($patients_appoint) !!};
  
    fill_data(patients_appoint);

    function fill_data(patients_appoint) {
      output = '';
      const days = ["Sun", "Mon", "Tue", "Wed", "Thur", "Fri", "Sat"];
      if (patients_appoint.length > 0) {
          for (i = 0; i < patients_appoint.length; i++) {
              const newdate = new Date(patients_appoint[i]['appointment_date']);
              patient_id = patients_appoint[i]['patient_id'];
              output += `<tr><td><input type="checkbox" class="appoint_chk" name="all_appointment_check" value="${patients_appoint[i]['appointment_id']}"></td><td>${patients_appoint[i]['patient_id']}</td><td>${patients_appoint[i]['patient_name']}</td><td>${patients_appoint[i]['guardian_cnic']}</td><td>${patients_appoint[i]['guardian_number']}</td><td>`+days[newdate.getDay()] + ` ` +newdate.toLocaleDateString() +`</td><td>${patients_appoint[i]['status']}</td></tr>`;
          }
      }
      $("#appoint_table_body").html(output);
    }    
  })
  $(document).ready(function() {
    $('#appoint_table').DataTable( {
      dom: 'Bfrtip',
      buttons: [
        {
          extend: 'copyHtml5',
          exportOptions: {
            columns: ':gt(0)'  // indexes of the columns that should be printed,
          }
        },
        {
          extend: 'excelHtml5',
          exportOptions: {
            columns: ':gt(0)'  // indexes of the columns that should be printed,
          }
        },
        {
          extend: 'csvHtml5',
          exportOptions: {
            columns: ':gt(0)'  // indexes of the columns that should be printed,
          }
        },
        {
          extend: 'pdfHtml5',
          exportOptions: {
            columns: ':gt(0)'  // indexes of the columns that should be printed,
          }
        }
      ]
    });

    // function checkAll(){
    //   console.log($("#select_all").val());
    //   // var items = document.getElementsByName('brand');
    //   // for (var i = 0; i < items.length; i++) {
    //   //   if (items[i].type == 'checkbox')
    //   //       items[i].checked = true;
    //   // }
    // }
  });
  function update_bulk_record()
  {
    var ids = [];
    //bilals data update on appointment db
    // $("#appoint_ids").val(appoint_ids);
    // alert($("input[name='all_appointment_check']").val());
    $("input[name='all_appointment_check']").each(function (index, obj) {
      if ($(this).is(":checked")) {
        ids.push($(this).val());
      }
      //   // console.log($(this).val());      //id of 
      //   if(date_changed && $("#status_drop").val() != "") {
      //     // both data changed
      //   } else if($("#status_drop").val() != "") {
      //     //only status changed
      //   } else if(date_changed ) {
      //     //only date changed
      //   }
    });
    if(ids.length > 0) {
      if(date_changed || $("#status_text").val() != "") {
        if(date_changed && $("#status_text").val() != "") {
          // both data changed
          $("#is_date").val(1);
          $("#is_status").val(1);
          // alert(1);
        } else if($("#status_text").val() != "") {
          //only status changed
          $("#is_status").val(1);
          // alert($("#status_text").val());
        } else if(date_changed ) {
          //only date changed
          $("#is_date").val(1);
          // alert(3);
        }
        $("#appoint_ids").val(ids);
        $('#appoint_form').submit();
      } else {
        alert("Please select field to change.");
      }
    } else {
      alert("Please select row(s) to change.");
    }
  }
</script>
@endsection