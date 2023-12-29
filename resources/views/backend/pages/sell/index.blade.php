@extends('backend.layouts.master')
@section('section-title', 'Sell')
@section('page-title', 'List')
@section('action-button')
    <a href="{{ route('pos.index') }}" class="btn btn-primary-rgba">
        <i class="mr-2 feather icon-plus"></i>
        Add New Sell
    </a>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card m-b-30">
                <div class="card-header">
                    <h5 class="card-title">Sell List</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable-buttons" class="table table-striped table-bordered">
                            <thead class="table-primary">
                                <tr class="text-center">
                                    <th> Invoice Date </th>
                                    <th> Invoice No </th>
                                    <th> Customer </th>
                                    <th> Customer Phone </th>
                                    <th> Total Amount </th>
                                    <th> Total Paid </th>
                                    <th> Total Due </th>
                                    <th> Status </th>
                                    <th> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($sellInfos as $sellInfo)
                                    <tr class="text-center">
                                        <td>{{ $sellInfo->created_at }}</td>
                                        <td>{{ $sellInfo->invoice_id }}</td>
                                        <td>{{ $sellInfo->customer_name }}</td>
                                        <td>{{ $sellInfo->customer_phone }}</td>
                                        <td>{{ $sellInfo->total_amount }}</td>
                                        <td>{{ $sellInfo->paid_amount }}</td>
                                        <td>{{ $sellInfo->due_amount }}</td>
                                        <td>
                                            @if ($sellInfo->status == 0)
                                                <span class="badge bg-warning">Due</span>
                                            @elseif ($sellInfo->status == 1)
                                                <span class="badge bg-success">Paid</span>
                                            @endif
                                        </td>
                                        <td>
                                            {{-- pay button  --}}
                                            @if (check_permission('sell.due-pay'))
                                                @if ($sellInfo->due_amount > 0)
                                                    <a href="{{ url('sell-due/pay/' . $sellInfo->id) }}"
                                                        class="btn btn-success-rgba">
                                                        <i class="feather icon-dollar-sign"></i>
                                                    </a>
                                                @endif
                                            @endif
                                            {{-- show button  --}}
                                            @if (check_permission('sell.details'))
                                                <a href="{{ url('sell-details/' . $sellInfo->id) }}"
                                                    class="btn btn-primary-rgba">
                                                    <i class="feather icon-eye"></i>
                                                </a>
                                            @endif
                                            {{-- Print Invoice --}}
                                            <a onclick="printInvoice('{{ $sellInfo->id }}','sell')"
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
