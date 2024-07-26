<h1>Dashboard Paramedis</h1>

@if (session('status'))
    <p>{{ session('status') }}</p>
@endif

<table border="1">
    <thead>
        <tr>
            <th>Full Name</th>
            <th>Date of Birth</th>
            <th>Mountain</th>
            <th>Citizenship</th>
            <th>Country</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Question 1</th>
            <th>Question 2</th>
            <th>Question 3</th>
            <th>Additional Notes</th>
            <th>Status</th>
            <th>Queue Number</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($scans as $scan)
            <tr>
                <td>{{ $scan->full_name }}</td>
                <td>{{ $scan->date_of_birth }}</td>
                <td>{{ $scan->mountain }}</td>
                <td>{{ $scan->citizenship }}</td>
                <td>{{ $scan->country }}</td>
                <td>{{ $scan->address }}</td>
                <td>{{ $scan->phone }}</td>
                <td>{{ $scan->email }}</td>
                <td>{{ $scan->question1 }}</td>
                <td>{{ $scan->question2 }}</td>
                <td>{{ $scan->question3 }}</td>
                <td>{{ $scan->additional_notes }}</td>
                <td>{{ $scan->status }}</td>
                <td>{{ $scan->queue_number }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
