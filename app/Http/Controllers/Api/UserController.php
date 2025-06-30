<?php

namespace App\Http\Controllers\Api;

use App\DTO\User\UserFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserFilterRequest;
use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Http\Resources\User\UserNoteResource;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    use AuthorizesRequests;

    /**
     * @param UserService $userService
     */
    public function __construct(
        protected UserService $userService
    )
    {
    }

    /**
     * @param UserFilterRequest $request
     * @return AnonymousResourceCollection
     */
    public function index(UserFilterRequest $request): AnonymousResourceCollection
    {
        $this->authorize('index', User::class);

        return UserResource::collection(
            $this->userService->getUsersPaginated(UserFilter::fromRequest($request))
        );
    }

    /**
     * @param UserStoreRequest $request
     * @return UserResource
     */
    public function store(UserStoreRequest $request): UserResource
    {
        $this->authorize('store', User::class);

        return UserResource::make(
            $this->userService->create($request->validated())
        );
    }

    /**
     * @param User $user
     * @return UserNoteResource
     */
    public function show(User $user): UserNoteResource
    {
        $this->authorize('show', User::class);

        return UserNoteResource::make($user->loadMissing(
            ['notes' => fn($query) => $query->withTrashed()]));
    }

    /**
     * @param UserUpdateRequest $request
     * @param User $user
     * @return UserResource
     */
    public function update(UserUpdateRequest $request, User $user): UserResource
    {
        $this->authorize('update', $user);

        return UserResource::make(
            $this->userService->update($user, $request->validated())
        );
    }

    /**
     * @param User $user
     * @return Response
     */
    public function destroy(User $user): Response
    {
        $this->authorize('delete', $user);

        $this->userService->delete($user);
        return response()->noContent();
    }

    /**
     * @return UserResource
     */
    public function self(): UserResource
    {
        return UserResource::make(Auth::user());
    }
}
