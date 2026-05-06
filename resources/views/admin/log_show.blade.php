<!DOCTYPE html>
<html>
<head>
    <title>Audit Log Details</title>

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

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 220px;
            height: 100%;
            background: #1f2937;
            color: white;
            padding-top: 20px;
        }

        .sidebar h2 {
            text-align: center;
            font-size: 18px;
            margin-bottom: 30px;
        }

        .sidebar a {
            display: block;
            padding: 12px 20px;
            color: #ddd;
            text-decoration: none;
            font-size: 14px;
        }

        .sidebar a.active,
        .sidebar a:hover {
            background: #374151;
            color: white;
        }

        .main {
            margin-left: 220px;
        }

        .topbar {
            background: white;
            padding: 15px 20px;
            border-bottom: 1px solid #ddd;
            display: flex;
            justify-content: space-between;
        }

        .content {
            padding: 20px;
        }

        .container {
            max-width: 900px;
            margin: auto;
        }

        .card {
            background: white;
            padding: 18px;
            border-radius: 8px;
            border: 1px solid #eee;
        }

        h2 {
            margin-top: 0;
            font-size: 18px;
        }

        .row {
            margin-bottom: 10px;
            font-size: 14px;
            color: #374151;
        }

        .label {
            font-weight: bold;
            color: #111827;
        }

        .badge {
            padding: 4px 10px;
            border-radius: 6px;
            color: white;
            font-size: 12px;
        }

        .update { background: #2563eb; }
        .create { background: #16a34a; }
        .delete { background: #dc2626; }

        .field {
            margin-top: 10px;
            padding: 10px;
            border: 1px solid #eee;
            border-radius: 6px;
            background: #fafafa;
        }

        .field-name {
            font-weight: bold;
            margin-bottom: 6px;
            font-size: 13px;
        }

        .old {
            color: #dc2626;
            background: #fee2e2;
            padding: 4px 8px;
            border-radius: 5px;
            display: inline-block;
            font-size: 13px;
        }

        .new {
            color: #16a34a;
            background: #dcfce7;
            padding: 4px 8px;
            border-radius: 5px;
            display: inline-block;
            font-size: 13px;
        }

        .arrow {
            margin: 0 8px;
            font-weight: bold;
        }

        .back-btn {
            display: inline-block;
            margin-top: 15px;
            padding: 8px 12px;
            background: #2563eb;
            color: white;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
        }

        .back-btn:hover {
            background: #1d4ed8;
        }

        .btn-danger {
            background: #dc2626;
            color: white;
            border: none;
            padding: 6px 10px;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>

<body>

<div class="sidebar">
    <h2>Super Admin</h2>

    <a href="/admin/dashboard">Dashboard</a>
    <a href="/admin/dashboard?section=students">Students</a>
    <a href="{{ route('admin.logs') }}" class="active">Audit Logs</a>

    <form method="POST" action="/logout" style="margin-top: 20px; padding: 0 20px;">
        @csrf
        <button class="btn-danger" style="width:100%;">Logout</button>
    </form>
</div>

<div class="main">

    <div class="topbar">
        <h1>Audit Log Details</h1>
        <div>Welcome, {{ auth()->user()->name }}</div>
    </div>

    <div class="content">

        <div class="container">

            <div class="card">

                <h2>Audit Log Details</h2>

                <div class="row">
                    <span class="label">User:</span>
                    {{ $log->user->name ?? 'System' }}
                </div>

                <div class="row">
                    <span class="label">Action:</span>
                    <span class="badge {{ strtolower($log->action) }}">
                        {{ strtoupper($log->action) }}
                    </span>
                </div>

                <div class="row">
                    <span class="label">Model:</span>
                    {{ class_basename($log->model_type) }}
                </div>

                <div class="row">
                    <span class="label">Date:</span>
                    {{ $log->created_at->format('Y-m-d H:i:s') }}
                </div>

                <hr>

                <h3>Changes</h3>

                @php
                    $old = $log->old_values ?? [];
                    $new = $log->new_values ?? [];
                @endphp

                @foreach($old as $field => $oldValue)

                    <div class="field">

                        <div class="field-name">
                            {{ str_replace('_', ' ', ucfirst($field)) }}
                        </div>

                        <div>
                            <span class="old">
                                {{ is_array($oldValue) ? json_encode($oldValue) : $oldValue }}
                            </span>

                            <span class="arrow">→</span>

                            <span class="new">
                                {{ is_array($new[$field] ?? null) ? json_encode($new[$field]) : ($new[$field] ?? '-') }}
                            </span>
                        </div>

                    </div>

                @endforeach

                <a href="{{ route('admin.logs') }}" class="back-btn">
                    Back to Logs
                </a>

            </div>

        </div>

    </div>

</div>

</body>
</html>

