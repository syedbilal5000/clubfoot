<!-- Main Sidebar Container -->
<style type="text/css">
  [class*=sidebar-dark-] .nav-sidebar>.nav-item.menu-open>.nav-link { background-color: rgba(255,255,255,.3); }
  .sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link.active { background-color: #007bff; }
</style>
<aside class="main-sidebar sidebar-dark-primary elevation-4" style="position: fixed; bottom: 0;">
  <!-- Brand Logo -->
  <a href="{{ route('home') }}" class="brand-link">
    <!-- <img src="{{ asset('adminlte/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
    <img src="{{ asset('img/clubfoot_logo.png') }}" alt="AdminLTE Logo" class="brand-image" style="">
    <span class="brand-text font-weight-light">ClubFoot</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">Alexander Pierce</a>
      </div>
    </div> -->

    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <!-- <li class="nav-item menu-open">
          <a href="#" class="nav-link active">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Starter Pages
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="#" class="nav-link active">
                <i class="far fa-circle nav-icon"></i>
                <p>Active Page</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Inactive Page</p>
              </a>
            </li>
          </ul>
        </li> -->

        <li class="nav-item menu-open">
          <a href="#" class="nav-link patient_nav ">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Patient
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('patient') }}" class="nav-link patients_nav">
                <i class="far fa-circle nav-icon"></i>
                <p>Patients</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('patient.create') }}" class="nav-link patients_nav_add">
                <i class="far fa-circle nav-icon"></i>
                <p>Add Patient</p>
              </a>
            </li>
            <!-- <li class="nav-item">
              <a href="appointment" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Inactive Page</p>
              </a>
            </li> -->
          </ul>
        </li>

        <li class="nav-item menu-open">
          <a href="#" class="nav-link appointment_nav">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Appointment
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('appointment') }}" class="nav-link appointments_nav">
                <i class="far fa-circle nav-icon"></i>
                <p>Appointments</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('appoint.create') }}" class="nav-link appointments_nav_add">
                <i class="far fa-circle nav-icon"></i>
                <p>Add Appointment</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item menu-open">
          <a href="#" class="nav-link visit_nav">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Visit
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('visit') }}" class="nav-link visits_nav">
                <i class="far fa-circle nav-icon"></i>
                <p>Visits</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('visit.create') }}" class="nav-link visits_nav_add">
                <i class="far fa-circle nav-icon"></i>
                <p>Add Visit</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item menu-open">
          <a href="#" class="nav-link donor_nav">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Donor
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('donor') }}" class="nav-link donors_nav">
                <i class="far fa-circle nav-icon"></i>
                <p>Donors</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('donor.create') }}" class="nav-link donors_nav_add">
                <i class="far fa-circle nav-icon"></i>
                <p>Add Donor</p>
              </a>
            </li>
          </ul>
        </li>

        <!-- <li class="nav-item">
          <a href="" class="nav-link appointment_nav">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Appointment
              <span class="right badge badge-danger">New</span>
            </p>
          </a>
        </li> -->
        <!-- <li class="nav-item">
          <a href="visit" class="nav-link visit_nav">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Visit
            </p>
          </a>
        </li> -->
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>