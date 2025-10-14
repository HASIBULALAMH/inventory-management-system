@extends('layout.master')

@section('content')

<style>
  .role-card {
    border: 0;
    border-radius: 1rem;
    box-shadow: 0 10px 25px rgba(0,0,0,.06);
    overflow: hidden;
  }
  .role-card .card-header {
    background: linear-gradient(135deg, #6f42c1, #20c997);
    color: #fff;
    padding: 1rem 1.25rem;
  }
  .form-label {
    font-weight: 500;
  }
  .form-control:focus {
    box-shadow: 0 0 0 0.2rem rgba(111,66,193,.25);
    border-color: #6f42c1;
  }
  .btn-submit {
    background: linear-gradient(135deg, #6f42c1, #20c997);
    color: #fff;
    border: 0;
  }
  .btn-submit:hover {
    opacity: 0.9;
  }
</style>

<div class="container my-4">
  <div class="card role-card">
    <div class="card-header d-flex align-items-center justify-content-between">
      <h5 class="mb-0"><i class="fa-solid fa-user-shield me-2"></i>Create New Role</h5>
      <a href="{{ route('admin.roles.list') }}" class="btn btn-light btn-sm">
        <i class="fa-solid fa-arrow-left me-1"></i>Back to Roles
      </a>
    </div>

    <div class="card-body">
      <form action="{{ route('admin.roles.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
  <label for="name" class="form-label">Role Name</label>
  <input type="text" class="form-control" id="name" name="name" placeholder="Enter role name">
</div>

<div class="mb-3">
  <label for="icon_class" class="form-label">Role Icon</label>
  <input type="text" class="form-control iconpicker" id="icon_class" name="icon_class" placeholder="Select icon">
</div>


        <!--role status-->
        <div class="mb-3">
          <label for="status" class="form-label">Status</label>
          <select class="form-select" id="status" name="status" required>
            <option value="active" selected>Active</option>
            <option value="inactive">Inactive</option>
          </select>
        </div>
        <button type="submit" class="btn btn-submit">
          <i class="fa-solid fa-plus me-1"></i>Create Role
        </button>
      </form>
    </div>
  </div>
</div>
<!-- FontAwesome CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<!-- Icon Picker CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fontawesome-iconpicker/3.2.0/css/fontawesome-iconpicker.min.css">

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- Icon Picker JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/fontawesome-iconpicker/3.2.0/js/fontawesome-iconpicker.min.js"></script>
<script>
$(document).ready(function() {
    // Initialize the icon picker
    $('.iconpicker').iconpicker({
        placement: 'bottom',
        hideOnSelect: true,
        inputSearch: true,
        templates: {
            searchInput: '<input type="search" class="form-control iconpicker-search" placeholder="Search icons">'
        }
    });

    // Role name -> icon mapping
    const roleIcons = {
        'Super Admin': 'fa-solid fa-crown',
        'Admin': 'fa-solid fa-user-shield',
        'Warehouse Manager': 'fa-solid fa-warehouse',
        'Inventory Officer': 'fa-solid fa-boxes-stacked',
        'Sales Manager': 'fa-solid fa-chart-line',
        'Sales Executive': 'fa-solid fa-user-tie',
        'Accounts Manager': 'fa-solid fa-calculator',
        'Accountant': 'fa-solid fa-file-invoice-dollar',
        'HR Manager': 'fa-solid fa-people-group',
        'HR Executive': 'fa-solid fa-user-group',
        'IT Manager': 'fa-solid fa-laptop-code',
        'IT Support': 'fa-solid fa-headset'
    };

    // When typing role name → auto icon fill
    $('#name').on('input', function() {
        const roleName = $(this).val().trim();
        if (roleIcons[roleName]) {
            $('#icon_class').val(roleIcons[roleName]).trigger('change');
            $('.iconpicker').iconpicker('setIcon', roleIcons[roleName]);
        }
    });
});
</script>

@endsection
