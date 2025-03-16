@extends('layouts.admin')

@section('content')
<div class="container mx-auto  w-full">
    <h2 class="text-2xl font-bold mb-6 top-4 left-6 ml-6">Sales Report</h2>
    
    <div class="relative w-full" style="height: 500px; min-width: 800px; padding-top: 20px;">
        <canvas id="salesChart"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    
    document.addEventListener("DOMContentLoaded", function () {
        const ctx = document.getElementById('salesChart').getContext('2d');

        const salesChart = new Chart(ctx, {
            type: 'bar', // Change to 'line' if you prefer
            datasets: [
                {
                    label: 'Alkaline Sales',
                    data: @json($alkaline_sales), // Alkaline sales
                    backgroundColor: 'rgba(54, 162, 235, 0.5)', // Blue
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Mineral Sales',
                    data: @json($mineral_sales), // Mineral sales
                    backgroundColor: 'rgba(75, 192, 192, 0.5)', // Green
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Distilled Sales',
                    data: @json($distilled_sales), // Distilled sales
                    backgroundColor: 'rgba(255, 99, 132, 0.5)', // Red
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }
            ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        top: 30,
                        bottom: 0,
                        left: 50,
                        right: 50, // Adds space above the chart
                    }
                },
            plugins: {
                legend: {
                    position: 'top',
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
