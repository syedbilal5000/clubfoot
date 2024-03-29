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
          <h1 class="m-0">Categories</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="home">Home</a></li>
            <li class="breadcrumb-item active">Category</li>
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
      <div class="col-md-12 table-responsive">
        <div class="form-group">
          <table id="category_table" class="table table-striped table-bordered" style="width:100% !important;">
            <thead class="table_header">
              <tr>
              <th>Name</th>
              <th>Description</th>
              <th>Action</th>
              </tr>
            </thead> 
            <tbody id="table_body">
            </tbody>
              <!-- bilals get all visits from database when drop down data change-->
            <tfoot>
              <tr>
              <th>Name</th>
              <th>Description</th>
              <th>Action</th>
              </tr>
            </tfoot>
            
          </table>
        </div>
      </div>
    </div>  <!-- row end -->
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
  var category = {!! json_encode($category) !!};
  
  view_patients(category);

  function view_patients(category) {
    var output = "";
    if (category.length > 0) {
        for (i = 0; i < category.length; i++) {
          output += `<tr id="${category[i]['id']}"><td>${category[i]['name']}</td><td>${category[i]['description']}</td><td class="text-center"><a href="category/${category[i]['id']}/edit" class="btn btn-link btn-warning " title="Update"><i class="fa fa-edit"></i></a></td></tr>`;
      }
    }
    $('#table_body').html(output);
  }
   

  $(function() {
    $(document).ready(function () {
      $('.category_nav').addClass('active');
      $('.expense_navs').addClass('active');
      $('.select2').select2();
      $('#category_table').DataTable( {
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
    });
  })
</script>
@endsection