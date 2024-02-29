<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Tag;
use App\Models\User;

class TagPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        if ($user->hasAnyRole(['superadmin', 'user']) || $user->can('view tag')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    // public function view(User $user, Tag $tag): bool
    // {
    //     //
    // }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasRole('superadmin') || $user->can('create tag');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function edit(User $user, Tag $tag): bool
    {
        if ($user->hasRole('superadmin') || $user->can('edit tag')) {
            return  $user->hasRole('superadmin');
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Tag $tag): bool
    {
        if ($user->hasRole('superadmin') || $user->can('delete tag')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    // public function restore(User $user, Tag $tag): bool
    // {
    //     //
    // }

    /**
     * Determine whether the user can permanently delete the model.
     */
    // public function forceDelete(User $user, Tag $tag): bool
    // {
    //     //
    // }
}
