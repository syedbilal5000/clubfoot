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
          <h1 class="m-0">Add Follow-Up</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="../home">Home</a></li>
            <li class="breadcrumb-item"><a href="../visit">Visits</a></li>
            <li class="breadcrumb-item active">Add New Followup</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

{{-- Main Content --}}

<form id="visit_form" method="POST" action="add" enctype="multipart/form-data">
  @csrf
  <div class="container-fluid">
  <div>
    <!-- <h2 style="text-align:center;">Add New Follow-Up</h2> -->
    <div class="row">
      <div class="col-md-4">
        <div class="form-group">
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
      <div class="col-md-4">
        <div class="form-group">
          <label>Date: </label><label style="color: red;"> &nbsp;*</label>
          <input type="date" name="visit_date" id="visit_date" value="@php echo date('Y-m-d');@endphp" class="form-control" required>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label>Age: </label>
          <input type="text" name="age" id="age" class="form-control" placeholder="This should be auto fill when patient selected" disabled>
        </div>
      </div>
      <!-- <div class="col-md-4">
        <div id="show_relapse" class="form-group" style="display: none;">
          <label>Relapse Condition: </label>
          <br>
          <div class="form-check form-check-inline">
            <label> <input class="form-check-input" type="radio" name="relapse_val" id="relapse_val1" onclick="set_relapse(1)"> Early </label>
          </div>
          <div class="form-check form-check-inline">
            <label> <input class="form-check-input" type="radio" name="relapse_val" id="relapse_val2" onclick="set_relapse(2)"> Late </label>
          </div>
        </div>
      </div> -->
      <!-- <input type="text" name="relapse_condition" id="relapse_condition" value="0" style="display: none;"> -->
    </div><!-- row end -->
    <div class="row">
      <div class="col-md-4">
        <div class="form-group">
          <label>Select Relapse: </label>
          <select id="relapse" name="relapse" class="form-control select2" style="width: 100%;">
            <option disabled hidden selected>Select Relapse</option>
            <option value="0">NONE</option>
            <option value="11">VARUS - Early</option>
            <option value="12">VARUS - Late</option>
            <option value="21">CAVUS - Early</option>
            <option value="22">CAVUS - Late</option>
            <option value="31">EQUINUS - Early</option>
            <option value="32">EQUINUS - Late</option>
          </select>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label>Size: </label>
          <input type="number" name="size" id="size" class="form-control" placeholder="Enter Size">
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label>Select Hours: </label>
          <select id="hours" name="hours" class="form-control select2" style="width: 100%;">
            <option value="0" disabled hidden selected>Select Hours</option>
            <option value="12">12</option>
            <option value="16">16</option>
            <option value="23">23</option>
          </select>
        </div>
      </div>
    </div> <!-- row end -->
    <div class="row">
      <div class="col-md-4">
        <div class="form-group">
          <label>Select Treatment: </label>
          <select id="treatment_drop" name="treatment" class="form-control select2" style="width: 100%;">
            <option value="0" disabled hidden selected>Select Treatment</option>
            <option value="3">Reassurance</option>
            <option value="4">New Brace</option>
            <option value="6">Change Brace</option>
            <option value="7">Completed</option>
            <option value="1">Casted</option>
            <option value="2">Tenotomy</option>
            <option value="5">Referred</option>
          </select>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label>Select Next Appointment: </label>
          <!-- <input type="date" name="next_visit_date" id="next_appointment" class="form-control" value="@php echo date('Y-m-d', strtotime('+1 week'));@endphp"> -->
          <select id="next_appointment" name="next_visit_date" class="form-control select2" style="width: 100%;">
            <option value="0" disabled hidden selected>Select Next Appointment</option>
            <option value="1">1 week</option>
            <option value="2">2 weeks</option>
            <option value="4">1 month</option>
            <option value="8">2 months</option>
            <option value="12">3 months</option>
            <option value="24">6 months</option>
            <option value="48">1 year</option>
          </select>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label>Select Site: </label>
          <select id="is_virtual" name="is_virtual" class="form-control select2" style="width: 100%;">
            <option disabled hidden>Select Site</option>
            <option value="0">Live</option>
            <option value="1">Virtual</option>
          </select>
        </div>
      </div>
    </div> <!-- row end -->
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label>Description: </label>
          <div class="input-group">
            <!-- <input type="text" name="appointment_description" class="form-control"> -->
            <textarea class="form-control" name="description" rows="2"></textarea>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-8">
        <div class="form-group">
          <input class="form-control" type="file" name="img_file" style="padding-top: 3px;">
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <!-- <br> -->
          <div class="form-check form-check-inline">
            <label style="padding-top: 5px;"> &nbsp;&nbsp; <input type="checkbox" name="is_emailed" id="is_emailed" value="1">&nbsp; Email send to donor? </label> 
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label>Amount Payed: </label>
          <input type="number" name="amount_payed" id="amount_payed" class="form-control" placeholder="Enter Amount Payed to Patient, If Any.">
        </div>
      </div>
    </div>    <!-- div row end -->
  </div>
    <button type="submit" style="margin-bottom: 10px;" class="form-control btn btn-primary">Submit</button>
  </div>
