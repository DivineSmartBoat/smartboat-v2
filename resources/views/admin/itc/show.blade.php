@extends('layouts.app')

@section('title','ITC Profile')

@section('content')

<div class="container-fluid py-4">

    <div class="card shadow border-0">

        <div class="card-header bg-primary text-white">

            <div class="d-flex justify-content-between align-items-center">

                <h4 class="mb-0">

                    Independent Travel Consultant (ITC)

                </h4>

                <a href="{{ route('itc.index') }}"
                   class="btn btn-light btn-sm">

                    Back

                </a>

            </div>

        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-lg-6">

                    <table class="table table-bordered">

                        <tr>

                            <th width="35%">

                                Smart ID

                            </th>

                            <td>

                                {{ $itc->smart_id }}

                            </td>

                        </tr>

                        <tr>

                            <th>

                                ITC Name

                            </th>

                            <td>

                                {{ $itc->full_name }}

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Mobile

                            </th>

                            <td>

                                {{ $itc->mobile }}

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Email

                            </th>

                            <td>

                                {{ $itc->email }}

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Status

                            </th>

                            <td>

@if($itc->status == 'Active')

    <span class="badge bg-success">
        Active
    </span>

@else

    <span class="badge bg-danger">
        Inactive
    </span>

@endif

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Entry D&T

                            </th>

                            <td>

                                {{ $itc->registration_datetime }}

                            </td>

                        </tr>

                    </table>

                </div>

                <div class="col-lg-6">

                    <table class="table table-bordered">

                        <tr>

                            <th width="40%">

                                Real Sponsor

                            </th>

                            <td>

                                {{ $itc->real_sponsor_smart_id ?? '-' }}

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Rising Sponsor

                            </th>

                            <td>

                                {{ $itc->rising_sponsor_smart_id ?? '-' }}

                            </td>

                        </tr>

                        <tr>

                            <th>

                                First Purchase D&T

                            </th>

                            <td>

                                {{ $itc->first_purchase_datetime ?? '-' }}

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Last Purchase D&T

                            </th>

                            <td>

                                {{ $itc->last_purchase_datetime ?? '-' }}

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Purchase Count

                            </th>

                            <td>

                                {{ $purchases->count() }}

                            </td>

                        </tr>

                        <tr>

                            <th>

                                Total Price

                            </th>

                            <td>

                                ₹ {{ number_format($purchases->sum('amount'),2) }}

                            </td>

                        </tr>

                    </table>

                </div>

            </div>

            <hr>

            <div class="d-flex gap-2 mb-3">

                <button class="btn btn-success">

                    Excel

                </button>

                <button class="btn btn-danger">

                    PDF

                </button>

                <button class="btn btn-dark">

                    Print

                </button>

            </div>

            <div class="table-responsive">

                <table class="table table-bordered table-hover">

                    <thead class="table-dark">

                    <tr>

                        <th>SL</th>

                        <th>Invoice</th>

                        <th>Product</th>

                        <th>Purpose</th>

                        <th>Smart Qty</th>

                        <th>Price</th>

                        <th>Purchase D&T</th>

                        <th>Status</th>

                    </tr>

                    </thead>

                    <tbody>

                    @forelse($purchases as $key=>$purchase)

                    <tr>

                        <td>

                            {{ $key+1 }}

                        </td>

                        <td>

                            {{ $purchase->invoice_no }}

                        </td>

                        <td>

                            {{ $purchase->product_name }}

                        </td>

                        <td>

                            {{ $purchase->purpose }}

                        </td>

                        <td>

                            {{ $purchase->qty }}

                        </td>

                        <td>

                            ₹ {{ number_format($purchase->amount,2) }}

                        </td>

                        <td>

                            {{ $purchase->purchase_datetime }}

                        </td>

                        <td>

                            {{ $purchase->payment_status }}

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="8"
                            class="text-center">

                            No Purchase Found

                        </td>

                    </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection