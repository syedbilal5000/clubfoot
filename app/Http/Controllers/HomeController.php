<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\MailController;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Patient, App\PatientFamily, App\PatientDiagnosis, App\PatientExamination;
use App\Appointment, App\AppointDelayed, App\Visit, App\Followup;
use App\Donor, App\Category, App\Expense, App\Item, App\Inventory;

class HomeController extends Controller
{
    private $auth_user;

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
        // return view('home');

        $start_date = date('Y-m-d', strtotime ('-3 Months'));
        $end_date = date('Y-m-d');
        $data = $this->dashboard_report($start_date, $end_date);
        // $data = ['casted_more' => $casted_more];
        return view('home')->with($data);
    }

    // dev - use for development/testing purpose
    public function dev(Request $request)
    {
        // print($request->url());
        // $response = Http::post('http://localhost:8080/clubfoot/public/appointment/add', [
        //     'patient_id' => '10001',
        //     'appointment_date' => '2022-03-31',
        // ]);
        // print($response);
        $id = "10001";
        $patient = Patient::find($id);
        // dd($patient);
        $name = 'Cloudways';
        // Mail::to('syedbilalhussain168@gmail.com')->send(new MailController($name));
        Mail::to('syedbilalhussain168@gmail.com')->send(new MailController($patient));
        // $details = [
        //     'title' => 'Mail from ItSolutionStuff.com',
        //     'body' => 'This is for testing email using smtp'
        // ];
       
        // \Mail::to('syedbilalhussain168@gmail.com')->send(new \App\MailController($details));
       
        dd("Email is Sent.");
        // dd(123);
    }

    // return auth user
    public function auth_user()
    {
        if (!$this->auth_user) {
            $this->auth_user = auth()->user();
        }
        return $this->auth_user;
    }

    // get report data for dashboard (appointments & visits)
    public function dashboard_report($st_dt, $ed_dt)
    {
        // dd("SELECT appointment_status FROM appointment WHERE appointment_date >= '" . $st_dt . "' AND appointment_date <= '" . $ed_dt . "'");
        $appointments = DB::select("SELECT appointment_status FROM appointment WHERE appointment_date >= '" . $st_dt . "' AND appointment_date <= '" . $ed_dt . "'");
        $query = DB::select("SELECT v.visit_count, f.followup_count FROM (SELECT COUNT(id) visit_count FROM visit_details WHERE visit_date >= '" . $st_dt . "' AND visit_date <= '" . $ed_dt . "') v, (SELECT COUNT(id) followup_count FROM followup WHERE visit_date >= '" . $st_dt . "' AND visit_date <= '" . $ed_dt . "') f");
        $visits = ($query != array()) ? $query[0] : $query;
        $data["appointments"] = $appointments;
        $data["visits"] = $visits;
        return $data;
    }

    // get report data for casted more than seven
    public function casted_more_report($st_dt, $ed_dt)
    {
        $query = "SELECT p.patient_id, p.patient_name, p.guardian_number, p.inserted_at, visits.total_visits, v1.visit_date first_visit, v2.visit_date last_visit, v1.total_score first_visit_score, v2.total_score last_visit_score FROM (SELECT patient_id, COUNT(patient_id) total_visits FROM visit_details WHERE visit_date >= '" . $st_dt . "' AND visit_date <= '" . $ed_dt . "' AND treatment = 1 GROUP BY patient_id HAVING COUNT(patient_id) > 7) visits LEFT JOIN visit_details v1 ON v1.patient_id = visits.patient_id and v1.visit_date = (SELECT MIN(visit_date) FROM visit_details WHERE patient_id = visits.patient_id) LEFT JOIN visit_details v2 ON v2.patient_id = visits.patient_id and v2.visit_date = (SELECT MAX(visit_date) FROM visit_details WHERE patient_id = visits.patient_id) LEFT JOIN patients p ON p.patient_id = visits.patient_id ORDER BY v1.total_score DESC, v2.total_score DESC LIMIT 1;";
        $casted_more = DB::select($query);
        return $casted_more;
    }

    // get report data for casted three same values
    public function casted_same_report($st_dt, $ed_dt)
    {
        $query = "SELECT v.patient_id, v.visit_date, v.next_visit_date, v.total_score, p.inserted_at, p.guardian_number, p.patient_name FROM visit_details v, patients p WHERE p.patient_id = v.patient_id AND v.visit_date >= '" . $st_dt . "' AND visit_date <= '" . $ed_dt . "' Order by v.patient_id, v.visit_date DESC";
        $casted_same = DB::select($query);
        $count =0;
        $curr_total_score =0;
        $curr_record;
        $curr_records= array();
        $curr_patient_id =0;
        for ($i = 0; $i < count($casted_same); $i++) {
            if($curr_total_score == $casted_same[$i]->total_score && $curr_patient_id == $casted_same[$i]->patient_id)
            {
                $count ++;
            }
            else if($curr_total_score == $casted_same[$i]->total_score)
            {
                $count =1;
            }
            if($count >= 3)
            {
                // print $curr_patient_id . '<br>';
                // print $curr_total_score. '<br>';
                array_push($curr_records, $casted_same[$i]); 
                $count =0;
            }
            if($curr_patient_id != $casted_same[$i]->patient_id){
                $curr_patient_id = $casted_same[$i]->patient_id;
                $curr_total_score =$casted_same[$i]->total_score;
                $curr_record = $casted_same[$i];
                $count =1;
            }
        }
        // dd(1);
        return $curr_records;
    }
	
	// get main report data
    public function main_data($query)
    {
        // $query = "SELECT p.patient_id, p.patient_name, p.guardian_number, p.inserted_at, a.appointment_id, a.appointment_date, COALESCE(ad.reason, 0) reason FROM (SELECT * FROM appointment WHERE appointment_status = (SELECT id FROM status WHERE status_name = 'Pending')) a LEFT JOIN patients p ON p.patient_id = a.patient_id LEFT JOIN appoint_delayed ad ON ad.appointment_id = a.appointment_id";
        // $query = "SELECT " . $selections . " FROM " . $collections . " WHERE " . $filterations;
		$main_report = DB::select($query);
        // dd($query);
        return $main_report;
    }

    // get report data for appointment delayed
    public function appoint_delayed_report($st_dt, $ed_dt)
    {
        $query = "SELECT p.patient_id, p.patient_name, p.guardian_number, p.inserted_at, a.appointment_id, a.appointment_date, COALESCE(ad.reason, 0) reason FROM (SELECT * FROM appointment WHERE appointment_date >= '" . $st_dt . "' AND appointment_date <= '" . $ed_dt . "' AND appointment_status = (SELECT id FROM status WHERE status_name = 'Pending')) a LEFT JOIN patients p ON p.patient_id = a.patient_id LEFT JOIN appoint_delayed ad ON ad.appointment_id = a.appointment_id"; 
        $appoint_delayed = DB::select($query);
        // dd($query);
        return $appoint_delayed;
    }

    // get visits report data by treatment type
    public function visits_report($type, $st_dt, $ed_dt)
    {
        $query = "SELECT treatment, SUM(visit_count) visit_count, SUM(followup_count) followup_count FROM (SELECT COUNT(*) visit_count, 0 followup_count, treatment FROM visit_details v GROUP BY v.treatment UNION ALL SELECT 0 visit_count, COUNT(*) followup_count, treatment FROM followup f GROUP BY f.treatment) sb GROUP BY treatment;";
        $visits_grouped = DB::select($query);
        return $visits_grouped;
    }

    // Patients report view
    public function patient_index()
    {
        $patients = $this->get_patients();
        return view('patient.index', ['patients' => $patients]);
    }

    // Donors report view
    public function donor_index()
    {
        $donors = $this->get_donors();
        return view('donor.index', ['donors' => $donors]);
    }

    // analytics view
    public function analytic_index()
    {
        // $donors = $this->get_donors();
        return view('analytic.index');
    }

    // alert for casted more than seven
    public function casted_more_view()
    {
        $start_date = date('Y-m-d', strtotime ('-3 Months'));
        $end_date = date('Y-m-d');
        $casted_more = $this->casted_more_report($start_date, $end_date);
        $data = ['casted_more' => $casted_more];
        return view('analytic.casted_more')->with($data);
    }

    // 
    public function main_report_view()
    {
        $start_date = date('Y-m-d', strtotime ('-3 Months'));
        $end_date = date('Y-m-d');
        $main_report = $this->main_report_report($start_date, $end_date);
        $data = ['main_report' => $main_report];
        return view('analytic.main_report')->with($data);
    }

    // get report data for casted more than seven
    public function main_report_report($st_dt, $ed_dt)
    {
        $query = "SELECT p.patient_id, p.patient_name, p.guardian_number, p.inserted_at, visits.total_visits, v1.visit_date first_visit, v2.visit_date last_visit, v1.total_score first_visit_score, v2.total_score last_visit_score FROM (SELECT patient_id, COUNT(patient_id) total_visits FROM visit_details WHERE visit_date >= '" . $st_dt . "' AND visit_date <= '" . $ed_dt . "' AND treatment = 1 GROUP BY patient_id HAVING COUNT(patient_id) > 7) visits LEFT JOIN visit_details v1 ON v1.patient_id = visits.patient_id and v1.visit_date = (SELECT MIN(visit_date) FROM visit_details WHERE patient_id = visits.patient_id) LEFT JOIN visit_details v2 ON v2.patient_id = visits.patient_id and v2.visit_date = (SELECT MAX(visit_date) FROM visit_details WHERE patient_id = visits.patient_id) LEFT JOIN patients p ON p.patient_id = visits.patient_id ORDER BY v1.total_score DESC, v2.total_score DESC LIMIT 1;";
        $main_report = DB::select($query);
        return $main_report;
    }

    // alert for casted have three same value
    public function casted_same_view()
    {
        $start_date = date('Y-m-d', strtotime ('-3 Months'));
        $end_date = date('Y-m-d');
        $casted_same = $this->casted_same_report($start_date, $end_date);
        $data = ['casted_same' => $casted_same];
        return view('analytic.casted_same')->with($data);
    }

    // alert for appoint delayed
    public function appoint_delayed_view()
    {
        // $start_date = date('Y-m-d');
        $start_date = date('Y-m-d', strtotime ('-3 Months'));
        $end_date = date('Y-m-d');
        $appoint_delayed = $this->appoint_delayed_report($start_date, $end_date);
        $data = ['appoint_delayed' => $appoint_delayed];
        return view('analytic.appoint_delayed')->with($data);
    }

    // analytic/visits/type - visits report view
    public function visits_view($type)
    {
        $sales_report = [1 => 'Treatment', 2 => 'Relapse', 3 => 'Month'];
        $start_date = date('Y-m-d', strtotime ('-3 Months'));
        $end_date = date('Y-m-d');
        $report_vsts = $this->visits_report($type, $start_date, $end_date);
        $data = ['report_vsts' => $report_vsts, 'type' => $type, 'report_name' => $sales_report[$type]];
        return view('analytic.visit_report')->with($data);
    }

    // this method will generate appointment date base on availability
    public function generate_date()
    {
        // $pending = 120;
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
        if(\Gate::allows('isViewer')) {
            abort(403, "Sorry, you don't have permission.");
        }
        $donors = $this->get_donors();
        return view('patient.create', ['donors' => $donors]);
    }

    public function visit_create()
    {
        if(\Gate::allows('isViewer')) {
            abort(403, "Sorry, you don't have permission.");
        }
        $patients = $this->get_patients();
        $date = $this->generate_date();
        return view('visit.create', ['patients' => $patients, 'date' => $date]);
    }

    public function item_create()
    {
        if(\Gate::allows('isViewer')) {
            abort(403, "Sorry, you don't have permission.");
        }
        return view('item.create');
    }

    public function item_index()
    {
        if(\Gate::allows('isViewer')) {
            abort(403, "Sorry, you don't have permission.");
        }
        $iitems = DB::select("SELECT id, name, price, description FROM item;");
        return view('item.index', ['items' => $iitems]);
    }

    public function category_create()
    {
        if(\Gate::allows('isViewer')) {
            abort(403, "Sorry, you don't have permission.");
        }
        return view('category.create');
    }

    public function category_index()
    {
        if(\Gate::allows('isViewer')) {
            abort(403, "Sorry, you don't have permission.");
        }
        $category = DB::select("SELECT id, name, description FROM category;");
        return view('category.index', ['category' => $category]);
    }

    public function inventory_create()
    {
        if(!\Gate::allows('isAdmin')) {
            abort(403, "Sorry, you don't have permission.");
        }
        $inventory = DB::select("SELECT id, name, price, description FROM item");
        return view('inventory.create', ['inventory' => $inventory]);
    }

    public function inventory_index()
    {
        if(\Gate::allows('isViewer')) {
            abort(403, "Sorry, you don't have permission.");
        }
        $inventory = DB::select("SELECT i.id, item_id, item.name as item_name, user_id,  i.name as inv_name, u.name as user_name, i.unit_cost, i.total_amount, i.unit_balance, i.description, i.inserted_at FROM inventory i LEFT JOIN users u on i.user_id = u.id LEFT JOIN item as item on item.id = i.item_id;");
        return view('inventory.index', ['inventory' => $inventory]);
    }

    public function expense_create()
    {
        if(\Gate::allows('isViewer')) {
            abort(403, "Sorry, you don't have permission.");
        }
        $expense = DB::select("SELECT id, name, description FROM category");
        return view('expense.create', ['expense' => $expense]);
    }

    public function expense_index()
    {
        if(\Gate::allows('isViewer')) {
            abort(403, "Sorry, you don't have permission.");
        }
        $expense = DB::select("SELECT e.id, cat_id, c.name as c_name, user_id,  e.name as e_name, u.name as user_name, e.amount, e.description, e.inserted_at FROM expense e LEFT JOIN users u on e.user_id = u.id LEFT JOIN category as c on c.id = e.cat_id;");
        return view('expense.index', ['expense' => $expense]);
    }

    // show donors create
    public function donor_create()
    {
        if(\Gate::allows('isViewer')) {
            abort(403, "Sorry, you don't have permission.");
        }
        $cities = $this->get_cities();
        return view('donor.create', ['cities' => $cities]);
    }

    // show appointment create
    public function appoint_create($patient_id=0)
    {
        if(\Gate::allows('isViewer')) {
            abort(403, "Sorry, you don't have permission.");
        }
        $patients = $this->get_patients();
        $date = $this->generate_date();
        $data = ['patients' => $patients, 'date' => $date, 'patient_id' => $patient_id, 'success' => 'Patient added successfully.'];
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

    public function followup_index()
    {
        $patients = $this->get_patients();
        return view('followup.index', ['patients' => $patients]);
    }
    public function followup_create()
    {
        if(\Gate::allows('isViewer')) {
            abort(403, "Sorry, you don't have permission.");
        }
        $patients = $this->get_patients();
        return view('followup.create', ['patients' => $patients]);
    }

    // get patients data
    public function get_patients()
    {
        $patients = DB::select("SELECT * FROM patients p LEFT JOIN patient_families pf ON p.patient_id = pf.patient_id LEFT JOIN patient_diagnoses pd ON p.patient_id = pd.patient_id;");
        // $patients = DB::table('patients')->join('patient_families', 'patients.patient_id', '=', 'patient_families.patient_id')->join('patient_diagnoses', 'patients.patient_id', '=', 'patient_diagnoses.patient_id')->select('patients.*', 'patient_families.*', 'patient_diagnoses.*')->paginate(2);
        // print_r($patients);
        // dd(1);
        return $patients;
    }

    // get donors data
    public function get_donors()
    {
        $donors = DB::select("SELECT d.*, c.city FROM donors d LEFT JOIN cities c ON d.city_id = c.city_id;");
        return $donors;
    }

    // public function get_patients_with_appointment()
    // {
    //     $patients_appoint = DB::select("SELECT p.patient_id, p.patient_name, p.guardian_number, p.guardian_cnic, a.appointment_id, a.appointment_date, a.appointment_status, a.previous_appointment_id, (SELECT status_name FROM status WHERE id =a.appointment_status) AS status FROM patients p LEFT JOIN appointment a ON p.patient_id = a.patient_id WHERE a.appointment_status = (SELECT id FROM status WHERE status_name = 'Pending');");
    //     return $patients_appoint;
    // }

    public function get_data_appoint($status)
    {
        $patients_appoint = DB::select("SELECT p.patient_id, p.patient_name, p.guardian_number, p.guardian_cnic, p.out_of_city, a.appointment_id, a.appointment_date, a.appointment_status, a.previous_appointment_id, (SELECT status_name FROM status WHERE id =a.appointment_status) AS status FROM patients p LEFT JOIN appointment a ON p.patient_id = a.patient_id WHERE a.appointment_status = (SELECT id FROM status WHERE status_name = '$status') ORDER BY a.appointment_date DESC, p.out_of_city DESC;");
        return $patients_appoint;
    }

    public function get_visits($patient_id)
    {
        $patients_visits = DB::select("SELECT * FROM visit_details WHERE patient_id = '$patient_id';");
        $patients_fup = DB::select("SELECT * FROM followup WHERE patient_id = '$patient_id';");
        return array("visits" => $patients_visits, "f_up" => $patients_fup);
    }

    // get pak cities (common - 158) from db
    public function get_cities()
    {
        $cities = DB::select("SELECT * FROM cities");
        return $cities;
    }

    // show patients edit
    public function patient_edit($id)
    {
        if(\Gate::allows('isViewer')) {
            abort(403, "Sorry, you don't have permission.");
        }
        $patient = DB::select("SELECT * FROM patients p LEFT JOIN patient_families pf ON pf.patient_id = p.patient_id LEFT JOIN patient_diagnoses pd ON pd.patient_id = p.patient_id LEFT JOIN patient_examinations pe ON pe.patient_id = p.patient_id WHERE p.patient_id = " . $id . ";");
        if (!$patient) {
            return redirect('patient')->with('error', 'Incorrect Patient.');
        }
        $donors = $this->get_donors();
        $patient = (object) $patient[0];
        return view('patient.edit', ['patient' => $patient, 'donors' => $donors]);
    }

    // show donors edit
    public function donor_edit($id)
    {
        // $donor = DB::select("SELECT * FROM donors WHERE id = " . $id . ";");
        $donor = Donor::find($id);
        if (!$donor) {
            return redirect('donor')->with('error', 'Incorrect Donor.');
        }
        $cities = $this->get_cities();
        $donor = (object) $donor;
        return view('donor.edit', ['donor' => $donor, 'cities' => $cities]);
    }

    // appoint delayed create
    public function appoint_delayed_store(Request $request)
    {
        // dd($request);
        $appoint_delayed = new AppointDelayed;
        $appoint_delayed->appointment_id = $request->appointment_id;
        $appoint_delayed->reason = isset($request->reason) ? $request->reason : 0;
        $appoint_delayed->description = $request->description;
        $appoint_delayed->save();
        return redirect('analytic/appoint_delayed');
    }

    // patient create
    public function patient_store(Request $request)
    {
        // dd($request);
        // Add patient general info
        $patient = new Patient;
        $patient->patient_id = $request->patient_id;
        $patient->patient_name = $request->patient_name;
        $patient->father_name = $request->father_name;
        // 0: "Other", 1: "Male", 2: "Female"
        $patient->gender = isset($request->gender) ? $request->gender : 0;
        $patient->donor_id = isset($request->donor_id) ? $request->donor_id : 0;
        $patient->birth_date = $request->birth_date;
        $patient->address = $request->address;
        $patient->address2 = $request->address2;
        $patient->out_of_city = isset($request->out_of_city) ? $request->out_of_city : 0;
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
        $patient_family->complications = $request->complications;
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
        $patient_diagnosis->other_diagnosis = $request->other_diagnosis;
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
        return redirect('/appointment/create/' . $patient_id)->with('success', 'Patient added successfully.');
    }

    // appointment create
    public function appoint_store(Request $request)
    {
        // dd($request);
        $patient_id = $request->patient_id;
        $query = DB::select("SELECT COALESCE(appointment_id, 0) appoint_id FROM appointment WHERE patient_id = " . $patient_id . " AND appointment_status = 2 ORDER BY appointment_id DESC LIMIT 1");
        $appoint_id = ($query != array()) ? $query[0]->appoint_id : 0;
        $appoint = DB::select("UPDATE appointment SET appointment_status = 4 WHERE appointment_id = " . $appoint_id);
        // Add patient general info
        $appointment = new Appointment;
        $appointment->appointment_date = $request->appointment_date;
        $appointment->patient_id = $patient_id;
        $appointment->appointment_status = 2; // Pending - status
        // 0 for new appointment, else appoint_id for old appointment
        $appointment->previous_appointment_id = $appoint_id;
        $appointment->inserted_at = date("Y-m-d");
        $appointment->save();
        return redirect('/appointment')->with('success', 'Appointment added successfully.');
    }

    // visit create
    public function visit_store(Request $request)
    {
        // dd($request);
        $patient_id = $request->patient_id;
        $query = DB::select("SELECT COALESCE(appointment_id, 0) appoint_id FROM appointment WHERE patient_id = " . $patient_id . " AND appointment_status = 2 ORDER BY inserted_at DESC LIMIT 1");
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
        $message = 'Visit added successfully.';
        // adding image file
        if($request->file('img_file')){
            $request->validate([
                'img_file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',]);
            $file = $request->file('img_file');
            // $filename = date('YmdHis') . $file->getClientOriginalName();
            $filename = date('YmdHis') . '_' . $patient_id . '.' . $request->img_file->extension();;
            $year_month = substr($filename, 0, 6);
            $path_dir = 'img/upload/' . $year_month;
            $path_file = $path_dir . '/' . $filename;
            $file->move(public_path($path_dir), $filename);
            $visit->img_path = $filename;
            $message = substr($message, 0, -1);
            // $email = 'syedbilalhussain168@gmail.com';
            $query = DB::select("SELECT donor_email FROM donors WHERE id IN (SELECT donor_id FROM patients WHERE patient_id = " . $patient_id . ")");
            $email = ($query != array()) ? $query[0]->donor_email : "";
            if ($this->send_mail($email, $patient_id, $path_file)) {
                $message .= ", also email sent.";
            } else {
                $message .= ", but email not send.";
            }
        }
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
            // $imageName = $patient_id .'_'. date('YmdHis');
            // $visit2->img_path = $request->image->move(public_path('img/upload'), $imageName);
            $visit2->save();
        }
        // add amount_payed if available
        if(isset($request->amount_payed)) {
            $values = [
                "patient_id" => $patient_id,
                "transaction_id" => $visit->id,
                "is_followup" => 0,
                "amount" => $request->amount_payed,
            ];
            $this->amount_payed_store($values);
        }
        $appoint = DB::select("UPDATE appointment SET appointment_status = 1 WHERE appointment_id = " . $appoint_id);
        // dd($request);
        return redirect('/visit')->with('success', $message);
    }

    // followup create
    public function followup_store(Request $request)
    {
        $patient_id = $request->patient_id;
        $query = DB::select("SELECT COALESCE(appointment_id, 0) appoint_id FROM appointment WHERE patient_id = " . $patient_id . " AND appointment_status = 2 ORDER BY inserted_at DESC LIMIT 1");
        $appoint_id = ($query != array()) ? $query[0]->appoint_id : 0;
        $weeks = isset($request->next_visit_date) ? $request->next_visit_date : 0;
        $next_visit_date = date('Y-m-d', strtotime ('+' . $weeks . ' Weeks'));
        $next_visit_date = ($weeks != 0) ? $next_visit_date : NULL;
        // Add followup
        $followup = new Followup;
        $followup->patient_id = $patient_id;
        $followup->appointment_id = $appoint_id;
        $followup->visit_date = $request->visit_date;
        $followup->next_visit_date = $next_visit_date;
        $followup->relapse = isset($request->relapse) ? $request->relapse : 0;
        $followup->size = isset($request->size) ? $request->size : 0;
        $followup->hours = isset($request->hours) ? $request->hours : 0;
        $followup->treatment = isset($request->treatment) ? $request->treatment : 0;
        $followup->is_virtual = isset($request->is_virtual) ? $request->is_virtual : 0;
        $followup->inserted_at = date("Y-m-d");
        // adding image file
        if($request->file('img_file')) {
            $request->validate([
                'img_file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',]);
            $file = $request->file('img_file');
            $filename = date('YmdHis') . '_' . $patient_id . '.' . $request->img_file->extension();;
            $year_month = substr($filename, 0, 6);
            $file->move(public_path('img/upload/' . $year_month), $filename);
            $followup->img_path = $filename;
        }
        $followup->save();
        // add amount_payed if available
        if(isset($request->amount_payed)) {
            $values = [
                "patient_id" => $patient_id,
                "transaction_id" => $followup->id,
                "is_followup" => 1,
                "amount" => $request->amount_payed,
            ];
            $this->amount_payed_store($values);
        }
        $appoint = DB::select("UPDATE appointment SET appointment_status = 1 WHERE appointment_id = " . $appoint_id);
        // dd($request);
        return redirect('/visit')->with('success', 'Follow-Up added successfully.');
    }

    // to store amount payed for visit/followup into amount_payed table
    public function amount_payed_store($values)
    {
        $query = "INSERT INTO amount_payed (patient_id, transaction_id, is_followup, amount)  VALUES (";
        foreach ($values as $key => $value) {
            $query .= $value . ", ";
        }
        $query = substr($query, 0, -2);
        $query .= ")";
        $amount_payed = DB::select($query);
    }

    // donor create
    public function donor_store(Request $request)
    {
        // Add donor
        $donor = new Donor;
        $donor->first_name = $request->first_name;
        $donor->last_name = $request->last_name;
        $donor->donor_email = $request->email;
        $donor->donor_number = $request->donor_number;
        $donor->donor_address = $request->donor_address;
        $donor->city_id = isset($request->city_id) ? $request->city_id : 0;
        $donor->description = $request->description;
        $donor->save();
        return redirect('/donor')->with('success', 'Donor added successfully.');
    }

    // category (expense) create
    public function category_store(Request $request)
    {
        // Add category
        $cat = new Category;
        $cat->name = $request->name;
        $cat->description = $request->description;
        $cat->save();
        return redirect('/category')->with('success', 'Category added successfully.');
    }

    // expense create
    public function expense_store(Request $request)
    {
        $user_id = $this->auth_user()->id;
        // Add expense
        $exp = new Expense;
        $exp->cat_id = $request->category;
        $exp->user_id = $user_id;
        $exp->name = $request->name;
        $exp->amount = $request->amount;
        $exp->description = $request->description;
        $exp->inserted_at = date("Y-m-d");
        $exp->save();
        return redirect('/expense')->with('success', 'Expense added successfully.');
    }

    // item (inventory) create
    public function item_store(Request $request)
    {
        // Add category
        $item = new Item;
        $item->name = $request->name;
        $item->price = $request->price;
        $item->description = $request->description;
        $item->save();
        return redirect('/item')->with('success', 'Item added successfully.');
    }

    // inventory create
    public function inventory_store(Request $request)
    {
        $user_id = $this->auth_user()->id;
        // Add inventory
        $inv = new Inventory;
        $inv->item_id = $request->item;
        $inv->user_id = $user_id;
        $inv->name = $request->name;
        $inv->unit_cost = $request->unit_cost;
        $inv->total_amount = $request->total_amount;
        $inv->unit_balance = $request->unit_balance;
        $inv->description = $request->description;
        $inv->inserted_at = date("Y-m-d");
        $inv->save();
        return redirect('/inventory')->with('success', 'Inventory added successfully.');
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
        $patient->donor_id = isset($request->donor_id) ? $request->donor_id : 0;
        $patient->birth_date = $request->birth_date;
        $patient->address = $request->address;
        $patient->address2 = $request->address2;
        $patient->out_of_city = isset($request->out_of_city) ? $request->out_of_city : 0;
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
        $patient_family->complications = $request->complications;
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
        $patient_diagnosis->other_diagnosis = $request->other_diagnosis;
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
            $msg = 'Appointment updated successfully.';
        }
        // print($query);
        return redirect('/appointment')->with('success', 'Appointment updated successfully.');
    }

    // donor update
    public function donor_update(Request $request, $id)
    {
        // Update donor
        $donor = Donor::find($id);
        $donor->first_name = $request->first_name;
        $donor->last_name = $request->last_name;
        $donor->donor_email = $request->email;
        $donor->donor_number = $request->donor_number;
        $donor->donor_address = $request->donor_address;
        $donor->city_id = isset($request->city_id) ? $request->city_id : 0;
        $donor->description = $request->description;
        $donor->save();
        return redirect('/donor')->with('success', 'Donor updated successfully.');
    }

    // send patient table data through mail to donor 
    public function send_mail($email, $patient_id=0, $path_file='')
    {
        if ($email != "") {
            $patient = Patient::find($patient_id);
            // dd($patient);
            // $name = 'Cloudways';
            // Mail::to('syedbilalhussain168@gmail.com')->send(new MailController($name));
            Mail::to($email)->send(new MailController($patient, $path_file));
            return true;
        }
        return false;
    }
}
