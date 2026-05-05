<!DOCTYPE html>
<html>
<head>
    <title>All Students</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            margin: 0;
            background: #f5f6f8;
            padding: 20px;
        }

        .container {
            max-width: 1100px;
            margin: auto;
        }

        .header {
            margin-bottom: 15px;
        }

        .header h1 {
            font-size: 20px;
            margin: 0;
        }

        .header p {
            margin: 5px 0 0;
            color: #666;
            font-size: 14px;
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
            cursor: pointer;
        }

        .back-btn:hover {
            background: #f1f1f1;
        }

        .card {
            background: white;
            padding: 15px;
            border-radius: 6px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.05);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        th, td {
            padding: 10px;
            border-bottom: 1px solid #eee;
            text-align: left;
        }

        th {
            background: #f9fafb;
            font-weight: 600;
            font-size: 13px;
            color: #333;
        }

        tr:hover {
            background: #fafafa;
        }

        .pagination {
            margin-top: 15px;
            display: flex;
            justify-content: center;
        }

        .pagination svg {
            width: 14px;
            height: 14px;
        }

        .pagination a, .pagination span {
            font-size: 16px;
        }

        .total {
            font-size: 13px;
            color: #555;
            margin-top: 5px;
        }
    </style>
</head>

<body>

<div class="container">

    <!-- HEADER -->
    <div class="header">
        <h1>All Students</h1>
        <p class="total">Total Students: {{ $students->total() }}</p>
    </div>

    <!-- BACK BUTTON -->
    <a href="javascript:history.back()" class="back-btn">← Back</a>

    <!-- TABLE CARD -->
    <div class="card">

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Exam Roll</th>
                    <th>Student ID</th>
                    <th>Full Name</th>
                    <th>Department</th>
                    <th>Hall</th>
                    <th>Mobile</th>
                </tr>
            </thead>

            <tbody>
                @foreach($students as $student)
                    <tr>
                        <td>{{ $student->id }}</td>
                        <td>{{ $student->exam_roll }}</td>
                        <td>{{ $student->student_id }}</td>
                        <td>{{ $student->fullname }}</td>
                        <td>{{ $student->department }}</td>
                        <td>{{ $student->hall }}</td>
                        <td>{{ $student->mobile_no }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

    <!-- PAGINATION -->
    <div class="pagination">
        {{ $students->links() }}
    </div>

</div>

</body>
</html>

