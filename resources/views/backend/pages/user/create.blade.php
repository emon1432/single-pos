@extends('backend.layouts.master')
@section('section-title', 'User')
@section('page-title', 'Create')
@section('action-button')
    <a href="{{ route('users.index') }}" class="btn btn-primary-rgba">
        <i class="mr-2 feather icon-list"></i>
        User List
    </a>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card m-b-30">
                <div class="card-header">
                    <h4 class="card-title font-weight-bold">Add User</h4>
                </div>
                <div class="card-body">
                    <form class="needs-validation" novalidate action="{{ route('users.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            {{-- Name --}}
                            <div class="mb-3 col-md-12">
                                <label for="validationCustom01" class="form-label font-weight-bold">
                                    Name
                                </label>
                                <input type="text" class="form-control" id="validationCustom01"
                                    placeholder="Enter User Name" name="name" required>
                            </div>
                            {{-- Email --}}
                            <div class="mb-3 col-md-6">
                                <label for="validationCustom02" class="form-label font-weight-bold">
                                    Email</label>
                                <input type="email" class="form-control" id="validationCustom02"
                                    placeholder="Enter User Email" name="email" required>
                            </div>
                            {{-- Phone --}}
                            <div class="mb-3 col-md-6">
                                <label for="validationCustom03" class="form-label font-weight-bold">
                                    Phone</label>
                                <input type="text" class="form-control" id="validationCustom03"
                                    placeholder="Enter User Phone" name="phone" required>
                            </div>
                            {{-- Password --}}
                            <div class="mb-3 col-md-6">
                                <label for="validationCustom04" class="form-label font-weight-bold">
                                    Password</label>
                                <input type="password" class="form-control" id="validationCustom04"
                                    placeholder="Enter User Password" name="password" required>
                            </div>
                            {{-- Confirm Password --}}
                            <div class="mb-3 col-md-6">
                                <label for="validationCustom05" class="form-label font-weight-bold">
                                    Confirm Password</label>
                                <input type="password" class="form-control" id="validationCustom05"
                                    placeholder="Enter User Confirm Password" name="password_confirmation" required>
                            </div>
                            {{-- User Role --}}
                            <div class="mb-3 col-md-6">
                                <label for="validationCustom06" class="form-label font-weight-bold">
                                    User Role</label>
                                <select class="form-control single-select" id="validationCustom06" name="role_id" required>
                                    <option value="">Select Role</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- User Status --}}
                            <div class="mb-3 col-md-6">
                                <label for="validationCustom07" class="form-label font-weight-bold">
                                    User Status</label>
                                <select class="form-control single-select" id="validationCustom07" name="status" required>
                                    <option value="">Select Status</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                            {{-- Address --}}
                            <div class="mb-3 col-md-12">
                                <label for="validationCustom08" class="form-label font-weight-bold">
                                    Address</label>
                                <textarea class="form-control" id="validationCustom08" rows="5" placeholder="Enter User Address" name="address"
                                    required></textarea>
                            </div>
                            {{-- Image --}}
                            <div class="mb-3 col-md-12">
                                <label for="validationCustom10" class="form-label font-weight-bold">
                                    Image</label>
                                <div class="col-md-8 d-flex">
                                    <input class="mr-5 form-control" id="validationCustom10" type="file" name="image"
                                        onchange="document.getElementById('showImage').src = window.URL.createObjectURL(this.files[0])"
                                        required>
                                    <img id="showImage" style="max-width: 100px; max-height: 100px;"
                                        src="{{ asset('backend/images/users/profile.svg') }}" alt="your image" />
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 form-group d-flex justify-content-center">
                            <button class="mr-2 btn btn-primary" type="submit">Submit</button>
                            <button class="btn btn-danger">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
