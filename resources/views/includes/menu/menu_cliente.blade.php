<li class="nav-item">
    <a href="{{ route('ordens.index') }}" class="nav-link {{ request()->is('ordens*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-list-alt"></i>
        <p>Administrar Ordenes</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('pagos.index') }}" class="nav-link {{ request()->is('pagos*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-list-alt"></i>
        <p>Administrar Pagos</p>
    </a>
</li>