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

{{-- AJAX Script --}}
<script>
document.addEventListener("DOMContentLoaded", function() {

  // Auto code & slug
  const nameInput = document.getElementById("warehouse_name");
  nameInput.addEventListener("input", function() {
    let name = this.value.trim();
    document.getElementById("warehouse_code").value = name.toUpperCase().replace(/\s+/g,'_').substring(0,10);
    document.getElementById("warehouse_slug").value = name.toLowerCase().replace(/\s+/g,'-');
  });

  // Country -> State
  document.getElementById("country").addEventListener("change", function() {
      let countryId = this.value;
      let stateSelect = document.getElementById("state");
      let citySelect  = document.getElementById("city");
      stateSelect.innerHTML = '<option value="">-- Select State --</option>';
      citySelect.innerHTML = '<option value="">-- Select City --</option>';
      document.getElementById("zipcode").value = '';
      
      if(countryId) {
          fetch(`/admin/warehouse/get-states/${countryId}`)
          .then(res => res.json())
          .then(data => {
              data.forEach(state => {
                  stateSelect.innerHTML += `<option value="${state.id}">${state.name}</option>`;
              });
          })
          .catch(err => console.error('Error fetching states:', err));
      }
  });


  // State -> City
  document.getElementById("state").addEventListener("change", function() {
      let stateId = this.value;
      let citySelect = document.getElementById("city");
      citySelect.innerHTML = '<option value="">-- Select City --</option>';
      document.getElementById("zipcode").value = '';
      
      if(stateId) {
          fetch(`/admin/warehouse/get-cities/${stateId}`)
          .then(res => res.json())
          .then(data => {
              data.forEach(city => {
                  citySelect.innerHTML += `<option value="${city.id}" data-zipcode="${city.zip_code || ''}">${city.name}</option>`;
              });
          })
          .catch(err => console.error('Error fetching cities:', err));
      }
  });

  // City -> Zipcode
  document.getElementById("city").addEventListener("change", function() {
      let selected = this.options[this.selectedIndex];
      let zipcode = selected.getAttribute("data-zipcode") || '';
      document.getElementById("zipcode").value = zipcode;
  });

  // Manager -> details
  document.getElementById("manager").addEventListener("change", function() {
      let managerId = this.value;
      if(managerId) {
          fetch(`/admin/warehouse/get-manager/${managerId}`)
          .then(res => res.json())
          .then(data => {
              document.getElementById("manager_email").value = data.email || '';
              document.getElementById("manager_phone").value = data.phone || '';
          })
          .catch(err => {
              console.error('Error fetching manager details:', err);
              document.getElementById("manager_email").value = '';
              document.getElementById("manager_phone").value = '';
          });
      } else {
          document.getElementById("manager_email").value = '';
          document.getElementById("manager_phone").value = '';
      }
  });
});
</script>

@endsection
