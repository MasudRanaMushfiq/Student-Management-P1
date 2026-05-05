<h2>Search Student</h2>

@if(session('error'))
    <p style="color:red">{{ session('error') }}</p>
@endif

<form method="GET" action="/exam/student/show">
    <input type="text" name="student_id" placeholder="Enter Student ID" required>
    <button type="submit">Search</button>
</form>

