@extends('layouts.app')
@section('link')
    <link rel="stylesheet" href="{{ asset('css/login-register.css') }}">
@endsection
@section('content')

<div class="container">
    <div class="row justify-content-center">

        <div class="col-lg-7 col-md-6">
            <div class="mr-lg-5">
                <video playsinline="" autoplay="" muted="" loop="" width="100%" class="mx-auto">
                    <source src="video/video_register.mp4" type="video/mp4">
                </video>
            </div>
        </div>
        <div class="col-lg-5 col-md-6">
            <div class="card  rounded">
                <div class="card-header text-center bg-light rounded">
                    <h5>Crear una cuenta en el centro oftalmológico surcolombiano ltda Neiva. </h5>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group position-relative">
                                    <label>Tipo de documento (Persona)
                                        <span class="text-danger">*</span>
                                    </label>
                                    <i class="fas fa-users-cog ml-3 icons"></i>
                                    <select name="tipo" id="tipo"
                                        class="form-control pl-5 @error('tipo') is-invalid @enderror">

                                        <option selected="" disabled=""></option>
                                        <option value="CC">CC - Cédula de ciudadanía</option>
                                        <option value="CE">CE - Tarjeta de Identidad</option>
                                    </select>
                                    @error('tipo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group position-relative">
                                    <label>Número de documento<span class="text-danger">*</span></label>
                                    <i class="fas fa-sort-numeric-up ml-3 icons"></i>
                                    <input type="number" class="form-control pl-5 @error('documentNumber') is-invalid @enderror"   name="documentNumber"
                                        id="documentNumber" value="{{ old('documentNumber') }}" required
                                        autocomplete="documentNumber">
                                    @error('documentNumber')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group position-relative">
                                    <label>Nombres<span class="text-danger">*</span></label>
                                    <i class="fas fa-user ml-3 icons"></i>
                                    <input type="text" class="form-control pl-5 @error('name') is-invalid @enderror" name="name" id="name"
                                        value="{{ old('name') }}" required autocomplete="off">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group position-relative">
                                    <label>Apellidos<span class="text-danger">*</span></label>
                                    <i class="far fa-user ml-3 icons"></i>
                                    <input type="text" class="form-control pl-5 @error('lastname') is-invalid @enderror" name="lastname" id="lastname"
                                        value="{{ old('lastname') }}" required autocomplete="off">
                                    @error('lastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group position-relative">
                                    <label>Número de celular o fijo <span class="text-danger">*</span></label>
                                    <i class="fas fa-mobile-alt ml-3 icons"></i>
                                    <input type="number" class="form-control pl-5 @error('phone') is-invalid @enderror" name="phone" id="phone"
                                        value="{{ old('phone') }}" required autocomplete="phone">
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group position-relative">
                                    <label>Correo electrónico <span class="text-danger">*</span></label>
                                    <i class="fas fa-envelope ml-3 icons"></i>
                                    <input type="email" class="form-control pl-5 @error('email') is-invalid @enderror" name="email" id="email"
                                        value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group position-relative">
                                    <label>Contraseña de ingreso <span class="text-danger">*</span></label>
                                    <i class="fas fa-unlock-alt ml-3 icons"></i>
                                    <input type="password" class="form-control pl-5 @error('password') is-invalid @enderror" name="password" id="passwords"
                                        required="" autocomplete="off">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="termsAndConditions"
                                            name="termsAndConditions">
                                        <label class="custom-control-label" for="termsAndConditions">Acepto los <a
                                                href="#" target="_blank" class="text-primary">Términos y condiciones del
                                                servicio</a></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary w-100"
                                    id="registerBtn">¡REGISTRARME!</button>
                            </div>
                            <div class="mx-auto">
                                <p class="mb-0 mt-3"><small class="text-dark mr-2">¿Ya tienes una cuenta?</small> <a
                                        href="{{ route('login') }}" class="text-dark font-weight-bold">Inicia sesión</a></p>
                            </div>




                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection