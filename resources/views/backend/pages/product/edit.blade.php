@extends('backend.layouts.master')
@section('section-title', 'Create Product')
@section('page-title', 'Create')
@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-dark">
                <div class="row ">
                    <div class="col-md-6">
                        <h4 class="card-title text-light">Add New Product</h4>
                    </div>
                    <div class="text-right col-md-6">
                        <a href="{{route('products.index') }}" class="btn btn-primary btn-sm">
                            <i class="bx bx-right-arrow-alt"></i>
                            All Product
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="p-4 border rounded">
                    <form class="row g-3 needs-validation" method="POST" action="{{ route('products.store') }}"
                        enctype="multipart/form-data" novalidate>
                        @csrf
                        {{-- Product name --}}
                        <div class="col-md-6">
                            <label for="validationCustom01" class="form-label fw-bold">Product Name</label>
                            <input type="text" class="form-control" id="validationCustom01" name="name"
                                placeholder="Enter product name" required>
                        </div>
                        {{-- Product code  --}}
                        <div class="col-md-6">
                            <label for="validationCustom03" class="form-label fw-bold">Product Code</label>
                            <input type="text" class="form-control" id="validationCustom03"
                                placeholder="Enter product code" name="code" required>
                        </div>
                        
                        {{-- Brand --}}
                        <div class="col-md-6">
                            <label for="validationCustom04" class="form-label fw-bold">Select Brand</label>
                            <select class="form-control select2" id="validationCustom04" name="brand_id" required>
                                <option selected disabled value="">Select Brand</option>
                                @foreach ($brands as $brand)
                                    <option value={{ $brand->id }}>{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        {{-- Category --}}
                        <div class="col-md-6">
                            <label for="validationCustom05" class="form-label fw-bold">Select Category</label>
                            <select class="form-control" id="validationCustom05" name="category_id" required>
                                <option selected disabled value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value={{ $category->id }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Unit --}}
                        <div class="col-md-6">
                            <label for="validationCustom07" class="form-label fw-bold">Select Unit</label>
                            <select class="form-control select2" id="validationCustom07" name="unit_id" required>
                                <option selected disabled value="">Select Unit</option>
                                @foreach ($units as $unit)
                                    <option value={{ $unit->id }}>{{ $unit->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- Supplier  --}}
                        <div class="col-md-6">
                            <label for="validationCustom08" class="form-label fw-bold">Select Supplier</label>
                            <select class="form-control" id="validationCustom08" name="supplier_id" required>
                                <option selected disabled value="">Select Supplier</option>
                                @foreach ($suppliers as $supplier)
                                    <option value={{ $supplier->id }}>{{ $supplier->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="validationCustom09" class="form-label fw-bold">Product Quantity</label>
                            <input type="number" class="form-control" id="validationCustom09" name="quantity" required>
                        </div>

                        {{-- Alert Quantity --}}
                        <div class="col-md-6">
                            <label for="validationCustom10" class="form-label fw-bold">Alert Quantity</label>
                            <input type="number" class="form-control" id="validationCustom10" name="alert_quantity"
                                required>
                        </div>
                        
                        {{-- Price --}}
                        <div class="col-md-6">
                            <label for="validationCustom11" class="form-label fw-bold">Product Price</label>
                            <input type="number" class="form-control" id="validationCustom11" name="selling_price"
                                required>
                        </div>
                        {{-- Description --}}
                        <div class="col-md-6">
                            <label for="validationCustom13" class="form-label fw-bold">Description</label>
                            <textarea class="form-control" id="validationCustom13" name="description" rows="5" required></textarea>
                        </div>

                        {{-- Tags --}}
                        <div class="col-md-6">
                            <label for="validationCustom14" class="form-label fw-bold">Tags</label>
                            <input type="text" class="form-control" id="validationCustom14" data-role="tagsinput"
                                name="tags" required>
                        </div>

                        {{-- Multiple Image --}}
                        <div class="col-md-12">
                            <label for="validationCustom16" class="form-label fw-bold">Product
                                Images</label>
                            <input class="form-control image-uploadify" id="validationCustom16" type="file"
                                name="image[]" accept="image/*" multiple required>
                        </div>

                        <div class="col-12">
                            <button class="btn btn-primary" type="submit"> Save </button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
