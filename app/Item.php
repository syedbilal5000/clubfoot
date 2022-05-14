<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    // protected  $primaryKey = 'donor_id';

    protected $table = 'item';

    // created_at and updated_at will not make
    public $timestamps = false;

    protected $fillable = [
        'name', 'price', 'description'
    ];
}
