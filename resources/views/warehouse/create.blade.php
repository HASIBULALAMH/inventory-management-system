@extends('layout.master')

@section('content')

<style>
  .warehouse-form-card {
    border: 0;
    border-radius: 1rem;
    box-shadow: 0 10px 25px rgba(0,0,0,.06);
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
  .form-control, .form-select {
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
            <input type="text" class="form-control" name="name" placeholder="Enter Warehouse Name" required>
          </div>

          <!-- Location -->
          <div class="col-md-6">
            <label class="form-label">Location <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="location" placeholder="Enter Location" required>
          </div>

          <!-- Contact Person -->
          <div class="col-md-6">
            <label class="form-label">Contact Person</label>
            <input type="text" class="form-control" name="contact_person" placeholder="Optional Contact Person">
          </div>

          <!-- Phone -->
          <div class="col-md-6">
            <label class="form-label">Phone</label>
            <input type="text" class="form-control" name="phone" placeholder="Optional Phone Number">
          </div>

          <!-- Status -->
          <div class="col-md-6">
            <label class="form-label">Status <span class="text-danger">*</span></label>
            <select class="form-select" name="status" required>
              <option value="1">Active</option>
              <option value="0">Inactive</option>
            </select>
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

@endsection
