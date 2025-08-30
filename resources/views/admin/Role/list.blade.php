@extends('admin.master')

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
  .table thead th {
    font-weight: 600;
    letter-spacing: .3px;
    text-transform: uppercase;
    font-size: .8rem;
    background: #f8f9fa;
    border-bottom: 0;
  }
  .status-dot {
    width: .5rem; height: .5rem; display: inline-block; border-radius: 50%;
    margin-right: .4rem;
  }
  .dot-active { background: #28a745; }
  .dot-inactive { background: #6c757d; }
  .action-btns .btn {
    border-radius: 999px;
  }
  .table-hover tbody tr:hover {
    background: #fbfbff;
  }
</style>

<div class="container my-4">
  <div class="card role-card">
    <div class="card-header d-flex flex-wrap align-items-center justify-content-between gap-2">
      <h5 class="mb-0"><i class="fa-solid fa-user-shield me-2"></i>Role Management</h5>
      <!-- ✅ Only Create Role button -->
      <a href="{{ route('roles.create') }}" class="btn btn-light btn-sm">
        <i class="fa-solid fa-plus me-1"></i>Create Role
      </a>
    </div>

    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table align-middle table-hover mb-0">
          <thead>
            <tr>
              <th style="width: 80px;">ID</th>
              <th>Role Name</th>
              <th>ROles icon</th>
              <th style="width: 160px;">Status</th>
              <th style="width: 160px;" class="text-end">Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($roles as $role)
            <tr>
              <td>{{$role->id}}</td>
              <td>{{$role->name}}</td>
              <td>
                @if($role->icon)
                  <img src="{{ asset('/uploads/role/'.$role->icon) }}" width="50" height="50" class="img-fluid rounded" alt="{{ $role->name }}">
                @endif
              </td>
              <td> 
                @if ($role->status == 'active')
                <span class="status-dot dot-active"></span>
                <span class="badge bg-success">Active</span>
                @elseif ($role->status == 'inactive')
                <span class="status-dot dot-inactive"></span>
                <span class="badge bg-danger">Inactive</span>
                @endif
              </td>
              <td class="text-end action-btns">
                <button class="btn btn-outline-primary btn-sm" data-bs-toggle="tooltip" data-bs-title="Edit">
                  <i class="fa-regular fa-pen-to-square"></i>
                </button>
                <button class="btn btn-outline-danger btn-sm" data-bs-toggle="tooltip" data-bs-title="Delete">
                  <i class="fa-regular fa-trash-can"></i>
                </button>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      <!-- Footer -->
      <div class="p-3 d-flex justify-content-between align-items-center"> 
        <small class="text-muted">Showing <strong>2</strong> roles</small>
        <nav> {{ $roles->links() }}
          <ul class="pagination pagination-sm mb-0">
            <li class="page-item disabled"><span class="page-link">Prev</span></li>
            <li class="page-item active"><span class="page-link">1</span></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">Next</a></li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  // Enable tooltips
  document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(el => new bootstrap.Tooltip(el));
</script>
@endsection
