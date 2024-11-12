<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Career Connect Dashboard - Job Seekers</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap">
  <style>
    /* Existing styles remain unchanged */
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

    .nav-menu.logout-menu {
      margin-top: auto;
      padding-top: 1rem;
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

    .job-seekers-header {
      display: flex;
      flex-direction: column;
      gap: 8px;
      margin-bottom: 24px;
    }

    .header-top {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .job-seekers-title {
      font-size: 28px;
      font-weight: 700;
      background: linear-gradient(135deg, var(--text-dark), var(--primary));
      background-clip: text;
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    .job-seekers-subtitle {
      font-size: 14px;
      color: #64748B;
    }

    .job-seekers-actions {
      display: flex;
      gap: 8px;
    }

    .action-button {
      display: flex;
      align-items: center;
      gap: 8px;
      background-color: white;
      color: #1a1a1a;
      border: 1px solid #E2E8F0;
      padding: 8px 16px;
      border-radius: 8px;
      cursor: pointer;
      font-size: 14px;
      font-weight: 500;
      transition: all 0.2s ease;
    }

    .action-button:hover {
      background-color: #F8FAFC;
    }

    .action-button svg {
      width: 16px;
      height: 16px;
    }

    .search-filters-container {
      display: flex;
      gap: 12px;
      margin-bottom: 24px;
    }

    .search-container {
      flex: 1;
      position: relative;
    }

    .search-input {
      width: 100%;
      padding: 8px 16px 8px 40px;
      border: 1px solid #E2E8F0;
      border-radius: 8px;
      font-size: 14px;
      background-color: white;
    }

    .search-input:focus {
      outline: none;
      border-color: #6366F1;
    }

    .search-icon {
      position: absolute;
      left: 12px;
      top: 50%;
      transform: translateY(-50%);
      width: 16px;
      height: 16px;
      color: #64748B;
    }

    .filter-select {
      padding: 8px 36px 8px 16px;
      border: 1px solid #E2E8F0;
      border-radius: 8px;
      font-size: 14px;
      color: #1a1a1a;
      background-color: white;
      cursor: pointer;
      min-width: 160px;
      appearance: none;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%2364748B' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
      background-repeat: no-repeat;
      background-position: right 12px center;
    }

    .job-seeker-card {
      background: white;
      border: 1px solid #E2E8F0;
      border-radius: 12px;
      padding: 24px;
      margin-bottom: 16px;
    }

    .job-seeker-header {
      display: flex;
      align-items: center;
      gap: 16px;
      margin-bottom: 20px;
    }

    .job-seeker-avatar {
      width: 48px;
      height: 48px;
      border-radius: 50%;
      object-fit: cover;
    }

    .job-seeker-info {
      flex: 1;
    }

    .name-status-wrapper {
      display: flex;
      align-items: center;
      gap: 12px;
      margin-bottom: 4px;
    }

    .job-seeker-name {
      font-size: 16px;
      font-weight: 600;
      color: #1a1a1a;
    }

    .status-badge {
      font-size: 12px;
      padding: 2px 8px;
      border-radius: 12px;
      font-weight: 500;
    }

    .status-active {
      background-color: #DCFCE7;
      color: #16A34A;
    }

    .status-open {
      background-color: #FEF3C7;
      color: #D97706;
    }

    .job-title {
      font-size: 14px;
      color: #64748B;
      margin-bottom: 4px;
    }

    .location-experience {
      font-size: 14px;
      color: #64748B;
    }

    .contact-info {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 16px;
      margin: 16px 0;
      padding: 16px 0;
      border-top: 1px solid #E2E8F0;
      border-bottom: 1px solid #E2E8F0;
    }

    .contact-item {
      display: flex;
      flex-direction: column;
      gap: 4px;
    }

    .contact-label {
      font-size: 14px;
      color: #64748B;
    }

    .contact-value {
      font-size: 14px;
      color: #1a1a1a;
    }

    .expertise-section {
      margin-bottom: 16px;
    }

    .expertise-label {
      font-size: 14px;
      color: #64748B;
      margin-bottom: 8px;
    }

    .expertise-tags {
      display: flex;
      flex-wrap: wrap;
      gap: 8px;
    }

    .expertise-tag {
      background-color: #F1F5F9;
      color: #1a1a1a;
      padding: 4px 12px;
      border-radius: 16px;
      font-size: 12px;
      font-weight: 500;
    }

    .card-footer {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .last-active {
      font-size: 14px;
      color: #64748B;
    }

    .view-resume-btn {
      display: flex;
      align-items: center;
      gap: 8px;
      background-color: white;
      color: #1a1a1a;
      border: 1px solid #E2E8F0;
      padding: 8px 16px;
      border-radius: 8px;
      cursor: pointer;
      font-size: 14px;
      font-weight: 500;
    }

    .menu-button {
      background: none;
      border: none;
      padding: 4px;
      cursor: pointer;
      color: #64748B;
    }

    @media (max-width: 768px) {
      .main-content {
        padding: 16px;
      }

      .search-filters-container {
        flex-direction: column;
      }

      .contact-info {
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
    <div class="job-seekers-header">
      <div class="header-top">
        <div>
          <h1 class="job-seekers-title">Job Seekers</h1>
          <p class="job-seekers-subtitle">Manage and view job seeker profiles</p>
        </div>
        <div class="job-seekers-actions">
          <button class="action-button">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4M7 10l5 5 5-5M12 15V3"></path>
            </svg>
            Export
          </button>
          <button class="action-button">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M4 21v-7M4 10V3M12 21v-9M12 8V3M20 21v-5M20 12V3M1 14h6M9 8h6M17 16h6"></path>
            </svg>
            Filters
          </button>
        </div>
      </div>
    </div>

    <div class="search-filters-container">
      <div class="search-container">
        <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <circle cx="11" cy="11" r="8"></circle>
          <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
        </svg>
        <input type="text" class="search-input" placeholder="Search job seekers...">
      </div>
      <select class="filter-select">
        <option value="all">All Status</option>
        <option value="active">Actively Looking</option>
        <option value="open">Open to Offers</option>
        <option value="employed">Employed</option>
      </select>
      <select class="filter-select">
        <option value="all">All Experience</option>
        <option value="entry">Entry Level</option>
        <option value="mid">Mid Level</option>
        <option value="senior">Senior Level</option>
      </select>
    </div>

    <div class="job-seekers-grid" id="jobSeekersGrid">
      <!-- Job seeker cards will be dynamically inserted here -->
    </div>
  </main>

  <script>
    const jobSeekers = [{
        name: "Alex Johnson",
        avatar: "/images/profile1.jpg",
        position: "Senior Frontend Developer",
        location: "San Francisco, CA",
        experience: "5+ years",
        email: "alex.j@example.com",
        phone: "+1 (555) 123-4567",
        status: "Actively Looking",
        expertise: ["React", "Node.js", "TypeScript"],
        lastActive: "2 hours ago"
      },
      {
        name: "Sarah Chen",
        avatar: "/images/profile2.jpg",
        position: "Backend Developer",
        location: "New York, NY",
        experience: "3 years",
        email: "sarah.c@example.com",
        phone: "+1 (555) 987-6543",
        status: "Open to Offers",
        expertise: ["Python", "Django", "AWS"],
        lastActive: "5 hours ago"
      }
    ];

    function createJobSeekerCard(jobSeeker) {
      return `
                <div class="job-seeker-card">
                    <div class="job-seeker-header">
                        <img src="${jobSeeker.avatar}" alt="${jobSeeker.name}" class="job-seeker-avatar">
                        <div class="job-seeker-info">
                            <div class="name-status-wrapper">
                                <span class="job-seeker-name">${jobSeeker.name}</span>
                                <span class="status-badge ${jobSeeker.status === 'Actively Looking' ? 'status-active' : 'status-open'}">${jobSeeker.status}</span>
                            </div>
                            <div class="job-title">${jobSeeker.position}</div>
                            <div class="location-experience">${jobSeeker.location} • ${jobSeeker.experience}</div>
                        </div>
                        <button class="menu-button">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="1"></circle>
                                <circle cx="12" cy="5" r="1"></circle>
                                <circle cx="12" cy="19" r="1"></circle>
                            </svg>
                        </button>
                    </div>
                    <div class="contact-info">
                        <div class="contact-item">
                            <span class="contact-label">Email:</span>
                            <span class="contact-value">${jobSeeker.email}</span>
                        </div>
                        <div class="contact-item">
                            <span class="contact-label">Phone:</span>
                            <span class="contact-value">${jobSeeker.phone}</span>
                        </div>
                    </div>
                    <div class="expertise-section">
                        <div class="expertise-label">Expertise:</div>
                        <div class="expertise-tags">
                            ${jobSeeker.expertise.map(skill => `<span class="expertise-tag">${skill}</span>`).join('')}
                        </div>
                    </div>
                    <div class="card-footer">
                        <span class="last-active">Last active ${jobSeeker.lastActive}</span>
                        <button class="view-resume-btn">
                            View Resume
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </button>
                    </div>
                </div>
            `;
    }

    function renderJobSeekers() {
      const jobSeekersGrid = document.getElementById('jobSeekersGrid');
      jobSeekersGrid.innerHTML = jobSeekers.map(createJobSeekerCard).join('');
    }

    document.addEventListener('DOMContentLoaded', renderJobSeekers);
  </script>
</body>

</html>