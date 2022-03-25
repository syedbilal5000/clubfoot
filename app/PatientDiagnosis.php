<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientDiagnosis extends Model
{
	protected  $primaryKey = 'patient_diagnosis_id';

    // created_at and updated_at will not make
    public $timestamps = false;

    protected $fillable = [
        'patient_id', 'evaluator_name', 'evaluation_date', 'evaluator_title', 'feet_affected', 'diagnosis', 'has_birth_deformity', 'has_treated', 'treatments', 'treatment_type', 'has_diagnosed', 'preg_week', 'has_birth_confirmed', 'diagnosis_comments'
    ];
}
