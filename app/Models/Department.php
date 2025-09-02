<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'name',
        'code',
        'status',
    ];

    //many to many
    public function designation()
    {
        return $this->hasMany(Designation::class);
    }
}
