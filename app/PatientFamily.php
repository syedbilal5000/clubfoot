<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientFamily extends Model
{
    // created_at and updated_at will not make
    public $timestamps = false;

    protected $fillable = [
        'patient_id', 'is_relatable', 'preg_len', 'has_complicated_preg', 'complications', 'is_alcoholic', 'is_smoked', 'has_complicated_birth', 'birth_place', 'referral_source', 'doctor_name', 'referral_hospital', 'other_referral'
    ];
}
