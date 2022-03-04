<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Codedge\Fpdf\Fpdf\Fpdf;

class PDFController extends Controller
{
    protected $fpdf;
 
    public function __construct()
    {
    	$this->middleware('auth');
        $this->fpdf = new Fpdf;
    }

    public function get_patient($id)
    {
        $patient = DB::select("SELECT * FROM patients WHERE patient_id = " . $id);
        return $patient;
    }

    public function index()
    {
    	$patient = $this->get_patient(10001);
    	if ($patient) {
    		$patient = $patient[0];
    		$this->get_pdf($patient);
    	} else {
    		dd("NO DATA FOUND");
    	}
    }

    public function get_pdf($patient)
    {
    	$this->fpdf->AddPage();
    	$this->fpdf->SetFont('Arial', 'B', '18');
		$this->fpdf->SetTextColor(66, 146, 244);
		$this->fpdf->Cell(195, 8, 'Clubfoot Clinic Ortho Unit ll, Civil Hospital, Karachi', 0, 1,'L');
		$this->fpdf->SetFont('Arial', '', '10');
		$this->fpdf->SetTextColor(0, 0, 0);
		$this->fpdf->Cell(65, 6, 'Patient form...', 0, 0,'L');
		$this->fpdf->Cell(18, 6, 'Reg No:', 0, 0,'R');
		$this->fpdf->Cell(47, 6, $patient->patient_id, 'B', 0,'L');
		$this->fpdf->Cell(18, 6, 'ICR No:', 0, 0,'R');
		$this->fpdf->Cell(47, 6, '', 'B', 1,'L');
		$this->fpdf->Line(10, 25, 205, 25);

		$this->fpdf->SetFont('Arial', 'B', '12');
		$this->fpdf->Cell(0, 1, '', 0, 1,'L');
		$this->fpdf->Cell(0, 10, 'General Information:', 0, 1,'L');

		$this->fpdf->SetFont('Arial', '', '10');
		$this->fpdf->Cell(25, 6, 'Patient Name:', 0, 0,'L');
		$this->fpdf->Cell(72, 6, '', 'B', 0,'L');
		$this->fpdf->Cell(26, 6, 'Father\'s Name:', 0, 0,'R');
		$this->fpdf->Cell(72, 6, '', 'B', 1,'L');

		$this->fpdf->Cell(15, 6, 'Gender:', 0, 0,'L');
		$this->fpdf->Cell(50, 6, '', 'B', 0,'L');
		$this->fpdf->Cell(15, 6, 'DOB:', 0, 0,'R');
		$this->fpdf->Cell(50, 6, '', 'B', 0,'L');
		$this->fpdf->Cell(15, 6, 'Age:', 0, 0,'R');
		$this->fpdf->Cell(50, 6, '', 'B', 1,'L');

		$this->fpdf->Cell(20, 6, 'Address1:', 0, 0,'L');
		$this->fpdf->Cell(175, 6, '', 'B', 1,'L');
		$this->fpdf->Cell(20, 6, 'Address2:', 0, 0,'L');
		$this->fpdf->Cell(175, 6, '', 'B', 1,'L');

		$this->fpdf->Cell(160, 6, 'Does the parent or guardian consent to photographs of the patient being used for evaluation purpose', 0, 0,'L');
		$this->fpdf->Cell(35, 6, '', 'B', 1,'L');

		$this->fpdf->SetFont('Arial', 'B', '12');
		$this->fpdf->Cell(0, 8, 'Parent/Guardian Information:', 0, 1,'L');
		$this->fpdf->Cell(0, 8, 'Primary Parent/ Guardian:', 0, 1,'L');

		$this->fpdf->SetFont('Arial', '', '10');
		$this->fpdf->Cell(40, 6, 'Relationship to Patient:', 0, 0,'L');
		$this->fpdf->Cell(68, 6, '', 'B', 0,'L');
		$this->fpdf->Cell(15, 6, 'Name:', 0, 0,'R');
		$this->fpdf->Cell(72, 6, '', 'B', 1,'L');

		$this->fpdf->Cell(30, 6, 'Phone Number 1:', 0, 0,'L');
		$this->fpdf->Cell(35, 6, '', 'B', 0,'L');
		$this->fpdf->Cell(30, 6, 'Phone Number 2:', 0, 0,'R');
		$this->fpdf->Cell(35, 6, '', 'B', 0,'L');
		$this->fpdf->Cell(20, 6, 'CNIC No:', 0, 0,'R');
		$this->fpdf->Cell(45, 6, '', 'B', 1,'L');

		$this->fpdf->Line(10, 95, 205, 95);

		$this->fpdf->SetFont('Arial', 'B', '12');
		$this->fpdf->Cell(0, 1, '', 0, 1,'L');
		$this->fpdf->Cell(0, 10, 'Family History', 0, 1,'L');

		$this->fpdf->SetFont('Arial', '', '10');
		$this->fpdf->Cell(70, 6, 'Any relatives with the clubfoot deformity:', 0, 0,'L');
		$this->fpdf->Cell(37, 6, '', 'B', 0,'L');
		$this->fpdf->Cell(60, 6, 'Length of pregnancy (in weeks):', 0, 0,'R');
		$this->fpdf->Cell(27, 6, '', 'B', 1,'L');

		$this->fpdf->Cell(90, 6, 'Did the mother have any complication during pregnancy:', 0, 0,'L');
		$this->fpdf->Cell(17, 6, '', 'B', 0,'L');
		$this->fpdf->Cell(60, 6, 'What were the complications:', 0, 0,'R');
		$this->fpdf->Cell(27, 6, '', 'B', 1,'L');

		$this->fpdf->Cell(75, 6, 'Did mother consume alcohol during pregnancy:', 0, 0,'L');
		$this->fpdf->Cell(25, 6, '', 'B', 0,'L');
		$this->fpdf->Cell(67, 6, 'Did the mother smoke during pregnancy:', 0, 0,'R');
		$this->fpdf->Cell(27, 6, '', 'B', 1,'L');

		$this->fpdf->Cell(50, 6, 'Any complications during birth:', 0, 0,'L');
		$this->fpdf->Cell(57, 6, '', 'B', 0,'L');
		$this->fpdf->Cell(60, 6, 'Place of birth:', 0, 0,'R');
		$this->fpdf->Cell(27, 6, '', 'B', 1,'L');

		$this->fpdf->SetFont('Arial', 'B', '12');
		$this->fpdf->Cell(0, 10, 'Referral Information', 0, 1,'L');

		$this->fpdf->SetFont('Arial', '', '10');
		$this->fpdf->Cell(35, 6, 'Referral source:', 0, 0,'L');
		$this->fpdf->Cell(160, 6, '', 'B', 1,'L');

		$this->fpdf->Cell(25, 6, 'Doctor Name:', 0, 0,'L');
		$this->fpdf->Cell(40, 6, '', 'B', 0,'L');
		$this->fpdf->Cell(30, 6, 'Hospital/Clinic:', 0, 0,'C');
		$this->fpdf->Cell(35, 6, '', 'B', 0,'L');
		$this->fpdf->Cell(40, 6, 'If other, please specify:', 0, 0,'C');
		$this->fpdf->Cell(25, 6, '', 'B', 1,'L');


		$this->fpdf->Line(10, 152, 205, 152);

		$this->fpdf->SetFont('Arial', 'B', '12');
		$this->fpdf->Cell(0, 1, '', 0, 1,'L');
		$this->fpdf->Cell(0, 10, 'Diagnosis:', 0, 1,'L');

		$this->fpdf->SetFont('Arial', '', '10');
		$this->fpdf->Cell(40, 6, 'Name of evaluator:', 0, 0,'L');
		$this->fpdf->Cell(57, 6, '', 'B', 0,'L');
		$this->fpdf->Cell(40, 6, 'Evaluation Date:', 0, 0,'R');
		$this->fpdf->Cell(57, 6, '', 'B', 1,'L');

		$this->fpdf->Cell(40, 6, 'Title of evaluator:', 0, 0,'L');
		$this->fpdf->Cell(57, 6, '', 'B', 0,'L');
		$this->fpdf->Cell(40, 6, 'Feet Affected:', 0, 0,'R');
		$this->fpdf->Cell(57, 6, '', 'B', 1,'L');

		$this->fpdf->Cell(40, 6, 'Diagnosis:', 0, 0,'L');
		$this->fpdf->Cell(57, 6, '', 'B', 0,'L');
		$this->fpdf->Cell(45, 6, 'Deformity present at birth:', 0, 0,'R');
		$this->fpdf->Cell(52, 6, '', 'B', 1,'L');

		$this->fpdf->Cell(43, 6, 'Any Pervious treatments:', 0, 0,'L');
		$this->fpdf->Cell(45, 6, '', 'B', 0,'L');
		$this->fpdf->Cell(70, 6, 'How many previous treatment sessions:', 0, 0,'R');
		$this->fpdf->Cell(37, 6, '', 'B', 1,'L');

		$this->fpdf->Cell(45, 6, 'Type of previous treatment(S):', 0, 0,'L');
		$this->fpdf->Cell(52, 6, '', 'B', 0,'L');
		$this->fpdf->Cell(40, 6, 'Diagnosed prenatally:', 0, 0,'R');
		$this->fpdf->Cell(57, 6, '', 'B', 1,'L');

		$this->fpdf->Cell(40, 6, 'At pregnancy Week:', 0, 0,'L');
		$this->fpdf->Cell(57, 6, '', 'B', 0,'L');
		$this->fpdf->Cell(40, 6, 'Confirmed at birth:', 0, 0,'R');
		$this->fpdf->Cell(57, 6, '', 'B', 1,'L');

		$this->fpdf->Cell(38, 6, 'Diagnosis comments:', 0, 0,'L');
		$this->fpdf->Cell(157, 6, '', 'B', 1,'L');

		$this->fpdf->Line(10, 205, 205, 205);

		$this->fpdf->SetFont('Arial', 'B', '12');
		$this->fpdf->Cell(0, 1, '', 0, 1,'L');
		$this->fpdf->Cell(0, 10, 'Physical Examination:', 0, 1,'L');

		$this->fpdf->SetFont('Arial', '', '10');
		$this->fpdf->Cell(60, 6, '', 'B', 0,'L');
		$this->fpdf->Cell(35, 6, 'Any Abnormalities:', 0, 0,'R');
		$this->fpdf->Cell(35, 6, '', 'B', 0,'L');
		$this->fpdf->Cell(30, 6, 'Any Weekness:', 0, 0,'R');
		$this->fpdf->Cell(35, 6, '', 'B', 1,'L');

		$this->fpdf->Line(10, 222, 205, 222);

		$this->fpdf->AddPage();

		$this->fpdf->SetFont('Arial', 'B', '18');
		$this->fpdf->SetTextColor(66, 146, 244);
		$this->fpdf->Cell(195, 8, "Treatment Visit Form\t\t Diagnosis\t\t Feet affected", 0, 1,'L');
		$this->fpdf->SetFont('Arial', 'B', '12');
		$this->fpdf->SetTextColor(0, 0, 0);
		$this->fpdf->Cell(65, 6, 'Initial Treatment Pirani Scores', 0, 1,'L');

		$this->fpdf->SetFont('Arial', 'B', '10');
		$this->fpdf->Cell(48, 6, 'Midfoot Score (MS)', 0, 0,'L');
		$this->fpdf->Cell(55, 6, 'Curved Lateral Border (CLB)', 0, 0,'L');
		$this->fpdf->Cell(41, 6, 'Medial Crease (MC)', 0, 0,'L');
		$this->fpdf->Cell(48, 6, 'Lateral Head of Talus (LHT)', 0, 1,'L');

		$this->fpdf->Cell(48, 6, 'Hindfoot Score (HS)', 0, 0,'L');
		$this->fpdf->Cell(55, 6, 'Posterior Crease (PC)', 0, 0,'L');
		$this->fpdf->Cell(41, 6, 'Rigid Equinus (RE)', 0, 0,'L');
		$this->fpdf->Cell(48, 6, 'Empty Heel (EH)', 0, 1,'L');

		$this->fpdf->Cell(0, 4, '', 0, 1,'L');

		$this->fpdf->SetFont('Arial', '', '10');
		$this->fpdf->Cell(25, 6, 'Date', 1, 0,'L');
		$this->fpdf->Cell(24, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(24, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(24, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(24, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(24, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(24, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(24, 6, ' ', 1, 1,'C');

		$this->fpdf->Cell(25, 6, 'Side', 1, 0,'L');
		$this->fpdf->Cell(12, 6, 'L', 1, 0,'C');
		$this->fpdf->Cell(12, 6, 'R', 1, 0,'C');
		$this->fpdf->Cell(12, 6, 'L', 1, 0,'C');
		$this->fpdf->Cell(12, 6, 'R', 1, 0,'C');
		$this->fpdf->Cell(12, 6, 'L', 1, 0,'C');
		$this->fpdf->Cell(12, 6, 'R', 1, 0,'C');
		$this->fpdf->Cell(12, 6, 'L', 1, 0,'C');
		$this->fpdf->Cell(12, 6, 'R', 1, 0,'C');
		$this->fpdf->Cell(12, 6, 'L', 1, 0,'C');
		$this->fpdf->Cell(12, 6, 'R', 1, 0,'C');
		$this->fpdf->Cell(12, 6, 'L', 1, 0,'C');
		$this->fpdf->Cell(12, 6, 'R', 1, 0,'C');
		$this->fpdf->Cell(12, 6, 'L', 1, 0,'C');
		$this->fpdf->Cell(12, 6, 'R', 1, 1,'C');

		$this->fpdf->Cell(25, 6, 'CLB', 1, 0,'L');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 1,'C');

		$this->fpdf->Cell(25, 6, 'MC', 1, 0,'L');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 1,'C');

		$this->fpdf->Cell(25, 6, 'LHT', 1, 0,'L');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 1,'C');

		$this->fpdf->Cell(25, 6, 'PC', 1, 0,'L');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 1,'C');

		$this->fpdf->Cell(25, 6, 'RE', 1, 0,'L');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 1,'C');

		$this->fpdf->Cell(25, 6, 'EH', 1, 0,'L');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 1,'C');

		$this->fpdf->Cell(25, 6, 'Midfoot Score', 1, 0,'L');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 1,'C');

