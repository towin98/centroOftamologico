<div class="content-wrapper">
    <h3 class="text-center pt-2">Ingresa los siguinetes datos</h3>
    <div class="container pb-5 pl-5 pr-5">
        <hr>
        <div class="row">

            @if (session()->has('message'))
            <div class="alert w-100 alert-success alert-dismissible fade show" role="alert">
                <h6 class="text-center">{{ session('message') }}</h6>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            <div class="col-md-6">
                <div class="form-group position-relative">
                    <label>Tipo de documento (Persona)
                        <span class="text-danger">*</span>
                    </label>
                    <i class="fas fa-users-cog ml-3 icons"></i>
                    <select name="tipo" id="tipo" class="form-control pl-5" wire:model="tipo">

                        <option></option>
                        <option value="CC">CC - Cédula de ciudadanía</option>
                        <option value="CE">CE - Tarjeta de Identidad</option>
                    </select>
                    @error('tipo')
                    <span class="badge badge-danger"> {{ $message }} </span>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group position-relative">
                    <label for="documentNumber">Número de documento
                        <span class="text-danger">*</span>
                    </label>
                    <i class="fas fa-sort-numeric-up ml-3 icons"></i>
                    <input type="number" class="form-control pl-5" id="documentNumber" wire:model="documentNumber"
                        autocomplete="off" required>
                    @error('documentNumber')
                    <span class="badge badge-danger">{{ $message }} </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group position-relative">
                    <label for="name">Nombres
                        <span class="text-danger">*</span>
                    </label>
                    <i class="fas fa-user ml-3 icons"></i>
                    <input type="text" class="form-control pl-5" id="name" wire:model="name" required>

                    @error('name')
                    <span class="badge badge-danger">{{ $message }} </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group position-relative">
                    <label for="lastname">Apellidos
                        <span class="text-danger">*</span>
                    </label>
                    <i class="far fa-user ml-3 icons"></i>
                    <input type="text" class="form-control pl-5" id="lastname" wire:model="lastname" required>
                    @error('lastname')
                    <span class="badge badge-danger">{{ $message }} </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group position-relative">
                    <label for="phone">Número de contacto
                        <span class="text-danger">*</span>
                    </label>
                    <i class="fas fa-mobile-alt ml-3 icons"></i>
                    <input type="number" class="form-control pl-5" wire:model="phone" id="phone" required
                        autocomplete="off">

                    @error('phone')
                    <span class="badge badge-danger">{{ $message }} </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group position-relative">
                    <label for="direccion">Dirección de residencia
                        <span class="text-danger">*</span>
                    </label>
                    <i class="fas fa-user ml-3 icons"></i>
                    <input type="text" class="form-control pl-5" wire:model="direccion" id="direccion" required
                        autocomplete="off">
                    @error('direccion')
                    <span class="badge badge-danger">{{ $message }} </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-3">
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
                    <span class="badge badge-danger">{{ $message }} </span>
                    @enderror
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group position-relative">
                    <label for="tipo_sangre">Tipo de sangre
                        <span class="text-danger">*</span>
                    </label>
                    <i class="fas fa-users-cog ml-3 icons"></i>
                    <select id="tipo_sangre" class="form-control pl-5" wire:model="tipo_sangre">
                        <option></option>
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
                    <span class="badge badge-danger">{{ $message }} </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group position-relative">
                    <label for="email">Correo electrónico
                        <span class="text-danger">*</span>
                    </label>
                    <i class="fas fa-envelope ml-3 icons"></i>
                    <input type="email" class="form-control pl-5" wire:model="email" id="email" required>

                    @error('email')
                    <span class="badge badge-danger">{{ $message }} </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group position-relative">
                    <label>Contraseña de ingreso <span class="text-danger">*</span></label>
                    <i class="fas fa-unlock-alt ml-3 icons"></i>
                    <input type="password" class="form-control pl-5" wire:model="password" name="password" id="password"
                        required autocomplete="off">
                    @error('password')
                    <span class="badge badge-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group position-relative">
                    <label for="tipo_sangre">Asigne rol
                        <span class="text-danger">*</span>
                    </label>
                    <i class="fas fa-users-cog ml-3 icons"></i>
                    <select id="rol" class="form-control pl-5" wire:model="rol">
                        <option>Seleccione</option>
                        @foreach ($roles as $rol)
                        <option value="{{ $rol->id }}"> {{ $rol->name }} </option>
                        @endforeach

                    </select>

                    @error('rol')
                    <span class="badge badge-danger">{{ $message }} </span>
                    @enderror
                </div>
            </div>


            <div class="col-md-12">
                <button type="button" wire:click="store" class="btn btn-primary w-100"
                    id="registerBtn">¡REGISTRAR!</button>
            </div>

        </div>
    </div>
</div>