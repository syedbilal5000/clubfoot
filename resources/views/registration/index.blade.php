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
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Starter Page</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

{{-- Main Content --}}

  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12">
          <h3>General Information</h3>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Does the parent or guardian consent to being included: </label><label style="color: red;"> &nbsp;*</label>
            <div class="input-group">
              <label> <input id="" type="radio" name="consentYN"> No </label> 
            </div>
            <div class="input-group">
              <label> <input id="" type="radio" name="consentYN"> Yes </label> 
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Does the parent or guardian consent to photographs of the patient being used for evaluation and marketing purposes: </label><label style="color: red;"> &nbsp;*</label>
            <div class="input-group">
              <label> <input id="" type="radio" name="photographsYN"> No </label> 
            </div>
            <div class="input-group">
              <label> <input id="" type="radio" name="photographsYN"> Yes </label> 
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="form-group">
            <label>Last name/ Surname: </label><label style="color: red;"> &nbsp;*</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-user"></i></span>
              <input type="text" id="lastName" class="form-control" placeholder="Enter Last Name">
            </div>
            <span id="custlErrormsg" style="color: red;"></span>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label>First Name: </label><label style="color: red;"> &nbsp;*</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-user"></i></span>
              <input type="text" id="firstName" class="form-control" placeholder="Enter First Name">
            </div>
            <span id="custfErrormsg" style="color: red;"></span>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label>Middle Name: </label><label style="color: red;"> &nbsp;*</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-user"></i></span>
              <input type="text" id="middleName" class="form-control" placeholder="Enter Middle Name">
            </div>
          </div>
        </div>
      </div>  <!-- div row end -->
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Sex: </label><label style="color: red;"> &nbsp;*</label>
            <div class="input-group">
              <label> <input id="" type="radio" name="gender"> Male </label> 
            </div>
            <div class="input-group">
              <label> <input id="" type="radio" name="gender"> Female </label> 
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Race: </label><label style="color: red;"> &nbsp;*</label>
            <div class="input-group">
              <label> <input id="" type="radio" name="race"> Asian </label> 
            </div>
            <div class="input-group">
              <label> <input id="" type="radio" name="race"> Caucasion </label> 
            </div>
            <div class="input-group">
              <label> <input id="" type="radio" name="race"> African (Black) </label> 
            </div>
            <div class="input-group">
              <label> <input id="" type="radio" name="race"> Asian(Indian) </label> 
            </div>
            <div class="input-group">
              <label> <input id="" type="radio" name="race"> Mixed </label> 
            </div>
            <div class="input-group">
              <label> <input id="" type="radio" name="race"> Other </label> 
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="form-group">
            <label>Date of birth(DD/MM/YYYY): </label><label style="color: red;"> &nbsp;*</label>
            <div class="input-group">
              <input type="date" name="dob" class="form-control">
            </div>
          </div>
        </div>
        <div class="col-md-8">
          <div class="form-group">
            <label>Tribe: </label>
            <div class="input-group">
              <input type="text" name="tribe" placeholder="Enter Tribe" class="form-control">
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
              <input type="text" name="address1" placeholder="Enter Address 1" class="form-control">
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
        <div class="col-md-4">
          <div class="form-group">
            <label>Village/Town/City: </label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-city"></i></span>
              <input type="text" id="cityName" class="form-control" placeholder="Enter City Name">
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label>State/Province: </label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-home"></i></span>
              <input type="text" id="stateName" class="form-control" placeholder="Enter State Name">
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label>Country: </label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-flag"></i></span>
              <input type="text" id="countryName" class="form-control" placeholder="Enter Country Name">
            </div>
          </div>
        </div>
      </div>  <!-- div row end -->
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
        <div class="col-md-4">
          <div class="form-group">
            <label>Last name/ Surname: </label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-user"></i></span>
              <input type="text" id="lastPrimaryName" class="form-control" placeholder="Enter Last Name">
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label>First Name: </label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-user"></i></span>
              <input type="text" id="firstPrimaryName" class="form-control" placeholder="Enter First Name">
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label>Middle Name: </label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-user"></i></span>
              <input type="text" id="middlePrimaryName" class="form-control" placeholder="Enter Middle Name">
            </div>
          </div>
        </div>
      </div>  <!-- div row end -->
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Relationship to patient: </label>
            <div class="input-group">
              <label> <input id="" type="radio" name="primaryPatient"> Mother </label> 
            </div>
            <div class="input-group">
              <label> <input id="" type="radio" name="primaryPatient"> Father </label> 
            </div>
            <div class="input-group">
              <label> <input id="" type="radio" name="primaryPatient"> Grandparent </label> 
            </div>
            <div class="input-group">
              <label> <input id="" type="radio" name="primaryPatient"> Brother </label> 
            </div>
            <div class="input-group">
              <label> <input id="" type="radio" name="primaryPatient"> Sister </label> 
            </div>
            <div class="input-group">
              <label> <input id="" type="radio" name="primaryPatient"> Aunt </label> 
            </div>
            <div class="input-group">
              <label> <input id="" type="radio" name="primaryPatient"> Uncle </label> 
            </div>
            <div class="input-group">
              <label> <input id="" type="radio" name="primaryPatient"> Friend </label> 
            </div>
            <div class="input-group">
              <label> <input id="" type="radio" name="primaryPatient"> Other </label> 
            </div>
          </div>
        </div>
      </div> <!-- div row end -->
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Phone number 1: </label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-phone"></i></span>
              <input type="number" id="phone1PrimaryName" class="form-control">
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Phone number 2: </label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-phone"></i></span>
              <input type="number" id="phone2PrimaryName" class="form-control">
            </div>
          </div>
        </div>
      </div> <!-- div row end -->
      <hr>
      <div class="row">
        <div class="col-sm-12">
          <h4>Secondary Parent/Guadrian Information</h4>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="form-group">
            <label>Last name/ Surname: </label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-user"></i></span>
              <input type="text" id="lastSecondaryName" class="form-control" placeholder="Enter Last Name">
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label>First Name: </label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-user"></i></span>
              <input type="text" id="firstSecondaryName" class="form-control" placeholder="Enter First Name">
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label>Middle Name: </label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-user"></i></span>
              <input type="text" id="middleSecondaryName" class="form-control" placeholder="Enter Middle Name">
            </div>
          </div>
        </div>
      </div>  <!-- div row end -->
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Relationship to patient: </label>
            <div class="input-group">
              <label> <input id="" type="radio" name="secondaryPatient"> Mother </label> 
            </div>
            <div class="input-group">
              <label> <input id="" type="radio" name="secondaryPatient"> Father </label> 
            </div>
            <div class="input-group">
              <label> <input id="" type="radio" name="secondaryPatient"> Grandparent </label> 
            </div>
            <div class="input-group">
              <label> <input id="" type="radio" name="secondaryPatient"> Brother </label> 
            </div>
            <div class="input-group">
              <label> <input id="" type="radio" name="secondaryPatient"> Sister </label> 
            </div>
            <div class="input-group">
              <label> <input id="" type="radio" name="secondaryPatient"> Aunt </label> 
            </div>
            <div class="input-group">
              <label> <input id="" type="radio" name="secondaryPatient"> Uncle </label> 
            </div>
            <div class="input-group">
              <label> <input id="" type="radio" name="secondaryPatient"> Friend </label> 
            </div>
            <div class="input-group">
              <label> <input id="" type="radio" name="secondaryPatient"> Other </label> 
            </div>
          </div>
        </div>
      </div> <!-- div row end -->
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Phone number 1: </label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-phone"></i></span>
              <input type="number" id="phone1SecondaryName" class="form-control">
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Phone number 2: </label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-phone"></i></span>
              <input type="number" id="phone2SecondaryName" class="form-control">
            </div>
          </div>
        </div>
      </div> <!-- div row end -->
      <hr>
      <div class="row">
        <div class="col-sm-12">
          <h4>Other Emergency Contact</h4>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="form-group">
            <label>Last name/ Surname: </label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-user"></i></span>
              <input type="text" id="lastOtherName" class="form-control" placeholder="Enter Last Name">
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label>First Name: </label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-user"></i></span>
              <input type="text" id="firstOtherName" class="form-control" placeholder="Enter First Name">
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label>Middle Name: </label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-user"></i></span>
              <input type="text" id="middleOtherName" class="form-control" placeholder="Enter Middle Name">
            </div>
          </div>
        </div>
      </div>  <!-- div row end -->
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Relationship to patient: </label>
            <div class="input-group">
              <label> <input id="" type="radio" name="otherPatient"> Mother </label> 
            </div>
            <div class="input-group">
              <label> <input id="" type="radio" name="otherPatient"> Father </label> 
            </div>
            <div class="input-group">
              <label> <input id="" type="radio" name="otherPatient"> Grandparent </label> 
            </div>
            <div class="input-group">
              <label> <input id="" type="radio" name="otherPatient"> Brother </label> 
            </div>
            <div class="input-group">
              <label> <input id="" type="radio" name="otherPatient"> Sister </label> 
            </div>
            <div class="input-group">
              <label> <input id="" type="radio" name="otherPatient"> Aunt </label> 
            </div>
            <div class="input-group">
              <label> <input id="" type="radio" name="otherPatient"> Uncle </label> 
            </div>
            <div class="input-group">
              <label> <input id="" type="radio" name="otherPatient"> Friend </label> 
            </div>
            <div class="input-group">
              <label> <input id="" type="radio" name="otherPatient"> Other </label> 
            </div>
          </div>
        </div>
      </div> <!-- div row end -->
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Phone number 1: </label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-phone"></i></span>
              <input type="number" id="phone1OtherName" class="form-control">
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Phone number 2: </label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-phone"></i></span>
              <input type="number" id="phone2OtherName" class="form-control">
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
        <div class="col-md-12">
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
      </div> <!-- div row end -->
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>If so, how many: </label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-edit"></i></span>
              <input type="text" id="ifsoDetail" class="form-control">
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
              <label> <input id="" type="radio" name="referralSource"> Promotional materials </label> 
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
    </div>
  </div>
@endsection