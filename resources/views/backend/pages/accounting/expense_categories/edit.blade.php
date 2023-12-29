@extends('backend.layouts.master')
@section('section-title', 'Expense Categories')
@section('page-title', 'Update')

@if (check_permission('expense-categories.index'))
    @section('action-button')
        <a href="{{ route('expense-categories.index') }}" class="btn btn-primary-rgba">
            <i class="mr-2 feather icon-list"></i>
            Expense Categories List
        </a>
    @endsection
@endif

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Expense Category</h5>
                </div>
                <div class="card-body">
                    <div class="border rounded">
                        <form class="row g-3 needs-validation" method="POST"
                            action="{{ route('expense-categories.update', $expenseCategory->id) }}"
                            enctype="multipart/form-data" novalidate>
                            @csrf
                            @method('PUT')
                            {{-- Name --}}
                            <div class="mt-2 col-md-6">
                                <label for="name" class="form-label fw-bold">Expense Category Name</label>
                                <input type="text" class="form-control" placeholder="Enter expense category name"
                                    name="name" id="name" required value="{{ $expenseCategory->name }}">
                            </div>

                            {{-- Status --}}
                            <div class="mt-2 col-md-6">
                                <label for="status" class="form-label fw-bold">Status</label>
                                <select class="form-control" name="status" required>
                                    <option selected disabled value="">Select Status</option>
                                    <option value="1" {{ $expenseCategory->status == 1 ? 'selected' : '' }}>Active
                                    </option>
                                    <option value="0" {{ $expenseCategory->status == 0 ? 'selected' : '' }}>Inactive
                                    </option>
                                </select>
                            </div>

                            {{-- Details --}}
                            <div class="mt-2 col-md-12">
                                <label for="details" class="form-label fw-bold">Details</label>
                                <textarea class="form-control" placeholder="Enter details" name="details" id="details">{{ $expenseCategory->details }}</textarea>
                            </div>

                            {{-- Submit Button --}}
                            <div class="mt-2 col-md-12">
                                @if (check_permission('expense-categories.update'))
                                    <button class="btn btn-primary" type="submit">Update</button>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
