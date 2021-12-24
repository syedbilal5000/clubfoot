<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;

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

    // show appointment index
    public function appointment_index()
    {
        return view('appointment.index');
    }

    // registration add
    public function register_store(Request $request)
    {
        // dd($request);
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
        // print_r($patient);
        // dd(11);
        return redirect('registration');
    }
}
