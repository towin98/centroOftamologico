<div>
    <div class="content-wrapper">
        <div class="container">
            <div class="pt-2 row">
                @include("livewire.horario.form-horario")
                @include("livewire.horario.$view")
            </div>

            <div class="pt-4 pb-2 d-flex justify-content-around">
                <div>
                    <h2>Horario</h2>
                </div>
                <div>
                    <select class="form-control" wire:model="id_medico">
                        <option>Seleccione un medico para filtrar su horario</option>
                        @foreach ($medicos as $medico)
                        <option value="{{ $medico->id }}"> {{ $medico->name }} {{ $medico->lastname }} </option>
                        @endforeach
                    </select>
                    @error('id_medico')
                    <span class="badge badge-danger"> {{ $message }} </span>
                    @enderror
                </div>
            </div>

            <div class="table-responsive-sm mt-2">
                <table class="table table-bordered">
                    <thead>
                        <tr class="table-success">
                            <th>NOMBRE</th>
                            <th>DIA TURNO</th>
                            <th>HORA INICIA TURNO</th>
                            <th>HORA FINALIZA TURNO</th>
                            <th>Consultario</th>
                            <th style="width: 10px;">Editar</th>
                            <th style="width: 10px;">Borrar</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($turnos as $turno)
                        <tr>
                            <td>{{ $turno->nombre }}</td>
                            <td>{{ $turno->dia_turno }}</td>
                            <td>{{ $turno->hora_inicio }}</td>
                            <td>{{ $turno->hora_fin }} </td>
                            <td>{{ $turno->id_consultorio }} </td>

                            <td>
                                <button wire:click="editar_horario({{$turno->id }})" class="btn btn-dark">
                                    Editar
                                </button>
                            </td>
                            <td>
                                <button onclick="alert()" wire:click="destroy({{$turno->id }})" class="btn btn-danger">
                                    Borrar
                                </button>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{ $turnos->links() }}
                </div>
            </div>

        </div>
    </div>

    @if (session()->has('message'))
    <script>
        Swal.fire(
                    '{{session('message')}}',
                    'Ok para continuar!',
                    'success'
                    );
    </script>
    @endif

    @if (session()->has('Existe'))
    <script>
        Swal.fire(
                    '{{session('Existe')}}',
                    'Ok para continuar!',
                    'error'
                    );
    </script>
    @endif


    <script>
    function alert() {
        const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        onOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })
  
    Toast.fire({
        icon: 'success',
        title: 'Registro eliminado'
    });
    }
    </script>



</div>