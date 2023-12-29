@extends('backend.layouts.master')
@section('section-title', 'Income Sources')
@section('page-title', 'Create')

@if (check_permission('income-sources.index'))
    @section('action-button')
        <a href="{{ route('income-sources.index') }}" class="btn btn-primary-rgba">
            <i class="mr-2 feather icon-list"></i>
            Income Sources List
        </a>
    @endsection
@endif

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Income Source</h5>
                </div>
                <div class="card-body">
                    <div class="border rounded">
                        <form class="row g-3 needs-validation" method="POST" action="{{ route('income-sources.store') }}"
                            enctype="multipart/form-data" novalidate>
                            @csrf
                            {{-- Name --}}
                            <div class="mt-2 col-md-6">
                                <label for="name" class="form-label fw-bold">Income Source Name</label>
                                <input type="text" class="form-control" placeholder="Enter income source name"
                                    name="name" id="name" required>
                            </div>

                            {{-- Status --}}
                            <div class="mt-2 col-md-6">
                                <label for="status" class="form-label fw-bold">Status</label>
                                <select class="form-control" name="status" required>
                                    <option selected disabled value="">Select Status</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>

                            {{-- Details --}}
                            <div class="mt-2 col-md-12">
                                <label for="details" class="form-label fw-bold">Details</label>
                                <textarea class="form-control" placeholder="Enter details" name="details" id="details"></textarea>
                            </div>

                            {{-- Submit Button --}}
                            <div class="mt-2 col-md-12">
                                @if (check_permission('income-sources.store'))
                                    <button class="btn btn-primary" type="submit">Save</button>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
