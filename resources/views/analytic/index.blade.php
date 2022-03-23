@extends('layouts.admin')

@section('content')
<style type="text/css">
  .main-transaction-wrapper2.card {
    border-radius: 0;
    box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);
    border-radius: 5px;
  }
  .transaction-summary {
    margin-bottom: 20px;
    padding: 0px 20px;
  }
  .transaction-summary h3 {
    margin: 20px 0 10px;
    font-weight: 600;
    font-size: 20px;
    margin-bottom: 10px;
  }
  .transaction-summary h5 {
    font-size: 16px;
    font-weight: 400;
    margin-top: 18px;
    margin-bottom: 30px; 
  }
  .transaction-summary h2 {
    margin-top: 18px;
    margin-bottom: 20px;
    font-weight: 500; 
  }
  .transaction-summary p {
    line-height: 8px;
    font-size: 15px;
  }
  .transaction-summary a {
    line-height: 17px;
  }
  .transaction-summary a:hover {
    text-decoration: underline;
  }
</style>
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Analysis</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="home">Home</a></li>
            <li class="breadcrumb-item active">Analysis Page</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
{{-- Main Content --}}
<form action="appointment/update" method="POST" id="appoint_form">
  @csrf
  <!-- <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div id="reports" class="tab-content current">
            <div class="row" style="padding: 0px 30px;">
              <div class="col-md-6">
                <div class="col-md-12">
                  <div class="main-transaction-wrapper card">
                    <div>
                      <div class="transaction-summary">
                        <h3>Appointments</h3>
                        <h5>View projected revenues of upcoming appointments, track cancelled ones also</h5>
                        <a href="reports/appointments">Appointments List</a>
                        <hr>
                        <a href="reports/appointments_summary">Appointments Summary</a>
                        <hr>
                        <a href="reports/appointments_cancel">Appointments Cancel</a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="main-transaction-wrapper card">
                    <div>
                      <div class="transaction-summary">
                        <h3>Staff</h3>
                        <h5>View your team's performance, commission details as well</h5>
                        <a href="reports/commission_summary">Commission Summary</a>
                        <hr>
                        <a href="reports/commission_detail">Commission Detailed</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="col-md-12">
                  <div class="main-transaction-wrapper card">
                    <div>
                      <div class="transaction-summary">
                        <h3>Sales</h3>
                        <h5>Analyse the performance of your business by comparing sales across services, staff, and more</h5>
                        <a href="reports/sales/1">Sales by Service</a>
                        <hr>
                        <a href="reports/sales/2">Sales by Location</a>
                        <hr>
                        <a href="reports/sales/3">Sales by Customer</a>
                        <hr>
                        <a href="reports/sales/4">Sales by Staff</a>
                        <hr>
                        <a href="reports/sales/5">Sales by Month</a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="main-transaction-wrapper card">
                    <div>
                      <div class="transaction-summary">
                        <h3>Miscellaneous</h3>
                        <h5>View other valuable reports</h5>
                        <a href="reports/customers">Customers List</a>
                        <hr>
                        <a href="reports/expenses">Expenses List</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> -->
</form>
<!-- ./wrapper -->
<!-- jQuery 3 -->
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<!-- Page specific script -->
<script type="text/javascript">
  var patient_id = 0, output = '', st_dt, ed_dt;

  $(document).ready(function() {
    $('.analytic_nav').addClass('active');
    // $('.appointments_nav').addClass('active');
  });

</script>
@endsection