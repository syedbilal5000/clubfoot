<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Patient;
use App\PatientFamily;
use App\PatientDiagnosis;
use App\PatientExamination;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    // show registration index
    public function register_index()
    {

        return view('registration.index');
    }

    public function register_appoint()
    {
        return view('appointment.add');
    }

    // show appointment index
    public function appointment_index()
    {
        return view('appointment.index');
    }

    // show visit index
    public function visit_index()
    {
        $patients = $this->get_patients();
        return view('visit.index', ['patients' => $patients]);
    }

    // Patients report view
    public function patients_index()
    {
        $patients = $this->get_patients();
        return view('patients.index', ['patients' => $patients]);
    }

    // get patients data
    public function get_patients()
    {
        // $patients = DB::select('SELECT * FROM patients WHERE active = ?', [1]);
        $patients = DB::select("SELECT * FROM patients;");
        return $patients;
    }

    // registration add
    public function register_store(Request $request)
    {
        // dd($request);
        // Add patient general info
        $patient = new Patient;
        $patient->patient_name = $request->patient_name;
        $patient->father_name = $request->father_name;
        // 0: "Other", 1: "Male", 2: "Female"
        $patient->gender = isset($request->gender) ? $request->gender : 0;
        $patient->birth_date = $request->birth_date;
        $patient->address = $request->address;
        $patient->address2 = $request->address2;
        // 0: false, 1: true
        $patient->has_photo_consent = isset($request->has_photo_consent) ? $request->has_photo_consent : 0;
        // 0: "Other", 1: "Mother", 2: "Father", 3: "Sibling"
        $patient->relation_to_patient = isset($request->relation_to_patient) ? $request->relation_to_patient : 0;
        $patient->guardian_name = $request->guardian_name;
        $patient->guardian_number = $request->guardian_number;
        $patient->guardian_number_2 = $request->guardian_number_2;
        $patient->guardian_cnic = $request->guardian_cnic;
        $patient->save();
        $patient_id = $patient->id;
        // Add patient family info
        $patient_family = new PatientFamily;
        $patient_family->patient_id = $patient_id;
        $patient_family->is_relatable = isset($request->is_relatable) ? $request->is_relatable : 0;
        $patient_family->preg_len = isset($request->preg_len) ? $request->preg_len : 0;
        $patient_family->has_complicated_preg = isset($request->has_complicated_preg) ? $request->has_complicated_preg : 0;
        $patient_family->is_alcoholic = isset($request->is_alcoholic) ? $request->is_alcoholic : 0;
        $patient_family->is_smoked = isset($request->is_smoked) ? $request->is_smoked : 0;
        $patient_family->has_complicated_birth = isset($request->has_complicated_birth) ? $request->has_complicated_birth : 0;
        // 0: "Other", 1: "Hospital", 2: "Clinic", 3: "Home"
        $patient_family->birth_place = isset($request->birth_place) ? $request->birth_place : 0;
        // 0: "Other", 1: "Hospital/Clinic", 2: "Midwife", 3: "Word of mouth"
        $patient_family->referral_source = isset($request->referral_source) ? $request->referral_source : 0;
        $patient_family->doctor_name = $request->doctor_name;
        $patient_family->referral_hospital = $request->referral_hospital;
        $patient_family->other_referral = $request->other_referral;
        $patient_family->save();
        // Add patient diagnosis info
        $patient_diagnosis = new PatientDiagnosis;
        $patient_diagnosis->patient_id = $patient_id;
        $patient_diagnosis->evaluator_name = $request->evaluator_name;
        $patient_diagnosis->evaluation_date = $request->evaluation_date;
        $patient_diagnosis->evaluator_title = isset($request->evaluator_title) ? $request->evaluator_title : 0;
        $patient_diagnosis->feet_affected = isset($request->feet_affected) ? $request->feet_affected : 0;
        $patient_diagnosis->diagnosis = isset($request->diagnosis) ? $request->diagnosis : 0;
        $patient_diagnosis->has_birth_deformity = isset($request->has_birth_deformity) ? $request->has_birth_deformity : 0;
        $patient_diagnosis->has_treated = isset($request->has_treated) ? $request->has_treated : 0;
        $patient_diagnosis->treatments = isset($request->treatments) ? $request->treatments : 0;
        $patient_diagnosis->treatment_type = isset($request->treatment_type) ? $request->treatment_type : 0;
        $patient_diagnosis->has_diagnosed = isset($request->has_diagnosed) ? $request->has_diagnosed : 0;
        $patient_diagnosis->preg_week = isset($request->preg_week) ? $request->preg_week : 0;
        $patient_diagnosis->has_birth_confirmed = isset($request->has_birth_confirmed) ? $request->has_birth_confirmed : 0;
        $patient_diagnosis->diagnosis_comments = $request->diagnosis_comments;
        $patient_diagnosis->save();
        // Add patient examination info
        $patient_examination = new PatientExamination;
        $patient_examination->patient_id = $patient_id;
        if(isset($request->examinations))
        {
            $patient_examination->head = in_array("head", $request->examinations);
            $patient_examination->heart = in_array("heart", $request->examinations);
            $patient_examination->urinary = in_array("urinary", $request->examinations);
            $patient_examination->skin = in_array("skin", $request->examinations);
            $patient_examination->spine = in_array("spine", $request->examinations);
            $patient_examination->hips = in_array("hips", $request->examinations);
        }
        if(isset($request->abnormalities))
        {
            $patient_examination->upper = in_array("upper", $request->abnormalities);
            $patient_examination->lower = in_array("lower", $request->abnormalities);
            $patient_examination->neuro = in_array("neuro", $request->abnormalities);
        }
        if(isset($request->weaknesses))
        {
            $patient_examination->arms = in_array("arms", $request->weaknesses);
            $patient_examination->legs = in_array("legs", $request->weaknesses);
            $patient_examination->other = in_array("other", $request->weaknesses);
        }
        $patient_examination->save();
        // print_r($patient);
        dd(11);
        return redirect('registration');
    }
}
