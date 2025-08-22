<div class="sidebar" id="sidebar">
    <div class="sidebar-header text-center py-4">
        <img src="assets/img/logo.png" alt="Logo" style="width:60px;" class="mb-2 rounded-circle shadow-sm">
        <h4 class="text-white">InventoryPro</h4>
    </div>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link active" href="{{ route('dashboard') }}"><i class="bi bi-speedometer2"></i> <span>Dashboard</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link d-flex justify-content-between align-items-center" href="#" data-bs-toggle="collapse" data-bs-target="#productsMenu">
                <span><i class="bi bi-box-seam"></i> Products</span>
                <i class="bi bi-caret-down-fill"></i>
            </a>
            <ul class="collapse nav flex-column ms-3" id="productsMenu">
                <li><a class="nav-link" href="#">All Products</a></li>
                <li><a class="nav-link" href="#">Add Product</a></li>
                <li><a class="nav-link" href="#">Inventory</a></li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link d-flex justify-content-between align-items-center" href="#" data-bs-toggle="collapse" data-bs-target="#categoriesMenu">
                <span><i class="bi bi-tags-fill"></i> Categories</span>
                <i class="bi bi-caret-down-fill"></i>
            </a>
            <ul class="collapse nav flex-column ms-3" id="categoriesMenu">
                <li><a class="nav-link" href="#">All Categories</a></li>
                <li><a class="nav-link" href="#">Add Category</a></li>
            </ul>
        </li>
        <li class="nav-item"><a class="nav-link" href="#"><i class="bi bi-people-fill"></i> <span>Suppliers</span></a></li>
        <li class="nav-item"><a class="nav-link" href="#"><i class="bi bi-bag-check-fill"></i> <span>Orders</span></a></li>
    </ul>
</div>