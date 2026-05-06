<!DOCTYPE html>
<html>
<head>
    <title>Department Dashboard</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f6fa;
            margin: 0;
            padding: 0;
        }

        .topbar {
            display: flex;
            justify-content: flex-end;
            padding: 15px 30px;
            background: #ffffff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }

        .logout-btn {
            background: #e74c3c;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
        }

        .logout-btn:hover {
            background: #c0392b;
        }

        .container {
            max-width: 900px;
            margin: 60px auto;
            background: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            text-align: center;
        }

        h1 {
            color: #2c3e50;
            margin-bottom: 10px;
        }

        p {
            color: #555;
            font-size: 16px;
            margin-bottom: 30px;
        }

        .cards {
            display: flex;
            gap: 15px;
            justify-content: space-between;
            margin-bottom: 40px;
        }

        .card {
            flex: 1;
            background: #3498db;
            color: white;
            padding: 20px;
            border-radius: 10px;
        }

        .card h2 {
            margin: 0;
            font-size: 30px;
        }

        .card span {
            display: block;
            margin-top: 8px;
            font-size: 14px;
            opacity: 0.9;
        }

        .card:nth-child(2) {
            background: #9b59b6;
        }

        .card:nth-child(3) {
            background: #e67e22;
        }

        .btn {
            display: inline-block;
            padding: 12px 25px;
            background-color: #2ecc71;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-size: 16px;
            transition: 0.3s;
        }

        .btn:hover {
            background-color: #27ae60;
        }
    </style>
</head>

<body>

<!-- TOP BAR -->
<div class="topbar">

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="logout-btn">Logout</button>
    </form>

</div>

<div class="container">

    <h1>Department Dashboard</h1>

    <p>Welcome, Department User</p>

    <!-- REAL TIME STATS -->
    <div class="cards">

        <div class="card">
            <h2>{{ $stats['total_students'] ?? 0 }}</h2>
            <span>Total Students</span>
        </div>

        <div class="card">
            <h2>{{ $stats['total_departments'] ?? 0 }}</h2>
            <span>Departments</span>
        </div>

        <div class="card">
            <h2>{{ $stats['active_sessions'] ?? 0 }}</h2>
            <span>Active Sessions</span>
        </div>

    </div>

    <a href="{{ route('dept.students') }}" class="btn">
        Go to Student Search
    </a>

</div>

</body>
</html>

