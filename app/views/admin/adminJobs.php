<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Career Connect Jobs</title>
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

    .content-wrapper {
      max-width: 1400px;
      margin: 0 auto;
    }

    .jobs-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 32px;
      gap: 24px;
    }

    .jobs-title {
      font-size: 32px;
      font-weight: 700;
      background: linear-gradient(135deg, var(--text-dark) 0%, var(--primary) 100%);
      -webkit-background-clip: text;
      background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    .search-filter-container {
      display: flex;
      gap: 16px;
      margin-bottom: 24px;
      flex-wrap: wrap;
    }

    .search-box {
      flex: 1;
      min-width: 280px;
      position: relative;
    }

    .search-input {
      width: 100%;
      padding: 12px 16px 12px 40px;
      border: 1px solid var(--border-color);
      border-radius: 12px;
      font-size: 14px;
      transition: all 0.2s ease;
      background-color: white;
    }

    .search-input:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
    }

    .search-icon {
      position: absolute;
      left: 12px;
      top: 50%;
      transform: translateY(-50%);
      color: var(--text-muted);
    }

    .filter-dropdown {
      min-width: 180px;
      padding: 12px 36px 12px 16px;
      border: 1px solid var(--border-color);
      border-radius: 12px;
      font-size: 14px;
      background-color: white;
      appearance: none;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%236b7280' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
      background-repeat: no-repeat;
      background-position: right 8px center;
      background-size: 20px;
      cursor: pointer;
    }

    .filter-dropdown:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
    }

    .add-job-btn {
      background-color: var(--primary);
      color: white;
      border: none;
      padding: 12px 24px;
      border-radius: 12px;
      font-weight: 600;
      font-size: 14px;
      cursor: pointer;
      transition: all 0.2s ease;
      display: flex;
      align-items: center;
      gap: 8px;
      white-space: nowrap;
    }

    .add-job-btn:hover {
      transform: translateY(-1px);
      box-shadow: 0 4px 12px rgba(99, 102, 241, 0.2);
    }

    .jobs-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
      gap: 24px;
      margin-bottom: 32px;
    }

    .job-card {
      background: white;
      border: 1px solid var(--border-color);
      border-radius: 16px;
      padding: 24px;
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
    }

    .job-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 4px;
      background: linear-gradient(135deg, var(--primary), #818cf8);
      opacity: 0;
      transition: opacity 0.3s ease;
    }

    .job-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
    }

    .job-card:hover::before {
      opacity: 1;
    }

    .job-header {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      margin-bottom: 20px;
      gap: 16px;
    }

    .job-title-wrapper {
      flex: 1;
    }

    .job-title {
      font-size: 20px;
      font-weight: 600;
      color: var(--text-dark);
      margin-bottom: 8px;
    }

    .job-subtitle {
      font-size: 14px;
      color: var(--text-muted);
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .job-badge {
      display: inline-flex;
      align-items: center;
      padding: 4px 12px;
      border-radius: 20px;
      font-size: 12px;
      font-weight: 500;
      background-color: rgba(99, 102, 241, 0.1);
      color: var(--primary);
    }

    .job-actions {
      display: flex;
      gap: 8px;
    }

    .job-action-btn {
      background: none;
      border: none;
      padding: 8px;
      border-radius: 8px;
      color: var(--text-muted);
      cursor: pointer;
      transition: all 0.2s ease;
    }

    .job-action-btn:hover {
      background-color: var(--body-bg);
      color: var(--primary);
    }

    .job-action-btn.delete:hover {
      color: var(--danger);
    }

    .job-details {
      display: grid;
      gap: 16px;
    }

    .job-detail {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 12px;
      background-color: var(--body-bg);
      border-radius: 12px;
      font-size: 14px;
      color: var(--text-dark);
    }

    .job-detail-icon {
      width: 20px;
      height: 20px;
      color: var(--text-muted);
    }

    .modal-overlay {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: rgba(0, 0, 0, 0.5);
      backdrop-filter: blur(4px);
      display: none;
      justify-content: center;
      align-items: center;
      padding: 24px;
      z-index: 1000;
      opacity: 0;
      transition: opacity 0.3s ease;
    }

    .modal-overlay.active {
      display: flex;
      opacity: 1;
    }

    .modal-content {
      background: white;
      border-radius: 20px;
      padding: 32px;
      width: 100%;
      max-width: 600px;
      max-height: 90vh;
      overflow-y: auto;
      position: relative;
      transform: translateY(20px);
      transition: transform 0.3s ease;
    }

    .modal-overlay.active .modal-content {
      transform: translateY(0);
    }

    .modal-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 32px;
    }

    .modal-title {
      font-size: 24px;
      font-weight: 600;
      color: var(--text-dark);
    }

    .close-modal {
      background: none;
      border: none;
      padding: 8px;
      border-radius: 8px;
      cursor: pointer;
      color: var(--text-muted);
      transition: all 0.2s ease;
    }

    .close-modal:hover {
      background-color: var(--body-bg);
      color: var(--text-dark);
    }

    .form-group {
      margin-bottom: 24px;
    }

    .form-label {
      display: block;
      font-size: 14px;
      font-weight: 500;
      color: var(--text-dark);
      margin-bottom: 8px;
    }

    .form-input {
      width: 100%;
      padding: 12px 16px;
      border: 1px solid var(--border-color);
      border-radius: 12px;
      font-size: 14px;
      transition: all 0.2s ease;
      background-color: white;
    }

    .form-input:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
    }

    textarea.form-input {
      min-height: 120px;
      resize: vertical;
    }

    .form-actions {
      display: flex;
      justify-content: flex-end;
      gap: 16px;
      margin-top: 32px;
    }

    .btn {
      padding: 12px 24px;
      border-radius: 12px;
      font-size: 14px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.2s ease;
    }

    .btn-secondary {
      background: var(--body-bg);
      border: 1px solid var(--border-color);
      color: var(--text-dark);
    }

    .btn-secondary:hover {
      background: var(--border-color);
    }

    .btn-primary {
      background: var(--primary);
      border: none;
      color: white;
    }

    .btn-primary:hover {
      transform: translateY(-1px);
      box-shadow: 0 4px 12px rgba(99, 102, 241, 0.2);
    }

    .empty-state {
      text-align: center;
      padding: 48px 24px;
      background: white;
      border-radius: 16px;
      border: 2px dashed var(--border-color);
    }

    .empty-state-icon {
      width: 48px;
      height: 48px;
      color: var(--text-muted);
      margin-bottom: 16px;
    }

    .empty-state-title {
      font-size: 18px;
      font-weight: 600;
      color: var(--text-dark);
      margin-bottom: 8px;
    }

    .empty-state-description {
      color: var(--text-muted);
      margin-bottom: 24px;
    }

    @media (max-width: 768px) {
      .main-content {
        padding: 20px;
      }

      .jobs-header {
        flex-direction: column;
        align-items: stretch;
      }

      .search-filter-container {
        flex-direction: column;
      }

      .search-box {
        width: 100%;
      }

      .filter-dropdown {
        width: 100%;
      }

      .add-job-btn {
        width: 100%;
        justify-content: center;
      }

      .jobs-grid {
        grid-template-columns: 1fr;
      }

      .modal-content {
        padding: 24px;
        margin: 0;
        border-radius: 0;
        height: 100vh;
        max-height: 100vh;
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
    <div class="content-wrapper">
      <div class="jobs-header">
        <h1 class="jobs-title">Jobs Management</h1>
        <button class="add-job-btn" onclick="openJobModal()">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M12 5v14m-7-7h14"></path>
          </svg>
          Add New Job
        </button>
      </div>

      <div class="search-filter-container">
        <div class="search-box">
          <svg class="search-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="11" cy="11" r="8"></circle>
            <path d="M21 21l-4.35-4.35"></path>
          </svg>
          <input type="text" class="search-input" placeholder="Search jobs...">
        </div>
        <select class="filter-dropdown">
          <option value="">All Job Types</option>
          <option value="full-time">Full Time</option>
          <option value="part-time">Part Time</option>
          <option value="contract">Contract</option>
        </select>
        <select class="filter-dropdown">
          <option value="">All Locations</option>
          <option value="remote">Remote</option>
          <option value="onsite">On-site</option>
          <option value="hybrid">Hybrid</option>
        </select>
      </div>

      <div class="jobs-grid">
      <?php foreach ($jobs as $job): ?>
        <!-- Job Card -->
        <div class="job-card">
          <div class="job-header">
            <div class="job-title-wrapper">
              <h3 class="job-title"><?= htmlspecialchars($job['title']); ?></h3>
              <div class="job-subtitle">
                <span class="job-badge"><?= htmlspecialchars($job['job_type']); ?></span>
                <!-- <span>•</span>
                <span>Remote</span> -->
              </div>
            </div>
            <div class="job-actions">
              <button class="job-action-btn" onclick="editJob(1)" title="Edit">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"></path>
                  <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                </svg>
              </button>
              <button class="job-action-btn delete" onclick="deleteJob(1)" title="Delete">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M3 6h18"></path>
                  <path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"></path>
                </svg>
              </button>
            </div>
          </div>
          <div class="job-details">
            <div class="job-detail">
              <svg class="job-detail-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
              </svg>
              <?= htmlspecialchars($job['requirements']); ?>
            </div>
            <div class="job-detail">
              <svg class="job-detail-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg>
              <?= htmlspecialchars($job['salary']); ?>
            </div>
            <div class="job-detail">
              <svg class="job-detail-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
              </svg>
              <?= htmlspecialchars($job['description']); ?>
            </div>
          </div>
        </div>
        <?php endforeach; ?>

        <!-- More job cards can be added here -->
      </div>

      <!-- Empty State (shown when no jobs) -->
      <div class="empty-state" style="display: none;">
        <svg class="empty-state-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
        </svg>
        <h3 class="empty-state-title">No jobs found</h3>
        <p class="empty-state-description">Get started by creating your first job posting</p>
        <button class="add-job-btn" onclick="openJobModal()">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M12 5v14m-7-7h14"></path>
          </svg>
          Add New Job
        </button>
      </div>
    </div>
  </main>

  <!-- Job Modal -->
  <div class="modal-overlay" id="jobModal">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title">Add New Job</h2>
        <button class="close-modal" onclick="closeJobModal()">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M18 6L6 18"></path>
            <path d="M6 6l12 12"></path>
          </svg>
        </button>
      </div>
      <form id="jobForm" method="POST" action="<?=site_url('admin/jobs/add-jobs');?>">
        <div class="form-group">
          <label class="form-label" for="jobTitle">Job Title</label>
          <input type="text" name="jobTitle" id="jobTitle" class="form-input" required>
        </div>
        <div class="form-group">
          <label class="form-label" for="jobType">Job Type</label>
          <select name="jobTitle" id="jobType" class="form-input" required>
            <option value="full-time">Full Time</option>
            <option value="part-time">Part Time</option>
            <option value="contract">Contract</option>
          </select>
        </div>
        <div class="form-group">
          <label class="form-label" for="location">Location</label>
          <select name="location" id="location" class="form-input" required>
            <option value="remote">Remote</option>
            <option value="onsite">On-site</option>
            <option value="hybrid">Hybrid</option>
          </select>
        </div>
        <div class="form-group">
          <label class="form-label" for="jobDescription">Description</label>
          <textarea name="jobDescription" id="jobDescription" class="form-input" required></textarea>
        </div>
        <div class="form-group">
          <label class="form-label" for="expertise">Required Expertise</label>
          <input type="text" name="expertise" id="expertise" class="form-input" placeholder="e.g., React, TypeScript, Node.js" required>
        </div>
        <div class="form-group">
          <label class="form-label" for="position">Position Level</label>
          <select name="position" id="position" class="form-input" required>
            <option value="entry">Entry Level</option>
            <option value="mid">Mid Level</option>
            <option value="senior">Senior Level</option>
            <option value="lead">Lead</option>
          </select>
        </div>
        <div class="form-group">
          <label class="form-label" for="salary">Annual Salary Range</label>
          <input type="text" name="salary" id="salary" class="form-input" placeholder="e.g., $80,000 - $100,000" required>
        </div>
        <div class="form-actions">
          <button type="button" class="btn btn-secondary" onclick="closeJobModal()">Cancel</button>
          <button type="submit" class="btn btn-primary">Save Job</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    // Modal functionality
    function openJobModal() {
      document.getElementById('jobModal').classList.add('active');
      document.body.style.overflow = 'hidden';
    }

    function closeJobModal() {
      document.getElementById('jobModal').classList.remove('active');
      document.body.style.overflow = '';
    }

    // Close modal when clicking outside
    document.getElementById('jobModal').addEventListener('click', function(e) {
      if (e.target === this) {
        closeJobModal();
      }
    });

    // Form submission
    document.getElementById('jobForm').addEventListener('submit', function(e) {
      e.preventDefault();
      // Add your form submission logic here
      closeJobModal();
    });

    // Edit job
    function editJob(id) {
      openJobModal();
      // Add your edit logic here
    }

    // Delete job
    function deleteJob(id) {
      if (confirm('Are you sure you want to delete this job?')) {
        // Add your delete logic here
      }
    }

    // Search functionality
    document.querySelector('.search-input').addEventListener('input', function(e) {
      // Add your search logic here
      console.log('Searching for:', e.target.value);
    });

    // Filter functionality
    document.querySelectorAll('.filter-dropdown').forEach(dropdown => {
      dropdown.addEventListener('change', function(e) {
        // Add your filter logic here
        console.log('Filter changed:', e.target.value);
      });
    });
  </script>
</body>

</html>