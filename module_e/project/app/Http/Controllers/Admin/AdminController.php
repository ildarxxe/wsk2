<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function showLogin(): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.login');
    }

    public function login(Request $request): Application|\Illuminate\Routing\Redirector|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);
        $admin = Admin::query()->where('name', $data['name'])->first();
        if (!$admin) {
            return redirect()->back()->with('message', 'Пользователь не найден');
        }
        if (!Hash::check($data['password'], $admin->password)) {
            return redirect()->back()->with('message', 'Неверный пароль');
        }
        Auth::login($admin);
        return redirect('/admin')->with('message', 'Успешный вход!');
    }

    public function logout(): Application|\Illuminate\Routing\Redirector|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        Auth::logout();
        session_abort();
        return redirect('/')->with('message', 'Успешный выход!');
    }

    public function showAdmin(): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.admin');
    }
}
