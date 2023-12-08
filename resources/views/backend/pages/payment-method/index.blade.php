@extends('backend.layouts.master')
@section('section-title', 'Payment Method')
@section('page-title', 'List')

@section('action-button')
    <a href="#" data-toggle="modal" data-target="#addModal" class="btn btn-primary-rgba">
        <i class="mr-2 feather icon-plus"></i>
        Add Payment Method
    </a>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card m-b-30">
                <div class="card-header">
                    <h5 class="card-title">Payment Method List</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable-buttons" class="table table-striped table-bordered">
                            <thead class="table-primary">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Details</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($paymentMethods as $data)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->slug }}</td>
                                        <td>{{ $data->details }}</td>
                                        <td>
                                            @if ($data->id != 1)
                                                <input type="checkbox" data-toggle="toggle" data-on="Active"
                                                    class="status-update" {{ $data->status == 1 ? 'checked' : '' }}
                                                    data-off="Inactive" data-onstyle="success" data-offstyle="danger"
                                                    data-id="{{ $data->id }}" data-model="PaymentMethod">
                                            @else
                                                <span class="badge badge-success">Active</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if (check_permission('payment-methods.update'))
                                                <a href="#" data-toggle="modal"
                                                    data-target="#editModal-{{ $data->id }}"
                                                    class="btn btn-primary-rgba {{ $data->id == 1 ? 'disabled' : '' }}">
                                                    <i class="feather icon-edit"></i>
                                                </a>
                                            @endif

                                            @if (check_permission('payment-methods.destroy'))
                                                <a href="#" data-toggle="modal"
                                                    data-target="#deleteModal-{{ $data->id }}"
                                                    class="btn btn-danger-rgba {{ $data->id == 1 ? 'disabled' : '' }}">
                                                    <i class="feather icon-trash"></i>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>

                                    {{-- edit modal  --}}
                                    <form action="{{ route('payment-methods.update', $data->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <x-edit-modal title="Edit Payment Method" sizeClass="modal-md"
                                            id="{{ $data->id }}">
                                            <x-input label="Name:" type="text" name="name" placeholder="Enter Name"
                                                required value="{{ $data->name }}" />
                                            <x-input label="Details:" type="text" name="details"
                                                placeholder="Enter Details" required value="{{ $data->details }}" />

                                        </x-edit-modal>
                                    </form>

                                    {{-- delete modal --}}
                                    <form action="{{ route('payment-methods.destroy', $data->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <x-delete-modal title="Delete Payment Method" id="{{ $data->id }}" />
                                    </form>
                                @empty
                                    <tr>
                                        <td colspan="100%" class="text-center text-danger">No Data Available</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Add Modal --}}
    <form action="{{ route('payment-methods.store') }}" method="POST">
        @csrf
        <x-add-modal title="Add Payment Method" sizeClass="modal-md">
            <x-input label="Payment Method Name:" type="text" name="name" placeholder="Enter Payment Method Name"
                required />
            <x-input label="Payment Method Details:" type="text" name="details"
                placeholder="Enter Payment Method Details" required />
        </x-add-modal>
    </form>

@endsection
