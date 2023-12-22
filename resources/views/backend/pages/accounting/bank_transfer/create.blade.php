@extends('backend.layouts.master')
@section('section-title', 'Bank Transfer')
@section('page-title', 'Create')

@if (check_permission('accounting.bank-transfers-list'))
    @section('action-button')
        <a href="{{ url('bank-transfers-list') }}" class="btn btn-primary-rgba">
            <i class="mr-2 feather icon-list"></i>
            Bank Transfer List
        </a>
    @endsection
@endif

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Bank Transfer</h5>
                </div>
                <div class="card-body">
                    <div class="border rounded">
                        <form class="row g-3 needs-validation" method="POST" action="{{ url('bank-transfer') }}"
                            enctype="multipart/form-data" novalidate>
                            @csrf
                            {{-- From Account --}}
                            <div class="mt-2 col-md-6">
                                <label for="from_account" class="form-label fw-bold">From Account</label>
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

                            {{-- From Account Balance --}}
                            <div class="mt-2 col-md-6">
                                <label for="from_account_balance" class="form-label fw-bold">From Account Balance</label>
                                <input type="text" class="form-control" placeholder="Enter account balance"
                                    name="from_account_balance" id="from_account_balance" readonly>
                            </div>

                            {{-- To Account --}}
                            <div class="mt-2 col-md-6">
                                <label for="to_account" class="form-label fw-bold">To Account</label>
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

                            {{-- To Account Balance --}}
                            <div class="mt-2 col-md-6">
                                <label for="to_account_balance" class="form-label fw-bold">To Account Balance</label>
                                <input type="text" class="form-control" placeholder="Enter account balance"
                                    name="to_account_balance" id="to_account_balance" readonly>
                            </div>

                            {{-- Transfer Amount --}}
                            <div class="mt-2 col-md-6">
                                <label for="amount" class="form-label fw-bold">Transfer Amount</label>
                                <input type="number" class="form-control" min="1" step="any"
                                    placeholder="Enter Transfer Amount" name="transfer_amount" required>
                            </div>

                            {{-- Reference No --}}
                            <div class="col-md-6">
                                <label for="reference_no" class="form-label fw-bold">Reference No</label>
                                <input type="text" class="form-control" placeholder="Enter reference no"
                                    name="reference_no" required>
                            </div>

                            {{-- Details --}}
                            <div class="col-md-12">
                                <label for="details" class="form-label fw-bold">Details</label>
                                <input type="text" class="form-control" placeholder="Enter details" name="details"
                                    required>
                            </div>

                            {{-- Submit Button --}}
                            <div class="mt-2 col-md-12">
                                @if (check_permission('accounting.bank-transfer-store'))
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
