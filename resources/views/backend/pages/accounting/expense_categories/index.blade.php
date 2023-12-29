@extends('backend.layouts.master')
@section('section-title', 'Expense Categories')
@section('page-title', 'List')
@if (check_permission('expense-categories.create'))
    @section('action-button')
        <a href="{{ route('expense-categories.create') }}" class="btn btn-primary-rgba">
            <i class="mr-2 feather icon-plus"></i>
            Add New Expense Category
        </a>
    @endsection
@endif
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card m-b-30">
                <div class="card-header">
                    <h5 class="card-title">Expense Categories List</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable-buttons" class="table table-striped table-bordered">
                            <thead class="table-primary">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Details</th>
                                    <th>Created By</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($expenseCategories as $key => $expenseCategory)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $expenseCategory->name }}</td>
                                        <td>{{ $expenseCategory->details }}</td>
                                        @if ($expenseCategory->is_default == true)
                                            <td class="text-danger">Sytem Default</td>
                                        @else
                                            <td>{{ $expenseCategory->user->name }}</td>
                                        @endif
                                        <td>
                                            <input type="checkbox" data-toggle="toggle" data-on="Active"
                                                class="status-update" {{ $expenseCategory->status == 1 ? 'checked' : '' }}
                                                data-off="Inactive" data-onstyle="success" data-offstyle="danger"
                                                {{ $expenseCategory->is_default == true ? 'disabled' : '' }}
                                                data-id="{{ $expenseCategory->id }}" data-model="ExpenseCategory">

                                        </td>
                                        <td>
                                            @if (check_permission('expense-categories.update'))
                                                <a href="{{ route('expense-categories.edit', $expenseCategory->id) }}"
                                                    class="btn btn-primary-rgba {{ $expenseCategory->is_default == true ? 'disabled' : '' }}">
                                                    <i class="feather icon-edit"></i>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
