<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Career Connect Dashboard</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap">
  <link href="<?=base_url();?>public/css/dashboard.css" rel="stylesheet">
</head>

<body>
  <!-- Sidebar - Kept exactly as in adminDashboard.php -->
  <?php
    include APP_DIR.'views/templates/adminNav.php';
  ?>


  <main class="main-content">
    <div class="dashboard-header">
      <h1 class="dashboard-title">Dashboard Overview</h1>
    </div>

    <div class="stats-grid">
      <div class="stat-card">
        <h3 class="stat-title">Total Users</h3>
        <div class="stat-value"><?= $currentWeek['users'] ?? '0'; ?></div>
        <div class="stat-change <?= $rates['usersRate'] >= 0 ? 'positive' : 'negative'; ?>">
          <?php if ($rates['usersRate'] >= 0) :?>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M18 15l-6-6-6 6" />
            </svg>
          <?php else :?>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M6 9l6 6 6-6" />
            </svg>
          <?php endif;?>
          <?= number_format($rates['usersRate'], 1) . '%'; ?>
        </div>
      </div>
      <div class="stat-card">
        <h3 class="stat-title">Active jobs</h3>
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
        <h3 class="stat-title">Job Applications</h3>
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
        <h3 class="stat-title">Hired</h3>
        <div class="stat-value"><?= $currentWeek['hiredApplications'] ?? '0'; ?></div>
        <div class="stat-change <?= $rates['hiredRate'] >= 0 ? 'positive' : 'negative'; ?>">
          <?php if ($rates['hiredRate'] >= 0) :?>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M18 15l-6-6-6 6" />
            </svg>
          <?php else :?>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M6 9l6 6 6-6" />
            </svg>
          <?php endif;?>
          <?= number_format($rates['hiredRate'], 1) . '%'; ?>
        </div>
      </div>
    </div>

    <div class="stats-grid">
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
      <div class="stat-card">
        <h3 class="stat-title">Employer accounts</h3>
        <div class="stat-value"><?= $currentWeek['employers'] ?? '0'; ?></div>
        <div class="stat-change <?= $rates['employersRate'] >= 0 ? 'positive' : 'negative'; ?>">
          <?php if ($rates['employersRate'] >= 0) :?>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M18 15l-6-6-6 6" />
            </svg>
          <?php else :?>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M6 9l6 6 6-6" />
            </svg>
          <?php endif;?>
          <?= number_format($rates['employersRate'], 1) . '%'; ?>
        </div>
      </div>
      <div class="stat-card">
        <h3 class="stat-title">Job seeker accounts</h3>
        <div class="stat-value"><p class="text-2xl"><?= $currentWeek['jobSeekers'] ?? '0'; ?></p></div>
        <div class="stat-change <?= $rates['jobSeekersRate'] >= 0 ? 'positive' : 'negative'; ?>">
          <?php if ($rates['jobSeekersRate'] >= 0) :?>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M18 15l-6-6-6 6" />
            </svg>
          <?php else :?>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M6 9l6 6 6-6" />
            </svg>
          <?php endif;?>
          <?= number_format($rates['jobSeekersRate'], 1) . '%'; ?>
        </div>
      </div>
    </div>

    <div class="charts-grid">
      <div class="chart-card">
          <div class="chart-header">
              <h3 class="chart-title">Job Applications Trend</h3>
              <div class="select-wrapper">
                  <select id="filterSelect">
                      <option value="7">Last 7 days</option>
                      <option value="30">Last 30 days</option>
                      <option value="365">Last 12 months</option>
                  </select>
              </div>
          </div>
          <canvas id="applicationsChart" width="400" height="300"></canvas>
      </div>

      <div class="chart-card">
        <div class="chart-header">
          <h3 class="chart-title">Top Job Categories</h3>
        </div>
        <div class="chart-container">
          <canvas id="applicationsCategoryChart" width="400" height="300"></canvas>
        </div>
      </div>
    </div>
  </main>


  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    const allApplications = <?= json_encode($applications); ?>;
    let filteredApplications = allApplications;

    function filterData(days) {
        const endDate = new Date();
        const startDate = new Date();
        startDate.setDate(endDate.getDate() - days); // Subtract the number of days

        filteredApplications = allApplications.filter(app => {
            const appDate = new Date(app.application_date);
            return appDate >= startDate && appDate <= endDate;
        });

        updateChart();
    }

    function updateChart() {
        const labels = filteredApplications.map(app => app.application_date);
        const data = filteredApplications.map(app => app.application_count);

        const ctx = document.getElementById('applicationsChart').getContext('2d');
        if (window.chartInstance) {
            window.chartInstance.destroy(); // Destroy the previous chart instance to redraw
        }

        window.chartInstance = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Job Applications',
                    data: data,
                    backgroundColor: 'rgba(99, 102, 241, 0.2)',
                    borderColor: 'rgba(99, 102, 241, 1)',
                    borderWidth: 2
                }]
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
    }

    filterData(7);

    document.getElementById('filterSelect').addEventListener('change', function() {
        const selectedValue = parseInt(this.value, 10);
        filterData(selectedValue); // Filter data based on selected value
    });

     // Prepare data from PHP variable
      const applicationsByCategory = <?= json_encode($applicationsByCategory); ?>;
      const labels = applicationsByCategory.map(app => app.job_category);
      const data = applicationsByCategory.map(app => app.applications);

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
      const ctx = document.getElementById('applicationsCategoryChart').getContext('2d');
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
                      }
                  }
              }
          }
      });
  </script>
</body>
</html>