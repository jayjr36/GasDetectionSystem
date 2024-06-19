@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center">Gas Detection System</h1>
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>Gas Level</th>
                <th>Fire Detected</th>
                <th>Timestamp</th>
            </tr>
        </thead>
        <tbody id="gas-readings">
            <!-- Data will be inserted here -->
        </tbody>
    </table>
</div>
<script src="{{ mix('js/app.js') }}"></script>
<script>
    function loadReadings() {
        fetch('/gas-readings')
            .then(response => response.json())
            .then(data => {
                const table = document.getElementById('gas-readings');
                table.innerHTML = '';
                data.forEach(reading => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${reading.gas_level}</td>
                        <td>${reading.fire_detected ? 'Yes' : 'No'}</td>
                        <td>${reading.created_at}</td>
                    `;
                    table.appendChild(row);
                });
            });
    }

    function startPolling() {
        loadReadings();
        setInterval(loadReadings, 5000); // Poll every 5 seconds
    }

    document.addEventListener('DOMContentLoaded', startPolling);
</script>
@endsection