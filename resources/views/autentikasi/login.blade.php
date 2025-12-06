<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Inter&display=swap" rel="stylesheet" />
    <title>Login</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Inter, sans-serif;
            background: #fff;
            min-height: 100vh;
        }

        /* === LAYOUT UTAMA 50–50 === */
        .container {
            display: flex;
            width: 100%;
            min-height: 100vh;
        }

        /* KIRI */
        .left {
            flex: 1;
            height: 100vh;
            overflow: hidden;
        }

        .left img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* KANAN */
        .right {
            flex: 1;
            min-height: 100vh;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        /* CARD LOGIN */
        .login-card {
            background: #1E3557;
            width: 100%;
            max-width: 480px;
            padding: 40px 30px;
            border-radius: 20px;
        }

        /* Title */
        .title-box {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 15px;
        }

        .title {
            color: #fff;
            font-family: Ubuntu, sans-serif;
            font-size: 32px;
            font-weight: 700;
        }

        .subtitle {
            color: #fff;
            font-family: Ubuntu, sans-serif;
            font-size: 16px;
            margin-top: 5px;
            opacity: 0.9;
        }

        .desc {
            color: #fff;
            font-size: 18px;
            text-align: center;
            margin: 15px 0 30px;
            opacity: 0.95;
        }

        /* INPUT */
        .input-group {
            margin-bottom: 20px;
        }

        .input-group label {
            color: #fff;
            font-size: 16px;
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .input-box {
            background: #fff;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            position: relative;
            transition: all 0.3s ease;
        }

        .input-box:focus-within {
            box-shadow: 0 0 0 3px rgba(246, 135, 0, 0.3);
        }

        .input-box input {
            width: 100%;
            font-size: 15px;
            border: none;
            outline: none;
            padding-left: 45px;
            background: transparent;
        }

        .input-box input::placeholder {
            color: #999;
        }

        /* ICONS - Fixed sizing */
        .icon {
            width: 24px;
            height: 24px;
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
            position: absolute;
            left: 15px;
            flex-shrink: 0;
        }

        .email-icon {
            background-image: url("images/email.png");
            filter: invert();
        }

        .pass-icon {
            background-image: url("images/lock.png");
            filter: invert();
        }

        .eye-icon {
            background-image: url("images/eye.png");
            right: 15px;
            left: auto;
            width: 24px;
            height: 24px;
            opacity: 0.6;
            cursor: pointer;
            transition: opacity 0.3s ease;
        }

        .eye-icon:hover {
            opacity: 4;
        }

        /* ICON WRAPPER WITH BACKGROUND */
        .icon-wrapper {
            width: 50px;
            height: 50px;
            background: #1E3557;        /* same dark-blue as screenshot */
            border-radius: 10px;
            border: 2px solid white;
            display: flex;
            align-items: center;
            justify-content: center;
            position: absolute;
            left: 0px;
        }

        /* ICON IMAGE */
        .icon-wrapper img {
            width: 25px;
            height: 25px;
            filter: invert(0); /* makes icon white */
        }

        /* Adjust input padding so text doesn't overlap the icon */
        .input-box input {
            padding-left: 60px !important;
        }


        /* Lupa Password */
        .forgot {
            color: #fff;
            font-size: 14px;
            float: right;
            margin-top: 5px;
            text-decoration: none;
            opacity: 0.9;
            transition: opacity 0.3s ease;
        }

        .forgot:hover {
            opacity: 1;
            text-decoration: underline;
        }

        /* BUTTON */
        .btn-login {
            width: 100%;
            height: 50px;
            border-radius: 20px;
            background: #F68700;
            color: #fff;
            font-size: 18px;
            font-weight: bold;
            border: none;
            margin-top: 40px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: Ubuntu, sans-serif;
        }

        .btn-login:hover {
            background: #d97500;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(246, 135, 0, 0.4);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        /* Error Message */
        .error-box {
            background: #ffebee;
            border-left: 4px solid #d32f2f;
            color: #b71c1c;
            padding: 12px 15px;
            border-radius: 10px;
            font-size: 14px;
            margin-bottom: 15px;
            animation: fadeIn 0.3s ease;
        }
    
        /* REGISTER */
        .register {
            margin-top: 25px;
            text-align: center;
            color: #fff;
            font-size: 15px;
        }

        .register a {
            color: #F68700;
            font-weight: bold;
            margin-left: 5px;
            cursor: pointer;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .register a:hover {
            color: #ff9a1f;
            text-decoration: underline;
        }

        /* === RESPONSIVE === */
        @media (max-width: 1024px) {
            .login-card {
                padding: 35px 25px;
            }

            .title {
                font-size: 28px;
            }

            .desc {
                font-size: 16px;
            }
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .left {
                display: none;
            }

            .right {
                flex: none;
                width: 100%;
                min-height: 100vh;
                padding: 30px 20px;
            }

            .login-card {
                padding: 30px 20px;
            }

            .title {
                font-size: 26px;
            }

            .subtitle {
                font-size: 14px;
            }

            .desc {
                font-size: 15px;
                margin: 15px 0 25px;
            }

            .btn-login {
                margin-top: 30px;
                font-size: 17px;
            }
        }

        @media (max-width: 480px) {
            .right {
                padding: 20px 15px;
            }

            .login-card {
                padding: 25px 18px;
                border-radius: 15px;
            }

            .title {
                font-size: 24px;
            }

            .subtitle {
                font-size: 13px;
            }

            .desc {
                font-size: 14px;
                margin: 12px 0 20px;
            }

            .input-group label {
                font-size: 14px;
            }

            .input-box {
                height: 48px;
            }

            .input-box input {
                font-size: 14px;
            }

            .btn-login {
                height: 48px;
                font-size: 16px;
                margin-top: 25px;
            }

            .register {
                font-size: 14px;
                margin-top: 20px;
            }

            .forgot {
                font-size: 13px;
            }
        }

        /* Landscape mobile */
        @media (max-height: 600px) and (orientation: landscape) {
            .right {
                padding: 15px;
            }

            .login-card {
                padding: 20px;
                max-width: 100%;
            }

            .title {
                font-size: 22px;
            }

            .desc {
                margin: 10px 0 15px;
                font-size: 14px;
            }

            .input-group {
                margin-bottom: 15px;
            }

            .btn-login {
                margin-top: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Bagian kiri -->
        <div class="left">
            <img src="{{ asset('images/banner_login.png') }}" alt="Login Image" />
        </div>

        <!-- Bagian kanan -->
        <div class="right">
            <div class="login-card">
                <form action="{{ route('postLogin') }}" method="POST">
                    <input type="hidden" name="source" value="{{ $source }}">
                    @csrf
                
                    <div class="title-box">
                        <h1 class="title">Selamat Datang</h1>
                        <p class="subtitle">Silahkan Lakukan Pendaftaran</p>
                    </div>
                
                    <p class="desc">Silahkan Login Menggunakan Email Yang Sudah Terdaftar</p>

                    @if ($errors->any())
                        <div class="error-box">
                            <strong>Terjadi kesalahan:</strong>
                            @if ($errors->has('login'))
                                <div style="margin-top:6px;">
                                    {{ $errors->first('login') }}
                                </div>
                            @endif
                        </div>
                    @endif
                    
                    <div class="input-group">
                        <label>Email</label>
                        <div class="input-box">
                            <div class="icon-wrapper">
                                <img src="images/email.png" alt="Email Icon">
                            </div>
                            <input type="email" name="email" placeholder="Masukkan Email" required>
                        </div>
                    </div>
                    
                    <div class="input-group">
                        <label>Password</label>
                        <div class="input-box">
                            <div class="icon-wrapper">
                                <img src="images/lock.png" alt="Lock Icon">
                            </div>
                            <input type="password" name="password" id="password" placeholder="Masukkan Password" required>
                            <span class="icon eye-icon" onclick="togglePassword()"></span>
                        </div>
                    </div>
                
                    <p class="forgot">Lupa Password?</p>
                    <button class="btn-login" type="submit">Masuk</button>
                
                    <div class="register">
                        <span>Belum punya akun?</span>
                        <a href="/register?source={{ $source }}">Daftar Sekarang!</a>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.querySelector('.eye-icon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.style.opacity = '1';
            } else {
                passwordInput.type = 'password';
                eyeIcon.style.opacity = '0.6';
            }
        }

        function handleLogin() {
            alert('Login functionality would be implemented here');
        }
    </script>
</body>

</html>