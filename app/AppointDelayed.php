<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppointDelayed extends Model
{
    // protected  $primaryKey = 'donor_id';

    protected $table = 'appoint_delayed';

    // created_at and updated_at will not make
    public $timestamps = false;

    protected $fillable = [
        'appointment_id', 'reason', 'description'
    ];
}
