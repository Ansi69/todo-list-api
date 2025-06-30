<?php

namespace App\Http\Controllers\Api;

use App\DTO\Auth\AuthData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthRequest;
use App\Models\User;
use App\Services\Abstracts\UserServiceInterface;
use Exception;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class AuthController extends Controller
{
    /**
     * @param UserServiceInterface $userService
     */
    public function __construct(
        protected UserServiceInterface $userService,
    )
    {
    }

    /**
     * @param AuthRequest $request
     * @return Response
     * @throws Throwable
     */
    public function login(AuthRequest $request): Response
    {
        throw_if(!Auth::attempt($request->validated()),
            new Exception(__('exceptions.bad_login_or_password'), Response::HTTP_UNAUTHORIZED));

        /** @var User $user */
        $user = Auth::user();
        $token = $this->userService->createAccessToken($user);

        $authData = AuthData::from(['user' => $user, 'token' => $token]);

        return $authData->toResponse($request)->setStatusCode(Response::HTTP_OK);
    }

    /**
     * @return Response
     */
    public function logout(): Response
    {
        Auth::user()->tokens()->delete();

        return response()->noContent();
    }
}
