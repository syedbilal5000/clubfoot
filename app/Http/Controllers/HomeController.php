<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Patient;
use App\PatientFamily;
use App\PatientDiagnosis;
use App\PatientExamination;
use App\Appointment;
use App\Visit;

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

    public function dev(Request $request)
    {
        $patient_id = 10;
        $msg = 'Patient Added Successfully.';
        $data = ['success' => $msg, 'patient_id' => $patient_id];
        return redirect('/appointment/create/' . $patient_id);
        // dd(123);
    }

    // Patients report view
    public function patient_index()
    {
        $patients = $this->get_patients();
        return view('patient.index', ['patients' => $patients]);
    }

    // this method will generate appointment date base on availability
    public function generate_date()
    {
        $pending = 120;
        $pending = DB::select("SELECT COALESCE(COUNT(*), 0) pendings FROM appointment WHERE appointment_status = 2")[0]->pendings;
        $lookups = DB::select("SELECT * FROM lookups");
        $day_cnt1 = $lookups[0]->count;
        $day_cnt2 = $lookups[1]->count;
        $total_count = $day_cnt1 + $day_cnt2;
        $nextWeek = ceil ($pending / $total_count); // number of weeks: 1, 2, ...
        $criteria = (($nextWeek - 1) * $total_count) + $day_cnt1;
        $day = ($criteria >= $pending) ? 1 : 2; // 1 for 1st day of the week
        // $next = strtotime('tuesday');
        $next = strtotime($lookups[$day - 1]->name);
        $date = date('Y-m-d', strtotime('+' . $nextWeek - 1 . ' weeks', $next));
        return $date;
    }

    // show patients create
    public function patient_create()
    {

        return view('patient.create');
    }

    public function visit_create()
    {
        $patients = $this->get_patients();
        return view('visit.create', ['patients' => $patients]);
    }

    // show patients edit
    public function patient_edit($id)
    {
        $patient = DB::select("SELECT * FROM patients p LEFT JOIN patient_families pf ON pf.patient_id = p.patient_id LEFT JOIN patient_diagnoses pd ON pd.patient_id = p.patient_id LEFT JOIN patient_examinations pe ON pe.patient_id = p.patient_id WHERE p.patient_id = " . $id . ";");
        if (!$patient) {
            return redirect('patient')->with('error', 'Incorrect Patient.');
        }
        // dd($patient);
        $patient = (object) $patient[0];
        return view('patient.edit', ['patient' => $patient]);
    }    

    // show appointment create
    public function appoint_create($patient_id=0)
    {
        $patients = $this->get_patients();
        $date = $this->generate_date();
        $data = ['patients' => $patients, 'date' => $date, 'patient_id' => $patient_id, 'success' => 'Patient Added Successfully.'];
        return view('appointment.create')->with($data);
    }

    // show appointment index
    public function appointment_index()
    {
        // $patients_appoint = $this->get_patients_with_appointment();
        $patients_appoint = $this->get_data_appoint("Pending");
        return view('appointment.list', ['patients_appoint' => $patients_appoint]);
    }

    // show visit index
    public function visit_index()
    {
        $patients = $this->get_patients();
        return view('visit.index', ['patients' => $patients]);
    }

    // get patients data
    public function get_patients()
    {
        $patients = DB::select("SELECT * FROM patients;");
        return $patients;
    }

    // public function get_patients_with_appointment()
    // {
    //     $patients_appoint = DB::select("SELECT p.patient_id, p.patient_name, p.guardian_number, p.guardian_cnic, a.appointment_id, a.appointment_date, a.appointment_status, a.previous_appointment_id, (SELECT status_name FROM status WHERE id =a.appointment_status) AS status FROM patients p JOIN appointment a ON p.patient_id = a.patient_id WHERE a.appointment_status = (SELECT id FROM status WHERE status_name = 'Pending');");
    //     return $patients_appoint;
    // }

    public function get_data_appoint($status)
    {
        $patients_appoint = DB::select("SELECT p.patient_id, p.patient_name, p.guardian_number, p.guardian_cnic, a.appointment_id, a.appointment_date, a.appointment_status, a.previous_appointment_id, (SELECT status_name FROM status WHERE id =a.appointment_status) AS status FROM patients p JOIN appointment a ON p.patient_id = a.patient_id WHERE a.appointment_status = (SELECT id FROM status WHERE status_name = '$status');");
        return $patients_appoint;
    }

    public function get_visits($patient_id)
    {
        $patients_appoint = DB::select("SELECT * FROM visit_details WHERE patient_id = '$patient_id';");
        return $patients_appoint;
    }

    // patient create
    public function patient_store(Request $request)
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
        $patient->guardian_cnic = isset($request->guardian_cnic) ? $request->guardian_cnic : '';
        $patient->inserted_at = date("Y-m-d");
        $patient->save();
        $patient_id = $patient->patient_id;
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
        $patient_examination->is_head = isset($request->is_head) ? $request->is_head : 0;
        $patient_examination->is_heart = isset($request->is_heart) ? $request->is_heart : 0;
        $patient_examination->is_urinary = isset($request->is_urinary) ? $request->is_urinary : 0;
        $patient_examination->is_skin = isset($request->is_skin) ? $request->is_skin : 0;
        $patient_examination->is_spine = isset($request->is_spine) ? $request->is_spine : 0;
        $patient_examination->is_hips = isset($request->is_hips) ? $request->is_hips : 0;
        $patient_examination->is_upper = isset($request->is_upper) ? $request->is_upper : 0;
        $patient_examination->is_lower = isset($request->is_lower) ? $request->is_lower : 0;
        $patient_examination->is_neuro = isset($request->is_neuro) ? $request->is_neuro : 0;
        $patient_examination->is_arms = isset($request->is_arms) ? $request->is_arms : 0;
        $patient_examination->is_legs = isset($request->is_legs) ? $request->is_legs : 0;
        $patient_examination->is_other = isset($request->is_other) ? $request->is_other : 0;
        $patient_examination->save();
        return redirect('/appointment/create/' . $patient_id)->with('success', 'Patient Added Successfully.');
    }

    // appointment create
    public function appoint_store(Request $request)
    {
        $patient_id = $request->patient_id;
        $appoint = DB::select("UPDATE appointment SET appointment_status = 4 WHERE appointment_id IN (SELECT appointment_id FROM appointment WHERE patient_id = " . $patient_id . " AND appointment_status = 2)");
        // Add patient general info
        $appointment = new Appointment;
        $appointment->appointment_date = $request->appointment_date;
        $appointment->patient_id = $patient_id;
        $appointment->appointment_status = 2; // Pending - status
        $appointment->previous_appointment_id = 0; // for new appointment
        $appointment->inserted_at = date("Y-m-d");
        $appointment->save();
        return redirect('/appointment')->with('success', 'Appointment Added Successfully.');
        dd($request);
    }

    // visit create
    public function visit_store(Request $request)
    {
        // dd($request);
        $patient_id = $request->patient_id;
        $query = DB::select("SELECT COALESCE(appointment_id, 0) appoint_id FROM appointment WHERE patient_id = " . $patient_id . " AND appointment_status = 2 LIMIT 1");
        $appoint_id = ($query != array()) ? $query[0]->appoint_id : 0;
        // Add visit
        $visit = new Visit;
        $visit->patient_id = $patient_id;
        $visit->visit_date = $request->visit_date;
        $visit->next_visit_date = $request->next_visit_date;
        $visit->appointment_id = $appoint_id;
        $visit->side = $request->side;
        $visit->CLB = $request->CLB;
        $visit->MC = $request->MC;
        $visit->LHT = $request->LHT;
        $visit->PC = $request->PC;
        $visit->RE = $request->RE;
        $visit->EH = $request->EH;
        $visit->mid_foot_score = $request->mid_foot_score;
        $visit->hind_foot_score = $request->hind_foot_score;
        $visit->total_score = $request->total_score;
        $visit->treatment = $request->treatment;
        $visit->complication = $request->complication;
        $visit->description = $request->description;
        $visit->inserted_at = date("Y-m-d");
        $visit->save();
        if(isset($request->side2)) {
            $visit2 = new Visit;
            $visit2->patient_id = $patient_id;
            $visit2->visit_date = $request->visit_date2;
            $visit2->next_visit_date = $request->next_visit_date2;
            $visit2->appointment_id = $appoint_id;
            $visit2->side = $request->side2;
            $visit2->CLB = $request->CLB2;
            $visit2->MC = $request->MC2;
            $visit2->LHT = $request->LHT2;
            $visit2->PC = $request->PC2;
            $visit2->RE = $request->RE2;
            $visit2->EH = $request->EH2;
            $visit2->mid_foot_score = $request->mid_foot_score2;
            $visit2->hind_foot_score = $request->hind_foot_score2;
            $visit2->total_score = $request->total_score2;
            $visit2->treatment = $request->treatment2;
            $visit2->complication = $request->complication2;
            $visit2->description = $request->description;
            $visit2->inserted_at = date("Y-m-d");
            $visit2->save();
        }
        $appoint = DB::select("UPDATE appointment SET appointment_status = 1 WHERE appointment_id = " . $appoint_id);
        // dd($request);
        return redirect('/visit')->with('success', 'Visit Added Successfully.');
        dd($request);
    }

    // patient update
    public function patient_update(Request $request, $id)
    {
        // dd($request);
        // Add patient general info
        $patient = Patient::find($id);
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
        $patient->guardian_cnic = isset($request->guardian_cnic) ? $request->guardian_cnic : '';
        $patient->icr_number = $request->icr_number;
        $patient->save();
        $patient_id = $patient->id;
        // Add patient family info
        $patient_family = PatientFamily::where('patient_id', '=', $id)->firstOrFail();
        // $patient_family->patient_id = $patient_id;
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
        $patient_diagnosis = PatientDiagnosis::where('patient_id', '=', $id)->firstOrFail();
        // $patient_diagnosis->patient_id = $patient_id;
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
        $patient_examination = PatientExamination::where('patient_id', '=', $id)->firstOrFail();
        // $patient_examination->patient_id = $patient_id;
        $patient_examination->is_head = isset($request->is_head) ? $request->is_head : 0;
        $patient_examination->is_heart = isset($request->is_heart) ? $request->is_heart : 0;
        $patient_examination->is_urinary = isset($request->is_urinary) ? $request->is_urinary : 0;
        $patient_examination->is_skin = isset($request->is_skin) ? $request->is_skin : 0;
        $patient_examination->is_spine = isset($request->is_spine) ? $request->is_spine : 0;
        $patient_examination->is_hips = isset($request->is_hips) ? $request->is_hips : 0;
        $patient_examination->is_upper = isset($request->is_upper) ? $request->is_upper : 0;
        $patient_examination->is_lower = isset($request->is_lower) ? $request->is_lower : 0;
        $patient_examination->is_neuro = isset($request->is_neuro) ? $request->is_neuro : 0;
        $patient_examination->is_arms = isset($request->is_arms) ? $request->is_arms : 0;
        $patient_examination->is_legs = isset($request->is_legs) ? $request->is_legs : 0;
        $patient_examination->is_other = isset($request->is_other) ? $request->is_other : 0;
        $patient_examination->save();
        // print_r($patient);
        // dd(11);
        return redirect('appointment/create');
    }

    // appointment bulk update
    public function appoint_update(Request $request)
    {
        // print_r($request->appoint_ids);
        $query = "UPDATE appointment SET ";
        if ($request->selected_option == 2) {
            $query .= "appointment_status = $request->change_status ";
        } else if ($request->selected_option == 1) {
            $query .= "appointment_date = '$request->change_date' ";
        } else {
            return redirect('/appointment')->with('error', 'Incorrect');
        }
        if (isset($request->appoint_ids)) {
            $appoint_ids = implode(',', $request->appoint_ids);
            $query .= "WHERE appointment_id IN ($appoint_ids)";
            $out = DB::select($query);
            $msg = 'Appointment Updated Successfully.';
        }
        // print($query);
        return redirect('/appointment')->with('success', 'Appointment Updated Successfully.');
        dd($request);
    }
}
