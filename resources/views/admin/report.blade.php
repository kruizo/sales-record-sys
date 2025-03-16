@extends('layouts.admin')

@section('content')
<div class="container mx-auto  w-full">
    <h2 class="text-2xl font-bold mb-4 top-4 left-6 ml-6 mt-6 text-center">Sales Report</h2>
    
    <div class="relative w-full" style="height: 500px; min-width: 800px; padding-top: 20px;">
        <canvas id="salesChart"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    
    document.addEventListener("DOMContentLoaded", function () {
        const ctx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(ctx, {
            type: 'line', // Change to 'line' if you prefer
            data: {
                labels: @json($labels), // Dates on x-axis
                datasets: [{
                    label: 'Total Sales',
                    data: @json($sales), // Sales data on y-axis
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgb(176, 9, 0)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        top: 30,
                        bottom: 0,
                        left: 200,
                        right: 0, // Adds space above the chart
                    }
                },
            plugins: {
                legend: {
                    position: 'left',
                    labels: {
                    font: {
                        size: 14
                    }
                    }
                }
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
        });
        setTimeout(() => {
            salesChart.resize();
        }, 500);
    });
</script>
@endsection
