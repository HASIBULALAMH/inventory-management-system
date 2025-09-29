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
      <h5 class="mb-0"><i class="fa-solid fa-map me-2"></i>Create State</h5>
      <!-- 🔙 Back to List Button -->
      <a href="{{ route('admin.locations.states.list') }}" class="btn btn-light btn-sm">
        <i class="fa-solid fa-arrow-left me-1"></i> Back to State List
      </a>
    </div>

    <form action="{{ route('admin.locations.states.store') }}" method="POST" class="p-4">
      @csrf
      <div class="row g-3">

        <!-- Country -->
        <div class="col-md-6">
          <label class="form-label required">Country</label>
          <select name="country_id" class="form-select" required>
            <option value="">-- Select Country --</option>
            @foreach($countries as $country)
              <option value="{{ $country->id }}">{{ $country->name }}</option>
            @endforeach
          </select>
        </div>

        <!-- State Name -->
        <div class="col-md-6">
          <label class="form-label required">State Name</label>
          <input type="text" id="stateName" name="name" class="form-control"
                 placeholder="Enter state name" required>
        </div>

        <!-- State Code -->
        <div class="col-md-4">
          <label class="form-label required">State Code (ISO)</label>
          <input type="text" id="stateCode" name="code" class="form-control text-uppercase"
                 maxlength="5" readonly required>
        </div>

        <!-- Slug -->
        <div class="col-md-4">
          <label class="form-label">Slug</label>
          <input type="text" id="stateSlug" name="slug" class="form-control" readonly>
        </div>

        <!-- Status -->
        <div class="col-md-4">
          <label class="form-label required">Status</label>
          <select name="status" class="form-select" required>
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
          </select>
        </div>

      </div>

      <!-- Submit + Cancel -->
      <div class="mt-4 d-flex gap-2">
        <button type="submit" class="btn btn-success px-4">
          <i class="fa-solid fa-floppy-disk me-1"></i> Save State
        </button>
        <a href="{{ route('admin.locations.states.list') }}" class="btn btn-secondary px-4">
          <i class="fa-solid fa-xmark me-1"></i> Cancel
        </a>
      </div>
    </form>
  </div>
</div>

<!-- 🔹 Auto Generate Code & Slug -->
<script>
  document.getElementById("stateName").addEventListener("input", function() {
    let name = this.value.trim();

    // Generate Code (ISO) → প্রথম 3 letter uppercase
    let code = name.replace(/\s+/g, '').substring(0, 3).toUpperCase();

    // Generate Slug → lowercase + hyphen
    let slug = name.toLowerCase().replace(/\s+/g, '-');

    document.getElementById("stateCode").value = code;
    document.getElementById("stateSlug").value = slug;
  });
</script>

@endsection
