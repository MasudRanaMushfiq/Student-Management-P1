<!DOCTYPE html>
<html>
<head>
    <title>All Students</title>

    <style>
        /* ===== PAGE SETUP ===== */
        @page {
            margin: 36px; /* ~0.5 inch */
        }

        body {
            font-family: DejaVu Sans;
            font-size: 12px;
        }

        /* ===== HEADER ===== */
        .header {
            text-align: center;
            margin-bottom: 10px;
        }

        .university {
            font-size: 18px;
            font-weight: bold;
        }

        .unit {
            font-size: 13px;
            margin-top: 3px;
        }

        .title {
            text-align: center;
            margin: 10px 0 15px 0;
            font-size: 14px;
            font-weight: bold;
        }

        /* ===== TABLE ===== */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #000;
        }

        th {
            background-color: #f2f2f2;
        }

        th, td {
            padding: 6px;
            text-align: left;
        }
    </style>
</head>

<body>

    <!-- ===== UNIVERSITY HEADER ===== -->
    <div class="header">
        <div class="university">University of Rajshahi</div>
        <div class="unit">Unit: C (Science)</div>
    </div>

    <!-- ===== TABLE ===== -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Department</th>
                <th>Hall</th>
                <th>Merit Position</th>
            </tr>
        </thead>

        <tbody>
        @foreach($students as $student)
            <tr>
                <td>{{ $student->id }}</td>
                <td>{{ $student->fullname ?? 'N/A' }}</td>
                <td>{{ $student->em_address ?? 'N/A' }}</td>
                <td>{{ $student->department ?? 'N/A' }}</td>
                <td>{{ $student->hall ?? 'N/A' }}</td>
                <td>{{ $student->merit_position ?? 'N/A' }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

</body>
</html>

