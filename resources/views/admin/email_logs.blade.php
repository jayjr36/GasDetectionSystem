@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Email Logs</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Sender</th>
                <th>Receiver Name</th>
                <th>Receiver Email</th>
                <th>Message</th>
                <th>Sent At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($emailLogs as $log)
                <tr>
                    <td>{{ $log->id }}</td>
                    <td>{{ $log->user->name }}</td>
                    <td>{{ $log->receiver_name }}</td>
                    <td>{{ $log->receiver_email }}</td>
                    <td>{{ $log->message }}</td>
                    <td>{{ $log->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
