<?php

declare(strict_types=1);

namespace App\Service;

use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthService
{

    public function registerCustomer($name, $email, $password)
    {

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'role' => 'customer',
            'password' => Hash::make($password),

        ]);

        return $user;
    }

    public function registerAdmin($name, $email, $password)
    {

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'role' => 'admin',
            'password' => Hash::make($password),

        ]);

        return $user;
    }


    public function login($email, $password)
    {

        $email = $email;
        $password = $password;

        $user = User::where('email', $email)->first();

        if (is_null($user) || !Hash::check($password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => 'Invalid credentials',
            ]);
        }

        $token = $user->createToken('myapptoken', ['role' => $user->role]);
        $plainTextToken = $token->plainTextToken;
        $userRole = $user->role;

        return [
            'token' => $plainTextToken,
            'role' => $userRole,
        ];
    }
}
