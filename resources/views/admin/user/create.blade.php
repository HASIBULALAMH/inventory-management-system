@extends('admin.master')

@section('content')
<style>
  .form-card {
    border: 0;
    border-radius: 1rem;
    box-shadow: 0 10px 25px rgba(0,0,0,.07);
    overflow: hidden;
  }
  .form-card .card-header {
    background: linear-gradient(135deg, #6f42c1, #20c997);
    color: #fff;
    padding: 1rem 1.25rem;
  }
  .form-section-title {
    font-size: .9rem;
    font-weight: 600;
    color: #6f42c1;
    text-transform: uppercase;
    margin-bottom: .75rem;
  }
  .form-control:focus, .form-select:focus {
    box-shadow: 0 0 0 0.2rem rgba(111,66,193,.25);
    border-color: #6f42c1;
  }
  .btn-gradient {
    background: linear-gradient(135deg, #20c997, #6f42c1);
    color: #fff;
    border: none;
  }
  .btn-gradient:hover {
    opacity: .9;
  }
  .image-preview {
    width: 120px;
    height: 120px;
    border: 2px dashed #ccc;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    background: #f8f9fa;
  }
  .image-preview img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
</style>

<div class="container my-4">
  <div class="card form-card">
    <div class="card-header d-flex align-items-center justify-content-between">
      <h5 class="mb-0"><i class="fa-solid fa-user-plus me-2"></i>Create User</h5>
      <a href="{{ route('admin.users.list') }}" class="btn btn-light btn-sm">
        <i class="fa-solid fa-arrow-left me-1"></i> Back
      </a>
    </div>

    <div class="card-body">
      <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- 🔹 Personal Info -->
        <div class="mb-4">
          <div class="form-section-title">Personal Information</div>
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Full Name <span class="text-danger">*</span></label>
              <input type="text" name="name" class="form-control" placeholder="Enter full name" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Email <span class="text-danger">*</span></label>
              <input type="email" name="email" class="form-control" placeholder="Enter email address" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Password <span class="text-danger">*</span></label>
              <input type="password" name="password" class="form-control" placeholder="Enter password" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Confirm Password <span class="text-danger">*</span></label>
              <input type="password" name="password_confirmation" class="form-control" placeholder="Re-enter password" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Date of Birth</label>
              <input type="date" name="dob" class="form-control">
            </div>
            <div class="col-md-6">
              <label class="form-label">Contact Number</label>
              <input type="text" name="phone" class="form-control" placeholder="Enter phone number">
            </div>
            <div class="col-md-12">
              <label class="form-label">Present Address</label>
              <textarea name="present_address" class="form-control" rows="2" placeholder="Enter present address"></textarea>
            </div>
          </div>
        </div>

        <!-- 🔹 Professional Info -->
        <div class="mb-4">
          <div class="form-section-title">Professional Information</div>
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Job Title</label>
              <input type="text" name="job_title" class="form-control" placeholder="e.g. Software Engineer">
            </div>
            <div class="col-md-6">
              <label class="form-label">Department</label>
              <input type="text" name="department" class="form-control" placeholder="e.g. IT, HR, Marketing">
            </div>
            <div class="col-md-6">
              <label class="form-label">Years of Experience</label>
              <input type="number" name="experience" class="form-control" placeholder="e.g. 5">
            </div>
          </div>
        </div>

        <!-- 🔹 Profile Image -->
        <div class="mb-4">
          <div class="form-section-title">Profile Picture</div>
          <div class="row g-3 align-items-center">
            <div class="col-md-3 text-center">
              <div class="image-preview" id="imagePreview">
                <span class="text-muted">No Image</span>
              </div>
            </div>
            <div class="col-md-9">
              <label class="form-label">Upload Profile Picture</label>
              <input type="file" name="image" class="form-control" accept="image/*" onchange="previewImage(event)">
            </div>
          </div>
        </div>

        <!-- 🔹 Role & Status -->
        <div class="mb-4">
          <div class="form-section-title">Role & Status</div>
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Assign Role <span class="text-danger">*</span></label>
              <select name="role" class="form-select" required>
                <option value="">Select Role</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Status <span class="text-danger">*</span></label>
              <select name="status" class="form-select" required>
                <option value="active" selected>Active</option>
                <option value="inactive">Inactive</option>
              </select>
            </div>
          </div>
        </div>

        <!-- 🔹 Action Buttons -->
        <div class="d-flex justify-content-end gap-2">
          <button type="reset" class="btn btn-secondary">Reset</button>
          <button type="submit" class="btn btn-gradient">
            <i class="fa-solid fa-floppy-disk me-1"></i> Save User
          </button>
        </div>

      </form>
    </div>
  </div>
</div>

<script>
  function previewImage(event) {
    const preview = document.getElementById('imagePreview');
    preview.innerHTML = '';
    const img = document.createElement('img');
    img.src = URL.createObjectURL(event.target.files[0]);
    preview.appendChild(img);
  }
</script>
@endsection
