@extends('layouts.app')

@section('content')

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card shadow-lg border-0 rounded-4">

                <div class="card-body p-5">

                    <h2 class="fw-bold mb-4">
                        Create Smart Account
                    </h2>

                    <p class="text-muted mb-4">
                        Welcome to our SmartBoat Family
                    </p>

                    <form method="POST" action="{{ route('register.store') }}">

                        @csrf

                        <div class="mb-3">

                            <label class="form-label">
                                Sponsor
                            </label>

                            <select class="form-select">
                                <option>I Have a Sponsor</option>
                                <option>I Don't Have a Sponsor</option>
                            </select>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Sponsor Search
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                placeholder="Search by Smart ID or Name">

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Full Name
                            </label>

                            <input
                                type="text"
                                class="form-control">

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Email
                            </label>

                            <input
                                type="email"
                                class="form-control">

                        </div>

                        <div class="row">

                            <div class="col-md-6">

                                <div class="mb-3">

                                    <label class="form-label">

                                        Country Code

                                    </label>

                                    <select class="form-select">

                                        <option>+91 India</option>

                                    </select>

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="mb-3">

                                    <label class="form-label">

                                        Mobile

                                    </label>

                                    <input
                                        class="form-control">

                                </div>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-6">

                                <div class="mb-3">

                                    <label class="form-label">

                                        Age

                                    </label>

                                    <input
                                        type="date"
                                        class="form-control">

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="mb-3">

                                    <label class="form-label">

                                        Gender

                                    </label>

                                    <select class="form-select">

                                        <option>Male</option>

                                        <option>Female</option>

                                        <option>Other</option>

                                    </select>

                                </div>

                            </div>

                        </div>

                        <div class="form-check mb-4">

                            <input
                                class="form-check-input"
                                type="checkbox">

                            <label class="form-check-label">

                                I Agree Terms & Conditions

                            </label>

                        </div>

                        <button
                            class="btn btn-success btn-lg w-100">

                            Register & Proceed

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection