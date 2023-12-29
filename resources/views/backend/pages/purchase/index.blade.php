@extends('backend.layouts.master')
@section('section-title', 'Purchase')
@section('page-title', 'List')
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
                    <h5 class="card-title">Purchase List</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable-buttons" class="table table-striped table-bordered">
                            <thead class="table-primary">
                                <tr class="text-center">
                                    <th> Purchase Date </th>
                                    <th> Purchase No </th>
                                    <th> Supplier </th>
                                    <th> Creator </th>
                                    <th> Total Amount </th>
                                    <th> Total Paid </th>
                                    <th> Total Due </th>
                                    <th> Status </th>
                                    <th> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($purchases as $data)
                                    <tr class="text-center">
                                        <td>{{ $data->purchase_date }}</td>
                                        <td>{{ $data->purchase_no }}</td>
                                        <td>{{ $data->supplier->name }}</td>
                                        <td>{{ $data->user->name }}</td>
                                        <td>{{ $data->total_amount }}</td>
                                        <td>{{ $data->total_paid }}</td>
                                        <td>{{ $data->total_due }}</td>
                                        <td>
                                            @if ($data->status == 0)
                                                <span class="badge badge-warning">Due</span>
                                            @elseif($data->status == 1)
                                                <span class="badge badge-success">Paid</span>
                                            @endif
                                        </td>
                                        <td>
                                            {{-- pay button  --}}
                                            @if (check_permission('purchase.pay'))
                                                @if ($data->total_due > 0)
                                                    <a href="{{ url('purchase/pay/' . $data->id) }}"
                                                        class="btn btn-success-rgba">
                                                        <i class="feather icon-dollar-sign"></i>
                                                    </a>
                                                @endif
                                            @endif
                                            {{-- show button  --}}
                                            @if (check_permission('purchase.show'))
                                                <a href="{{ url('purchase/' . $data->id) }}" class="btn btn-primary-rgba">
                                                    <i class="feather icon-eye"></i>
                                                </a>
                                            @endif
                                            {{-- Print Invoice --}}
                                            <a onclick="printInvoice('{{ $data->id }}','purchase')"
                                                class="btn btn-info-rgba">
                                                <i class="feather icon-printer"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center">No Purchase Found</td>
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
