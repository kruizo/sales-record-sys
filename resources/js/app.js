import "./bootstrap";
import "flowbite";
import "../css/app.css";
// import Chart from "chart.js/auto";

// // Add this script to your Blade template or a separate JS file
// document.addEventListener('DOMContentLoaded', function() {
//     const reportsTab = document.getElementById('reportsTab');
    
//     if (reportsTab) {
//         reportsTab.addEventListener('click', function(e) {
//             e.preventDefault();
//             printDashboard();
//         });
//     }
// });
// function printDashboard() {
//     const dashboardContent = document.getElementById('dashboardContent').innerHTML;
    
//     const printWindow = window.open('', '_blank');
    
//     printWindow.document.write(`
//         <!DOCTYPE html>
//         <html>
//         <head>
//             <title>Dashboard Report</title>
//             <script src="https://cdn.tailwindcss.com"></script>
//             <style>
//                 @page {
//                     size: A4;
//                     margin: 1cm;
//                 }
//                 @media print {
//                     body {
//                         font-size: 12pt;
//                         line-height: 1.5;
//                         color: #000;
//                         background: none;
//                     }
//                     .print-header {
//                         border-bottom: 2px solid #000;
//                         margin-bottom: 1rem;
//                         padding-bottom: 0.5rem;
//                     }
//                     .print-section {
//                         margin-bottom: 1.5rem;
//                         page-break-inside: avoid;
//                     }
//                     .print-list {
//                         margin-left: 1.5rem;
//                     }
//                     .no-print {
//                         display: none !important;
//                     }
//                 }
//             </style>
//         </head>
//         <body class="p-4 font-sans">
//             <div class="print-header">
//                 <h1 class="text-2xl font-bold">Dashboard Report</h1>
//                 <p class="text-sm text-gray-600">Printed on ${new Date().toLocaleDateString()}</p>
//             </div>
            
//             <div class="space-y-6">
//                 ${dashboardContent}
//             </div>
            
//             <script>
                
//                 window.onload = function() {
//                     setTimeout(function() {
//                         window.print();
//                         window.close();
//                     }, 200);
//                 }
                
//             </script>
//         </body>
//         </html>
//     `);
    
//     printWindow.document.close();
// }

document.getElementById('reportsTab').addEventListener('click', function(e) {
    e.preventDefault();
    preparePrintContent();
    window.print();
});

function preparePrintContent() {
    // Clone the dashboard content
    const content = document.getElementById('dashboardContent').cloneNode(true);
    
    // Set the print date
    document.getElementById('printDate').textContent = new Date().toLocaleDateString();
    
    // Clear and repopulate print content
    const printContent = document.getElementById('printContent');
    printContent.innerHTML = '';
    printContent.appendChild(content);
    
    // Apply print-specific classes
    const elements = printContent.querySelectorAll('*');
    elements.forEach(el => {
        el.classList.add('print:block', 'print:w-full');
        el.classList.remove('print:hidden');
    });
}