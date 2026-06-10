<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'username'     => ['required', 'string', 'max:255', 'unique:users,username'],
            'email'        => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'kelamin'      => ['required'],
            'role'         => ['required', Rule::in(['siswa', 'walikelas', 'bendahara', 'admin'])],
            'password'     => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'nama_lengkap' => $request->nama_lengkap,
            'username'     => $request->username,
            'email'        => $request->email,
            'kelamin'      => $request->kelamin,
            'role'         => $request->role,
            'password'     => Hash::make($request->password),
        ]);

        event(new Registered($user));

        return redirect()->route('login')
            ->with('success', 'Registrasi berhasil. Silakan login.');
    }
}
