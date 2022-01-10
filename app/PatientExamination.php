<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientExamination extends Model
{
    // created_at and updated_at will not make
    public $timestamps = false;

    protected $fillable = [
        'patient_id', 'is_head', 'is_heart', 'is_urinary', 'is_skin', 'is_spine', 'is_hips', 'is_upper', 'is_lower', 'is_neuro', 'is_arms', 'is_legs', 'is_other'
    ];
}
