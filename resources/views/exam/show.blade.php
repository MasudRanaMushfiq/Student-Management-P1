<h2>Student Details</h2>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<h3>Basic Information</h3>
<p><b>Student ID:</b> {{ $student->student_id }}</p>
<p><b>Full Name:</b> {{ $student->fullname }}</p>
<p><b>Exam Roll:</b> {{ $student->exam_roll }}</p>
<p><b>Applicant ID:</b> {{ $student->applicant_id }}</p>
<p><b>Gender:</b> {{ $student->gender }}</p>
<p><b>Date of Birth:</b> {{ $student->date_of_birth }}</p>
<p><b>Mobile:</b> {{ $student->mobile_no }}</p>
<p><b>Email:</b> {{ $student->em_address }}</p>

<h3>Academic Information</h3>
<p><b>SSC GPA:</b> {{ $student->ssc_gpa }}</p>
<p><b>SSC Board:</b> {{ $student->ssc_board }}</p>
<p><b>HSC GPA:</b> {{ $student->hsc_gpa }}</p>
<p><b>HSC Board:</b> {{ $student->hsc_board }}</p>

<h3>Admission Information</h3>
<p><b>Faculty:</b> {{ $student->faculty }}</p>
<p><b>Department:</b> {{ $student->department }}</p>
<p><b>Hall:</b> {{ $student->hall }}</p>
<p><b>Merit Position:</b> {{ $student->merit_position }}</p>
<p><b>Quota:</b> {{ $student->quota }}</p>

<h3>Payment</h3>
<p><b>Transaction ID:</b> {{ $student->payment_trxid }}</p>
<p><b>Amount:</b> {{ $student->payment_amount }}</p>

<br>

<a href="/exam/student/edit/{{ $student->id }}">
    <button>Edit Name Only</button>
</a>

