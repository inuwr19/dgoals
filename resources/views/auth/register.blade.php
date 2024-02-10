@extends('layouts.customer.index')

@section('content')
<section class="vh-150">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100" style="margin-top: 135px;">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card shadow-2-strong" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">

                        <h3 class="mb-5">Sign Up</h3>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="form-outline mb-4">
                                <input id="name" type="name"
                                    class="form-control form-control-lg @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" required autocomplete="name" autofocus />
                                <label class="form-label" for="typeEmailX-2">Name</label>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-outline mb-4">
                                <input id="email" type="email"
                                    class="form-control form-control-lg @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus />
                                <label class="form-label" for="typeEmailX-2">Email</label>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-outline mb-4">
                                <input id="phone" type="text" class="form-control form-control-lg @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone"
                                pattern="[1-9]{1}[0-9]{9}"autofocus/>
                                <label class="form-label" for="typeEmailX-2">Phone</label>
                                @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>


                            <div class="form-outline mb-4">
                                <input id="password" type="password"
                                    class="form-control form-control-lg @error('password') is-invalid @enderror"
                                    name="password" required autocomplete="current-password" />
                                <label class="form-label" for="typePasswordX-2">Password</label>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <button class="btn btn-success" type="submit">Register</button>

                            <div class="mt-3">
                                <p class="mb-0">Have an account?
                                    <a href="{{ route('login') }}" class="fw-bold">Sign In</a>
                                </p>
                            </div>

                            <hr class="my-4">

                            <button type="button" class="google-sign-in-button">
                                Sign up with Google
                            </button>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
