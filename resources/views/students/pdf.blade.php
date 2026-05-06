<!DOCTYPE html>
<html>
<head>
    <title>Student List</title>
    <style>
        body { font-family: DejaVu Sans; }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>

<h2>Student List</h2>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Department</th>
        </tr>
    </thead>
    <tbody>
        @foreach($students as $student)
            <tr>
                <td>{{ $student->id }}</td>
                <td>{{ $student->name }}</td>
                <td>{{ $student->department->name ?? 'N/A' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>

