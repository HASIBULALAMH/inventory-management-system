<nav id="sidebar" class="sidebar">
    <div class="sidebar-content">
        <a class="sidebar-brand" href="{{ route('dashboard') }}">
            <i class="align-middle" data-feather="box"></i>
            <span class="align-middle">Admin Panel</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">Main</li>
            <li class="sidebar-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}" class="sidebar-link">
                    <i class="align-middle" data-feather="sliders"></i>
                    <span class="align-middle">Dashboard</span>
                </a>
            </li>

            <li class="sidebar-header">Management</li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link">
                    <i class="align-middle" data-feather="users"></i>
                    <span class="align-middle">Users</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link">
                    <i class="align-middle" data-feather="package"></i>
                    <span class="align-middle">Products</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link">
                    <i class="align-middle" data-feather="shopping-bag"></i>
                    <span class="align-middle">Orders</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="#" class="sidebar-link">
                    <i class="align-middle" data-feather="bar-chart-2"></i>
                    <span class="align-middle">Reports</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
