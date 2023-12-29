@extends('backend.layouts.master')
@section('section-title', 'Income Sources')
@section('page-title', 'List')
@if (check_permission('income-sources.create'))
    @section('action-button')
        <a href="{{ route('income-sources.create') }}" class="btn btn-primary-rgba">
            <i class="mr-2 feather icon-plus"></i>
            Add New Income Source
        </a>
    @endsection
@endif
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card m-b-30">
                <div class="card-header">
                    <h5 class="card-title">Income Sources List</h5>
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
                                @foreach ($incomeSources as $key => $incomeSource)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $incomeSource->name }}</td>
                                        <td>{{ $incomeSource->details }}</td>
                                        @if ($incomeSource->is_default == true)
                                            <td class="text-danger">Sytem Default</td>
                                        @else
                                            <td>{{ $incomeSource->user->name }}</td>
                                        @endif
                                        <td>
                                            <input type="checkbox" data-toggle="toggle" data-on="Active"
                                                class="status-update" {{ $incomeSource->status == 1 ? 'checked' : '' }}
                                                data-off="Inactive" data-onstyle="success" data-offstyle="danger"
                                                {{ $incomeSource->is_default == true ? 'disabled' : '' }}
                                                data-id="{{ $incomeSource->id }}" data-model="IncomeSource">

                                        </td>
                                        <td>
                                            @if (check_permission('income-sources.update'))
                                                <a href="{{ route('income-sources.edit', $incomeSource->id) }}"
                                                    class="btn btn-primary-rgba {{ $incomeSource->is_default == true ? 'disabled' : '' }}">
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
