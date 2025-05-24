<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function login(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required',
            'password' => 'required'
        ]);

        $user = Admin::query()->where('name', $data['name'])->first();
        if (!$user) {
            return redirect()->back()->with('message', 'Пользователь не найден');
        }
        if (!Hash::check($data['password'], $user->password)) {
            return redirect()->back()->with('message', 'Неправильный пароль');
        }
        Auth::login($user);
        return redirect('/admin')->with('message', 'Успешный вход');
    }

    public function logout(): RedirectResponse {
        Auth::logout();
        session_destroy();
        return redirect('/admin/login');
    }
}
