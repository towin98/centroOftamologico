<div class="pt-3">
    <h2 class="text-center">Ingrese datos del medico</h2>
    <hr>

    @if (session()->has('message'))
    <div class="alert alert-primary alert-dismissible fade show" role="alert">
        <strong> {{ session('message') }} </strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
</div>
<div class="row">

    <div class="col-sm-6 col-lg-6">
        <label for="photo">Subir foto
            <span class="text-danger">*</span>
        </label>
        <input type="file" class="form-control pl-5" id="photo" wire:model="photo" required>

        <div wire:loading wire:target="photo" class="text-danger">Cargando...</div>

        @error('photo')
        <span class="text-danger">{{ $message }} </span>
        @enderror

        @if ($photo)
        <img src="{{ $photo->temporaryUrl() }}" class=" rounded-circle"
            style="width: 19.6rem; height: 19.6rem; margin-left: 18%; margin-right: 18%;">
        @endif

        @if ($photoMostrar)
        <img src="{{ 'storage/'.$photoMostrar }}" class=" rounded-circle
            @if ($photo)
                d-none
            @endif " style="width: 19.6rem; height: 19.6rem; margin-left: 18%; margin-right: 18%;">
        @endif

    </div>

    <div class="col-sm-6 col-lg-6">

        <div class="form-group position-relative">
            <input type="hidden" wire:model="id_medico">

            <label for="nombres">Nombres
                <span class="text-danger">*</span>
            </label>
            <i class="fas fa-mobile-alt ml-3 icons"></i>
            <input type="text" class="form-control pl-5" wire:model="nombres" id="nombres" required autocomplete="off">

            @error('nombres')
            <span class="text-danger">{{ $message }} </span>
            @enderror
        </div>

        <div class="form-group position-relative">
            <label for="apellidos">Apellidos
                <span class="text-danger">*</span>
            </label>
            <i class="fas fa-envelope ml-3 icons"></i>
            <input type="text" class="form-control pl-5" wire:model="apellidos" id="apellidos" required>

            @error('apellidos')
            <span class="text-danger">{{ $message }} </span>
            @enderror
        </div>

        <div class="form-group position-relative">
            <label for="id_especialidad">Especialidad
                <span class="text-danger">*</span>
            </label>
            <i class="fas fa-mobile-alt ml-3 icons"></i>

            <select id="id_especialidad" class="custom-select pl-5" wire:model="id_especialidad" required>
                <option value="0">Seleccione</option>
                @foreach ($especializaciones as $especialidad)
                <option value="{{$especialidad->id}}">{{$especialidad->name}}</option>
                @endforeach
            </select>

            @error('id_especialidad')
            <span class="text-danger">{{ $message }} </span>
            @enderror

        </div>
        <div class="form-group position-relative">
            <label for="descripcion_perfil">Descripcion
                <span class="text-danger">*</span>
            </label>
            <i class="fas fa-envelope ml-3 icons"></i>
            <textarea wire:model="descripcion_perfil" class="form-control" id="descripcion_perfil" rows="3"></textarea>
            @error('descripcion_perfil')
            <span class="text-danger">{{ $message }} </span>
            @enderror
        </div>

    </div>
</div> {{--row 1 --}}