</form>
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/inputmask/jquery.inputmask.js') }}"></script>
<script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
<script>
  var patients = {!! json_encode($patients) !!};
  
  view_patients(patients);
  
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
            output += `<option value="${patients[i]['patient_id']}">${patients[i]['patient_id']},${patients[i]['patient_name']},${patients[i]['guardian_number']},${patients[i]['guardian_cnic']}</option>`;
          }
        }
    } else {
        output = '<option value="-1">No Data</option>';
    }
    $('#patients').html(output);
  }

  $(function () {
    $('.select2').select2();
    $('.followup_nav').addClass('active');
    $('.followups_nav_add').addClass('active');
    $("#visit_form").validate();
    // check next_visit_date is not holiday
    $('#visit_form').submit(function () {
      let holidays_dict = {2: 5, 3: 23, 5: 11, 8: 14, 12: 25};
      let numWeeks = parseInt($("#next_appointment").val());
      let now = new Date();
      now.setDate(now.getDate() + numWeeks * 7);
      let month = now.getMonth() + 1;
      let date = now.getDate();
      let nxt_date = now.getFullYear()  + "-" + month + "-" + date;
      if (month in holidays_dict && holidays_dict[month] == date) {
        alert("Please select another date (week) for next appointment becuase you selected the holiday.");
        return false;
      }
    });

    $('#patients').on('change', function() {
      let id = $("#patients").val();
        for (i = 0; i < patients.length; i++) {
          if(patients[i]['patient_id'] == id)
          {
            $("#age").val(getAge(patients[i]['birth_date']));
          }
        }
     });
  });

  // function view_relapse(chk) {
  //   $("#relapse_val1").prop("checked", false);
  //   $("#relapse_val2").prop("checked", false);
  //   $("#relapse_condition").val("0");
  //   if (chk != "0") {
  //     $("#show_relapse").css("display", "block");
  //   } else {
  //     $("#show_relapse").css("display", "none");
  //   }
  // }

  // function set_relapse(val) {
  //   $('#relapse_condition').val(val);
  // }

  function getAge(dateString) {
    var now = new Date();
    var today = new Date(now.getYear(),now.getMonth(),now.getDate());

    var yearNow = now.getYear();
    var monthNow = now.getMonth();
    var dateNow = now.getDate();

      // 09/09/1989
    var dob = new Date(dateString.substring(0, 4),
                       dateString.substring(5, 7)-1,                   
                       dateString.substring(8, 10)                  
                       );

    var yearDob = dob.getYear();
    var monthDob = dob.getMonth();
    var dateDob = dob.getDate();
    var age = {};
    var ageString = "";
    var yearString = "";
    var monthString = "";
    var dayString = "";


    yearAge = yearNow - yearDob;

    if (monthNow >= monthDob)
      var monthAge = monthNow - monthDob;
    else {
      yearAge--;
      var monthAge = 12 + monthNow -monthDob;
    }

    if (dateNow >= dateDob)
      var dateAge = dateNow - dateDob;
    else {
      monthAge--;
      var dateAge = 31 + dateNow - dateDob;

      if (monthAge < 0) {
        monthAge = 11;
        yearAge--;
      }
    }

    age = {
        years: yearAge,
        months: monthAge,
        days: dateAge
        };

    if ( age.years > 1 ) yearString = " years";
    else yearString = " year";
    if ( age.months> 1 ) monthString = " months";
    else monthString = " month";
    if ( age.days > 1 ) dayString = " days";
    else dayString = " day";


    if ( (age.years > 0) && (age.months > 0) && (age.days > 0) )
      ageString = age.years + yearString + ", " + age.months + monthString + ", and " + age.days + dayString + " old.";
    else if ( (age.years == 0) && (age.months == 0) && (age.days > 0) )
      ageString = "Only " + age.days + dayString + " old!";
    else if ( (age.years > 0) && (age.months == 0) && (age.days == 0) )
      ageString = age.years + yearString + " old. Happy Birthday!!";
    else if ( (age.years > 0) && (age.months > 0) && (age.days == 0) )
      ageString = age.years + yearString + " and " + age.months + monthString + " old.";
    else if ( (age.years == 0) && (age.months > 0) && (age.days > 0) )
      ageString = age.months + monthString + " and " + age.days + dayString + " old.";
    else if ( (age.years > 0) && (age.months == 0) && (age.days > 0) )
      ageString = age.years + yearString + " and " + age.days + dayString + " old.";
    else if ( (age.years == 0) && (age.months > 0) && (age.days == 0) )
      ageString = age.months + monthString + " old.";
    else ageString = "Oops! Could not calculate age!";

    return ageString;
  }
</script>
@endsection