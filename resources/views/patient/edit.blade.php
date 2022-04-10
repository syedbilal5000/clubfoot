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

<form method="POST" action="edit">
  @csrf
  <!-- <input name="_method" type="hidden" value="PUT"> -->
  @method('PUT')
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
            <label>Reg No: </label>
            <div class="input-group">
              <span class="input-group-text"><i class="fa fa-user"></i></span>
              <input type="text" name="" value="{{ $patient->patient_id }}" class="form-control" placeholder="Reg No" disabled>
            </div>
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
            <label>ICR No: </label>
            <div class="input-group">
              <span class="input-group-text"><i class="fa fa-user"></i></span>
              <input type="text" name="icr_number" value="{{ $patient->icr_number }}" class="form-control" placeholder="Enter ICR No" required>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Patient Name: </label><label style="color: red;"> &nbsp;*</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fa fa-user"></i></span>
              <input type="text" name="patient_name" value="{{ $patient->patient_name }}" class="form-control" placeholder="Enter Patient Name" required>
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
              <input type="text" name="father_name" value="{{ $patient->father_name }}" class="form-control" placeholder="Enter Father Name" required>
            </div>
          </div>
        </div>
      </div>  <!-- div row end -->
      <div class="row">
        <div class="col-md-6">
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
              <label> <input class="form-check-input" type="radio" name="gender" value="{{ $patient->gender == 1 ? $patient->gender : '1'}}" {{ $patient->gender == 1  ? 'checked' : ''}}> Male </label>
            </div>
            <div class="form-check form-check-inline">
              <label> <input class="form-check-input" type="radio" name="gender" value="{{ $patient->gender == 2 ? $patient->gender : '2'}}" {{ $patient->gender == 2  ? 'checked' : ''}}> Female </label>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Select Donor: </label>
            <select id="donors" name="donor_id" class="form-control select2" style="width: 100%;">
              <option selected disabled>Select Donor</option>
              <option value="0">No Donor</option>
            </select>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Date of birth(MM/DD/YYYY): </label><label style="color: red;"> &nbsp;*</label>
            <div class="input-group">
              <input type="date" name="birth_date" value="{{ $patient->birth_date }}" class="form-control" required>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Age: </label>
            <div class="input-group">
              <input type="text" name="age" id="age" placeholder="This should be auto fill" class="form-control" disabled>
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
              <input type="text" name="address" value="{{ $patient->address }}" placeholder="Enter Address 1" class="form-control">
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-8">
          <div class="form-group">
            <label>Address 2: </label>
            <div class="input-group">
              <span class="input-group-text"><i class="fa fa-home"></i></span>
              <input type="text" name="address2" value="{{ $patient->address2 }}" placeholder="Enter Address 2" class="form-control">
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label>Out Of Karachi: </label>
            <br>
            <div class="form-check form-check-inline" style="padding-top: 5px;">
              <label> <input type="checkbox" name="out_of_city" value="{{ $patient->out_of_city == 1 ? $patient->out_of_city : '1'}}" {{ $patient->out_of_city == 1 ? 'checked' : ''}}> &nbsp; Yes </label>
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
              <label> <input type="radio" class="form-check-input" name="has_photo_consent" value="{{ $patient->has_photo_consent == 0 ? $patient->has_photo_consent : '0'}}" {{ $patient->has_photo_consent == 0  ? 'checked' : ''}}> No </label> 
            </div>
            <div class="form-check form-check-inline">
              <label> <input type="radio" class="form-check-input" name="has_photo_consent" value="{{ $patient->has_photo_consent == 1 ? $patient->has_photo_consent : '1'}}" {{ $patient->has_photo_consent == 1  ? 'checked' : ''}}> Yes </label> 
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
              <label> <input type="radio" class="form-check-input" name="relation_to_patient" value="{{ $patient->relation_to_patient == 1 ? $patient->relation_to_patient : '1'}}" {{ $patient->relation_to_patient == 1  ? 'checked' : ''}}> Mother </label> 
            </div>
            <div class="form-check form-check-inline">
              <label> <input type="radio" class="form-check-input" name="relation_to_patient" value="{{ $patient->relation_to_patient == 2 ? $patient->relation_to_patient : '2'}}" {{ $patient->relation_to_patient == 2  ? 'checked' : ''}}> Father </label> 
            </div>
            <div class="form-check form-check-inline">
              <label> <input type="radio" class="form-check-input" name="relation_to_patient" value="{{ $patient->relation_to_patient == 3 ? $patient->relation_to_patient : '3'}}" {{ $patient->relation_to_patient == 3  ? 'checked' : ''}}> Sibling </label>             
            </div>
            <div class="form-check form-check-inline">
              <label> <input type="radio" class="form-check-input" name="relation_to_patient" value="{{ $patient->relation_to_patient == 0 ? $patient->relation_to_patient : '0'}}" {{ $patient->relation_to_patient == 0  ? 'checked' : ''}}> Other </label> 
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label>Name: </label>
            <div class="input-group">
              <span class="input-group-text"><i class="fa fa-user"></i></span>
              <input type="text" name="guardian_name" value="{{ $patient->guardian_name }}" class="form-control" placeholder="Enter Parents Name">
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
              <input type="text" name="guardian_number" value="{{ $patient->guardian_number }}" class="form-control" data-inputmask='"mask": "0399-9999999"' data-mask required>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label>Phone number 2: </label>
            <div class="input-group">
              <span class="input-group-text"><i class="fa fa-phone"></i></span>
              <input type="text" name="guardian_number_2" value="{{ $patient->guardian_number_2 }}" class="form-control" data-inputmask='"mask": "0399-9999999"' data-mask>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label>CNIC No: </label>
            <div class="input-group">
              <span class="input-group-text">&nbsp; <i class="fas fa-info"></i>&nbsp; </span>
              <input type="text" name="guardian_cnic" value="{{ $patient->guardian_cnic }}" class="form-control" data-inputmask='"mask": "99999-9999999-9"' data-mask>
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
              <label> <input type="radio" name="is_relatable" value="{{ $patient->is_relatable == 1 ? $patient->is_relatable : '1'}}" {{ $patient->is_relatable == 1  ? 'checked' : ''}}> Yes </label> 
            </div>
            <div class="form-check form-check-inline">
              <label> <input type="radio" name="is_relatable" value="{{ $patient->is_relatable == 0 ? $patient->is_relatable : '0'}}" {{ $patient->is_relatable == 0  ? 'checked' : ''}}> No </label> 
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Length of Pregnancy(in weeks): </label><label style="color: red;"> &nbsp;*</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fa fa-edit"></i></span>
              <input type="text" id="weekDetail" name="preg_len" value="{{ $patient->preg_len }}" class="form-control" required>
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
              <label> <input type="radio" name="has_complicated_preg" value="{{ $patient->has_complicated_preg == 1 ? $patient->has_complicated_preg : '1'}}" {{ $patient->has_complicated_preg == 1  ? 'checked' : ''}}> Yes </label> 
            </div>
            <div class="form-check form-check-inline">
              <label> <input type="radio" name="has_complicated_preg" value="{{ $patient->has_complicated_preg == 0 ? $patient->has_complicated_preg : '0'}}" {{ $patient->has_complicated_preg == 0  ? 'checked' : ''}}> No </label> 
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
              <input type="text" name="complications" value="{{ $patient->complications }}" class="form-control">
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
              <label> <input type="radio" name="is_alcoholic" value="{{ $patient->is_alcoholic == 1 ? $patient->is_alcoholic : '1'}}" {{ $patient->is_alcoholic == 1  ? 'checked' : ''}}> Yes </label> 
            </div>
            <div class="form-check form-check-inline">
              <label> <input type="radio" name="is_alcoholic" value="{{ $patient->is_alcoholic == 0 ? $patient->is_alcoholic : '0'}}" {{ $patient->is_alcoholic == 0  ? 'checked' : ''}}> No </label> 
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
              <label> <input type="radio" name="is_smoked" value="{{ $patient->is_smoked == 1 ? $patient->is_smoked : '1'}}" {{ $patient->is_smoked == 1  ? 'checked' : ''}}> Yes </label> 
            </div>
            <div class="form-check form-check-inline">
              <label> <input type="radio" name="is_smoked" value="{{ $patient->is_smoked == 0 ? $patient->is_smoked : '0'}}" {{ $patient->is_smoked == 0  ? 'checked' : ''}}> No </label> 
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
              <label> <input type="radio" name="has_complicated_birth" value="{{ $patient->has_complicated_birth == 1 ? $patient->has_complicated_birth : '1'}}" {{ $patient->has_complicated_birth == 1  ? 'checked' : ''}}> Yes </label> 
            </div>
            <div class="form-check form-check-inline">
              <label> <input type="radio" name="has_complicated_birth" value="{{ $patient->has_complicated_birth == 0 ? $patient->has_complicated_birth : '0'}}" {{ $patient->has_complicated_birth == 0  ? 'checked' : ''}}> No </label> 
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
              <label> <input type="radio" name="birth_place" value="{{ $patient->birth_place == 1 ? $patient->birth_place : '1'}}" {{ $patient->birth_place == 1  ? 'checked' : ''}}> Hospital </label> 
            </div>
            <div class="form-check form-check-inline">
              <label> <input type="radio" name="birth_place" value="{{ $patient->birth_place == 2 ? $patient->birth_place : '2'}}" {{ $patient->birth_place == 2  ? 'checked' : ''}}> Clinic </label> 
            </div>
            <div class="form-check form-check-inline">
              <label> <input type="radio" name="birth_place" value="{{ $patient->birth_place == 3 ? $patient->birth_place : '3'}}" {{ $patient->birth_place == 3  ? 'checked' : ''}}> Home </label> 
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
              <label> <input type="radio" name="referral_source" value="{{ $patient->referral_source == 1 ? $patient->referral_source : '1'}}" {{ $patient->referral_source == 1  ? 'checked' : ''}}> Hospital/Clinic </label> 
            </div>
            <div class="form-check form-check-inline">
              <label> <input type="radio" name="referral_source" value="{{ $patient->referral_source == 2 ? $patient->referral_source : '2'}}" {{ $patient->referral_source == 2  ? 'checked' : ''}}> Midwife </label> 
            </div>
            <div class="form-check form-check-inline">
              <label> <input type="radio" name="referral_source" value="{{ $patient->referral_source == 3 ? $patient->referral_source : '3'}}" {{ $patient->referral_source == 3  ? 'checked' : ''}}> Word of mouth </label> 
            </div>
            <div class="form-check form-check-inline">
              <label> <input type="radio" name="referral_source" value="{{ $patient->referral_source == 0 ? $patient->referral_source : '0'}}" {{ $patient->referral_source == 0  ? 'checked' : ''}}> Other </label> 
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
              <input type="text" name="doctor_name" value="{{ $patient->doctor_name }}" class="form-control" placeholder="Enter Doctor Name">
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label>Hospital/Clinic name: </label>
            <div class="input-group">
              <span class="input-group-text"><i class="fa fa-hospital"></i></span>
              <input type="text" name="referral_hospital" value="{{ $patient->referral_hospital }}" class="form-control" placeholder="Enter Hospital/Clinic Name">
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label>If Other, please specify: </label>
            <div class="input-group">
              <span class="input-group-text"><i class="fa fa-user"></i></span>
              <input type="text" name="other_referral" value="{{ $patient->other_referral }}" class="form-control" placeholder="Enter Name">
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
              <input type="text" name="evaluator_name" value="{{ $patient->evaluator_name }}" class="form-control" placeholder="Enter Evaluator Name">
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Evaluation Date: </label>
            <div class="input-group">
              <span class="input-group-text"><i class="fa fa-calendar"></i></span>
              <input type="date" name="evaluation_date" value="{{ $patient->evaluation_date }}" class="form-control" >
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
              <label> <input type="radio" name="evaluator_title" value="{{ $patient->evaluator_title == 1 ? $patient->evaluator_title : '1'}}" {{ $patient->evaluator_title == 1  ? 'checked' : ''}}> Doctor </label> 
            </div>
            <div class="form-check form-check-inline">
              <label> <input type="radio" name="evaluator_title" value="{{ $patient->evaluator_title == 2 ? $patient->evaluator_title : '2'}}" {{ $patient->evaluator_title == 2  ? 'checked' : ''}}> Nurse </label> 
            </div>
            <div class="form-check form-check-inline">
              <label> <input type="radio" name="evaluator_title" value="{{ $patient->evaluator_title == 3 ? $patient->evaluator_title : '3'}}" {{ $patient->evaluator_title == 3  ? 'checked' : ''}}> Midwife </label> 
            </div>
            <div class="form-check form-check-inline">
              <label> <input type="radio" name="evaluator_title" value="{{ $patient->evaluator_title == 4 ? $patient->evaluator_title : '4'}}" {{ $patient->evaluator_title == 4  ? 'checked' : ''}}> Physical therapist </label> 
            </div>
            <div class="form-check form-check-inline">
              <label> <input type="radio" name="evaluator_title" value="{{ $patient->evaluator_title == 0 ? $patient->evaluator_title : '0'}}" {{ $patient->evaluator_title == 0  ? 'checked' : ''}}> Other </label> 
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
              <label> <input type="radio" name="feet_affected" required value="{{ $patient->feet_affected == 1 ? $patient->feet_affected : '1'}}" {{ $patient->feet_affected == 1 ? 'checked' : ''}}> Right </label> 
            </div>
            <div class="form-check form-check-inline">
              <label> <input type="radio" name="feet_affected" required value="{{ $patient->feet_affected == 2 ? $patient->feet_affected : '2'}}" {{ $patient->feet_affected == 2 ? 'checked' : ''}}> Left </label> 
            </div>
            <div class="form-check form-check-inline">
              <label> <input type="radio" name="feet_affected" required value="{{ $patient->feet_affected == 3 ? $patient->feet_affected : '3'}}" {{ $patient->feet_affected == 3 ? 'checked' : ''}}> Both </label> 
            </div>
          </div>
        </div>
      </div>    <!-- div row end -->
      <div class="row">
        <div class="col-md-8">
          <div class="form-group">
            <label>Diagnosis: </label><label style="color: red;"> &nbsp;*</label>
            <br>
            <div class="form-check form-check-inline">
              <label> <input type="radio" class = "diagnosis_class" name="diagnosis" required value="{{ $patient->diagnosis == 1 ? $patient->diagnosis : '1'}}" {{ $patient->diagnosis == 1 ? 'checked' : ''}}> Idiopathic Clubfoot </label> 
            </div>
            <div class="form-check form-check-inline">
              <label> <input type="radio" class = "diagnosis_class" name="diagnosis" required value="{{ $patient->diagnosis == 2 ? $patient->diagnosis : '2'}}" {{ $patient->diagnosis == 2 ? 'checked' : ''}}> Syndromic Clubfoot </label> 
            </div>
            <div class="form-check form-check-inline">
              <label> <input type="radio" class = "diagnosis_class" name="diagnosis" required value="{{ $patient->diagnosis == 3 ? $patient->diagnosis : '3'}}" {{ $patient->diagnosis == 3 ? 'checked' : ''}}> Neuropathic Clubfoot </label> 
            </div>
            <div class="form-check form-check-inline">
              <label> <input type="radio" class = "diagnosis_class" name="diagnosis" required value="{{ $patient->diagnosis == 0 ? $patient->diagnosis : '0'}}" {{ $patient->diagnosis == 0 ? 'checked' : ''}}> Other </label> 
            </div>
          </div>
        </div>
        <div class="col-md-4" id="div_other_diagnosis" style="display: {{ $patient->diagnosis == 0 ? 'block' : 'none'}}">
          <div class="form-group">
            <label>Specific Other: </label>
            <div class="input-group" >
              <span class="input-group-text"><i class="fa fa-edit"></i></span>
              <input type="text" name="other_diagnosis" id="other_diagnosis" value="{{ $patient->other_diagnosis }}" class="form-control" >
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
              <label> <input type="radio" name="has_birth_deformity" required value="{{ $patient->has_birth_deformity == 1 ? $patient->has_birth_deformity : '1'}}" {{ $patient->has_birth_deformity == 1 ? 'checked' : ''}}> Yes </label> 
            </div>
            <div class="form-check form-check-inline">
              <label> <input type="radio" name="has_birth_deformity" required value="{{ $patient->has_birth_deformity == 0 ? $patient->has_birth_deformity : '0'}}" {{ $patient->has_birth_deformity == 0 ? 'checked' : ''}}> No </label> 
            </div>
          </div>
        </div>
      </div>    <!-- div row end -->
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Any Previous treatments: </label>
            <br>
            <div class="form-check form-check-inline">
              <label> <input type="radio" name="has_treated" value="{{ $patient->has_treated == 1 ? $patient->has_treated : '1'}}" {{ $patient->has_treated == 1 ? 'checked' : ''}}> Yes </label> 
            </div>
            <div class="form-check form-check-inline">
              <label> <input type="radio" name="has_treated" value="{{ $patient->has_treated == 0 ? $patient->has_treated : '0'}}" {{ $patient->has_treated == 0 ? 'checked' : ''}}> No </label> 
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>How many previous treatment sessions: </label>
            <div class="input-group">
              <span class="input-group-text"><i class="fa fa-check"></i></span>
              <input type="text" name="treatments" value="{{ $patient->treatments }}" class="form-control" placeholder="Enter Sessions">
            </div>
          </div>
        </div>
      </div>    <!-- div row end -->
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Type of previous treatment(S): </label>
            <br>
            <div class="form-check form-check-inline">
              <label> <input type="radio" name="treatment_type" value="{{ $patient->treatment_type == 1 ? $patient->treatment_type : '1'}}" {{ $patient->treatment_type == 1 ? 'checked' : ''}}> Casting above knee </label> 
            </div>
            <div class="form-check form-check-inline">
              <label> <input type="radio" name="treatment_type" value="{{ $patient->treatment_type == 2 ? $patient->treatment_type : '2'}}" {{ $patient->treatment_type == 2 ? 'checked' : ''}}> Casting below knee </label> 
            </div>
            <div class="form-check form-check-inline">
              <label> <input type="radio" name="treatment_type" value="{{ $patient->treatment_type == 3 ? $patient->treatment_type : '3'}}" {{ $patient->treatment_type == 3 ? 'checked' : ''}}> Physiotherapy </label> 
            </div>
            <div class="form-check form-check-inline">
              <label> <input type="radio" name="treatment_type" value="{{ $patient->treatment_type == 0 ? $patient->treatment_type : '0'}}" {{ $patient->treatment_type == 0 ? 'checked' : ''}}> Other </label> 
            </div>
          </div>
        </div>
      </div>    <!-- div row end -->
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Diagnosed prenatally: </label>
            <br>
            <div class="form-check form-check-inline">
              <label> <input type="radio" name="has_diagnosed" value="{{ $patient->has_diagnosed == 1 ? $patient->has_diagnosed : '1'}}" {{ $patient->has_diagnosed == 1 ? 'checked' : ''}}> Yes </label> 
            </div>
            <div class="form-check form-check-inline">
              <label> <input type="radio" name="has_diagnosed" value="{{ $patient->has_diagnosed == 0 ? $patient->has_diagnosed : '0'}}" {{ $patient->has_diagnosed == 0 ? 'checked' : ''}}> No </label> 
            </div>
          </div>
        </div>
      </div>    <!-- div row end -->
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>At pregnancy Week: </label>
            <div class="input-group">
              <span class="input-group-text"><i class="fa fa-calendar"></i></span>
              <input type="text" name="preg_week" value="{{ $patient->preg_week }}" class="form-control" placeholder="Enter Value">
            </div>
          </div>
        </div>
      </div>  <!-- div row end -->
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Confirmed at birth: </label>
            <br>
            <div class="form-check form-check-inline">
              <label> <input type="radio" name="has_birth_confirmed" value="{{ $patient->has_birth_confirmed == 1 ? $patient->has_birth_confirmed : '1'}}" {{ $patient->has_birth_confirmed == 1 ? 'checked' : ''}}> Yes </label> 
            </div>
            <div class="form-check form-check-inline">
              <label> <input type="radio" name="has_birth_confirmed" value="{{ $patient->has_birth_confirmed == 0 ? $patient->has_birth_confirmed : '0'}}" {{ $patient->has_birth_confirmed == 0 ? 'checked' : ''}}> No </label> 
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
              <input type="text" name="diagnosis_comments" value="{{ $patient->diagnosis_comments }}" class="form-control" placeholder="Enter Diagnosis Comments">
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
              <label> <input type="checkbox" name="is_head" value="{{ $patient->is_head == 1 ? $patient->is_head : '1'}}" {{ $patient->is_head == 1 ? 'checked' : ''}}> Head </label> 
            </div>
            <div class="form-check form-check-inline">
              <label> <input type="checkbox" name="is_heart" value="{{ $patient->is_heart == 1 ? $patient->is_heart : '1'}}" {{ $patient->is_heart == 1 ? 'checked' : ''}}> Heart/Lungs  </label> 
            </div>
            <div class="form-check form-check-inline">
              <label> <input type="checkbox" name="is_urinary" value="{{ $patient->is_urinary == 1 ? $patient->is_urinary : '1'}}" {{ $patient->is_urinary == 1 ? 'checked' : ''}}> Urinary/Digestive </label> 
            </div>
            <div class="form-check form-check-inline">
              <label> <input type="checkbox" name="is_skin" value="{{ $patient->is_skin == 1 ? $patient->is_skin : '1'}}" {{ $patient->is_skin == 1 ? 'checked' : ''}}> Skin </label> 
            </div>
            <div class="form-check form-check-inline">
              <label> <input type="checkbox" name="is_spine" value="{{ $patient->is_spine == 1 ? $patient->is_spine : '1'}}" {{ $patient->is_spine == 1 ? 'checked' : ''}}> Spine </label> 
            </div>
            <div class="form-check form-check-inline">
              <label> <input type="checkbox" name="is_hips" value="{{ $patient->is_hips == 1 ? $patient->is_hips : '1'}}" {{ $patient->is_hips == 1 ? 'checked' : ''}}> Hips </label> 
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
              <label> <input type="checkbox" name="is_upper" value="{{ $patient->is_upper == 1 ? $patient->is_upper : '1'}}" {{ $patient->is_upper == 1 ? 'checked' : ''}}> Upper Extremities </label> 
            </div>
            <div class="form-check form-check-inline">
              <label> <input type="checkbox" name="is_lower" value="{{ $patient->is_lower == 1 ? $patient->is_lower : '1'}}" {{ $patient->is_lower == 1 ? 'checked' : ''}}> Lower Extremities  </label> 
            </div>
            <div class="form-check form-check-inline">
              <label> <input type="checkbox" name="is_neuro" value="{{ $patient->is_neuro == 1 ? $patient->is_neuro : '1'}}" {{ $patient->is_neuro == 1 ? 'checked' : ''}}> Neurological </label> 
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
              <label> <input type="checkbox" name="is_arms" value="{{ $patient->is_arms == 1 ? $patient->is_arms : '1'}}" {{ $patient->is_arms == 1 ? 'checked' : ''}}> Arms </label> 
            </div>
            <div class="form-check form-check-inline">
              <label> <input type="checkbox" name="is_legs" value="{{ $patient->is_legs == 1 ? $patient->is_legs : '1'}}" {{ $patient->is_legs == 1 ? 'checked' : ''}}> Legs  </label> 
            </div>
            <div class="form-check form-check-inline">
              <label> <input type="checkbox" name="is_other" value="{{ $patient->is_other == 1 ? $patient->is_other : '1'}}" {{ $patient->is_other == 1 ? 'checked' : ''}}> Other Parts of Body </label> 
            </div>
          </div>
        </div>
      </div>    <!-- div row end -->

    </div>
    <br>
    <button type="submit" style="margin-bottom: 10px;" class="form-control btn btn-primary">Submit</button>
  </div>
