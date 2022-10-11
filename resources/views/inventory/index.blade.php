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
          <h1 class="m-0">Inventories</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="home">Home</a></li>
            <li class="breadcrumb-item active">Inventory</li>
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
      <div class="col-md-6 table-responsive">
        <div class="form-group">
          <table id="summary_table" class="table table-striped table-bordered" style="width:100% !important;">
            <thead class="table_header">
              <tr>
              <th>Item Name</th>
              <th>Inventory Name</th>
              <th>Unit Balance</th>
              </tr>
            </thead> 
            <tbody id="summary_table_body">
            </tbody>
            <tfoot>
              <tr>
              <th>Item Name</th>
              <th>Inventory Name</th>
              <th>Unit Balance</th>            
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>  <!-- row end -->
    <div class="row">
      <div class="col-md-12 table-responsive">
        <div class="form-group">
          <table id="inventory_table" class="table table-striped table-bordered" style="width:100% !important;">
            <thead class="table_header">
              <tr>
              <th>Item Name</th>
              <th>Date</th>
              <th>Inventory Name</th>
              <th>Unit Cost</th>
              <th>Total Amount</th>
              <th>Unit Balance</th>
              <th>Description</th>
              <th>Action</th>
              </tr>
            </thead> 
            <tbody id="table_body">
            </tbody>
            <tfoot>
              <tr>
              <th>Item Name</th>
              <th>Date</th>
              <th>Inventory Name</th>
              <th>Unit Cost</th>
              <th>Total Amount</th>
              <th>Unit Balance</th>
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
<div class="modal fade" id="modal-defaultedit">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title">Edit To Do Item</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <div class="row">
              <form method="post" id="form">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Task</label>
                  <input type="number" id="less_amount" class="form-control" value="0" />
                  <input type="hidden" id="inv_id" class="form-control"/>
                  <input type="hidden" id="item_nam" class="form-control"/>
                </div>
                <!-- /.form-group -->
              </div>
            </form>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button onclick="submitCalling()" id="edittaskbtn" type="button" class="btn btn-primary">Edit</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
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
  var inventory = {!! json_encode($inventory) !!};
  
  view_inventory(inventory);

  function view_inventory(inventory) {
    var output = "";
    if (inventory.length > 0) {
        for (i = 0; i < inventory.length; i++) {
          output += `<tr id="${inventory[i]['id']}"><td>${inventory[i]['item_name']}</td><td>${inventory[i]['inserted_at']}</td><td>${inventory[i]['inv_name']}</td><td>${inventory[i]['unit_cost']}</td><td>${inventory[i]['total_amount']}</td><td id="balance_${inventory[i]['id']}">${inventory[i]['unit_balance']}</td><td>${inventory[i]['description']}</td><td class="text-center"><a href="#" class="btn btn-primary " data-toggle="modal" data-target="#modal-defaultedit" data-backdrop="static" title="Minus" onclick="editModelClick('${inventory[i]['item_name']}', ${inventory[i]['id']})"><i class="fa fa-minus"></i></a> <a href="inventory/${inventory[i]['id']}/edit" class="btn btn-link btn-warning " hidden title="Update Record"><i class="fa fa-edit"></i></a></td></tr>`;
      }
      balance = {};
      inv_name = {};
      for(i = 0; i < inventory.length; i++) {
        if(balance[`${inventory[i]['item_name']}`] !== undefined)
        {
          balance[`${inventory[i]['item_name']}`] += parseInt(`${inventory[i]['unit_balance']}`)
        }
        else {
          balance[`${inventory[i]['item_name']}`] = parseInt(`${inventory[i]['unit_balance']}`)
          inv_name[`${inventory[i]['item_name']}`] = `${inventory[i]['inv_name']}`
        }
      }
      option = "";
      for (const [key, value] of Object.entries(balance)) {
        option += `<tr> <td>${key}</td> <td>`+inv_name[`${key}`]+`</td> <td id="balance_${key}">${value}</td> </tr>`;
      }
      $('#summary_table_body').html(option);
    }
    $('#table_body').html(output);
  }
  function editModelClick(bal, id)
  {
    $("#item_nam").val(bal);
    $("#inv_id").val(id);
  }
  function submitCalling()
  {
    let id = $("#inv_id").val();
    let item_nam = $("#item_nam").val();
    let bal = $("#less_amount").val();
    $.ajax({
        type: 'GET',
        url: 'inventory/update/' + bal + "/" + id,
        dataType: 'json',
        success: function (data) {
          $("#balance_"+item_nam).html($("#balance_"+item_nam).html() - bal);
          $("#balance_"+id).html($("#balance_"+id).html() - bal);
          $('#modal-defaultedit').modal('hide');
        },
        error: function() { 
          console.log("none");
        }
      });
  }
   
  $(function() {
    $(document).ready(function () {
      $('.inventory_nav').addClass('active');
      $('.inventory_navs').addClass('active');
      $('.select2').select2();
      $('#inventory_table').DataTable( {
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