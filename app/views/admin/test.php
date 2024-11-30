<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<!-- Chart Card -->
<div class="chart-card">
    <div class="chart-header">
        <h3 class="chart-title">Job Applications by Category</h3>
    </div>
    <canvas id="applicationsChart" width="400" height="300"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Prepare data from PHP variable
    const applicationsByCategory = <?= json_encode($applicationsByCategory); ?>;
    const labels = applicationsByCategory.map(app => app.job_category);
    const data = applicationsByCategory.map(app => app.application_count);

    // Define colors for each category (you can modify this array to your needs)
    const categoryColors = [
        'rgba(99, 102, 241, 0.7)',   // Software Development
        'rgba(255, 99, 132, 0.7)',   // Web Development & Design
        'rgba(54, 162, 235, 0.7)',   // Data & Analytics
        'rgba(255, 159, 64, 0.7)',   // AI & Machine Learning
        'rgba(75, 192, 192, 0.7)',   // Cloud Computing & DevOps
        'rgba(153, 102, 255, 0.7)',  // Cybersecurity
        'rgba(255, 159, 64, 0.7)',   // IT Infrastructure & Networking
        'rgba(54, 162, 235, 0.7)',   // IT Management & Leadership
        'rgba(99, 102, 241, 0.7)',   // Software Testing & QA
        'rgba(255, 99, 132, 0.7)',   // Database Management
        'rgba(153, 102, 255, 0.7)',  // Emerging Technologies
        'rgba(75, 192, 192, 0.7)',   // Technical Writing & Documentation
        'rgba(255, 159, 64, 0.7)',   // IT Sales & Consulting
        'rgba(54, 162, 235, 0.7)',   // Specialized IT Fields
    ];

    // Ensure each category has a unique color
    const colors = applicationsByCategory.map((app, index) => categoryColors[index % categoryColors.length]);

    // Create the horizontal bar chart
    const ctx = document.getElementById('applicationsChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',  // Horizontal bar chart
        data: {
            labels: labels,
            datasets: [{
                label: 'Job Applications by Category',
                data: data,
                backgroundColor: colors,  // Use the dynamic colors for each bar
                borderColor: colors.map(color => color.replace('0.7', '1')),  // Darker shade for the border
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            indexAxis: 'y',  // Makes the chart horizontal
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Number of Applications'
                    },
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1,  // Ensures whole numbers on X axis
                        callback: function(value) {
                            return value % 1 === 0 ? value : ''; // Only show integer values
                        }
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Job Categories'
                    }
                }
            }
        }
    });
</script>


</body>
</html>