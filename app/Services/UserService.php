<?php

namespace App\Services;

use App\DTO\User\UserFilter;
use App\Models\User;
use App\Repositories\Abstracts\UserRepository;
use App\Services\Abstracts\UserServiceInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class UserService implements UserServiceInterface
{
    public function __construct(
        protected UserRepository $userRepository,
    )
    {
    }

    /**
     * @param array $data
     * @return User
     */
    public function create(array $data): User
    {
        return User::query()->create($data);
    }

    /**
     * @param User $user
     * @param array $data
     * @return User
     */
    public function update(User $user, array $data): User
    {
        $user->fill($data)->save();

        return $user;
    }

    /**
     * @param User $user
     * @return void
     */
    public function delete(User $user): void
    {
        $user->delete();
    }

    /**
     * @param User $user
     * @return string
     */
    public function createAccessToken(User $user): string
    {
        return $user->createToken('auth_token')->plainTextToken;
    }

    /**
     * @param UserFilter $filter
     * @return LengthAwarePaginator
     */
    public function getUsersPaginated(UserFilter $filter): LengthAwarePaginator
    {
        return $this->userRepository->getUsersPaginated($filter);
    }
}
