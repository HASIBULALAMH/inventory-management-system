<nav class="navbar navbar-expand-lg shadow-sm px-3">
    <button class="btn btn-outline-secondary d-lg-none" id="sidebarToggle"><i class="bi bi-list"></i></button>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav ms-auto align-items-center">
            <li class="nav-item me-3 position-relative">
                <i class="bi bi-bell fs-5 position-relative" id="notificationIcon"></i>
                <span class="badge bg-danger position-absolute top-0 start-100 translate-middle p-1 rounded-circle animate-bounce" id="notificationBadge"></span>
            </li>
            <li class="nav-item me-3">
                <button id="modeToggle" class="btn btn-outline-secondary"><i class="bi bi-moon-fill"></i></button>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                    <i class="bi bi-person-circle fs-4 me-2"></i> Admin
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li><a class="dropdown-item" href="#">Logout</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>