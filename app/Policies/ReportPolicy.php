<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Report;
use Spatie\Permission\Models\Role;

class ReportPolicy
{
    /**
     * Create a new policy instance.
     */
    public function viewAny(User $user)
    {
        return $user->hasRole('admin');
    }

    public function update(User $user, Report $report)
    {
        return $user->hasRole('admin');
    }

}
