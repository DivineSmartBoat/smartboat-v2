@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-5">
                    <div class="d-flex flex-column flex-md-row justify-content-between gap-3 mb-4">
                        <div>
                            <h2 class="fw-bold mb-2">Create Smart Account</h2>
                            <p class="text-muted mb-0">Welcome to our SmartBoat Family</p>
                        </div>
                        <a class="btn btn-outline-success align-self-md-start" href="{{ route('login') }}">Already registered? Login</a>
                    </div>

                    @if (session('status'))
                        <div class="alert alert-success">{{ session('status') }}</div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="sponsor_type" class="form-label">Sponsor</label>
                            <select id="sponsor_type" name="sponsor_type" class="form-select @error('sponsor_type') is-invalid @enderror">
                                <option value="with_sponsor" @selected(old('sponsor_type', 'with_sponsor') === 'with_sponsor')>I Have a Sponsor</option>
                                <option value="without_sponsor" @selected(old('sponsor_type') === 'without_sponsor')>I Don't Have a Sponsor</option>
                            </select>
                        </div>

                        <div class="mb-3" id="sponsor-search-wrap">
                            <label for="sponsor_search" class="form-label">Sponsor Search</label>
                            <input id="sponsor_search" type="text" class="form-control" placeholder="Search by Smart ID or Name" autocomplete="off">
                            <input id="sponsor_smart_id" type="hidden" name="sponsor_smart_id" value="{{ old('sponsor_smart_id') }}">
                            <div id="sponsor_results" class="list-group mt-2"></div>
                            @error('sponsor_smart_id')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="full_name" class="form-label">Full Name</label>
                            <input id="full_name" name="full_name" type="text" class="form-control @error('full_name') is-invalid @enderror" value="{{ old('full_name') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="country_code" class="form-label">Country Code</label>
                                    <select id="country_code" name="country_code" class="form-select @error('country_code') is-invalid @enderror">
                                        <option value="+91" @selected(old('country_code', '+91') === '+91')>+91 India</option>
                                        <option value="+880" @selected(old('country_code') === '+880')>+880 Bangladesh</option>
                                        <option value="+1" @selected(old('country_code') === '+1')>+1 USA/Canada</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="mobile" class="form-label">Mobile</label>
                                    <input id="mobile" name="mobile" type="text" class="form-control @error('mobile') is-invalid @enderror" value="{{ old('mobile') }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="date_of_birth" class="form-label">Date of Birth</label>
                                    <input id="date_of_birth" name="date_of_birth" type="date" class="form-control @error('date_of_birth') is-invalid @enderror" value="{{ old('date_of_birth') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select id="gender" name="gender" class="form-select @error('gender') is-invalid @enderror" required>
                                        <option value="">Select Gender</option>
                                        <option value="Male" @selected(old('gender') === 'Male')>Male</option>
                                        <option value="Female" @selected(old('gender') === 'Female')>Female</option>
                                        <option value="Other" @selected(old('gender') === 'Other')>Other</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input id="password" name="password" type="password" class="form-control @error('password') is-invalid @enderror" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                                    <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="transaction_password" class="form-label">Transaction Password</label>
                                    <input id="transaction_password" name="transaction_password" type="password" class="form-control @error('transaction_password') is-invalid @enderror" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="transaction_password_confirmation" class="form-label">Confirm Transaction Password</label>
                                    <input id="transaction_password_confirmation" name="transaction_password_confirmation" type="password" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-check mb-4">
                            <input id="terms" name="terms" value="1" class="form-check-input @error('terms') is-invalid @enderror" type="checkbox" @checked(old('terms')) required>
                            <label for="terms" class="form-check-label">I Agree Terms & Conditions</label>
                        </div>

                        <button class="btn btn-success btn-lg w-100" type="submit">Register & Proceed</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
const sponsorType = document.getElementById('sponsor_type');
const sponsorWrap = document.getElementById('sponsor-search-wrap');
const sponsorSearch = document.getElementById('sponsor_search');
const sponsorSmartId = document.getElementById('sponsor_smart_id');
const sponsorResults = document.getElementById('sponsor_results');

function toggleSponsorSearch() {
    const withSponsor = sponsorType.value === 'with_sponsor';
    sponsorWrap.style.display = withSponsor ? 'block' : 'none';
    if (!withSponsor) {
        sponsorSmartId.value = '';
        sponsorSearch.value = '';
        sponsorResults.innerHTML = '';
    }
}

sponsorType.addEventListener('change', toggleSponsorSearch);
toggleSponsorSearch();

sponsorSearch.addEventListener('input', async () => {
    sponsorSmartId.value = '';
    sponsorResults.innerHTML = '';

    const keyword = sponsorSearch.value.trim();
    if (keyword.length < 2) {
        return;
    }

    const response = await fetch(`{{ route('api.sponsor.search') }}?keyword=${encodeURIComponent(keyword)}`);
    const members = await response.json();

    sponsorResults.innerHTML = members.map((member) => `
        <button class="list-group-item list-group-item-action" type="button" data-smart-id="${member.smart_id}" data-name="${member.full_name}">
            <strong>${member.smart_id}</strong> - ${member.full_name}<br>
            <small>${member.mobile ?? ''} ${member.email ?? ''}</small>
        </button>
    `).join('');
});

sponsorResults.addEventListener('click', (event) => {
    const button = event.target.closest('button[data-smart-id]');
    if (!button) {
        return;
    }

    sponsorSmartId.value = button.dataset.smartId;
    sponsorSearch.value = `${button.dataset.smartId} - ${button.dataset.name}`;
    sponsorResults.innerHTML = '';
});
</script>
@endsection
