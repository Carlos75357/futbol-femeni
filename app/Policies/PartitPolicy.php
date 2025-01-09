<?php

namespace App\Policies;

use App\Models\Partit;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PartitPolicy
{
    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Partit $partit): bool
    {
        return $user->role === 'arbitre' && $user->id === $partit->arbitre_id; // Only referees can update matches
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Partit $partit): bool
    {
        return false;
    }
}