		$this->fpdf->Cell(25, 6, 'Hindfoot Score', 1, 0,'L');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 1,'C');

		$this->fpdf->Cell(25, 6, 'Total Score', 1, 0,'L');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 1,'C');

		$this->fpdf->Cell(25, 6, 'Treatment', 1, 0,'L');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 1,'C');

		$this->fpdf->Cell(25, 6, 'Complic', 1, 0,'L');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(12, 6, ' ', 1, 1,'C');

		$this->fpdf->Cell(25, 6, 'Next App', 1, 0,'L');
		$this->fpdf->Cell(24, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(24, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(24, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(24, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(24, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(24, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(24, 6, ' ', 1, 1,'C');

		$this->fpdf->Cell(25, 6, 'No of Cast', 1, 0,'L');
		$this->fpdf->Cell(24, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(24, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(24, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(24, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(24, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(24, 6, ' ', 1, 0,'C');
		$this->fpdf->Cell(24, 6, ' ', 1, 1,'C');

		$this->fpdf->Cell(0, 4, '', 0, 1,'L');

		$this->fpdf->Cell(30, 6, 'Total no of Cast:', 0, 0,'L');
		$this->fpdf->Cell(57, 6, '', 'B', 0,'L');
		$this->fpdf->Cell(20, 6, '', 0, 0,'L');
		$this->fpdf->Cell(30, 6, 'Total no of Recast:', 0, 0,'L');
		$this->fpdf->Cell(57, 6, '', 'B', 1,'L');

		$this->fpdf->Cell(35, 6, 'Date of Tenotomy:', 0, 0,'L');
		$this->fpdf->Cell(52, 6, '', 'B', 0,'L');
		$this->fpdf->Cell(20, 6, '', 0, 0,'L');
		$this->fpdf->Cell(35, 6, 'Date of Tenotomy:', 0, 0,'L');
		$this->fpdf->Cell(52, 6, '', 'B', 1,'L');

		$this->fpdf->Cell(27, 6, 'Time Duration:', 0, 0,'L');
		$this->fpdf->Cell(60, 6, '', 'B', 0,'L');
		$this->fpdf->Cell(20, 6, '', 0, 0,'L');
		$this->fpdf->Cell(27, 6, 'Time Duration:', 0, 0,'L');
		$this->fpdf->Cell(60, 6, '', 'B', 1,'L');

		$this->fpdf->Cell(42, 6, 'Date of Brace Application:', 0, 0,'L');
		$this->fpdf->Cell(45, 6, '', 'B', 0,'L');
		$this->fpdf->Cell(20, 6, '', 0, 0,'L');
		$this->fpdf->Cell(42, 6, 'Date of Brace Application:', 0, 0,'L');
		$this->fpdf->Cell(45, 6, '', 'B', 1,'L');

		$this->fpdf->Cell(0, 6, ' ', 0, 1,'L');

		$this->fpdf->Cell(41, 6, 'Follow UP', 1, 0,'C');
		$this->fpdf->Cell(41, 12, ' ', 1, 0,'C');
		$this->fpdf->Cell(41, 6, 'Abduction Brace USE', 1, 0,'C');
		$this->fpdf->Cell(41, 12, ' ', 1, 0,'C');
		$this->fpdf->Cell(31, 6, ' ', 1, 1,'C');

		$this->fpdf->Cell(25, 6, 'Date', 1, 0,'C');
		$this->fpdf->Cell(16, 6, 'Age', 1, 0,'C');
		$this->fpdf->Cell(41, 6, 'RELAPSE', 0, 0,'C');
		$this->fpdf->Cell(20, 6, 'Size', 1, 0,'C');
		$this->fpdf->Cell(21, 6, 'Hours', 1, 0,'C');
		$this->fpdf->Cell(41, 6, 'TREATMENT', 0, 0,'C');
		$this->fpdf->Cell(31, 6, 'Next App', 1, 1,'C');

		$this->fpdf->Cell(25, 6, '', 1, 0,'C');
		$this->fpdf->Cell(16, 6, '', 1, 0,'C');
		$this->fpdf->Cell(41, 6, '', 1, 0,'C');
		$this->fpdf->Cell(20, 6, '', 1, 0,'C');
		$this->fpdf->Cell(21, 6, '', 1, 0,'C');
		$this->fpdf->Cell(41, 6, '', 1, 0,'C');
		$this->fpdf->Cell(31, 6, '', 1, 1,'C');

		$this->fpdf->Cell(25, 6, '', 1, 0,'C');
		$this->fpdf->Cell(16, 6, '', 1, 0,'C');
		$this->fpdf->Cell(41, 6, '', 1, 0,'C');
		$this->fpdf->Cell(20, 6, '', 1, 0,'C');
		$this->fpdf->Cell(21, 6, '', 1, 0,'C');
		$this->fpdf->Cell(41, 6, '', 1, 0,'C');
		$this->fpdf->Cell(31, 6, '', 1, 1,'C');

		$this->fpdf->Cell(25, 6, '', 1, 0,'C');
		$this->fpdf->Cell(16, 6, '', 1, 0,'C');
		$this->fpdf->Cell(41, 6, '', 1, 0,'C');
		$this->fpdf->Cell(20, 6, '', 1, 0,'C');
		$this->fpdf->Cell(21, 6, '', 1, 0,'C');
		$this->fpdf->Cell(41, 6, '', 1, 0,'C');
		$this->fpdf->Cell(31, 6, '', 1, 1,'C');

		$this->fpdf->Cell(25, 6, '', 1, 0,'C');
		$this->fpdf->Cell(16, 6, '', 1, 0,'C');
		$this->fpdf->Cell(41, 6, '', 1, 0,'C');
		$this->fpdf->Cell(20, 6, '', 1, 0,'C');
		$this->fpdf->Cell(21, 6, '', 1, 0,'C');
		$this->fpdf->Cell(41, 6, '', 1, 0,'C');
		$this->fpdf->Cell(31, 6, '', 1, 1,'C');

		$this->fpdf->Cell(25, 6, '', 1, 0,'C');
		$this->fpdf->Cell(16, 6, '', 1, 0,'C');
		$this->fpdf->Cell(41, 6, '', 1, 0,'C');
		$this->fpdf->Cell(20, 6, '', 1, 0,'C');
		$this->fpdf->Cell(21, 6, '', 1, 0,'C');
		$this->fpdf->Cell(41, 6, '', 1, 0,'C');
		$this->fpdf->Cell(31, 6, '', 1, 1,'C');

		$this->fpdf->Cell(25, 6, '', 1, 0,'C');
		$this->fpdf->Cell(16, 6, '', 1, 0,'C');
		$this->fpdf->Cell(41, 6, '', 1, 0,'C');
		$this->fpdf->Cell(20, 6, '', 1, 0,'C');
		$this->fpdf->Cell(21, 6, '', 1, 0,'C');
		$this->fpdf->Cell(41, 6, '', 1, 0,'C');
		$this->fpdf->Cell(31, 6, '', 1, 1,'C');

		$this->fpdf->Cell(25, 6, '', 1, 0,'C');
		$this->fpdf->Cell(16, 6, '', 1, 0,'C');
		$this->fpdf->Cell(41, 6, '', 1, 0,'C');
		$this->fpdf->Cell(20, 6, '', 1, 0,'C');
		$this->fpdf->Cell(21, 6, '', 1, 0,'C');
		$this->fpdf->Cell(41, 6, '', 1, 0,'C');
		$this->fpdf->Cell(31, 6, '', 1, 1,'C');

		$this->fpdf->Cell(25, 6, '', 1, 0,'C');
		$this->fpdf->Cell(16, 6, '', 1, 0,'C');
		$this->fpdf->Cell(41, 6, '', 1, 0,'C');
		$this->fpdf->Cell(20, 6, '', 1, 0,'C');
		$this->fpdf->Cell(21, 6, '', 1, 0,'C');
		$this->fpdf->Cell(41, 6, '', 1, 0,'C');
		$this->fpdf->Cell(31, 6, '', 1, 1,'C');

		$this->fpdf->Cell(25, 6, '', 1, 0,'C');
		$this->fpdf->Cell(16, 6, '', 1, 0,'C');
		$this->fpdf->Cell(41, 6, '', 1, 0,'C');
		$this->fpdf->Cell(20, 6, '', 1, 0,'C');
		$this->fpdf->Cell(21, 6, '', 1, 0,'C');
		$this->fpdf->Cell(41, 6, '', 1, 0,'C');
		$this->fpdf->Cell(31, 6, '', 1, 1,'C');

		$this->fpdf->Cell(25, 6, '', 1, 0,'C');
		$this->fpdf->Cell(16, 6, '', 1, 0,'C');
		$this->fpdf->Cell(41, 6, '', 1, 0,'C');
		$this->fpdf->Cell(20, 6, '', 1, 0,'C');
		$this->fpdf->Cell(21, 6, '', 1, 0,'C');
		$this->fpdf->Cell(41, 6, '', 1, 0,'C');
		$this->fpdf->Cell(31, 6, '', 1, 1,'C');

		$this->fpdf->Cell(25, 6, '', 1, 0,'C');
		$this->fpdf->Cell(16, 6, '', 1, 0,'C');
		$this->fpdf->Cell(41, 6, '', 1, 0,'C');
		$this->fpdf->Cell(20, 6, '', 1, 0,'C');
		$this->fpdf->Cell(21, 6, '', 1, 0,'C');
		$this->fpdf->Cell(41, 6, '', 1, 0,'C');
		$this->fpdf->Cell(31, 6, '', 1, 1,'C');
		//////////////////////////////////////////////////
		$this->fpdf->Cell(25, 6, 'Key', 1, 0,'L');
		$this->fpdf->Cell(16, 6, '', 1, 0,'C');
		$this->fpdf->Cell(41, 6, '', 1, 0,'C');
		$this->fpdf->Cell(20, 6, '', 1, 0,'C');
		$this->fpdf->Cell(21, 6, '', 1, 0,'C');
		$this->fpdf->Cell(41, 6, '', 1, 0,'C');
		$this->fpdf->Cell(31, 6, '', 1, 1,'C');

		$this->fpdf->Cell(25, 6, '', 1, 0,'C');
		$this->fpdf->Cell(16, 6, '', 1, 0,'C');
		$this->fpdf->Cell(41, 6, '', 1, 0,'C');
		$this->fpdf->Cell(20, 6, '', 1, 0,'C');
		$this->fpdf->Cell(21, 6, '', 1, 0,'C');
		$this->fpdf->Cell(41, 6, '', 1, 0,'C');
		$this->fpdf->Cell(31, 6, '', 1, 1,'C');

		$this->fpdf->Cell(25, 6, '', 1, 0,'C');
		$this->fpdf->Cell(16, 6, '', 1, 0,'C');
		$this->fpdf->Cell(41, 6, '', 1, 0,'C');
		$this->fpdf->Cell(20, 6, '', 1, 0,'C');
		$this->fpdf->Cell(21, 6, '', 1, 0,'C');
		$this->fpdf->Cell(41, 6, '', 1, 0,'C');
		$this->fpdf->Cell(31, 6, '', 1, 1,'C');

		$this->fpdf->Cell(25, 6, '', 1, 0,'C');
		$this->fpdf->Cell(16, 6, '', 1, 0,'C');
		$this->fpdf->Cell(41, 6, '', 1, 0,'C');
		$this->fpdf->Cell(20, 6, '', 1, 0,'C');
		$this->fpdf->Cell(21, 6, '', 1, 0,'C');
		$this->fpdf->Cell(41, 6, '', 1, 0,'C');
		$this->fpdf->Cell(31, 6, '', 1, 1,'C');
        $this->fpdf->Output();

        exit;
    }
}
