@extends('layouts.customer.index')

@section('content')
<section class="vh-100">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100" style="margin-top: 115px;">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card shadow-2-strong" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">

                        <h3 class="mb-5">Sign in</h3>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                        <div class="form-outline mb-4">
                            <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus/>
                            <label class="form-label" for="typeEmailX-2">Email</label>
                            @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="form-outline mb-4">
                            <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" />
                            <label class="form-label" for="typePasswordX-2">Password</label>
                            @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <!-- Checkbox -->
                        <div class="form-check d-flex justify-content-start mb-4">
                            <input class="form-check-input" type="checkbox" value="" id="form1Example3" />
                            <label class="form-check-label" for="form1Example3"> Remember password </label>
                        </div>

                        <button class="btn btn-success" type="submit">Login</button>

                        <div class="mt-3">
                            <p class="mb-0">Don't have an account?
                                <a href="{{ route('register') }}" class="fw-bold">Sign Up</a>
                            </p>
                        </div>

                        <hr class="my-4">

                        <a href="{{ route('redirectToGoogle') }}" class="google-sign-in-button" >
                            Sign in with Google
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
{{-- <div class="container mt-5">
    <div class="row mt-5 pt-5">
        <div class="col-md-6 offset-md-3">
            <div class="card my-5 mt-5">

                <form class="card-body cardbody-color p-lg-5">

                    <div class="text-center">
                        <img src="https://cdn.pixabay.com/photo/2016/03/31/19/56/avatar-1295397__340.png"
                            class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3" width="200px"
                            alt="profile">
                    </div>

                    <div class="mb-3">
                        <input type="text" class="form-control" id="Username" aria-describedby="emailHelp"
                            placeholder="User Name">
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" id="password" placeholder="password">
                    </div>
                    <div class="text-center"><button type="submit" class="btn btn-color px-5 mb-5 w-100">Login</button>
                    </div>
                    <div id="emailHelp" class="form-text text-center mb-5 text-dark">Not
                        Registered? <a href="#" class="text-dark fw-bold"> Create an
                            Account</a>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div> --}}
@endsection
