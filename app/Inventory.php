<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    // protected  $primaryKey = 'donor_id';

    protected $table = 'inventory';

    // created_at and updated_at will not make
    public $timestamps = false;

    protected $fillable = [
        'item_id', 'user_id', 'name', 'unit_cost', 'total_amount', 'unit_balance', 'description', 'inserted_at'
    ];
}
