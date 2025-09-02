<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    protected $fillable = [
        'name',
        'code',
        'department_id',
        'status',
    ];

    //many to many
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
