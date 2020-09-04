<div>
    <div class="content-wrapper">
        <div class="{{-- contenido-editar-datos --}}container-fluid pl-5 pr-5">
            <div class="pt-2 pb-2">
                <h2 class="text-center">Información personal</h2>
                <hr>
            </div>
            <div class="row ">

                <div class="col-sm-4 col-lg-4">

                    @if ($photo)
                    <img src="{{ asset('storage').'/'.Auth::user()->photo }}" class="rounded-circle mx-auto d-block"
                        style="width: 10.6rem; height: 10.6rem;">
                    @endif

                    <a class="btn btn-dark btn-block" href="{{ route('datos-user.create') }}">Cambiar imagen</a>

                </div>

                <div class="col-sm-4 col-lg-4">
                    <div class="form-group position-relative">
                        <label for="documentNumber">Número de documento
                            <span class="text-danger">*</span>
                        </label>
                        <i class="fas fa-sort-numeric-up ml-3 icons"></i>
                        <input type="number" class="form-control pl-5" id="documentNumber" wire:model="documentNumber"
                            autocomplete="off" required>

                        @error('documentNumber')
                        <span>{{ $message }} </span>
                        @enderror


                    </div>
                    <div class="form-group position-relative">
                        <label for="name">Nombres
                            <span class="text-danger">*</span>
                        </label>
                        <i class="fas fa-user ml-3 icons"></i>
                        <input type="text" class="form-control pl-5" id="name" wire:model="name" required>

                        @error('name')
                        <span>{{ $message }} </span>
                        @enderror

                    </div>

                    <div class="form-group position-relative">
                        <label for="lastname">Apellidos
                            <span class="text-danger">*</span>
                        </label>
                        <i class="far fa-user ml-3 icons"></i>
                        <input type="text" class="form-control pl-5" id="lastname" wire:model="lastname" required>
                        @error('lastname')
                        <span>{{ $message }} </span>
                        @enderror
                    </div>


                </div>
                <div class="col-sm-4 col-lg-4">

                    <div class="form-group position-relative">
                        <label for="tipo">Tipo de Identificacion
                            <span class="text-danger">*</span>
                        </label>
                        <i class="fas fa-users-cog ml-3 icons"></i>
                        <select id="tipo" class="form-control pl-5" wire:model="tipo">
                            <option selected="" disabled=""></option>
                            <option value="CC">CC - Cédula de ciudadanía</option>
                            <option value="CE">CE - Tarjeta de Identidad</option>
                        </select>

                        @error('tipo')
                        <span>{{ $message }} </span>
                        @enderror
                    </div>

                    <div class="form-group position-relative">
                        <label for="tipo_sangre">Tipo de sangre
                            <span class="text-danger">*</span>
                        </label>
                        <i class="fas fa-users-cog ml-3 icons"></i>
                        <select id="tipo_sangre" class="form-control pl-5" wire:model="tipo_sangre">
                            <option value="A+">A+</option>
                            <option value="B+">B+</option>
                            <option value="O+">O+</option>
                            <option value="AB+">AB+</option>
                            <option value="A-">A-</option>
                            <option value="B-">B-</option>
                            <option value="O-">O-</option>
                            <option value="AB-">AB-</option>
                        </select>

                        @error('tipo_sangre')
                        <span>{{ $message }} </span>
                        @enderror
                    </div>

                    <div class="form-group position-relative">
                        <label for="tipo_eps">EPS
                            <span class="text-danger">*</span>
                        </label>
                        <i class="fas fa-users-cog ml-3 icons"></i>
                        <select id="tipo_eps" class="form-control pl-5" wire:model="tipo_eps">

                            <option></option>
                            <option value="Comparta">Comparta</option>
                            <option value="Sanitas">Sanitas</option>
                        </select>
                        @error('tipo_eps')
                        <span>{{ $message }} </span>
                        @enderror
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-sm-4 col-lg-4">
                    <div class="form-group position-relative">
                        <label for="phone">Número de celular
                            <span class="text-danger">*</span>
                        </label>
                        <i class="fas fa-mobile-alt ml-3 icons"></i>
                        <input type="number" class="form-control pl-5" wire:model="phone" id="phone" required
                            autocomplete="off">

                        @error('phone')
                        <span>{{ $message }} </span>
                        @enderror
                    </div>
                </div>

                <div class="col-sm-4 col-lg-4">
                    <div class="form-group position-relative">
                        <label for="email">Correo electrónico
                            <span class="text-danger">*</span>
                        </label>
                        <i class="fas fa-envelope ml-3 icons"></i>
                        <input type="email" class="form-control pl-5" wire:model="email" id="email" required>

                        @error('email')
                        <span>{{ $message }} </span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-4 col-lg-4">
                    <div class="form-group position-relative">
                        <label for="direccion">Dirección de residencia
                            <span class="text-danger">*</span>
                        </label>
                        <i class="fas fa-user ml-3 icons"></i>
                        <input type="text" class="form-control pl-5" wire:model="direccion" id="direccion" required
                            autocomplete="off">
                        @error('direccion')
                        <span>{{ $message }} </span>
                        @enderror
                    </div>
                </div>
            </div> {{--row 2 --}}
            <div class="pb-3 d-flex justify-content-end">
                <button wire:click="store" class="btn btn-primary">Guardar datos</button>
            </div>
            
            @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
            @endif
        </div>

    </div>
</div>