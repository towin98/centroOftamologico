

@if (session()->has('message'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>  {{ session('message') }} </strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<div class="pt-2 pb-2 position-relative">
    <div class="position-absolute" style="
    left: 0;
    right: 0;
    text-align: center;"> 
        <h2>Listando de medicos</h2>
    </div>

    <div class="position-relative">
        <button class="btn btn-primary" wire:click="guardar">
            Crear nuevo medico
        </button>
    </div>
</div>

<div class="table-responsive-sm mt-2">
    <table class="table table-light">
        <thead>
            <tr>
                <th>MEDICO</th>
                <th>Especialidad</th>
                <th>Descripción</th>
                <th>FOTO</th>
                <th colspan="2" class="text-center">Aciones</th>
                <th></td>
            </tr>
        </thead>
        <tbody>
            @foreach ($medicos as $medico)
            <tr>
                <td>{{ $medico->nombres }} {{ $medico->apellidos }}</td>
                
                <td>{{ $medico->id_especialidad }}</td>
                <td>{{ $medico->descripcion }}</td>
                <td> <img src="{{ 'storage/'.$medico->photo }}" class="mx-auto d-block" alt="Foto de perfil medico" style="width: 60px; height: 60px;"></td>
                <td>
                    <button class="btn btn-success" wire:click="edit( {{$medico->id}} )">
                        Editar
                    </button>
                </td>
                <td>
                    <button wire:click="destroy({{ $medico->id }})" class="btn btn-danger">
                        Eliminar
                    </button>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>

</div>
{{ $medicos->links() }}