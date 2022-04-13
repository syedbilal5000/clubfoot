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
  <div class="content-header" style="padding-left: 0px;">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Add Donor</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="../home">Home</a></li>
            <li class="breadcrumb-item"><a href="../appointment">Donors</a></li>
            <li class="breadcrumb-item active">Add New Donor</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

{{-- Main Content --}}
<form id="donor_form" method="POST" action="add">
  @csrf
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
          <label>Last Name: </label>
          <div class="input-group">
            <span class="input-group-text"><i class="fa fa-user"></i></span>
            <input type="text" name="last_name" class="form-control" placeholder="Enter Last Name">
          </div>
        </div>
      </div>
    </div>  <!-- div row end -->
    
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label>Phone number: </label><label style="color: red;"> &nbsp;*</label>
          <div class="input-group">
            <span class="input-group-text"><i class="fa fa-phone"></i></span>
            <input type="text" name="donor_number" class="form-control" data-inputmask='"mask": "0399-9999999"' data-mask required>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label>Email: </label>
          <div class="input-group">
            <span class="input-group-text"><i class="fa fa-user"></i></span>
            <input type="email" name="email" class="form-control" placeholder="Enter Email">
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
          <select id="cities" name="city_id" class="form-control select2" onchange="get_state(this.value)" style="width: 100%;">
            <option selected disabled>Select City</option>
            <option value="0">Other</option>
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
            <textarea class="form-control" name="description" rows="3"></textarea>
          </div>
        </div>
      </div>
    </div>  <!-- row end -->
    <br>
    <button type="submit" style="margin-bottom: 10px;" class="form-control btn btn-primary">Submit</button>
  </div>
</form>

<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/inputmask/jquery.inputmask.js') }}"></script>
<script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
<!-- Page specific script -->
<script>
  
  var output = '', output2 = '', states = {};
  var cities = {!! json_encode($cities) !!};
  view_cities(cities);
  
  function view_cities(patients) {
    // output = '<option value="">Select City</option>';
    if (cities.length > 0) {
        // iterate over cities
        for (i = 0; i < cities.length; i++) {
          output += `<option value="${cities[i]['city_id']}">${patients[i]['city']}</option>`;
          if (!states[cities[i]['state']]) {
            states[cities[i]['state']] = cities[i]['state'];
          }
        }
        // iterate over states
        for(var key in states) {
          output2 += `<option value="${states[key]}">${key}</option>`;
        }
    } else {
        output = '<option value="-1">No Data</option>';
    }
    $('#cities').append(output);
    $('#states').append(output2);
  }

  function get_state(val) {
    // when val is not 0, not for "Other" case
    if (val != 0){
      // substract 1 from val because index starts from 0, then with state get the state from cities, then get state from states
      $("#states").val(states[cities[val-1]['state']]).change();
    }
  }

  $(function () {
    $('.select2').select2();
    $('.donor_nav').addClass('active');
    $('.donors_nav_add').addClass('active');
    $('[data-mask]').inputmask();
    $("#donor_form").validate();
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