<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        if ($user->hasAnyRole(['superadmin', 'user']) || $user->can('view post')) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    // public function view(User $user, Post $post): bool
    // {
    //     //
    // }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasAnyRole(['superadmin', 'user']) || $user->can('create post');
    }

    /**
     * Determine whether the user can update the model.
     */
    // public function update(User $user, Post $post): bool
    // {
    //     //
    // }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Post $post): bool
    {
        if ($user->hasAnyRole(['superadmin', 'user']) || $user->can('delete post')) {
            return $user->id === $post->user_id || $user->hasRole('superadmin');
        }
    }

    /**
     * Determine whether the user can restore the model.
     */
    // public function restore(User $user, Post $post): bool
    // {
    //     //
    // }

    /**
     * Determine whether the user can permanently delete the model.
     */
    // public function forceDelete(User $user, Post $post): bool
    // {
    //     //
    // }
}
