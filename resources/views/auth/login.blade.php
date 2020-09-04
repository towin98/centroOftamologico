@extends('layouts.app')
@section('link')
    <link rel="stylesheet" href="{{ asset('css/login-register.css') }}">
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-7 col-md-6">
            <div class="mr-lg-5">
              <img src="img/undraw_doctors.png" class="img-fluid d-block mx-auto" alt="">
            </div>
        </div>

        <div class="col-lg-5 col-md-6 mt-4">
            <div class="card rounded">
                <div class="card-header text-center bg-light rounded">
                    <h5>Acceso de usuarios</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login-ingreso') }}">
                        @csrf

                        <div class="row">
                            
                            <div class="col-md-12">
                                <div class="form-group position-relative">
                                    <label for="email">Número de documento / E-mail<span class="text-danger">*</span></label>
                                    <i class="fas fa-user ml-3 icons"></i>
                                    <input type="text" class="form-control pl-5 @error('email') is-invalid @enderror" name="email"
                                        id="email" required="" autocomplete="email">
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group position-relative">
                                    <label for="password">Contraseña <span class="text-danger">*</span></label>
                                    <i class="fas fa-unlock-alt ml-3 icons"></i>
                                    <input type="password"
                                        class="form-control pl-5 @error('password') is-invalid @enderror" id="password"
                                        name="password" id="password" required autocomplete="password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                            </div>

                            {{-- <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Recordarme') }}
                                        </label>
                                    </div>
                                </div>
                            </div> --}}
 
                            <div class="col-lg-12 mb-0">
                                <button type="submit" class="btn btn-primary btn-block">
                                    INICIAR SESIÓN
                                </button>
                            </div>
                            <div class="col-12 text-center">
                                <p class="mb-0 mt-3"><small class="text-dark mr-2">¿Aún no estás registrado(a)?</small>
                                    <a href="{{ route('register') }}" class="text-dark font-weight-bold">¡Regístrate ahora!</a>
                                </p>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link " href="{{ route('password.request') }}">
                                        {{ __('Olvidaste tu contraseña') }}
                                    </a>
                                @endif
                            </div>
   
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection