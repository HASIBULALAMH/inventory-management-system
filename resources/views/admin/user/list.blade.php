@extends('admin.master')

@section('content')

<style>
  .user-card {
    border: 0;
    border-radius: 1rem;
    box-shadow: 0 8px 25px rgba(0,0,0,.06);
    overflow: hidden;
  }
  .user-card .card-header {
    background: linear-gradient(135deg, #6f42c1, #20c997);
    color: #fff;
    padding: 1rem 1.25rem;
  }
  .form-control, .form-select {
    border-radius: .6rem;
    padding: .5rem .9rem;
  }
  .table thead {
    background: #f8f9fa;
  }
  .table th {
    font-weight: 600;
    color: #495057;
  }
  .badge {
    font-size: .75rem;
    padding: .45em .65em;
    border-radius: .4rem;
  }
</style>

<div class="container my-4">
  <div class="card user-card">
    <div class="card-header d-flex align-items-center justify-content-between">
      <h5 class="mb-0"><i class="fa-solid fa-users me-2"></i>User List</h5>
      <a href=" {{ route('admin.users.create') }}" class="btn btn-light btn-sm"><i class="fa-solid fa-plus me-1"></i>Create User</a>
    </div>

    <div class="card-body">
      <!-- Search & Filter -->
      <div class="row mb-3 g-2">
        <div class="col-md-4">
          <input type="text" class="form-control" placeholder="🔍 Search by name, email or phone...">
        </div>
        <div class="col-md-3">
          <select class="form-select">
            <option value="">Filter by Department</option>
            <option>Sales</option>
            <option>Warehouse</option>
            <option>Accounts</option>
            <option>IT</option>
            <option>HR</option>
          </select>
        </div>
        <div class="col-md-3">
          <select class="form-select">
            <option value="">Filter by Role</option>
            <option>Admin</option>
            <option>Manager</option>
            <option>Staff</option>
            <option>Vendor</option>
          </select>
        </div>
        <div class="col-md-2">
          <button class="btn btn-gradient w-100"><i class="fa-solid fa-filter me-1"></i>Filter</button>
        </div>
      </div>

      <!-- User Table -->
      <div class="table-responsive">
        <table class="table table-bordered align-middle">
          <thead>
            <tr>
              <th>#</th>
              <th>Profile</th>
              <th>Full Name</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Employee ID</th>
              <th>Department</th>
              <th>Designation</th>
              <th>Role</th>
              <th>Status</th>
              <th>Join Date</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <!-- Example User -->
            <tr>
              <td>1</td>
              <td><img src="https://via.placeholder.com/40" class="rounded-circle" alt="Profile"></td>
              <td>Hasibul Alam</td>
              <td>hasibul@example.com</td>
              <td>+8801700000000</td>
              <td>EMP-001</td>
              <td>IT</td>
              <td>Web Developer</td>
              <td><span class="badge bg-primary">Admin</span></td>
              <td><span class="badge bg-success">Active</span></td>
              <td>2025-01-10</td>
              <td>
                <a href="#" class="btn btn-sm btn-info"><i class="fa-solid fa-eye"></i></a>
                <a href="#" class="btn btn-sm btn-warning"><i class="fa-solid fa-pen"></i></a>
                <a href="#" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></a>
              </td>
            </tr>
            <tr>
              <td>2</td>
              <td><img src="https://via.placeholder.com/40" class="rounded-circle" alt="Profile"></td>
              <td>Rakib Hasan</td>
              <td>rakib@example.com</td>
              <td>+8801711111111</td>
              <td>EMP-002</td>
              <td>Sales</td>
              <td>Sales Executive</td>
              <td><span class="badge bg-secondary">Staff</span></td>
              <td><span class="badge bg-danger">Inactive</span></td>
              <td>2025-02-01</td>
              <td>
                <a href="#" class="btn btn-sm btn-info"><i class="fa-solid fa-eye"></i></a>
                <a href="#" class="btn btn-sm btn-warning"><i class="fa-solid fa-pen"></i></a>
                <a href="#" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

@endsection
