<?php

namespace App\Repositories;

use App\Domain\Enums\RoleEnum;
use App\DTO\User\UserFilter;
use App\Models\User;
use App\Repositories\Abstracts\UserRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Prettus\Repository\Eloquent\BaseRepository;

class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return User::class;
    }

    /**
     * @return Collection
     */
    public function getAdmins(): Collection
    {
        return $this->where('role_id', RoleEnum::admin->value)->get();
    }

    /**
     * @param UserFilter $filter
     * @return LengthAwarePaginator
     */
    public function getUsersPaginated(UserFilter $filter): LengthAwarePaginator
    {
        return $this
            ->when($filter->search,
                fn(Builder $query, $search) => $query
                    ->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
            )
            ->when($filter->roleId, fn(Builder $query) => $query->where('role_id', $filter->roleId)
            )->orderBy($filter->orderBy, $filter->orderDirection)
            ->paginate($filter->perPage);
    }
}
