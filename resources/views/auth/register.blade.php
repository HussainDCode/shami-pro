<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ShamPro – Create Your Account</title>

    <!-- Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" />
    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" />
    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Manrope:wght@200..800&family=Montez&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="assets/css/style2.css">
</head>

<body>

    <!-- ANIMATED BG -->
    <div class="bg-canvas">
        <div class="bg-grid"></div>
        <div class="bg-blob bg-blob-1"></div>
        <div class="bg-blob bg-blob-2"></div>
        <div class="bg-blob bg-blob-3"></div>
    </div>

    <div class="page-wrap">
        <!-- LOGO -->
        <a href="{{ url('/') }}" class="site-logo" style="text-decoration:none;color:inherit">
            <div class="logo-icon"><i class="bi bi-compass"></i></div>
            <div class="logo-text">Sham<span>Pro</span></div>
        </a>

        @if ($errors->any())
            <div class="alert alert-danger mx-auto mb-3" style="max-width:860px;border-radius:16px">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- FORM CARD -->
        <div class="form-card">
            <!-- HEADER -->
            <div class="card-header-top">
                <p class="step-badge" id="globalStepBadge">Step <span id="globalStepNum">1</span> of <span
                        id="globalStepTotal">5</span></p>
                <h1 id="stepTitle">Create Your Account</h1>
                <p id="stepSubtitle">Join the world's most trusted travel marketplace.</p>
            </div>

            <!-- PROGRESS BAR -->
            <div class="progress-mini">
                <div class="progress-mini-inner" id="progressBar" style="width:20%"></div>
            </div>

            <!-- STEPS NAV (for business / buyer respective step counts) -->
            <div class="steps-wrap" id="stepsWrap">
                <div class="steps-inner" id="stepsInner">
                    <!-- injected by JS -->
                </div>
            </div>

            <!-- FORM BODY -->
            <div class="form-body">
                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" id="registerForm">
                    @csrf
                    <input type="hidden" name="account_type" id="accountTypeInput" value="">

                    <!-- ============================
           STEP 0 : Account Type
      ============================= -->
                    <div class="wizard-step active" id="step-0">
                        <div class="section-heading">
                            <h2><span class="sh-icon"><i class="bi bi-person-gear"></i></span>Who are you?</h2>
                            <p>Select your account type to get started.</p>
                        </div>

                        <div class="type-selector">
                            <div class="type-card" id="tc-business" onclick="selectType('business')">
                                <div class="tc-check"><i class="bi bi-check"></i></div>
                                <div class="tc-icon"><i class="bi bi-briefcase"></i></div>
                                <h3>Business Owner</h3>
                                <p>Register your business and list your services on Now.</p>
                            </div>
                            <div class="type-card" id="tc-buyer" onclick="selectType('buyer')">
                                <div class="tc-check"><i class="bi bi-check"></i></div>
                                <div class="tc-icon"><i class="bi bi-person-heart"></i></div>
                                <h3>Buyer</h3>
                                <p>Book Items, packages and experiences with verified providers.</p>
                            </div>
                        </div>

                        <div class="form-nav">
                            <div></div>
                            <button type="button" class="btn-next" onclick="goNext()">
                                Continue <i class="bi bi-arrow-right"></i>
                            </button>
                        </div>
                    </div>

                    <!-- ============================
           STEP 1 : Personal Info
      ============================= -->
                    <div class="wizard-step" id="step-1">
                        <div class="section-heading">
                            <h2><span class="sh-icon"><i class="bi bi-person"></i></span>Personal Information</h2>
                            <p>Tell us a bit about yourself.</p>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="field-group">
                                    <label><i class="bi bi-person-fill"></i> First Name <span
                                            class="text-danger">*</span></label>
                                    <div class="input-icon-wrap">
                                        <i class="bi bi-person icon-prefix"></i>
                                        <input type="text" class="form-control" id="firstName" name="first_name"
                                            value="{{ old('first_name') }}" placeholder="John" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="field-group">
                                    <label><i class="bi bi-person-fill"></i> Last Name <span
                                            class="text-danger">*</span></label>
                                    <div class="input-icon-wrap">
                                        <i class="bi bi-person icon-prefix"></i>
                                        <input type="text" class="form-control" id="lastName" name="last_name"
                                            value="{{ old('last_name') }}" placeholder="Doe" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="field-group">
                                    <label><i class="bi bi-at"></i> Username <span
                                            class="text-danger">*</span></label>
                                    <div class="input-icon-wrap">
                                        <i class="bi bi-at icon-prefix"></i>
                                        <input type="text" class="form-control" id="username" name="username"
                                            value="{{ old('username') }}" placeholder="john.doe" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="field-group">
                                    <label><i class="bi bi-envelope-fill"></i> Email Address <span
                                            class="text-danger">*</span></label>
                                    <div class="input-icon-wrap">
                                        <i class="bi bi-envelope icon-prefix"></i>
                                        <input type="email" class="form-control" id="email" name="email"
                                            value="{{ old('email') }}" placeholder="john@example.com" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="field-group">
                                    <label><i class="bi bi-telephone-fill"></i> Phone Number <span
                                            class="text-danger">*</span></label>
                                    <div class="input-icon-wrap">
                                        <i class="bi bi-telephone icon-prefix"></i>
                                        <input type="tel" class="form-control" id="phone" name="phone"
                                            value="{{ old('phone') }}" placeholder="+1 234 567 8900" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="field-group">
                                    <label><i class="bi bi-globe"></i> Website</label>
                                    <div class="input-icon-wrap">
                                        <i class="bi bi-globe icon-prefix"></i>
                                        <input type="url" class="form-control" id="website" name="website"
                                            value="{{ old('website') }}" placeholder="https://yoursite.com">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="field-group">
                                    <label><i class="bi bi-gender-ambiguous"></i> Gender <span
                                            class="text-danger">*</span></label>
                                    <div class="fancy-radio-group" id="genderGroup">
                                        <label class="fancy-radio" onclick="selectFancyRadio(this,'genderGroup')">
                                            <input type="radio" name="gender" value="male"
                                                {{ old('gender') == 'male' ? 'checked' : '' }}><span
                                                class="fr-dot"></span>
                                            Male
                                        </label>
                                        <label class="fancy-radio" onclick="selectFancyRadio(this,'genderGroup')">
                                            <input type="radio" name="gender" value="female"
                                                {{ old('gender') == 'female' ? 'checked' : '' }}><span
                                                class="fr-dot"></span>
                                            Female
                                        </label>
                                        <label class="fancy-radio" onclick="selectFancyRadio(this,'genderGroup')">
                                            <input type="radio" name="gender" value="other"
                                                {{ old('gender') == 'other' ? 'checked' : '' }}><span
                                                class="fr-dot"></span>
                                            Other
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="field-group">
                                    <label><i class="bi bi-calendar-fill"></i> Date of Birth <span
                                            class="text-danger">*</span></label>
                                    <div class="input-icon-wrap">
                                        <i class="bi bi-calendar icon-prefix"></i>
                                        <input type="date" class="form-control" id="dob"
                                            name="date_of_birth" value="{{ old('date_of_birth') }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="field-group">
                                    <label><i class="bi bi-flag-fill"></i> Nationality <span
                                            class="text-danger">*</span></label>
                                    <div class="field-group" style="margin-bottom:0">
                                        <select class="form-select" id="nationality" name="nationality" required
                                            data-old="{{ e(old('nationality')) }}">
                                            <option value="">Select nationality</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="field-group">
                                    <label><i class="bi bi-camera-fill"></i> Profile Picture</label>
                                    <div class="upload-box"
                                        onclick="document.getElementById('profilePicInput').click()"
                                        id="profilePicBox">
                                        <input type="file" id="profilePicInput" name="profile_picture"
                                            accept="image/*" onchange="previewUpload(this,'profilePicBox')">
                                        <i class="bi bi-person-circle"></i>
                                        <p>Click to upload your profile photo</p>
                                        <span>JPG, PNG, GIF up to 5MB</span>
                                        <div class="upload-preview" id="profilePicPreview"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-nav">
                            <button type="button" class="btn-prev" onclick="goPrev()"><i
                                    class="bi bi-arrow-left"></i>
                                Back</button>
                            <button type="button" class="btn-next" onclick="goNext()">Next <i
                                    class="bi bi-arrow-right"></i></button>
                        </div>
                    </div>

                    <!-- ============================
           STEP 2 : Address Info
      ============================= -->
                    <div class="wizard-step" id="step-2">
                        <div class="section-heading">
                            <h2><span class="sh-icon"><i class="bi bi-geo-alt"></i></span>Address Details</h2>
                            <p>Help us locate you on the map.</p>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="field-group">
                                    <label><i class="bi bi-geo"></i> Country <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select" id="country" name="country"
                                        onchange="updateCitiesByCountry()" required
                                        data-old="{{ e(old('country')) }}">
                                        <option value="">Select country</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="field-group">
                                    <label><i class="bi bi-buildings"></i> City <span
                                            class="text-danger">*</span></label>
                                    <div class="custom-select-wrap">
                                        <div class="city-selected-display" id="cityDisplay"
                                            onclick="toggleCityDropdown()">
                                            <span>Select city</span>
                                            <i class="bi bi-chevron-down"></i>
                                        </div>
                                        <div class="city-dropdown" id="cityDropdown">
                                            <div class="city-search">
                                                <i class="bi bi-search"></i>
                                                <input type="text" id="citySearchInput"
                                                    placeholder="Search city..." oninput="filterCities(this.value)">
                                            </div>
                                            <div class="city-list" id="cityList"></div>
                                        </div>
                                        <input type="hidden" id="cityValue" name="city">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="field-group">
                                    <label><i class="bi bi-mailbox"></i> Postal Code</label>
                                    <div class="input-icon-wrap">
                                        <i class="bi bi-mailbox icon-prefix"></i>
                                        <input type="text" class="form-control" id="postalCode"
                                            name="postal_code" value="{{ old('postal_code') }}" placeholder="12345">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="field-group">
                                    <label><i class="bi bi-signpost"></i> Landmark</label>
                                    <div class="input-icon-wrap">
                                        <i class="bi bi-signpost icon-prefix"></i>
                                        <input type="text" class="form-control" id="landmark" name="landmark"
                                            value="{{ old('landmark') }}" placeholder="Near Central Park...">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="field-group">
                                    <label><i class="bi bi-house-fill"></i> Full Address <span
                                            class="text-danger">*</span></label>
                                    <div class="input-icon-wrap">
                                        <i class="bi bi-house icon-prefix"></i>
                                        <input type="text" class="form-control" id="address" name="address"
                                            value="{{ old('address') }}" placeholder="123 Main St, Apt 4B" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-nav">
                            <button type="button" class="btn-prev" onclick="goPrev()"><i
                                    class="bi bi-arrow-left"></i>
                                Back</button>
                            <button type="button" class="btn-next" onclick="goNext()">Next <i
                                    class="bi bi-arrow-right"></i></button>
                        </div>
                    </div>

                    <!-- ============================
           STEP 3 : ID Verification
      ============================= -->
                    <div class="wizard-step" id="step-3">
                        <div class="section-heading">
                            <h2><span class="sh-icon"><i class="bi bi-shield-check"></i></span>Identity Verification
                            </h2>
                            <p>Upload a government-issued ID card for verification.</p>
                        </div>

                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="field-group">
                                    <label><i class="bi bi-card-heading"></i> ID Card – Front Side <span
                                            class="text-danger">*</span></label>
                                    <div class="upload-box" onclick="document.getElementById('idFrontInput').click()"
                                        id="idFrontBox">
                                        <input type="file" id="idFrontInput" name="id_front" accept="image/*"
                                            onchange="previewUpload(this,'idFrontBox')">
                                        <i class="bi bi-credit-card-2-front"></i>
                                        <p>Upload front of ID card</p>
                                        <span>JPG, PNG, PDF · Max 10MB</span>
                                        <div class="upload-preview" id="idFrontPreview"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="field-group">
                                    <label><i class="bi bi-credit-card-2-back"></i> ID Card – Back Side <span
                                            class="text-danger">*</span></label>
                                    <div class="upload-box" onclick="document.getElementById('idBackInput').click()"
                                        id="idBackBox">
                                        <input type="file" id="idBackInput" name="id_back" accept="image/*"
                                            onchange="previewUpload(this,'idBackBox')">
                                        <i class="bi bi-credit-card-2-back"></i>
                                        <p>Upload back of ID card</p>
                                        <span>JPG, PNG, PDF · Max 10MB</span>
                                        <div class="upload-preview" id="idBackPreview"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Business owner only: business registration proof -->
                            <div class="col-12" id="bizProofSection" style="display:none">
                                <div class="fancy-divider">
                                    <hr><span>Business Documents</span>
                                    <hr>
                                </div>
                                <div class="field-group">
                                    <label><i class="bi bi-file-earmark-check-fill"></i> Business Registration Proof
                                        <span class="text-danger">*</span></label>
                                    <div class="upload-box" onclick="document.getElementById('bizProofInput').click()"
                                        id="bizProofBox">
                                        <input type="file" id="bizProofInput" name="biz_proof"
                                            accept="image/*,.pdf" onchange="previewUpload(this,'bizProofBox')">
                                        <i class="bi bi-file-earmark-text"></i>
                                        <p>Upload your business registration certificate or trade license</p>
                                        <span>JPG, PNG, PDF · Max 20MB</span>
                                        <div class="upload-preview" id="bizProofPreview"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-nav">
                            <button type="button" class="btn-prev" onclick="goPrev()"><i
                                    class="bi bi-arrow-left"></i>
                                Back</button>
                            <button type="button" class="btn-next" onclick="goNext()">Next <i
                                    class="bi bi-arrow-right"></i></button>
                        </div>
                    </div>

                    <!-- ============================
           STEP 4 : Password
      ============================= -->
                    <div class="wizard-step" id="step-4">
                        <div class="section-heading">
                            <h2><span class="sh-icon"><i class="bi bi-lock"></i></span>Secure Your Account</h2>
                            <p>Create a strong password to protect your account.</p>
                        </div>

                        <div class="row g-3">
                            <div class="col-12">
                                <div class="field-group">
                                    <label><i class="bi bi-lock-fill"></i> Create Password <span
                                            class="text-danger">*</span></label>
                                    <div class="input-icon-wrap">
                                        <i class="bi bi-lock icon-prefix"></i>
                                        <input type="password" class="form-control" id="password" name="password"
                                            placeholder="Min 8 characters" oninput="checkPasswordStrength(this.value)"
                                            required>
                                        <i class="bi bi-eye icon-suffix"
                                            onclick="togglePassword('password',this)"></i>
                                    </div>
                                    <div class="pw-strength" id="pwBars">
                                        <div class="pw-bar" id="bar1"></div>
                                        <div class="pw-bar" id="bar2"></div>
                                        <div class="pw-bar" id="bar3"></div>
                                        <div class="pw-bar" id="bar4"></div>
                                    </div>
                                    <div style="font-size:11.5px;color:var(--body-color);margin-top:5px" id="pwLabel">
                                        Enter a
                                        password to check strength</div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="field-group">
                                    <label><i class="bi bi-lock-fill"></i> Confirm Password <span
                                            class="text-danger">*</span></label>
                                    <div class="input-icon-wrap">
                                        <i class="bi bi-lock icon-prefix"></i>
                                        <input type="password" class="form-control" id="confirmPassword"
                                            name="password_confirmation" placeholder="Re-enter your password"
                                            required>
                                        <i class="bi bi-eye icon-suffix"
                                            onclick="togglePassword('confirmPassword',this)"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div
                                    style="background:rgba(28, 168, 203, .1);border-radius:var(--radius-sm);padding:14px 18px;font-size:13px;color:var(--theme-color)">
                                    <i class="bi bi-info-circle me-2"></i>
                                    Password must be at least 8 characters and include uppercase, lowercase, number and
                                    special character.
                                </div>
                            </div>
                        </div>

                        <div class="form-nav">
                            <button type="button" class="btn-prev" onclick="goPrev()"><i
                                    class="bi bi-arrow-left"></i>
                                Back</button>
                            <button type="button" class="btn-next" onclick="goNext()">Next <i
                                    class="bi bi-arrow-right"></i></button>
                        </div>
                    </div>

                    <!-- ============================
           STEP 5 : Payment
      ============================= -->
                    <div class="wizard-step" id="step-5">
                        <div class="section-heading">
                            <h2><span class="sh-icon"><i class="bi bi-credit-card"></i></span>Registration Payment
                            </h2>
                            <p>A one-time fee is required to activate your account.</p>
                        </div>

                        <!-- Amount Banner -->
                        <div style="text-align:center;margin-bottom:20px">
                            <div class="amount-badge">
                                <i class="bi bi-cash-coin"></i>
                                Registration Fee: <strong>$1.00 USD</strong>
                            </div>
                            <div style="font-size:13px;color:var(--body-color)">One-time non-refundable registration fee.
                            </div>
                        </div>

                        <!-- Account Details -->
                        <div class="payment-box">
                            <h4><i class="bi bi-bank2 me-2"></i>Transfer to Our Account</h4>
                            <p>Send $1.00 to the account below and upload your transaction slip.</p>

                            <div class="account-detail-row">
                                <i class="bi bi-bank"></i>
                                <div>
                                    <div class="ad-label">Bank Name</div>
                                    <div class="ad-value">First National Travel Bank</div>
                                </div>
                            </div>
                            <div class="account-detail-row">
                                <i class="bi bi-hash"></i>
                                <div>
                                    <div class="ad-label">Account Number</div>
                                    <div class="ad-value">1234 5678 9012 3456</div>
                                </div>
                            </div>
                            <div class="account-detail-row">
                                <i class="bi bi-person-badge"></i>
                                <div>
                                    <div class="ad-label">Account Holder</div>
                                    <div class="ad-value">ShamPro Marketplace Ltd.</div>
                                </div>
                            </div>
                            <div class="account-detail-row">
                                <i class="bi bi-upc"></i>
                                <div>
                                    <div class="ad-label">IBAN / Routing</div>
                                    <div class="ad-value">GB29 NWBK 6016 1331 9268 19</div>
                                </div>
                            </div>
                            <div class="account-detail-row">
                                <i class="bi bi-telephone-fill"></i>
                                <div>
                                    <div class="ad-label">Mobile Payment (PayNow / JazzCash)</div>
                                    <div class="ad-value">+1 800 ShamPro 00</div>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Method -->
                        <div class="field-group">
                            <label><i class="bi bi-wallet2"></i> Payment Method Used</label>
                            <div class="fancy-radio-group" id="payMethodGroup">
                                <label class="fancy-radio" onclick="selectFancyRadio(this,'payMethodGroup')">
                                    <input type="radio" name="payment_method" value="bank"><span
                                        class="fr-dot"></span><i class="bi bi-bank"></i> Bank Transfer
                                </label>
                                <label class="fancy-radio" onclick="selectFancyRadio(this,'payMethodGroup')">
                                    <input type="radio" name="payment_method" value="card"><span
                                        class="fr-dot"></span><i class="bi bi-credit-card"></i> Card
                                </label>
                                <label class="fancy-radio" onclick="selectFancyRadio(this,'payMethodGroup')">
                                    <input type="radio" name="payment_method" value="mobile"><span
                                        class="fr-dot"></span><i class="bi bi-phone"></i> Mobile Payment
                                </label>
                            </div>
                        </div>

                        <!-- Card Info (conditionally shown) -->
                        <div id="cardInfoSection" style="display:none">
                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="field-group">
                                        <label><i class="bi bi-credit-card-fill"></i> Card Number</label>
                                        <div class="input-icon-wrap">
                                            <i class="bi bi-credit-card icon-prefix"></i>
                                            <input type="text" class="form-control" id="cardNumber"
                                                placeholder="1234 5678 9012 3456" maxlength="19"
                                                oninput="formatCard(this)">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="field-group">
                                        <label><i class="bi bi-calendar3"></i> Expiry Date</label>
                                        <div class="input-icon-wrap">
                                            <i class="bi bi-calendar icon-prefix"></i>
                                            <input type="text" class="form-control" id="cardExpiry"
                                                placeholder="MM/YY" maxlength="5" oninput="formatExpiry(this)">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="field-group">
                                        <label><i class="bi bi-shield-lock"></i> CVV <span class="form-tooltip"
                                                title="3-4 digit code on back of card">?</span></label>
                                        <div class="input-icon-wrap">
                                            <i class="bi bi-lock icon-prefix"></i>
                                            <input type="password" class="form-control" id="cardCvv"
                                                placeholder="•••" maxlength="4">
                                            <i class="bi bi-eye icon-suffix"
                                                onclick="togglePassword('cardCvv',this)"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="field-group">
                                        <label><i class="bi bi-person-fill"></i> Cardholder Name</label>
                                        <div class="input-icon-wrap">
                                            <i class="bi bi-person icon-prefix"></i>
                                            <input type="text" class="form-control" id="cardName"
                                                placeholder="John Doe">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Transaction Slip Upload -->
                        <div class="field-group" id="slipSection">
                            <label><i class="bi bi-receipt"></i> Upload Transaction Slip / Screenshot <span
                                    class="text-danger">*</span></label>
                            <div class="upload-box" onclick="document.getElementById('txSlipInput').click()"
                                id="txSlipBox">
                                <input type="file" id="txSlipInput" name="payment_slip" accept="image/*,.pdf"
                                    onchange="previewUpload(this,'txSlipBox')">
                                <i class="bi bi-receipt-cutoff"></i>
                                <p>Upload proof of your $1.00 payment</p>
                                <span>JPG, PNG, PDF · Max 10MB</span>
                                <div class="upload-preview" id="txSlipPreview"></div>
                            </div>
                        </div>

                        <div class="field-group">
                            <label><i class="bi bi-hash"></i> Transaction / Reference ID</label>
                            <div class="input-icon-wrap">
                                <i class="bi bi-hash icon-prefix"></i>
                                <input type="text" class="form-control" id="txRef" name="transaction_ref"
                                    value="{{ old('transaction_ref') }}" placeholder="e.g. TXN12345678">
                            </div>
                        </div>

                        <div class="form-nav">
                            <button type="button" class="btn-prev" onclick="goPrev()"><i
                                    class="bi bi-arrow-left"></i>
                                Back</button>
                            <button type="button" class="btn-next" onclick="submitForm()">
                                <i class="bi bi-check2-circle"></i> Submit Registration
                            </button>
                        </div>
                    </div>

                    <!-- Success step removed - Laravel handles redirect after registration -->

                    <!-- ============================
           SUCCESS SCREEN (kept for JS ref, hidden)
      ============================= -->
                    <div class="wizard-step" id="step-success" style="display:none">
                        <div class="success-screen">
                            <div class="success-animation"><i class="bi bi-check-lg"></i></div>
                            <h2>Registration Submitted!</h2>
                            <p>
                                Thank you for joining <strong class="text-teal">ShamPro</strong>! Your registration is
                                under
                                review.
                                We'll verify your documents and payment within <strong>24-48 hours</strong> and send a
                                confirmation to your email.
                            </p>
                            <a href="{{ url('/') }}" class="btn-next"
                                style="display:inline-flex;text-decoration:none">
                                <i class="bi bi-house"></i> Back to Home
                            </a>
                        </div>
                    </div>

                </form>
            </div><!-- /form-body -->
        </div><!-- /form-card -->
    </div><!-- /page-wrap -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    <script>
        /* ============================================================
                       DATA
                    ============================================================ */
        const COUNTRIES = [
            "Afghanistan", "Albania", "Algeria", "Andorra", "Angola", "Antigua and Barbuda", "Argentina",
            "Armenia", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados",
            "Belarus", "Belgium", "Belize", "Benin", "Bhutan", "Bolivia", "Bosnia and Herzegovina", "Botswana",
            "Brazil", "Brunei", "Bulgaria", "Burkina Faso", "Burundi", "Cabo Verde", "Cambodia", "Cameroon",
            "Canada", "Central African Republic", "Chad", "Chile", "China", "Colombia", "Comoros",
            "Congo (Brazzaville)", "Congo (DRC)", "Costa Rica", "Croatia", "Cuba", "Cyprus", "Czech Republic",
            "Denmark", "Djibouti", "Dominica", "Dominican Republic", "Ecuador", "Egypt", "El Salvador",
            "Equatorial Guinea", "Eritrea", "Estonia", "Eswatini", "Ethiopia", "Fiji", "Finland", "France",
            "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Greece", "Grenada", "Guatemala", "Guinea",
            "Guinea-Bissau", "Guyana", "Haiti", "Honduras", "Hungary", "Iceland", "India", "Indonesia", "Iran",
            "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati",
            "Kuwait", "Kyrgyzstan", "Laos", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libya", "Liechtenstein",
            "Lithuania", "Luxembourg", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta",
            "Marshall Islands", "Mauritania", "Mauritius", "Mexico", "Micronesia", "Moldova", "Monaco",
            "Mongolia", "Montenegro", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal",
            "Netherlands", "New Zealand", "Nicaragua", "Niger", "Nigeria", "North Korea", "North Macedonia",
            "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines",
            "Poland", "Portugal", "Qatar", "Romania", "Russia", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia",
            "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Saudi Arabia", "Senegal", "Serbia",
            "Seychelles", "Sierra Leone", "Singapore", "Slovakia", "Slovenia", "Solomon Islands", "Somalia",
            "South Africa", "South Korea", "South Sudan", "Spain", "Sri Lanka", "Sudan", "Suriname", "Sweden",
            "Switzerland", "Syria", "Taiwan", "Tajikistan", "Tanzania", "Thailand", "Timor-Leste", "Togo",
            "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Tuvalu", "Uganda", "Ukraine",
            "United Arab Emirates", "United Kingdom", "United States", "Uruguay", "Uzbekistan", "Vanuatu",
            "Vatican City", "Venezuela", "Vietnam", "Yemen", "Zambia", "Zimbabwe"
        ];

        // World Cities list (representative subset with many major cities)
        const ALL_CITIES = [
            "Abu Dhabi", "Abuja", "Accra", "Addis Ababa", "Adelaide", "Agra", "Ahmedabad", "Alexandria",
            "Algiers", "Almaty", "Amman", "Amsterdam", "Anchorage", "Ankara", "Antananarivo", "Antwerp",
            "Apia", "Athens", "Atlanta", "Auckland", "Baghdad", "Baku", "Bangalore", "Bangkok", "Barcelona",
            "Basel", "Beirut", "Belgrade", "Belo Horizonte", "Berlin", "Bishkek", "Bogota", "Bologna",
            "Brisbane", "Brussels", "Bucharest", "Budapest", "Buenos Aires", "Cairo", "Calgary", "Canberra",
            "Cape Town", "Caracas", "Casablanca", "Chennai", "Chengdu", "Chicago", "Chongqing", "Colombo",
            "Copenhagen", "Dakar", "Dallas", "Damascus", "Dar es Salaam", "Delhi", "Denver", "Dhaka",
            "Doha", "Dubai", "Dublin", "Durban", "Edinburgh", "Florence", "Frankfurt", "Geneva", "Glasgow",
            "Guangzhou", "Guatemala City", "Guayaquil", "Hamburg", "Hanoi", "Harare", "Helsinki", "Ho Chi Minh City",
            "Hong Kong", "Houston", "Hyderabad", "Islamabad", "Istanbul", "Jakarta", "Jeddah", "Jerusalem",
            "Johannesburg", "Kabul", "Kampala", "Karachi", "Kathmandu", "Khartoum", "Kinshasa", "Kolkata",
            "Kuala Lumpur", "Kuwait City", "Lagos", "Lahore", "La Paz", "Lima", "Lisbon", "London",
            "Los Angeles", "Luanda", "Lusaka", "Lyon", "Madrid", "Manama", "Manila", "Maputo", "Marseille",
            "Melbourne", "Mexico City", "Miami", "Milan", "Minneapolis", "Minsk", "Mogadishu", "Montevideo",
            "Montreal", "Moscow", "Mumbai", "Muscat", "Nairobi", "Naples", "Nassau", "New York", "Niamey",
            "Nicosia", "Oslo", "Ottawa", "Ouagadougou", "Panama City", "Paris", "Perth", "Phnom Penh",
            "Porto", "Prague", "Pretoria", "Quito", "Rabat", "Riyadh", "Rio de Janeiro", "Rome", "Rosario",
            "San Francisco", "San José", "Santiago", "Santo Domingo", "São Paulo", "Seattle", "Seoul",
            "Shanghai", "Shenzhen", "Singapore", "Sofia", "Stockholm", "Surabaya", "Sydney", "Taipei",
            "Tashkent", "Tehran", "Tel Aviv", "Tbilisi", "Tokyo", "Toronto", "Tunis", "Ulaanbaatar",
            "Vancouver", "Vienna", "Vilnius", "Warsaw", "Washington D.C.", "Wellington", "Yangon", "Yerevan",
            "Zagreb", "Zurich"
        ];

        /* ============================================================
           WIZARD STATE
        ============================================================ */
        let accountType = null; // 'business' | 'buyer'
        let currentStep = 0; // 0 = type select
        const TOTAL_STEPS = 6; // steps 0-5 + success

        const STEP_META = {
            0: {
                title: "Create Your Account",
                sub: "Join the world's most trusted marketplace.",
                icon: "bi-compass"
            },
            1: {
                title: "Personal Information",
                sub: "Tell us a bit about yourself.",
                icon: "bi-person"
            },
            2: {
                title: "Address Details",
                sub: "Help us locate you on the map.",
                icon: "bi-geo-alt"
            },
            3: {
                title: "Identity Verification",
                sub: "Upload a government-issued ID for verification.",
                icon: "bi-shield-check"
            },
            4: {
                title: "Secure Your Account",
                sub: "Create a strong password.",
                icon: "bi-lock"
            },
            5: {
                title: "Registration Payment",
                sub: "Complete payment to activate your account.",
                icon: "bi-credit-card"
            },
        };

        const STEP_LABELS = ["Account Type", "Personal Info", "Address", "ID Verification", "Password", "Payment"];

        /* ============================================================
           INIT
        ============================================================ */
        window.addEventListener('DOMContentLoaded', () => {
            populateCountries();
            populateNationality();
            const countrySel = document.getElementById('country');
            const natSel = document.getElementById('nationality');
            if (countrySel.dataset.old) countrySel.value = countrySel.dataset.old;
            if (natSel.dataset.old) natSel.value = natSel.dataset.old;
            renderSteps();
            updateUI();
            initPaymentMethodListener();

            // Close city dropdown on outside click
            document.addEventListener('click', e => {
                const wrap = document.querySelector('.custom-select-wrap');
                if (wrap && !wrap.contains(e.target)) closeCityDropdown();
            });
        });

        /* ============================================================
           COUNTRIES & NATIONALITY
        ============================================================ */
        function populateCountries() {
            const sel = document.getElementById('country');
            COUNTRIES.forEach(c => {
                const opt = document.createElement('option');
                opt.value = c;
                opt.textContent = c;
                sel.appendChild(opt);
            });
        }

        function populateNationality() {
            const sel = document.getElementById('nationality');
            COUNTRIES.forEach(c => {
                const opt = document.createElement('option');
                opt.value = c;
                opt.textContent = c;
                sel.appendChild(opt);
            });
        }

        /* ============================================================
           CITY DROPDOWN
        ============================================================ */
        let selectedCity = '';

        function updateCitiesByCountry() {
            renderCityList(ALL_CITIES);
            document.getElementById('cityDisplay').innerHTML = '<span>Select city</span><i class="bi bi-chevron-down"></i>';
            selectedCity = '';
            document.getElementById('cityValue').value = '';
        }

        function toggleCityDropdown() {
            const dd = document.getElementById('cityDropdown');
            const display = document.getElementById('cityDisplay');
            const isOpen = dd.classList.contains('open');
            if (isOpen) {
                closeCityDropdown();
            } else {
                dd.classList.add('open');
                display.classList.add('open');
                renderCityList(ALL_CITIES);
                document.getElementById('citySearchInput').value = '';
                setTimeout(() => document.getElementById('citySearchInput').focus(), 50);
            }
        }

        function closeCityDropdown() {
            document.getElementById('cityDropdown').classList.remove('open');
            document.getElementById('cityDisplay').classList.remove('open');
        }

        function filterCities(val) {
            const filtered = ALL_CITIES.filter(c => c.toLowerCase().includes(val.toLowerCase()));
            renderCityList(filtered);
        }

        function renderCityList(cities) {
            const list = document.getElementById('cityList');
            if (!cities.length) {
                list.innerHTML = '<div class="city-empty">No cities found</div>';
                return;
            }
            list.innerHTML = cities.map(c =>
                `<div class="city-opt${c === selectedCity ? ' selected' : ''}" onclick="selectCity('${c}')">${c}</div>`
            ).join('');
        }

        function selectCity(city) {
            selectedCity = city;
            document.getElementById('cityValue').value = city;
            const d = document.getElementById('cityDisplay');
            d.innerHTML = `${city} <i class="bi bi-chevron-down"></i>`;
            closeCityDropdown();
        }

        /* ============================================================
           TYPE SELECTION
        ============================================================ */
        function selectType(type) {
            accountType = type;
            document.getElementById('accountTypeInput').value = type;
            document.getElementById('tc-business').classList.toggle('selected', type === 'business');
            document.getElementById('tc-buyer').classList.toggle('selected', type === 'buyer');
            // show/hide biz proof section
            document.getElementById('bizProofSection').style.display = type === 'business' ? 'block' : 'none';
        }

        /* ============================================================
           FANCY RADIO
        ============================================================ */
        function selectFancyRadio(el, groupId) {
            document.querySelectorAll(`#${groupId} .fancy-radio`).forEach(r => r.classList.remove('selected'));
            el.classList.add('selected');
            const inp = el.querySelector('input[type="radio"]');
            if (inp) inp.checked = true;
        }

        /* ============================================================
           STEPS RENDER
        ============================================================ */
        function renderSteps() {
            const inner = document.getElementById('stepsInner');
            inner.innerHTML = STEP_LABELS.map((label, i) => {
                let cls = '';
                if (i < currentStep) cls = 'done';
                else if (i === currentStep) cls = 'active';
                const icon = i < currentStep ? '<i class="bi bi-check"></i>' : (i + 1);
                return `<div class="step-item ${cls}" id="stepItem${i}">
      <div class="step-circle">${icon}</div>
      <div class="step-label">${label}</div>
    </div>`;
            }).join('');
        }

        function updateStepClasses() {
            STEP_LABELS.forEach((_, i) => {
                const el = document.getElementById('stepItem' + i);
                if (!el) return;
                el.className = 'step-item';
                if (i < currentStep) el.classList.add('done');
                else if (i === currentStep) el.classList.add('active');
                const circle = el.querySelector('.step-circle');
                if (i < currentStep) circle.innerHTML = '<i class="bi bi-check"></i>';
                else circle.innerHTML = (i + 1);
            });
        }

        /* ============================================================
           UI UPDATE
        ============================================================ */
        function updateUI() {
            const meta = STEP_META[currentStep] || {};
            document.getElementById('stepTitle').textContent = meta.title || '';
            document.getElementById('stepSubtitle').textContent = meta.sub || '';
            document.getElementById('globalStepNum').textContent = currentStep + 1;
            document.getElementById('globalStepTotal').textContent = STEP_LABELS.length;

            // Progress bar
            const pct = Math.round(((currentStep + 1) / STEP_LABELS.length) * 100);
            document.getElementById('progressBar').style.width = pct + '%';

            updateStepClasses();
        }

        /* ============================================================
           NAVIGATION
        ============================================================ */
        function showStep(n) {
            document.querySelectorAll('.wizard-step').forEach(s => s.classList.remove('active'));
            const target = document.getElementById('step-' + n) || document.getElementById('step-success');
            if (target) target.classList.add('active');
        }

        function goPrev() {
            if (currentStep > 0) {
                currentStep--;
                showStep(currentStep);
                updateUI();
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            }
        }

        function goNext() {
            if (!validateStep(currentStep)) return;
            currentStep++;
            showStep(currentStep);
            updateUI();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        function submitForm() {
            if (!validateStep(currentStep)) return;
            document.getElementById('accountTypeInput').value = accountType || '';
            document.getElementById('registerForm').submit();
        }

        /* ============================================================
           VALIDATION (basic)
        ============================================================ */
        function validateStep(step) {
            clearErrors();
            if (step === 0) {
                if (!accountType) {
                    alert('Please select an account type to continue.');
                    return false;
                }
            }
            if (step === 1) {
                if (!v('firstName')) {
                    showError('firstName', 'First name is required');
                    return false;
                }
                if (!v('lastName')) {
                    showError('lastName', 'Last name is required');
                    return false;
                }
                if (!v('username')) {
                    showError('username', 'Username is required');
                    return false;
                }
                if (!v('email') || !document.getElementById('email').value.includes('@')) {
                    showError('email', 'Valid email is required');
                    return false;
                }
                if (!v('phone')) {
                    showError('phone', 'Phone number is required');
                    return false;
                }
                if (!document.querySelector('#genderGroup .fancy-radio.selected')) {
                    alert('Please select your gender.');
                    return false;
                }
                if (!v('dob')) {
                    showError('dob', 'Date of birth is required');
                    return false;
                }
                if (!document.getElementById('nationality').value) {
                    showSelectError('nationality', 'Nationality is required');
                    return false;
                }
            }
            if (step === 2) {
                if (!document.getElementById('country').value) {
                    showSelectError('country', 'Country is required');
                    return false;
                }
                if (!document.getElementById('cityValue').value) {
                    document.getElementById('cityDisplay').classList.add('is-invalid');
                    return false;
                }
                if (!v('address')) {
                    showError('address', 'Address is required');
                    return false;
                }
            }
            if (step === 4) {
                const pw = document.getElementById('password').value;
                const cpw = document.getElementById('confirmPassword').value;
                if (pw.length < 8) {
                    showError('password', 'Password must be at least 8 characters');
                    return false;
                }
                if (pw !== cpw) {
                    showError('confirmPassword', 'Passwords do not match');
                    return false;
                }
            }
            return true;
        }

        function v(id) {
            return document.getElementById(id)?.value?.trim() !== '';
        }

        function showError(id, msg) {
            const el = document.getElementById(id);
            if (el) {
                el.classList.add('is-invalid');
                const err = document.createElement('div');
                err.className = 'field-error';
                err.innerHTML = `<i class="bi bi-exclamation-circle"></i>${msg}`;
                el.parentNode.appendChild(err);
            }
        }

        function showSelectError(id, msg) {
            const el = document.getElementById(id);
            if (el) {
                el.classList.add('is-invalid');
                const err = document.createElement('div');
                err.className = 'field-error';
                err.innerHTML = `<i class="bi bi-exclamation-circle"></i>${msg}`;
                el.parentNode.appendChild(err);
            }
        }

        function clearErrors() {
            document.querySelectorAll('.field-error').forEach(e => e.remove());
            document.querySelectorAll('.is-invalid').forEach(e => e.classList.remove('is-invalid'));
        }

        /* ============================================================
           FILE UPLOAD PREVIEW
        ============================================================ */
        function previewUpload(input, boxId) {
            const box = document.getElementById(boxId);
            const previewId = boxId.replace('Box', 'Preview');
            const preview = document.getElementById(previewId);
            const file = input.files[0];
            if (!file) return;

            box.style.borderColor = 'var(--theme-color)';
            box.style.background = 'rgba(28, 168, 203, .1)';

            if (!preview) return;
            preview.style.display = 'block';

            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = e => {
                    preview.innerHTML =
                        `<img src="${e.target.result}" alt="preview"><div class="up-name">${file.name}</div>`;
                };
                reader.readAsDataURL(file);
            } else {
                preview.innerHTML =
                    `<div style="font-size:13px;color:var(--theme-color);padding:8px"><i class="bi bi-file-earmark-check me-2"></i>${file.name}</div>`;
            }
        }

        /* ============================================================
           PASSWORD
        ============================================================ */
        function togglePassword(id, iconEl) {
            const inp = document.getElementById(id);
            if (!inp) return;
            const show = inp.type === 'password';
            inp.type = show ? 'text' : 'password';
            iconEl.className = show ? 'bi bi-eye-slash icon-suffix' : 'bi bi-eye icon-suffix';
        }

        function checkPasswordStrength(val) {
            const bars = [document.getElementById('bar1'), document.getElementById('bar2'), document.getElementById('bar3'),
                document.getElementById('bar4')
            ];
            const label = document.getElementById('pwLabel');
            bars.forEach(b => {
                b.className = 'pw-bar';
            });

            if (!val) {
                label.textContent = 'Enter a password to check strength';
                return;
            }

            let score = 0;
            if (val.length >= 8) score++;
            if (/[A-Z]/.test(val)) score++;
            if (/[0-9]/.test(val)) score++;
            if (/[^A-Za-z0-9]/.test(val)) score++;

            const cls = score <= 1 ? 'weak' : score === 2 ? 'medium' : score === 3 ? 'medium' : 'strong';
            const text = score <= 1 ? '🔴 Weak' : score === 2 ? '🟡 Fair' : score === 3 ? '🟡 Good' : '🟢 Strong';

            for (let i = 0; i < score; i++) bars[i].classList.add(cls);
            label.textContent = text;
            label.style.color = cls === 'weak' ? '#ef4444' : cls === 'medium' ? '#f59e0b' : '#10b981';
        }

        /* ============================================================
           PAYMENT FORM
        ============================================================ */
        function initPaymentMethodListener() {
            document.querySelectorAll('[name="payment_method"]').forEach(inp => {
                inp.addEventListener('change', () => {
                    const isCard = inp.value === 'card';
                    document.getElementById('cardInfoSection').style.display = isCard ? 'block' : 'none';
                });
            });
        }

        function formatCard(input) {
            let v = input.value.replace(/\D/g, '').substring(0, 16);
            input.value = v.match(/.{1,4}/g)?.join(' ') || v;
        }

        function formatExpiry(input) {
            let v = input.value.replace(/\D/g, '');
            if (v.length >= 3) v = v.substring(0, 2) + '/' + v.substring(2, 4);
            input.value = v;
        }

        /* ============================================================
           DRAG & DROP for upload boxes
        ============================================================ */
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.upload-box').forEach(box => {
                box.addEventListener('dragover', e => {
                    e.preventDefault();
                    box.style.borderColor = 'var(--theme-color)';
                });
                box.addEventListener('dragleave', () => {
                    box.style.borderColor = 'var(--gray-color)';
                });
                box.addEventListener('drop', e => {
                    e.preventDefault();
                    const inp = box.querySelector('input[type="file"]');
                    if (inp && e.dataTransfer.files.length) {
                        inp.files = e.dataTransfer.files;
                        previewUpload(inp, box.id);
                    }
                });
            });
        });
    </script>
</body>

</html>
