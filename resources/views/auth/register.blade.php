<!DOCTYPE html>
<html>
<head>
    <title>Register</title>

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
            max-width: 360px;
            background: #fff;
            padding: 30px 25px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            text-align: center;
        }

        .title {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #333;
        }

        .input-group {
            margin-bottom: 15px;
            text-align: left;
        }

        .input-group input {
            width: 100%;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ddd;
            font-size: 14px;
            outline: none;
        }

        .input-group input:focus {
            border-color: #1877f2;
        }

        .btn {
            width: 100%;
            padding: 10px;
            background: #1877f2;
            border: none;
            color: white;
            font-size: 15px;
            border-radius: 6px;
            cursor: pointer;
        }

        .btn:hover {
            background: #166fe5;
        }

        .error {
            color: red;
            font-size: 13px;
            margin-bottom: 10px;
            text-align: left;
        }

        .footer {
            margin-top: 15px;
            font-size: 14px;
        }

        .footer a {
            color: #1877f2;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

<div class="card">

    <div class="title">Register</div>

    {{-- Validation Errors --}}
    @if($errors->any())
        <div class="error">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form method="POST" action="/register" onsubmit="return validateForm()">
        @csrf

        <div class="input-group">
            <input type="text" name="name" id="name" placeholder="Full Name" required>
        </div>

        <div class="input-group">
            <input type="email" name="email" id="email" placeholder="Email" required>
        </div>

        <div class="input-group">
            <input type="password" name="password" id="password" placeholder="Password" required>
        </div>

        <button type="submit" class="btn">Register</button>
    </form>

    <div class="footer">
        Already have an account?
        <a href="/login">Login</a>
    </div>

</div>

<script>
function validateForm() {
    let name = document.getElementById('name').value.trim();
    let email = document.getElementById('email').value.trim();
    let password = document.getElementById('password').value.trim();

    if (name === "" || email === "" || password === "") {
        alert("All fields are required");
        return false;
    }

    let pattern = /^[^ ]+@[^ ]+\.[a-z]{2,}$/;
    if (!email.match(pattern)) {
        alert("Enter a valid email");
        return false;
    }

    if (password.length < 6) {
        alert("Password must be at least 6 characters");
        return false;
    }

    return true;
}
</script>

</body>
</html>

