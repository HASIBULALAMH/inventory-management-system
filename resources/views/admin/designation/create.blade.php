@extends('layout.master')

@section('content')

<style>
  .desig-form-card {
    border: 0;
    border-radius: 1rem;
    box-shadow: 0 10px 25px rgba(0,0,0,.06);
    overflow: hidden;
  }
  .desig-form-card .card-header {
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
  .code-preview {
    background-color: #f8f9fa;
    padding: 8px 12px;
    border-radius: 0.6rem;
    font-family: monospace;
    border: 1px solid #dee2e6;
  }
</style>

<div class="container my-4">
  <div class="card desig-form-card">
    <div class="card-header d-flex align-items-center justify-content-between">
      <h5 class="mb-0"><i class="fa-solid fa-plus-circle me-2"></i>Create Designation</h5>
      <a href="{{ route('admin.designations.list') }}" class="btn btn-light btn-sm"><i class="fa-solid fa-list me-1"></i>Designation List</a>
    </div>

    <div class="card-body">
      <form action="{{ route('admin.designations.store') }}" method="POST">
        @csrf
        <div class="row g-3">
          <!-- Designation Name -->
          <div class="col-md-6">
            <label for="name" class="form-label">Designation Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="name" name="name" required 
                   placeholder="Enter designation name" onkeyup="generateCode()">
            @error('name')
              <div class="text-danger small">{{ $message }}</div>
            @enderror
          </div>

          <!-- Auto-generated Code -->
          <div class="col-md-6">
            <label class="form-label">Designation Code</label>
            <div class="code-preview" id="codePreview">CODE_WILL_APPEAR_HERE</div>
            <input type="hidden" name="code" id="codeInput">
            <small class="text-muted">Code is auto-generated from the designation name</small>
          </div>

          <!-- Department -->
          <div class="col-md-6">
            <label for="department_id" class="form-label">Department <span class="text-danger">*</span></label>
            <select class="form-select" id="department_id" name="department_id" required>
              <option value="" selected disabled>Select Department</option>
              @foreach($departments as $department)
                <option value="{{ $department->id }}">{{ $department->name }}</option>
              @endforeach
            </select>
            @error('department_id')
              <div class="text-danger small">{{ $message }}</div>
            @enderror
          </div>

          <!-- Status -->
          <div class="col-md-6">
            <label class="form-label">Status <span class="text-danger">*</span></label>
            <select class="form-select" name="status" required>
              <option value="active">Active</option>
              <option value="inactive">Inactive</option>
            </select>
          </div>

          <!-- Submit Button -->
          <div class="col-12 mt-4">
            <button type="submit" class="btn btn-gradient px-4">
              <i class="fa-solid fa-save me-2"></i>Save Designation
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
function generateCode() {
    const nameInput = document.getElementById('name');
    const codePreview = document.getElementById('codePreview');
    const codeInput = document.getElementById('codeInput');
    
    if (nameInput.value.trim() === '') {
        codePreview.textContent = 'CODE_WILL_APPEAR_HERE';
        codeInput.value = '';
        return;
    }
    
    // Convert to uppercase, replace spaces with underscores, and remove special characters
    let code = nameInput.value
        .toUpperCase()
        .replace(/[^\w\s]/gi, '') // Remove special characters
        .replace(/\s+/g, '_')      // Replace spaces with underscores
        .replace(/_+/g, '_')        // Replace multiple underscores with single
        .replace(/^_+|_+$/g, '');   // Remove leading/trailing underscores
    
    // If code is empty after processing (e.g., only special characters were entered)
    if (code === '') {
        code = 'DESIGNATION';
    }
    
    codePreview.textContent = code;
    codeInput.value = code;
}
</script>

@endsection
