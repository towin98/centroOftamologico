@extends('layouts.app')
@section('cambiar-password')
<div class="content-wrapper">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(session()->has('alert-success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{session('alert-success')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            @if(session()->has('alert-warning'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{session('alert-warning')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <div class="card mt-4">
                <div class="card-header">Cambio de contraseña</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('datos-usuario.cambiar-password') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="passwordOld" class="col-md-4 col-form-label text-md-right">Contraseña
                                Anterior</label>

                            <div class="col-md-6">
                                <input id="passwordOld" type="password"
                                    class="form-control password @error('passwordOld') is-invalid @enderror" name="passwordOld"
                                    value="{{ old('passwordOld') }}" required autocomplete="passwordOld" autofocus>

                                @error('passwordOld')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="passwordNew" class="col-md-4 col-form-label text-md-right">Contraseña
                                Nueva</label>

                            <div class="col-md-6">
                                <input id="passwordNew" type="password"
                                    class="form-control password @error('passwordNew') is-invalid @enderror" name="passwordNew"
                                    value="{{ old('passwordNew') }}" required autocomplete="passwordNew">
                                @error('passwordNew')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="passwordConfirm" class="col-md-4 col-form-label text-md-right">Confirme
                                Contraseña</label>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input id="passwordConfirm" type="password"
                                        class="form-control password @error('passwordConfirm') is-invalid @enderror"
                                        name="passwordConfirm" value="{{ old('passwordConfirm') }}" required
                                        autocomplete="passwordConfirm">
                                    <div class="input-group-append">
                                        <i id="passwordEye" class="btn btn-outline-secondary fas fa-eye-slash"></i>
                                    </div>
                                </div>
                                @error('passwordConfirm')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">Cambiar contraseña</button>
                                <a class="btn btn-dark" href=" {{ route('datos-usuario') }} ">Atras</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('js/passwordEye.js') }}"></script>    
@endsection
