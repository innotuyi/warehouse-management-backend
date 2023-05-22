<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\TestInputRequest;
use App\Models\User;
use App\Service\AuthService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\TryCatch;

class AuthController extends Controller
{
    public function __construct(protected AuthService $service)
    {
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        try {
            $this->service->registerCustomer($request->name, $request->email, $request->password);
            return response()->json(["Users registered successfull"]);
        } catch (\Exception $e) {
            throw $e->getMessage();
        }
    }


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        try {
            $token = $this->service->login(
                $request->email,
                $request->password
            );
            return response()->json(['token' => $token]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function logout(Request $request)
    {
        
        if (Auth::check()) {
          
            $user = Auth::user();
    
            $user->tokens()->delete();
        }
    
        return response()->json(['message' => 'Logged out successfully']);
    }
    
}
