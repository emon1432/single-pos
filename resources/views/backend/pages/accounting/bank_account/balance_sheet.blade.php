@extends('backend.layouts.master')
@section('section-title', 'Balance Sheet')
@section('page-title', 'Balance Sheet')
@if (check_permission('bank-accounts.index'))
    @section('action-button')
        <a href="{{ url('bank-accounts') }}" class="btn btn-primary-rgba">
            <i class="mr-2 feather icon-plus"></i>
            Bank Account List
        </a>
    @endsection
@endif
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card m-b-30">
                <div class="card-header">
                    <h5 class="card-title">Balance Sheet</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable-buttons" class="table table-striped table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th> Bank Name </th>
                                    <th> Account Name </th>
                                    <th> Account Number </th>
                                    <th> Deposit </th>
                                    <th> Withdraw </th>
                                    <th> Transfer To Others </th>
                                    <th> Transfer From Others </th>
                                    <th> Balance </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total_deposit = 0;
                                    $total_withdraw = 0;
                                    $total_transfer_to_others = 0;
                                    $total_transfer_from_others = 0;
                                    $total_balance = 0;
                                @endphp
                                @foreach ($bank_accounts_balance_sheet as $bank_account)
                                    <tr class="text-center">
                                        <td>{{ $bank_account->bank_name }}</td>
                                        <td>{{ $bank_account->name }}</td>
                                        <td>{{ $bank_account->account_number }}</td>
                                        <td>{{ $bank_account->total_deposit }}</td>
                                        <td>{{ $bank_account->total_withdraw }}</td>
                                        <td>{{ $bank_account->total_transfer_to_others }}</td>
                                        <td>{{ $bank_account->total_transfer_from_others }}</td>
                                        {{-- Calculate Balance --}}
                                        @php
                                            $balance = abs($bank_account->total_deposit + $bank_account->total_transfer_from_others) - abs($bank_account->total_withdraw + $bank_account->total_transfer_to_others);
                                        @endphp
                                        <td>{{ $balance }}</td>

                                        {{-- total deposit, withdraw, Transfer To Others, Transfer From Others, Balance --}}
                                        @php
                                            $total_deposit += $bank_account->total_deposit;
                                            $total_withdraw += $bank_account->total_withdraw;
                                            $total_transfer_to_others += $bank_account->total_transfer_to_others;
                                            $total_transfer_from_others += $bank_account->total_transfer_from_others;
                                            $total_balance += $balance;
                                        @endphp
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="text-center">
                                    <th colspan="2"></th>
                                    <th>Total</th>
                                    <th>{{ $total_deposit }}</th>
                                    <th>{{ $total_withdraw }}</th>
                                    <th>{{ $total_transfer_to_others }}</th>
                                    <th>{{ $total_transfer_from_others }}</th>
                                    <th>{{ $total_balance }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
