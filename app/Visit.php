<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    // protected  $primaryKey = 'appointment_id';

    protected $table = 'visit_details';

    // created_at and updated_at will not make
    public $timestamps = false;

    protected $fillable = [
        'patient_id', 'visit_date', 'next_visit_date', 'appointment_id', 'side', 'CLB', 'MC', 'LHT', 'PC', 'RE', 'EH', 'mid_foot_score', 'hind_foot_score', 'total_score', 'treatment', 'complication', 'img_path', 'description', 'inserted_at'
    ];
}
