@extends('backend.layouts.master')
@section('section-title', 'Customer')
@section('page-title', 'List')
@if (check_permission('users.create'))
    @section('action-button')
        <a href="#" data-toggle="modal" data-target="#addModal" class="btn btn-primary-rgba">
            <i class="mr-2 feather icon-plus"></i>
            Add Customer
        </a>
    @endsection
@endif
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card m-b-30">
                <div class="card-header">
                    <h5 class="card-title">Customer List</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable-buttons" class="table table-striped table-bordered">
                            <thead class="table-primary">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Payable</th>
                                    <th>Receivable</th>
                                    <th>Balance</th>
                                    <th>Due</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($customers as $data)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->email }}</td>
                                        <td>{{ $data->phone }}</td>
                                        <td>{{ $data->payable }}</td>
                                        <td>{{ $data->receivable }}</td>
                                        <td>{{ $data->payable - $data->receivable }}</td>
                                        <td>{{ $data->payable - $data->receivable }}</td>
                                        {{-- <td>
                                            <input type="checkbox" data-toggle="toggle" data-on="Active"
                                                class="status-update" {{ $data->status == 1 ? 'checked' : '' }}
                                                data-off="Inactive" data-onstyle="success" data-offstyle="danger"
                                                data-id="{{ $data->id }}" data-model="User">
                                        </td> --}}
                                        <td>
                                            @if (check_permission('users.edit'))
                                                <a href="{{ route('users.edit', $data->id) }}"
                                                    class="btn btn-primary-rgba">
                                                    <i class="feather icon-edit"></i>
                                                </a>
                                            @endif
                                            @if (check_permission('users.destroy'))
                                                <button class="btn btn-danger-rgba">
                                                    <i class="feather icon-trash"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
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
    <form action="{{route('customers.store')}}" method="POST">
        @csrf
        <x-add-modal title="Add Customer" sizeClass="modal-lg">
            <x-input label="Customer Name:" type="text" name="name" placeholder="Enter Customer Name" required md="6" />
            <x-input label="Email:" type="email" name="email" placeholder="Enter Email" required md="6" />
            <x-input label="Phone:" type="text" name="phone" placeholder="Enter Phone" required md="6" />
            <x-input label="Address:" type="text" name="address" placeholder="Enter Address" required md="6" />
            <x-input label="Payable:" type="text" name="payable" value="0" md="6" />
            <x-input label="Receivable:" type="text" name="receivable" value="0" md="6" />
        </x-add-modal>
    </form>
@endsection
