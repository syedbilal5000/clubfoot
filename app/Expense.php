<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    // protected  $primaryKey = 'donor_id';

    protected $table = 'expense';

    // created_at and updated_at will not make
    public $timestamps = false;

    protected $fillable = [
        'cat_id', 'user_id', 'name', 'amount', 'description', 'inserted_at'
    ];
}
