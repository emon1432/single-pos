@extends('backend.layouts.master')
@section('section-title', 'Update Bank Account')
@section('page-title', 'Update')

@if (check_permission('bank-accounts.index'))
    @section('action-button')
        <a href="{{ url('bank-accounts') }}" class="btn btn-primary-rgba">
            <i class="mr-2 feather icon-list"></i>
            Bank Accounts
        </a>
    @endsection
@endif

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Update Bank Account</h5>
                </div>
                <div class="card-body">
                    <div class="border rounded">
                        <form class="row g-3 needs-validation" method="POST"
                            action="{{ url('bank-accounts/' . $bank_account->id) }}" enctype="multipart/form-data"
                            novalidate>
                            @csrf
                            @method('PUT')
                            {{-- Account name --}}
                            <div class="mt-2 col-md-12">
                                <label for="name" class="form-label fw-bold">Account Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Enter account name"
                                    required value="{{ $bank_account->name }}">
                            </div>

                            {{-- Account number  --}}
                            <div class="mt-2 col-md-6">
                                <label for="account_number" class="form-label fw-bold">Account Number</label>
                                <input type="text" class="form-control" placeholder="Enter account number"
                                    name="account_number" required value="{{ $bank_account->account_number }}">
                            </div>

                            {{-- Bank name --}}
                            <div class="mt-2 col-md-6">
                                <label for="bank_name" class="form-label fw-bold">Bank Name</label>
                                <input type="text" class="form-control" placeholder="Enter bank name" name="bank_name"
                                    required value="{{ $bank_account->bank_name }}">
                            </div>

                            {{-- Branch name --}}
                            <div class="mt-2 col-md-6">
                                <label for="branch_name" class="form-label fw-bold">Branch Name</label>
                                <input type="text" class="form-control" placeholder="Enter branch name"
                                    name="branch_name" required value="{{ $bank_account->branch_name }}">
                            </div>

                            {{-- Contact Person --}}
                            <div class="mt-2 col-md-6">
                                <label for="contact_person" class="form-label fw-bold">Contact Person</label>
                                <input type="text" class="form-control" placeholder="Enter contact person name"
                                    name="contact_person" required value="{{ $bank_account->contact_person }}">
                            </div>

                            {{-- Contact Number --}}
                            <div class="mt-2 col-md-6">
                                <label for="contact_number" class="form-label fw-bold">Contact Number</label>
                                <input type="text" class="form-control" placeholder="Enter contact number"
                                    name="contact_number" required value="{{ $bank_account->contact_number }}">
                            </div>
                            {{-- Email --}}
                            <div class="mt-2 col-md-6">
                                <label for="email" class="form-label fw-bold">Email</label>
                                <input type="email" class="form-control" placeholder="Enter email" name="email" required
                                    value="{{ $bank_account->email }}">
                            </div>
                            {{-- Internal Banking URL --}}
                            <div class="mt-2 col-md-6">
                                <label for="url" class="form-label fw-bold">Internal Banking URL</label>
                                <input type="text" class="form-control" placeholder="Enter internal banking url"
                                    name="url" value="{{ $bank_account->url }}">
                            </div>
                            {{-- Status --}}
                            <div class="mt-2 col-md-6">
                                <label for="status" class="form-label fw-bold">Status</label>
                                <select class="form-control" name="status">
                                    <option selected disabled value="">Select Status</option>
                                    <option value="1" {{ $bank_account->status == 1 ? 'selected' : '' }}>Active
                                    </option>
                                    <option value="0" {{ $bank_account->status == 0 ? 'selected' : '' }}>Inactive
                                    </option>
                                </select>
                            </div>
                            {{-- Details --}}
                            <div class="mt-2 col-md-12">
                                <label for="details" class="form-label fw-bold">Details</label>
                                <textarea class="form-control" name="details" rows="3">{{ $bank_account->details }}</textarea>
                            </div>
                            {{-- Branch Address --}}
                            <div class="mt-2 col-md-12">
                                <label for="address" class="form-label fw-bold">Branch Address</label>
                                <textarea class="form-control" name="branch_address" rows="3">{{ $bank_account->branch_address }}</textarea>
                            </div>
                            {{-- Submit Button --}}
                            <div class="mt-2 col-md-12">
                                @if (check_permission('bank-accounts.update'))
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
