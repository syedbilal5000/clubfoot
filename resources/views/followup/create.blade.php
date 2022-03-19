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
          <h1 class="m-0">Add Follow UP</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="../home">Home</a></li>
            <li class="breadcrumb-item"><a href="../visit">Visit</a></li>
            <li class="breadcrumb-item active">Add Followup</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

{{-- Main Content --}}

<form id="visit_form" method="POST" action="add">
  @csrf
  <div>
    <h2 style="text-align:center;">Add New</h2>
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
          <label>Date: </label>
          <input type="date" name="visit_date" id="visit_date" value="@php echo date('Y-m-d');@endphp" class="form-control">
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label>Age: </label>
          <input type="text" name="age" id="age" class="form-control">
        </div>
      </div>
    </div><!-- row end -->
    <div class="row">
      <div class="col-md-4">
        <div class="form-group">
          <label>Relapse: </label>
          <input type="text" name="relapse" id="relapse" class="form-control">
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label>Size: </label>
          <input type="text" name="size" id="size" class="form-control">
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label>Hours: </label>
          <select id="hours" name="hours" class="form-control select2" style="width: 100%;">
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
          <label>Treatment: </label>
          <select id="treatment_drop" name="treatment" class="form-control select2" style="width: 100%;">
            <option value="3">Reassurance</option>
            <option value="4">New Brace</option>
            <option value="1">Casted</option>
            <option value="2">Tenotomy</option>
            <option value="5">Referred</option>
          </select>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label>Next Appointment: </label>
          <!-- <input type="date" name="next_visit_date" id="next_appointment" class="form-control" value="@php echo date('Y-m-d', strtotime('+1 week'));@endphp"> -->
          <select id="next_visit_date" name="next_visit_date" class="form-control select2" style="width: 100%;">
            <option value="1 week">1 week</option>
            <option value="2 weeks">2 weeks</option>
            <option value="1 month (4 weeks)">1 month (4 weeks)</option>
            <option value="2 months">2 months</option>
            <option value="3 months">3 months</option>
            <option value="6 months">6 months</option>
            <option value="1 year">1 year</option>
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
      </div>  <!-- row end -->
  </div>
  <br>
      <button type="submit" style="margin-bottom: 10px;" class="form-control btn btn-primary">Submit</button>
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
    $('.followup_nav').addClass('active');
    $('.followups_nav_add').addClass('active');
    $("#visit_form").validate();

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