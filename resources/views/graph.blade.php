@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center">Gas Detection System - Graph</h1>
    <div class="row mt-4">
        <div class="col">
            <canvas id="gasChart" width="400" height="200"></canvas>
        </div>
    </div>
</div>

<script src="{{ asset('js/app.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    function loadGasData(callback) {
        fetch('/gas-readings')
            .then(response => response.json())
            .then(data => {
                const labels = data.map(reading => new Date(reading.created_at).toLocaleString());
                const gasLevels = data.map(reading => reading.gas_level);

                callback(labels, gasLevels);
            });
    }

    function createChart(labels, gasLevels) {
        const ctx = document.getElementById('gasChart').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Gas Levels',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1,
                    data: gasLevels,
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    }

    function startPolling() {
        loadGasData((labels, gasLevels) => {
            createChart(labels, gasLevels);
        });

        setInterval(() => {
            loadGasData((labels, gasLevels) => {
                createChart(labels, gasLevels);
            });
        }, 5000); // Poll every 5 seconds
    }

    document.addEventListener('DOMContentLoaded', startPolling);
</script>
@endsection
