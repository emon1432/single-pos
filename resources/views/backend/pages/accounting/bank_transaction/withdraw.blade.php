@extends('backend.layouts.master')
@section('section-title', 'Withdraw From Bank')
@section('page-title', 'Withdraw')

@if (check_permission('accounting.transaction-history'))
    @section('action-button')
        <a href="{{ url('transaction-history') }}" class="btn btn-primary-rgba">
            <i class="mr-2 feather icon-list"></i>
            Transaction History
        </a>
    @endsection
@endif

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Withdraw from Bank Account</h5>
                </div>
                <div class="card-body">
                    <div class="border rounded">
                        <form class="row g-3 needs-validation" method="POST" action="{{ url('withdraw') }}"
                            enctype="multipart/form-data" novalidate>
                            @csrf
                            {{-- Account name --}}
                            <div class="mt-2 col-md-6">
                                <label for="name" class="form-label fw-bold">Select Account</label>
                                <select class="form-control" name="from_account" required>
                                    <option selected disabled value="">Select Account</option>
                                    @foreach ($bank_accounts as $account)
                                        <option value="{{ $account->id }}" data-deposit="{{ $account->total_deposit }}"
                                            data-withdraw="{{ $account->total_withdraw }}"
                                            data-transfer_to_other="{{ $account->total_transfer_to_others }}"
                                            data-transfer_from_other="{{ $account->total_transfer_from_others }}">
                                            {{ $account->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Account balance  --}}
                            <div class="mt-2 col-md-6">
                                <label for="account_balance" class="form-label fw-bold">Account Balance</label>
                                <input type="text" class="form-control" placeholder="Enter account balance"
                                    name="from_account_balance" id="account_balance" readonly>
                            </div>

                            {{-- Expense Category --}}
                            <div class="mt-2 col-md-6">
                                <label for="expense_category_id" class="form-label fw-bold">Expense Category</label>
                                <select class="form-control" name="expense_category_id" required>
                                    <option selected disabled value="">Select Expense Category</option>
                                    @foreach ($expense_categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Withdraw Amount --}}
                            <div class="mt-2 col-md-6">
                                <label for="amount" class="form-label fw-bold">Withdraw Amount</label>
                                <input type="number" class="form-control" min="1" step="any"
                                    placeholder="Enter Withdraw Amount" name="withdraw_amount" required>
                            </div>

                            {{-- Reference No --}}
                            <div class="mt-2 col-md-6">
                                <label for="reference_no" class="form-label fw-bold">Reference No</label>
                                <input type="text" class="form-control" placeholder="Enter reference no"
                                    name="reference_no" required>
                            </div>

                            {{-- Details --}}
                            <div class="mt-2 col-md-6">
                                <label for="details" class="form-label fw-bold">Details</label>
                                <input type="text" class="form-control" placeholder="Enter details" name="details"
                                    required>
                            </div>

                            {{-- Submit Button --}}
                            <div class="mt-2 col-md-12">
                                @if (check_permission('accounting.withdraw-store'))
                                    <button class="btn btn-primary" type="submit">Save</button>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('backend') }}/js/bank-transfer.js"></script>
@endpush
