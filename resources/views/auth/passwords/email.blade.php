<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>ShamPro - Forgot Password</title>
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
        <div class="auth-left">
            <div class="left-mesh">
                <div class="mesh-circle mc1"></div>
                <div class="mesh-circle mc2"></div>
                <div class="mesh-circle mc3"></div>
            </div>
            <div class="left-grid"></div>
            <div class="left-logo">
                <div class="logo-icon"><i class="bi bi-compass"></i></div>
                <div class="logo-text">Sham<span>Pro</span></div>
            </div>
            <div class="left-hero">
                <div class="teal-line"></div>
                <h2>Password recovery <em>made simple.</em></h2>
                <p>Securely recover access to your account in under 2 minutes using our OTP verification system.</p>
            </div>
        </div>
        <div class="auth-right">
            <div class="auth-box">
                <button class="back-btn" onclick="window.location.href='{{ route('login') }}'"><i
                        class="bi bi-arrow-left"></i> Back to Sign In</button>
                <div class="fp-steps">
                    <div class="fp-step active" id="fpStep0">
                        <div class="fp-circle">1</div>
                        <div class="fp-label">Enter Email</div>
                    </div>
                    <div class="fp-step" id="fpStep1">
                        <div class="fp-circle">2</div>
                        <div class="fp-label">Verify OTP</div>
                    </div>
                    <div class="fp-step" id="fpStep2">
                        <div class="fp-circle"><i class="bi bi-check"></i></div>
                        <div class="fp-label">Done</div>
                    </div>
                </div>
                <div id="viewEmail">
                    <div class="form-heading">
                        <div class="fh-badge"><i class="bi bi-key"></i> Password Recovery</div>
                        <h1>Forgot Password?</h1>
                        <p>Enter your registered email address below. We'll send you a 6-digit one-time code to verify
                            your identity.</p>
                    </div>
                    <div class="info-box"><i class="bi bi-info-circle-fill"></i><span>Make sure you have access to your
                            email inbox. The OTP expires in <strong>5 minutes</strong>.</span></div>
                    <div class="field">
                        <label><i class="bi bi-envelope-fill"></i> Registered Email Address</label>
                        <div class="input-wrap"><i class="bi bi-envelope i-pre"></i><input type="email"
                                id="forgotEmail" placeholder="you@example.com" oninput="liveEmail(this)"></div>
                        <div class="field-err" id="err-forgot"><i class="bi bi-exclamation-circle"></i> <span></span>
                        </div>
                    </div>
                    <button class="btn-auth" id="sendOtpBtn" onclick="sendOtp()">
                        <div class="btn-spinner"></div><span class="btn-text"><i class="bi bi-send"></i> Send OTP
                            Code</span>
                    </button>
                    <div class="auth-link">Remember your password? <a href="{{ route('login') }}">Sign in here</a></div>
                </div>
                <div id="viewOtp" style="display:none">
                    <div class="otp-section-title">Check Your Inbox</div>
                    <div class="otp-section-sub">We've sent a 6-digit verification code to</div>
                    <div class="otp-email-display" id="otpEmailShow">-</div>
                    <div class="otp-group">
                        <input type="text" class="otp-inp" maxlength="1" oninput="handleOtp(this,0)"
                            onkeydown="otpBack(event,0)">
                        <input type="text" class="otp-inp" maxlength="1" oninput="handleOtp(this,1)"
                            onkeydown="otpBack(event,1)">
                        <input type="text" class="otp-inp" maxlength="1" oninput="handleOtp(this,2)"
                            onkeydown="otpBack(event,2)">
                        <input type="text" class="otp-inp" maxlength="1" oninput="handleOtp(this,3)"
                            onkeydown="otpBack(event,3)">
                        <input type="text" class="otp-inp" maxlength="1" oninput="handleOtp(this,4)"
                            onkeydown="otpBack(event,4)">
                        <input type="text" class="otp-inp" maxlength="1" oninput="handleOtp(this,5)"
                            onkeydown="otpBack(event,5)">
                    </div>
                    <div class="otp-err" id="err-otp"><i class="bi bi-exclamation-circle"></i> <span></span></div>
                    <button class="btn-auth" id="verifyBtn" onclick="verifyOtp()">
                        <div class="btn-spinner"></div><span class="btn-text"><i class="bi bi-check2-circle"></i>
                            Verify Code</span>
                    </button>
                    <div class="resend-row">Didn't receive it? <a id="resendLink" onclick="resendOtp()">Resend
                            OTP</a> <span id="resendTimer"></span></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        let userEmail = '';
        let timerInterval = null;
        async function postJson(url, data) {
            const r = await fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify(data)
            });
            const j = await r.json().catch(() => ({}));
            if (!r.ok) throw j;
            return j;
        }

        function setErr(id, msg) {
            const e = document.getElementById(id);
            e.querySelector('span').textContent = msg;
            e.style.display = 'flex';
        }

        function clrErr(id) {
            document.getElementById(id).style.display = 'none';
        }

        function setStep(n) {
            for (let i = 0; i < 3; i++) {
                const el = document.getElementById('fpStep' + i);
                el.className = 'fp-step';
                if (i < n) el.classList.add('done');
                else if (i === n) el.classList.add('active');
            }
        }

        function liveEmail(inp) {
            const ok = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(inp.value.trim());
            inp.classList.toggle('error', !ok && inp.value.length > 2);
            if (ok) clrErr('err-forgot');
        }
        async function sendOtp() {
            clrErr('err-forgot');
            const email = document.getElementById('forgotEmail').value.trim();
            if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                setErr('err-forgot', 'Please enter a valid email address');
                return;
            }
            const b = document.getElementById('sendOtpBtn');
            b.classList.add('loading');
            try {
                const data = await postJson("{{ route('password.custom.send-otp') }}", {
                    email
                });
                userEmail = data.email;
                document.getElementById('viewEmail').style.display = 'none';
                document.getElementById('viewOtp').style.display = 'block';
                document.getElementById('otpEmailShow').textContent = userEmail;
                setStep(1);
                startTimer();
            } catch (e) {
                setErr('err-forgot', e.message || 'Failed to send OTP');
            } finally {
                b.classList.remove('loading');
            }
        }

        function handleOtp(inp, idx) {
            const inputs = document.querySelectorAll('.otp-inp');
            inp.value = inp.value.replace(/[^A-Za-z0-9]/g, '').slice(0, 1);
            if (inp.value && idx < 5) inputs[idx + 1].focus();
        }

        function otpBack(e, idx) {
            const inputs = document.querySelectorAll('.otp-inp');
            if (e.key === 'Backspace' && !inputs[idx].value && idx > 0) inputs[idx - 1].focus();
        }
        async function verifyOtp() {
            clrErr('err-otp');
            const code = Array.from(document.querySelectorAll('.otp-inp')).map(i => i.value).join('');
            if (code.length < 6) {
                setErr('err-otp', 'Incorrect or incomplete code');
                return;
            }
            const b = document.getElementById('verifyBtn');
            b.classList.add('loading');
            try {
                const data = await postJson("{{ route('password.custom.verify-otp') }}", {
                    email: userEmail,
                    otp: code
                });
                setStep(2);
                window.location.href = data.redirect;
            } catch (e) {
                setErr('err-otp', e.message || 'Invalid code');
            } finally {
                b.classList.remove('loading');
            }
        }
        async function resendOtp() {
            clrErr('err-otp');
            try {
                await postJson("{{ route('password.custom.send-otp') }}", {
                    email: userEmail
                });
                startTimer();
            } catch (e) {
                setErr('err-otp', e.message || 'Failed to resend OTP');
            }
        }

        function startTimer() {
            clearInterval(timerInterval);
            let s = 60;
            const t = document.getElementById('resendTimer');
            const l = document.getElementById('resendLink');
            l.style.display = 'none';
            t.textContent = 'Resend in ' + s + 's';
            timerInterval = setInterval(() => {
                s--;
                t.textContent = s > 0 ? 'Resend in ' + s + 's' : '';
                if (s <= 0) {
                    clearInterval(timerInterval);
                    l.style.display = 'inline';
                }
            }, 1000);
        }
    </script>
</body>

</html>
