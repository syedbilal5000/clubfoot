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
          <h1 class="m-0">Add Visit</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="../home">Home</a></li>
            <li class="breadcrumb-item"><a href="../visit">Visits</a></li>
            <li class="breadcrumb-item active">Add New Visit</li>
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
    <!-- <h2 style="text-align:center;">Add New Visit</h2> -->
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
          <label>Select Side: </label><label style="color: red;"> &nbsp;*</label>
          <select id="side_drop" name="side" class="form-control select2" style="width: 100%;" required>
            <option selected disabled hidden value="0">Select Side</option>
            <option value="L">Left</option>
            <option value="R">Right</option>
          </select>
          <span id="custlErrormsg" style="color: red;"></span>
        </div>
      </div>
    </div><!-- row end -->
    <h5>MidFoot Score</h5>
    <div class="row">
      <div class="col-md-4">
        <div class="form-group">
          <label>Select CLB: </label>
          <select id="clb_drop" name="CLB" class="form-control select2 score_dropd" style="width: 100%;">
            <option value="0.0">0.0</option>
            <option value="0.5">0.5</option>
            <option value="1.0">1.0</option>
          </select>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label>Select MC: </label>
          <select id="mc_drop" name="MC" class="form-control select2 score_dropd" style="width: 100%;">
            <option value="0.0">0.0</option>
            <option value="0.5">0.5</option>
            <option value="1.0">1.0</option>
          </select>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label>Select LHT: </label>
          <select id="lht_drop" name="LHT" class="form-control select2 score_dropd" style="width: 100%;">
            <option value="0.0">0.0</option>
            <option value="0.5">0.5</option>
            <option value="1.0">1.0</option>
          </select>
        </div>
      </div>
    </div> <!-- row end -->
    <h5>HindFoot Score</h5>
    <div class="row">
      <div class="col-md-4">
        <div class="form-group">
          <label>Select PC: </label>
          <select id="pc_drop" name="PC" class="form-control select2 score_dropd" style="width: 100%;">
            <option value="0.0">0.0</option>
            <option value="0.5">0.5</option>
            <option value="1.0">1.0</option>
          </select>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label>Select RE: </label>
          <select id="re_drop" name="RE" class="form-control select2 score_dropd" style="width: 100%;">
            <option value="0.0">0.0</option>
            <option value="0.5">0.5</option>
            <option value="1.0">1.0</option>
          </select>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label>Select EH: </label>
          <select id="eh_drop" name="EH" class="form-control select2 score_dropd" style="width: 100%;">
            <option value="0.0">0.0</option>
            <option value="0.5">0.5</option>
            <option value="1.0">1.0</option>
          </select>
        </div>
      </div>
    </div> <!-- row end -->
    <h5>Total Score</h5>
    <div class="row">
      <div class="col-md-4">
        <div class="form-group">
          <label>Midfoot Score: </label>
          <input type="text" name="mid_foot_score" id="midfoot_score" class="form-control" readonly style="cursor: not-allowed;">
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label>Hindfoot Score: </label>
          <input type="text" name="hind_foot_score" id="hindfoot_score" class="form-control" readonly style="cursor: not-allowed;">
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label>Total Score: </label>
          <input type="text" name="total_score" id="total_score" class="form-control" readonly style="cursor: not-allowed;">
        </div>
      </div>
    </div> <!-- row end -->
    <div class="row">
      <div class="col-md-4">
        <div class="form-group">
          <label>Select Treatment: </label>
          <select id="treatment_drop" name="treatment" class="form-control select2" style="width: 100%;">
            <option value="0" selected disabled hidden>Select Treatment</option>
            <option value="1">Casted</option>
            <option value="2">Tenotomy</option>
            <option value="3">Full Correction</option>
          </select>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label>Complication: </label>
          <input type="text" name="complication" class="form-control">
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label>Next Appointment: </label>
          <input type="date" name="next_visit_date" id="next_appointment" class="form-control nxt_date" value="@php echo date('Y-m-d', strtotime('+1 week'));@endphp">
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
    <div class="row">
    <div class="col-md-12" onclick="more_clickable(0);" style="cursor: pointer; text-decoration: underline; color: blue; text-align: right; margin-bottom: 10px;"><i class="fas fa-plus"></i> Add more</div></div>
  </div>
  <div id="add_another" style="display: none;">
    <h3 onclick="more_clickable(1);" style="cursor: pointer; text-decoration: underline;">Second</h3>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label>Date: </label>
          <input type="date" name="visit_date2" id="visit_date2" value="@php echo date('Y-m-d');@endphp" class="form-control">
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label>Select Side: </label><label style="color: red;"> &nbsp;*</label>
          <select id="side_drop2" name="side2" class="form-control select2" style="width: 100%;">
            <option selected disabled hidden value="0">Select Side</option>
            <option value="L">Left</option>
            <option value="R">Right</option>
          </select>
        </div>
      </div>
    </div><!-- row end -->
    <h5>MidFoot Score</h5>
    <div class="row">
      <div class="col-md-4">
        <div class="form-group">
          <label>Select CLB: </label>
          <select id="clb_drop2" name="CLB2" class="form-control select2 score_dropd2" style="width: 100%;">
            <option value="0.0">0.0</option>
            <option value="0.5">0.5</option>
            <option value="1.0">1.0</option>
          </select>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label>Select MC: </label>
          <select id="mc_drop2" name="MC2" class="form-control select2 score_dropd2" style="width: 100%;">
            <option value="0.0">0.0</option>
            <option value="0.5">0.5</option>
            <option value="1.0">1.0</option>
          </select>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label>Select LHT: </label>
          <select id="lht_drop2" name="LHT2" class="form-control select2 score_dropd2" style="width: 100%;">
            <option value="0.0">0.0</option>
            <option value="0.5">0.5</option>
            <option value="1.0">1.0</option>
          </select>
        </div>
      </div>
    </div> <!-- row end -->
    <h5>HindFoot Score</h5>
    <div class="row">
      <div class="col-md-4">
        <div class="form-group">
          <label>Select PC: </label>
          <select id="pc_drop2" name="PC2" class="form-control select2 score_dropd2" style="width: 100%;">
            <option value="0.0">0.0</option>
            <option value="0.5">0.5</option>
            <option value="1.0">1.0</option>
          </select>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label>Select RE: </label>
          <select id="re_drop2" name="RE2" class="form-control select2 score_dropd2" style="width: 100%;">
            <option value="0.0">0.0</option>
            <option value="0.5">0.5</option>
            <option value="1.0">1.0</option>
          </select>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label>Select EH: </label>
          <select id="eh_drop2" name="EH2" class="form-control select2 score_dropd2" style="width: 100%;">
            <option value="0.0">0.0</option>
            <option value="0.5">0.5</option>
            <option value="1.0">1.0</option>
          </select>
        </div>
      </div>
    </div> <!-- row end -->
    <h5>Total Score</h5>
    <div class="row">
      <div class="col-md-4">
        <div class="form-group">
          <label>Midfoot Score: </label>
          <input type="text" name="mid_foot_score2" id="midfoot_score2" class="form-control" disabled>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label>Hindfoot Score: </label>
          <input type="text" name="hind_foot_score2" id="hindfoot_score2" class="form-control" disabled>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label>Total Score: </label>
          <input type="text" name="total_score2" id="total_score2" class="form-control" disabled>
        </div>
      </div>
    </div> <!-- row end -->
    <div class="row">
      <div class="col-md-4">
        <div class="form-group">
          <label>Select Treatment: </label>
          <select id="treatment_drop2" name="treatment2" class="form-control select2" style="width: 100%;">
            <option value="1">Casted</option>
            <option value="2">Tenotomy</option>
            <option value="3">Full Correction</option>
          </select>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label>Complications: </label>
          <input type="text" name="complication2" id="complications2" class="form-control">
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label>Next Appointment: </label>
          <input type="date" name="next_visit_date2" id="next_appointment2" class="form-control nxt_date" value="@php echo date('Y-m-d', strtotime('+1 week'));@endphp">
        </div>
      </div>
    </div> <!-- row end -->
  </div>
  <br>
    <div class="row">
      <div class="col-md-8">
        <div class="form-group">
          <input class="form-control" type="file" name="img_file" style="padding-top: 3px;">
        </div>
      </div>
      <!-- <div class="col-md-3">
        <div class="form-group">
          <div class="form-check form-check-inline">
            <label style="padding-top: 5px;"> &nbsp;&nbsp; <input type="checkbox" name="is_payed" id="is_payed" value="1">&nbsp; Amount to be payed? </label> 
          </div>
        </div>
      </div> -->
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
    <button type="submit" style="margin-bottom: 10px;" class="form-control btn btn-primary" id="btn_submit">Submit</button>
  </div>
