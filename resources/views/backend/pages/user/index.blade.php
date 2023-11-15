@extends('backend.layouts.master')
@section('section-title', 'User')
@section('page-title', 'List')
@section('action-button')
    <a class="btn btn-primary-rgba" href="{{ route('users.create') }}">
        <i class="mr-2 feather icon-plus"></i>
        Add User
    </a>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card m-b-30">
                <div class="card-header">
                    <h5 class="card-title">User List</h5>
                </div>
                <div class="card-body">
                    <h6 class="card-subtitle">Export data to Copy, CSV, Excel & Note.</h6>
                    <div class="table-responsive">
                        <table id="datatable-buttons" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Photo</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>User Role</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>
                                            <img src="{{ asset('backend') }}/images/users/{{ $user->image }}"
                                                alt="{{ $user->name }}" width="50px" height="50px">
                                        </td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{{ $user->role->name }}</td>
                                        <td>
                                            <input type="checkbox" data-toggle="toggle" data-on="Active"
                                                class="status-update" {{ $user->status == 1 ? 'checked' : '' }}
                                                data-off="Inactive" data-onstyle="success" data-offstyle="danger"
                                                data-id="{{ $user->id }}" data-model="User">
                                        </td>
                                        <td>
                                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary-rgba">
                                                <i class="feather icon-edit"></i>
                                            </a>
                                            <button class="btn btn-danger-rgba">
                                                <i class="feather icon-trash"></i>
                                            </button>
                                        </td>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
