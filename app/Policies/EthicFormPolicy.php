<?php

namespace App\Policies;

use App\EthicForm;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EthicFormPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any ethic forms.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the ethic form.
     *
     * @param  \App\User  $user
     * @param  \App\EthicForm  $ethicForm
     * @return mixed
     */
    public function view(User $user, EthicForm $ethicForm)
    {
        //
    }

    /**
     * Determine whether the user can create ethic forms.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {

    }

    /**
     * Determine whether the user can update the ethic form.
     *
     * @param  \App\User  $user
     * @param  \App\EthicForm  $ethicForm
     * @return mixed
     */
    public function update(User $user, EthicForm $ethicForm)
    {
        //
    }

    /**
     * Determine whether the user can delete the ethic form.
     *
     * @param  \App\User  $user
     * @param  \App\EthicForm  $ethicForm
     * @return mixed
     */
    public function delete(User $user, EthicForm $ethicForm)
    {
        //
    }

    /**
     * Determine whether the user can restore the ethic form.
     *
     * @param  \App\User  $user
     * @param  \App\EthicForm  $ethicForm
     * @return mixed
     */
    public function restore(User $user, EthicForm $ethicForm)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the ethic form.
     *
     * @param  \App\User  $user
     * @param  \App\EthicForm  $ethicForm
     * @return mixed
     */
    public function forceDelete(User $user, EthicForm $ethicForm)
    {
        //
    }
}
