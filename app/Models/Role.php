<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name',
        'guard_name',
        'icon',
        'status',
    ];

    //one to many
    public function permission()
    {
        return $this->hasMany(Permission::class);
    }
    //one to many
    public function user()
    {
        return $this->hasMany(User::class);
    }
}