@extends('layouts.admin')

@section('content')
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
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <!-- bilals if coming from registration then patient and date will be select auto and id will maintain -->
          <label>Select Patient: </label>
          <select id="patients" class="form-control select2" style="width: 100%;">
          </select>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label>Appointment date: </label><label style="color: red;"> &nbsp;*</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-date"></i></span>
            <input type="date" name="appointment_date" class="form-control">
          </div>
        </div>
      </div>
    </div>  <!-- row end -->
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label>Description: </label><label style="color: red;"> &nbsp;*</label>
          <div class="input-group">
            <input type="text" name="appointment_description" class="form-control">
          </div>
        </div>
      </div>
    </div>  <!-- row end -->
    <br>
    <!-- bilals save appointment in the table -->
    <button type="submit" style="margin-bottom: 10px;" class="form-control btn btn-primary">Submit</button>
  </div>
</div>

<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
<!-- Page specific script -->
<script>
  var patients = {!! json_encode($patients) !!};
  
  view_patients(patients);

  function view_patients(patients) {
    output = '';
    if (patients.length > 0) {
        for (i = 0; i < patients.length; i++) {
            output += `<option value="${patients[i]['patient_id']}">${patients[i]['patient_name']}</option>`
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