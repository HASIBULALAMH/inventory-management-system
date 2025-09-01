@extends('admin.master')

@section('content')

<style>
  .user-card {
    border: 0;
    border-radius: 1rem;
    box-shadow: 0 10px 25px rgba(0,0,0,.06);
    overflow: hidden;
  }
  .user-card .card-header {
    background: linear-gradient(135deg, #20c997, #6f42c1);
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
  .filter-box input:focus, .filter-box select:focus {
    box-shadow: 0 0 0 0.2rem rgba(111,66,193,.25);
    border-color: #6f42c1;
  }
</style>

<div class="container my-4">
  <div class="card user-card">
    <div class="card-header d-flex flex-wrap align-items-center justify-content-between gap-2">
      <h5 class="mb-0"><i class="fa-solid fa-users me-2"></i>User Management</h5>
      <a href="{{ route('admin.users.create') }}" class="btn btn-light btn-sm">
        <i class="fa-solid fa-user-plus me-1"></i>Create User
      </a>
    </div>

    <!-- 🔍 Search & Filter -->
    <div class="p-3 filter-box d-flex flex-wrap gap-2 align-items-center justify-content-between">
      <div class="d-flex gap-2">
        <input type="text" id="searchInput" class="form-control form-control-sm" placeholder="Search by name or email" value="{{ request('search') }}">
        <select id="statusFilter" class="form-select form-select-sm" style="width:150px;" value="{{ request('filter') }}">
          <option value=" ">All Status</option>
          <option value="active">Active</option>
          <option value="inactive">Inactive</option>
        </select>
      </div>
    </div>

    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table align-middle table-hover mb-0" id="userTable">
          <thead>
            <tr>
              <th style="width: 80px;">ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Role</th>
              <th style="width: 160px;">Status</th>
              <th style="width: 160px;" class="text-end">Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($users as $user)
            <tr>
              <td>{{ $user->id }}</td>
              <td>{{ $user->name }}</td>
              <td>{{ $user->email }}</td>
              <td>{{ $user->roles->first() ? $user->roles->first()->name : 'N/A' }}</td>
              <td> 
                @if ($user->status == 'active')
                <span class="status-dot dot-active"></span>
                <span class="badge text-bg-success">Active</span>
                @elseif ($user->status == 'inactive')
                <span class="status-dot dot-inactive"></span>
                <span class="badge text-bg-danger">Inactive</span>
                @endif
              </td>
              <td class="text-end">
               <div class="d-flex gap-2 justify-content-end">
               <a href="#" class="btn btn-outline-primary btn-sm rounded-circle" data-bs-toggle="tooltip" data-bs-title="View" style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center;">
                 <i class="fa-regular fa-eye"></i>
               </a>
                 <a href="" class="btn btn-outline-primary btn-sm rounded-circle" data-bs-toggle="tooltip" data-bs-title="Edit" style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center;">
                   <i class="fa-regular fa-pen-to-square"></i>
                 </a>
                 <form action="" method="POST" class="d-inline">
                   @csrf
                   @method('DELETE')
                   <button type="submit" class="btn btn-outline-danger rounded-circle" data-bs-toggle="tooltip" data-bs-title="Delete" onclick="return confirm('Are you sure you want to delete this role?')">
                     <i class="fa-regular fa-trash-can"></i>
                   </button>
                 </form>
               </div>
             </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      <!-- Footer -->
      <div class="p-3 d-flex justify-content-between align-items-center">
        <small class="text-muted">Showing <strong>{{ $users->total() }}</strong> users</small>
        <nav>
          <ul class="pagination pagination-sm mb-0">
            {{ $users->links() }}
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

  // 🔍 Search & Filter Logic
  const searchInput = document.getElementById('searchInput');
  const statusFilter = document.getElementById('statusFilter');
  const rows = document.querySelectorAll('#userTable tbody tr');

  function filterTable() {
    const searchText = searchInput.value.toLowerCase();
    const status = statusFilter.value;

    rows.forEach(row => {
      const name = row.cells[1].innerText.toLowerCase();
      const email = row.cells[2].innerText.toLowerCase();
      const role = row.cells[3].innerText.toLowerCase();
      const statusText = row.cells[4].innerText.toLowerCase();

      const matchesSearch = name.includes(searchText) || email.includes(searchText) || role.includes(searchText);
      const matchesStatus = !status || statusText.includes(status);

      if (matchesSearch && matchesStatus) {
        row.style.display = '';
      } else {
        row.style.display = 'none';
      }
    });
  }

  searchInput.addEventListener('input', filterTable);
  statusFilter.addEventListener('change', filterTable);
</script>
@endsection
