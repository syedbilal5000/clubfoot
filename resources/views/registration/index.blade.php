@extends('layouts.admin')

@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Registration</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="home">Home</a></li>
            <li class="breadcrumb-item active">Registration Page</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

{{-- Main Content --}}

<form method="POST" action="registration/add">
  @csrf
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12">
          <h3>General Information</h3>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Patient Name: </label><label style="color: red;"> &nbsp;*</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-user"></i></span>
              <input type="text" name="patient_name" class="form-control" placeholder="Enter Patient Name">
            </div>
            <span id="custlErrormsg" style="color: red;"></span>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Father's Name: </label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-user"></i></span>
              <input type="text" id="father_name" class="form-control" placeholder="Enter Father Name">
            </div>
          </div>
        </div>
      </div>  <!-- div row end -->
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Gender: </label><label style="color: red;"> &nbsp;*</label>
            <div class="input-group">
              <label> <input id="" type="radio" name="gender" value="Male"> Male </label> 
            </div>
            <div class="input-group">
              <label> <input id="" type="radio" name="gender" value="Female"> Female </label> 
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Date of birth(DD/MM/YYYY): </label><label style="color: red;"> &nbsp;*</label>
            <div class="input-group">
              <input type="date" name="birth_date" class="form-control">
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Age: </label>
            <div class="input-group">
              <input type="text" name="age" placeholder="Enter Tribe" class="form-control">
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Address 1: </label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-home"></i></span>
              <input type="text" name="address" placeholder="Enter Address 1" class="form-control">
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Address 2: </label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-home"></i></span>
              <input type="text" name="address2" placeholder="Enter Address 2" class="form-control">
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Does the parent or guardian consent to photographs of the patient being used for evaluation and marketing purposes: </label><label style="color: red;"> &nbsp;*</label>
            <div class="input-group">
              <label> <input id="" type="radio" name="has_photo_consent"> No </label> 
            </div>
            <div class="input-group">
              <label> <input id="" type="radio" name="has_photo_consent"> Yes </label> 
            </div>
          </div>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-sm-12">
          <h3>Parent/Guadrian Information</h3>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-sm-12">
          <h4>Primary Parent/Guadrian Information</h4>
        </div>
      </div>
      <div class="row">
        <div class="col-md-8">
          <div class="form-group">
            <label>Relationship to patient: </label>
            <div class="input-group">
              <label> <input id="" type="radio" name="relation_to_patient"> Mother </label> 
            </div>
            <div class="input-group">
              <label> <input id="" type="radio" name="relation_to_patient"> Father </label> 
            </div>
            <div class="input-group">
              <label> <input id="" type="radio" name="relation_to_patient"> Sibling </label>             
            </div>
            <div class="input-group">
              <label> <input id="" type="radio" name="relation_to_patient"> Other </label> 
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label>Name: </label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-user"></i></span>
              <input type="text" name="guardian_name" class="form-control" placeholder="Enter Parents Name">
            </div>
          </div>
        </div>
      </div>  <!-- div row end -->
      <div class="row">
        <div class="col-md-4">
          <div class="form-group">
            <label>Phone number 1: </label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-phone"></i></span>
              <input type="text" name="guardian_number" class="form-control" data-inputmask='"mask": "0399-9999999"' data-mask>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label>Phone number 2: </label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-phone"></i></span>
              <input type="text" name="guardian_number_2" class="form-control" data-inputmask='"mask": "0399-9999999"' data-mask>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label>CNIC No: </label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-card"></i></span>
              <input type="text" name="guardian_cnic" class="form-control" data-inputmask='"mask": "99999-9999999-9"' data-mask>
            </div>
          </div>
        </div>
      </div> <!-- div row end -->
      <hr>
      <div class="row">
        <div class="col-sm-12">
          <h3>Family History</h3>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Any Relatives with the clubfoot deformity: </label><label style="color: red;"> &nbsp;*</label>
            <div class="input-group">
              <label> <input id="" type="radio" name="relative1YN"> Yes </label> 
            </div>
            <div class="input-group">
              <label> <input id="" type="radio" name="relative1YN"> No </label> 
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Length of Pregnancy(in weeks): </label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-edit"></i></span>
              <input type="text" id="weekDetail" class="form-control">
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Did the mother have any complications during pregnancy: </label>
            <div class="input-group">
              <label> <input id="" type="radio" name="relative2YN"> Yes </label> 
            </div>
            <div class="input-group">
              <label> <input id="" type="radio" name="relative2YN"> No </label> 
            </div>
          </div>
        </div>
      </div> <!-- div row end -->
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>What were the complications: </label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-edit"></i></span>
              <input type="text" id="complicationsDetail" class="form-control">
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Did the mother consume alcohol during pregnancy: </label>
            <div class="input-group">
              <label> <input id="" type="radio" name="relative3YN"> Yes </label> 
            </div>
            <div class="input-group">
              <label> <input id="" type="radio" name="relative3YN"> No </label> 
            </div>
          </div>
        </div>
      </div> <!-- div row end -->
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Did the mother smoke during pregnancy: </label>
            <div class="input-group">
              <label> <input id="" type="radio" name="relative4YN"> Yes </label> 
            </div>
            <div class="input-group">
              <label> <input id="" type="radio" name="relative4YN"> No </label> 
            </div>
          </div>
        </div>
      </div> <!-- div row end -->
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Any complications during birth: </label>
            <div class="input-group">
              <label> <input id="" type="radio" name="relative5YN"> Yes </label> 
            </div>
            <div class="input-group">
              <label> <input id="" type="radio" name="relative5YN"> No </label> 
            </div>
          </div>
        </div>
      </div> <!-- div row end -->
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Place of birth: </label>
            <div class="input-group">
              <label> <input id="" type="radio" name="relative6YN"> Hospital </label> 
            </div>
            <div class="input-group">
              <label> <input id="" type="radio" name="relative6YN"> Clinic </label> 
            </div>
            <div class="input-group">
              <label> <input id="" type="radio" name="relative6YN"> Home </label> 
            </div>
          </div>
        </div>
      </div> <!-- div row end -->
      <hr>
      <div class="row">
        <div class="col-sm-12">
          <h3>Referral Information</h3>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Referral source: </label>
            <div class="input-group">
              <label> <input id="" type="radio" name="referralSource"> Hospital/Clinic </label> 
            </div>
            <div class="input-group">
              <label> <input id="" type="radio" name="referralSource"> Midwife </label> 
            </div>
            <div class="input-group">
              <label> <input id="" type="radio" name="referralSource"> Word of mouth </label> 
            </div>
            <div class="input-group">
              <label> <input id="" type="radio" name="referralSource"> Other </label> 
            </div>
          </div>
        </div>
      </div> <!-- div row end -->
      <div class="row">
        <div class="col-md-4">
          <div class="form-group">
            <label>Doctor name: </label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-user"></i></span>
              <input type="text" id="doctorName" class="form-control" placeholder="Enter Doctor Name">
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label>Hospital/Clinic name: </label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-hospital"></i></span>
              <input type="text" id="clinicName" class="form-control" placeholder="Enter Hospital/Clinic Name">
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label>If Other, please specify: </label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-user"></i></span>
              <input type="text" id="otherName" class="form-control" placeholder="Enter Name">
            </div>
          </div>
        </div>
      </div>  <!-- div row end -->
      <button type="submit" style="margin-bottom: 10px;" class="form-control btn btn-primary">Submit</button>
    </div>
  </div>
</form>
@endsection