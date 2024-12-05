<?php
include APP_DIR.'views/templates/header.php';
?>
<body class="bg-gray-100">
    <div id="app">
      <?php
      include APP_DIR.'views/templates/nav.php';
      ?>  

        <?php if (!empty($_SESSION['toastr'])): ?>
        <script>
            $(document).ready(function() {
                toastr.<?= $_SESSION['toastr']['type']; ?>("<?= $_SESSION['toastr']['message']; ?>");
            });
        </script>
        <?php unset($_SESSION['toastr']); endif; ?>

        <!-- <?php if ($role === 'employer'): ?>
            <button type="button" class="btn-modal" onclick="openModal()">
                Post a Job
            </button>

            <div id="jobPostModal" class="modal">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 id="jobPostModalLabel">Post a Job</h5>
                        <button type="button" class="btn-close" onclick="closeModal()">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form id="jobPostForm" method="POST" action="<?=site_url('user/employer/job-post');?>">
                            <div class="mb-3">
                                <label for="jobTitle" class="form-label">Job Title</label>
                                <input type="text" class="form-control" id="jobTitle" name="title" required>
                            </div>

                            <div class="mb-3">
                                <label for="jobDescription" class="form-label">Job Description</label>
                                <textarea class="form-control" id="jobDescription" name="description" rows="3" required></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="jobRequirements" class="form-label">Requirements</label>
                                <textarea class="form-control" id="jobRequirements" name="requirements" rows="3" required></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="jobLocation" class="form-label">Location</label>
                                <input type="text" class="form-control" id="jobLocation" name="location" required>
                            </div>

                            <div class="mb-3">
                                <label for="jobSalary" class="form-label">Salary</label>
                                <input type="text" class="form-control" id="salary" name="salary" required>
                            </div>

                            <div class="mb-3">
                                <label for="jobType" class="form-label">Job Type</label>
                                <select class="form-select" id="jobType" name="job_type" required>
                                    <option value="full-time">Full-time</option>
                                    <option value="part-time">Part-time</option>
                                    <option value="remote">Remote</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="jobStatus" class="form-label">Status</label>
                                <select class="form-select" id="jobStatus" name="status" required>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>

            <script>
                // Function to open the modal
                function openModal() {
                    document.getElementById('jobPostModal').style.display = 'block'; // Show the modal
                }

                // Function to close the modal
                function closeModal() {
                    document.getElementById('jobPostModal').style.display = 'none'; // Hide the modal
                }

                // Close modal if clicked outside of it
                window.onclick = function(event) {
                    var modal = document.getElementById('jobPostModal');
                    if (event.target === modal) {
                        closeModal();
                    }
                }
            </script>

            <style>
                /* Button styles */
                .btn-modal {
                    background-color: #28a745;
                    color: white;
                    padding: 10px 20px;
                    border: none;
                    border-radius: 5px;
                    cursor: pointer;
                    font-size: 16px;
                }

                .btn-modal:hover {
                    background-color: #218838;
                }

                /* Modal styles */
                .modal {
                    display: none; /* Hidden by default */
                    position: fixed;
                    z-index: 1050;
                    left: 0;
                    top: 0;
                    width: 100%;
                    height: 100%;
                    overflow: auto;
                    background-color: rgba(0, 0, 0, 0.5); /* Backdrop */
                    align-items: center;
                    justify-content: center;
                }

                .modal-content {
                    background-color: #fff;
                    padding: 20px;
                    border-radius: 5px;
                    width: 50%;
                    max-width: 600px;
                }

                /* Modal header styles */
                .modal-header {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                }

                .modal-header h5 {
                    margin: 0;
                    font-size: 1.5rem;
                }

                .btn-close {
                    background: none;
                    border: none;
                    font-size: 1.5rem;
                    cursor: pointer;
                }

                /* Modal body styles */
                .modal-body {
                    margin-top: 15px;
                }

                /* Form input styles */
                .form-label {
                    font-weight: bold;
                }

                .form-control, .form-select {
                    width: 100%;
                    padding: 10px;
                    margin-bottom: 15px;
                    border-radius: 5px;
                    border: 1px solid #ccc;
                }

                .form-select {
                    background-color: #fff;
                }

                /* Button styles */
                .btn-primary {
                    background-color: #007bff;
                    color: white;
                    padding: 10px 20px;
                    border: none;
                    border-radius: 5px;
                    cursor: pointer;
                }

                .btn-primary:hover {
                    background-color: #0056b3;
                }
            </style>

        <?php endif; ?> -->
    
    <?php
        include APP_DIR.'views/templates/employer/jobLists.php';
    ?> 
    

    </div>

    <!-- Bootstrap and jQuery Scripts -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script> -->
</body>
</html>
