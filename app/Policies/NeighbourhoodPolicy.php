<?php

namespace App\Policies;

use App\Models\Neighbourhood;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class NeighbourhoodPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability) {
        
        if ($user->is_admin) {
            return true;
        }

    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can manage neighbourhoods.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Neighbourhood  $neighbourhood
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function manage(User $user)
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Neighbourhood  $neighbourhood
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Neighbourhood $neighbourhood)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Neighbourhood  $neighbourhood
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Neighbourhood $neighbourhood)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Neighbourhood  $neighbourhood
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Neighbourhood $neighbourhood)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Neighbourhood  $neighbourhood
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Neighbourhood $neighbourhood)
    {
        //
    }
}
