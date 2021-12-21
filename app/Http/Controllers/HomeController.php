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

    // registration add
    public function register_store(Request $request)
    {
        // dd($request);
        $patient = new Patient;
        $patient->patient_name = $request->patient_name;
        $patient->save();
        return redirect('registration');
    }
}
