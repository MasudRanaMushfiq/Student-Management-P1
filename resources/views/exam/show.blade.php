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
        }

        .topbar {
            background: #fff;
            padding: 15px 20px;
            border-bottom: 1px solid #ddd;
        }

        .topbar h1 {
            margin: 0;
            font-size: 18px;
        }

        .container {
            max-width: 1100px;
            margin: auto;
            padding: 20px;
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
        }

        .back-btn:hover {
            background: #f1f1f1;
        }

        .card {
            background: #fff;
            padding: 20px;
            border-radius: 6px;
            box-shadow: 0 1px 5px rgba(0,0,0,0.05);
            margin-bottom: 20px;
        }

        h2 {
            margin-top: 0;
            font-size: 16px;
            border-bottom: 1px solid #eee;
            padding-bottom: 8px;
        }

        h3 {
            margin-top: 15px;
            font-size: 14px;
            color: #2563eb;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px 15px;
            font-size: 14px;
        }

        .item {
            background: #f9fafb;
            padding: 10px;
            border-radius: 5px;
        }

        .label {
            font-weight: bold;
            color: #444;
        }

        .success {
            color: green;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .btn {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 15px;
            background: #2563eb;
            color: white;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-size: 14px;
        }

        .btn:hover {
            background: #1d4ed8;
        }

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

    <!-- BACK BUTTON -->
    <a href="javascript:history.back()" class="back-btn">← Back</a>

    <div class="card">

        <h2>Full Student Profile</h2>

        @if(session('success'))
            <p class="success">{{ session('success') }}</p>
        @endif

        <!-- PERSONAL DETAILS -->
        <h3>Personal Details</h3>
        <div class="grid">
            <div class="item"><span class="label">Student ID:</span> {{ $student->student_id }}</div>
            <div class="item"><span class="label">Full Name:</span> {{ $student->fullname }}</div>
            <div class="item"><span class="label">Exam Roll:</span> {{ $student->exam_roll }}</div>
            <div class="item"><span class="label">Applicant ID:</span> {{ $student->applicant_id }}</div>
            <div class="item"><span class="label">Gender:</span> {{ $student->gender }}</div>
            <div class="item"><span class="label">DOB:</span> {{ $student->date_of_birth }}</div>
            <div class="item"><span class="label">Mobile:</span> {{ $student->mobile_no }}</div>
            <div class="item"><span class="label">Email:</span> {{ $student->em_address }}</div>
        </div>

        <!-- SSC INFO -->
        <h3>SSC Information</h3>
        <div class="grid">
            <div class="item"><span class="label">SSC GPA:</span> {{ $student->ssc_gpa }}</div>
            <div class="item"><span class="label">SSC Board:</span> {{ $student->ssc_board }}</div>
        </div>

        <!-- HSC INFO -->
        <h3>HSC Information</h3>
        <div class="grid">
            <div class="item"><span class="label">HSC GPA:</span> {{ $student->hsc_gpa }}</div>
            <div class="item"><span class="label">HSC Board:</span> {{ $student->hsc_board }}</div>
        </div>

        <!-- ADMISSION INFO -->
        <h3>Admission Information</h3>
        <div class="grid">
            <div class="item"><span class="label">Faculty:</span> {{ $student->faculty }}</div>
            <div class="item"><span class="label">Department:</span> {{ $student->department }}</div>
            <div class="item"><span class="label">Hall:</span> {{ $student->hall }}</div>
            <div class="item"><span class="label">Merit Position:</span> {{ $student->merit_position }}</div>
            <div class="item"><span class="label">Quota:</span> {{ $student->quota }}</div>
        </div>

        <!-- PAYMENT INFO -->
        <h3>Payment Information</h3>
        <div class="grid">
            <div class="item"><span class="label">Transaction ID:</span> {{ $student->payment_trxid }}</div>
            <div class="item"><span class="label">Amount:</span> {{ $student->payment_amount }}</div>
        </div>

        <!-- EDIT BUTTON -->
        <a href="/exam/student/edit/{{ $student->id }}" class="btn">
            Edit Name Only
        </a>

    </div>

</div>

</body>
</html>

