@extends('backend.layouts.master')
@section('section-title', 'Supplier')
@section('page-title', 'List')
@if (check_permission('suppliers.update'))
    @section('action-button')
        <a href="#" data-toggle="modal" data-target="#addModal" class="btn btn-primary-rgba">
            <i class="mr-2 feather icon-plus"></i>
            Add Supplier
        </a>
    @endsection
@endif
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card m-b-30">
                <div class="card-header">
                    <h5 class="card-title">Supplier List</h5>
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
                                @forelse($suppliers as $data)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->email }}</td>
                                        <td>{{ $data->phone }}</td>
                                        <td>{{ $data->payable }}</td>
                                        <td>{{ $data->receivable }}</td>
                                        
                                        <td>{{ $data->payable - $data->receivable }}</td>
                                        <td>{{ $data->payable - $data->receivable }}</td>
                                        <td>
                                            @if(check_permission('suppliers.update'))
                                                <a href="#" data-toggle="modal" data-target="#editModal-{{ $data->id }}"
                                                    class="btn btn-primary-rgba">
                                                    <i class="feather icon-edit"></i>
                                                </a>
                                            @endif
                                            
                                            @if (check_permission('suppliers.destroy'))
                                                <a href="#" data-toggle="modal"
                                                    data-target="#deleteModal-{{ $data->id }}" class="btn btn-danger-rgba">
                                                    <i class="feather icon-trash"></i>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>

                                    {{-- edit modal  --}}
                                    <form action="{{ route('suppliers.update', $data->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <x-edit-modal title="Edit Supplier" sizeClass="modal-lg" id="{{ $data->id }}">
                                            <x-input label="Name:" type="text" name="name" placeholder="Enter Name"
                                                required md="6" value="{{$data->name}}" />
                                            <x-input label="Email:" type="email" name="email" placeholder="Enter Email"
                                                required md="6" value="{{$data->email}}" />
                                            <x-input label="Phone:" type="text" name="phone" placeholder="Enter Phone"
                                                required md="6" value="{{$data->phone}}" />
                                            <x-input label="Address:" type="text" name="address"
                                                placeholder="Enter Address" required md="6"
                                                value="{{$data->address}}" />
                                            <x-input label="Payable:" type="text" name="payable" value="{{$data->payable}}" md="6" />
                                            <x-input label="Receivable:" type="text" name="receivable" value="{{$data->receivable}}" md="6" />
                                        </x-edit-modal>
                                    </form>

                                    {{-- delete modal --}}
                                    <form action="{{ route('suppliers.destroy', $data->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <x-delete-modal title="Delete Supplier" id="{{ $data->id }}" />
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
    <form action="{{route('suppliers.store')}}" method="POST">
        @csrf
        <x-add-modal title="Add Supplier" sizeClass="modal-lg">
            <x-input label="Supplier Name:" type="text" name="name" placeholder="Enter Supplier Name" required md="6" />
            <x-input label="Email:" type="email" name="email" placeholder="Enter Email" required md="6" />
            <x-input label="Phone:" type="text" name="phone" placeholder="Enter Phone" required md="6" />
            <x-input label="Address:" type="text" name="address" placeholder="Enter Address" required md="6" />
            <x-input label="Payable:" type="text" name="payable" value="0" md="6" />
            <x-input label="Receivable:" type="text" name="receivable" value="0" md="6" />
        </x-add-modal>
    </form>
    
@endsection
