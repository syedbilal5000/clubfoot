<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected  $primaryKey = 'appointment_id';

    protected $table = 'appointment';

    // created_at and updated_at will not make
    public $timestamps = false;

    protected $fillable = [
        'appointment_date', 'patient_id', 'appointment_status', 'previous_appointment_id'
    ];
}
