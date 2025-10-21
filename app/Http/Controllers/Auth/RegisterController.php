<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class RegisterController extends Controller
{
    public function register(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
            'role' => 'required|string'
        ]);

        $existingEmail = User::where('email', $request->email)->first();
        if ($existingEmail) {
            throw new ConflictHttpException('Email already exists');
        }

    
        $user = new User();
        $user->email = $request->email;
        $user->password = bcrypt($request->password); 
        $user->role = $request->role; 

        $user->save();

        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user
        ], 201);
    }
}
