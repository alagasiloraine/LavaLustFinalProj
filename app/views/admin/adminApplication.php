<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Career Connect - Admin Applications</title>
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

    .applications-header {
      display: flex;
      flex-direction: column;
      gap: 16px;
      margin-bottom: 24px;
    }

    .applications-title {
      font-size: 28px;
      font-weight: 700;
      background: linear-gradient(135deg, var(--text-dark), var(--primary));
      background-clip: text;
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    .search-filter-container {
      display: flex;
      flex-direction: column;
      gap: 12px;
    }

    .search-container {
      position: relative;
    }

    .search-icon {
      position: absolute;
      left: 12px;
      top: 50%;
      transform: translateY(-50%);
      color: var(--text-muted);
    }

    .search-input {
      width: 100%;
      padding: 10px 12px 10px 40px;
      border: 1px solid var(--border-color);
      border-radius: 8px;
      font-size: 14px;
    }

    .status-filter {
      padding: 10px 12px;
      border: 1px solid var(--border-color);
      border-radius: 8px;
      font-size: 14px;
      background-color: white;
    }

    .applications-table {
      width: 100%;
      border-collapse: separate;
      border-spacing: 0;
    }

    .applications-table th,
    .applications-table td {
      padding: 8px 12px;
      /* Reduced padding */
      text-align: left;
      border-bottom: 1px solid var(--border-color);
      font-size: 13px;
      /* Smaller font size */
    }

    .applications-table th {
      background-color: #f8fafc;
      font-weight: 600;
      color: var(--text-muted);
      font-size: 12px;
      /* Even smaller font size for headers */
      text-transform: uppercase;
      letter-spacing: 0.05em;
    }

    .status-badge {
      display: inline-flex;
      align-items: center;
      padding: 4px 8px;
      border-radius: 16px;
      font-size: 12px;
      font-weight: 500;
      gap: 6px;
    }

    .status-badge.pending {
      background-color: #fef3c7;
      color: #d97706;
    }

    .status-badge.approved {
      background-color: #dcfce7;
      color: #15803d;
    }

    .status-badge.declined {
      background-color: #fee2e2;
      color: #dc2626;
    }

    .action-buttons {
      display: flex;
      gap: 8px;
    }

    .action-button {
      padding: 6px 12px;
      border: none;
      border-radius: 6px;
      font-size: 12px;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.2s ease;
      display: flex;
      align-items: center;
      gap: 6px;
    }

    .action-button svg {
      width: 14px;
      height: 14px;
    }

    .action-button.approve {
      background-color: #22c55e;
      color: white;
      box-shadow: 0 2px 4px rgba(34, 197, 94, 0.2);
    }

    .action-button.approve:hover:not(:disabled) {
      background-color: #16a34a;
    }

    .action-button.decline {
      background-color: #ef4444;
      color: white;
      box-shadow: 0 2px 4px rgba(239, 68, 68, 0.2);
    }

    .action-button.decline:hover:not(:disabled) {
      background-color: #dc2626;
    }

    .action-button:disabled {
      opacity: 0.5;
      cursor: not-allowed;
      box-shadow: none;
    }

    .nav-menu.logout-menu {
      margin-top: auto;
      padding-top: 1rem;
    }

    @media (min-width: 768px) {
      .search-filter-container {
        flex-direction: row;
      }

      .search-container {
        flex: 1;
      }

      .status-filter {
        width: 200px;
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
    <div class="applications-header">
      <h1 class="applications-title">Job Applications</h1>
      <div class="search-filter-container">
        <div class="search-container">
          <svg class="search-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="11" cy="11" r="8"></circle>
            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
          </svg>
          <input type="text" id="searchInput" class="search-input" placeholder="Search applications...">
        </div>
        <select id="statusFilter" class="status-filter">
          <option value="all">All Applications</option>
          <option value="pending">Pending</option>
          <option value="approved">Approved</option>
          <option value="declined">Declined</option>
        </select>
      </div>
    </div>

    <table class="applications-table">
      <thead>
        <tr>
          <th>Applicant</th>
          <th>Position</th>
          <th>Company</th>
          <th>Applied Date</th>
          <th>Experience</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody id="applicationsTableBody">
        <!-- Table rows will be dynamically inserted here -->
      </tbody>
    </table>
  </main>

  <script>
    const applications = [{
        id: 1,
        applicant: "John Smith",
        position: "Senior React Developer",
        company: "TechCorp Inc.",
        appliedDate: "2024-02-10",
        experience: "5 years",
        status: "pending"
      },
      {
        id: 2,
        applicant: "Sarah Johnson",
        position: "UX Designer",
        company: "Design Studios",
        appliedDate: "2024-02-09",
        experience: "3 years",
        status: "approved"
      },
      {
        id: 3,
        applicant: "Michael Brown",
        position: "DevOps Engineer",
        company: "Cloud Solutions",
        appliedDate: "2024-02-08",
        experience: "4 years",
        status: "declined"
      }
    ];

    function renderApplications(apps) {
      const tableBody = document.getElementById('applicationsTableBody');
      tableBody.innerHTML = '';

      apps.forEach(app => {
        const row = document.createElement('tr');
        row.innerHTML = `
                    <td>${app.applicant}</td>
                    <td>${app.position}</td>
                    <td>${app.company}</td>
                    <td>${formatDate(app.appliedDate)}</td>
                    <td>${app.experience}</td>
                    <td>
                        <span class="status-badge ${app.status}">
                            ${getStatusIcon(app.status)}
                            ${capitalizeFirstLetter(app.status)}
                        </span>
                    </td>
                    <td>
                        <div class="action-buttons">
                            <button class="action-button approve" onclick="updateStatus(${app.id}, 'approved')" ${app.status === 'approved' ? 'disabled' : ''}>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                                Approve
                            </button>
                            <button class="action-button decline" onclick="updateStatus(${app.id}, 'declined')" ${app.status === 'declined' ? 'disabled' : ''}>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                </svg>
                                Decline
                            </button>
                        </div>
                    </td>
                `;
        tableBody.appendChild(row);
      });
    }

    function getStatusIcon(status) {
      switch (status) {
        case 'pending':
          return '<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>';
        case 'approved':
          return '<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>';
        case 'declined':
          return '<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>';
        default:
          return '';
      }
    }

    function formatDate(dateString) {
      const options = {
        year: 'numeric',
        month: 'short',
        day: 'numeric'
      };
      return new Date(dateString).toLocaleDateString('en-US', options);
    }

    function capitalizeFirstLetter(string) {
      return string.charAt(0).toUpperCase() + string.slice(1);
    }

    function updateStatus(id, newStatus) {
      const application = applications.find(app => app.id === id);
      if (application) {
        application.status = newStatus;
        filterApplications();
      }
    }

    function filterApplications() {
      const searchTerm = document.getElementById('searchInput').value.toLowerCase();
      const statusFilter = document.getElementById('statusFilter').value;

      const filteredApps = applications.filter(app => {
        const matchesSearch =
          app.applicant.toLowerCase().includes(searchTerm) ||
          app.position.toLowerCase().includes(searchTerm) ||
          app.company.toLowerCase().includes(searchTerm);
        const matchesStatus = statusFilter === 'all' || app.status === statusFilter;
        return matchesSearch && matchesStatus;
      });

      renderApplications(filteredApps);
    }

    document.getElementById('searchInput').addEventListener('input', filterApplications);
    document.getElementById('statusFilter').addEventListener('change', filterApplications);

    // Initial render
    renderApplications(applications);
  </script>
</body>

</html>