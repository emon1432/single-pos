@extends('backend.layouts.master')
@section('section-title', 'Category')
@section('page-title', 'List')

    @section('action-button')
        <a href="#" data-toggle="modal" data-target="#addModal" class="btn btn-primary-rgba">
            <i class="mr-2 feather icon-plus"></i>
            Add Category
        </a>
    @endsection
    
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card m-b-30">
                <div class="card-header">
                    <h5 class="card-title">Category List</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable-buttons" class="table table-striped table-bordered">
                            <thead class="table-primary">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($categories as $data)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>
                                            @if(check_permission('categories.update'))
                                                <a href="#" data-toggle="modal" data-target="#editModal-{{ $data->id }}"
                                                    class="btn btn-primary-rgba">
                                                    <i class="feather icon-edit"></i>
                                                </a>
                                            @endif
                                            
                                            @if (check_permission('categories.destroy'))
                                                <a href="#" data-toggle="modal"
                                                    data-target="#deleteModal-{{ $data->id }}" class="btn btn-danger-rgba">
                                                    <i class="feather icon-trash"></i>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>

                                    {{-- edit modal  --}}
                                    <form action="{{ route('categories.update', $data->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <x-edit-modal title="Edit Category" sizeClass="modal-md" id="{{ $data->id }}">
                                            <x-input label="Name:" type="text" name="name" placeholder="Enter Name"
                                                required value="{{$data->name}}" />
                                        </x-edit-modal>
                                    </form>

                                    {{-- delete modal --}}
                                    <form action="{{ route('categories.destroy', $data->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <x-delete-modal title="Delete Category" id="{{ $data->id }}" />
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
    <form action="{{route('categories.store')}}" method="POST">
        @csrf
        <x-add-modal title="Add Category" sizeClass="modal-md">
            <x-input label="Category Name:" type="text" name="name" placeholder="Enter Category Name" required />
        </x-add-modal>
    </form>
    
@endsection
