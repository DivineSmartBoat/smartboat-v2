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

<div id="selectedSponsorCard" class="card border-success mt-3 d-none shadow-sm">
    <div class="card-body">
        <small class="text-success fw-bold">
            Selected Sponsor
        </small>

        <div id="selectedSponsorInfo" class="mt-2"></div>
    </div>
</div>
                            @error('sponsor_smart_id')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

 <div class="mb-3">
    <label for="full_name" class="form-label">
        Full Name
    </label>

    <input
        id="full_name"
        name="full_name"
        type="text"
        maxlength="100"
        autocomplete="name"
        placeholder="Enter Full Name"
        class="form-control @error('full_name') is-invalid @enderror"
        value="{{ old('full_name') }}"
        required>

    @error('full_name')
        <div class="invalid-feedback d-block">
            {{ $message }}
        </div>
    @enderror
</div>

 <div class="mb-3">
    <label for="email" class="form-label">
        Email Address
    </label>

    <input
        id="email"
        name="email"
        type="email"
        autocomplete="email"
        placeholder="Enter Email Address"
        class="form-control @error('email') is-invalid @enderror"
        value="{{ old('email') }}"
        required>

    @error('email')
        <div class="invalid-feedback d-block">
            {{ $message }}
        </div>
    @enderror
</div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="country_code" class="form-label">Country Code</label>
<select
    id="country_code"
    name="country_code"
    class="form-select @error('country_code') is-invalid @enderror"
    required>

    <option value="">Select Country Code</option>

    <option value="+91" @selected(old('country_code')=='+91')>
        🇮🇳 India (+91)
    </option>

    <option value="+880" @selected(old('country_code')=='+880')>
        🇧🇩 Bangladesh (+880)
    </option>

    <option value="+1" @selected(old('country_code')=='+1')>
        🇺🇸 United States (+1)
    </option>

    <option value="+44" @selected(old('country_code')=='+44')>
        🇬🇧 United Kingdom (+44)
    </option>

    <option value="+971" @selected(old('country_code')=='+971')>
        🇦🇪 UAE (+971)
    </option>

    <option value="+966" @selected(old('country_code')=='+966')>
        🇸🇦 Saudi Arabia (+966)
    </option>

    <option disabled>
        ─────────────────────
    </option>

    <option disabled>
        🌍 Full World Country List (Coming in Next Sprint)
    </option>

</select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
<label for="mobile" class="form-label">
    Mobile Number
</label>

<input
    id="mobile"
    name="mobile"
    type="tel"
    inputmode="numeric"
    maxlength="15"
    autocomplete="tel"
    placeholder="Enter Mobile Number"
    class="form-control @error('mobile') is-invalid @enderror"
    value="{{ old('mobile') }}"
    required>

@error('mobile')
<div class="invalid-feedback d-block">
    {{ $message }}
</div>
@enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
    <label for="date_of_birth" class="form-label">
        Date of Birth
    </label>

    <input
        id="date_of_birth"
        name="date_of_birth"
        type="date"
        max="{{ now()->subDay()->format('Y-m-d') }}"
        class="form-control @error('date_of_birth') is-invalid @enderror"
        value="{{ old('date_of_birth') }}">

    @error('date_of_birth')
    <div class="invalid-feedback d-block">
        {{ $message }}
    </div>
    @enderror
</div>
    
                            </div>
                            <div class="col-md-6">
<div class="mb-3">
    <label for="gender" class="form-label">
        Gender
    </label>

    <select
        id="gender"
        name="gender"
        class="form-select @error('gender') is-invalid @enderror"
        required>

        <option value="">Select Gender</option>
        <option value="Male" @selected(old('gender') === 'Male')>Male</option>
        <option value="Female" @selected(old('gender') === 'Female')>Female</option>
        <option value="Other" @selected(old('gender') === 'Other')>Other</option>

    </select>

    @error('gender')
    <div class="invalid-feedback d-block">
        {{ $message }}
    </div>
 @enderror
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

    const sponsorCard =
        document.getElementById('selectedSponsorCard');

    const sponsorInfo =
        document.getElementById('selectedSponsorInfo');

    if (withSponsor) {

        sponsorCard.classList.add('d-none');

        sponsorInfo.innerHTML = '';

        sponsorSmartId.value = '';

        sponsorSearch.value = '';

        sponsorResults.innerHTML = '';

    } else {

        sponsorCard.classList.remove('d-none');

        sponsorInfo.innerHTML = `
            <div class="fw-bold text-success">
                Admin
            </div>

            <div>
                Sponsor will be assigned automatically.
            </div>
        `;

        sponsorSmartId.value = '';

        sponsorSearch.value = 'Admin (Auto Placement)';

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
 <button
    class="list-group-item list-group-item-action"
    type="button"
    data-smart-id="${member.smart_id}"
    data-name="${member.full_name}">

    <div class="fw-bold">
        ${member.full_name}
    </div>

    <div>
        Smart ID :
        ${member.smart_id}
    </div>

    <small class="text-muted">
        ${member.mobile ?? ''}
    </small>

</button>
    `).join('');
});

sponsorResults.addEventListener('click', (event) => {

    const button = event.target.closest('button[data-smart-id]');

    if (!button) {
        return;
    }

    sponsorSmartId.value = button.dataset.smartId;

    sponsorSearch.value =
        `${button.dataset.smartId} - ${button.dataset.name}`;

    sponsorResults.innerHTML = '';

    const sponsorCard =
        document.getElementById('selectedSponsorCard');

    const sponsorInfo =
        document.getElementById('selectedSponsorInfo');

    sponsorCard.classList.remove('d-none');

    sponsorInfo.innerHTML = `
        <div class="fw-bold">${button.dataset.name}</div>
        <div>Smart ID : ${button.dataset.smartId}</div>
    `;
});
</script>
@endsection
