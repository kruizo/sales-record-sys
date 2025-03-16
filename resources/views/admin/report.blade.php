@extends('layouts.admin')

@section('content')
<div class="flex justify-center items-center w-full">
    <div class="relative mt-10" style="height: 500px; min-width: 800px; padding-top: 20px; margin-left: 50px;">
        <h2 class="text-4xl font-extrabold text-gray-900 tracking-wide text-center">📊 Sales Report</h2>
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
                    backgroundColor: '#4F46E5',
                    borderColor: 'rgb(176, 9, 0)',
                    borderWidth: 1
                }]
            },
            options: {
                elements: {
                    line: {
                        borderColor: '#4F46E5', // Cool blue for the line
                        borderWidth: 3,  // Thicker line
                        tension: 0.4     // Smooth curves
                    },
                    point: {
                        radius: 5, 
                        backgroundColor: '#6366F1', // Purple shade
                        borderColor: '#4F46E5',
                        borderWidth: 2,
                        hoverRadius: 8, // Bigger hover effect
                        hoverBackgroundColor: '#F59E0B' // Orange hover
                    }
                },
                plugins: {
                    legend: {
                        position: 'top', // Move legend inside
                        labels: {
                            boxWidth: 15, 
                            padding: 15, 
                            color: '#1F2937' // Darker text
                        }
                    },
                    tooltip: {
                        backgroundColor: '#1E40AF', // Dark blue
                        titleFont: { size: 14, weight: 'bold' },
                        bodyFont: { size: 12 },
                        displayColors: false // Removes color box
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
