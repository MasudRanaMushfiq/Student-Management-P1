<!DOCTYPE html>
<html>
<head>
    <title>Home</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            margin: 0;
            background: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            width: 100%;
            max-width: 520px;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 6px 18px rgba(0,0,0,0.1);
        }

        .title {
            font-size: 22px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 8px;
            color: #333;
        }

        .subtitle {
            font-size: 14px;
            text-align: center;
            color: #666;
            margin-bottom: 20px;
        }

        .info-box {
            background: #f7f7f7;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .info-box p {
            margin: 6px 0;
        }

        .notice {
            background: #fff3cd;
            color: #856404;
            padding: 12px;
            border-radius: 8px;
            font-size: 14px;
            margin-bottom: 20px;
            border: 1px solid #ffeeba;
            line-height: 1.5;
        }

        .logout-wrapper {
            display: flex;
            justify-content: flex-end;
        }

        .btn-logout {
            padding: 6px 12px;
            background: #e53935;
            border: none;
            color: white;
            font-size: 13px;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-logout:hover {
            background: #d32f2f;
        }

    </style>
</head>

<body>

<div class="card">

    <div class="title">Welcome</div>
    <div class="subtitle">You are logged in successfully</div>

    {{-- User Info --}}
    <div class="info-box">
        <p><strong>Name:</strong> {{ auth()->user()->name }}</p>
        <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
        <p><strong>User ID:</strong> {{ auth()->user()->id }}</p>
        <p><strong>Account Created:</strong> {{ auth()->user()->created_at }}</p>
    </div>

    {{-- Verification Notice --}}
    <div class="notice">
        <strong>Account Status:</strong><br>
        Please wait until you are verified by the super admin and assigned a role. <br><br>
        Once your role is assigned, you will automatically see all available options based on your permissions after login.
    </div>

    {{-- Logout --}}
    <div class="logout-wrapper">
        <form method="POST" action="/logout">
            @csrf
            <button type="submit" class="btn-logout">Logout</button>
        </form>
    </div>

</div>

</body>
</html>

