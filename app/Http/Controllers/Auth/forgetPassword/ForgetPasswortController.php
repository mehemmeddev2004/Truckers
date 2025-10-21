<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException; // 🔹 bunu əlavə et

class ForgetPasswordController extends Controller
{
    public function forgetPassword(Request $request)
    {
        // 1. Email yoxlaması
        $request->validate([
            'email' => 'required|email',
        ]);

        // 2. İstifadəçini tap
        $user = User::where('email', $request->email)->first();

        // 3. Tapılmadıqda xəta at
        if (!$user) {
            throw new NotFoundHttpException('Email does not exist');
        }

        // 4. Burada şifrə sıfırlama mail-i göndərə bilərsən
        // Mail::to($user->email)->send(new ResetPasswordMail($token));

        return response()->json([
            'message' => 'Password reset link sent to your email'
        ], 200);
    }
}
