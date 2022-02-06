@extends('layouts.admin')

@section('content')
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
          <h1 class="m-0">Appointments</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="../home">Home</a></li>
            <li class="breadcrumb-item"><a href="../appointment">Appointment</a></li>
            <li class="breadcrumb-item active">Add Appointment</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

{{-- Main Content --}}
<form id="appoint_form" method="POST" action="add">
  @csrf
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <!-- bilals if coming from registration then patient and date will be select auto and id will maintain -->
            <label>Select Patient: </label><label style="color: red;"> &nbsp;*</label>
            <select id="patients" name="patient_id" class="form-control select2 @error('patient_id') is-invalid @enderror" style="width: 100%;" required>
              <option selected disabled>Select Patient</option>
            </select>
            @error('patient_id')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Appointment date: </label><label style="color: red;"> &nbsp;*</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-date"></i></span>
              <input type="date" name="appointment_date" id="appointment_date" class="form-control @error('appointment_date') is-invalid @enderror" required>
              @error('appointment_date')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>
        </div>
      </div>  <!-- row end -->
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Description: </label>
            <div class="input-group">
              <!-- <input type="text" name="appointment_description" class="form-control"> -->
              <textarea class="form-control" name="description" rows="3"></textarea>
            </div>
          </div>
        </div>
      </div>  <!-- row end -->
      <br>
      <button type="submit" style="margin-bottom: 10px;" class="form-control btn btn-primary">Submit</button>
    </div>
  </div>
</form>

<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
<!-- Page specific script -->
<script>
  var patients = {!! json_encode($patients) !!};
  var date = {!! json_encode($date) !!};
  var patient_id = {!! json_encode($patient_id) !!};
  $('#appointment_date').val(date);
  
  view_patients(patients);
  if (patient_id) {
    $('#patients').val(patient_id).change();
  }

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

  $(function () {
    $('.select2').select2();
    $('.appointment_nav').addClass('active');
    $('.appointments_nav_add').addClass('active');
    $("#appoint_form").validate();
    /*
    //bilals display all appointments in calender, change background color according to status of appointment.
    $.ajax({
      url: main_url+'meetingS/getAllMeeting.php?empid='+empid,                        
      type: 'GET',
      contentType: "application/x-www-form-urlencoded; charset=UTF-8",
      dataType: "json",
      complete : function(response){
        var data = response.responseText; 
        // console.log(data);       
        var jsonR = JSON.parse(data);                
        // console.log(calendar)
        $('#calendar').fullCalendar('renderEvents', jsonR, true);
      },
      error: function (exception)
      {
        console.log(exception);
        //alert(exception.responseText);
      }
    });
    */
    /* initialize the external events
     -----------------------------------------------------------------*/
    
  })
</script>
@endsection