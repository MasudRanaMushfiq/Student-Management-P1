<h2>Edit Student Name</h2>

<form method="POST" action="/exam/student/update/{{ $student->id }}">
    @csrf

    <label>Full Name</label>
    <input type="text" name="fullname" value="{{ $student->fullname }}" required>

    <button type="submit">Update</button>
</form>

