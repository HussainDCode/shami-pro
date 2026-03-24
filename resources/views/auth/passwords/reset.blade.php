<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ShamPro - Reset Password</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" />
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Syne:wght@700;800;900&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/style2.css">
</head>

<body>
    <div class="auth-layout">
        <div class="auth-left">
            <h2 style="font-family:var(--title-font);font-size:34px;font-weight:700;">Set your <span style="color:var(--theme-color);">new
                    password</span> securely.</h2>
        </div>
        <div class="auth-right">
            <div class="auth-box">
                <div class="form-heading">
                    <div class="fh-badge"><i class="bi bi-shield-fill-check"></i> New Password</div>
                    <h1>Reset Password</h1>
                    <p>Create a strong new password for <strong style="color:var(--theme-color);">{{ $verifiedEmail }}</strong>.
                    </p>
                </div>
                <form method="POST" action="{{ route('password.custom.reset') }}">
                    @csrf
                    <div class="field">
                        <label><i class="bi bi-lock-fill"></i> New Password</label>
                        <div class="input-wrap">
                            <i class="bi bi-lock i-pre"></i>
                            <input type="password" id="newPw" name="password" required minlength="8"
                                autocomplete="new-password">
                            <i class="bi bi-eye i-suf" onclick="toggleVis('newPw', this)"></i>
                        </div>
                        @error('password')
                            <div class="text-err">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="field">
                        <label><i class="bi bi-lock-fill"></i> Confirm Password</label>
                        <div class="input-wrap">
                            <i class="bi bi-lock i-pre"></i>
                            <input type="password" id="confirmPw" name="password_confirmation" required minlength="8"
                                autocomplete="new-password">
                            <i class="bi bi-eye i-suf" onclick="toggleVis('confirmPw', this)"></i>
                        </div>
                    </div>
                    <button class="btn-auth" type="submit"><i class="bi bi-check2-all"></i> Reset My Password</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        function toggleVis(id, iconEl) {
            const inp = document.getElementById(id);
            const show = inp.type === 'password';
            inp.type = show ? 'text' : 'password';
            iconEl.className = show ? 'bi bi-eye-slash i-suf' : 'bi bi-eye i-suf';
        }
    </script>
</body>

</html>
