<li class="nav-item">
    <a class="nav-link @if ($menu == 'evento') {{ 'active' }}  @endif"  href="{{ route('evento.index') }}"> <strong>Citas medicas</strong></a>
</li>
@can('create')
<li class="nav-item">
    <a class="nav-link @if ($menu == 'medicos-perfil') {{ 'active' }}  @endif" href="{{ route('medicos-perfil') }}" > <strong>Saber mas de Medicos.</strong></a>
</li>
@endcan

@canany(['create','edit','delete','view']) {{-- si tiene alguno de estos permisos --}}
<li class="nav-item">
    <a class="nav-link @if ($menu == 'ubicacion') {{ 'active' }}  @endif"  href=""> <strong>Ubicacion Clinica (Maps).</strong></a>
</li>
<li class="nav-item">
    <a class="nav-link @if ($menu == 'guia') {{ 'active' }}  @endif"  href=""> <strong>Guia para agendar citas.</strong></a>
</li>

@endcan




