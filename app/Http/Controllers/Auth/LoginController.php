<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;


class LoginController extends Controller
{
    public function Login (Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user || !password_verify($request->password, $user->password)) {
            throw new UnauthorizedHttpException('Invalid credentials');
        }

        return response()->json([
            'message' => 'Login successful',
            'user' => $user
        ], 200);
    }
}