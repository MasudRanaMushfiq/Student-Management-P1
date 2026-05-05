<!DOCTYPE html>
<html>
<head>
    <title>Exam Controller Dashboard</title>

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

        /* TOP BAR */
        .topbar {
            background: #ffffff;
            padding: 15px 20px;
            border-bottom: 1px solid #ddd;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .topbar h1 {
            margin: 0;
            font-size: 18px;
        }

        /* LOGOUT BUTTON */
        .logout-btn {
            padding: 8px 12px;
            font-size: 13px;
            background: #ef4444;
            color: white;
            border: none;
            border-radius: 5px;
            text-decoration: none;
        }

        .logout-btn:hover {
            background: #dc2626;
        }

        /* CONTAINER */
        .container {
            padding: 20px;
            max-width: 1100px;
            margin: auto;
        }

        /* CARD */
        .card {
            background: #ffffff;
            padding: 20px;
            border-radius: 6px;
            box-shadow: 0 1px 5px rgba(0,0,0,0.05);
            margin-bottom: 20px;
        }

        .card h2 {
            margin-top: 0;
            font-size: 16px;
        }

        .text-muted {
            color: #666;
            font-size: 14px;
        }

        /* BUTTON */
        .btn {
            display: inline-block;
            padding: 10px 15px;
            background: #2563eb;
            color: white;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-size: 14px;
            cursor: pointer;
        }

        .btn:hover {
            background: #1d4ed8;
        }

        /* REQUEST LIST */
        .request {
            border-bottom: 1px solid #eee;
            padding: 10px 0;
        }

        .request:last-child {
            border-bottom: none;
        }

        .badge {
            display: inline-block;
            padding: 3px 8px;
            font-size: 12px;
            background: #f59e0b;
            color: white;
            border-radius: 4px;
        }

    </style>
</head>

<body>

<!-- TOP BAR -->
<div class="topbar">
    <h1>Exam Controller Dashboard</h1>

    <!-- LOGOUT -->
    <form method="POST" action="/logout" style="margin:0;">
        @csrf
        <button type="submit" class="logout-btn">Logout</button>
    </form>
</div>

<div class="container">

    <!-- INFO CARD -->
    <div class="card">
        <h2>Welcome</h2>
        <p class="text-muted">
            You can manage student name corrections and verification requests from here.
        </p>

        <a href="/exam/student/search" class="btn">
            Search Student
        </a>
    </div>

    <!-- REQUEST SECTION -->
    <div class="card">
        <h2>Student Correction Requests</h2>
        <p class="text-muted">List of students requesting information corrections</p>

        <div class="request">
            <strong>Masud Rana</strong> (ID: 10123) <br>
            Requested: Name correction <span class="badge">Pending</span>
        </div>

        <div class="request">
            <strong>Rahim Uddin</strong> (ID: 10124) <br>
            Requested: Hall change <span class="badge">Pending</span>
        </div>

        <div class="request">
            <strong>Ayesha Akter</strong> (ID: 10125) <br>
            Requested: Mobile number update <span class="badge">Pending</span>
        </div>

    </div>

</div>

</body>
</html>

