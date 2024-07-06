<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            height: 100vh;
        }
        .sidebar {
            width: 250px;
            background-color: #343a40;
            padding: 15px;
        }
        .sidebar a {
            color: #fff;
            display: block;
            padding: 10px;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .content {
            flex-grow: 1;
            padding: 20px;
        }
        iframe {
            width: 100%;
            height: 100%;
            border: none;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2 class="text-white text-center py-5">ADMIN</h2>
        {{-- <a href="{{ route('admin.dashboard') }}" target="content">Dashboard</a> --}}
    <div style="height: 50px;"></div>
        <a href="{{ route('admin.users') }}" target="content" class="btn btn-outline-primary mb-2">Manage Users</a>
        <a href="{{ route('admin.emailLogs') }}" target="content" class="btn btn-outline-primary mb-2">Email Logs</a>
        <a href="{{ url('/display-page') }}" class="btn btn-outline-primary mb-2">
            Gas Readings
        </a>
        <!-- Add more links as needed -->
    </div>
    
    <div class="content">
        <iframe name="content" src="{{ route('admin.users') }}"></iframe>
    </div>
</body>
</html>
