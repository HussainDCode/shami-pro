<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ShamPro – Sign In</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" />
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Manrope:wght@200..800&family=Montez&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style2.css">
</head>

<body>
    <div class="auth-layout">

        <!-- LEFT PANEL -->
        <div class="auth-left">
            <div class="left-mesh">
                <div class="mesh-circle mc1"></div>
                <div class="mesh-circle mc2"></div>
                <div class="mesh-circle mc3"></div>
            </div>
            <div class="left-grid"></div>
            <div class="left-floaters">
                <div class="floater f1">
                    <div class="f-icon"><i class="bi bi-star-fill"></i></div>
                    <div class="f-label">Traveler Rating</div>
                    <div class="f-val">4.9 / 5.0 ⭐</div>
                </div>
                <div class="floater f2">
                    <div class="f-icon"><i class="bi bi-shield-fill-check"></i></div>
                    <div class="f-label">Verified Listings</div>
                    <div class="f-val">12,400+</div>
                </div>
                <div class="floater f3">
                    <div class="f-icon"><i class="bi bi-globe-americas"></i></div>
                    <div class="f-label">Countries Covered</div>
                    <div class="f-val">195 Nations</div>
                </div>
            </div>
            <div class="left-logo">
                <div class="logo-icon"><i class="bi bi-compass"></i></div>
                <div class="logo-text">Sham<span>Pro</span></div>
            </div>
            <div class="left-hero">
                <div class="teal-line"></div>
                <h2>Welcome back to your <em>adventure hub.</em></h2>
                <p>Sign in to access thousands of Packages, trusted Deals, and Secure Platform — all in one place.</p>
            </div>
            <div class="left-stats">
                <div class="stat-item">
                    <div class="s-num">50k+</div>
                    <div class="s-label">Happy Clients</div>
                </div>
                <div class="stat-item">
                    <div class="s-num">8k+</div>
                    <div class="s-label">Client Partners</div>
                </div>
                <div class="stat-item">
                    <div class="s-num">195</div>
                    <div class="s-label">Countries</div>
                </div>
            </div>
        </div>

        <!-- RIGHT PANEL -->
        <div class="auth-right">
            <div class="auth-box">
                <div class="form-heading">
                    <div class="fh-badge"><i class="bi bi-compass"></i> ShamPro Account</div>
                    <h1>Sign In</h1>
                    <p>Don't have an account? <a href="{{ route('register') }}">Create one free</a></p>
                </div>

                <!-- Type toggle -->
                {{-- <div class="type-toggle">
                    <button class="active" id="btnBuyer" onclick="setType('buyer')"><i class="bi bi-person-heart"></i>
                        Buyer</button>
                    <button id="btnBusiness" onclick="setType('business')"><i class="bi bi-briefcase"></i>
                        Business</button>
                </div> --}}

                <!-- Social -->
                <div class="social-btns">
                    <button class="social-btn" onclick="toast('Google sign-in coming soon!','bi-google')">
                        <svg width="18" height="18" viewBox="0 0 18 18">
                            <path fill="#4285F4"
                                d="M17.64 9.2c0-.637-.057-1.251-.164-1.84H9v3.481h4.844c-.209 1.125-.843 2.078-1.796 2.716v2.259h2.908c1.702-1.567 2.684-3.875 2.684-6.615z" />
                            <path fill="#34A853"
                                d="M9 18c2.43 0 4.467-.806 5.956-2.184l-2.908-2.259c-.806.54-1.837.86-3.048.86-2.344 0-4.328-1.584-5.036-3.711H.957v2.332A8.997 8.997 0 0 0 9 18z" />
                            <path fill="#FBBC05"
                                d="M3.964 10.706A5.41 5.41 0 0 1 3.682 9c0-.593.102-1.17.282-1.706V4.962H.957A8.996 8.996 0 0 0 0 9c0 1.452.348 2.827.957 4.038l3.007-2.332z" />
                            <path fill="#EA4335"
                                d="M9 3.58c1.321 0 2.508.454 3.44 1.345l2.582-2.58C13.463.891 11.426 0 9 0A8.997 8.997 0 0 0 .957 4.962L3.964 7.294C4.672 5.163 6.656 3.58 9 3.58z" />
                        </svg>
                        Google
                    </button>
                    <button class="social-btn" onclick="toast('Facebook sign-in coming soon!','bi-facebook')">
                        <i class="bi bi-facebook" style="color:#1877f2;font-size:17px"></i> Facebook
                    </button>
                </div>

                <div class="auth-divider">
                    <hr><span>or continue with email</span>
                    <hr>
                </div>

                <form method="POST" action="{{ route('login') }}" id="loginForm">
                    @csrf

                    <!-- Email -->
                    <div class="field">
                        <label><i class="bi bi-envelope-fill"></i> Email Address</label>
                        <div class="input-wrap">
                            <i class="bi bi-envelope i-pre"></i>
                            <input type="email" id="email" name="email" value="{{ old('email') }}"
                                placeholder="you@example.com" required autofocus
                                class="@error('email') error @enderror">
                        </div>
                        @error('email')
                            <div class="field-err" style="display:flex"><i class="bi bi-exclamation-circle"></i>
                                {{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="field">
                        <label><i class="bi bi-lock-fill"></i> Password</label>
                        <div class="input-wrap">
                            <i class="bi bi-lock i-pre"></i>
                            <input type="password" id="password" name="password" placeholder="Your password" required
                                class="@error('password') error @enderror">
                            <i class="bi bi-eye i-suf" id="eyeLogin" onclick="toggleVis('password','eyeLogin')"></i>
                        </div>
                        @error('password')
                            <div class="field-err" style="display:flex"><i class="bi bi-exclamation-circle"></i>
                                {{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Remember / Forgot -->
                    <div class="row-between">
                        <label class="check-wrap">
                            <input type="checkbox" name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }}>
                            <div class="check-box"></div>
                            <span>Remember me</span>
                        </label>
                        <a class="forgot-link" href="{{ route('password.custom.forgot') }}">Forgot password?</a>
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="btn-auth" id="loginBtn">
                        <span class="btn-text"><i class="bi bi-box-arrow-in-right"></i> Sign In</span>
                    </button>
                </form>

                <div class="auth-link">New to ShamPro? <a href="{{ route('register') }}">Create an account</a></div>
            </div>
        </div>
    </div>

    <div class="toast-wrap" id="toastWrap"></div>

    <script>
        function setType(t) {
            document.getElementById('btnBuyer').classList.toggle('active', t === 'buyer');
            document.getElementById('btnBusiness').classList.toggle('active', t === 'business');
        }

        function toggleVis(id, iconId) {
            const inp = document.getElementById(id);
            const show = inp.type === 'password';
            inp.type = show ? 'text' : 'password';
            document.getElementById(iconId).className = (show ? 'bi bi-eye-slash' : 'bi bi-eye') + ' i-suf';
        }
    </script>
</body>

</html>
