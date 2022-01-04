<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientExamination extends Model
{
    // created_at and updated_at will not make
    public $timestamps = false;

    protected $fillable = [
        'patient_id', 'head', 'heart', 'urinary', 'skin', 'spine', 'hips', 'upper', 'lower', 'neuro', 'arms', 'legs', 'other'
    ];
}
