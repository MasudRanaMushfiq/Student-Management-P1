<h1>Super Admin Dashboard</h1>
<p>Manage users and students</p>

<!-- =======================
     USERS SECTION (TOP)
======================= -->
<h2>All Users</h2>

<table border="1" cellpadding="8">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Current Role</th>
            <th>Assign Role</th>
        </tr>
    </thead>

    <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>

                <td>
                    {{ $user->getRoleNames()->first() ?? 'No Role' }}
                </td>

                <td>
                    <form method="POST" action="/admin/users/{{ $user->id }}/role">
                        @csrf

                        <select name="role">
                            <option value="dept"
                                {{ $user->hasRole('dept') ? 'selected' : '' }}>
                                Dept
                            </option>

                            <option value="exam-controller"
                                {{ $user->hasRole('exam-controller') ? 'selected' : '' }}>
                                Exam Controller
                            </option>

                            <option value="super-admin"
                                {{ $user->hasRole('super-admin') ? 'selected' : '' }}>
                                Super Admin
                            </option>
                        </select>

                        <button type="submit">Assign</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<hr>

<!-- =======================
     STUDENTS SECTION (BOTTOM)
======================= -->
<h2>Students</h2>

<a href="/admin/students">
    <button>View All Students (Paginated)</button>
</a>


