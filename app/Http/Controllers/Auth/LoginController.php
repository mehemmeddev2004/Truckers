<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Handle API login request
     */
    public function login(Request $request)
    {
        // ✅ Giriş verilerini doğrula
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8'],
        ]);

        // ✅ Kullanıcıyı bul
        $user = User::where('email', $credentials['email'])->first();

        // ✅ Kullanıcı yoksa veya şifre hatalıysa hata fırlat
        if (!$user) {
            throw ValidationException::withMessages([
                'email' => ['No account found for this email address.'],
            ]);
        }

        // ✅ Bcrypt formatında değilse özel mesaj ver
        try {
            if (!Hash::check($credentials['password'], $user->password)) {
                throw ValidationException::withMessages([
                    'email' => ['The provided credentials are incorrect.'],
                ]);
            }
        } catch (\RuntimeException $e) {
            throw ValidationException::withMessages([
                'password' => ['This account password is not using bcrypt. Please reset your password.'],
            ]);
        }

        // ✅ Eski tokenleri sil (isteğe bağlı güvenlik)
        $user->tokens()->delete();

        // ✅ Yeni token oluştur
        $token = $user->createToken('auth-token')->plainTextToken;

        // ✅ Başarılı yanıt döndür
        return response()->json([
            'message' => 'Login successful',
            'user' => $user,
            'token' => $token,
        ]);
    }

    /**
     * Handle logout request
     */
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logged out from all devices successfully',
        ]);
    }
}
