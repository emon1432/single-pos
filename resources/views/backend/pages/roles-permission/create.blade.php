@extends('backend.layouts.master')
@section('section-title', 'Role & Permission')
@section('page-title', 'Create')
@section('action-button')
    <a href="{{ route('roles-permission.index') }}" class="btn btn-primary-rgba">
        <i class="mr-2 feather icon-list"></i>
        Role & Permission List
    </a>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card m-b-30">
                <div class="card-header">
                    <h4 class="card-title font-weight-bold">Add Role & Permission</h4>
                </div>
                <div class="card-body">
                    <form class="needs-validation" action="{{ route('roles-permission.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row d-flex justify-content-center">
                            <div class="col-md-3"></div>
                            <div class="mb-3 col-md-6">
                                <label for="validationCustom01" class="form-label font-weight-bold">
                                    Role Name
                                </label>
                                <input type="text" class="form-control" id="validationCustom01"
                                    placeholder="Enter Role Name" name="name" required>
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                        <div class="card" style="border: 1px solid black;">
                            <div class="card-header bg-secondary">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4 class="card-title">Permission</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach ($routeList as $key => $value)
                                        <div class="col-md-3">
                                            <div class="card" style="border: 1px solid black;">
                                                <div class="card-header bg-secondary">
                                                    <div class="custom-control custom-checkbox">
                                                        <input class="custom-control-input" type="checkbox"
                                                            id="{{ $key }}"
                                                            onclick="$('.{{ $key }}').prop('checked', this.checked);">
                                                        <label class="custom-control-label font-weight-bold text-dark"
                                                            for="{{ $key }}">
                                                            {{ str_replace('-', ' ', str_replace('_', ' ', ucfirst($key))) }}
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    @foreach ($routeList[$key] as $item => $value)
                                                        <div class="custom-control custom-checkbox">
                                                            <input class="custom-control-input {{ $key }}"
                                                                type="checkbox" id="{{ $key }}{{ $item }}"
                                                                name="permission[{{ $key }}][]"
                                                                value="{{ $item }}">
                                                            <label class="custom-control-label font-weight-bold"
                                                                for="{{ $key }}{{ $item }}">
                                                                {{ str_replace('-', ' ', str_replace('_', ' ', ucfirst($item))) }}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="card-footer mt-3">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary-rgba">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
