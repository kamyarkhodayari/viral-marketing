<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Product;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index(User $user)
    {
        return $user->role == 1;
    }

    public function create(User $user)
    {
        return $user->role == 1;
    }

    public function edit(User $user, Product $product)
    {
        return $user->role == 1;
    }

    public function delete(User $user, Product $product)
    {
        return $user->role == 1;
    }
}
