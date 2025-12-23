<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Login - Al Nafi Travels</title>

    <!-- Favicon -->
    <link rel="icon" type="image/jpeg" href="{{ asset('images/alnafi.jpeg') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #f9f5eb 0%, #f5f0e1 50%, #ebe4d3 100%);
            padding: 20px;
        }

        .login-container {
            display: flex;
            width: 100%;
            max-width: 900px;
            background: white;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 25px 80px rgba(0, 0, 0, 0.1);
        }

        .login-left {
            flex: 1;
            background: #2d2d2d;
            padding: 60px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: white;
        }

        .login-left .icon {
            font-size: 80px;
            margin-bottom: 30px;
        }

        .login-left h1 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 15px;
            color: #f5c518;
        }

        .login-left p {
            font-size: 15px;
            opacity: 0.8;
            line-height: 1.6;
        }

        .features {
            margin-top: 40px;
            text-align: left;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 15px;
            font-size: 14px;
        }

        .feature-item .check {
            width: 24px;
            height: 24px;
            background: #d4a017;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            color: #2d2d2d;
        }

        .login-right {
            flex: 1;
            padding: 60px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: #fffdf7;
        }

        .login-right h2 {
            font-size: 28px;
            font-weight: 600;
            color: #2d2d2d;
            margin-bottom: 10px;
        }

        .login-right .subtitle {
            color: #666666;
            font-size: 14px;
            margin-bottom: 35px;
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            color: #2d2d2d;
            margin-bottom: 8px;
        }

        .form-group input {
            width: 100%;
            padding: 14px 18px;
            border: 2px solid #e8e4d9;
            border-radius: 12px;
            font-size: 15px;
            font-family: 'Poppins', sans-serif;
            transition: all 0.3s ease;
            background: white;
        }

        .form-group input:focus {
            outline: none;
            border-color: #d4a017;
            box-shadow: 0 0 0 4px rgba(212, 160, 23, 0.1);
        }

        .form-group input::placeholder {
            color: #999;
        }

        .remember-row {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 30px;
        }

        .remember-row input[type="checkbox"] {
            width: 18px;
            height: 18px;
            accent-color: #d4a017;
        }

        .remember-row label {
            font-size: 14px;
            color: #666;
        }

        .login-btn {
            width: 100%;
            padding: 16px;
            background: #2d2d2d;
            color: #f5c518;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .login-btn:hover {
            background: #d4a017;
            color: #2d2d2d;
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(212, 160, 23, 0.3);
        }

        .error-msg {
            background: #ffebee;
            color: #c62828;
            padding: 12px 16px;
            border-radius: 10px;
            font-size: 13px;
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
            }

            .login-left {
                padding: 40px 30px;
            }

            .login-left .icon {
                font-size: 60px;
                margin-bottom: 20px;
            }

            .login-left h1 {
                font-size: 22px;
            }

            .features {
                display: none;
            }

            .login-right {
                padding: 40px 30px;
            }
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-left">
            <div class="login-logo mb-6 bg-white p-2 rounded-2xl w-24 h-24 overflow-hidden mx-auto shadow-lg">
                <img src="{{ asset('images/alnafi.jpeg') }}" class="w-full h-full object-contain" alt="Al Nafi Logo">
            </div>
            <h1>Al Nafi Travels</h1>
            <p>Your simple solution for managing travel business finances</p>

            <div class="features">
                <div class="feature-item">
                    <span class="check">✓</span>
                    <span>Track Sales & Payments</span>
                </div>
                <div class="feature-item">
                    <span class="check">✓</span>
                    <span>Manage Customers & Suppliers</span>
                </div>
                <div class="feature-item">
                    <span class="check">✓</span>
                    <span>Beautiful Reports</span>
                </div>
                <div class="feature-item">
                    <span class="check">✓</span>
                    <span>Easy to Use Interface</span>
                </div>
            </div>
        </div>

        <div class="login-right">
            {{ $slot }}
        </div>
    </div>
</body>

</html>