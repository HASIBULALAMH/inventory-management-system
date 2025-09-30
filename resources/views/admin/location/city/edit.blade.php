@extends('layout.master')

@section('content')

<style>
  .form-card {
    border: 0;
    border-radius: .75rem;
    box-shadow: 0 8px 20px rgba(0, 0, 0, .08);
    overflow: hidden;
  }

  .form-card .card-header {
    background: linear-gradient(135deg, #20c997, #6f42c1);
    color: #fff;
    padding: 1rem 1.25rem;
    font-weight: 600;
    font-size: 1.1rem;
  }

  .form-label.required::after {
    content: " *";
    color: red;
    font-weight: bold;
  }

  .form-control:focus,
  .form-select:focus {
    box-shadow: 0 0 0 0.2rem rgba(111, 66, 193, 0.25);
    border-color: #6f42c1;
  }

  .section-title {
    font-weight: 600;
    font-size: 1rem;
    margin: 1.2rem 0 .6rem;
    color: #6f42c1;
    border-bottom: 1px solid #eee;
    padding-bottom: .3rem;
  }
</style>

<div class="container-fluid px-4">
  <h4 class="mt-4 mb-4">Create Warehouse</h4>

  <div class="card mb-4">
    <div class="card-header bg-primary text-white">
      <i class="bi bi-box-seam"></i> Warehouse Information
    </div>
    <div class="card-body">
      <form action="{{ route('admin.warehouse.store') }}" method="POST">
        @csrf

        <div class="row mb-3">
          <div class="col-md-4">
            <label class="form-label">Name <span class="text-danger">*</span></label>
            <input type="text" id="warehouse_name" name="name" class="form-control" required>
          </div>
          <div class="col-md-4">
            <label class="form-label">Code</label>
            <input type="text" id="warehouse_code" name="code" class="form-control" readonly>
          </div>
          <div class="col-md-4">
            <label class="form-label">Slug</label>
            <input type="text" id="warehouse_slug" name="slug" class="form-control" readonly>
          </div>
        </div>

        <h6 class="mb-3 text-primary">📍 Location</h6>
        <div class="row mb-3">
          <div class="col-md-4">
            <label class="form-label">Country <span class="text-danger">*</span></label>
            <select id="country" name="country_id" class="form-select" required>
              <option value="">-- Select Country --</option>
              @foreach($countries as $country)
              <option value="{{ $country->id }}">{{ $country->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-4">
            <label class="form-label">State <span class="text-danger">*</span></label>
            <select id="state" name="state_id" class="form-select" required>
              <option value="">-- Select State --</option>
            </select>
          </div>
          <div class="col-md-4">
            <label class="form-label">City <span class="text-danger">*</span></label>
            <select id="city" name="city_id" class="form-select" required>
              <option value="">-- Select City --</option>
            </select>
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-md-4">
            <label class="form-label">Zipcode</label>
            <input type="text" id="zipcode" name="zipcode" class="form-control" readonly>
          </div>
        </div>

        <h6 class="mb-3 text-primary">👨‍💼 Manager Info</h6>
        <div class="row mb-3">
          <div class="col-md-4">
            <label class="form-label">Select Manager <span class="text-danger">*</span></label>
            <select id="manager" name="manager_id" class="form-select" required>
              <option value="">-- Select User --</option>
              @foreach($users as $user)
              <option value="{{ $user->id }}">{{ $user->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-4">
            <label class="form-label">Email</label>
            <input type="text" id="manager_email" class="form-control" readonly>
          </div>
          <div class="col-md-4">
            <label class="form-label">Phone</label>
            <input type="text" id="manager_phone" class="form-control" readonly>
          </div>
        </div>

        <h6 class="mb-3 text-primary">⚙️ Extra Details</h6>
        <div class="row mb-3">
          <div class="col-md-4">
            <label class="form-label">Capacity <span class="text-danger">*</span></label>
            <input type="number" name="capacity" class="form-control" required>
          </div>
          <div class="col-md-4">
            <label class="form-label">Starting Date <span class="text-danger">*</span></label>
            <input type="date" name="starting_date" class="form-control" required>
          </div>
          <div class="col-md-4">
            <label class="form-label">Status <span class="text-danger">*</span></label>
            <select name="status" class="form-select" required>
              <option value="active">Active</option>
              <option value="inactive">Inactive</option>
            </select>
          </div>
        </div>

        <div class="text-end">
          <button type="submit" class="btn btn-success px-4">
            <i class="bi bi-save"></i> Save Warehouse
          </button>
        </div>
      </form>
    </div>
  </div>
</div>


<!-- JavaScript for auto-generating code and slug -->
<script>
  document.getElementById("cityName").addEventListener("input", function() {
    let name = this.value.trim();
    if (name.length > 0) {
      document.getElementById("cityCode").value = name.replace(/\s+/g, '').substring(0, 3).toUpperCase();
      document.getElementById("citySlug").value = name.toLowerCase().replace(/\s+/g, '-');
    }
  });
</script>

@endsection