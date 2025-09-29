<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    //

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_warehouses', 'warehouse_id', 'user_id');
    }
}
