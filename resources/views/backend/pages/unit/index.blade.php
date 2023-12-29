@extends('backend.layouts.master')
@section('section-title', 'Unit')
@section('page-title', 'List')
@if (check_permission('units.update'))
    @section('action-button')
        <a href="#" data-toggle="modal" data-target="#addModal" class="btn btn-primary-rgba">
            <i class="mr-2 feather icon-plus"></i>
            Add Unit
        </a>
    @endsection
@endif
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card m-b-30">
                <div class="card-header">
                    <h5 class="card-title">Unit List</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable-buttons" class="table table-striped table-bordered">
                            <thead class="table-primary">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Related To</th>
                                    <th>Related Sign</th>
                                    <th>Related Value</th>
                                    <th>Final Value</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($units as $data)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->related_unit ? $data->related_unit->name : '-' }}</td>
                                        <td>{{ $data->related_sign ? $data->related_sign : '-' }}</td>
                                        <td>{{ $data->related_value ? $data->related_value : '-' }}</td>
                                        <td>
                                            @if ($data->related_unit)
                                                {{ $data->name }} = 1
                                                {{ $data->related_unit ? $data->related_unit->name : '-' }}
                                                {{ $data->related_sign ? $data->related_sign : '-' }}
                                                {{ $data->related_value ? $data->related_value : '-' }}
                                            @endif
                                        </td>
                                        <td>
                                            @if (check_permission('units.update'))
                                                <a href="#" data-toggle="modal"
                                                    data-target="#editModal-{{ $data->id }}"
                                                    class="btn btn-primary-rgba {{ $data->id == 1 ? 'disabled' : '' }}">
                                                    <i class="feather icon-edit"></i>
                                                </a>
                                            @endif

                                            @if (check_permission('units.destroy'))
                                                <a href="#" data-toggle="modal"
                                                    data-target="#deleteModal-{{ $data->id }}"
                                                    class="btn btn-danger-rgba {{ $data->id == 1 ? 'disabled' : '' }}">
                                                    <i class="feather icon-trash"></i>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>

                                    {{-- edit modal  --}}
                                    <form action="{{ route('units.update', $data->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <x-edit-modal title="Edit Customer" sizeClass="modal-lg" id="{{ $data->id }}">
                                            <x-input label="Unit Name:" type="text" name="name"
                                                placeholder="Enter Unit Name" required md="6"
                                                value="{{ $data->name }}" />
                                            <x-select label="Related Unit:" name="related_unit_id" md="6">
                                                <option value="">Select Related Unit</option>
                                                @foreach ($units as $unit)
                                                    <option value="{{ $unit->id }}"
                                                        @if ($data->id == $unit->related_unit_id) selected @endif>
                                                        {{ $unit->name }}</option>
                                                @endforeach
                                            </x-select>
                                            <x-input label="Related Sign:" type="text" name="related_sign" value="*"
                                                md="6" readonly />
                                            <x-input label="Related Value:" type="text" name="related_value"
                                                placeholder="Enter Related Value" required md="6"
                                                value="{{ $data->related_value }}" />
                                        </x-edit-modal>
                                    </form>

                                    {{-- delete modal --}}
                                    <form action="{{ route('units.destroy', $data->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <x-delete-modal title="Delete Customer" id="{{ $data->id }}" />
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
    <form action="{{ route('units.store') }}" method="POST">
        @csrf
        <x-add-modal title="Add Unit" sizeClass="modal-lg">
            <x-input label="Unit Name:" type="text" name="name" placeholder="Enter Unit Name" required
                md="6" />
            <x-select label="Related Unit:" name="related_unit_id" md="6">
                <option value="">Select Related Unit</option>
                @foreach ($units as $data)
                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                @endforeach
            </x-select>
            <x-input label="Related Sign:" type="text" name="related_sign" value="*" md="6" readonly />
            <x-input label="Related Value:" type="text" name="related_value" placeholder="Enter Related Value" required
                md="6" />
        </x-add-modal>
    </form>

@endsection
