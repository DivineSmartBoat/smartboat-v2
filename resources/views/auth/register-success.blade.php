@extends('layouts.app')

@section('title', 'Registration Successful')

@section('content')

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-xl-8 col-lg-9">

            <div class="card shadow-lg border-0 rounded-4">

                <div class="card-body p-5">

                    <div class="text-center mb-5">

                        <div
                            class="rounded-circle bg-success bg-opacity-10
                            d-inline-flex align-items-center justify-content-center"
                            style="width:90px;height:90px;">

                            <span
                                style="font-size:42px;"
                                class="text-success">
                                ✓
                            </span>

                        </div>

                        <h2 class="fw-bold mt-4 mb-2">

                            Welcome to our SmartBoat Family

                        </h2>

                        <p class="text-muted mb-0">

                            Registration Successful

                        </p>

                    </div>

                    <div
                        class="alert alert-success border-success rounded-4">

                        <div class="fw-bold">

                            Congratulations!

                        </div>

                        <div>

                            Your Smart Account has been created
                            successfully.

                        </div>

                    </div>

                    <div class="card border-success rounded-4 mt-4">

                        <div class="card-header bg-success text-white">

                            Account Information

                        </div>

                        <div class="card-body">

                            <div class="row mb-4">

                                <div class="col-md-4 fw-bold">

                                    Smart ID

                                </div>

                                <div class="col-md-8">

                                    <div class="input-group">

                                        <input
                                            id="smartId"
                                            class="form-control"
                                            type="text"
                                            readonly
                                            value="{{ session('smart_id') }}">

                                        <button
                                            class="btn btn-outline-success"
                                            type="button"
                                            onclick="copyField('smartId')">

                                            Copy

                                        </button>

                                    </div>

                                </div>

                            </div>
<div class="row mb-4">

    <div class="col-md-4 fw-bold">

        Sponsor

    </div>

    <div class="col-md-8">

        <strong>

            {{ session('real_sponsor_name') }}

        </strong>

        <br>

        <small class="text-muted">

            {{ session('real_sponsor_smart_id') }}

        </small>

    </div>

</div>

<div class="row mb-4">

    <div class="col-md-4 fw-bold">

        Rising Sponsor

    </div>

    <div class="col-md-8">

        <strong>

            {{ session('rising_sponsor_name') }}

        </strong>

        <br>

        <small class="text-muted">

            {{ session('rising_sponsor_smart_id') }}

        </small>

    </div>

</div>

                            <div class="row mb-4">

                                <div class="col-md-4 fw-bold">

                                    Login Password

                                </div>

                                <div class="col-md-8">

                                    <div class="input-group">

                                        <input
                                            id="loginPassword"
                                            type="password"
                                            class="form-control"
                                            readonly
                                            value="{{ session('login_password') }}">

                                        <button
                                            class="btn btn-outline-secondary"
                                            type="button"
                                            id="loginEye">

                                            👁

                                        </button>

                                        <button
                                            class="btn btn-outline-success"
                                            type="button"
                                            onclick="copyField('loginPassword')">

                                            Copy

                                        </button>

                                    </div>

                                </div>

                            </div>

                            <div class="row mb-4">

                                <div class="col-md-4 fw-bold">

                                    Transaction Password

                                </div>

                                <div class="col-md-8">

                                    <div class="input-group">

                                        <input
                                            id="transactionPassword"
                                            type="password"
                                            class="form-control"
                                            readonly
                                            value="{{ session('transaction_password') }}">

                                        <button
                                            class="btn btn-outline-secondary"
                                            type="button"
                                            id="transactionEye">

                                            👁

                                        </button>

                                        <button
                                            class="btn btn-outline-success"
                                            type="button"
                                            onclick="copyField('transactionPassword')">

                                            Copy

                                        </button>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                     <div class="text-center mt-5">

                        <a
                            href="{{ route('login') }}"
                            class="btn btn-success btn-lg px-5">

                            Login Now

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<script>

function copyField(id)
{
    const field = document.getElementById(id);

    field.type = 'text';

    field.select();

    document.execCommand('copy');

    field.type =
        (id === 'smartId')
            ? 'text'
            : 'password';
}

function enablePressHold(buttonId, inputId)
{
    const button = document.getElementById(buttonId);

    const input = document.getElementById(inputId);

    const show = () => input.type = 'text';

    const hide = () => input.type = 'password';

    button.addEventListener('mousedown', show);

    button.addEventListener('mouseup', hide);

    button.addEventListener('mouseleave', hide);

    button.addEventListener('touchstart', show);

    button.addEventListener('touchend', hide);
}

enablePressHold(
    'loginEye',
    'loginPassword'
);

enablePressHold(
    'transactionEye',
    'transactionPassword'
);

</script>

@endsection