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
      <h5 class="mb-0"><i class="fa-solid fa-flag me-2"></i>Edit Country</h5>
      <!-- 🔙 Back to List Button -->
      <a href="{{ route('admin.locations.countries.list') }}" class="btn btn-light btn-sm">
        <i class="fa-solid fa-arrow-left me-1"></i> Back to Country List
      </a>
    </div>

    <form action="{{ route('admin.locations.countries.update', $country->id) }}" method="POST" class="p-4">
      @csrf
      @method('PUT')
      <div class="row g-3">

        <!-- Country Name -->
        <div class="col-md-6">
          <label class="form-label required">Country Name</label>
          <input type="text" id="countryName" name="name" 
                 class="form-control" 
                 value="{{ old('name', $country->name) }}" 
                 placeholder="Enter country name" required>
        </div>

        <!-- ISO Code (Auto Generate) -->
        <div class="col-md-3">
          <label class="form-label required">Country Code (ISO)</label>
          <input type="text" id="countryCode" name="code" 
                 class="form-control text-uppercase" maxlength="3" 
                 value="{{ old('code', $country->code) }}" readonly required>
        </div>

        <!-- Phone Code -->
        <div class="col-md-3">
          <label class="form-label required">Phone Code</label>
          <input type="text" name="phone_code" 
                 class="form-control" 
                 value="{{ old('phone_code', $country->phone_code) }}" 
                 placeholder="e.g. +880, +1, +91" required>
        </div>

        <!-- Status -->
        <div class="col-md-6">
          <label class="form-label required">Status</label>
          <select name="status" class="form-select" required>
            <option value="active" {{ old('status', $country->status) == 'active' ? 'selected' : '' }}>Active</option>
            <option value="inactive" {{ old('status', $country->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
          </select>
        </div>

      </div>

      <!-- Submit + Cancel -->
      <div class="mt-4 d-flex gap-2">
        <button type="submit" class="btn btn-success px-4">
          <i class="fa-solid fa-floppy-disk me-1"></i>Update Country
        </button>
        <a href="{{ route('admin.locations.countries.list') }}" class="btn btn-secondary px-4">
          <i class="fa-solid fa-xmark me-1"></i>Cancel
        </a>
      </div>
    </form>
  </div>
</div>

<!-- 🔹 Auto Generate ISO Code -->
<script>
  document.getElementById("countryName").addEventListener("input", function() {
    let name = this.value.trim().toUpperCase();
    let iso = "";

    if (name.includes(" ")) {
      iso = name.split(" ").map(word => word[0]).join("").substring(0,3);
    } else {
      iso = name.substring(0,3);
    }

    document.getElementById("countryCode").value = iso;
  });
</script>

@endsection
