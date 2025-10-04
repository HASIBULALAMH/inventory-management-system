<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Union extends Model
{
    protected $fillable = [
        'name',
        'code',
        'slug',
        'thana_id',
        'zipcode',
    ];
    //Relationship
    public function thana()
    {
        return $this->belongsTo(Thana::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

}
