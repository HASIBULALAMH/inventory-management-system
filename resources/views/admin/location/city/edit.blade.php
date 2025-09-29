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
      <h5 class="mb-0"><i class="fa-solid fa-city me-2"></i>Edit City</h5>
      <a href="{{ route('admin.locations.cities.list') }}" class="btn btn-light btn-sm">
        <i class="fa-solid fa-arrow-left me-1"></i> Back to City List
      </a>
    </div>

    <form action="{{ route('admin.locations.cities.update', $city->id) }}" method="POST" class="p-4">
      @csrf
      @method('PUT')

      @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <div class="row g-3">
        <!-- Country -->
        <div class="col-md-6">
          <label class="form-label required">Country</label>
          <select name="country_id" id="countrySelect" class="form-select" required>
            <option value="">-- Select Country --</option>
            @foreach($countries as $country)
              <option value="{{ $country->id }}" {{ old('country_id', $city->country_id) == $country->id ? 'selected' : '' }}>
                {{ $country->name }} ({{ $country->iso_code }})
              </option>
            @endforeach
          </select>
        </div>

        <!-- State -->
        <div class="col-md-6">
          <label class="form-label required">State / Division</label>
          <select name="state_id" id="stateSelect" class="form-select" required>
            <option value="">-- Select State --</option>
            @foreach($states as $state)
              <option value="{{ $state->id }}" {{ old('state_id', $city->state_id) == $state->id ? 'selected' : '' }}>
                {{ $state->name }}
              </option>
            @endforeach
          </select>
        </div>

        <!-- City Name -->
        <div class="col-md-6">
          <label class="form-label required">City Name</label>
          <input type="text" id="cityName" name="name" class="form-control"
                 placeholder="Enter city name" value="{{ old('name', $city->name) }}" required>
        </div>

        <!-- City Code -->
        <div class="col-md-3">
          <label class="form-label required">City Code (ISO)</label>
          <input type="text" id="cityCode" name="code" class="form-control text-uppercase"
                 maxlength="5" value="{{ old('code', $city->code) }}" required>
        </div>

        <!-- Slug -->
        <div class="col-md-3">
          <label class="form-label">Slug</label>
          <input type="text" id="citySlug" name="slug" class="form-control"
                 value="{{ old('slug', $city->slug) }}" readonly>
        </div>

        <!-- Zip Code -->
        <div class="col-md-3">
          <label class="form-label required"> Zip Code </label>
          <input type="text" id="zipCode" name="zip_code" class="form-control text-uppercase"
                 maxlength="5" value="{{ old('zip_code', $city->zip_code) }}" required>
        </div>

        <!-- Status -->
        <div class="col-md-4">
          <label class="form-label required">Status</label>
          <select name="status" class="form-select" required>
            <option value="active" {{ old('status', $city->status) == 'active' ? 'selected' : '' }}>Active</option>
            <option value="inactive" {{ old('status', $city->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
          </select>
        </div>
      </div>

      <!-- Submit + Cancel -->
      <div class="mt-4 d-flex gap-2">
        <button type="submit" class="btn btn-success px-4">
          <i class="fa-solid fa-floppy-disk me-1"></i> Update City
        </button>
        <a href="{{ route('admin.locations.cities.list') }}" class="btn btn-secondary px-4">
          <i class="fa-solid fa-xmark me-1"></i> Cancel
        </a>
      </div>
    </form>
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
