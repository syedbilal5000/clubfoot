<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Followup extends Model
{
    // protected  $primaryKey = 'appointment_id';

    protected $table = 'followup';

    // created_at and updated_at will not make
    public $timestamps = false;

    protected $fillable = [
        'patient_id', 'appointment_id', 'visit_date', 'next_visit_date', 'relapse', 'size', 'hours', 'treatment', 'is_virtual', 'img_path', 'description', 'inserted_at'
    ];
}
