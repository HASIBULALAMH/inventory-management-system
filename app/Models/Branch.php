<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable = [
        'location_id',
        'name',
        'code',
        'slug',
        'status',
    ];
    //Relationship
    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
