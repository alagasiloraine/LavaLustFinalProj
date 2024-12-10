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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-rXxIFbCxF4CyCPgYwMdNsVov2GAzGpGQKgEfiGyjH71Szs5bNJPaTvY1f3JibXoElH3s5IjroFZ8x3TBuEFyKg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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
    <div class="job-seekers-header">
      <div class="header-top">
        <div>
          <h1 class="job-seekers-title">Employers</h1>
        </div>
      </div>
    </div>

    <div class="search-filters-container ">
      <div class="search-container items-center">
        <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <circle cx="11" cy="11" r="8"></circle>
          <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
        </svg>
        <input type="text"  id="searchInput"
              oninput="searchJobSeeker()" class="search-input" placeholder="Search employers...">
      </div>
  
      <div class="mb-6 flex justify-between items-center space-x-2 ">
        <button onclick="changePage('prev')" class="bg-blue-800 text-white text-sm px-2 py-1 rounded-lg hover:bg-blue-600 transition shadow-sm">
            Previous
        </button>
        <span id="paginationInfo" class="text-gray-700 font-medium"></span>
        <button  onclick="changePage('next')" class="bg-blue-800 text-white text-sm px-2 py-1 rounded-lg hover:bg-blue-600 transition shadow-sm">
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
                    <div class="posted-jobs p-2">
                        <h5 class="text-xl font-bold mb-4">Posted Jobs:</h5>
                        <?php if (!empty($employer['posted_jobs'])): ?>
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 h-56 overflow-auto p-2">
                                <?php foreach ($employer['posted_jobs'] as $job): ?>
                                    <div class="bg-white rounded-lg shadow-lg border p-2 transition-transform transform hover:scale-105">
                                        <h3 class="text-md font-semibold text-blue-800"><?= htmlspecialchars($job['title']) ?></h3>
                                        <p class="text-gray-600 mb-4 text-sm"><?= htmlspecialchars($job['description']) ?></p>
                                        <button type="button" class="job-action-btn text-blue-600 hover:text-blue-800" onclick="toggleModal('showModal-<?= $job['job_id'] ?>')">
                                            <span>view</span>
                                        </button>
                                    </div>

                                    <!-- Job Detail Modal -->
                                    <div id="showModal-<?= $job['job_id'] ?>" class="modal fixed inset-0 z-50 flex top-1 justify-center items-center bg-black bg-opacity-70 hidden overflow-hidden">
                                        <div class="modal-content bg-white rounded-lg shadow-lg p-8 w-full max-w-lg transition-transform transform scale-95 hover:scale-100">
                                            <span class="close-btn text-gray-500 hover:text-gray-700 cursor-pointer text-2xl" onclick="toggleModal('showModal-<?= $job['job_id'] ?>')">&times;</span>
                                            <h4 class="text-2xl font-bold text-bluue-800 mb-4"><?= htmlspecialchars($job['title']) ?></h4>
                                            
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                                <div class="bg-gray-100 p-4 rounded-lg shadow">
                                                    <h5 class="font-semibold text-lg text-blue-600">Job Details</h5>
                                                    <p class="text-gray-700"><strong>Description:</strong> <?= htmlspecialchars($job['description']) ?></p>
                                                    <p class="text-gray-700"><strong>Requirements:</strong> <?= htmlspecialchars($job['requirements']) ?></p>
                                                </div>
                                                <div class="bg-gray-100 p-4 rounded-lg shadow">
                                                    <h5 class="font-semibold text-lg text-blue-600">Job Information</h5>
                                                    <p class="text-gray-700"><strong>Location:</strong> <?= htmlspecialchars($job['location']) ?></p>
                                                    <p class="text-gray-700"><strong>Job Type:</strong> <?= htmlspecialchars($job['job_type']) ?></p>
                                                    <p class="text-gray-700"><strong>Salary:</strong> <?= htmlspecialchars($job['salary']) ?></p>
                                                </div>
                                                <div class="bg-gray-100 p-4 rounded-lg shadow">
                                                    <h5 class="font-semibold text-lg text-blue-600">Employer Information</h5>
                                                    <p class="text-gray-700"><strong>Employer:</strong> <?= htmlspecialchars($employer['company_name']) ?></p>
                                                    <p class="text-gray-700"><strong>Address:</strong> <?= htmlspecialchars($employer['company_address']) ?></p>
                                                    <p class="text-gray-700"><strong>Contact:</strong> <?= htmlspecialchars($employer['contact_info']) ?></p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <p class="text-gray-600">No Jobs Posted</p>
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