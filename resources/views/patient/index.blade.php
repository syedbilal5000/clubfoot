@extends('layouts.admin')

@section('content')
<!-- <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables.net-bs/css/dataTables.bootstrap.min.css') }}"> -->
<link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('adminlte/plugins/dataTables-buttons/css/buttons.dataTables.min.css') }}">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Patients</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="home">Home</a></li>
            <li class="breadcrumb-item active">Patients</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
      <div class="row">
        <div class="col-md-9"></div>
        <div class="col-md-3">
        <a class="form-control pull-right btn btn-primary" href="patient/create">Add New Patient</a>    
        </div>
    </div>
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

{{-- Main Content --}}

<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <table id="patient_table" class="table table-striped table-bordered" style="width:100% !important;">
        <thead>
            <tr>
                <th>Patient Name</th>
                <th>Father Name</th>
                <th>Guardian Name</th>
                <th>Guardian Number</th>
                <th>Age (m)</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="patients">
            <!-- <tr>
                <td>Donna Snider</td>
                <td>Customer Support</td>
                <td>New York</td>
                <td>27</td>
                <td>2011/01/25</td>
            </tr> -->
        </tbody>
        <tfoot>
            <tr>
                <th>Patient Name</th>
                <th>Father Name</th>
                <th>Guardian Name</th>
                <th>Guardian Number</th>
                <th>Age (m)</th>
                <th>Actions</th>
            </tr>
        </tfoot>
      </table>
    </div>
  </div> <!-- row end -->
</div>

<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<!-- <script src="{{ asset('adminlte/plugins/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script> -->
<script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/dataTables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/dataTables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/ajax/libs/jszip.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/ajax/libs/pdfmake.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/ajax/libs/vfs_fonts.js') }}"></script>

<script type="text/javascript">
  var patients = {!! json_encode($patients) !!};
  var output = '', patient_id = 0;
  console.log(patients);
  
  view_patients(patients);

  function view_patients(patients) {
    output = '';
    if (patients.length > 0) {
        for (i = 0; i < patients.length; i++) {
            patient_id = patients[i]['patient_id'];
            output += `<tr><td>${patients[i]['patient_name']}</td> `;
            output += '<td>';
            output += (patients[i]['father_name'] ? patients[i]['father_name'] : '-');
            output += '</td> <td>';
            output += (patients[i]['guardian_name'] ? patients[i]['guardian_name'] : '-');
            output += '</td> <td>';
            output += (patients[i]['guardian_number'] ? patients[i]['guardian_number'] : '-');
            output += '</td> <td>';
            output += (patients[i]['birth_date'] ? getAge(patients[i]['birth_date']) : '-');
            output += `</td> <td class="text-center"> <a href="patient/${patient_id}/edit" class="btn btn-link btn-warning "><i class="fa fa-edit"></i></a> <a href="patient/{{ Crypt::encrypt(5) }}/delete" class="btn btn-link btn-danger "><i class="fa fa-times"></i></a> </td></tr>`;
        }
    } else {
        output = '<tr>No Data</tr>';
    }
    $('#patients').html(output);
  }

  function getAge(dateString) {
    var now = new Date();
    var today = new Date(now.getYear(),now.getMonth(),now.getDate());

    var yearNow = now.getYear();
    var monthNow = now.getMonth();
    var dateNow = now.getDate();

    var dob = new Date(dateString.substring(0,4), // year
                       dateString.substring(5,7)-1,                   
                       dateString.substring(8,10)                  
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
  
    if ( age.years > 1 ) yearString = "y"; // years
    else yearString = "y"; // year
    if ( age.months> 1 ) monthString = "m";
    else monthString = "m";
    if ( age.days > 1 ) dayString = "d";
    else dayString = "d";

    if ( (age.years > 0) && (age.months > 0) && (age.days > 0) )
      ageString = age.years + yearString + ", " + age.months + monthString + ", " + age.days + dayString;
    else if ( (age.years == 0) && (age.months == 0) && (age.days > 0) )
      ageString = age.days + dayString;
    else if ( (age.years > 0) && (age.months == 0) && (age.days == 0) )
      ageString = age.years + yearString;
    else if ( (age.years > 0) && (age.months > 0) && (age.days == 0) )
      ageString = age.years + yearString + " " + age.months + monthString;
    else if ( (age.years == 0) && (age.months > 0) && (age.days > 0) )
      ageString = age.months + monthString + " " + age.days + dayString;
    else if ( (age.years > 0) && (age.months == 0) && (age.days > 0) )
      ageString = age.years + yearString + " " + age.days + dayString;
    else if ( (age.years == 0) && (age.months > 0) && (age.days == 0) )
      ageString = age.months + monthString;
    else ageString = "Oops! Could not calculate age!";

    return ageString;
  }

  $(document).ready(function() {
    $('.patient_nav').addClass('active');
    $('.patients_nav').addClass('active');
    // $('#patient_table').DataTable();
    $('#patient_table').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    } );
  } );
</script>
@endsection