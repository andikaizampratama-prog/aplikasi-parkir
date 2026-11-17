
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Register - ParkirKu</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #0f172a, #1d4ed8, #0891b2);
            font-family: Arial, sans-serif;
        }

        .register-card {
            width: 100%;
            max-width: 450px;
            background: white;
            padding: 35px;
            border-radius: 20px;
            box-shadow: 0 20px 50px rgba(0,0,0,.2);
        }
    </style>
</head>

<body>

<div class="register-card">

    <h2 class="text-center text-primary fw-bold">ParkirKu</h2>

    <p class="text-center text-secondary mb-4">
        Buat Akun Baru
    </p>

    @if($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('register.process') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nama Lengkap</label>
            <input type="text" name="name" class="form-control"
                   value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control"
                   value="{{ old('email') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control"
                   minlength="8" required>
        </div>

        <div class="mb-4">
            <label class="form-label">Konfirmasi Password</label>
            <input type="password" name="password_confirmation"
                   class="form-control" minlength="8" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">
            Register
        </button>
    </form>

    <div class="text-center mt-4">
        Sudah punya akun?
        <a href="{{ route('login') }}">Login</a>
    </div>

</div>

</body>
</html>
