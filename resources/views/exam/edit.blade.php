<!DOCTYPE html>
<html>
<head>
    <title>Edit Student Name</title>

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
            max-width: 600px;
            margin: auto;
            padding: 20px;
        }

        .card {
            background: #fff;
            padding: 20px;
            border-radius: 6px;
            box-shadow: 0 1px 5px rgba(0,0,0,0.05);
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

        h2 {
            margin-top: 0;
            font-size: 16px;
            border-bottom: 1px solid #eee;
            padding-bottom: 8px;
        }

        label {
            display: block;
            margin-top: 15px;
            font-size: 14px;
            color: #333;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }

        .btn {
            margin-top: 20px;
            padding: 10px 15px;
            background: #2563eb;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 14px;
        }

        .btn:hover {
            background: #1d4ed8;
        }

    </style>
</head>

<body>

<div class="topbar">
    <h1>Exam Controller</h1>
</div>

<div class="container">

    <!-- BACK BUTTON -->
    <a href="javascript:history.back()" class="back-btn">← Back</a>

    <div class="card">

        <h2>Edit Student Name</h2>

        <form method="POST" action="/exam/student/update/{{ $student->id }}">
            @csrf

            <label>Full Name</label>
            <input type="text" name="fullname" value="{{ $student->fullname }}" required>

            <button type="submit" class="btn">Update Name</button>
        </form>

    </div>

</div>

</body>
</html>

