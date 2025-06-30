<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function index(User $user): bool
    {
        return $user->isAdmin();
    }
    public function store(User $user): bool
    {
        return $user->isAdmin();
    }

    public function show(User $user): bool
    {
        return $user->isAdmin();
    }

    public function update(User $user, User $model): bool
    {
        return $user->isAdmin() && !$model->isAdmin();
    }

    public function delete(User $user, User $model): bool
    {
        return $user->isAdmin() && !$model->isAdmin();
    }
}
