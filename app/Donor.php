<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Donor extends Model
{
    protected  $primaryKey = 'donor_id';

    // protected $table = 'appointment';

    // created_at and updated_at will not make
    public $timestamps = false;

    protected $fillable = [
        'first_name', 'last_name', 'donor_email', 'donor_number', 'donor_address'
    ];
}
