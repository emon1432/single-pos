@extends('backend.layouts.master')
@section('section-title', 'Bank Transaction')
@section('page-title', 'List')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card m-b-30">
                <div class="card-header">
                    <h5 class="card-title">Bank Transaction List</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable-buttons" class="table table-striped table-bordered">
                            <thead class="table-primary">
                                <tr class="text-center">
                                    <th> Date </th>
                                    <th> Reference No </th>
                                    <th> Type </th>
                                    <th>
                                        <span class="badge bg-success">Income</span>
                                        /
                                        <span class="badge bg-warning">Expense</span>
                                    </th>
                                    <th> Account </th>
                                    <th> Credit </th>
                                    <th> Debit </th>
                                    <th> Created By </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total_credit = 0;
                                    $total_debit = 0;
                                @endphp
                                @foreach ($bank_transactions as $transaction)
                                    <tr class="text-center">
                                        <td> {{ $transaction->created_at->format('d M Y h:i:s A') }} </td>
                                        <td> {{ $transaction->reference_no }} </td>
                                        <td>
                                            @if ($transaction->transaction_type == 'deposit')
                                                <span class="badge bg-success"> Deposit </span>
                                            @else
                                                <span class="badge bg-warning"> Withdraw </span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($transaction->transaction_type == 'deposit')
                                                {{ $transaction->income_source->name }}
                                            @else
                                                {{ $transaction->expense_category->name }}
                                            @endif
                                        </td>
                                        <td> {{ $transaction->to_bank_account->name }} </td>
                                        @if ($transaction->transaction_type == 'deposit')
                                            <td> {{ $transaction->amount }} </td>
                                            <td> - </td>
                                            @php
                                                $total_credit += $transaction->amount;
                                            @endphp
                                        @else
                                            <td> - </td>
                                            <td> {{ $transaction->amount }} </td>
                                            @php
                                                $total_debit += $transaction->amount;
                                            @endphp
                                        @endif
                                        <td> {{ $transaction->user->name }} </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="5" class="text-end"> Total Amount </th>
                                    <th class="text-center"> {{ $total_credit }} </th>
                                    <th class="text-center"> {{ $total_debit }} </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
