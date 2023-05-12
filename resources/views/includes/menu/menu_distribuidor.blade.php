{{-- <li class="nav-item">
    <a href="{{ route('clientes.index') }}" class="nav-link {{ request()->is('clientes*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-users"></i>
        <p>Clientes</p>
    </a>
</li> --}}

<li class="nav-item">
    <a href="{{ route('ordens.index') }}" class="nav-link {{ request()->is('ordens*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-list-alt"></i>
        <p>Administrar Ordenes</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('entregas.index') }}" class="nav-link {{ request()->is('entregas*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-list-alt"></i>
        <p>Administrar Entregas</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('reportes.index') }}" class="nav-link {{ request()->is('reportes*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-file-alt"></i>
        <p>Reportes</p>
    </a>
</li>
