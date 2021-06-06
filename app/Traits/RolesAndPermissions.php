<?php

namespace App\Traits;

use App\Models\Role;

trait RolesAndPermissions
{
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id')->withTimestamps();
    }

    public function permissions()
    {
        return $this->roles->map->permissions->flatten()->pluck('name')->unique();
    }

    public function assignRoles($roles)
    {
        $this->roles()->sync($roles);
    }
}
