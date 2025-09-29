@extends('layout.master')

@section('content')

<style>
  .warehouse-form-card {
    border: 0;
    border-radius: 1rem;
    box-shadow: 0 10px 25px rgba(0, 0, 0, .06);
    overflow: hidden;
  }

  .warehouse-form-card .card-header {
    background: linear-gradient(135deg, #20c997, #6f42c1);
    color: #fff;
    padding: 1rem 1.25rem;
  }

  .form-label {
    font-weight: 500;
    color: #495057;
  }

  .form-control,
  .form-select {
    border-radius: .6rem;
    padding: .6rem .9rem;
  }

  .btn-gradient {
    background: linear-gradient(135deg, #20c997, #6f42c1);
    border: 0;
    color: #fff;
    border-radius: .6rem;
    transition: all .3s ease;
  }

  .btn-gradient:hover {
    opacity: .9;
    transform: translateY(-2px);
  }
</style>

<div class="container my-4">
  <div class="card warehouse-form-card">
    <div class="card-header d-flex align-items-center justify-content-between">
      <h5 class="mb-0"><i class="fa-solid fa-plus-circle me-2"></i>Create Warehouse</h5>
      <a href="#" class="btn btn-light btn-sm"><i class="fa-solid fa-list me-1"></i>Warehouse List</a>
    </div>

    <div class="card-body">
      <form action="#" method="POST">
        @csrf
        <div class="row g-3">

          <!-- Warehouse Name -->
          <div class="col-md-6">
            <label class="form-label">Warehouse Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="warehouseName" name="name" placeholder="Enter Warehouse Name" required>
          </div>

          <!-- Warehouse Code (auto generate from name) -->
          <div class="col-md-6">
            <label class="form-label">Warehouse Code / ID <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="warehouseCode" name="code" placeholder="Auto generated" readonly>
          </div>

          <!-- Location / Address -->
          <div class="col-md-12">
            <label class="form-label">Location / Address <span class="text-danger">*</span></label>
            <textarea class="form-control" name="address" rows="2" placeholder="Street, City, Zip" required></textarea>
          </div>

          <!-- Country / State / City -->
          <div class="col-md-4">
            <label class="form-label">Country</label>
            <input type="text" class="form-control" name="country" placeholder="Enter Country">
          </div>
          <div class="col-md-4">
            <label class="form-label">State</label>
            <input type="text" class="form-control" name="state" placeholder="Enter State">
          </div>
          <div class="col-md-4">
            <label class="form-label">City</label>
            <input type="text" class="form-control" name="city" placeholder="Enter City">
          </div>

          <!-- Contact Person -->
          <div class="col-md-6">
            <label class="form-label">Contact Person</label>
            <input type="text" class="form-control" name="contact_person" placeholder="Enter Contact Person">
          </div>

          <!-- Phone -->
          <div class="col-md-3">
            <label class="form-label">Phone</label>
            <input type="text" class="form-control" name="phone" placeholder="Enter Phone Number">
          </div>

          <!-- Email -->
          <div class="col-md-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" name="email" placeholder="Enter Email">
          </div>

          <!-- Status -->
          <div class="col-md-4">
            <label class="form-label">Status <span class="text-danger">*</span></label>
            <select class="form-select" name="status" required>
              <option value="1">Active</option>
              <option value="0">Inactive</option>
            </select>
          </div>

          <!-- Capacity -->
          <div class="col-md-4">
            <label class="form-label">Capacity</label>
            <input type="text" class="form-control" name="capacity" placeholder="Enter Capacity (e.g., 5000 units)">
          </div>

          <!-- Warehouse Type -->
          <div class="col-md-4">
            <label class="form-label">Warehouse Type</label>
            <select class="form-select" name="type">
              <option value="">Select Type</option>
              <option>Main</option>
              <option>Regional</option>
              <option>Cold Storage</option>
              <option>Raw Materials</option>
              <option>Finished Goods</option>
            </select>
          </div>

          <!-- Operating Hours -->
          <div class="col-md-6">
            <label class="form-label">Operating Hours</label>
            <input type="text" class="form-control" name="operating_hours" placeholder="e.g., 9 AM - 6 PM">
          </div>

          <!-- Linked Departments -->
          <div class="col-md-6">
            <label class="form-label">Linked Departments</label>
            <select class="form-select" name="departments[]" multiple>
              <option>Sales</option>
              <option>Production</option>
              <option>Accounts</option>
              <option>Logistics</option>
            </select>
          </div>

          <!-- Inventory System ID -->
          <div class="col-md-6">
            <label class="form-label">Inventory System ID</label>
            <input type="text" class="form-control" name="inventory_id" placeholder="Optional Integration ID">
          </div>

          <!-- Supervisor / Manager -->
          <div class="col-md-6">
            <label class="form-label">Supervisor / Manager</label>
            <select class="form-select" name="supervisor_id">
              <option value="">Select Supervisor</option>
              <option value="1">John Doe</option>
              <option value="2">Jane Smith</option>
              <option value="3">Michael Brown</option>
            </select>
          </div>

          <!-- Notes / Description -->
          <div class="col-md-12">
            <label class="form-label">Notes / Description</label>
            <textarea class="form-control" name="notes" rows="2" placeholder="Extra warehouse details"></textarea>
          </div>

          <!-- Action Buttons -->
          <div class="col-12 d-flex justify-content-end gap-2 mt-3">
            <button type="reset" class="btn btn-outline-secondary"><i class="fa-solid fa-rotate-left me-1"></i>Reset</button>
            <button type="submit" class="btn btn-gradient"><i class="fa-solid fa-save me-1"></i>Save Warehouse</button>
          </div>

        </div>
      </form>
    </div>
  </div>
</div>

<!-- Auto-generate Warehouse Code -->
<script>
  document.getElementById('warehouseName').addEventListener('input', function() {
    let code = this.value.trim().toUpperCase().replace(/\s+/g, '_');
    document.getElementById('warehouseCode').value = code.substring(0, 10);
  });
</script>

@endsection