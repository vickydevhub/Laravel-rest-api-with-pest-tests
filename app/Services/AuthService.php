<?php

namespace App\Services;

use App\DTOs\Auth\LoginDTO;
use App\DTOs\Auth\RegisterDTO;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class AuthService
{
    public function register(RegisterDTO $dto): User
    {
        return User::create([
            'name' => $dto->name,
            'email' => $dto->email,
            'password' => Hash::make($dto->password),
        ]);
    }

    public function login(LoginDTO $dto): string
    {
        if (! Auth::attempt($dto->toArray())) {
            throw new UnauthorizedHttpException('', 'Invalid credentials.');
        }

        /** @var User $user */
        $user = Auth::user();

        return $user->createToken('api-token')->plainTextToken;
    }

    public function logout(User $user): void
    {
        $user->tokens()->delete();
    }
}
