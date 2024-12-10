  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Career Connect Jobs</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="<?=base_url();?>public/css/job.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.4/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.4/dist/sweetalert2.min.js"></script>

    <style>
       .job-status {
            display: inline-flex;
            align-items: center;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 500;
            width: fit-content;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 8px 16px;
            border-radius: 30px;
            font-size: 14px;
            font-weight: 600;
            letter-spacing: 0.01em;
            transition: all var(--animation-duration) ease;
        }

        .status-active {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.1) 0%, rgba(5, 150, 105, 0.1) 100%);
            color: #059669;
            border: 1px solid rgba(16, 185, 129, 0.2);
        }

        .status-active::before {
            content: '';
            display: inline-block;
            width: 8px;
            height: 8px;
            margin-right: 8px;
            background: var(--gradient-success);
            border-radius: 50%;
            box-shadow: 0 0 0 2px rgba(16, 185, 129, 0.2);
            animation: pulse 2s infinite;
        }

        .status-inactive {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.1) 0%, rgba(220, 38, 38, 0.1) 100%);
            color: #dc2626;
            border: 1px solid rgba(239, 68, 68, 0.2);
        }

        .status-inactive::before {
            content: '';
            display: inline-block;
            width: 8px;
            height: 8px;
            margin-right: 8px;
            background: var(--gradient-danger);
            border-radius: 50%;
            box-shadow: 0 0 0 2px rgba(239, 68, 68, 0.2);
        }


        /* .status-active::before,
.status-inactive::before {
    content: '';
    display: inline-block;
    width: 6px;
    height: 6px;
    border-radius: 50%;
    margin-right: 8px;
} */

        .status-active::before {
            background-color: #15803d;
            box-shadow: 0 0 0 2px rgba(21, 128, 61, 0.2);
        }

        .status-inactive::before {
            background-color: #dc2626;
            box-shadow: 0 0 0 2px rgba(220, 38, 38, 0.2);
        }

        /* Ensure text is centered with dot */
        .job-status span {
            display: flex;
            align-items: center;
            gap: 8px;
        }
    </style>
  </head>

  <body>
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
      <div class="content-wrapper">
        <div class="jobs-header">
          <h1 class="jobs-title">Jobs Management</h1>
        </div>

        <div class="search-filter-container">
          <div class="search-box">
            <svg class="search-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <circle cx="11" cy="11" r="8"></circle>
              <path d="M21 21l-4.35-4.35"></path>
            </svg>
            <input type="text"  
                  id="searchInput"
                  oninput="searchJobs()"
                  class="search-input" 
                  placeholder="Search jobs...">
          </div>
          <select  
                id="filterSelect"
                onchange="filterJobs()" 
                class="filter-dropdown">
            <option value="">All Job Types</option>
            <option value="full-time">Full Time</option>
            <option value="part-time">Part Time</option>
            <option value="remote">Remote</option>
          </select>

          <select  
                id="filterStatusSelect"
                onchange="filterJobsStatus()" 
                class="filter-dropdown">
            <option value="">All Job Status</option>
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
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

        <div class="jobs-grid">
        <?php if (!empty($jobs)): ?>
          <?php foreach ($jobs as $job): ?>
            <div class="job-card job-container">
              <div class="job-header">
                <div class="job-title-wrapper">
                  <h3 class="job-title"><?= htmlspecialchars($job['title']); ?></h3>
                  <div class="job-subtitle">
                    <span class="job-badge job-type"><?= htmlspecialchars($job['job_type']); ?></span>
                  </div>
                </div>
                <div class="job-actions">
                  <button type="button" class="job-action-btn" onclick="toggleModal('showModal-<?= $job['job_id'] ?>')">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 4C7.03 4 3.17 7.36 2.21 10.59a1 1 0 000 .82C3.17 16.64 7.03 20 12 20c4.97 0 8.83-3.36 9.79-6.59a1 1 0 000-.82C20.83 7.36 16.97 4 12 4zm0 12c-2.94 0-5.5-2.07-6.36-4.95C6.5 10.07 9.06 8 12 8c2.94 0 5.5 2.07 6.36 4.95C17.5 15.93 14.94 17 12 17z"></path>
                        <circle cx="12" cy="12" r="3"></circle>
                    </svg>
                  </button>
                  <button class="job-action-btn delete" type="button" onclick="confirmDelete(event, <?= $job['job_id'] ?>)" title="Delete">
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
                  <p><?= htmlspecialchars($job['description']); ?></p>
                </div>
                <div class="job-status">
                  <span class="job-status <?= $job['status'] === 'active' ? 'status-active' : 'status-inactive' ?>">
                    <?= htmlspecialchars($job['status']); ?>
                  </span>
                </div>
                
                <?php if ($job['status'] === 'inactive' ): ?>
                  
                  <div class="job-detail">
                    Last active: 
                    <span data-inactive-at="<?= htmlspecialchars($job['inactive_timestamp'] ?? ''); ?>"></span>
                  </div>
                <?php endif; ?>

              </div>
            </div>

            <div id="showModal-<?= $job['job_id'] ?>" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50">
              <div class="bg-white rounded-lg shadow-lg max-w-lg w-full p-6 overflow-hidden space-y-6">
                  
                  <!-- Modal Header -->
                  <div class="text-center">
                      <h2 class="text-2xl font-semibold text-gray-800"><?= htmlspecialchars($job['title']) ?></h2>
                      <p class="text-gray-600 text-sm mt-1"><?= htmlspecialchars($job['location']) ?></p>
                  </div>

                  <!-- Job Title -->
                  <div class="border-t border-gray-300 pt-4">
                      <h3 class="text-lg font-medium text-gray-700">Job Description</h3>
                      <p class="text-gray-800 mt-2"><?= htmlspecialchars($job['description']) ?></p>
                  </div>

                  <!-- Job Requirements -->
                  <div>
                      <h3 class="text-lg font-medium text-gray-700">Requirements</h3>
                      <ul class="text-gray-800 mt-2 list-disc pl-5">
                          <?php foreach (explode(",", $job['requirements']) as $requirement): ?>
                              <li><?= htmlspecialchars($requirement) ?></li>
                          <?php endforeach; ?>
                      </ul>
                  </div>

                  <!-- Salary & Job Type -->
                  <div class="flex justify-between mt-4">
                      <div class="w-1/2 pr-2">
                          <h3 class="text-lg font-medium text-gray-700">Salary</h3>
                          <p class="text-gray-800"><?= htmlspecialchars($job['salary']) ?></p>
                      </div>
                      <div class="w-1/2 pl-2">
                          <h3 class="text-lg font-medium text-gray-700">Job Type</h3>
                          <p class="text-gray-800"><?= htmlspecialchars($job['job_type']) ?></p>
                      </div>
                  </div>

                  <div class="flex justify-between mt-4">
                      <div class="w-1/2 pr-2">
                          <h3 class="text-lg font-medium text-gray-700">Company Name</h3>
                          <p class="text-gray-800"><?= htmlspecialchars($job['company_name']) ?></p>
                      </div>
                      <div class="w-1/2 pl-2">
                          <h3 class="text-lg font-medium text-gray-700">Company Address</h3>
                          <p class="text-gray-800"><?= htmlspecialchars($job['company_address']) ?></p>
                      </div>
                      <div class="w-1/2 pl-2">
                          <h3 class="text-lg font-medium text-gray-700">contact Information</h3>
                          <p class="text-gray-800"><?= htmlspecialchars($job['contact_info']) ?></p>
                      </div>
                  </div>

                  <!-- Job Status -->
                  <div class="border-t border-gray-300 pt-4">
                      <h3 class="text-lg font-medium text-gray-700">Status</h3>
                      <p class="text-gray-800"><?= htmlspecialchars($job['status']) ?></p>
                  </div>

                  <!-- Close Button -->
                  <div class="flex justify-end pt-6">
                      <button class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition-all" onclick="document.getElementById('showModal-<?= $job['job_id'] ?>').classList.add('hidden')">
                          Close
                      </button>
                  </div>

              </div>
            </div>


            <?php endforeach; ?>
          <?php endif;?>
        </div>
      </div>
    </main>

    <script>
        function searchJobs() {
            const searchInput = document.getElementById("searchInput").value.toLowerCase();
            const jobCards = document.querySelectorAll(".job-card"); 

            jobCards.forEach((card) => {
                const title = card.querySelector("h3")?.textContent.toLowerCase() || ""; 
                const description = card.querySelector("p")?.textContent.toLowerCase() || ""; 

                card.style.display =
                    title.includes(searchInput) || description.includes(searchInput) ? "block" : "none";
            });
        }


          function filterJobs() {
              const filterValue = document.getElementById("filterSelect").value.toLowerCase();
              const jobCards = document.querySelectorAll(".job-card"); 
              jobCards.forEach((card) => {
                  const type = card.querySelector(".job-type").textContent.toLowerCase();
                  card.style.display =
                      filterValue === "all" || type.includes(filterValue) ? "block" : "none";
              });
          }

          function filterJobsStatus() {
              const filterValue = document.getElementById("filterStatusSelect").value.toLowerCase();
              const jobCards = document.querySelectorAll(".job-card"); 
              jobCards.forEach((card) => {
                  const type = card.querySelector(".job-status").textContent.toLowerCase();
                  card.style.display =
                      filterValue === "all" || type.includes(filterValue) ? "block" : "none";
              });
          }
          
          let currentPage = 1;
          const jobsPerPage = 6;

          function paginateJobs() {
              const jobCards = Array.from(document.querySelectorAll(".job-card"));
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
              const jobCards = Array.from(document.querySelectorAll(".job-card"));
              const totalJobs = jobCards.length;
              const totalPages = Math.ceil(totalJobs / jobsPerPage);

              if (direction === "next" && currentPage < totalPages) currentPage++;
              if (direction === "prev" && currentPage > 1) currentPage--;

              paginateJobs();
          }
          document.addEventListener('DOMContentLoaded', function() {
              paginateJobs();
          });


          function timeAgo(timestamp) {
              const now = new Date();
              const inactiveDate = new Date(timestamp);

              if (isNaN(inactiveDate.getTime())) {
                  return "Invalid date";
              }

              const seconds = Math.floor((now - inactiveDate) / 1000);

              if (seconds < 60) return "now";
              const minutes = Math.floor(seconds / 60);
              if (minutes < 60) return `${minutes} minute${minutes > 1 ? "s" : ""} ago`;
              const hours = Math.floor(minutes / 60);
              if (hours < 24) return `${hours} hour${hours > 1 ? "s" : ""} ago`;
              const days = Math.floor(hours / 24);
              return `${days} day${days > 1 ? "s" : ""} ago`;
          }

          function updateTimes() {
              document.querySelectorAll("[data-inactive-at]").forEach((element) => {
                  const timestamp = element.dataset.inactiveAt;
                  console.log("Timestamp:", timestamp); // Debugging to ensure timestamp is correct
                  element.textContent = timeAgo(timestamp);
              });
          }

          document.addEventListener("DOMContentLoaded", function() {
              updateTimes();
          });


          function toggleModal(modalId) {
              const modal = document.getElementById(modalId);
              modal.classList.toggle('hidden');
          }

          function confirmDelete(event, jobId) {
              event.preventDefault(); 

              Swal.fire({
                  title: 'Are you sure?',
                  text: 'Do you really want to delete this job post?',
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonText: 'Yes, delete it!',
                  cancelButtonText: 'No, keep it',
                  reverseButtons: true
              }).then((result) => {
                  if (result.isConfirmed) {
                      const deleteUrl = "<?= site_url('admin/deleteJob/') ?>" + jobId;
                      window.location.href = deleteUrl;
                  } else {
                      toastr.info('Job post delete canceled.', 'Canceled'); 
                  }
              });
          }

    
    </script>
  </body>

  </html>