</form>
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/inputmask/jquery.inputmask.js') }}"></script>
<script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
<script>
  var patients = {!! json_encode($patients) !!};
  var date = {!! json_encode($date) !!};
  $(".nxt_date").val(date);
  
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
    $('.visit_nav').addClass('active');
    $('.visits_nav_add').addClass('active');
    $("#visit_form").validate();
    // check next_visit_date is not holiday
    $('#visit_form').submit(function () {
      let holidays_dict = {2: 5, 3: 23, 5: 1, 8: 14, 12: 25};
      let nxt_date = $("#next_appointment").val();
      let month = parseInt(nxt_date.substr(5, 2));
      let date = parseInt(nxt_date.substr(8, 2));
      if (month in holidays_dict && holidays_dict[month] == date) {
        alert("Please select another date for next appointment becuase you selected the holiday.");
        return false;
      } else if ($("#side_drop2").val() != null) {
        nxt_date = $("#next_appointment2").val();
        month = parseInt(nxt_date.substr(5, 2));
        date = parseInt(nxt_date.substr(8, 2));
        if (month in holidays_dict && holidays_dict[month] == date) {
          alert("Please select another date for next appointment becuase you selected the holiday in your second visit.");
          return false;
        }
      }
    });

    $(".score_dropd").on('change', function() {
      calculateScore();
    });
    $(".score_dropd2").on('change', function() {
      calculateScore2();
    });
    $('#patients').on('change', function() {
      let id = $("#patients").val();
        for (i = 0; i < patients.length; i++) {
          if(patients[i]['patient_id'] == id)
          {
            console.log(patients[i])
            if(patients[i]['feet_affected'] == "1")
            {
              $("#side_drop").val("R").change();
              $("#side_drop2").val("0").change();
            }
            else if(patients[i]['feet_affected'] == "2")
            {
              $("#side_drop").val("L").change();
              $("#side_drop2").val("0").change();
            }
            else if(patients[i]['feet_affected'] == "3")
              {
                console.log(3)
                $("#side_drop").val("L").change();
                $("#side_drop2").val("R").change();
                
                $('#add_another').css('display', 'block');
                $('#side_drop2').prop('required', true);
              }
          }
        }
     });

    $("#btn_submit").on('click', function() {
      if ($("#is_emailed").prop('checked') == true){ 
        console.log("email send karo")
      }
    })
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