</form>
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/inputmask/jquery.inputmask.js') }}"></script>
<script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
<script>
  var output = '';
  var donors = {!! json_encode($donors) !!};
  var donor_id = {!! json_encode($patient->donor_id) !!};
  var birth_date = {!! json_encode($patient->birth_date) !!};
  $("#age").val(getAge(birth_date));

  view_donors(donors);
  
  function view_donors(donors) {
    if (donors.length > 0) {
        for (i = 0; i < donors.length; i++) {
          output += `<option value="${donors[i]['id']}">${donors[i]['first_name']} ${donors[i]['last_name']}</option>`;
        }
    } else {
        output = '<option value="-1">No Data</option>';
    }
    $('#donors').append(output);
    $('#donors').val(donor_id);
  }

  $(function () {
    $('.select2').select2();
    $('.patient_nav').addClass('active');
    $('.patients_nav_add').addClass('active');
    $('[data-mask]').inputmask();
    $("#date_text").on('change', function() {
      $("#age_text").val(getAge($("#date_text").val()));
    });
    $(".diagnosis_class").on("change", function() {
      var id_dia = $("input[type='radio'][name='diagnosis']:checked").val();
      $("#div_other_diagnosis").css("display", id_dia == "0" ? "block" : "none");
      $("#other_diagnosis").prop("required", id_dia == "0" ? true : false);
      $("#other_diagnosis").val(id_dia != "0" ? null : $("#other_diagnosis").val());
    });
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
