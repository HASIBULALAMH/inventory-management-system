@extends('layout.master')

@section('content')

<style>
  .form-card {
    border: 0;
    border-radius: 1rem;
    box-shadow: 0 10px 25px rgba(0, 0, 0, .07);
    overflow: visible;
  }
  .form-card .card-header {
    background: linear-gradient(135deg, #20c997, #6f42c1);
    color: #fff;
    padding: 1rem 1.25rem;
  }
  .form-control,
  .form-select {
    border-radius: .6rem;
    padding: .55rem .9rem;
  }
  .form-control:focus,
  .form-select:focus {
    box-shadow: 0 0 0 0.2rem rgba(32,201,151,.25);
    border-color: #20c997;
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
  .required::after {
    content: " *";
    color: red;
    font-weight: bold;
  }
</style>

<div class="container my-4">
  <div class="card form-card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h5 class="mb-0"><i class="fa-solid fa-user-plus me-2"></i>Create User</h5>
      <a href="{{ route('admin.users.list') }}" class="btn btn-light btn-sm">
        <i class="fa-solid fa-arrow-left me-1"></i> Back to User List
      </a>
    </div>

    <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data" class="p-4">
      @csrf

      @if ($errors->any())
        <div class="alert alert-danger">
          <ul class="mb-0">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <!-- Basic Personal Information -->
      <h6 class="mb-3 text-primary"><i class="fa-solid fa-user me-2"></i>Basic Personal Information</h6>
      <div class="row g-3">
        <!-- Full Name -->
        <div class="col-md-6">
          <label class="form-label required">Full Name</label>
          <input type="text" name="name" class="form-control" placeholder="Enter full name" required>
        </div>
        <!-- Email -->
        <div class="col-md-6">
          <label class="form-label required">Email Address</label>
          <input type="email" name="email" class="form-control" placeholder="example@email.com" required>
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
          <label class="form-label required">Password</label>
          <input type="password" name="password" class="form-control" placeholder="Enter password" required>
        </div>
        <!-- Confirm Password -->
        <div class="col-md-6">
          <label class="form-label required">Confirm Password</label>
          <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm password" required>
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
      <!-- nationnal id -->
        <div class="col-md-6">
          <label class="form-label">National ID</label>
          <input type="text" name="national_id" class="form-control">
        </div>
        <!-- Present Address -->
        <h6 class="mb-2 text-primary">Present Address</h6>
<div class="row g-3">
  <!-- Country -->
  <div class="col-md-3">
    <label class="form-label">Country</label>
    <select id="present_country" name="present_country_id" class="form-select">
      <option value="">-- Select Country --</option>
      @foreach($countries as $country)
        <option value="{{ $country->id }}">{{ $country->name }}</option>
      @endforeach
    </select>
  </div>
  <!-- State -->
  <div class="col-md-3">
    <label class="form-label">State</label>
    <select id="present_state" name="present_state_id" class="form-select"></select>
  </div>
  <!-- City -->
  <div class="col-md-3">
    <label class="form-label">City</label>
    <select id="present_city" name="present_city_id" class="form-select"></select>
  </div>
  <!-- Zipcode -->
  <div class="col-md-3">
    <label class="form-label">Zipcode</label>
    <input type="text" id="present_zipcode" name="present_zipcode" class="form-control" readonly>
  </div>
</div>

<div class="col-12 mb-2">
  <input type="checkbox" id="sameAsPresent" />
  <label for="sameAsPresent">Permanent Address same as Present Address</label>
</div>


<hr class="my-3">
<!-- Permanent Address -->
<h6 class="mb-2 text-primary">Permanent Address</h6>
<div class="row g-3">
  <!-- Country -->
  <div class="col-md-3">
    <label class="form-label">Country</label>
    <select id="permanent_country" name="permanent_country_id" class="form-select">
      <option value="">-- Select Country --</option>
      @foreach($countries as $country)
        <option value="{{ $country->id }}">{{ $country->name }}</option>
      @endforeach
    </select>
  </div>
  <!-- State -->
  <div class="col-md-3">
    <label class="form-label">State</label>
    <select id="permanent_state" name="permanent_state_id" class="form-select"></select>
  </div>
  <!-- City -->
  <div class="col-md-3">
    <label class="form-label">City</label>
    <select id="permanent_city" name="permanent_city_id" class="form-select"></select>
  </div>
  <!-- Zipcode -->
  <div class="col-md-3">
    <label class="form-label">Zipcode</label>
    <input type="text" id="permanent_zipcode" name="permanent_zipcode" class="form-control" readonly>
  </div>
</div>


      <hr class="my-4">

      <!-- Professional / System Information -->
      <h6 class="mb-3 text-primary"><i class="fa-solid fa-briefcase me-2"></i>Professional / System Information</h6>
      <div class="row g-3">
        <!-- Employee ID -->
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
          <select name="role_id" id="role" class="form-select" onchange="generateEmployeeId()">
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
        <!-- Status -->
        <div class="col-md-6">
          <label class="form-label required">Status</label>
          <select name="status" class="form-select" required>
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
          </select>
        </div>
      </div>

      <!-- Submit -->
      <div class="mt-4 d-flex gap-2">
        <button type="submit" class="btn btn-gradient px-4">
          <i class="fa-solid fa-floppy-disk me-1"></i> Save User
        </button>
        <a href="{{ route('admin.users.list') }}" class="btn btn-secondary px-4">
          <i class="fa-solid fa-xmark me-1"></i> Cancel
        </a>
      </div>
    </form>
  </div>
</div>


<script src="{{ asset('assets/js/location.js') }}"></script>
<script>initLocationSelector({
    countryId: 'present_country',
    stateId: 'present_state',
    cityId: 'present_city',
    zipcodeId: 'present_zipcode',
    baseUrl: '{{ url("admin/user") }}'
});

initLocationSelector({
    countryId: 'permanent_country',
    stateId: 'permanent_state',
    cityId: 'permanent_city',
    zipcodeId: 'permanent_zipcode',
    baseUrl: '{{ url("admin/user") }}'
});

enablePermanentAutofill(
    { countryId: 'present_country', stateId: 'present_state', cityId: 'present_city', zipcodeId: 'present_zipcode' },
    { countryId: 'permanent_country', stateId: 'permanent_state', cityId: 'permanent_city', zipcodeId: 'permanent_zipcode' },
    'sameAsPresent'
);

</script>
<!-- genarate employee id -->
<script>
  function generateEmployeeId() {
    const name = document.querySelector('input[name="name"]').value || 'USR';
    const deptSelect = document.getElementById('department');
    const desigSelect = document.getElementById('designation');
    const roleSelect = document.getElementById('role');

    const dept = deptSelect.options[deptSelect.selectedIndex]?.text || 'DEPT';
    const desig = desigSelect.options[desigSelect.selectedIndex]?.text || 'DESIG';
    const role = roleSelect.options[roleSelect.selectedIndex]?.text || 'ROLE';

    const empId = [
      name.substring(0, 3).toUpperCase(),
      dept.substring(0, 3).toUpperCase(),
      desig.substring(0, 3).toUpperCase(),
      role.substring(0, 3).toUpperCase(),
      Math.floor(1000 + Math.random() * 9000)
    ].join('-');

    document.getElementById('employeeId').value = empId;
  }

  document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('input[name="name"]').addEventListener('input', generateEmployeeId);
    generateEmployeeId();
  });
</script>

@endsection
