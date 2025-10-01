<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $fillable = [
        'name',
        'code',
        'slug',
        'status',
        'country_id',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function cities()
    {
        return $this->hasMany(City::class);
    }
    public function warehouse()
    {
        return $this->hasMany(Warehouse::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
