<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ShamPro - Confirm Password</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" />

        <link rel="stylesheet" href="assets/css/style2.css">
</head>

<body>
    <div class="card auth-card p-4 p-md-5">
        <h3 class="mb-2">Confirm your password</h3>
        <p class="text-muted mb-4">For security, please confirm your password before continuing.</p>

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input id="password" type="password" name="password"
                    class="form-control @error('password') is-invalid @enderror" required
                    autocomplete="current-password">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-main text-white w-100">Confirm password</button>
        </form>

        @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}" class="btn btn-link mt-3">Forgot your password?</a>
        @endif
    </div>
</body>

</html>
