<h1>All Students</h1>

<p>Total Students: {{ $students->total() }}</p>

<table border="1" cellpadding="8" cellspacing="0">
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

<br>

<div>
    {{ $students->links() }}
</div>

