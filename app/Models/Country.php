<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
        'name',
        'code',
        'status',
        'phone_code',
    ];

    public function states()
    {
        return $this->hasMany(State::class);
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
