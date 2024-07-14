<!DOCTYPE html>
<html>
<head>
    <title>Gas Readings</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h4 class="text-center">Gas Detectionn System</h4>
    <h5 class="text-center">Below is a summary of all values recorded</h5>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Gas Level</th>
                <th>Fire Detected</th>
                <th>Created At</th>
                {{-- <th>Updated At</th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach ($gasReadings as $reading)
                <tr>
                    <td>{{ $reading->id }}</td>
                    <td>{{ $reading->gas_level }}</td>
                    <td>{{ $reading->fire_detected ? 'Yes' : 'No' }}</td>
                    <td>{{ $reading->created_at }}</td>
                    {{-- <td>{{ $reading->updated_at }}</td> --}}
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
