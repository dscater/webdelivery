<li class="nav-item">
    <a href="{{ route('users.index') }}" class="nav-link {{ request()->is('users*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-users"></i>
        <p>Usuarios</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('clientes.index') }}" class="nav-link {{ request()->is('clientes*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-users"></i>
        <p>Clientes</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('empresas.index') }}" class="nav-link {{ request()->is('empresas*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-list"></i>
        <p>Empresas</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('distribuidors.index') }}" class="nav-link {{ request()->is('distribuidors*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-list"></i>
        <p>Grupos Distribuidores</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('pagos.index') }}" class="nav-link {{ request()->is('pagos*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-list"></i>
        <p>Pagos</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('productos.index') }}" class="nav-link {{ request()->is('productos*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-list-alt"></i>
        <p>Productos</p>
    </a>
</li>

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
    <a href="{{ route('razon_social.index') }}"
        class="nav-link {{ request()->is('razon_social*') ? 'active' : '' }}">
        <i class="nav-icon fa fa-hospital"></i>
        <p>Razón social</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('reportes.index') }}" class="nav-link {{ request()->is('reportes*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-file-alt"></i>
        <p>Reportes</p>
    </a>
</li>
