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
          <input type="text" name="hours" id="hours" class="form-control">
        </div>
      </div>
    </div> <!-- row end -->
    <div class="row">
      <div class="col-md-4">
        <div class="form-group">
          <label>Treatment: </label>
          <select id="treatment_drop" name="treatment" class="form-control select2" style="width: 100%;">
            <option value="1">Casted</option>
            <option value="2">Tenotomy</option>
          </select>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label>Next Appointment: </label>
          <input type="date" name="next_visit_date" id="next_appointment" class="form-control" value="@php echo date('Y-m-d', strtotime('+1 week'));@endphp">
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
    $(".score_dropd").on('change', function() {
      calculateScore();
    });
    $(".score_dropd2").on('change', function() {
      calculateScore2();
    });
    $("#visit_form").validate();
  });

  function more_clickable(is_hide=0) {
    if(is_hide == 0) {
      $('#add_another').css('display', 'block');
      $('#side_drop2').prop('required', true);
    }
    else {
      $('#add_another').css('display', 'none');
      $('#side_drop2').prop('required', false);
    }
  }

  function calculateScore() {
    var clb_drop = $("#clb_drop").val();
    var mc_drop = $("#mc_drop").val();
    var lht_drop = $("#lht_drop").val();
    var pc_drop = $("#pc_drop").val();
    var re_drop = $("#re_drop").val();
    var eh_drop = $("#eh_drop").val();

    var midfoot_score = parseFloat(clb_drop) + parseFloat(mc_drop) + parseFloat(lht_drop);
    var hindfoot_score = parseFloat(pc_drop) + parseFloat(re_drop) + parseFloat(eh_drop);

    $("#midfoot_score").val(midfoot_score);
    $("#hindfoot_score").val(hindfoot_score);
    $("#total_score").val(midfoot_score + hindfoot_score);

  }

  function calculateScore2() {
    var clb_drop = $("#clb_drop2").val();
    var mc_drop = $("#mc_drop2").val();
    var lht_drop = $("#lht_drop2").val();
    var pc_drop = $("#pc_drop2").val();
    var re_drop = $("#re_drop2").val();
    var eh_drop = $("#eh_drop2").val();

    var midfoot_score = parseFloat(clb_drop) + parseFloat(mc_drop) + parseFloat(lht_drop);
    var hindfoot_score = parseFloat(pc_drop) + parseFloat(re_drop) + parseFloat(eh_drop);

    $("#midfoot_score2").val(midfoot_score);
    $("#hindfoot_score2").val(hindfoot_score);
    $("#total_score2").val(midfoot_score + hindfoot_score);

  }
</script>
@endsection