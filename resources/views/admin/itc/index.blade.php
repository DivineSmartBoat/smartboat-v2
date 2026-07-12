@extends('layouts.app')

@section('title', 'ITC List')

@section('content')

<div class="container-fluid py-4">

    <div class="card shadow-sm border-0">

        <div class="card-header bg-white">

            <div class="d-flex justify-content-between align-items-center flex-wrap">

                <div>
                    <h3 class="mb-1">
                        Independent Travel Consultant (ITC)
                    </h3>

                    <small class="text-muted">
                        SmartBoat Ecosistem Private Limited
                    </small>
                </div>

<div class="text-end">

    <h5 class="mb-0">
        Total ITC :
        <span class="badge bg-primary">
            {{ $itcs->total() }}
        </span>
    </h5>

</div>

</div>

</div>

<div class="card-body">

<form id="itcSearchForm" method="GET" action="{{ route('itc.index') }}">

    <div class="row g-2 mb-4">

        <div class="col-lg-3">
            <input
                type="text"
                name="smart_id"
                value="{{ request('smart_id') }}"
                class="form-control"
                placeholder="Search Smart ID">
        </div>

        <div class="col-lg-3">
            <input
                type="text"
                name="name"
                value="{{ request('name') }}"
                class="form-control"
                placeholder="Search ITC Name">
        </div>

        <div class="col-lg-2">
            <input
                type="text"
                name="mobile"
                value="{{ request('mobile') }}"
                class="form-control"
                placeholder="Mobile">
        </div>

        <div class="col-lg-2">
            <select
                name="status"
                class="form-select">

                <option value="">All Status</option>

                <option value="Active"
                    {{ request('status')=='Active' ? 'selected' : '' }}>
                    Active
                </option>

                <option value="Inactive"
                    {{ request('status')=='Inactive' ? 'selected' : '' }}>
                    Inactive
                </option>

            </select>
        </div>

        <div class="col-lg-2 d-grid">
            <button type="submit" class="btn btn-primary">
                Search
            </button>
        </div>

    </div>

</form>

<div class="mb-3 d-flex gap-2 flex-wrap">

    <button type="submit" form="itcSearchForm" class="btn btn-primary">
        Search
    </button>

    <a href="{{ route('itc.index') }}" class="btn btn-secondary">
        Reset
    </a>

    <button type="button" class="btn btn-success">
        Excel
    </button>

    <button type="button" class="btn btn-danger">
        PDF
    </button>

    <button type="button" class="btn btn-dark">
        Print
    </button>

</div>


            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-dark">

                    <tr>

                        <th width="60">

                            SL

                        </th>

                        <th>

                            Smart ID

                        </th>

                        <th>

                            ITC Name

                        </th>

                        <th>

                            Mobile

                        </th>

                        <th>

                            Status

                        </th>

                        <th>

                            Smart Qty

                        </th>

                        <th>

                            Price

                        </th>

                        <th>

                            Purchase

                        </th>

                        <th>

                            Total Price

                        </th>

                        <th>

                            Entry D&T

                        </th>

                        <th>

                            First Purchase D&T

                        </th>

                        <th>

                            Last Purchase D&T

                        </th>

                        <th>

                            Action

                        </th>

                    </tr>

                    </thead>

                    <tbody>

@forelse($itcs as $key => $itc)

<tr>

    <td>
        {{ $itcs->firstItem() + $key }}
    </td>

    <td>
        {{ $itc->smart_id }}
    </td>

    <td>
        {{ $itc->full_name }}
    </td>

    <td>
        {{ $itc->mobile }}
    </td>

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

    <td>
        {{ $itc->total_quantity ?? 0 }}
    </td>

    <td>
        ₹ {{ number_format($itc->price ?? 0,2) }}
    </td>

    <td>
        {{ $itc->purchase_count ?? 0 }}
    </td>

    <td>
        ₹ {{ number_format($itc->total_purchase_amount ?? 0,2) }}
    </td>

    <td>
        {{ $itc->registration_datetime ?? '-' }}
    </td>

    <td>
        {{ $itc->first_purchase_datetime ?? '-' }}
    </td>

    <td>
        {{ $itc->last_purchase_datetime ?? '-' }}
    </td>

    <td>
        <a href="{{ route('itc.show',$itc->smart_id) }}"
           class="btn btn-sm btn-primary">
            View
        </a>
    </td>

</tr>

@empty

<tr>
    <td colspan="13" class="text-center py-5">
        No ITC Found
    </td>
</tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

            <div class="mt-4">

                {{ $itcs->links() }}

            </div>

        </div>

    </div>

</div>

@endsection