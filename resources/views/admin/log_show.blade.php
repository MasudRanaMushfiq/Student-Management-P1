<!DOCTYPE html>
<html>
<head>
    <title>Audit Log Details</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: #f4f6f9;
            padding: 20px;
        }

        .container {
            max-width: 900px;
            margin: auto;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        h2 {
            margin-top: 0;
            font-size: 20px;
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
            margin-top: 12px;
            padding: 10px;
            border: 1px solid #eee;
            border-radius: 6px;
            background: #fafafa;
        }

        .field-name {
            font-weight: bold;
            margin-bottom: 6px;
        }

        .old {
            color: #dc2626;
            background: #fee2e2;
            padding: 4px 8px;
            border-radius: 5px;
            display: inline-block;
        }

        .new {
            color: #16a34a;
            background: #dcfce7;
            padding: 4px 8px;
            border-radius: 5px;
            display: inline-block;
        }

        .arrow {
            margin: 0 8px;
            font-weight: bold;
        }

        a {
            display: inline-block;
            margin-top: 15px;
            text-decoration: none;
            color: #2563eb;
        }
    </style>
</head>

<body>

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

        @foreach($log->old_values as $field => $change)

            <div class="field">

                <div class="field-name">{{ $field }}</div>

                <div>
                    <span class="old">
                        {{ $change['old'] ?? '-' }}
                    </span>

                    <span class="arrow">→</span>

                    <span class="new">
                        {{ $change['new'] ?? '-' }}
                    </span>
                </div>

            </div>

        @endforeach

        <a href="{{ route('admin.logs') }}">← Back to Logs</a>

    </div>

</div>

</body>
</html>

