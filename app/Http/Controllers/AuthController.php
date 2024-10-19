<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // バリデーション
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 認証試行
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // セッション固定攻撃を防ぐため
            $user = Auth::user();
            return response()->json(['message' => 'ログイン成功', 'user' => $user], 200);
        }

        return response()->json(['message' => '認証に失敗しました'], 401);
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate(); // セッションを無効化
        $request->session()->regenerateToken(); // CSRF トークンを再生成

        return response()->json(['message' => 'ログアウトしました'], 200);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = new User();
        $user-> name = $request->name;
        $user-> email = $request->email;
        $user-> password = Hash::make($request->password);
        $user->save();

        Auth::login($user);

        return response()->json(['message' => 'User registered successfully', 'user' => $user], 201);
    }
}
