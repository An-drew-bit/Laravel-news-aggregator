<?php

namespace App\Http\Controllers\Auth;

use App\Events\UserLastLoginEvent;
use App\Http\Controllers\Controller;
use App\Jobs\ForgotUserEmailJob;
use App\Http\Requests\Auth\{AuthRequest, ForgotRequest, RegisterRequest};
use App\Models\User;
use Illuminate\Auth\Events\Registered;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.registerForm');
    }

    public function store(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        if ($user) {
            event(new Registered($user));

            auth('web')->login($user);

            return to_route('verification.notice');
        }

        return to_route('home')->with('success', 'Вы успешно зарегистрировались');
    }

    public function showLoginForm()
    {
        return view('auth.loginForm');
    }

    public function login(AuthRequest $request)
    {
        if (auth('web')->attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            event(new UserLastLoginEvent(auth()->user()));

            session()->flash('success', 'Вы успешно вошли');

            if (auth()->user()->is_admin) {
                return to_route('admin.index');

            } else {
                return to_route('home');
            }
        }

        return to_route('login')->with('error', 'Не правильно введен Логин или Пароль');
    }

    public function showForgotForm()
    {
        return view('auth.forgotPassword.forgotForm');
    }

    public function forgot(ForgotRequest $request)
    {
        $user = User::where(['email' => $request->get('email')])->firstOrFail();

        $password = uniqid();

        $user->password = bcrypt($password);
        $user->update();

        dispatch(new ForgotUserEmailJob($user, $password));

        return to_route('login.showForm')->with('message', 'Письмо отправлено в логи');
    }

    public function logout()
    {
        auth('web')->logout();

        return to_route('home');
    }
}
