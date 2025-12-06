<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Inter&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-size: 14px;
            margin: 0;
            padding: 0;
            font-family: Inter, sans-serif;
        }

        .v58_1869 {
            width: 100%;
            min-height: 100vh;
            background: #fff;
            position: relative;
            display: flex;
            flex-wrap: wrap;
        }

        .v58_1928 {
            width: 50%;
            min-height: 100vh;
            background: url("images/banner_register.png") center/contain no-repeat;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .v58_1929 {
            width: 50%;
            min-height: 100vh;
            background: #f5f5f5;
            position: relative;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .v58_1931 {
            width: 100%;
            max-width: 500px;
            background: #1e3557;
            border-radius: 20px;
            position: relative;
            padding: 40px;
            margin: 20px auto;
        }

        .v58_1955 {
            font-size: clamp(24px, 5vw, 32px);
            font-family: Ubuntu;
            color: white;
            text-align: center;
        }

        .v58_1956 {
            font-size: clamp(14px, 3vw, 16px);
            margin-top: 5px;
            color: white;
            text-align: center;
        }

        .form-block {
            width: 100%;
            margin-top: 20px;
            position: relative;
        }

        .form-label {
            color: white;
            font-size: 16px;
            margin-bottom: 8px;
            display: block;
        }

        .form-input-wrapper {
            position: relative;
            width: 100%;
        }

        .form-input {
            width: 100%;
            height: 45px;
            background: #fefefe;
            border-radius: 10px;
            padding-left: 55px;
            padding-right: 15px;
            font-size: 15px;
            border: none;
            outline: none;
        }

        .icon-box {
            width: 43px;
            height: 43px;
            background: #1e3557;
            border-radius: 10px 0 0 10px;
            position: absolute;
            top: 1px;
            left: 1px;
            display: flex;
            align-items: center;
            justify-content: center;
            pointer-events: none;
            z-index: 1;
        }

        .icon-box img {
            width: 24px;
            height: 24px;
        }

        .register-btn {
            width: 100%;
            max-width: 200px;
            height: 50px;
            background: #f68700;
            border-radius: 20px;
            margin: 30px auto 0;
            display: block;
            color: white;
            font-weight: bold;
            font-size: 20px;
            cursor: pointer;
            border: none;
            transition: background 0.3s;
        }

        .register-btn:hover {
            background: #d97600;
        }

        /* ERROR TEXT FOR EACH INPUT */
        .input-error {
            color: #ffb3b3;
            font-size: 13px;
            margin-top: 5px;
            display: block;
        }

        /* RED BORDER FOR INVALID INPUT */
        .form-input.error {
            border: 2px solid #d9534f !important;
        }

        /* Fade-in animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-5px); }
            to { opacity: 1; transform: translateY(0); }
        }


        /* Tablet */
        @media screen and (max-width: 1024px) {
            .v58_1928 {
                width: 40%;
            }

            .v58_1929 {
                width: 60%;
            }

            .v58_1931 {
                padding: 30px;
            }
        }

        /* Mobile */
        @media screen and (max-width: 768px) {
            .v58_1869 {
                flex-direction: column;
            }

            .v58_1928 {
                width: 100%;
                min-height: 200px;
                display: none;
            }

            .v58_1929 {
                width: 100%;
                min-height: 100vh;
                padding: 15px;
            }

            .v58_1931 {
                padding: 25px;
                margin: 0 auto;
            }

            .form-block {
                margin-top: 15px;
            }

            .form-label {
                margin-bottom: 6px;
            }

            .icon-box {
                width: 41px;
                height: 41px;
            }

            .icon-box img {
                width: 22px;
                height: 22px;
            }

            .register-btn {
                margin-top: 20px;
            }
        }

        /* Small Mobile */
        @media screen and (max-width: 480px) {
            .v58_1931 {
                padding: 20px;
            }

            .form-input {
                height: 42px;
                font-size: 14px;
                padding-left: 50px;
            }

            .icon-box {
                width: 38px;
                height: 38px;
            }

            .icon-box img {
                width: 20px;
                height: 20px;
            }

            .form-label {
                font-size: 14px;
                margin-bottom: 6px;
            }

            .register-btn {
                height: 45px;
                font-size: 18px;
            }
        }
    </style>
</head>

<body>
    <div class="v58_1869">
        <div class="v58_1928">
            {{-- Gamabr sebelah kiri login --}}
        </div>
            <div class="v58_1931">

                <!-- Title -->
                <div>
                    <div class="v58_1955">Selamat Datang</div>
                    <div class="v58_1956">Silahkan Lakukan Pendaftaran</div>
                </div>

                <!-- FORM -->
                <form method="POST" action="{{ route('postRegister') }}">
                    <input type="hidden" name="source" value="{{ $source }}">
                    <input type="hidden" name="role" value="pemohon">
                    @csrf


                    <!-- PASSWORD -->
                    <div class="form-block">
                        <label class="form-label">Password</label>
                        <div class="form-input-wrapper">
                            <div class="icon-box">
                                <img src="{{ asset('images/lock.png') }}">
                            </div>
                            <input type="password" name="password" class="form-input @error('password') error @enderror"
                                placeholder="Masukkan Password" required>
                        </div>
                    
                        @error('password')
                            <span class="input-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- NIK -->
                    <div class="form-block">
                        <label class="form-label">NIK</label>
                        <div class="form-input-wrapper">
                            <div class="icon-box">
                                <img src="{{ asset('images/user.png') }}">
                            </div>
                            <input type="text" name="nik" class="form-input @error('nik') error @enderror" placeholder="Masukkan NIK" required>
                            @error('nik')
                                <span class="input-error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- EMAIL -->
                    <div class="form-block">
                        <label class="form-label">Email</label>
                        <div class="form-input-wrapper">
                            <div class="icon-box">
                                <img src="{{ asset('images/letter.png') }}">
                            </div>
                            <input type="email" name="email" class="form-input @error('email') error @enderror" placeholder="Masukkan Email" required>
                            @error('email')
                                <span class="input-error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- NAMA -->
                    <div class="form-block">
                        <label class="form-label">Nama</label>
                        <div class="form-input-wrapper">
                            <div class="icon-box">
                                <img src="{{ asset('images/letter.png') }}">
                            </div>
                            <input type="text" name="nama" class="form-input @error('nama') error @enderror" placeholder="Masukkan Nama" required>
                            @error('nama')
                                <span class="input-error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- NO TELP -->
                    <div class="form-block">
                        <label class="form-label">No. Telp</label>
                        <div class="form-input-wrapper">
                            <div class="icon-box">
                                <img src="{{ asset('images/phone.png') }}">
                            </div>
                            <input type="tel" name="no_telp" class="form-input @error('no_telp') error @enderror" placeholder="Masukkan No. Telp" required>
                            @error('no_telp')
                                <span class="input-error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="register-btn">Daftar</button>

                </form>

            </div>
        </div>

    </div>

</body>

</html>