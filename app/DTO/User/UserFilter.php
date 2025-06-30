<?php

namespace App\DTO\User;

use App\Http\Requests\User\UserFilterRequest;
use Spatie\LaravelData\Data;

class UserFilter extends Data
{
    public function __construct(
        public readonly string  $orderBy,
        public readonly string  $orderDirection,
        public readonly ?string $perPage = null,
        public readonly ?string $search = null,
        public readonly ?int    $roleId = null,
    )
    {
    }

    /**
     * @param UserFilterRequest $request
     * @return UserFilter
     */
    public static function fromRequest(UserFilterRequest $request): UserFilter
    {
        $data = $request->validated();

        return new self(
            orderBy: $data['order_by'] ?? 'created_at',
            orderDirection: $data['order_direction'] ?? 'asc',
            perPage: $data['per_page'] ?? 15,
            search: $data['search'] ?? null,
            roleId: $data['role_id'] ?? null,
        );
    }
}