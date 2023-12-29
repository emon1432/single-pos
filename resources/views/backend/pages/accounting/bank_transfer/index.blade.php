@extends('backend.layouts.master')
@section('section-title', 'Bank Transfer')
@section('page-title', 'List')
@if (check_permission('accounting.bank-transfer-create'))
    @section('action-button')
        <a href="{{ url('bank-transfer') }}" class="btn btn-primary-rgba">
            <i class="mr-2 feather icon-plus"></i>
            Add Bank Transfer
        </a>
    @endsection
@endif
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card m-b-30">
                <div class="card-header">
                    <h5 class="card-title">Bank Transfer List</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable-buttons" class="table table-striped table-bordered">
                            <thead class="table-primary">
                                <tr class="text-center">
                                    <th> Date </th>
                                    <th> Reference No </th>
                                    <th> From Account </th>
                                    <th> To Account </th>
                                    <th> Created By </th>
                                    <th> Details </th>
                                    <th> Amount </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total = 0;
                                @endphp
                                @foreach ($bank_transfers as $transfer)
                                    <tr class="text-center">
                                        <td> {{ $transfer->created_at->format('d M Y h:i:s A') }} </td>
                                        <td> {{ $transfer->reference_no }} </td>
                                        <td> {{ $transfer->from_bank_account->name }} </td>
                                        <td> {{ $transfer->to_bank_account->name }} </td>
                                        <td> {{ $transfer->user->name }} </td>
                                        <td> {{ $transfer->details }} </td>
                                        <td> {{ $transfer->amount }} </td>
                                    </tr>
                                    @php
                                        $total += $transfer->amount;
                                    @endphp
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="6" class="text-end"> Total Amount </th>
                                    <th class="text-center"> {{ $total }} </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
