@extends('layouts.admin')

@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Add Patient</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="./">Patients</a></li>
            <li class="breadcrumb-item active">Add New Patient</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

{{-- Main Content --}}

<form method="POST" action="add">
  @csrf
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12">
          <h3 id="general_info" onclick="general_clickable();" style="cursor: pointer; text-decoration: underline;">General Information</h3>
        </div>
      </div>
      <div id="general_view">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Patient Name: </label><label style="color: red;"> &nbsp;*</label>
              <div class="input-group">
                <span class="input-group-text"><i class="fa fa-user"></i></span>
                <input type="text" name="patient_name" class="form-control" placeholder="Enter Patient Name" required>
              </div>
              <span id="custlErrormsg" style="color: red;"></span>
            </div>
            <!-- <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-user"></i></span>
              </div>
              <input type="text" name="patient_name" class="form-control" placeholder="Enter Patient Name">
            </div> -->
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Father's Name: </label><label style="color: red;"> &nbsp;*</label>
              <div class="input-group">
                <span class="input-group-text"><i class="fa fa-user"></i></span>
                <input type="text" name="father_name" class="form-control" placeholder="Enter Father Name" required>
              </div>
            </div>
          </div>
        </div>  <!-- div row end -->
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Gender: </label>
              <!-- <div class="input-group">
                <label> <input type="radio" name="gender" value="1"> Male </label> 
              </div>
              <div class="input-group">
                <label> <input type="radio" name="gender" value="2"> Female </label> 
              </div> -->
              <br>
              <div class="form-check form-check-inline">
                <label> <input class="form-check-input" type="radio" name="gender" value="1"> Male </label>
              </div>
              <div class="form-check form-check-inline">
                <label> <input class="form-check-input" type="radio" name="gender" value="2"> Female </label>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Date of birth(MM/DD/YYYY): </label><label style="color: red;"> &nbsp;*</label>
              <div class="input-group">
                <input type="date" name="birth_date" class="form-control" id="date_text" required>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Age: </label>
              <div class="input-group">
                <input type="text" name="age" placeholder="This should be auto fill" id="age_text" class="form-control" readonly>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Address 1: </label>
              <div class="input-group">
                <span class="input-group-text"><i class="fa fa-home"></i></span>
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
                <span class="input-group-text"><i class="fa fa-home"></i></span>
                <input type="text" name="address2" placeholder="Enter Address 2" class="form-control">
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Does the parent or guardian consent to photographs of the patient being used for evaluation and marketing purposes: </label><label style="color: red;"> &nbsp;*</label>
              <br>
              <div class="form-check form-check-inline">
                <label> <input type="radio" class="form-check-input" name="has_photo_consent" value="0"> No </label> 
              </div>
              <div class="form-check form-check-inline">
                <label> <input type="radio" class="form-check-input" name="has_photo_consent" value="1"> Yes </label> 
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
              <br>
              <div class="form-check form-check-inline">
                <label> <input type="radio" class="form-check-input" name="relation_to_patient" value="1"> Mother </label> 
              </div>
              <div class="form-check form-check-inline">
                <label> <input type="radio" class="form-check-input" name="relation_to_patient" value="2"> Father </label> 
              </div>
              <div class="form-check form-check-inline">
                <label> <input type="radio" class="form-check-input" name="relation_to_patient" value="3"> Sibling </label>             
              </div>
              <div class="form-check form-check-inline">
                <label> <input type="radio" class="form-check-input" name="relation_to_patient" value="0"> Other </label> 
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Name: </label>
              <div class="input-group">
                <span class="input-group-text"><i class="fa fa-user"></i></span>
                <input type="text" name="guardian_name" class="form-control" placeholder="Enter Parents Name">
              </div>
            </div>
          </div>
        </div>  <!-- div row end -->
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label>Phone number 1: </label><label style="color: red;"> &nbsp;*</label>
              <div class="input-group">
                <span class="input-group-text"><i class="fa fa-phone"></i></span>
                <input type="text" name="guardian_number" class="form-control" data-inputmask='"mask": "0399-9999999"' data-mask required>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Phone number 2: </label>
              <div class="input-group">
                <span class="input-group-text"><i class="fa fa-phone"></i></span>
                <input type="text" name="guardian_number_2" class="form-control" data-inputmask='"mask": "0399-9999999"' data-mask>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>CNIC No: </label><label style="color: red;"> &nbsp;*</label>
              <div class="input-group">
                <span class="input-group-text">&nbsp; <i class="fas fa-info"></i>&nbsp; </span>
                <input type="text" name="guardian_cnic" class="form-control" data-inputmask='"mask": "99999-9999999-9"' data-mask required>
              </div>
            </div>
          </div>
        </div> <!-- div row end -->
      </div>
      <hr>
      <div class="row">
        <div class="col-sm-12">
          <h3 id="history_info" onclick="history_clickable();" style="cursor: pointer; text-decoration: underline;">Family History</h3>
        </div>
      </div>
      <div id="history_view">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Any Relatives with the clubfoot deformity: </label>
              <br>
              <div class="form-check form-check-inline">
                <label> <input type="radio" name="is_relatable" value="1"> Yes </label> 
              </div>
              <div class="form-check form-check-inline">
                <label> <input type="radio" name="is_relatable" value="0"> No </label> 
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Length of Pregnancy(in weeks): </label><label style="color: red;"> &nbsp;*</label>
              <div class="input-group">
                <span class="input-group-text"><i class="fa fa-edit"></i></span>
                <input type="text" id="weekDetail" name="preg_len" class="form-control" required>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Did the mother have any complications during pregnancy: </label>
              <br>
              <div class="form-check form-check-inline">
                <label> <input type="radio" name="has_complicated_preg" value="1"> Yes </label> 
              </div>
              <div class="form-check form-check-inline">
                <label> <input type="radio" name="has_complicated_preg" value="0"> No </label> 
              </div>
            </div>
          </div>
        </div> <!-- div row end -->
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>What were the complications: </label>
              <div class="input-group">
                <span class="input-group-text"><i class="fa fa-edit"></i></span>
                <input type="text" name="complications" class="form-control">
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Did the mother consume alcohol during pregnancy: </label>
              <br>
              <div class="form-check form-check-inline">
                <label> <input type="radio" name="is_alcoholic" value="1"> Yes </label> 
              </div>
              <div class="form-check form-check-inline">
                <label> <input type="radio" name="is_alcoholic" value="0"> No </label> 
              </div>
            </div>
          </div>
        </div> <!-- div row end -->
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Did the mother smoke during pregnancy: </label>
              <br>
              <div class="form-check form-check-inline">
                <label> <input type="radio" name="is_smoked" value="1"> Yes </label> 
              </div>
              <div class="form-check form-check-inline">
                <label> <input type="radio" name="is_smoked" value="0"> No </label> 
              </div>
            </div>
          </div>
        </div> <!-- div row end -->
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Any complications during birth: </label>
              <br>
              <div class="form-check form-check-inline">
                <label> <input type="radio" name="has_complicated_birth" value="1"> Yes </label> 
              </div>
              <div class="form-check form-check-inline">
                <label> <input type="radio" name="has_complicated_birth" value="0"> No </label> 
              </div>
            </div>
          </div>
        </div> <!-- div row end -->
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Place of birth: </label>
              <br>
              <div class="form-check form-check-inline">
                <label> <input type="radio" name="birth_place" value="1"> Hospital </label> 
              </div>
              <div class="form-check form-check-inline">
                <label> <input type="radio" name="birth_place" value="2"> Clinic </label> 
              </div>
              <div class="form-check form-check-inline">
                <label> <input type="radio" name="birth_place" value="3"> Home </label> 
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
              <br>
              <div class="form-check form-check-inline">
                <label> <input type="radio" name="referral_source" value="1"> Hospital/Clinic </label> 
              </div>
              <div class="form-check form-check-inline">
                <label> <input type="radio" name="referral_source" value="2"> Midwife </label> 
              </div>
              <div class="form-check form-check-inline">
                <label> <input type="radio" name="referral_source" value="3"> Word of mouth </label> 
              </div>
              <div class="form-check form-check-inline">
                <label> <input type="radio" name="referral_source" value="0"> Other </label> 
              </div>
            </div>
          </div>
        </div> <!-- div row end -->
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label>Doctor name: </label>
              <div class="input-group">
                <span class="input-group-text"><i class="fa fa-user-md"></i></span>
                <input type="text" name="doctor_name" class="form-control" placeholder="Enter Doctor Name">
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Hospital/Clinic name: </label>
              <div class="input-group">
                <span class="input-group-text"><i class="fa fa-hospital"></i></span>
                <input type="text" name="referral_hospital" class="form-control" placeholder="Enter Hospital/Clinic Name">
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>If Other, please specify: </label>
              <div class="input-group">
                <span class="input-group-text"><i class="fa fa-user"></i></span>
                <input type="text" name="other_referral" class="form-control" placeholder="Enter Name">
              </div>
            </div>
          </div>
        </div>  <!-- div row end -->
      </div>
      <hr>
      <div class="row">
        <div class="col-sm-12">
          <h3 id="diagnosis_info" onclick="diagnosis_clickable();" style="cursor: pointer; text-decoration: underline;">Diagnosis</h3>
        </div>
      </div>
      <div id="diagnosis_view">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Name of evaluator: </label>
              <div class="input-group">
                <span class="input-group-text"><i class="fa fa-user-md"></i></span>
                <input type="text" name="evaluator_name" class="form-control" placeholder="Enter Evaluator Name">
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Evaluation Date: </label>
              <div class="input-group">
                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                <input type="date" name="evaluation_date" class="form-control" >
              </div>
            </div>
          </div>
        </div>  <!-- div row end -->
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Title of evaluator: </label>
              <br>
              <div class="form-check form-check-inline">
                <label> <input type="radio" name="evaluator_title" value="1"> Doctor </label> 
              </div>
              <div class="form-check form-check-inline">
                <label> <input type="radio" name="evaluator_title" value="2"> Nurse </label> 
              </div>
              <div class="form-check form-check-inline">
                <label> <input type="radio" name="evaluator_title" value="3"> Midwife </label> 
              </div>
              <div class="form-check form-check-inline">
                <label> <input type="radio" name="evaluator_title" value="4"> Physical therapist </label> 
              </div>
              <div class="form-check form-check-inline">
                <label> <input type="radio" name="evaluator_title" value="0"> Other </label> 
              </div>
            </div>
          </div>
        </div>    <!-- div row end -->
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Feet Affected: </label><label style="color: red;"> &nbsp;*</label>
              <br>
              <div class="form-check form-check-inline">
                <label> <input type="radio" name="feet_affected" value="1" required> Right </label> 
              </div>
              <div class="form-check form-check-inline">
                <label> <input type="radio" name="feet_affected" value="2" required> Left </label> 
              </div>
              <div class="form-check form-check-inline">
                <label> <input type="radio" name="feet_affected" value="3" required> Both </label> 
              </div>
            </div>
          </div>
        </div>    <!-- div row end -->
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Diagnosis: </label><label style="color: red;"> &nbsp;*</label>
              <br>
              <div class="form-check form-check-inline">
                <label> <input type="radio" name="diagnosis" value="1" required> Idiopathic Clubfoot </label> 
              </div>
              <div class="form-check form-check-inline">
                <label> <input type="radio" name="diagnosis" value="2" required> Syndromic Clubfoot </label> 
              </div>
              <div class="form-check form-check-inline">
                <label> <input type="radio" name="diagnosis" value="3" required> Neuropathic Clubfoot </label> 
              </div>
              <div class="form-check form-check-inline">
                <label> <input type="radio" name="diagnosis" value="0" required> Other </label> 
              </div>
            </div>
          </div>
        </div>    <!-- div row end -->
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Deformity present at birth: </label><label style="color: red;"> &nbsp;*</label>
              <br>
              <div class="form-check form-check-inline">
                <label> <input type="radio" name="has_birth_deformity" value="1" required> Yes </label> 
              </div>
              <div class="form-check form-check-inline">
                <label> <input type="radio" name="has_birth_deformity" value="0" required> No </label> 
              </div>
            </div>
          </div>
        </div>    <!-- div row end -->
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Any Pervious treatments: </label><label style="color: red;"> &nbsp;*</label>
              <br>
              <div class="form-check form-check-inline">
                <label> <input type="radio" name="has_treated" value="1" required> Yes </label> 
              </div>
              <div class="form-check form-check-inline">
                <label> <input type="radio" name="has_treated" value="0" required> No </label> 
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>How many previous treatment sessions: </label><label style="color: red;"> &nbsp;*</label>
              <div class="input-group">
                <span class="input-group-text"><i class="fa fa-check"></i></span>
                <input type="text" name="treatments" class="form-control" placeholder="Enter Sessions" required>
              </div>
            </div>
          </div>
        </div>    <!-- div row end -->
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Type of previous treatment(S): </label><label style="color: red;"> &nbsp;*</label>
              <br>
              <div class="form-check form-check-inline">
                <label> <input type="radio" name="treatment_type" value="1" required> Casting above knee </label> 
              </div>
              <div class="form-check form-check-inline">
                <label> <input type="radio" name="treatment_type" value="2" required> Casting below knee </label> 
              </div>
              <div class="form-check form-check-inline">
                <label> <input type="radio" name="treatment_type" value="3" required> Physiotherapy </label> 
              </div>
              <div class="form-check form-check-inline">
                <label> <input type="radio" name="treatment_type" value="0" required> Other </label> 
              </div>
            </div>
          </div>
        </div>    <!-- div row end -->
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Diagnosed prenatally: </label><label style="color: red;"> &nbsp;*</label>
              <br>
              <div class="form-check form-check-inline">
                <label> <input type="radio" name="has_diagnosed" value="1" required> Yes </label>
              </div>
              <div class="form-check form-check-inline">
                <label> <input type="radio" name="has_diagnosed" value="0" required> No </label> 
              </div>
            </div>
          </div>
        </div>    <!-- div row end -->
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>At pregnancy Week: </label><label style="color: red;"> &nbsp;*</label>
              <div class="input-group">
                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                <input type="text" name="preg_week" class="form-control" placeholder="Enter Value" required>
              </div>
            </div>
          </div>
        </div>  <!-- div row end -->
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Confirmed at birth: </label><label style="color: red;"> &nbsp;*</label>
              <br>
              <div class="form-check form-check-inline">
                <label> <input type="radio" name="has_birth_confirmed" value="1" required> Yes </label> 
              </div>
              <div class="form-check form-check-inline">
                <label> <input type="radio" name="has_birth_confirmed" value="0" required> No </label> 
              </div>
            </div>
          </div>
        </div>  <!-- div row end -->        
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Diagnosis comments: </label>
              <div class="input-group">
                <span class="input-group-text"><i class="fa fa-edit"></i></span>
                <input type="text" name="diagnosis_comments" class="form-control" placeholder="Enter Diagnosis Comments">
              </div>
            </div>
          </div>
        </div>  <!-- div row end -->
      </div>
      <hr>
      <div class="row">
        <div class="col-sm-12">
          <h3 id="physical_info" onclick="physical_clickable();" style="cursor: pointer; text-decoration: underline;">Physical Examination</h3>
        </div>
      </div>
      <div id="physical_view">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <br>
              <div class="form-check form-check-inline">
                <label> <input type="checkbox" name="is_head" value="1"> Head </label> 
              </div>
              <div class="form-check form-check-inline">
                <label> <input type="checkbox" name="is_heart" value="1"> Heart/Lungs  </label> 
              </div>
              <div class="form-check form-check-inline">
                <label> <input type="checkbox" name="is_urinary" value="1"> Urinary/Digestive </label> 
              </div>
              <div class="form-check form-check-inline">
                <label> <input type="checkbox" name="is_skin" value="1"> Skin </label> 
              </div>
              <div class="form-check form-check-inline">
                <label> <input type="checkbox" name="is_spine" value="1"> Spine </label> 
              </div>
              <div class="form-check form-check-inline">
                <label> <input type="checkbox" name="is_hips" value="1"> Hips </label> 
              </div>
            </div>
          </div>
        </div>    <!-- div row end -->
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Any Abnormalities: </label>
              <br>
              <div class="form-check form-check-inline">
                <label> <input type="checkbox" name="is_upper" value="1"> Upper Extremities </label> 
              </div>
              <div class="form-check form-check-inline">
                <label> <input type="checkbox" name="is_lower" value="1"> Lower Extremities  </label> 
              </div>
              <div class="form-check form-check-inline">
                <label> <input type="checkbox" name="is_neuro" value="1"> Neurological </label> 
              </div>
            </div>
          </div>
        </div>    <!-- div row end -->
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Any Weakness: </label>
              <br>
              <div class="form-check form-check-inline">
                <label> <input type="checkbox" name="is_arms" value="1"> Arms </label> 
              </div>
              <div class="form-check form-check-inline">
                <label> <input type="checkbox" name="is_legs" value="1"> Legs  </label> 
              </div>
              <div class="form-check form-check-inline">
                <label> <input type="checkbox" name="is_other" value="1"> Other Parts of Body </label> 
              </div>
            </div>
          </div>
        </div>    <!-- div row end -->

      </div>
      <br>
      <!-- bilals route next to appointment/add -->
      <button type="submit" style="margin-bottom: 10px;" class="form-control btn btn-primary">Submit</button>
    </div>
  </div>
