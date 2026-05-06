<!DOCTYPE html>
<html>
<head>
    <title>Student Search</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4f6f9;
        }

        .container {
            margin-top: 40px;
        }

        .card {
            border: none;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        table {
            font-size: 14px;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Student Search</h4>
        <a href="{{ route('dept.home') }}" class="btn btn-secondary btn-sm">Back</a>
    </div>



    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card p-3 mb-4">

        <form method="GET" action="{{ route('dept.students.search') }}">

            <div class="row g-3">

                <div class="col-md-4">
                    <label class="form-label">Department</label>
                    <select name="dept" class="form-select">
                        <option value="">All</option>
                        <option value="CSE" {{ request('dept') == 'CSE' ? 'selected' : '' }}>CSE</option>
                        <option value="EEE" {{ request('dept') == 'EEE' ? 'selected' : '' }}>EEE</option>
                        <option value="BBA" {{ request('dept') == 'BBA' ? 'selected' : '' }}>BBA</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Hall</label>
                    <select name="hall" class="form-select">
                        <option value="">All</option>
                        <option value="Motihar" {{ request('hall') == 'Motihar' ? 'selected' : '' }}>Motihar</option>
                        <option value="Shaheed" {{ request('hall') == 'Shaheed' ? 'selected' : '' }}>Shaheed</option>
                        <option value="Nawab" {{ request('hall') == 'Nawab' ? 'selected' : '' }}>Nawab</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <label class="form-label">Start Session</label>
                    <select name="start_session" class="form-select">
                        <option value="">Start</option>
                        @foreach($sessions as $session)
                            <option value="{{ $session }}" {{ request('start_session') == $session ? 'selected' : '' }}>
                                {{ $session }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <label class="form-label">End Session</label>
                    <select name="end_session" class="form-select">
                        <option value="">End</option>
                        @foreach($sessions as $session)
                            <option value="{{ $session }}" {{ request('end_session') == $session ? 'selected' : '' }}>
                                {{ $session }}
                            </option>
                        @endforeach
                    </select>
                </div>

            </div>

            <div class="mt-3">
                <button class="btn btn-primary">Search</button>
            </div>

        </form>

    </div>

    @if(isset($students) && $students->count() > 0)

        <div class="card p-3">

            <table class="table table-bordered table-hover">

                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Department</th>
                        <th>Hall</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($students as $student)
                        <tr>
                            <td>{{ $student->id }}</td>
                            <td>{{ $student->fullname ?? 'N/A' }}</td>
                            <td>{{ $student->department ?? 'N/A' }}</td>
                            <td>{{ $student->hall ?? 'N/A' }}</td>
                        </tr>
                    @endforeach
                </tbody>

            </table>

            <div class="d-flex justify-content-center mt-3">
                {{ $students->appends(request()->query())->links('pagination::bootstrap-5') }}
            </div>

        </div>

    @elseif(isset($students))

        <div class="alert alert-warning">
            No results found
        </div>

    @endif

</div>

</body>
</html>
