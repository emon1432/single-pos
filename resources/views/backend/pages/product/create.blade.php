@extends('backend.layouts.master')
@section('section-title', 'Create Product')
@section('page-title', 'Create')

@if (check_permission('products.update'))
    @section('action-button')
        <a href="{{ route('products.index') }}" class="btn btn-primary-rgba">
            <i class="mr-2 feather icon-list"></i>
            All Products
        </a>
    @endsection
@endif

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Add New Product</h5>
            </div>
            <div class="card-body">
                <div class="border rounded">
                    <form class="row g-3 needs-validation" method="POST" action="{{ route('products.store') }}"
                        enctype="multipart/form-data" novalidate>
                        @csrf
                        {{-- Product name --}}
                        <div class="mt-2 col-md-6">
                            <label for="name" class="form-label fw-bold">Product Name</label>
                            <input type="text" class="form-control" name="name"
                                placeholder="Enter product name" required>
                        </div>

                        {{-- Product code  --}}
                        <div class="mt-2 col-md-6">
                            <label for="code" class="form-label fw-bold">Product Code</label>
                            <input type="text" class="form-control"
                                placeholder="Enter product code" name="code">
                        </div>
                        
                        {{-- Brand --}}
                        <div class="mt-2 col-md-6">
                            <label for="brand_id" class="form-label fw-bold">Select Brand</label>
                            <select class="form-control select2" name="brand_id">
                                <option selected disabled value="">Select Brand</option>
                                @foreach ($brands as $brand)
                                    <option value={{ $brand->id }}>{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        {{-- Category --}}
                        <div class="mt-2 col-md-6">
                            <label for="unit_id" class="form-label fw-bold">Select Category</label>
                            <select class="form-control" name="category_id">
                                <option selected disabled value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value={{ $category->id }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Unit --}}
                        <div class="mt-2 col-md-6">
                            <label for="unit_id" class="form-label fw-bold">Select Unit</label>
                            <select class="form-control select2" name="unit_id" required>
                                <option selected disabled value="">Select Unit</option>
                                @foreach ($units as $unit)
                                    <option value={{ $unit->id }}>{{ $unit->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        {{-- Supplier  --}}
                        <div class="mt-2 col-md-6">
                            <label for="supplier_id" class="form-label fw-bold">Select Supplier</label>
                            <select class="form-control" name="supplier_id">
                                <option selected disabled value="">Select Supplier</option>
                                @foreach ($suppliers as $supplier)
                                    <option value={{ $supplier->id }}>{{ $supplier->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- <div class="mt-2 col-md-6">
                            <label for="validationCustom09" class="form-label fw-bold">Product Quantity</label>
                            <input type="number" class="form-control" id="validationCustom09" name="quantity" required>
                        </div> --}}

                        {{-- Alert Quantity --}}
                        <div class="mt-2 col-md-2">
                            <label for="alert_quantity" class="form-label fw-bold">Alert Quantity</label>
                            <input type="number" class="form-control" name="alert_quantity"
                                required>
                        </div>
                        
                        {{-- Price --}}
                        <div class="mt-2 col-md-5">
                            <label for="purchase_price" class="form-label fw-bold">Purchase Price</label>
                            <input type="number" class="form-control" name="purchase_price"
                                required>
                        </div>
                        <div class="mt-2 col-md-5">
                            <label for="selling_price" class="form-label fw-bold">Sale Price</label>
                            <input type="number" class="form-control" name="selling_price"
                                required>
                        </div>
                        {{-- Description --}}
                        <div class="mt-2 col-md-12">
                            <label for="description" class="form-label fw-bold">Description</label>
                            <textarea class="form-control" name="description" rows="5"></textarea>
                        </div>

                        {{-- Multiple Image --}}
                        <div class="col-md-12">
                            <label for="image" class="form-label fw-bold">Product
                                Images</label>
                            <input class="form-control image-uploadify" type="file"
                                name="image[]" accept="image/*" multiple required>
                        </div>

                        <div class="mt-3 text-center col-12">
                            <button class="btn btn-primary" type="submit"> Save </button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