</form>
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/inputmask/jquery.inputmask.js') }}"></script>
<script >
  $(function () {
    $('.patient_nav').addClass('active');
    $('.patients_nav_add').addClass('active');
    $('[data-mask]').inputmask();
    $("#date_text").on('change', function() {
      $("#age_text").val(getAge($("#date_text").val()));
    })
  });
  function general_clickable() {
    if($('#general_view').css('display') == 'block') {
      $('#general_view').css('display', 'none');
    }
    else {
      $('#general_view').css('display', 'block');
    }
  }
  function history_clickable() {
    if($('#history_view').css('display') == 'block') {
      $('#history_view').css('display', 'none');
    }
    else {
      $('#history_view').css('display', 'block');
    }
  }
  function diagnosis_clickable() {
    if($('#diagnosis_view').css('display') == 'block') {
      $('#diagnosis_view').css('display', 'none');
    }
    else {
      $('#diagnosis_view').css('display', 'block');
    }
  }
  function physical_clickable() {
    if($('#physical_view').css('display') == 'block') {
      $('#physical_view').css('display', 'none');
    }
    else {
      $('#physical_view').css('display', 'block');
    }
  }
  function getAge(dateString) {
    var now = new Date();
    var today = new Date(now.getYear(),now.getMonth(),now.getDate());

    var yearNow = now.getYear();
    var monthNow = now.getMonth();
    var dateNow = now.getDate();

      // 09/09/1989
    var dob = new Date(dateString.substring(0, 4),
                       dateString.substring(5, 7)-1,                   
                       dateString.substring(8, 10)                  
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

    if ( age.years > 1 ) yearString = " years";
    else yearString = " year";
    if ( age.months> 1 ) monthString = " months";
    else monthString = " month";
    if ( age.days > 1 ) dayString = " days";
    else dayString = " day";


    if ( (age.years > 0) && (age.months > 0) && (age.days > 0) )
      ageString = age.years + yearString + ", " + age.months + monthString + ", and " + age.days + dayString + " old.";
    else if ( (age.years == 0) && (age.months == 0) && (age.days > 0) )
      ageString = "Only " + age.days + dayString + " old!";
    else if ( (age.years > 0) && (age.months == 0) && (age.days == 0) )
      ageString = age.years + yearString + " old. Happy Birthday!!";
    else if ( (age.years > 0) && (age.months > 0) && (age.days == 0) )
      ageString = age.years + yearString + " and " + age.months + monthString + " old.";
    else if ( (age.years == 0) && (age.months > 0) && (age.days > 0) )
      ageString = age.months + monthString + " and " + age.days + dayString + " old.";
    else if ( (age.years > 0) && (age.months == 0) && (age.days > 0) )
      ageString = age.years + yearString + " and " + age.days + dayString + " old.";
    else if ( (age.years == 0) && (age.months > 0) && (age.days == 0) )
      ageString = age.months + monthString + " old.";
    else ageString = "Oops! Could not calculate age!";

    return ageString;
  }
</script>
@endsection
