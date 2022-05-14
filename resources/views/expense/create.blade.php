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
          <h1 class="m-0">Add Expense</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="home">Home</a></li>
            <li class="breadcrumb-item active">Add New Expense</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

{{-- Main Content --}}

<form id="expense_form" method="POST" action="add" enctype="multipart/form-data">
  @csrf
  <div class="container-fluid">
  <div>
    
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label>Select Category: </label><label style="color: red;"> &nbsp;*</label>
          <select id="category" name="category" class="form-control select2 @error('id') is-invalid @enderror" style="width: 100%;" required>
            <option selected disabled>Select Category</option>
          </select>
          @error('id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label>Expense Name: </label>
          <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label>Amount: </label><label style="color: red;"> &nbsp;*</label>
          <input type="number" name="amount" id="amount" class="form-control" placeholder="Enter Amount" required>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label>Description: </label>
          <input type="text" name="description" id="description" class="form-control" placeholder="Enter Description">
        </div>
      </div>
    </div> <!-- row end -->
  </div>
  <button type="submit" style="margin-bottom: 10px;" class="form-control btn btn-primary">Submit</button>
  </div>
</form>
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/inputmask/jquery.inputmask.js') }}"></script>
<script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
<script>
  
  $(function () {
    $('.select2').select2();
    $('.expense_navs').addClass('active');
    $('.expense_nav_add').addClass('active');

  });

  var expense = {!! json_encode($expense) !!};
  
  view_expense(expense);
  
  function view_expense(expense) {
    output = '<option value="">Select Category</option>';
    if (expense.length > 0) {
        var expenseCheck = {};
        for (i = 0; i < expense.length; i++) {
            if(expenseCheck[expense[i]['id']] == true)
          {

          }
          else {
            expenseCheck[expense[i]['id']] = true;
            output += `<option value="${expense[i]['id']}">${expense[i]['name']}</option>`;
          }
        }
    } else {
        output = '<option value="-1">No Data</option>';
    }
    $('#category').html(output);
  }


</script>
@endsection