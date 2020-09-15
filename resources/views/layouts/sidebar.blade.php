@section('openSidebar')
<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>

@endsection

@section('sidebar')

<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #040026 !important;">
  <!-- Brand Logo -->
  <a href="#" class="brand-link">
    <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
      style="opacity: .8">
    <span class="brand-text font-weight-light">Centro Oftamologico</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">

    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <a href="{{ route('datos-user.create') }}">
          <img src="{{ asset('storage').'/'.Auth::user()->photo }}" class="img-circle elevation-2" alt="User Image">
        </a>
      </div>
      <div class="info">
        <a href="{{ route('datos-user.create') }}" class="d-block">{{ Auth::user()->name }}
          {{  Auth::user()->lastname }}</a>
      </div>
    </div>

    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        @can('Editar datos')
        <li class="nav-header">Datos</li>
        <li class="nav-item">
          <a href="{{ route('datos-user.index') }}"
            class="nav-link  @if ($menu == 'editar-datos') {{ 'active' }}  @endif">
            <i class="nav-icon fas fa-chalkboard-teacher"></i>
            <p>
              Editar mis datos
            </p>
          </a>
        </li>
        @endcan

        @canany(['Crear Rol','Asignar Rol']) {{-- si tiene alguno de estos permisos --}}
        <li class="nav-header">Usuarios</li>

        <li class="nav-item">
          <a href="{{-- {{ route('crearUsuario') }} --}}"
            class="nav-link {{-- @if ($menu == 'crearUsuario') {{ 'active' }}  @endif --}}">
            <i class="far fa-circle nav-icon"></i>
            <p>Crear Usuario</p>
          </a>
        </li>
        
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon far fa-envelope"></i>
            <p>
              Roles
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            @can('Crear Rol')
            <li class="nav-item">
              <a href="{{ route('crearRol') }} " class="nav-link @if ($menu == 'crearRol') {{ 'active' }}  @endif">
                <i class="far fa-circle nav-icon"></i>
                <p>Crear Rol</p>
              </a>
            </li>
            @endcan

            @can('Asignar Rol')
            <li class="nav-item">
              <a href="{{ route('asignarRolUser') }}"
                class="nav-link @if ($menu == 'asignarRolUser') {{ 'active' }}  @endif">
                <i class="far fa-circle nav-icon"></i>
                <p>Asignar Rol User</p>
              </a>
            </li>
            @endcan
          </ul>
        </li>
        @endcan

        




        <li class="nav-header">Medicos</li>
        @can('Registrarse como medico')
        <li class="nav-item">
          <a href=" {{ route('medicos-registro') }} "
            class="nav-link @if ($menu == 'medicos-registro') {{ 'active' }}  @endif">
            <i class="nav-icon fas fa-chalkboard-teacher"></i>
            <p>
              Registrar medicos
            </p>
          </a>
        </li>
        @endcan
        @can('Ver medicos centro')
        <li class="nav-item">
          <a href="{{ route('medicos-perfil') }}" class="nav-link
          @if ($menu == 'medicos-centro') {{ 'active' }}  @endif">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Medicos centro.
            </p>
          </a>
        </li>
        @endcan
        @can('Turno')
        <li class="nav-item">
          <a href="{{ route('turno.index') }}" class="nav-link
          @if ($menu == 'turno-horario') {{ 'active' }}  @endif">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Turno.
            </p>
          </a>
        </li>
        @endcan

        <li class="nav-header">MENU</li>
        @can('Agendar Cita')
        <li class="nav-item">
          <a href="{{ route('cita.index') }}" class="nav-link @if ($menu == 'cita') {{ 'active' }}  @endif">
            <i class="nav-icon fas fa-chalkboard-teacher"></i>
            <p>
              Citas medicas
              <span class="badge badge-info right">2</span>
            </p>
          </a>
        </li>
        @endcan
        <li class="nav-item">
          <a href="#" class="nav-link  @if ($menu == 'ubicacion') {{ 'active' }}  @endif">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Ubicacion Clinica.
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link  @if ($menu == 'guia') {{ 'active' }}  @endif">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Guia para agendar citas.
            </p>
          </a>
        </li>
        {{-- <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon far fa-envelope"></i>
            <p>
              Ventas
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="registrarventa" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Registrar venta</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="reporteventas" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Reporte ventas</p>
              </a>
            </li>
          </ul>
        </li> --}}

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
</aside>

@endsection