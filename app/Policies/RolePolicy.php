<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    public function manage(User $user)
    {
        return $user->hasRole('Admin'); // Sadece adminler yönetebilir
    }
}
