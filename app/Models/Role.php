<?php

namespace App\Models;

use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    protected $fillable = [
        'name',
        'guard_name',
        'icon_class',
        'status',
        'dashboard_route',
    ];

    // User relation (many-to-many)
    public function user()
    {
        return $this->belongsToMany(User::class, 'model_has_roles', 'role_id', 'model_id');
    }




    //get icon html
    public function getIconHtmlAttribute() {
        return $this->icon_class ? '<i class="'.$this->icon_class.'"></i>' : '';
    }
    
}
