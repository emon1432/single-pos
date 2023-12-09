@extends('backend.layouts.master')
@section('section-title', 'Purchase')
@section('page-title', 'log')
@if (check_permission('purchase.create'))
    @section('action-button')
        <a href="{{ route('purchase.create') }}" class="btn btn-primary-rgba">
            <i class="mr-2 feather icon-plus"></i>
            Add New Purchase
        </a>
    @endsection
@endif
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card m-b-30">
                <div class="card-header">
                    <h5 class="card-title">Purchase Log</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable-buttons" class="table table-striped table-bordered">
                            <thead class="table-primary">
                                <tr class="text-center">
                                    <th> Date </th>
                                    <th>Purchase No</th>
                                    <th>Type</th>
                                    <th>Supplier</th>
                                    <th>Created By</th>
                                    <th>Payment Method</th>
                                    <th>Amount</th>
                                    <th>Payment Reference</th>
                                    <th> Note </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($purchase_logs as $data)
                                    <tr class="text-center">
                                        <td>{{ $data->created_at->format('d-m-Y') }}</td>
                                        <td>{{ $data->purchase_no }}</td>
                                        <td><span
                                                class="badge bg-{{ $data->type == 'Purchase' ? 'info' : 'warning' }}">{{ $data->type }}</span>
                                        <td>{{ $data->supplier->name }}</td>
                                        <td>{{ $data->user->name }}</td>
                                        <td>{{ $data->payment_method->name }}</td>
                                        <td>{{ $data->paid_amount }}</td>
                                        <td>{{ $data->payment_reference }}</td>
                                        <td>{{ $data->note }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center">No Data Found!</td>
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
