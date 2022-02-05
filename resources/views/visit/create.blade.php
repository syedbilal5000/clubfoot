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
          <h1 class="m-0">Visits</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="../home">Home</a></li>
            <li class="breadcrumb-item"><a href="../visit">Visit</a></li>
            <li class="breadcrumb-item active">Add Visit</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

{{-- Main Content --}}

<form method="POST" action="Visits/add">
  @csrf
  <div>
    <h2 style="text-align:center;">Add New Visit</h2>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label>Date: </label>
          <input type="date" name="visit_date" id="visit_date" class="form-control">
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label>Side: </label>
          <select id="side_drop" class="form-control select2" style="width: 100%;">
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
          <label>CLB: </label>
          <select id="clb_drop" class="form-control select2 score_dropd" style="width: 100%;">
            <option value="0.0">0.0</option>
            <option value="0.5">0.5</option>
            <option value="1.0">1.0</option>
          </select>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label>MC: </label>
          <select id="mc_drop" class="form-control select2 score_dropd" style="width: 100%;">
            <option value="0.0">0.0</option>
            <option value="0.5">0.5</option>
            <option value="1.0">1.0</option>
          </select>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label>LHT: </label>
          <select id="lht_drop" class="form-control select2 score_dropd" style="width: 100%;">
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
          <label>PC: </label>
          <select id="pc_drop" class="form-control select2 score_dropd" style="width: 100%;">
            <option value="0.0">0.0</option>
            <option value="0.5">0.5</option>
            <option value="1.0">1.0</option>
          </select>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label>RE: </label>
          <select id="re_drop" class="form-control select2 score_dropd" style="width: 100%;">
            <option value="0.0">0.0</option>
            <option value="0.5">0.5</option>
            <option value="1.0">1.0</option>
          </select>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label>EH: </label>
          <select id="eh_drop" class="form-control select2 score_dropd" style="width: 100%;">
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
          <input type="text" disabled name="midfoot_score" id="midfoot_score" class="form-control">
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label>Hindfoot Score: </label>
          <input type="text" disabled name="hindfoot_score" id="hindfoot_score" class="form-control">
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label>Total Score: </label>
          <input type="text" disabled name="total_score" id="total_score" class="form-control">
        </div>
      </div>
    </div> <!-- row end -->
    <div class="row">
      <div class="col-md-4">
        <div class="form-group">
          <label>Treatment: </label>
          <select id="treatment_drop" class="form-control select2" style="width: 100%;">
            <option value="1">Casted</option>
            <option value="2">Tenotomy</option>
          </select>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label>Complications: </label>
          <input type="text" name="complications" id="complications" class="form-control">
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label>Next Appointment: </label>
          <input type="date" name="next_appointment" id="next_appointment" class="form-control" value="@php echo date('Y-m-d', strtotime('+1 week'));@endphp">
        </div>
      </div>
    </div> <!-- row end -->
    <div class="row">
    <div class="col-md-12" onclick="more_clickable(0);" style="cursor: pointer; text-decoration: underline; color: blue; text-align: right; margin-bottom: 10px;"><i class="fas fa-plus"></i> Add more</div></div>
  </div>
  <div id="add_another" style="display: none;">
    <h3 onclick="more_clickable(1);" style="cursor: pointer; text-decoration: underline;">Second</h3>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label>Date: </label>
          <input type="date" name="visit_date2" id="visit_date2" class="form-control">
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label>Side: </label>
          <select id="side_drop2" class="form-control select2" style="width: 100%;">
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
          <label>CLB: </label>
          <select id="clb_drop2" class="form-control select2 score_dropd2" style="width: 100%;">
            <option value="0.0">0.0</option>
            <option value="0.5">0.5</option>
            <option value="1.0">1.0</option>
          </select>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label>MC: </label>
          <select id="mc_drop2" class="form-control select2 score_dropd2" style="width: 100%;">
            <option value="0.0">0.0</option>
            <option value="0.5">0.5</option>
            <option value="1.0">1.0</option>
          </select>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label>LHT: </label>
          <select id="lht_drop2" class="form-control select2 score_dropd2" style="width: 100%;">
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
          <label>PC: </label>
          <select id="pc_drop2" class="form-control select2 score_dropd2" style="width: 100%;">
            <option value="0.0">0.0</option>
            <option value="0.5">0.5</option>
            <option value="1.0">1.0</option>
          </select>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label>RE: </label>
          <select id="re_drop2" class="form-control select2 score_dropd2" style="width: 100%;">
            <option value="0.0">0.0</option>
            <option value="0.5">0.5</option>
            <option value="1.0">1.0</option>
          </select>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label>EH: </label>
          <select id="eh_drop2" class="form-control select2 score_dropd2" style="width: 100%;">
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
          <input type="text" disabled name="midfoot_score2" id="midfoot_score2" class="form-control">
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label>Hindfoot Score: </label>
          <input type="text" disabled name="hindfoot_score2" id="hindfoot_score2" class="form-control">
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label>Total Score: </label>
          <input type="text" disabled name="total_score2" id="total_score2" class="form-control">
        </div>
      </div>
    </div> <!-- row end -->
    <div class="row">
      <div class="col-md-4">
        <div class="form-group">
          <label>Treatment: </label>
          <select id="treatment_drop2" class="form-control select2" style="width: 100%;">
            <option value="Casted">Casted</option>
            <option value="Tenotomy">Tenotomy</option>
          </select>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label>Complications: </label>
          <input type="text" name="complications2" id="complications2" class="form-control">
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label>Next Appointment: </label>
          <input type="date" name="next_appointment2" id="next_appointment2" class="form-control" value="@php echo date('Y-m-d', strtotime('+1 week'));@endphp">
        </div>
      </div>
    </div> <!-- row end -->
  </div>
</form>
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
<script>
  $(function () {
    $('.select2').select2();
    $('.visit_nav').addClass('active');
    $('.visits_nav_add').addClass('active');
    $(".score_dropd").on('change', function() {
      calculateScore();
    })
    $(".score_dropd2").on('change', function() {
      calculateScore2();
    })
    // $("#appoint_form").validate();
  });

  function more_clickable(is_hide=0) {
    if(is_hide == 0) {
      $('#add_another').css('display', 'block');
    }
    else {
      $('#add_another').css('display', 'none');
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