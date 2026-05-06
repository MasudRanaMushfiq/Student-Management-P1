<!DOCTYPE html>
<html>
<head>
    <title>Student Details</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            margin: 0;
            background: #f4f6f9;
            color: #111827;
        }

        /* TOP BAR */
        .topbar {
            background: #ffffff;
            padding: 12px 20px;
            border-bottom: 1px solid #e5e7eb;
        }

        .topbar h1 {
            margin: 0;
            font-size: 16px;
            font-weight: 600;
        }

        .container {
            max-width: 1000px;
            margin: auto;
            padding: 18px;
        }

        /* BACK BUTTON */
        .back-btn {
            display: inline-block;
            margin-bottom: 12px;
            padding: 6px 10px;
            font-size: 13px;
            background: #2563eb;
            border: 1px solid #ddd;
            border-radius: 5px;
            text-decoration: none;
            color: #fff;
        }

        .back-btn:hover {
            background: #0048d8;
        }

        /* CARD */
        .card {
            background: #fff;
            padding: 16px;
            border-radius: 8px;
            border: 1px solid #eee;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
            padding-bottom: 8px;
            border-bottom: 1px solid #eee;
        }

        .header h2 {
            margin: 0;
            font-size: 15px;
        }

        .success {
            color: #16a34a;
            font-size: 13px;
            margin: 5px 0 10px;
        }

        /* SECTION */
        .section {
            margin-top: 12px;
        }

        .section h3 {
            margin: 10px 0;
            font-size: 13px;
            color: #2563eb;
            font-weight: 600;
        }

        /* GRID */
        .grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 8px;
        }

        .item {
            background: #f9fafb;
            padding: 8px 10px;
            border-radius: 6px;
            font-size: 13px;
            border: 1px solid #f1f5f9;
        }

        .label {
            font-weight: 600;
            color: #374151;
        }

        /* BUTTON */
        .btn {
            display: inline-block;
            margin-top: 14px;
            padding: 8px 12px;
            background: #2563eb;
            color: white;
            border-radius: 6px;
            text-decoration: none;
            font-size: 13px;
        }

        .btn:hover {
            background: #1d4ed8;
        }

        /* RESPONSIVE */
        @media (max-width: 900px) {
            .grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 600px) {
            .grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

<div class="topbar">
    <h1>Student Details</h1>
</div>

<div class="container">

    <a href="javascript:history.back()" class="back-btn">← Back</a>

    <div class="card">

        <div class="header">
            <h2>Full Student Profile</h2>
                    <a href="/exam/student/edit/{{ $student->id }}" class="btn">
            Edit Name
        </a>
        </div>

        @if(session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif

        <!-- PERSONAL -->
        <div class="section">
            <h3>Personal Details</h3>
            <div class="grid">
                <div class="item"><span class="label">Student ID:</span> {{ $student->student_id }}</div>
                <div class="item"><span class="label">Name:</span> {{ $student->fullname }}</div>
                <div class="item"><span class="label">Roll:</span> {{ $student->exam_roll }}</div>
                <div class="item"><span class="label">Applicant:</span> {{ $student->applicant_id }}</div>
                <div class="item"><span class="label">Gender:</span> {{ $student->gender }}</div>
                <div class="item"><span class="label">DOB:</span> {{ $student->date_of_birth }}</div>
                <div class="item"><span class="label">Mobile:</span> {{ $student->mobile_no }}</div>
                <div class="item"><span class="label">Email:</span> {{ $student->em_address }}</div>
            </div>
        </div>

        <!-- SSC -->
        <div class="section">
            <h3>SSC Information</h3>
            <div class="grid">
                <div class="item"><span class="label">GPA:</span> {{ $student->ssc_gpa }}</div>
                <div class="item"><span class="label">Board:</span> {{ $student->ssc_board }}</div>
            </div>
        </div>

        <!-- HSC -->
        <div class="section">
            <h3>HSC Information</h3>
            <div class="grid">
                <div class="item"><span class="label">GPA:</span> {{ $student->hsc_gpa }}</div>
                <div class="item"><span class="label">Board:</span> {{ $student->hsc_board }}</div>
            </div>
        </div>

        <!-- ADMISSION -->
        <div class="section">
            <h3>Admission</h3>
            <div class="grid">
                <div class="item"><span class="label">Faculty:</span> {{ $student->faculty }}</div>
                <div class="item"><span class="label">Department:</span> {{ $student->department }}</div>
                <div class="item"><span class="label">Hall:</span> {{ $student->hall }}</div>
                <div class="item"><span class="label">Merit:</span> {{ $student->merit_position }}</div>
                <div class="item"><span class="label">Quota:</span> {{ $student->quota }}</div>
            </div>
        </div>

        <!-- PAYMENT -->
        <div class="section">
            <h3>Payment</h3>
            <div class="grid">
                <div class="item"><span class="label">Trx ID:</span> {{ $student->payment_trxid }}</div>
                <div class="item"><span class="label">Amount:</span> {{ $student->payment_amount }}</div>
            </div>
        </div>

    </div>
</div>

</body>
</html>

