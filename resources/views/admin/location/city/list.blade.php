@extends('layout.master')

@section('content')

<style>
  .list-card {
    border: 0;
    border-radius: 1rem;
    box-shadow: 0 10px 25px rgba(0,0,0,.06);
    overflow: hidden;
  }
  .list-card .card-header {
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
</style>

<div class="container my-4">
  <div class="card list-card">
    <div class="card-header d-flex flex-wrap align-items-center justify-content-between gap-2">
      <h5 class="mb-0"><i class="fa-solid fa-city me-2"></i>City List</h5>
      <a href="{{ route('admin.locations.cities.create') }}" class="btn btn-light btn-sm">
        <i class="fa-solid fa-plus me-1"></i> Create City
      </a>
    </div>

    <div class="card-body">
      <!-- 🔎 Search & Filter -->
      <form method="GET" action="{{ route('admin.locations.cities.list') }}" class="row g-2 mb-3">
        <div class="col-md-3">
          <input type="text" name="search" class="form-control" placeholder="Search by name or code" value="{{ request('search') }}">
        </div>
        <div class="col-md-3">
          <select name="status" class="form-select">
            <option value="">-- Filter by Status --</option>
            <option value="active" {{ request('status')=='active' ? 'selected' : '' }}>Active</option>
            <option value="inactive" {{ request('status')=='inactive' ? 'selected' : '' }}>Inactive</option>
          </select>
        </div>
        <div class="col-md-2 d-grid">
          <button type="submit" class="btn btn-primary"><i class="fa-solid fa-search me-1"></i>Search</button>
        </div>
        <div class="col-md-2 d-grid">
          <a href="{{ route('admin.locations.cities.list') }}" class="btn btn-secondary"><i class="fa-solid fa-rotate-right me-1"></i>Reset</a>
        </div>
      </form>

      <!-- 🔹 Table -->
      <div class="table-responsive">
        <table class="table align-middle table-hover mb-0">
          <thead>
            <tr>
              <th style="width: 80px;">ID</th>
              <th>City Name</th>
              <th>Zip Code</th>
              <th>Code</th>
              <th>Slug</th>
              <th>Country</th>
              <th>State</th>
              <th>Status</th>
              <th style="width: 160px;" class="text-end">Actions</th>
            </tr>
          </thead>
          <tbody>
            @forelse($cities as $city)
              <tr>
                <td>#{{ $city->id }}</td>
                <td>{{ $city->name }}</td>
                <td>{{ $city->zip_code }}</td>
                <td>{{ $city->code }}</td>
                <td>{{ $city->slug }}</td>
                <td>{{ $city->country?->name }}</td>
                <td>{{ $city->state?->name }}</td>
                <td>
                  @if($city->status == 'active')
                    <span class="status-dot dot-active"></span>
                    <span class="badge text-bg-success">Active</span>
                  @else
                    <span class="status-dot dot-inactive"></span>
                    <span class="badge text-bg-secondary">Inactive</span>
                  @endif
                </td>
                <td class="text-end action-btns">
                  <a href="{{ route('admin.locations.cities.edit', $city->id) }}" class="btn btn-outline-primary btn-sm" data-bs-toggle="tooltip" title="Edit">
                    <i class="fa-regular fa-pen-to-square"></i>
                  </a>
                  <form action="{{ route('admin.locations.cities.delete', $city->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure to delete this city?')" data-bs-toggle="tooltip" title="Delete">
                      <i class="fa-regular fa-trash-can"></i>
                    </button>
                  </form>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="8" class="text-center text-muted">No cities found</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <!-- 🔹 Pagination -->
      <div class="p-3 d-flex justify-content-between align-items-center">
        <small class="text-muted">
          Showing {{ $cities->firstItem() }} - {{ $cities->lastItem() }} of {{ $cities->total() }} cities
        </small>
        {{ $cities->links('pagination::bootstrap-5') }}
      </div>
    </div>
  </div>
</div>

<!-- Tooltip JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(el => new bootstrap.Tooltip(el));
</script>

@endsection
