@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('adminlte/plugins/dataTables-buttons/css/buttons.dataTables.min.css') }}">
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
          <h1 class="m-0">Follow up</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="home">Home</a></li>
            <li class="breadcrumb-item active">Follow up</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

{{-- Main Content --}}

<form method="POST" action="#">
  @csrf
  <div>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label>Select Patient: </label>
          <select id="patients" class="form-control select2" style="width: 100%;">
            <option selected disabled>Select Patient</option>
          </select>
        </div>
      </div>
    </div>  <!-- row end -->
    <div class="row">
      <div class="col-md-12 table-responsive">
        <div class="form-group">
          <table id="visit_table" class="table table-striped table-bordered" style="width:100% !important;">
            <thead class="table_header">
              <tr>
              <th>Date</th>
              <th>Age</th>
              <th>Relapse</th>
              <th>Hindfoot Score</th>
              <th>Total Score</th>
              <th>Treatment</th>
              <th>Complications</th>
              <th>Next App</th>
              </tr>
            </thead> 
            <tbody id="table_body">
            </tbody>
              <!-- bilals get all visits from database when drop down data change-->
            <tfoot>
              <tr>
              <th>Date</th>
              <th>Age</th>
              <th>Relapse</th>
              <th>Hindfoot Score</th>
              <th>Total Score</th>
              <th>Treatment</th>
              <th>Complications</th>
              <th>Next App</th>
              </tr>
            </tfoot>
            
          </table>
        </div>
      </div>
    </div>  <!-- row end -->
    <hr><br>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label>Total no of Cast: </label>
          <input type="text" name="no_cast" id="no_cast" class="form-control" disabled>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label>Total no of Recast: </label>
          <input type="text" name="no_recast" id="no_recast" class="form-control" disabled>
        </div>
      </div>
    </div> <!-- row end -->
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label>Date of Tenotomy: </label>
          <input type="text" name="date_tenotomy" id="date_tenotomy" class="form-control" disabled>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label>Date of Tenotomy: </label>
          <input type="text" name="date_retenotomy" id="date_retenotomy" class="form-control" disabled>
        </div>
      </div>
    </div> <!-- row end -->
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label>Time Duration: </label>
          <input type="text" name="time_tenotomy" id="time_tenotomy" class="form-control" disabled>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label>Time Duration: </label>
          <input type="text" name="time_retenotomy" id="time_retenotomy" class="form-control" disabled>
        </div>
      </div>
    </div> <!-- row end -->
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label>Date of Brace Application: </label>
          <input type="text" name="brace_app_tenotomy" id="brace_app_tenotomy" class="form-control" disabled>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label>Date of Brace Application: </label>
          <input type="text" name="brace_app_retenotomy" id="brace_app_retenotomy" class="form-control" disabled>
        </div>
      </div>
    </div> <!-- row end -->
    <hr><br>
    <div class="row">
      <div class="col-md-12 table-responsive">
        <div class="form-group">
          <table id="followup_table" class="table table-striped table-bordered" style="width:100% !important;">
            <thead class="table_followup_header">
              <tr style="text-align:center;">
                <th colspan="2">Follow up</th>
                <th rowspan="2" style="vertical-align: inherit;">RELAPSE</th>
                <th colspan="2">Abduction Brace use</th>
                <th rowspan="2" style="vertical-align: inherit;">TREATMENT</th>
                <th rowspan="2" style="vertical-align: inherit;">Next App</th>
              </tr>
              <tr style="text-align:center;">
                <th>Date</th>
                <th>Age</th>
                <th>Size</th>
                <th>Hours</th>
              </tr>
            </thead> 
            <tbody class="table_followup_body">
              <tr>
                <td>check1</td>
                <td>check1</td>
                <td>check1</td>
                <td>check1</td>
                <td>check1</td>
                <td>check1</td>
                <td>check1</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div> <!-- row end -->
  </div>
</form>
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/dataTables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/dataTables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/ajax/libs/jszip.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/ajax/libs/pdfmake.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/ajax/libs/vfs_fonts.js') }}"></script>
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
   

  $(function() {
    $(document).ready(function () {
      $('.visit_nav').addClass('active');
      $('.visits_nav').addClass('active');
      $('.select2').select2();
      $('#visit_table').DataTable();
      $(".dataTables_empty").html("Please select patient first")

      $('#patients').on('change', function() {
        let id = $("#patients").val();
        if(id != "")
        {  
          $.ajax({
            type:'GET',
            url:'get_visits/' + id,
            // data:{_token: "{{ csrf_token() }}"
            // },
            success: function( data ) {
              console.log(data);
              // let parsedData = JSON.parse(data);
              let output = "";
              for (var i = 0; i < data.length ; i++) {
                output += "<tr><td>"+
                    (data[i].inserted_at == null ? "-" : data[i].inserted_at) +"</td> <td>"+
                    data[i].side+"</td> <td>"+
                    (data[i].CLB == null ? "0" : data[i].CLB)+"<br>"+
                    (data[i].MC == null ? "0" : data[i].MC)+"<br>"+
                    (data[i].LHT == null ? "0" : data[i].LHT)+"</td> <td>"+
                    (data[i].PC == null ? "0" : data[i].PC)+"<br>"+
                    (data[i].RE == null ? "0" : data[i].RE)+"<br>"+
                    (data[i].EH == null ? "0" : data[i].EH)+"</td> <td>"+
                    (data[i].mid_foot_score == null ? "0" : data[i].mid_foot_score )+"</td> <td>"+
                    (data[i].hind_foot_score == null ? "0" : data[i].hind_foot_score)+"</td> <td>"+
                    (data[i].total_score == null ? "0" : data[i].total_score)+"</td> <td>"+
                    data[i].treatment+"</td> <td>"+
                    (data[i].complication == null ? "No" : data[i].complication)+"</td> <td>"+
                    (data[i].next_visit_date == null ? "-" : data[i].next_visit_date)+"</td> </tr>";
              }
              if ( $.fn.DataTable.isDataTable('#visit_table') ) {
                $('#visit_table').DataTable().destroy();
              }
              $('#table_body').html(output);              
              $('#visit_table').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                  {
                    extend: 'copyHtml5',
                    exportOptions: {
                      // columns: ':gt(0)'  // indexes of the columns that should be printed,
                    }
                  },
                  {
                    extend: 'excelHtml5',
                    exportOptions: {
                      // columns: ':gt(0)'  // indexes of the columns that should be printed,
                    }
                  },
                  {
                    extend: 'csvHtml5',
                    exportOptions: {
                      // columns: ':gt(0)'  // indexes of the columns that should be printed,
                    }
                  },
                  {
                    extend: 'pdfHtml5',
                    exportOptions: {
                      // columns: ':gt(0)'  // indexes of the columns that should be printed,
                    }
                  }
                ],
                "columnDefs": [
                  { 
                      // "targets": [0], //first column / numbering column
                      // "orderable": false, //set not orderable
                  },
                ]
              });
              if(output == "") {
                $(".dataTables_empty").html("Please select patient first")                
              }
            }
          });
        }
      });
    });
  })
</script>
@endsection