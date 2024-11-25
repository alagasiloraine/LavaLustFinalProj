<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
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
        <a href="<?=site_url('admin/dashboard');?>" class="nav-link">
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
        <a href="<?=site_url('admin/analytics');?>" class="nav-link">
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
        <a href="<?=site_url('admin/jobs');?>" class="nav-link">
          <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
          </svg>
          <span class="nav-text">Jobs</span>
        </a>
      </div>
      <div class="nav-item">
        <a href="<?=site_url('admin/applications');?>" class="nav-link">
          <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
          </svg>
          <span class="nav-text">Applications</span>
        </a>
      </div>
      <div class="nav-item">
        <a href="<?=site_url('admin/jobseekers');?>" class="nav-link">
          <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
          </svg>
          <span class="nav-text">Job Seekers</span>
        </a>
      </div>
    </nav>

    <div class="nav-menu mt-auto">
      <div class="nav-item">
        <a href="<?=site_url('auth/logout');?>" class="nav-link">
          <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
          </svg>
          <span class="nav-text">Logout</span>
        </a>
      </div>
    </div>
  </aside>
</body>
</html>