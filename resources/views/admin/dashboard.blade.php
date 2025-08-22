@extends('admin.master')

@section('content')
<div class="row g-4">
    <div class="col-md-3">
        <div class="card card-neumorphic text-white bg-gradient-primary shadow">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6>Total Products</h6>
                    <h3>250</h3>
                </div>
                <i class="bi bi-box-seam fs-1"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-neumorphic text-white bg-gradient-success shadow">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6>Total Orders</h6>
                    <h3>120</h3>
                </div>
                <i class="bi bi-bag-check-fill fs-1"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-neumorphic text-white bg-gradient-warning shadow">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6>Suppliers</h6>
                    <h3>50</h3>
                </div>
                <i class="bi bi-people-fill fs-1"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-neumorphic text-white bg-gradient-danger shadow">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6>Categories</h6>
                    <h3>30</h3>
                </div>
                <i class="bi bi-tags fs-1"></i>
            </div>
        </div>
    </div>
</div>

<!-- Charts -->
<div class="row g-4 mt-3">
    <div class="col-md-6">
        <div class="card card-neumorphic shadow p-3">
            <h5>Inventory Trend</h5>
            <canvas id="inventoryChart" height="200"></canvas>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card card-neumorphic shadow p-3">
            <h5>Sales Trend</h5>
            <canvas id="salesChart" height="200"></canvas>
        </div>
    </div>
</div>
@endsection