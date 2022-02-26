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
          <h1 class="m-0">Donors</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="../home">Home</a></li>
            <li class="breadcrumb-item"><a href="../appointment">Donor</a></li>
            <li class="breadcrumb-item active">Add Donor</li>
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
            <label>First Name: </label><label style="color: red;"> &nbsp;*</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fa fa-user"></i></span>
              <input type="text" name="first_name" class="form-control" placeholder="Enter First Name" required>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Last Name: </label><label style="color: red;"> &nbsp;*</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fa fa-user"></i></span>
              <input type="text" name="last_name" class="form-control" placeholder="Enter Last Name" required>
            </div>
          </div>
        </div>
      </div>  <!-- div row end -->
      
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Email: </label><label style="color: red;"> &nbsp;*</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fa fa-user"></i></span>
              <input type="email" name="donor_email" class="form-control" placeholder="Enter Email" required>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Phone number: </label><label style="color: red;"> &nbsp;*</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fa fa-phone"></i></span>
              <input type="text" name="donor_number" class="form-control" data-inputmask='"mask": "0399-9999999"' data-mask required>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Address: </label>
            <div class="input-group">
              <span class="input-group-text"><i class="fa fa-home"></i></span>
              <input type="text" name="donor_address" placeholder="Enter Address" class="form-control">
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Select City: </label>
            <select id="cities" name="city_id" class="form-control select2" style="width: 100%;">
              <option selected disabled>Select City</option>
            </select>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Select State: </label>
            <select id="states" name="state_id" class="form-control select2" style="width: 100%;">
              <option selected disabled>Select State</option>
            </select>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Description: </label>
            <div class="input-group">
              <textarea class="form-control" name="donor_description" rows="3"></textarea>
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
<script src="{{ asset('adminlte/plugins/inputmask/jquery.inputmask.js') }}"></script>
<script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
<!-- Page specific script -->
<script>
  
  // view_patients(patients);
  
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
    $('.donor_nav').addClass('active');
    $('.donors_nav_add').addClass('active');
    $('[data-mask]').inputmask();
    // $("#appoint_form").validate();
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