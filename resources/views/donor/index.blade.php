@extends('layouts.admin')

@section('content')
<!-- <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables.net-bs/css/dataTables.bootstrap.min.css') }}"> -->
<link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('adminlte/plugins/dataTables-buttons/css/buttons.dataTables.min.css') }}">
  <!-- Content Header (Page header) -->
  <div class="content-header" style="padding-left: 0px;">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Donors</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="home">Home</a></li>
            <li class="breadcrumb-item active">Donors</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
      <div class="row">
        <div class="col-md-9"></div>
        <div class="col-md-3">
        <a class="form-control pull-right btn btn-primary" href="donor/create">Add New Donor</a>    
        </div>
    </div>
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

{{-- Main Content --}}

<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <table id="donor_table" class="table table-striped table-bordered" style="width:100% !important;">
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>City</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="donors">
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
                <th>First Name</th>
                <th>Last Name</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>City</th>
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
  var donors = {!! json_encode($donors) !!};
  var output = '', donor_id = 0;
  console.log(donors);
  
  view_donors(donors);

  function view_donors(donors) {
    output = '';
    if (donors.length > 0) {
        for (i = 0; i < donors.length; i++) {
            donor_id = donors[i]['id'];
            output += `<tr><td>${donors[i]['first_name']}</td> <td>`;
            output += (donors[i]['last_name'] ? donors[i]['last_name'] : '-');
            output += `</td><td>${donors[i]['donor_number']}</td> <td>`;
            output += (donors[i]['donor_email'] ? donors[i]['donor_email'] : '-');
            output += '</td> <td>';
            output += (donors[i]['city'] ? donors[i]['city'] : '-');
            output += `</td> <td class="text-center"> <a href="donor/${donor_id}/edit" class="btn btn-link btn-warning "><i class="fa fa-edit"></i></a> <a href="donor/{{ Crypt::encrypt(5) }}/delete" class="btn btn-link btn-danger "><i class="fa fa-times"></i></a> </td></tr>`;
        }
    } else {
        output = '<tr>No Data</tr>';
    }
    $('#donors').html(output);
  }

  $(document).ready(function() {
    $('.donor_nav').addClass('active');
    $('.donors_nav').addClass('active');
    // $('#patient_table').DataTable();
    $('#donor_table').DataTable( {
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