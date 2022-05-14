<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // protected  $primaryKey = 'donor_id';

    protected $table = 'category';

    // created_at and updated_at will not make
    public $timestamps = false;

    protected $fillable = [
        'name', 'description'
    ];
}
