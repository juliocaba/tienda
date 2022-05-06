<li class="nav-item {{ Request::is('/home*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('home') }}">
        <i class="nav-icon icon-home"></i>        
        <span>Inicio</span>
    </a>
</li>
<li class="nav-item {{ Request::is('admin/categories*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin.categories.index') }}">
        <i class="nav-icon icon-layers"></i>
        <span>Categorias</span>
    </a>
</li>
