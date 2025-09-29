<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
       'name',
       'email',
       'password',
       'phone',
       'gender',
       'dob',
       'present_address',
       'permanent_address',
       'employee_id',
       'department_id',
       'designation_id',
       'role',
       'join_date',
       'profile_photo',
       'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }



    //many to many
   public function designation()
   {
       return $this->belongsTo(Designation::class);
   }

   //many to many
   public function department()
   {
       return $this->belongsTo(Department::class);
   }

    public function warehouses()
    {
        return $this->belongsToMany(Warehouse::class, 'user_warehouses', 'user_id', 'warehouse_id');
    }

  

  
}
