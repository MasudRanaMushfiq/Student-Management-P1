<!DOCTYPE html>
<html>
<head>
    <title>Department Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f7fb;
        }

        .container {
            margin-top: 40px;
        }

        .card {
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }

        /* TOP BAR */
        .topbar {
            background: #0f172a; /* black-blue */
            padding: 12px 25px;
            display: flex;
            justify-content: flex-end;
        }

        .logout-btn {
            background: #2563eb; /* blue */
            color: white;
            border: none;
            padding: 7px 14px;
            border-radius: 5px;
        }

        .logout-btn:hover {
            background: #1d4ed8;
        }

        /* TITLE */
        h4 {
            color: #0f172a;
            font-weight: 600;
        }

        p {
            color: #64748b;
        }

        /* STATS */
        .stat-card {
            color: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            transition: 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-3px);
        }

        .stat-card h2 {
            margin: 0;
            font-size: 28px;
        }

        .stat-card span {
            font-size: 14px;
            opacity: 0.9;
        }

        /* BUTTON */
        .btn-custom {
            background: #2563eb;
            color: white;
            padding: 10px 20px;
            border-radius: 6px;
            text-decoration: none;
            display: inline-block;
        }

        .btn-custom:hover {
            background: #1d4ed8;
            color: white;
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

    <!-- MAIN CARD -->
    <div class="card p-4 text-center mb-4">

        <h4>Department Dashboard</h4>
        <p>Welcome, Department User</p>

        <!-- STATS -->
        <div class="row g-3">

            <div class="col-md-4">
                <div class="stat-card" style="background:#1e3a8a;">
                    <h2>{{ $stats['total_students'] ?? 0 }}</h2>
                    <span>Total Students</span>
                </div>
            </div>

            <div class="col-md-4">
                <div class="stat-card" style="background:#0f172a;">
                    <h2>{{ $stats['total_departments'] ?? 0 }}</h2>
                    <span>Departments</span>
                </div>
            </div>

            <div class="col-md-4">
                <div class="stat-card" style="background:#2563eb;">
                    <h2>{{ $stats['active_sessions'] ?? 0 }}</h2>
                    <span>Sessions</span>
                </div>
            </div>

        </div>

        <!-- BUTTON -->
        <div class="mt-4">
            <a href="{{ route('dept.students') }}" class="btn-custom">
                Go to Student Search
            </a>
                <a href="{{ url('/students/pdf') }}" class="btn btn-primary">
    Download PDF
    </a>
        </div>

    </div>

</div>

</body>
</html>

