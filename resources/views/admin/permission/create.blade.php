@extends('layout.master')

@section('content')

<style>
  .permission-card {
    border: 0;
    border-radius: 1rem;
    box-shadow: 0 10px 25px rgba(0,0,0,.06);
    overflow: hidden;
  }
  .permission-card .card-header {
    background: linear-gradient(135deg, #20c997, #6f42c1);
    color: #fff;
    padding: 1rem 1.25rem;
  }
  .form-label {
    font-weight: 500;
  }
  .form-control:focus, .form-select:focus {
    box-shadow: 0 0 0 0.2rem rgba(32,201,151,.25);
    border-color: #20c997;
  }
  .btn-submit {
    background: linear-gradient(135deg, #20c997, #6f42c1);
    color: #fff;
    border: 0;
  }
  .btn-submit:hover {
    opacity: 0.9;
  }
</style>

<div class="container my-4">
  <div class="card permission-card">
    <div class="card-header d-flex align-items-center justify-content-between">
      <h5 class="mb-0"><i class="fa-solid fa-lock me-2"></i>Create New Permission</h5>
      <a href="{{ route('admin.permissions.list') }}" class="btn btn-light btn-sm">
        <i class="fa-solid fa-arrow-left me-1"></i>Back to Permissions
      </a>
    </div>

    <div class="card-body">
      <form action="{{ route('admin.permissions.store') }}" method="POST">
        @csrf

        <!-- Permission Name -->
        <div class="mb-3">
          <label for="name" class="form-label">Permission Name</label>
          <input type="text" class="form-control" id="name" name="name" placeholder="Enter permission name" required>
        </div>

        <!-- Guard Name -->
        <div class="mb-3">
          <label for="guard_name" class="form-label">Guard Name</label>
          <select class="form-select" id="guard_name" name="guard_name" required>
            <option value="web" selected>Web</option>
            <option value="api">API</option>
          </select>
        </div>

        <!-- Status -->
        <div class="mb-3">
          <label for="status" class="form-label">Status</label>
          <select class="form-select" id="status" name="status" required>
            <option value="active" selected>Active</option>
            <option value="inactive">Inactive</option>
          </select>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-submit">
          <i class="fa-solid fa-plus me-1"></i>Create Permission
        </button>
      </form>
    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@endsection
