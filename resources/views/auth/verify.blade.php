<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ShamPro - Verify Email</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" />
        <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Manrope:wght@200..800&family=Montez&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --theme-color: #1CA8CB;
            --title-color: #113D48;
            --body-color: #6E7070;
            --smoke-color2: #F3F4F6;
            --white-color: #ffffff;
            --gray-color: #E1E4E5;
            --success-color: #28a745;
            --body-font: "Inter", sans-serif;
            --title-font: "Manrope", sans-serif;
            --shadow-lg: 0 20px 60px rgba(13, 27, 42, .14);
        }

        body {
            min-height: 100vh;
            display: grid;
            place-items: center;
            background: var(--smoke-color2);
            font-family: var(--body-font);
        }

        .auth-card {
            width: 100%;
            max-width: 560px;
            border: 0;
            border-radius: 18px;
            box-shadow: var(--shadow-lg);
        }

        .auth-card h3 {
            font-family: var(--title-font);
            color: var(--title-color);
            font-weight: 700;
        }

        .auth-card p {
            color: var(--body-color);
        }

        .btn-main {
            background: var(--theme-color);
            border: 0;
            font-family: var(--body-font);
            font-weight: 700;
        }

        .btn-main:hover {
            background: #148fa0;
        }

        .alert-success {
            background: rgba(40, 167, 69, .1);
            border-color: var(--success-color);
            color: var(--success-color);
        }
    </style>
</head>

<body>
    <div class="card auth-card p-4 p-md-5 text-center">
        <h3 class="mb-2">Verify your email address</h3>
        <p class="text-muted mb-4">Before proceeding, please check your email for a verification link.</p>

        @if (session('resent'))
            <div class="alert alert-success">A fresh verification link has been sent to your email address.</div>
        @endif

        <form method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <button type="submit" class="btn btn-main text-white">Resend verification email</button>
        </form>

        <a href="{{ route('login') }}" class="btn btn-link mt-3">Back to login</a>
    </div>
</body>

</html>
