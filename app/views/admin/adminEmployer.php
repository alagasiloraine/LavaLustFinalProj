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
          <h1 class="job-seekers-title">Employers</h1>
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
              oninput="searchJobSeeker()" class="search-input" placeholder="Search employers...">
      </div>
      <!-- <select class="filter-select"
            id="filterSelect"
            onchange="filterJobSeeker()">
        <option value="all">All Status</option>
        <option value="available">Available</option>
        <option value="open">Open to Offers</option>
        <option value="employed">Employed</option>
      </select> -->
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
        <?php foreach ($employers as $employer): ?>
            <div class="job-seeker-card">
                <div class="job-seeker-header">
                    <img src="<?= isset($employer['profile_picture']) && !empty($employer['profile_picture']) ? '../../../../uploads/profile_pictures/' . $employer['profile_picture'] : '../../../public/images/OIP.jpg'; ?>" class="job-seeker-avatar">
                    <div class="job-seeker-info">
                        <div class="name-status-wrapper">
                            <span class="job-seeker-name"><?= htmlspecialchars($employer['company_name'] ?? 'N/A'); ?></span>
                            <span class="job-seeker-username"><?= htmlspecialchars($employer['user_name'] ?? 'N/A'); ?></span>
                        </div>
                        <div class="location-experience job-seeker-experience"><?= htmlspecialchars($employer['company_address'] ?? 'N/A'); ?> • <?= htmlspecialchars($employer['contact_info'] ?? 'N/A'); ?></div>
                        <div class="location-experience job-seeker-status"><?= htmlspecialchars($employer['status'] ?? 'N/A'); ?></div>
                    </div>
                </div>
                <div class="contact-info">
                    <div class="contact-item">
                        <span class="contact-label">Email:</span>
                        <span class="contact-value"><?= htmlspecialchars($employer['user_email'] ?? 'N/A'); ?></span>
                    </div>
                </div>
                <div class="expertise-section">
                    <div class="posted-jobs">
                        <h4>Posted Jobs:</h4>
                        <?php if (!empty($employer['posted_jobs'])): ?>
                            <ul>
                                <?php foreach ($employer['posted_jobs'] as $job): ?>
                                    <li>
                                        <strong><?= htmlspecialchars($job['title']) ?></strong> - <?= htmlspecialchars($job['description']) ?>
                                        <button type="button" class="job-action-btn" onclick="toggleModal('showModal-<?= $job['job_id'] ?>')">
                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M12 4C7.03 4 3.17 7.36 2.21 10.59a1 1 0 000 .82C3.17 16.64 7.03 20 12 20c4.97 0 8.83-3.36 9.79-6.59a1 1 0 000-.82C20.83 7.36 16.97 4 12 4zm0 12c-2.94 0-5.5-2.07-6.36-4.95C6.5 10.07 9.06 8 12 8c2.94 0 5.5 2.07 6.36 4.95C17.5 15.93 14.94 17 12 17z"></path>
                                                <circle cx="12" cy="12" r="3"></circle>
                                            </svg>
                                        </button>
                                    </li>

                                    <!-- Job Detail Modal -->
                                    <div id="showModal-<?= $job['job_id'] ?>" class="modal">
                                        <div class="modal-content">
                                            <span class="close-btn" onclick="toggleModal('showModal-<?= $job['job_id'] ?>')">&times;</span>
                                            <h4><?= htmlspecialchars($job['title']) ?></h4>
                                            <p><strong>Description:</strong> <?= htmlspecialchars($job['description']) ?></p>
                                            <p><strong>Requirements:</strong> <?= htmlspecialchars($job['requirements']) ?></p>
                                            <p><strong>Location:</strong> <?= htmlspecialchars($job['location']) ?></p>
                                            <p><strong>Job Type:</strong> <?= htmlspecialchars($job['job_type']) ?></p>
                                            <p><strong>Salary:</strong> <?= htmlspecialchars($job['salary']) ?></p>

                                            <!-- <p><strong>Job ID:</strong> <?= htmlspecialchars($job['job_id']) ?></p> -->
                                            <p><strong>Employer:</strong> <?= htmlspecialchars($employer['company_name']) ?></p>
                                            <p><strong>Location:</strong> <?= htmlspecialchars($employer['company_address']) ?></p>
                                            <p><strong>Contact:</strong> <?= htmlspecialchars($employer['contact_info']) ?></p>
                                        </div>
                                    </div>

                                <?php endforeach; ?>
                            </ul>
                        <?php else: ?>
                            <p>No Jobs Posted</p>
                        <?php endif; ?>
                    </div>
                </div>
               
            </div>


            
        <?php endforeach; ?>
    </div>

    
  </main>

  <style>
    /* Modal Background */
    .modal {
        display: none; 
        position: fixed; 
        z-index: 1; 
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0,0,0,0.4); 
    }

    /* Modal Content */
    .modal-content {
        background-color: white;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        max-width: 600px;
    }

    /* Close Button */
    .close-btn {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close-btn:hover,
    .close-btn:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
</style>
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
        //   function filterJobSeekerExperience() {
        //       const filterValue = document.getElementById("filterSelect").value.toLowerCase();
        //       const jobCards = document.querySelectorAll(".job-seeker-card"); 
        //       jobCards.forEach((card) => {
        //           const type = card.querySelector(".job-seeker-experience").textContent.toLowerCase();
        //           card.style.display =
        //               filterValue === "all" || type.includes(filterValue) ? "block" : "none";
        //       });
        //   }

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
         

// Toggle the modal visibility
function toggleModal(modalId) {
        var modal = document.getElementById(modalId);
        if (modal.style.display === "none" || modal.style.display === "") {
            modal.style.display = "block";
        } else {
            modal.style.display = "none";
        }
    }

    // Close the modal when the user clicks anywhere outside the modal content
    window.onclick = function(event) {
        var modals = document.querySelectorAll('.modal');
        modals.forEach(function(modal) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        });
    }
  </script>
</body>

</html>