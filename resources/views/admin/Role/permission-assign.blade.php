@extends('admin.master')

@section('content')

<style>
  .assign-card {
    border: 0;
    border-radius: 1rem;
    box-shadow: 0 10px 25px rgba(0,0,0,.06);
    overflow: hidden;
  }
  .assign-card .card-header {
    background: linear-gradient(135deg, #6f42c1, #20c997);
    color: #fff;
    padding: 1rem 1.25rem;
  }
  .form-label {
    font-weight: 500;
  }
  .permission-list {
    max-height: 350px;
    overflow-y: auto;
    border: 1px solid #e9ecef;
    border-radius: .5rem;
    padding: 1rem;
    background: #fafafa;
  }
  .form-check-input:checked {
    background-color: #20c997;
    border-color: #20c997;
  }
  .btn-submit {
    background: linear-gradient(135deg, #6f42c1, #20c997);
    color: #fff;
    border: 0;
  }
  .btn-submit:hover {
    opacity: 0.9;
  }
  .permission-group {
    margin-bottom: 1.2rem;
  }
  .permission-group h6 {
    font-weight: 600;
    font-size: .9rem;
    margin-bottom: .5rem;
    color: #495057;
  }
</style>

<div class="container my-4">
  <div class="card assign-card">
    <div class="card-header d-flex align-items-center justify-content-between">
      <h5 class="mb-0"><i class="fa-solid fa-user-shield me-2"></i>Assign Permissions to Role</h5>
      <a href="{{ route('admin.roles.list') }}" class="btn btn-light btn-sm">
        <i class="fa-solid fa-arrow-left me-1"></i>Back to Roles
      </a>
    </div>

    <div class="card-body">
      <form action="" method="POST">
        @csrf

        <!-- Role Info -->
        <div class="mb-3">
          <label class="form-label">Role Name</label>
          <input type="text" class="form-control" value="{{ $role->name }}" disabled>
        </div>

        <!-- Permissions List -->
        <div class="mb-3">
          <label class="form-label">Select Permissions</label>
          <div class="permission-list">
            
            <!-- Example grouped permissions -->
            <div class="permission-group">
              <h6>User Management</h6>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="permissions[]" value="manage_users" id="perm1">
                <label class="form-check-label" for="perm1">Manage Users</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="permissions[]" value="view_users" id="perm2">
                <label class="form-check-label" for="perm2">View Users</label>
              </div>
            </div>

            <div class="permission-group">
              <h6>Role Management</h6>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="permissions[]" value="manage_roles" id="perm3">
                <label class="form-check-label" for="perm3">Manage Roles</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="permissions[]" value="view_roles" id="perm4">
                <label class="form-check-label" for="perm4">View Roles</label>
              </div>
            </div>

            <div class="permission-group">
              <h6>Reports</h6>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="permissions[]" value="view_reports" id="perm5">
                <label class="form-check-label" for="perm5">View Reports</label>
              </div>
            </div>

          </div>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-submit">
          <i class="fa-solid fa-check me-1"></i>Assign Permissions
        </button>
      </form>
    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@endsection
