@extends('backend.layouts.master')
@section('section-title', 'Product')
@section('page-title', 'List')
@if (check_permission('products.create'))
    @section('action-button')
        <a href="{{ route('products.create') }}" class="btn btn-primary-rgba">
            <i class="mr-2 feather icon-plus"></i>
            Add Product
        </a>
    @endsection
@endif
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card m-b-30">
                <div class="card-header">
                    <h5 class="card-title">Product List</h5>
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
                                @forelse($products as $data)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>
                                            @if(check_permission('products.update'))
                                                <a href="#" data-toggle="modal" data-target="#editModal-{{ $data->id }}"
                                                    class="btn btn-primary-rgba">
                                                    <i class="feather icon-edit"></i>
                                                </a>
                                            @endif
                                            
                                            @if (check_permission('products.destroy'))
                                                <a href="#" data-toggle="modal"
                                                    data-target="#deleteModal-{{ $data->id }}" class="btn btn-danger-rgba">
                                                    <i class="feather icon-trash"></i>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>

                                    {{-- delete modal --}}
                                    <form action="{{ route('products.destroy', $data->id) }}" method="POST">
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
@endsection
