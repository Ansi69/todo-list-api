<?php

namespace App\DTO\Note;

use App\Http\Requests\Note\NoteFilterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\LaravelData\Data;

class NoteFilter extends Data
{
    public function __construct(
        public readonly string  $orderBy,
        public readonly string  $orderDirection,
        public readonly User    $user,
        public readonly ?string $perPage = null,
    )
    {
    }

    /**
     * @param NoteFilterRequest $request
     * @return NoteFilter
     */
    public static function fromRequest(NoteFilterRequest $request): NoteFilter
    {
        $data = $request->validated();

        return new self(
            orderBy: $data['order_by'] ?? 'created_at',
            orderDirection: $data['order_direction'] ?? 'asc',
            user: Auth::user(),
            perPage: $data['per_page'] ?? 15,
        );
    }
}