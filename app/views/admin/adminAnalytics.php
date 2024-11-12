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
    <aside class="sidebar" id="sidebar">
        <div class="logo">
            <div class="logo-icon">
                <img src="/images/imagelogo1.png" alt="Career Connect Logo">
            </div>
            <div class="logo-text-wrapper">
                <span class="logo-text">Career Connect</span>
                <span class="logo-subtext">IT JOB PORTAL</span>
            </div>
        </div>

        <div class="section-title">Main Menu</div>
        <nav class="nav-menu">
            <div class="nav-item">
                <a href="/dashboad" class="nav-link">
                    <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="3" width="7" height="7"></rect>
                        <rect x="14" y="3" width="7" height="7"></rect>
                        <rect x="14" y="14" width="7" height="7"></rect>
                        <rect x="3" y="14" width="7" height="7"></rect>
                    </svg>
                    <span class="nav-text">Dashboard</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="/analytics" class="nav-link active">
                    <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M22 12h-4l-3 9L9 3l-3 9H2"></path>
                    </svg>
                    <span class="nav-text">Analytics</span>
                </a>
            </div>
        </nav>

        <div class="section-title">General</div>
        <nav class="nav-menu">
            <div class="nav-item">
                <a href="/jobs" class="nav-link">
                    <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    <span class="nav-text">Jobs</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="/application" class="nav-link">
                    <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <span class="nav-text">Applications</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="/jobseekers" class="nav-link">
                    <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <span class="nav-text">Job Seekers</span>
                </a>
            </div>
        </nav>

        <div class="nav-menu mt-auto">
            <div class="nav-item">
                <a href="/login.php" class="nav-link">
                    <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    <span class="nav-text">Logout</span>
                </a>
            </div>
        </div>
    </aside>

    <main class="main-content">
        <div class="analytics-header">
            <h1 class="analytics-title">Analytics</h1>
            <div class="dashboard-actions">
                <div class="select-wrapper">
                    <select>
                        <option>Last 30 days</option>
                        <option>Last 7 days</option>
                        <option>Last 90 days</option>
                        <option>Custom range</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="analytics-content">
            <aside class="analytics-sidebar">
                <div class="filter-group">
                    <label class="filter-label">Metrics</label>
                    <div class="checkbox-group">
                        <label class="checkbox-label">
                            <input type="checkbox" class="checkbox-input" checked>
                            Job Views
                        </label>
                        <label class="checkbox-label">
                            <input type="checkbox" class="checkbox-input" checked>
                            Applications
                        </label>
                        <label class="checkbox-label">
                            <input type="checkbox" class="checkbox-input" checked>
                            Success Rate
                        </label>
                        <label class="checkbox-label">
                            <input type="checkbox" class="checkbox-input" checked>
                            Response Time
                        </label>
                    </div>
                </div>

                <div class="filter-group">
                    <label class="filter-label">Job Categories</label>
                    <select class="filter-select">
                        <option>All Categories</option>
                        <option>Technology</option>
                        <option>Marketing</option>
                        <option>Sales</option>
                        <option>Finance</option>
                        <option>Design</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label class="filter-label">Location</label>
                    <select class="filter-select">
                        <option>All Locations</option>
                        <option>Remote</option>
                        <option>On-site</option>
                        <option>Hybrid</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label class="filter-label">Custom Date Range</label>
                    <div class="date-range">
                        <input type="date" class="date-input" placeholder="Start date">
                        <input type="date" class="date-input" placeholder="End date">
                    </div>
                </div>
            </aside>

            <div class="analytics-main">
                <div class="metric-card">
                    <div class="metric-header">
                        <h3 class="metric-title">Job Performance Overview</h3>
                        <div class="select-wrapper">
                            <select>
                                <option>All Jobs</option>
                                <option>Active Jobs</option>
                                <option>Closed Jobs</option>
                            </select>
                        </div>
                    </div>
                    <div class="stats-grid">
                        <div class="stat-card">
                            <h3 class="stat-title">Total Views</h3>
                            <div class="stat-value">15,234</div>
                            <div class="stat-change positive">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M18 15l-6-6-6 6" />
                                </svg>
                                18.2%
                            </div>
                        </div>
                        <div class="stat-card">
                            <h3 class="stat-title">Applications</h3>
                            <div class="stat-value">1,876</div>
                            <div class="stat-change positive">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M18 15l-6-6-6 6" />
                                </svg>
                                12.5%
                            </div>
                        </div>
                        <div class="stat-card">
                            <h3 class="stat-title">Success Rate</h3>
                            <div class="stat-value">68%</div>
                            <div class="stat-change positive">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M18 15l-6-6-6 6" />
                                </svg>
                                5.3%
                            </div>
                        </div>
                        <div class="stat-card">
                            <h3 class="stat-title">Avg. Response Time</h3>
                            <div class="stat-value">2.4 days</div>
                            <div class="stat-change negative">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M6 9l6 6 6-6" />
                                </svg>
                                1.8%
                            </div>
                        </div>
                    </div>
                    <div class="metric-chart">
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

                <div class="metric-card">
                    <div class="metric-header">
                        <h3 class="metric-title">Application Sources</h3>
                        <div class="select-wrapper">
                            <select>
                                <option>Last 30 days</option>
                                <option>Last 90 days</option>
                                <option>Last 12 months</option>
                            </select>
                        </div>
                    </div>
                    <div class="metric-chart">
                        <svg width="100%" height="100%" viewBox="0 0 400 300">
                            <rect x="0" y="0" width="400" height="300" fill="#f8fafc" />
                            <!-- Bars -->
                            <rect x="50" y="50" width="200" height="30" fill="#6366F1" />
                            <rect x="50" y="90" width="160" height="30" fill="#22c55e" />
                            <rect x="50" y="130" width="140" height="30" fill="#ef4444" />
                            <rect x="50" y="170" width="120" height="30" fill="#f59e0b" />
                            <rect x="50" y="210" width="100" height="30" fill="#3b82f6" />

                            <!-- Labels -->
                            <g fill="#1e293b" font-size="12">
                                <text x="260" y="70">Direct (45%)</text>
                                <text x="260" y="110">Job Boards (30%)</text>
                                <text x="260" y="150">Social Media (15%)</text>
                                <text x="260" y="190">Referrals (7%)</text>
                                <text x="260" y="230">Other (3%)</text>
                            </g>

                            <!-- Axis -->
                            <line x1="50" y1="40" x2="50" y2="250" stroke="#64748b" stroke-width="1" />
                            <g fill="#64748b" font-size="10">
                                <text x="45" y="40" text-anchor="end">0%</text>
                                <text x="45" y="250" text-anchor="end">50%</text>
                            </g>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>