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
        $patient = DB::select("SELECT * FROM patients p JOIN patient_families pf ON p.patient_id = pf.patient_id  JOIN patient_diagnoses pd ON p.patient_id = pd.patient_id JOIN patient_examinations pe ON p.patient_id = pe.patient_id WHERE p.patient_id = " . $id);
        return $patient;
    }

    public function get_visits($id)
    {
        $visits = DB::select("SELECT * FROM visit_details WHERE patient_id = " . $id . "  Order by visit_date, side");
        return $visits;
    }

	public function calculateAge($dob)
    {
    	$interval = date_diff(date_create(), date_create($dob));
		return $interval->format("%Yy, %Mm, %dd");
	}

    public function index($patient_id)
    {
    	//$this->calculateAge('2021-01-01');

    	$patient = $this->get_patient($patient_id);
    	if ($patient) {
    		$visits = $this->get_visits($patient_id);
    		$patient = $patient[0];
    		$this->get_pdf($patient, $visits);
    	} else {
    		dd("NO DATA FOUND");
    	}
    }
    

    public function get_pdf($patient, $visits)
    {
    	$relation_to_patient = $patient->relation_to_patient;
    	if($relation_to_patient == '1'){
    		$relation_to_patient = 'Mother';
    	}
    	else if($relation_to_patient == '2'){
    		$relation_to_patient = 'Father';
    	}
    	else if($relation_to_patient == '3'){
    		$relation_to_patient = 'Sibling';
    	}
    	else {
    		$relation_to_patient = 'Other';
    	}
    	$birth_place = $patient->birth_place;
    	if($birth_place == '1'){
    		$birth_place = 'Hospital';
    	}
    	else if($birth_place == '2'){
    		$birth_place = 'Clinic';
    	}
    	else if($birth_place == '3'){
    		$birth_place = 'Home';
    	}
    	else {
    		$birth_place = 'Other';
    	}
    	$referral_source = $patient->referral_source;
    	if($referral_source == '1'){
    		$referral_source = 'Hospital/Clinic';
    	}
    	else if($referral_source == '2'){
    		$referral_source = 'MidWife';
    	}
    	else if($referral_source == '3'){
    		$referral_source = 'Word of mouth';
    	}
    	else {
    		$referral_source = 'Other';
    	}

    	$feet_affected = $patient->feet_affected;
    	if($feet_affected == '1'){
    		$feet_affected = 'Right';
    	}
    	else if($feet_affected == '2'){
    		$feet_affected = 'Left';
    	}
    	else if($feet_affected == '3'){
    		$feet_affected = 'Both';
    	}

    	$evaluator_title = $patient->evaluator_title;
    	if($evaluator_title == '1'){
    		$evaluator_title = 'Doctor';
    	}
    	else if($evaluator_title == '2'){
    		$evaluator_title = 'Nurse';
    	}
    	else if($evaluator_title == '3'){
    		$evaluator_title = 'Midwife';
    	}
    	else if($evaluator_title == '3'){
    		$evaluator_title = 'Physical therapist';
    	}
    	else {
    		$evaluator_title = 'Other';
    	}

    	$treatment_type = $patient->treatment_type;
    	if($treatment_type == '1'){
          $treatment_type = 'Casting above knee';
        } else if($treatment_type == '2'){
          $treatment_type = 'Casting below knee';
        } else if($treatment_type == '3'){
          $treatment_type = 'Physiotherapy';
        } else {
          $treatment_type = 'Other';
        }

        $diagnosis = $patient->diagnosis;
    	if($diagnosis == '1'){
          $diagnosis = 'Idiopathic Clubfoot';
        } else if($diagnosis == '2'){
          $diagnosis = 'Syndromic Clubfoot';
        } else if($diagnosis == '3'){
          $diagnosis = 'Neuropathic Clubfoot';
        } else {
          $diagnosis = 'Other';
        }
    	$this->fpdf->AddPage();
    	$this->fpdf->SetFont('Arial', 'B', '18');
		$this->fpdf->SetTextColor(66, 146, 244);
		$this->fpdf->Cell(195, 8, 'Clubfoot Clinic Ortho Unit ll, Civil Hospital, Karachi', 0, 1,'L');
		$this->fpdf->SetFont('Arial', '', '10');
		$this->fpdf->SetTextColor(0, 0, 0);
		$this->fpdf->Cell(65, 6, 'Patient form...', 0, 0,'L');
		$this->fpdf->Cell(18, 6, 'Reg No:', 0, 0,'R');
		$this->fpdf->Cell(47, 6, 'Pc-'.substr($patient->inserted_at, 2, 2).'|'.$patient->patient_id, 'B', 0,'L');
		$this->fpdf->Cell(18, 6, 'ICR No:', 0, 0,'R');
		$this->fpdf->Cell(47, 6, $patient->icr_number, 'B', 1,'L');
		$this->fpdf->Line(10, 25, 205, 25);

		$this->fpdf->SetFont('Arial', 'B', '12');
		$this->fpdf->Cell(0, 1, '', 0, 1,'L');
		$this->fpdf->Cell(0, 10, 'General Information:', 0, 1,'L');

		$this->fpdf->SetFont('Arial', '', '10');
		$this->fpdf->Cell(25, 6, 'Patient Name:', 0, 0,'L');
		$this->fpdf->Cell(72, 6, $patient->patient_name, 'B', 0,'L');
		$this->fpdf->Cell(26, 6, 'Father\'s Name:', 0, 0,'R');
		$this->fpdf->Cell(72, 6, $patient->father_name, 'B', 1,'L');

		$this->fpdf->Cell(15, 6, 'Gender:', 0, 0,'L');
		$this->fpdf->Cell(50, 6, $patient->gender == 2 ? 'Female' : 'Male', 'B', 0,'L');
		$this->fpdf->Cell(15, 6, 'DOB:', 0, 0,'R');
		$this->fpdf->Cell(50, 6, $patient->birth_date, 'B', 0,'L');
		$this->fpdf->Cell(15, 6, 'Age:', 0, 0,'R');
		$this->fpdf->Cell(50, 6, $this->calculateAge($patient->birth_date), 'B', 1,'L');

		$this->fpdf->Cell(20, 6, 'Address1:', 0, 0,'L');
		$this->fpdf->Cell(175, 6, $patient->address, 'B', 1,'L');
		$this->fpdf->Cell(20, 6, 'Address2:', 0, 0,'L');
		$this->fpdf->Cell(175, 6, $patient->address2, 'B', 1,'L');

		$this->fpdf->Cell(160, 6, 'Does the parent or guardian consent to photographs of the patient being used for evaluation purpose', 0, 0,'L');
		$this->fpdf->Cell(35, 6, $patient->has_photo_consent == 1 ? 'Yes' : 'No', 'B', 1,'L');

		$this->fpdf->SetFont('Arial', 'B', '12');
		$this->fpdf->Cell(0, 8, 'Parent/Guardian Information:', 0, 1,'L');
		$this->fpdf->Cell(0, 8, 'Primary Parent/ Guardian:', 0, 1,'L');

		$this->fpdf->SetFont('Arial', '', '10');
		$this->fpdf->Cell(40, 6, 'Relationship to Patient:', 0, 0,'L');
		$this->fpdf->Cell(68, 6, $relation_to_patient, 'B', 0,'L');
		$this->fpdf->Cell(15, 6, 'Name:', 0, 0,'R');
		$this->fpdf->Cell(72, 6, $patient->guardian_name, 'B', 1,'L');

		$this->fpdf->Cell(30, 6, 'Phone Number 1:', 0, 0,'L');
		$this->fpdf->Cell(35, 6, $patient->guardian_number, 'B', 0,'L');
		$this->fpdf->Cell(30, 6, 'Phone Number 2:', 0, 0,'R');
		$this->fpdf->Cell(35, 6, $patient->guardian_number_2, 'B', 0,'L');
		$this->fpdf->Cell(20, 6, 'CNIC No:', 0, 0,'R');
		$this->fpdf->Cell(45, 6, $patient->guardian_cnic, 'B', 1,'L');

		$this->fpdf->Line(10, 95, 205, 95);

		$this->fpdf->SetFont('Arial', 'B', '12');
		$this->fpdf->Cell(0, 1, '', 0, 1,'L');
		$this->fpdf->Cell(0, 10, 'Family History', 0, 1,'L');

		$this->fpdf->SetFont('Arial', '', '10');
		$this->fpdf->Cell(70, 6, 'Any relatives with the clubfoot deformity:', 0, 0,'L');
		$this->fpdf->Cell(37, 6, $patient->is_relatable == 1 ? 'Yes' : 'No', 'B', 0,'L');
		$this->fpdf->Cell(60, 6, 'Length of pregnancy (in weeks):', 0, 0,'R');
		$this->fpdf->Cell(27, 6, $patient->preg_len, 'B', 1,'L');

		$this->fpdf->Cell(90, 6, 'Did the mother have any complication during pregnancy:', 0, 0,'L');
		$this->fpdf->Cell(17, 6, $patient->has_complicated_preg == 1 ? 'Yes' : 'No', 'B', 0,'L');
		$this->fpdf->Cell(60, 6, 'What were the complications:', 0, 0,'R');
		$this->fpdf->Cell(27, 6, $patient->complications, 'B', 1,'L');

		$this->fpdf->Cell(75, 6, 'Did mother consume alcohol during pregnancy:', 0, 0,'L');
		$this->fpdf->Cell(25, 6, $patient->is_alcoholic == 1 ? 'Yes' : 'No', 'B', 0,'L');
		$this->fpdf->Cell(67, 6, 'Did the mother smoke during pregnancy:', 0, 0,'R');
		$this->fpdf->Cell(27, 6, $patient->is_smoked == 1 ? 'Yes' : 'No', 'B', 1,'L');

		$this->fpdf->Cell(50, 6, 'Any complications during birth:', 0, 0,'L');
		$this->fpdf->Cell(57, 6, $patient->has_complicated_birth == 1 ? 'Yes' : 'No', 'B', 0,'L');
		$this->fpdf->Cell(60, 6, 'Place of birth:', 0, 0,'R');
		$this->fpdf->Cell(27, 6, $birth_place, 'B', 1,'L');

		$this->fpdf->SetFont('Arial', 'B', '12');
		$this->fpdf->Cell(0, 10, 'Referral Information', 0, 1,'L');

		$this->fpdf->SetFont('Arial', '', '10');
		$this->fpdf->Cell(35, 6, 'Referral source:', 0, 0,'L');
		$this->fpdf->Cell(160, 6, $referral_source, 'B', 1,'L');

		$this->fpdf->Cell(25, 6, 'Doctor Name:', 0, 0,'L');
		$this->fpdf->Cell(40, 6, $patient->doctor_name, 'B', 0,'L');
		$this->fpdf->Cell(30, 6, 'Hospital/Clinic:', 0, 0,'C');
		$this->fpdf->Cell(35, 6, $patient->referral_hospital, 'B', 0,'L');
		$this->fpdf->Cell(40, 6, 'If other, please specify:', 0, 0,'C');
		$this->fpdf->Cell(25, 6, $patient->other_referral, 'B', 1,'L');


		$this->fpdf->Line(10, 152, 205, 152);

		$this->fpdf->SetFont('Arial', 'B', '12');
		$this->fpdf->Cell(0, 1, '', 0, 1,'L');
		$this->fpdf->Cell(0, 10, 'Diagnosis:', 0, 1,'L');

		$this->fpdf->SetFont('Arial', '', '10');
		$this->fpdf->Cell(40, 6, 'Name of evaluator:', 0, 0,'L');
		$this->fpdf->Cell(57, 6, $patient->evaluator_name, 'B', 0,'L');
		$this->fpdf->Cell(40, 6, 'Evaluation Date:', 0, 0,'R');
		$this->fpdf->Cell(57, 6, $patient->evaluation_date, 'B', 1,'L');

		$this->fpdf->Cell(40, 6, 'Title of evaluator:', 0, 0,'L');
		$this->fpdf->Cell(57, 6, $evaluator_title, 'B', 0,'L');
		$this->fpdf->Cell(40, 6, 'Feet Affected:', 0, 0,'R');
		$this->fpdf->Cell(57, 6, $feet_affected, 'B', 1,'L');

		$this->fpdf->Cell(40, 6, 'Diagnosis:', 0, 0,'L');
		$this->fpdf->Cell(57, 6, $diagnosis, 'B', 0,'L');
		$this->fpdf->Cell(45, 6, 'Deformity present at birth:', 0, 0,'R');
		$this->fpdf->Cell(52, 6, $patient->has_birth_deformity == 1 ? 'Yes' : 'No', 'B', 1,'L');

		$this->fpdf->Cell(43, 6, 'Any Pervious treatments:', 0, 0,'L');
		$this->fpdf->Cell(45, 6, $patient->has_treated == 1 ? 'Yes' : 'No', 'B', 0,'L');
		$this->fpdf->Cell(70, 6, 'How many previous treatment sessions:', 0, 0,'R');
		$this->fpdf->Cell(37, 6, $patient->treatments, 'B', 1,'L');

		$this->fpdf->Cell(45, 6, 'Type of previous treatment(S):', 0, 0,'L');
		$this->fpdf->Cell(52, 6, $treatment_type, 'B', 0,'C');
		$this->fpdf->Cell(40, 6, 'Diagnosed prenatally:', 0, 0,'R');
		$this->fpdf->Cell(57, 6, $patient->has_diagnosed == 1 ? 'Yes' : 'No', 'B', 1,'L');

		$this->fpdf->Cell(40, 6, 'At pregnancy Week:', 0, 0,'L');
		$this->fpdf->Cell(57, 6, $patient->preg_week, 'B', 0,'L');
		$this->fpdf->Cell(40, 6, 'Confirmed at birth:', 0, 0,'R');
		$this->fpdf->Cell(57, 6, $patient->has_birth_confirmed == 1 ? 'Yes' : 'No', 'B', 1,'L');

		$this->fpdf->Cell(38, 6, 'Diagnosis comments:', 0, 0,'L');
		$this->fpdf->Cell(157, 6, $patient->diagnosis_comments, 'B', 1,'L');

		$this->fpdf->Line(10, 205, 205, 205);

		$this->fpdf->SetFont('Arial', 'B', '12');
		$this->fpdf->Cell(0, 1, '', 0, 1,'L');
		$this->fpdf->Cell(0, 10, 'Physical Examination:', 0, 1,'L');

		$check = '';
		$check .= $patient->is_head == '1' ? 'Head,' : '';
		$check .= $patient->is_heart == '1' ? 'Heart/Lungs,' : '';
		$check .= $patient->is_urinary == '1' ? 'Urinary/Digestive,' : '';
		$check .= $patient->is_skin == '1' ? 'Skin,' : '';
		$check .= $patient->is_spine == '1' ? 'Spine,' : '';
		$check .= $patient->is_hips == '1' ? 'Hips,' : '';

		$Abnormalities = '';
		$Abnormalities .= $patient->is_upper == '1' ? 'Upper Extremities,' : '';
		$Abnormalities .= $patient->is_lower == '1' ? 'Lower Extremities,' : '';
		$Abnormalities .= $patient->is_neuro == '1' ? 'Neurological,' : '';

		$Weekness = '';
		$Weekness .= $patient->is_arms == '1' ? 'Arms,' : '';
		$Weekness .= $patient->is_legs == '1' ? 'Legs,' : '';
		$Weekness .= $patient->is_other == '1' ? 'Other Parts of Body,' : '';

		$this->fpdf->SetFont('Arial', '', '10');
		$this->fpdf->Cell(60, 6, $check, 'B', 0,'L');
		$this->fpdf->Cell(35, 6, 'Any Abnormalities:', 0, 0,'R');
		$this->fpdf->Cell(35, 6, $Abnormalities, 'B', 0,'L');
		$this->fpdf->Cell(30, 6, 'Any Weekness:', 0, 0,'R');
		$this->fpdf->Cell(35, 6, $Weekness, 'B', 1,'L');

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
		$this->fpdf->Cell(48, 6, 'Empty Heel (total_score)', 0, 1,'L');

		$this->fpdf->Cell(0, 4, '', 0, 1,'L');

		$this->fpdf->SetFont('Arial', '', '10');
		$this->fpdf->Cell(25, 6, 'Date', 1, 0,'L');
		$date = "-";
		$colCount =0;
		for ($i=0; $i < sizeof($visits); $i++) {
			if($date != $visits[$i]->visit_date)
			{
				if($colCount == 6)
				{
					$this->fpdf->Cell(24, 6, $visits[$i]->visit_date , 1, 1,'C');
				}
				else {
					$this->fpdf->Cell(24, 6, $visits[$i]->visit_date , 1, 0,'C');
				}
				$date = $visits[$i]->visit_date;
				$colCount++;
			}
		}
		for ($i=$colCount; $i < 7; $i++) { 
			if($colCount == 6)
			{
				$this->fpdf->Cell(24, 6, ' ', 1, 1,'C');
			}
			else {
				$this->fpdf->Cell(24, 6, ' ' , 1, 0,'C');
			}
			$colCount++;
		}
		
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

		////////////////////////// CLB //////////////////////////
		$date = "-";
		$colCount =0;
		$this->fpdf->Cell(25, 6, 'CLB', 1, 0,'L');
		for ($i=0; $i < sizeof($visits) && $colCount < 14; $i++) {
			// if($date != $visits[$i]->visit_date)
			if(isset($visits[$i+1]->visit_date) && $visits[$i]->visit_date == $visits[$i+1]->visit_date)
			{
				$this->fpdf->Cell(12, 6, $visits[$i]->CLB, 1, 0,'C');
				if($colCount == 12)
					$this->fpdf->Cell(12, 6, $visits[$i+1]->CLB, 1, 1,'C');
				else 
					$this->fpdf->Cell(12, 6, $visits[$i+1]->CLB, 1, 0,'C');
				$i++;
				$colCount+=2;
			}
			else if($visits[$i]->side == "L")
			{
				$this->fpdf->Cell(12, 6, $visits[$i]->CLB, 1, 0,'C');
				if($colCount == 12)
					$this->fpdf->Cell(12, 6, ' ', 1, 1,'C');
				else 
					$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
				$colCount+=2;
			}
			else if($visits[$i]->side == "R") {
				$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
				if($colCount == 12)
					$this->fpdf->Cell(12, 6, $visits[$i]->CLB, 1, 1,'C');
				else
					$this->fpdf->Cell(12, 6, $visits[$i]->CLB, 1, 0,'C');
				$colCount+=2;
			}
		}
		for ($i=$colCount; $i < 14; $i++) { 
			if($colCount == 13)
			{
				$this->fpdf->Cell(12, 6, ' ', 1, 1,'C');
			}
			else {
				$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
			}
			$colCount++;
		}
		////////////////////////// MC //////////////////////////
		$date = "-";
		$colCount =0;
		$this->fpdf->Cell(25, 6, 'MC', 1, 0,'L');
		for ($i=0; $i < sizeof($visits) && $colCount < 14; $i++) {
			// if($date != $visits[$i]->visit_date)
			if(isset($visits[$i+1]->visit_date) && $visits[$i]->visit_date == $visits[$i+1]->visit_date)
			{
				$this->fpdf->Cell(12, 6, $visits[$i]->MC, 1, 0,'C');
				if($colCount == 12)
					$this->fpdf->Cell(12, 6, $visits[$i+1]->MC, 1, 1,'C');
				else
					$this->fpdf->Cell(12, 6, $visits[$i+1]->MC, 1, 0,'C');
				$i++;
				$colCount+=2;
			}
			else if($visits[$i]->side == "L")
			{
				$this->fpdf->Cell(12, 6, $visits[$i]->MC, 1, 0,'C');
				if($colCount == 12)
					$this->fpdf->Cell(12, 6, ' ', 1, 1,'C');
				else	
					$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
				$colCount+=2;
			}
			else if($visits[$i]->side == "R") {
				$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
				if($colCount == 12)
					$this->fpdf->Cell(12, 6, $visits[$i]->MC, 1, 1,'C');
				else	
					$this->fpdf->Cell(12, 6, $visits[$i]->MC, 1, 0,'C');
				$colCount+=2;
			}
		}
		for ($i=$colCount; $i < 14; $i++) { 
			if($colCount == 13)
			{
				$this->fpdf->Cell(12, 6, ' ', 1, 1,'C');
			}
			else {
				$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
			}
			$colCount++;
		}

		////////////////////////// LHT //////////////////////////
		$date = "-";
		$colCount =0;
		$this->fpdf->Cell(25, 6, 'LHT', 1, 0,'L');
		for ($i=0; $i < sizeof($visits) && $colCount < 14; $i++) {
			// if($date != $visits[$i]->visit_date)
			if(isset($visits[$i+1]->visit_date) && $visits[$i]->visit_date == $visits[$i+1]->visit_date)
			{
				$this->fpdf->Cell(12, 6, $visits[$i]->LHT, 1, 0,'C');
				if($colCount == 12)
					$this->fpdf->Cell(12, 6, $visits[$i+1]->LHT, 1, 1,'C');
				else	
					$this->fpdf->Cell(12, 6, $visits[$i+1]->LHT, 1, 0,'C');
				$i++;
				$colCount+=2;
			}
			else if($visits[$i]->side == "L")
			{
				$this->fpdf->Cell(12, 6, $visits[$i]->LHT, 1, 0,'C');
				if($colCount == 12)
					$this->fpdf->Cell(12, 6, ' ', 1, 1,'C');
				else	
					$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
				$colCount+=2;
			}
			else if($visits[$i]->side == "R") {
				$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
				if($colCount == 12)
					$this->fpdf->Cell(12, 6, $visits[$i]->LHT, 1, 1,'C');
				else	
					$this->fpdf->Cell(12, 6, $visits[$i]->LHT, 1, 0,'C');
				$colCount+=2;
			}
		}
		for ($i=$colCount; $i < 14; $i++) { 
			if($colCount == 13)
			{
				$this->fpdf->Cell(12, 6, ' ', 1, 1,'C');
			}
			else {
				$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
			}
			$colCount++;
		}

		////////////////////////// PC //////////////////////////
		$date = "-";
		$colCount =0;
		$this->fpdf->Cell(25, 6, 'PC', 1, 0,'L');
		for ($i=0; $i < sizeof($visits) && $colCount < 14; $i++) {
			// if($date != $visits[$i]->visit_date)
			if(isset($visits[$i+1]->visit_date) && $visits[$i]->visit_date == $visits[$i+1]->visit_date)
			{
				$this->fpdf->Cell(12, 6, $visits[$i]->PC, 1, 0,'C');
				if($colCount == 12)
					$this->fpdf->Cell(12, 6, $visits[$i+1]->PC, 1, 1,'C');
				else	
					$this->fpdf->Cell(12, 6, $visits[$i+1]->PC, 1, 0,'C');
				$i++;
				$colCount+=2;
			}
			else if($visits[$i]->side == "L")
			{
				$this->fpdf->Cell(12, 6, $visits[$i]->PC, 1, 0,'C');
				if($colCount == 12)
					$this->fpdf->Cell(12, 6, ' ', 1, 1,'C');
				else	
					$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
				$colCount+=2;
			}
			else if($visits[$i]->side == "R") {
				$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
				if($colCount == 12)
					$this->fpdf->Cell(12, 6, $visits[$i]->PC, 1, 1,'C');
				else	
					$this->fpdf->Cell(12, 6, $visits[$i]->PC, 1, 0,'C');
				$colCount+=2;
			}
		}
		for ($i=$colCount; $i < 14; $i++) { 
			if($colCount == 13)
			{
				$this->fpdf->Cell(12, 6, ' ', 1, 1,'C');
			}
			else {
				$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
			}
			$colCount++;
		}

		////////////////////////// RE //////////////////////////
		$date = "-";
		$colCount =0;
		$this->fpdf->Cell(25, 6, 'RE', 1, 0,'L');
		for ($i=0; $i < sizeof($visits) && $colCount < 14; $i++) {
			// if($date != $visits[$i]->visit_date)
			if(isset($visits[$i+1]->visit_date) && $visits[$i]->visit_date == $visits[$i+1]->visit_date)
			{
				$this->fpdf->Cell(12, 6, $visits[$i]->RE, 1, 0,'C');
				if($colCount == 12)
					$this->fpdf->Cell(12, 6, $visits[$i+1]->RE, 1, 1,'C');
				else	
					$this->fpdf->Cell(12, 6, $visits[$i+1]->RE, 1, 0,'C');
				$i++;
				$colCount+=2;
			}
			else if($visits[$i]->side == "L")
			{
				$this->fpdf->Cell(12, 6, $visits[$i]->RE, 1, 0,'C');
				if($colCount == 12)
					$this->fpdf->Cell(12, 6, ' ', 1, 1,'C');
				else	
					$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
				$colCount+=2;
			}
			else if($visits[$i]->side == "R") {
				$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
				if($colCount == 12)
					$this->fpdf->Cell(12, 6, $visits[$i]->RE, 1, 1,'C');
				else	
					$this->fpdf->Cell(12, 6, $visits[$i]->RE, 1, 0,'C');
				$colCount+=2;
			}
		}
		for ($i=$colCount; $i < 14; $i++) { 
			if($colCount == 13)
			{
				$this->fpdf->Cell(12, 6, ' ', 1, 1,'C');
			}
			else {
				$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
			}
			$colCount++;
		}

		////////////////////////// EH //////////////////////////
		$date = "-";
		$colCount =0;
		$this->fpdf->Cell(25, 6, 'EH', 1, 0,'L');
		for ($i=0; $i < sizeof($visits) && $colCount < 14; $i++) {
			// if($date != $visits[$i]->visit_date)
			if(isset($visits[$i+1]->visit_date) && $visits[$i]->visit_date == $visits[$i+1]->visit_date)
			{
				$this->fpdf->Cell(12, 6, $visits[$i]->EH, 1, 0,'C');
				if($colCount == 12)
					$this->fpdf->Cell(12, 6, $visits[$i+1]->EH, 1, 1,'C');
				else
					$this->fpdf->Cell(12, 6, $visits[$i+1]->EH, 1, 0,'C');
				$i++;
				$colCount+=2;
			}
			else if($visits[$i]->side == "L")
			{
				$this->fpdf->Cell(12, 6, $visits[$i]->EH, 1, 0,'C');
				if($colCount == 12)
					$this->fpdf->Cell(12, 6, ' ', 1, 1,'C');
				else
					$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
				$colCount+=2;
			}
			else if($visits[$i]->side == "R") {
				$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
				if($colCount == 12)
					$this->fpdf->Cell(12, 6, $visits[$i]->EH, 1, 1,'C');
				else
					$this->fpdf->Cell(12, 6, $visits[$i]->EH, 1, 0,'C');
				$colCount+=2;
			}
		}
		for ($i=$colCount; $i < 14; $i++) { 
			if($colCount == 13)
			{
				$this->fpdf->Cell(12, 6, ' ', 1, 1,'C');
			}
			else {
				$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
			}
			$colCount++;
		}

		////////////////////////// mid_foot_score //////////////////////////
		$date = "-";
		$colCount =0;
		$this->fpdf->Cell(25, 6, 'Midfoot Score', 1, 0,'L');
		for ($i=0; $i < sizeof($visits) && $colCount < 14; $i++) {
			// if($date != $visits[$i]->visit_date)
			if(isset($visits[$i+1]->visit_date) && $visits[$i]->visit_date == $visits[$i+1]->visit_date)
			{
				$this->fpdf->Cell(12, 6, $visits[$i]->mid_foot_score, 1, 0,'C');
				if($colCount == 12)
					$this->fpdf->Cell(12, 6, $visits[$i+1]->mid_foot_score, 1, 1,'C');
				else
					$this->fpdf->Cell(12, 6, $visits[$i+1]->mid_foot_score, 1, 0,'C');
				$i++;
				$colCount+=2;
			}
			else if($visits[$i]->side == "L")
			{
				$this->fpdf->Cell(12, 6, $visits[$i]->mid_foot_score, 1, 0,'C');
				if($colCount == 12)
					$this->fpdf->Cell(12, 6, ' ', 1, 1,'C');
				else
					$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
				$colCount+=2;
			}
			else if($visits[$i]->side == "R") {
				$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
				if($colCount == 12)
					$this->fpdf->Cell(12, 6, $visits[$i]->mid_foot_score, 1, 1,'C');
				else	
					$this->fpdf->Cell(12, 6, $visits[$i]->mid_foot_score, 1, 0,'C');
				$colCount+=2;
			}
		}
		for ($i=$colCount; $i < 14; $i++) { 
			if($colCount == 13)
			{
				$this->fpdf->Cell(12, 6, ' ', 1, 1,'C');
			}
			else {
				$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
			}
			$colCount++;
		}

		////////////////////////// hind_foot_score //////////////////////////
		$date = "-";
		$colCount =0;
		$this->fpdf->Cell(25, 6, 'Hindfoot Score', 1, 0,'L');
		for ($i=0; $i < sizeof($visits) && $colCount < 14; $i++) {
			// if($date != $visits[$i]->visit_date)
			if(isset($visits[$i+1]->visit_date) && $visits[$i]->visit_date == $visits[$i+1]->visit_date)
			{
				$this->fpdf->Cell(12, 6, $visits[$i]->hind_foot_score, 1, 0,'C');
				if($colCount == 12)
					$this->fpdf->Cell(12, 6, $visits[$i+1]->hind_foot_score, 1, 1,'C');
				else	
					$this->fpdf->Cell(12, 6, $visits[$i+1]->hind_foot_score, 1, 0,'C');
				$i++;
				$colCount+=2;
			}
			else if($visits[$i]->side == "L")
			{
				$this->fpdf->Cell(12, 6, $visits[$i]->hind_foot_score, 1, 0,'C');
				if($colCount == 12)
					$this->fpdf->Cell(12, 6, ' ', 1, 1,'C');
				else	
					$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
				$colCount+=2;
			}
			else if($visits[$i]->side == "R") {
				$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
				if($colCount == 12)
					$this->fpdf->Cell(12, 6, $visits[$i]->hind_foot_score, 1, 1,'C');
				else	
					$this->fpdf->Cell(12, 6, $visits[$i]->hind_foot_score, 1, 0,'C');
				$colCount+=2;
			}
		}
		for ($i=$colCount; $i < 14; $i++) { 
			if($colCount == 13)
			{
				$this->fpdf->Cell(12, 6, ' ', 1, 1,'C');
			}
			else {
				$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
			}
			$colCount++;
		}

		////////////////////////// total_score //////////////////////////
		$date = "-";
		$colCount =0;
		$this->fpdf->Cell(25, 6, 'Total Score', 1, 0,'L');
		for ($i=0; $i < sizeof($visits) && $colCount < 14; $i++) {
			// if($date != $visits[$i]->visit_date)
			if(isset($visits[$i+1]->visit_date) && $visits[$i]->visit_date == $visits[$i+1]->visit_date)
			{
				$this->fpdf->Cell(12, 6, $visits[$i]->total_score, 1, 0,'C');
				if($colCount == 12)
					$this->fpdf->Cell(12, 6, $visits[$i+1]->total_score, 1, 1,'C');
				else	
					$this->fpdf->Cell(12, 6, $visits[$i+1]->total_score, 1, 0,'C');
				$i++;
				$colCount+=2;
			}
			else if($visits[$i]->side == "L")
			{
				$this->fpdf->Cell(12, 6, $visits[$i]->total_score, 1, 0,'C');
				if($colCount == 12)
					$this->fpdf->Cell(12, 6, ' ', 1, 1,'C');
				else	
					$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
				$colCount+=2;
			}
			else if($visits[$i]->side == "R") {
				$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
				if($colCount == 12)
					$this->fpdf->Cell(12, 6, $visits[$i]->total_score, 1, 1,'C');
				else	
					$this->fpdf->Cell(12, 6, $visits[$i]->total_score, 1, 0,'C');
				$colCount+=2;
			}
		}
		for ($i=$colCount; $i < 14; $i++) { 
			if($colCount == 13)
			{
				$this->fpdf->Cell(12, 6, ' ', 1, 1,'C');
			}
			else {
				$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
			}
			$colCount++;
		}

		////////////////////////// treatment //////////////////////////
		$date = "-";
		$colCount =0;
		$this->fpdf->Cell(25, 6, 'Treatment', 1, 0,'L');
		for ($i=0; $i < sizeof($visits) && $colCount < 14; $i++) {
			// if($date != $visits[$i]->visit_date)
			if(isset($visits[$i+1]->visit_date) && $visits[$i]->visit_date == $visits[$i+1]->visit_date)
			{
				$this->fpdf->Cell(12, 6, $visits[$i]->treatment, 1, 0,'C');
				if($colCount == 12)
					$this->fpdf->Cell(12, 6, $visits[$i+1]->treatment, 1, 1,'C');
				else	
					$this->fpdf->Cell(12, 6, $visits[$i+1]->treatment, 1, 0,'C');
				$i++;
				$colCount+=2;
			}
			else if($visits[$i]->side == "L")
			{
				$this->fpdf->Cell(12, 6, $visits[$i]->treatment, 1, 0,'C');
				if($colCount == 12)
					$this->fpdf->Cell(12, 6, ' ', 1, 1,'C');
				else	
					$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
				$colCount+=2;
			}
			else if($visits[$i]->side == "R") {
				$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
				if($colCount == 12)
					$this->fpdf->Cell(12, 6, $visits[$i]->treatment, 1, 1,'C');
				else	
					$this->fpdf->Cell(12, 6, $visits[$i]->treatment, 1, 0,'C');
				$colCount+=2;
			}
		}
		for ($i=$colCount; $i < 14; $i++) { 
			if($colCount == 13)
			{
				$this->fpdf->Cell(12, 6, ' ', 1, 1,'C');
			}
			else {
				$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
			}
			$colCount++;
		}

		////////////////////////// complication //////////////////////////
		$date = "-";
		$colCount =0;
		$this->fpdf->Cell(25, 6, 'Complic', 1, 0,'L');
		for ($i=0; $i < sizeof($visits) && $colCount < 14; $i++) {
			// if($date != $visits[$i]->visit_date)
			if(isset($visits[$i+1]->visit_date) && $visits[$i]->visit_date == $visits[$i+1]->visit_date)
			{
				$this->fpdf->Cell(12, 6, $visits[$i]->complication, 1, 0,'C');
				if($colCount == 12)
					$this->fpdf->Cell(12, 6, $visits[$i+1]->complication, 1, 1,'C');
				else	
					$this->fpdf->Cell(12, 6, $visits[$i+1]->complication, 1, 0,'C');
				$i++;
				$colCount+=2;
			}
			else if($visits[$i]->side == "L")
			{
				$this->fpdf->Cell(12, 6, $visits[$i]->complication, 1, 0,'C');
				if($colCount == 12)
					$this->fpdf->Cell(12, 6, ' ', 1, 1,'C');
				else	
					$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
				$colCount+=2;
			}
			else if($visits[$i]->side == "R") {
				$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
				if($colCount == 12)
					$this->fpdf->Cell(12, 6, $visits[$i]->complication, 1, 1,'C');
				else	
					$this->fpdf->Cell(12, 6, $visits[$i]->complication, 1, 0,'C');
				$colCount+=2;
			}
		}
		for ($i=$colCount; $i < 14; $i++) { 
			if($colCount == 13)
			{
				$this->fpdf->Cell(12, 6, ' ', 1, 1,'C');
			}
			else {
				$this->fpdf->Cell(12, 6, ' ', 1, 0,'C');
			}
			$colCount++;
		}

		////////////////////////// next_visit_date //////////////////////////
		$date = "-";
		$colCount =0;
		$this->fpdf->Cell(25, 6, 'Next App', 1, 0,'L');
		for ($i=0; $i < sizeof($visits); $i++) {
			if($date != $visits[$i]->visit_date)
			{
				if($colCount == 6)
				{
					$this->fpdf->Cell(24, 6, $visits[$i]->visit_date , 1, 1,'C');
				}
				else {
					$this->fpdf->Cell(24, 6, $visits[$i]->visit_date , 1, 0,'C');
				}
				$date = $visits[$i]->visit_date;
				$colCount++;
			}
		}
		for ($i=$colCount; $i < 7; $i++) { 
			if($i == 6)
			{
				$this->fpdf->Cell(24, 6, ' ', 1, 1,'C');
			}
			else {
				$this->fpdf->Cell(24, 6, ' ' , 1, 0,'C');
			}
			//$colCount++;
		}

		$this->fpdf->Cell(25, 6, 'No of Cast', 1, 0,'L');
		
		for ($i=1; $i <= $colCount; $i++) { 
			if($i == 6)
			{
				$this->fpdf->Cell(24, 6, $i, 1, 1,'C');
			}
			else {
				$this->fpdf->Cell(24, 6, $i, 1, 0,'C');
			}
		}
		for ($i=$colCount; $i < 7; $i++) { 
			if($i == 6)
			{
				$this->fpdf->Cell(24, 6, ' ', 1, 1,'C');
			}
			else {
				$this->fpdf->Cell(24, 6, ' ' , 1, 0,'C');
			}
		}

		$this->fpdf->Cell(0, 4, '', 0, 1,'L');

		$this->fpdf->Cell(30, 6, 'Total no of Cast:', 0, 0,'L');
		$this->fpdf->Cell(57, 6, $colCount, 'B', 0,'C');
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
