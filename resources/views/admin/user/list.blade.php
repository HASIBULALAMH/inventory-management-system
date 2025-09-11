@extends('layout.master')

@section('content')

<style>
.user-card {
    border:0; 
    border-radius:1rem; 
    box-shadow:0 8px 25px rgba(0,0,0,.06); 
    overflow:hidden;
}
.user-card .card-header {
    background: linear-gradient(135deg, #6f42c1, #20c997); 
    color:#fff; 
    padding:1rem 1.25rem;
}
.form-control, .form-select { border-radius:.6rem; padding:.5rem .9rem; }
.table thead { background:#f8f9fa; }
.table th { font-weight:600; color:#495057; }
.badge { font-size:.75rem; padding:.45em .65em; border-radius:.4rem; }
.btn-icon { width:32px; height:32px; display:flex; align-items:center; justify-content:center; padding:0; }
.filter-box { margin-bottom:1rem; display:flex; flex-wrap:wrap; gap:.5rem; }
</style>

<div class="container my-4">
  <div class="card user-card">
    <div class="card-header d-flex align-items-center justify-content-between">
      <h5 class="mb-0"><i class="fas fa-users me-2"></i>User Management</h5>
      <a href="{{ route('admin.users.create') }}" class="btn btn-light btn-sm"><i class="fas fa-plus me-1"></i>Add User</a>
    </div>
    
    <div class="card-body">

      <!-- Search & Filter -->
      <form method="GET" action="{{ route('admin.users.list') }}" class="filter-box">
        <input type="text" name="search" class="form-control form-control-sm" placeholder="Search by name, email, phone..." value="{{ request('search') }}">
        <select class="form-select form-select-sm" name="role">
          <option value="">All Roles</option>
          @foreach($roles as $role)
            <option value="{{ $role->name }}" {{ request('role')==$role->name?'selected':'' }}>{{ $role->name }}</option>
          @endforeach
        </select>
        <select class="form-select form-select-sm" name="status">
          <option value="">All Status</option>
          <option value="active" {{ request('status')=='active'?'selected':'' }}>Active</option>
          <option value="inactive" {{ request('status')=='inactive'?'selected':'' }}>Inactive</option>
        </select>
        <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-filter me-1"></i>Filter</button>
      </form>

      <!-- User Table -->
      <div class="table-responsive">
        <table class="table table-hover align-middle">
          <thead>
            <tr>
              <th>#</th>
              <th>User</th>
              <th>Contact</th>
              <th>Department</th>
              <th>Designation</th>
              <th>Roles</th>
              <th>Status</th>
              <th class="text-end">Actions</th>
            </tr>
          </thead>
          <tbody>
            @forelse($users as $user)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>
                <div class="d-flex align-items-center">
                  <img src="{{ $user->profile_photo ? asset('uploads/profile_photos/'.$user->profile_photo) : asset('assets/img/avatars/default.png') }}" class="rounded-circle me-2" width="32" height="32">
                  <div>
                    <h6 class="mb-0">{{ $user->name }}</h6>
                    <small class="text-muted">ID: {{ $user->employee_id ?? 'N/A' }}</small>
                  </div>
                </div>
              </td>
              <td>
                <div>{{ $user->email }}</div>
                <small class="text-muted">{{ $user->phone ?? 'N/A' }}</small>
              </td>
              <td>{{ $user->department->name ?? 'N/A' }}</td>
              <td>{{ $user->designation->name ?? 'N/A' }}</td>
              <td>
                @forelse($user->roles as $role)
                  <span class="badge bg-info">{{ $role->name }}</span>
                @empty
                  N/A
                @endforelse
              </td>
              <td>
                @if($user->status=='active')
                  <span class="badge bg-success"><i class="fas fa-circle me-1"></i> Active</span>
                @else
                  <span class="badge bg-danger"><i class="fas fa-circle me-1"></i> Inactive</span>
                @endif
              </td>
              <td class="text-end">
                <div class="d-flex gap-2 justify-content-end">
                  <a href="#" class="btn btn-sm btn-icon btn-outline-primary rounded-circle" title="View"><i class="fas fa-eye"></i></a>
                  <a href="#" class="btn btn-sm btn-icon btn-outline-primary rounded-circle" title="Edit"><i class="fas fa-edit"></i></a>
                  <form action="#" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-icon btn-outline-danger rounded-circle" title="Delete"><i class="fas fa-trash"></i></button>
                  </form>
                </div>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="8" class="text-center py-4">
                <div class="text-muted">
                  <i class="fas fa-users fa-2x mb-3"></i>
                  <p>No users found</p>
                  <a href="{{ route('admin.users.create') }}" class="btn btn-primary mt-2"><i class="fas fa-plus me-1"></i>Add New User</a>
                </div>
              </td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <!-- Pagination -->
      <div class="d-flex justify-content-between align-items-center mt-3">
        <div class="text-muted">Showing {{ $users->firstItem() ?? 0 }} to {{ $users->lastItem() ?? 0 }} of {{ $users->total() ?? 0 }} entries</div>
        <nav>{{ $users->withQueryString()->links() }}</nav>
      </div>

    </div>
  </div>
</div>

@endsection
