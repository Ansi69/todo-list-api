<?php

namespace App\Http\Resources\User;

use App\DTO\Auth\AuthData;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin AuthData */
class UserAuthResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            "token" => $this->token,
            "user" => UserResource::make($this->user),
        ];
    }
}
