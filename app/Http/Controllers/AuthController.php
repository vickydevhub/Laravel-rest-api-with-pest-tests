<?php

namespace App\Http\Controllers;

use App\DTOs\Auth\LoginDTO;
use App\DTOs\Auth\RegisterDTO;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct(
        private readonly AuthService $authService
    ) {}

    /**
     * Handle user registration.
     *
     * @return JsonResponse
     */
    public function register(RegisterRequest $request)
    {
        $dto = RegisterDTO::fromArray($request->validated());

        $result = $this->authService->register($dto);

        $user = $result['user'];

        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'token' => $result['token'],
        ], 201);
    }

    public function login(LoginDTO $dto): ?array
    {
        if (! Auth::attempt($dto->toArray())) {
            return null;
        }

        /** @var User $user */
        $user = Auth::user();

        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token,
        ];
    }
}
