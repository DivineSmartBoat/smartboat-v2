@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-5">
                    <h2 class="fw-bold mb-2">Member Login</h2>
                    <p class="text-muted mb-4">Login with your Smart ID or email.</p>

                    @if (session('status'))
                        <div class="alert alert-success">{{ session('status') }}</div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="login" class="form-label">Smart ID or Email</label>
                            <input id="login" name="login" type="text" class="form-control @error('login') is-invalid @enderror" value="{{ old('login') }}" required autofocus>
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <input id="password" name="password" type="password" class="form-control @error('password') is-invalid @enderror" required>
                        </div>

                        <button class="btn btn-success btn-lg w-100" type="submit">Login</button>
                    </form>

                    <p class="text-center text-muted mt-4 mb-0">
                        No account yet?
                        <a href="{{ route('register') }}">Register now</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
