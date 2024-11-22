<?php
    
namespace App\Models\Traits;

use Illuminate\Support\Facades\Auth;

trait HasPermissions
{
    public function hasPermission($permission)
    {
        return $this->roles()->whereHas('permissions', function ($query) use ($permission) {
            $query->where('name', $permission);
        })->exists();
    }
}
