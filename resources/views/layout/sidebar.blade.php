<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="index.html">
            <span class="align-middle">AdminKit</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Pages
            </li>

            <li class="sidebar-item active">
                <a class="sidebar-link" href="{{route('admin.dashboard')}}">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{route('admin.roles.list')}}">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Roles</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{route('admin.permissions.list')}}">
                    <i class="align-middle" data-feather="log-in"></i> <span class="align-middle">Permissions</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{route('admin.departments.list')}}">
                    <i class="align-middle" data-feather="user-plus"></i> <span class="align-middle"> Departments</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{route('admin.designations.list')}}">
                    <i class="align-middle" data-feather="book"></i> <span class="align-middle">Designations</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{route('admin.locations.list')}}">
                    <i class="align-middle" data-feather="book"></i> <span class="align-middle">Locations</span>
                </a>
            </li>

            
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{route('admin.users.list')}}">
                    <i class="align-middle" data-feather="book"></i> <span class="align-middle">Users</span>
                </a>
            </li>

            <li class="sidebar-header">
              Modules
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('admin.warehouse.list') }}">
                    <i class="align-middle" data-feather="square"></i> <span class="align-middle">Warehouses</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{route('admin.branch.list')}}">
                    <i class="align-middle" data-feather="package"></i> <span class="align-middle">Branch</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="">
                    <i class="align-middle" data-feather="list"></i> <span class="align-middle">Categories</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="">
                    <i class="align-middle" data-feather="brand"></i> <span class="align-middle">Brands</span>
                </a>
            </li>

        </ul>

        <div class="sidebar-cta">
            <div class="sidebar-cta-content">
                <strong class="d-inline-block mb-2">Upgrade to Pro</strong>
                <div class="mb-3 text-sm">
                    Are you looking for more components? Check out our premium version.
                </div>
                <div class="d-grid">
                    <a href="upgrade-to-pro.html" class="btn btn-primary">Upgrade to Pro</a>
                </div>
            </div>
        </div>
    </div>
</nav>