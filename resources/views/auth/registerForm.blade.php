@extends('auth.layouts.layout')

@section('content')
    <form action="{{ route('register.store') }}" method="POST">
        @csrf

        <a href="{{ route('home') }}">
            <img class="mb-4" src="{{ asset('assets/front/img/bootstrap-logo.svg') }}" alt="" width="72" height="57">
        </a>
        <h1 class="h3 mb-3 fw-normal">Регистрация</h1>

        <div class="form-floating">
            <input type="text" class="form-control" name="name" placeholder="Имя" value="{{ old('name') }}">
            <label for="name">Your name</label>
        </div>
        <div class="form-floating">
            <input type="email" class="form-control" name="email" placeholder="name@example.com" value="{{ old('email') }}">
            <label for="email">Email address</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" name="password" placeholder="Password">
            <label for="password">Password</label>
        </div>

        <div class="form-floating">
            <input type="password" class="form-control" name="password_confirmation" placeholder="Password">
            <label for="password">Repeat Password</label>
        </div>

        <div class="mb-3">
            <div><a href="{{ route('login.showForm') }}">Есть аккаунт? Авторизуйтесь</a></div>
        </div>

        <button class="w-100 btn btn-lg btn-primary" type="submit">Sign up</button>
        <p class="mt-5 mb-3 text-muted">&copy; {{ date('Y') }}</p>
    </form>
@endsection
