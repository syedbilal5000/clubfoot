<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    // created_at and updated_at will not make
    public $timestamps = false;

    protected $fillable = [
        'patient_name', 'father_name', 'gender', 'birth_date', 'address', 'has_photo_consent', 'relation_to_patient', 'guardian_name', 'guardian_number', 'guardian_number_2', 'guardian_cnic'
    ];
}
