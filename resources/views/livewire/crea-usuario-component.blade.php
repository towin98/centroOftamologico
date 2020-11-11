<div class="content-wrapper">
    <h3 class="text-center pt-2">Ingresa los siguientes datos</h3>
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
                        <optgroup label="Eps Particular">
                            @foreach ($eps as $epsValue)
                            @if ($epsValue->id_tipo_eps == 1)
                            <option value="{{ $epsValue->id }}"
                                {{ (old("tipo_eps") == $epsValue->id ? "selected":"") }}> {{ $epsValue->nombre }}
                            </option>
                            @endif
                            @endforeach
                        </optgroup>

                        <optgroup label="Eps Prepagada">
                            @foreach ($eps as $epsValue)
                            @if ($epsValue->id_tipo_eps == 2)
                            <option value="{{ $epsValue->id }}"
                                {{ (old("tipo_eps") == $epsValue->id ? "selected":"") }}> {{ $epsValue->nombre }}
                            </option>
                            @endif
                            @endforeach
                        </optgroup>
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
                        @foreach ($tipoSangre as $tipo)
                        <option value="{{ $tipo }}" {{ (old("tipo_sangre") == $tipo ? "selected":"")}}> {{ $tipo }}
                        </option>
                        @endforeach
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
                    <label for="rol">Asigne rol
                        <span class="text-danger">*</span>
                    </label>
                    <i class="fas fa-users-cog ml-3 icons"></i>
                    <select id="rol" class="form-control pl-5" wire:model="rol" required>
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

            @if ($especialidad == true)
            <div class="col-md-3">
                <div class="form-group position-relative">
                    <label for="especialidadMedico">Especialidad
                        <span class="text-danger">*</span>
                    </label>
                    <i class="fas fa-users-cog ml-3 icons"></i>
                    <select id="especialidadMedico" class="form-control pl-5" wire:model="especialidadMedico" required>
                        <option></option>
                        @foreach ($especialidades as $especialidad)
                        <option value="{{ $especialidad->id }}"> {{ $especialidad->name }} </option>
                        @endforeach
                    </select>

                    @error('especialidadMedico')
                    <span class="badge badge-danger">{{ $message }} </span>
                    @enderror

                    
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group position-relative">
                    <label for="asuntosCita">Asuntos de citas que atendera
                        <span class="text-danger">*</span>
                    </label>
                    <i class="fas fa-users-cog ml-3 icons"></i>
                    <div wire:ignore>
                        
                        <select id="asuntosCita" class="mul-select form-control pl-5" size="12" multiple
                            wire:model="asuntosCita" required>
                            @foreach ($MotivoCitas as $MotivoCita)
                            <option value="{{ $MotivoCita->id }}"> {{ $MotivoCita->nombreasunto }} </option>
                            @endforeach
                        </select>
                    </div>
                    <h6> {{ 'Seleccionados' }} {{  implode(', ', $asuntosCita) }}</h6>
                    @error('asuntosCita')
                    <span class="badge badge-danger">{{ $message }} </span>
                    @enderror
                </div>
            </div>
            @endif
            <div class="col-md-12">
                <div class="d-flex justify-content-end">
                    <button type="button" wire:click="store" class="btn btn-primary"
                        id="registerBtn">¡REGISTRAR!</button>
                </div>
            </div>
        </div>
    </div>
</div>



              {{--   <div wire:ignore>
                    <script>
                        $(".mul-select").select2({
                        placeholder: "Seleccione citas que atendera", //placeholder
                        tags: true,
                        tokenSeparators: ['/', ',', ';', " "]
                    });
                    </script>
                </div> --}}