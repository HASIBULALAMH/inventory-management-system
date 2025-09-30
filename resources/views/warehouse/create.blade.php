@extends('layout.master')

@section('content')

<style>
  .form-card {
    border: 0;
    border-radius: 1rem;
    box-shadow: 0 10px 25px rgba(0,0,0,.07);
    overflow: hidden;
  }
  .form-card .card-header {
    background: linear-gradient(135deg, #20c997, #6f42c1);
    color: #fff;
    padding: 1rem 1.25rem;
  }
  .form-control:focus, .form-select:focus {
    box-shadow: 0 0 0 0.2rem rgba(32,201,151,.25);
    border-color: #20c997;
  }
  .required::after {
    content: " *";
    color: red;
    font-weight: bold;
  }
</style>

<div class="container my-4">
  <div class="card form-card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h5 class="mb-0"><i class="fa-solid fa-warehouse me-2"></i>Create Warehouse</h5>
      <a href="{{ route('admin.warehouse.list') }}" class="btn btn-light btn-sm">
        <i class="fa-solid fa-arrow-left me-1"></i> Back to List
      </a>
    </div>

    <form action="{{ route('admin.warehouse.store') }}" method="POST" class="p-4">
      @csrf
      <div class="row g-3">

        <!-- Name, Code, Slug -->
        <div class="col-md-4">
          <label class="form-label required">Warehouse Name</label>
          <input type="text" id="warehouse_name" name="name" class="form-control" required>
        </div>
        <div class="col-md-4">
          <label class="form-label required">Warehouse Code</label>
          <input type="text" id="warehouse_code" name="code" class="form-control" readonly required>
        </div>
        <div class="col-md-4">
          <label class="form-label">Slug</label>
          <input type="text" id="warehouse_slug" name="slug" class="form-control" readonly>
        </div>

        <!-- Country, State, City -->
        <div class="col-md-4">
          <label class="form-label required">Country</label>
          <select id="country" name="country_id" class="form-select" required>
            <option value="">-- Select Country --</option>
            @foreach($countries as $country)
              <option value="{{ $country->id }}">{{ $country->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="col-md-4">
          <label class="form-label required">State</label>
          <select id="state" name="state_id" class="form-select" required>
            <option value="">-- Select State --</option>
          </select>
        </div>
        <div class="col-md-4">
          <label class="form-label required">City</label>
          <select id="city" name="city_id" class="form-select" required>
            <option value="">-- Select City --</option>
          </select>
        </div>

        <!-- Zipcode -->
        <div class="col-md-4">
          <label class="form-label">Zipcode</label>
          <input type="text" id="zipcode" name="zipcode" class="form-control" readonly>
        </div>

        <!-- Manager/User -->
        <div class="col-md-4">
          <label class="form-label required">Supervisor</label>
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

        <!-- Capacity & Date & Status -->
        <div class="col-md-4">
          <label class="form-label required">Capacity</label>
          <input type="number" name="capacity" class="form-control" required>
        </div>
        <div class="col-md-4">
          <label class="form-label required">Opening Date</label>
          <input type="date" name="starting_date" class="form-control" required>
        </div>
        <div class="col-md-4">
          <label class="form-label required">Status</label>
          <select name="status" class="form-select" required>
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
          </select>
        </div>

      </div>

      <!-- Submit -->
      <div class="mt-4 d-flex gap-2">
        <button type="submit" class="btn btn-success px-4">
          <i class="fa-solid fa-floppy-disk me-1"></i> Save Warehouse
        </button>
        <a href="{{ route('admin.warehouse.list') }}" class="btn btn-secondary px-4">
          <i class="fa-solid fa-xmark me-1"></i> Cancel
        </a>
      </div>
    </form>
  </div>
</div>
<script src="{{ asset('assets/js/location.js') }}"></script>
<script src="{{ asset('assets/js/user.js') }}"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {

  // Auto code & slug
  const nameInput = document.getElementById("warehouse_name");
  nameInput.addEventListener("input", function() {
    let name = this.value.trim();
    document.getElementById("warehouse_code").value = name.toUpperCase().replace(/\s+/g,'_').substring(0,10);
    document.getElementById("warehouse_slug").value = name.toLowerCase().replace(/\s+/g,'-');
  });

});
</script>


@endsection
