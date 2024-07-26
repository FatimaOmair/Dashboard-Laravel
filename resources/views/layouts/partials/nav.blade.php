<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href="#" class="nav-link active active-item">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Starter Pages
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="#" class="nav-link active active-item">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Active Page</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Inactive Page</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                    Simple Link
                    <span class="badge badge-danger">New</span>
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('dashboard.sliders.index') }}" class="nav-link">
                <i class="nav-icon fas fa-sliders-h"></i>
                <p>
                    Sliders
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('dashboard.banners.index') }}" class="nav-link">
                <i class="far fa-flag nav-icon"></i>
                <p>
                    Banners
                </p>
            </a>
        </li>
        <!-- New Categories Link -->
        <li class="nav-item">
            <a href="{{ route('categories.index') }}" class="nav-link">
                <i class="nav-icon fas fa-list"></i>
                <p>
                    Categories
                </p>
            </a>
        </li>
    </ul>
</nav>
