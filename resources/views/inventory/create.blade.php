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
          <h1 class="m-0">Add Inventory</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="home">Home</a></li>
            <li class="breadcrumb-item active">Add New Inventory</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

{{-- Main Content --}}

<form id="inventory_form" method="POST" action="add" enctype="multipart/form-data">
  @csrf
  <div class="container-fluid">
  <div>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label>Select Item: </label><label style="color: red;"> &nbsp;*</label>
          <select id="item" name="item" class="form-control select2 @error('id') is-invalid @enderror" style="width: 100%;" required>
            <option selected disabled>Select Item</option>
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
          <label>Name: </label>
          <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label>Unit Cost: </label><label style="color: red;"> &nbsp;*</label>
          <input type="number" name="unit_cost" id="unit_cost" class="form-control" placeholder="Enter Cost">
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label>Unit Balance: </label><label style="color: red;"> &nbsp;*</label>
          <input type="text" name="unit_balance" id="unit_balance" class="form-control" placeholder="Enter Balance" required>
        </div>
      </div>
    </div> <!-- row end -->
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label>Total Amount: </label><label style="color: red;"> &nbsp;*</label>
          <input type="number" name="total_amount" id="total_amount" class="form-control" placeholder="Enter Total Amount" required>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label>Date: </label><label style="color: red;"> &nbsp;*</label>
          <input type="date" name="insert_date" id="insert_date" class="form-control" value="@php echo date('Y-m-d');@endphp">
        </div>
      </div>
    </div> <!-- row end -->
    <div class="row">
      <div class="col-md-12">
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
    $('.inventory_navs').addClass('active');
    $('.inventory_nav_add').addClass('active');

    $("#unit_balance").on('change', function(){
      changeAmount();
    });
    $("#unit_cost").on('change', function(){
      changeAmount();
    });
    
  });

  function changeAmount()
  {
    var bal = $("#unit_balance").val() == 0 ? 1 : $("#unit_balance").val();
    var unit = $("#unit_cost").val() == 0 ? 1 : $("#unit_cost").val();
    $("#total_amount").val(bal * unit);
  }
  var inventory = {!! json_encode($inventory) !!};
  
  view_inventory(inventory);
  
  function view_inventory(inventory) {
    output = '<option value="">Select Item</option>';
    if (inventory.length > 0) {
        var inventoryCheck = {};
        for (i = 0; i < inventory.length; i++) {
            if(inventoryCheck[inventory[i]['id']] == true)
          {

          }
          else {
            inventoryCheck[inventory[i]['id']] = true;
            output += `<option value="${inventory[i]['id']}">${inventory[i]['name']}</option>`;
          }
        }
    } else {
        output = '<option value="-1">No Data</option>';
    }
    $('#item').html(output);
  }


</script>
@endsection