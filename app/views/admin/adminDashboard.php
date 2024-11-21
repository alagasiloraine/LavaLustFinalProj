<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Career Connect Dashboard</title>
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

    .main-content {
      flex: 1;
      padding: 24px;
      background: var(--card-bg);
      border-radius: 16px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
      border: 1px solid var(--border-color);
      overflow-y: auto;
    }

    .dashboard-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 24px;
    }

    .dashboard-title {
      font-size: 28px;
      font-weight: 700;
      background: linear-gradient(135deg, var(--text-dark), var(--primary));
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
      padding: 8px 36px 8px 12px;
      font-size: 14px;
      border: 1px solid var(--border-color);
      border-radius: 8px;
      background-color: var(--card-bg);
      color: var(--text-dark);
      cursor: pointer;
      min-width: 160px;
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

    .stats-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
      gap: 24px;
      margin-bottom: 24px;
    }

    .stat-card {
      background: var(--card-bg);
      padding: 24px;
      border-radius: 12px;
      border: 1px solid var(--border-color);
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      height: 100%;
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .stat-card:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .stat-title {
      font-size: 14px;
      color: var(--text-muted);
      margin-bottom: 8px;
    }

    .stat-value {
      font-size: 24px;
      font-weight: 600;
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

    .charts-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
      gap: 24px;
    }

    .chart-card {
      background: var(--card-bg);
      padding: 24px;
      border-radius: 12px;
      border: 1px solid var(--border-color);
    }

    .chart-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 16px;
    }

    .chart-title {
      font-size: 16px;
      font-weight: 600;
      color: var(--text-dark);
    }

    .chart-container {
      height: 300px;
      background: var(--body-bg);
      border-radius: 8px;
    }

    .mt-auto {
      margin-top: auto;
    }

    @media (min-width: 1024px) {
      .stats-grid {
        grid-template-columns: repeat(4, 1fr);
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
        margin-bottom: 20px;
      }

      .main-content {
        width: 100%;
      }

      .dashboard-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 12px;
      }

      .dashboard-actions {
        flex-direction: column;
        align-items: stretch;
      }

      .select-wrapper {
        width: 100%;
      }

      select {
        width: 100%;
      }

      .stats-grid,
      .charts-grid {
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
    <div class="dashboard-header">
      <h1 class="dashboard-title">Dashboard Overview</h1>
      <div class="dashboard-actions">
        <div class="select-wrapper">
          <select>
            <option>Month to date</option>
            <option>Week to date</option>
            <option>Year to date</option>
          </select>
        </div>
        <span style="color: var(--text-muted);">compared to</span>
        <div class="select-wrapper">
          <select>
            <option>Previous period</option>
            <option>Previous year</option>
          </select>
        </div>
      </div>
    </div>

    <div class="stats-grid">
      <div class="stat-card">
        <h3 class="stat-title">Revenue</h3>
        <div class="stat-value">$24,500</div>
        <div class="stat-change positive">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M18 15l-6-6-6 6" />
          </svg>
          12.5%
        </div>
      </div>
      <div class="stat-card">
        <h3 class="stat-title">New jobs posted</h3>
        <div class="stat-value">145</div>
        <div class="stat-change positive">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M18 15l-6-6-6 6" />
          </svg>
          8.2%
        </div>
      </div>
      <div class="stat-card">
        <h3 class="stat-title">Jobs filled</h3>
        <div class="stat-value">89</div>
        <div class="stat-change positive">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M18 15l-6-6-6 6" />
          </svg>
          5.7%
        </div>
      </div>
      <div class="stat-card">
        <h3 class="stat-title">Job alerts created</h3>
        <div class="stat-value">328</div>
        <div class="stat-change negative">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M6 9l6 6 6-6" />
          </svg>
          3.2%
        </div>
      </div>
    </div>

    <div class="stats-grid">
      <div class="stat-card">
        <h3 class="stat-title">Job views</h3>
        <div class="stat-value">2,451</div>
        <div class="stat-change positive">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M18 15l-6-6-6 6" />
          </svg>
          9.3%
        </div>
      </div>
      <div class="stat-card">
        <h3 class="stat-title">Job applications</h3>
        <div class="stat-value">156</div>
        <div class="stat-change positive">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M18 15l-6-6-6 6" />
          </svg>
          12.8%
        </div>
      </div>
      <div class="stat-card">
        <h3 class="stat-title">New employer accounts</h3>
        <div class="stat-value">23</div>
        <div class="stat-change negative">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M6 9l6 6 6-6" />
          </svg>
          2.1%
        </div>
      </div>
      <div class="stat-card">
        <h3 class="stat-title">New job seeker accounts</h3>
        <div class="stat-value">892</div>
        <div class="stat-change positive">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M18 15l-6-6-6 6" />
          </svg>
          14.2%
        </div>
      </div>
    </div>

    <div class="charts-grid">
      <div class="chart-card">
        <div class="chart-header">
          <h3 class="chart-title">Job Applications Trend</h3>
          <div class="select-wrapper">
            <select>
              <option>Last 7 days</option>
              <option>Last 30 days</option>
              <option>Last 12 months</option>
            </select>
          </div>
        </div>
        <div class="chart-container">
          <svg width="100%" height="100%" viewBox="0 0 400 300">
            <rect x="0" y="0" width="400" height="300" fill="#f8fafc" />
            <polyline
              fill="none"
              stroke="#6366F1"
              stroke-width="2"
              points="
                            50,250
                            100,200
                            150,220
                            200,180
                            250,150
                            300,100
                            350,50
                        " />
            <g fill="#1e293b" font-size="12">
              <text x="50" y="270">Mon</text>
              <text x="100" y="270">Tue</text>
              <text x="150" y="270">Wed</text>
              <text x="200" y="270">Thu</text>
              <text x="250" y="270">Fri</text>
              <text x="300" y="270">Sat</text>
              <text x="350" y="270">Sun</text>
            </g>
            <g fill="#1e293b" font-size="12">
              <text x="10" y="250">0</text>
              <text x="10" y="200">25</text>
              <text x="10" y="150">50</text>
              <text x="10" y="100">75</text>
              <text x="10" y="50">100</text>
            </g>
          </svg>
        </div>
      </div>
      <div class="chart-card">
        <div class="chart-header">
          <h3 class="chart-title">Top Job Categories</h3>
          <div class="select-wrapper">
            <select>
              <option>By Applications</option>
              <option>By Views</option>
            </select>
          </div>
        </div>
        <div class="chart-container">
          <svg width="100%" height="100%" viewBox="0 0 400 300">
            <rect x="0" y="0" width="400" height="300" fill="#f8fafc" />
            <!-- Bars -->
            <rect x="50" y="50" width="200" height="30" fill="#6366F1" />
            <rect x="50" y="90" width="160" height="30" fill="#22c55e" />
            <rect x="50" y="130" width="140" height="30" fill="#ef4444" />
            <rect x="50" y="170" width="120" height="30" fill="#f59e0b" />
            <rect x="50" y="210" width="100" height="30" fill="#3b82f6" />
            <rect x="50" y="250" width="80" height="30" fill="#ec4899" />

            <!-- Labels -->
            <g fill="#1e293b" font-size="12">
              <text x="260" y="70">Technology (35%)</text>
              <text x="260" y="110">Marketing (28%)</text>
              <text x="260" y="150">Sales (24%)</text>
              <text x="260" y="190">Finance (20%)</text>
              <text x="260" y="230">Design (16%)</text>
              <text x="260" y="270">Other (12%)</text>
            </g>

            <!-- Axis -->
            <line x1="50" y1="40" x2="50" y2="290" stroke="#64748b" stroke-width="1" />
            <g fill="#64748b" font-size="10">
              <text x="45" y="40" text-anchor="end">0%</text>
              <text x="45" y="290" text-anchor="end">40%</text>
            </g>
          </svg>
        </div>
      </div>
    </div>
  </main>
</body>

</html>