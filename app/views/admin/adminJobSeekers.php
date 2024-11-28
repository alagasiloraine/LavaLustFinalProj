<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Career Connect Dashboard - Job Seekers</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap">
    <link href="<?=base_url();?>public/css/jobseeker.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.4/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.4/dist/sweetalert2.min.js"></script>
</head>

<body>
  <!-- Sidebar - Kept exactly as in adminDashboard.php -->
  <?php
    include APP_DIR.'views/templates/adminNav.php';
  ?>

  <?php if (isset($_SESSION['success'])): ?>
              <script>
                  toastr.success("<?php echo $_SESSION['success']; ?>", "Success");
              </script>
              <?php unset($_SESSION['success']); ?>
          <?php elseif (isset($_SESSION['error'])): ?>
              <script>
                  toastr.error("<?php echo $_SESSION['error']; ?>", "Error");
              </script>
              <?php unset($_SESSION['error']); ?>
          <?php endif; ?>

  <main class="main-content">
    <div class="job-seekers-header">
      <div class="header-top">
        <div>
          <h1 class="job-seekers-title">Job Seekers</h1>
          <!-- <p class="job-seekers-subtitle">Manage and view job seeker profiles</p> -->
        </div>
      </div>
    </div>

    <div class="search-filters-container">
      <div class="search-container">
        <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <circle cx="11" cy="11" r="8"></circle>
          <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
        </svg>
        <input type="text"  id="searchInput"
              oninput="searchJobSeeker()" class="search-input" placeholder="Search job seekers...">
      </div>
      <select class="filter-select"
            id="filterSelect"
            onchange="filterJobSeeker()">
        <option value="all">All Status</option>
        <option value="available">Available</option>
        <option value="open">Open to Offers</option>
        <option value="employed">Employed</option>
      </select>
      <div class="mb-6 flex justify-between items-center">
              <button 
                  onclick="changePage('prev')" 
                  class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition shadow-sm"
              >
                  Previous
              </button>
              <span id="paginationInfo" class="text-gray-700 font-medium"></span>
              <button 
                  onclick="changePage('next')" 
                  class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition shadow-sm"
              >
                  Next
              </button>
          </div>
    </div>

    <div class="job-seekers-grid" id="jobSeekersGrid">
      <?php foreach ($jobSeekers as $jobSeeker): ?>
        <div class="job-seeker-card">
          <div class="job-seeker-header">
            <img src="<?= isset($jobSeeker['profile_picture']) && !empty($jobSeeker['profile_picture']) ? '../../../../uploads/profile_pictures/' . $jobSeeker['profile_picture'] : '../../../public/images/OIP.jpg'; ?>" class="job-seeker-avatar">
            <div class="job-seeker-info">
              <div class="name-status-wrapper">
                <span class="job-seeker-name"><?= htmlspecialchars($jobSeeker['full_name'] ?? 'N/A'); ?></span>
                <span class="job-seeker-username"><?= htmlspecialchars($jobSeeker['user_name'] ?? 'N/A'); ?></span>
                <span class="status-badge job-seeker-availability"><?= htmlspecialchars($jobSeeker['availability'] ?? 'N/A' ); ?></span>
              </div>
              <div class="job-title">
              <?php if (!empty($jobSeeker['hired_job_title'])): ?>
                  <span class="hired-job-title">Hired for: <?= htmlspecialchars($jobSeeker['hired_job_title'] ?? 'N/A' ); ?></span>
              <?php else: ?>
                  <span class="hired-job-title">Not Hired Yet</span>
              <?php endif; ?>
              </div>
              <div class="location-experience job-seeker-experience"><?= htmlspecialchars($jobSeeker['location'] ?? 'N/A' ); ?> • <?= htmlspecialchars($jobSeeker['experience'] ?? 'N/A' ); ?></div>
              <div class="location-experience job-seeker-status"><?= htmlspecialchars($jobSeeker['status'] ?? 'N/A' ); ?></div>
            </div>

            <!-- <button class="job-action-btn delete" type="button" onclick="confirmDeactive(event, <?= $jobSeeker['user_id'] ?>)" title="Delete">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M3 6h18"></path>
                <path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"></path>
              </svg>
            </button> -->

          </div>
          <div class="contact-info">
            <div class="contact-item">
              <span class="contact-label">Email:</span>
              <span class="contact-value"><?= htmlspecialchars($jobSeeker['user_email'] ?? 'N/A' ); ?></span>
            </div>
            <div class="contact-item">
              <span class="contact-label">Phone:</span>
              <span class="contact-value"><?= htmlspecialchars($jobSeeker['phone'] ?? 'N/A' ); ?></span>
            </div>
          </div>
          <div class="expertise-section">
            <div class="expertise-label">Expertise:</div>
            <div class="expertise-tags">
              <?= htmlspecialchars($jobSeeker['skills'] ?? 'N/A' ); ?>
            </div>
          </div>
          <div class="card-footer">
              <?php if (!empty($jobSeeker['resume'])): ?>
                <a href="<?= htmlspecialchars('download/' . $jobSeeker['resume']) ?>" 
                  class="view-resume-btn" >
                    View Resume
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </a>

              <?php else: ?>
                  <span class="no-resume-available">No Resume Available</span>
              <?php endif; ?>
          </div>


        </div>
      <?php endforeach; ?>
    </div>
    
  </main>

  <script>
  function searchJobSeeker() {
      const searchInput = document.getElementById("searchInput").value.toLowerCase();
      const jobCards = document.querySelectorAll(".job-seeker-card");

      jobCards.forEach((card) => {
          const fullName = card.querySelector(".job-seeker-name")?.textContent.toLowerCase() || "";
          const email = card.querySelector(".contact-value")?.textContent.toLowerCase() || "";
          const username = card.querySelector(".job-seeker-username")?.textContent.toLowerCase() || "";

          card.style.display =
              fullName.includes(searchInput) || email.includes(searchInput) ? "block" : "none";
      });
  }


        function filterJobSeeker() {
              const filterValue = document.getElementById("filterSelect").value.toLowerCase();
              const jobCards = document.querySelectorAll(".job-seeker-card"); 
              jobCards.forEach((card) => {
                  const type = card.querySelector(".job-seeker-availability").textContent.toLowerCase();
                  card.style.display =
                      filterValue === "all" || type.includes(filterValue) ? "block" : "none";
              });
          }
          function filterJobSeekerExperience() {
              const filterValue = document.getElementById("filterSelect").value.toLowerCase();
              const jobCards = document.querySelectorAll(".job-seeker-card"); 
              jobCards.forEach((card) => {
                  const type = card.querySelector(".job-seeker-experience").textContent.toLowerCase();
                  card.style.display =
                      filterValue === "all" || type.includes(filterValue) ? "block" : "none";
              });
          }

          let currentPage = 1;
          const jobsPerPage = 6;

          function paginateJobs() {
              const jobCards = Array.from(document.querySelectorAll(".job-seeker-card"));
              const totalJobs = jobCards.length;
              const totalPages = Math.ceil(totalJobs / jobsPerPage);

              jobCards.forEach((card, index) => {
                  card.style.display =
                      index >= (currentPage - 1) * jobsPerPage && index < currentPage * jobsPerPage
                          ? "block"
                          : "none";
              });

              document.getElementById("paginationInfo").textContent = `${currentPage} of ${totalPages}`;
          }

          function changePage(direction) {
              const jobCards = Array.from(document.querySelectorAll(".job-seeker-card"));
              const totalJobs = jobCards.length;
              const totalPages = Math.ceil(totalJobs / jobsPerPage);

              if (direction === "next" && currentPage < totalPages) currentPage++;
              if (direction === "prev" && currentPage > 1) currentPage--;

              paginateJobs();
          }
          document.addEventListener('DOMContentLoaded', function() {
              paginateJobs();
          });
  
          function confirmDeactive(event, userId) {
              event.preventDefault(); 

              Swal.fire({
                  title: 'Are you sure?',
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonText: 'Yes',
                  cancelButtonText: 'No',
                  reverseButtons: true
              }).then((result) => {
                  if (result.isConfirmed) {
                      const deleteUrl = "<?= site_url('admin/deactivateUser/') ?>" + userId;
                      window.location.href = deleteUrl;
                  } else {
                      toastr.info('canceled.', 'Canceled'); 
                  }
              });
          }
  </script>
</body>

</html>