@extends('backend.layouts.master')
@section('section-title', 'Bank Account')
@section('page-title', 'List')
@if (check_permission('bank-accounts.create'))
    @section('action-button')
        <a href="{{ url('bank-accounts/create') }}" class="btn btn-primary-rgba">
            <i class="mr-2 feather icon-plus"></i>
            Add Bank Account
        </a>
    @endsection
@endif
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card m-b-30">
                <div class="card-header">
                    <h5 class="card-title">Bank Account List</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable-buttons" class="table table-striped table-bordered">
                            <thead class="table-primary">
                                <tr>
                                    <th> Account Name </th>
                                    <th> Account Number </th>
                                    <th> Bank Name </th>
                                    <th> Branch Name </th>
                                    <th> Contact Person </th>
                                    <th> Contact Number </th>
                                    <th> Email </th>
                                    <th> Status </th>
                                    <th> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bank_accounts as $bank_account)
                                    <tr class="text-center">
                                        <td>{{ $bank_account->name }}</td>
                                        <td>{{ $bank_account->account_number }}</td>
                                        <td>{{ $bank_account->bank_name }}</td>
                                        <td>{{ $bank_account->branch_name }}</td>
                                        <td>{{ $bank_account->contact_person }}</td>
                                        <td>{{ $bank_account->contact_number }}</td>
                                        <td>{{ $bank_account->email }}</td>
                                        <td>
                                            @if ($bank_account->id != 1)
                                                <input type="checkbox" data-toggle="toggle" data-on="Active"
                                                    class="status-update" {{ $bank_account->status == 1 ? 'checked' : '' }}
                                                    data-off="Inactive" data-onstyle="success" data-offstyle="danger"
                                                    data-id="{{ $bank_account->id }}" data-model="BankAccount">
                                            @else
                                                <span class="badge badge-success">Active</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if (check_permission('bank-accounts.edit'))
                                                <a href="{{ url('bank-accounts/' . $bank_account->id . '/edit') }}"
                                                    class="btn btn-primary-rgba {{ $bank_account->id == 1 ? 'disabled' : '' }}">
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
