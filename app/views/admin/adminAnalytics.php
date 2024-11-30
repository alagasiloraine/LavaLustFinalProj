<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Career Connect Analytics</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap">
    <style>
        :root {
            --sidebar-bg: #003479;
            --sidebar-hover: rgba(255, 255, 255, 0.1);
            --text-primary: rgba(255, 255, 255, 0.9);
            --text-secondary: rgba(255, 255, 255, 0.6);
            --active-item: rgba(255, 255, 255, 0.1);
            --card-bg: #ffffff;
            --body-bg: #f8fafc;
            --text-dark: #1e293b;
            --text-muted: #64748b;
            --success: #22c55e;
            --danger: #ef4444;
            --primary: #6366F1;
            --border-color: #e2e8f0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--body-bg);
            height: 100vh;
            display: flex;
            padding: 12px;
            color: var(--text-dark);
        }

        /* Sidebar styles - Kept exactly as in adminDashboard.php */
        .sidebar {
            background-color: var(--sidebar-bg);
            width: 280px;
            height: calc(100vh - 24px);
            padding: 1.5rem;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            border-radius: 16px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
            margin-right: 12px;
        }

        .sidebar::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border: 2px solid rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            pointer-events: none;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: var(--text-primary);
            margin-bottom: 1rem;
            padding: 0.5rem;
        }

        .logo-icon {
            width: 60px;
            height: 60px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .logo-icon img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 8px;
        }

        .logo-text-wrapper {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .logo-text {
            font-weight: 600;
            font-size: 16px;
            white-space: nowrap;
        }

        .logo-subtext {
            font-size: 11px;
            color: rgba(255, 255, 255, 0.7);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            white-space: nowrap;
        }

        .section-title {
            color: var(--text-secondary);
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin: 0.75rem 0 0.5rem;
            padding-left: 0.5rem;
        }

        .nav-menu {
            list-style: none;
        }

        .nav-item {
            margin-bottom: 0.25rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 0.5rem;
            color: var(--text-secondary);
            text-decoration: none;
            border-radius: 0.5rem;
            transition: all 0.2s ease;
            white-space: nowrap;
        }

        .nav-link:hover {
            background-color: var(--sidebar-hover);
            color: var(--text-primary);
        }

        .nav-link.active {
            background-color: var(--active-item);
            color: var(--text-primary);
        }

        .nav-icon {
            width: 20px;
            height: 20px;
            flex-shrink: 0;
        }

        /* Updated Analytics Content Styles */
        .main-content {
            flex: 1;
            padding: 24px;
            background: var(--card-bg);
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            border: 1px solid var(--border-color);
            overflow-y: auto;
        }

        .analytics-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            padding: 0 4px;
        }

        .analytics-title {
            font-size: 28px;
            font-weight: 700;
            color: var(--text-dark);
            background: linear-gradient(135deg, var(--text-dark) 0%, var(--primary) 100%);
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .dashboard-actions {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .select-wrapper {
            position: relative;
        }

        select {
            appearance: none;
            padding: 10px 36px 10px 12px;
            font-size: 14px;
            font-weight: 500;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            background-color: var(--card-bg);
            color: var(--text-dark);
            cursor: pointer;
            min-width: 160px;
            transition: all 0.2s ease;
        }

        select:hover {
            border-color: var(--primary);
        }

        select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.1);
        }

        .select-wrapper::after {
            content: '';
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            width: 10px;
            height: 10px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-size: contain;
            pointer-events: none;
        }

        .analytics-content {
            display: flex;
            gap: 24px;
        }

        .analytics-sidebar {
            width: 280px;
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 20px;
        }

        .filter-group {
            margin-bottom: 20px;
            position: relative;
        }

        .filter-label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 12px;
        }

        .checkbox-group {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .checkbox-label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            color: var(--text-dark);
            cursor: pointer;
        }

        .checkbox-input {
            width: 18px;
            height: 18px;
            border: 2px solid var(--border-color);
            border-radius: 4px;
            appearance: none;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .checkbox-input:checked {
            background-color: var(--primary);
            border-color: var(--primary);
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='white' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='20 6 9 17 4 12'%3E%3C/polyline%3E%3C/svg%3E");
            background-size: 12px;
            background-repeat: no-repeat;
            background-position: center;
        }

        .filter-select {
            width: 100%;
            margin-bottom: 8px;
            appearance: none;
            padding: 12px 36px 12px 16px;
            font-size: 14px;
            font-weight: 500;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            background-color: var(--card-bg);
            color: var(--text-dark);
            cursor: pointer;
            transition: all 0.2s ease;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%236b7280' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            background-size: 16px;
        }

        .filter-select:hover {
            border-color: var(--primary);
            background-color: var(--body-bg);
        }

        .filter-select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }

        .date-range {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .date-input {
            width: 100%;
            padding: 10px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 14px;
            color: var(--text-dark);
            background-color: var(--card-bg);
            transition: all 0.2s ease;
        }

        .date-input:hover,
        .date-input:focus {
            border-color: var(--primary);
            outline: none;
        }

        .analytics-main {
            flex: 1;
        }

        .metric-card {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 24px;
        }

        .metric-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .metric-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--text-dark);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 24px;
        }

        .stat-card {
            background: var(--card-bg);
            padding: 20px;
            border-radius: 12px;
            border: 1px solid var(--border-color);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
        }

        .stat-title {
            font-size: 14px;
            color: var(--text-muted);
            margin-bottom: 8px;
        }

        .stat-value {
            font-size: 24px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 8px;
        }

        .stat-change {
            display: flex;
            align-items: center;
            gap: 4px;
            font-size: 14px;
            font-weight: 500;
        }

        .stat-change.positive {
            color: var(--success);
        }

        .stat-change.negative {
            color: var(--danger);
        }

        .metric-chart {
            height: 300px;
            background: var(--body-bg);
            border-radius: 12px;
            padding: 20px;
            margin-top: 20px;
        }

        .mt-auto {
            margin-top: auto;
        }

        @media (max-width: 1024px) {
            .analytics-content {
                flex-direction: column;
            }

            .analytics-sidebar {
                width: 100%;
            }
        }

        @media (max-width: 768px) {
            body {
                padding: 12px;
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                height: auto;
                margin-right: 0;
                margin-bottom: 12px;
            }

            .main-content {
                width: 100%;
            }

            .analytics-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }

            .dashboard-actions {
                width: 100%;
            }

            .select-wrapper {
                width: 100%;
            }

            select {
                width: 100%;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <!-- Sidebar - Kept exactly as in adminDashboard.php -->
    <?php
    include APP_DIR.'views/templates/adminNav.php';
    ?>

    <main class="main-content">
        <div class="analytics-header">
            <h1 class="analytics-title">Analytics</h1>
            <div class="dashboard-actions">
            </div>
        </div>

        <div class="analytics-content">
            <!-- <aside class="analytics-sidebar">
                <div class="filter-group">
                    <label class="filter-label">Job Categories</label>
                    <select class="filter-select">
                        <option>All Categories</option>
                        <option value="Software Development">Software Development</option>
                        <option value="Web Development & Design">Web Development & Design</option>
                        <option value="Data & Analytics">Data & Analytics</option>
                        <option value="Artificial Intelligence & Machine Learning">Artificial Intelligence & Machine Learning</option>
                        <option value="Cloud Computing & DevOps">Cloud Computing & DevOps</option>
                        <option value="Cybersecurity">Cybersecurity</option>
                        <option value="IT Infrastructure & Networking">IT Infrastructure & Networking</option>
                        <option value="IT Management & Leadership">IT Management & Leadership</option>
                        <option value="Software Testing & Quality Assurance">Software Testing & Quality Assurance</option>
                        <option value="Database Management">Database Management</option>
                        <option value="Emerging Technologies">Emerging Technologies</option>
                        <option value="Technical Writing & Documentation">Technical Writing & Documentation</option>
                        <option value="IT Sales & Consulting">IT Sales & Consulting</option>
                        <option value="Specialized IT Fields">Specialized IT Fields</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label class="filter-label">Job Type</label>
                    <select class="filter-select">
                        <option>All</option>
                        <option>Full-time</option>
                        <option>Part-time</option>
                        <option>Remote</option>
                    </select>
                </div>

            
            </aside> -->

            <div class="analytics-main">
                <div class="metric-card">
                    <div class="metric-header">
                        <h3 class="metric-title">Job Performance Overview</h3>
                    </div>
                    <div class="stats-grid">
                        <div class="stat-card">
                            <h3 class="stat-title">Applications</h3>
                            <div class="stat-value"><?= $currentWeek['appliedApplications'] ?? '0'; ?></div>
                            <div class="stat-change <?= $rates['appliedRate'] >= 0 ? 'positive' : 'negative'; ?>">
                            <?php if ($rates['appliedRate'] >= 0) :?>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M18 15l-6-6-6 6" />
                                </svg>
                            <?php else :?>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M6 9l6 6 6-6" />
                                </svg>
                            <?php endif;?>
                            <?= number_format($rates['appliedRate'], 1) . '%'; ?>
                            </div>
                        </div>
                        <div class="stat-card">
                            <h3 class="stat-title">Active Jobs</h3>
                            <div class="stat-value"><?= $currentWeek['jobs'] ?? '0'; ?></div>
                            <div class="stat-change <?= $rates['jobsRate'] >= 0 ? 'positive' : 'negative'; ?>">
                            <?php if ($rates['jobsRate'] >= 0) :?>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M18 15l-6-6-6 6" />
                                </svg>
                            <?php else :?>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M6 9l6 6 6-6" />
                                </svg>
                            <?php endif;?>
                            <?= number_format($rates['jobsRate'], 1) . '%'; ?>
                            </div>
                        </div>
                        <div class="stat-card">
                            <h3 class="stat-title">Inactive Jobs</h3>
                            <div class="stat-value"><?= $currentWeek['inactiveJobs'] ?? '0'; ?></div>
                            <div class="stat-change <?= $rates['inactiveJobsRate'] >= 0 ? 'negative' : 'positive'; ?>">
                            <?php if ($rates['inactiveJobsRate'] >= 0) :?>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M18 15l-6-6-6 6" />
                                </svg>
                            <?php else :?>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M6 9l6 6 6-6" />
                                </svg>
                            <?php endif;?>
                            <?= number_format($rates['inactiveJobsRate'], 1) . '%'; ?>
                            </div>
                        </div>
                    </div>
                    <div class="metric-chart">
                        <canvas id="applicationsByCategoryAndDateChart" width="1000" height="300"></canvas>
                    </div>
                </div>

                <div class="metric-card">
                    <div class="metric-header">
                        <h3 class="metric-title">Application Status</h3>
                    </div>
                    <div class="metric-chart">
                        <canvas id="applicationsByStatusChart" width="1000" height="300"></canvas>
                    </div>
                </div>

                <div class="metric-card">
                    <div class="metric-header">
                        <h3 class="metric-title">Job Type</h3>
                    </div>
                    <div class="metric-chart">
                        <canvas id="jobsByTypeChart" width="1000" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </main>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const applicationsByStatus = <?= json_encode($applicationsByStatus); ?>;

    const labels = applicationsByStatus.map(app => app.status);
    const data = applicationsByStatus.map(app => app.application_count);

    const ctx = document.getElementById('applicationsByStatusChart').getContext('2d');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,  // The status names (Hired, Applied, Scheduled, Rejected)
            datasets: [{
                label: 'Application Count',
                data: data,  // The count of applications for each status
                backgroundColor: [
                    'rgba(99, 102, 241, 0.5)',   // Hired
                    'rgba(34, 167, 240, 0.5)',   // Applied
                    'rgba(252, 165, 165, 0.5)',  // Scheduled
                    'rgba(239, 68, 68, 0.5)'     // Rejected
                ],
                borderColor: [
                    'rgba(99, 102, 241, 1)',   // Hired
                    'rgba(34, 167, 240, 1)',   // Applied
                    'rgba(252, 165, 165, 1)',  // Scheduled
                    'rgba(239, 68, 68, 1)'     // Rejected
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            indexAxis: 'y',  // This makes the bars horizontal
            plugins: {
                legend: {
                    display: false  // You can disable the legend if it's not needed
                }
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Number of Applications'
                    },
                    beginAtZero: true,  // Ensure the x-axis starts at 0
                    ticks: {
                        stepSize: 1, // Ensure that the ticks are whole numbers
                        callback: function(value) {
                            return value % 1 === 0 ? value : ''; // Only display whole numbers
                        }
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Application Status'
                    },
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1, // Ensure that the ticks are whole numbers
                        callback: function(value) {
                            return value % 1 === 0 ? value : ''; // Only display whole numbers
                        }
                    }
                }
            }
        }
    });

    
    const rawData = <?= json_encode($applicationsByCategoryAndDate); ?>;

    const categoryData = {};
    rawData.forEach(row => {
        if (!categoryData[row.job_category]) {
            categoryData[row.job_category] = {};
        }
        categoryData[row.job_category][row.application_date] = row.application_count;
    });

    const allDates = Array.from(new Set(rawData.map(row => row.application_date))).sort();

    const colors = [
        'rgba(99, 102, 241, 1)', // Blue
        'rgba(255, 99, 132, 1)', // Red
        'rgba(54, 162, 235, 1)', // Light Blue
        'rgba(255, 159, 64, 1)', // Orange
        'rgba(75, 192, 192, 1)', // Teal
        'rgba(153, 102, 255, 1)', // Purple
        'rgba(255, 205, 86, 1)', // Gold
        'rgba(201, 203, 207, 1)'  // Light Grey
    ];

    const datasets = Object.keys(categoryData).map((category, index) => {
        return {
            label: category,
            data: allDates.map(date => categoryData[category][date] || 0), // Fill missing dates with 0
            borderColor: colors[index % colors.length],
            borderWidth: 2,
            fill: false
        };
    });

    const ctx2 = document.getElementById('applicationsByCategoryAndDateChart').getContext('2d');
    new Chart(ctx2, {
        type: 'line',
        data: {
            labels: allDates, // Dates on the x-axis
            datasets: datasets
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true
                }
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Date'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Number of Applications'
                    },
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1, // Ensure that the ticks are whole numbers
                        callback: function(value) {
                            return value % 1 === 0 ? value : ''; // Only display whole numbers
                        }
                    }
                }
            }
        }
    });


    const jobsByType = <?= json_encode($jobsByType); ?>;

    const jobTypes = jobsByType.map(job => job.job_type);
    const jobCounts = jobsByType.map(job => job.job_count);

    const colors2 = {
        full_time: 'rgba(54, 162, 235, 1)', // Blue
        part_time: 'rgba(255, 99, 132, 1)', // Red
        remote: 'rgba(75, 192, 192, 1)'    // Teal
    };

    const backgroundColors = jobTypes.map(type => colors2[type] || 'rgba(153, 102, 255, 1)'); // Default color for unknown types

    const ctx3 = document.getElementById('jobsByTypeChart').getContext('2d');
    new Chart(ctx3, {
        type: 'bar',
        data: {
            labels: jobTypes, // Job types on the y-axis
            datasets: [{
                label: 'Number of Jobs',
                data: jobCounts,
                backgroundColor: backgroundColors,
                borderWidth: 1
            }]
        },
        options: {
            indexAxis: 'y', // Makes it a horizontal bar chart
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Number of Jobs'
                    },
                    beginAtZero: true
                },
                y: {
                    title: {
                        display: true,
                        text: 'Job Type'
                    }
                }
            }
        }
    });

</script>
</body>

</html>