<!DOCTYPE html>
<html>
<head>
    <title>Search Student</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            margin: 0;
            background: #f4f6f9;
        }

        .topbar {
            background: #fff;
            padding: 15px 20px;
            border-bottom: 1px solid #ddd;
        }

        .topbar h1 {
            margin: 0;
            font-size: 18px;
        }

        .container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
        }

        /* BACK BUTTON */
        .back-btn {
            display: inline-block;
            margin-bottom: 15px;
            padding: 8px 12px;
            font-size: 14px;
            background: #ffffff;
            border: 1px solid #ddd;
            border-radius: 6px;
            text-decoration: none;
            color: #333;
        }

        .back-btn:hover {
            background: #f1f1f1;
        }

        .card {
            background: #fff;
            padding: 20px;
            border-radius: 6px;
            box-shadow: 0 1px 5px rgba(0,0,0,0.05);
        }

        h2 {
            margin-top: 0;
            font-size: 16px;
        }

        .text-muted {
            font-size: 14px;
            color: #666;
            margin-bottom: 15px;
        }

        .error {
            color: red;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .form-group {
            display: flex;
            gap: 10px;
        }

        input {
            flex: 1;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }

        button {
            padding: 10px 15px;
            background: #2563eb;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background: #1d4ed8;
        }

    </style>
</head>

<body>

<!-- TOP BAR -->
<div class="topbar">
    <h1>Exam Controller</h1>
</div>

<div class="container">

    <!-- BACK BUTTON -->
    <a href="javascript:history.back()" class="back-btn">← Back</a>

    <div class="card">

        <h2>Search Student</h2>
        <p class="text-muted">Enter Student ID to find student details</p>

        {{-- ERROR MESSAGE --}}
        @if(session('error'))
            <div class="error">{{ session('error') }}</div>
        @endif

        {{-- SEARCH FORM --}}
        <form method="GET" action="/exam/student/show">
            <div class="form-group">
                <input type="text" name="student_id" placeholder="Enter Student ID" required>
                <button type="submit">Search</button>
            </div>
        </form>

    </div>

</div>

</body>
</html>

