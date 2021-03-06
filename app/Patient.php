<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected  $primaryKey = 'patient_id';

    // created_at and updated_at will not make
    public $timestamps = false;

    protected $fillable = [
        'patient_id', 'patient_name', 'father_name', 'gender', 'birth_date', 'address', 'address2', 'out_of_city', 'has_photo_consent', 'relation_to_patient', 'guardian_name', 'guardian_number', 'guardian_number_2', 'guardian_cnic', 'icr_number', 'donor_id', 'inserted_at'
    ];
}
