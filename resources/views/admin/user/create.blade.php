@extends('admin.master')

@section('content')

<style>
  .form-card {
    border: 0;
    border-radius: 1rem;
    box-shadow: 0 8px 25px rgba(0, 0, 0, .07);
    overflow: hidden;
  }

  .form-card .card-header {
    background: linear-gradient(135deg, #6f42c1, #20c997);
    color: #fff;
    padding: 1rem 1.25rem;
  }

  .form-control,
  .form-select {
    border-radius: .6rem;
    padding: .55rem .9rem;
  }

  .btn-gradient {
    background: linear-gradient(135deg, #6f42c1, #20c997);
    color: #fff;
    border: none;
    border-radius: .6rem;
    padding: .55rem 1.2rem;
    transition: 0.3s;
  }

  .btn-gradient:hover {
    opacity: .9;
  }
</style>

<div class="container my-4">
  <div class="card user-card">
    <div class="card-header d-flex align-items-center justify-content-between">
      <h5 class="mb-0"><i class="fa-solid fa-users me-2"></i>User Create</h5>
      <a href="{{ route('admin.users.list') }}" class="btn btn-light btn-sm"><i class="fa-solid fa-plus me-1"></i>User List</a>
    </div>

    <div class="card-body">
      <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Basic Personal Information -->
        <h6 class="mb-3 text-primary"><i class="fa-solid fa-user me-2"></i>Basic Personal Information</h6>
        <div class="row g-3">
          <!-- Full Name -->
          <div class="col-md-6">
            <label class="form-label">Full Name <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control" placeholder="Enter full name">
          </div>
          <!-- Email -->
          <div class="col-md-6">
            <label class="form-label">Email Address <span class="text-danger">*</span></label>
            <input type="email" name="email" class="form-control" placeholder="example@email.com">
          </div>
          <!-- Phone -->
          <div class="col-md-6">
            <label class="form-label">Phone Number</label>
            <input type="text" name="phone" class="form-control" placeholder="+8801XXXXXXXXX">
          </div>
          <!-- Profile Photo -->
          <div class="col-md-6">
            <label class="form-label">Profile Photo</label>
            <input type="file" name="profile_photo" class="form-control">
          </div>
          <!-- Password -->
          <div class="col-md-6">
            <label class="form-label">Password <span class="text-danger">*</span></label>
            <input type="password" name="password" class="form-control" placeholder="Enter password">
          </div>
          <!-- Confirm Password -->
          <div class="col-md-6">
            <label class="form-label">Confirm Password <span class="text-danger">*</span></label>
            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm password">
          </div>
          <!-- Gender -->
          <div class="col-md-4">
            <label class="form-label">Gender</label>
            <select name="gender" class="form-select">
              <option value="">Select gender</option>
              <option value="male">Male</option>
              <option value="female">Female</option>
            </select>
          </div>
          <!-- Date of Birth -->
          <div class="col-md-4">
            <label class="form-label">Date of Birth</label>
            <input type="date" name="dob" class="form-control">
          </div>
          <!-- Present Address -->
          <div class="col-md-12">
            <label class="form-label">Present Address</label>
            <textarea name="present_address" class="form-control" rows="2"></textarea>
          </div>
          <!-- Permanent Address -->
          <div class="col-md-12">
            <label class="form-label">Permanent Address</label>
            <textarea name="permanent_address" class="form-control" rows="2"></textarea>
          </div>
        </div>

        <hr class="my-4">

        <!-- Professional / System Information -->
        <h6 class="mb-3 text-primary"><i class="fa-solid fa-briefcase me-2"></i>Professional / System Information</h6>
        <div class="row g-3">
          <!-- Auto Employee ID -->
          <div class="col-md-6">
            <label class="form-label">Employee ID (Auto)</label>
            <input type="text" name="employee_id" id="employeeId" class="form-control" readonly>
          </div>
          <!-- Department -->
          <div class="col-md-6">
            <label class="form-label">Department</label>
            <select name="department_id" id="department" class="form-select" onchange="generateEmployeeId()">
              <option value="">Select Department</option>
              @foreach($departments as $department)
              <option value="{{ $department->id }}">{{ $department->name }}</option>
              @endforeach
            </select>
          </div>
          <!-- Designation -->
          <div class="col-md-6">
            <label class="form-label">Designation</label>
            <select name="designation_id" id="designation" class="form-select" onchange="generateEmployeeId()">
              <option value="">Select Designation</option>
              @foreach($designations as $designation)
              <option value="{{ $designation->id }}">{{ $designation->name }}</option>
              @endforeach
            </select>
          </div>
          <!-- Role -->
          <div class="col-md-6">
            <label class="form-label">Role</label>
            <select name="role" id="role" class="form-select" onchange="generateEmployeeId()">
              <option value="">Select Role</option>
              @foreach($roles as $role)
              <option value="{{ $role->id }}">{{ $role->name }}</option>
              @endforeach
            </select>
          </div>
          <!-- Join Date -->
          <div class="col-md-6">
            <label class="form-label">Join Date</label>
            <input type="date" name="join_date" class="form-control">
          </div>
        </div>
        <!-- Status -->
        <div class="col-md-6">
          <label class="form-label">Status <span class="text-danger">*</span></label>
          <select name="status" class="form-select">
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
          </select>
        </div>

        <div class="mt-4 d-flex justify-content-end">
          <button type="submit" class="btn btn-gradient"><i class="fa-solid fa-floppy-disk me-1"></i>Save User</button>
        </div>

      </form>
    </div>
  </div>
</div>

<script>
  // Auto Generate Employee ID
  function generateEmployeeId() {
    const name = document.querySelector('input[name="name"]').value || 'USR';
    const deptSelect = document.getElementById('department');
    const desigSelect = document.getElementById('designation');
    const roleSelect = document.getElementById('role');

    // Get the text of selected options
    const dept = deptSelect.options[deptSelect.selectedIndex]?.text || 'DEPT';
    const desig = desigSelect.options[desigSelect.selectedIndex]?.text || 'DESIG';
    const role = roleSelect.options[roleSelect.selectedIndex]?.text || 'ROLE';

    // Format: First 3 letters of name, department, designation, and role in uppercase, separated by hyphens
    const empId = [
      name.substring(0, 3).toUpperCase(),
      dept.substring(0, 3).toUpperCase(),
      desig.substring(0, 3).toUpperCase(),
      role.substring(0, 3).toUpperCase(),
      Math.floor(1000 + Math.random() * 9000) // Add a random 4-digit number for uniqueness
    ].join('');

    document.getElementById('employeeId').value = empId;
  }

  // Add event listeners
  document.addEventListener('DOMContentLoaded', function() {
    // Generate ID when name changes
    document.querySelector('input[name="name"]').addEventListener('input', generateEmployeeId);

    // Initial generation
    generateEmployeeId();
  });
</script>

@endsection