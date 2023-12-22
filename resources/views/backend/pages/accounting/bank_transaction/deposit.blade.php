@extends('backend.layouts.master')
@section('section-title', 'Deposit To Bank')
@section('page-title', 'Deposit')

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
                    <h5 class="card-title">Deposit to Bank Account</h5>
                </div>
                <div class="card-body">
                    <div class="border rounded">
                        <form class="row g-3 needs-validation" method="POST" action="{{ url('deposit') }}"
                            enctype="multipart/form-data" novalidate>
                            @csrf
                            {{-- Account name --}}
                            <div class="mt-2 col-md-6">
                                <label for="name" class="form-label fw-bold">Select Account</label>
                                <select class="form-control" name="to_account" required>
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

                            {{-- Account number  --}}
                            <div class="mt-2 col-md-6">
                                <label for="account_balance" class="form-label fw-bold">Account Balance</label>
                                <input type="text" class="form-control" placeholder="Enter account balance"
                                    name="to_account_balance" id="account_balance" readonly>
                            </div>

                            {{-- Income Source --}}
                            <div class="mt-2 col-md-6">
                                <label for="income_source_id" class="form-label fw-bold">Income Source</label>
                                <select class="form-control" name="income_source_id" required>
                                    <option selected disabled value="">Select Income Source</option>
                                    @foreach ($income_sources as $source)
                                        <option value="{{ $source->id }}">{{ $source->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Deposit Amount --}}
                            <div class="mt-2 col-md-6">
                                <label for="amount" class="form-label fw-bold">Deposit Amount</label>
                                <input type="number" class="form-control" min="1" step="any"
                                    placeholder="Enter Deposit Amount" name="deposit_amount" required>
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
                                @if (check_permission('accounting.deposit-store'))
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
