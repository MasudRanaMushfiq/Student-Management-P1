<!DOCTYPE html>
<html>
<head>
    <title>Audit Logs</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: #f4f6f9;
            padding: 20px;
        }

        .container {
            max-width: 1000px;
            margin: auto;
        }

        h2 {
            margin-bottom: 15px;
            font-size: 20px;
            color: #111827;
        }

        .card {
            background: white;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #eee;
            text-align: left;
        }

        th {
            background: #f9fafb;
            font-weight: bold;
            color: #374151;
        }

        tr:hover {
            background: #f3f4f6;
        }

        .badge {
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 12px;
            color: white;
        }

        .create { background: #16a34a; }
        .update { background: #2563eb; }
        .delete { background: #dc2626; }

        a {
            text-decoration: none;
            color: #2563eb;
        }

        a:hover {
            text-decoration: underline;
        }

        .pagination {
            margin-top: 15px;
        }

    </style>
</head>

<body>

<div class="container">

    <h2>Audit Logs</h2>

    <div class="card">

        <table>
            <thead>
                <tr>
                    <th>User</th>
                    <th>Action</th>
                    <th>Model</th>
                    <th>Time</th>
                    <th>Details</th>
                </tr>
            </thead>

            <tbody>
                @foreach($logs as $log)
                    <tr>
                        <td>
                            {{ $log->user->name ?? 'System' }}
                        </td>

                        <td>
                            <span class="badge {{ $log->action }}">
                                {{ strtoupper($log->action) }}
                            </span>
                        </td>

                        <td>
                            {{ class_basename($log->model_type) }}
                        </td>

                        <td>
                            {{ $log->created_at->diffForHumans() }}
                        </td>

                        <td>
                            <a href="{{ route('admin.logs.show', $log->id) }}">
                                View
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="pagination">
            {{ $logs->links() }}
        </div>

    </div>

</div>

</body>
</html>

