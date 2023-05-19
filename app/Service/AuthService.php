<?php 

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthService  {

public function registerUser($name, $email, $password){

   $user = User::create([
        'name' => $name,
        'email' => $email,
        'password' => Hash::make($password)
    ]);

    return $user;
}
}