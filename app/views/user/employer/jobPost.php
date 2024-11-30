<?php
include APP_DIR.'views/templates/header.php';
?>
<body class="bg-gray-50 text-gray-800">

    <?php
        include APP_DIR.'views/templates/nav.php';
    ?>  
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6 text-center">Your Job Posts</h1>
        <!-- Display success or error message if set -->
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

        <?php
            $applicationCounts = [];
            foreach ($counts as $count) {
                // Only count applications that are not Cancelled, Hired, or Rejected
                if ($count['status'] !== 'Cancelled' && $count['status'] !== 'Hired' && $count['status'] !== 'Rejected') {
                    $applicationCounts[$count['job_id']] = ($applicationCounts[$count['job_id']] ?? 0) + 1;
                }
            }
        ?>


        <!-- Check if there are jobs to display -->
        <?php if (!empty($jobs)): ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Loop through each job and display its details -->
                <?php foreach ($jobs as $job): ?>
                    <div class="bg-white rounded-lg shadow-md p-6 relative">
                        <h2 class="text-xl font-semibold mb-2"><?= htmlspecialchars($job['title']) ?></h2>
                        <p class="text-gray-600 mb-2">
                            <strong>Location:</strong> <?= htmlspecialchars($job['location']) ?>
                        </p>
                        <p class="text-gray-600 mb-4">
                            <strong>Status:</strong> 
                            <span class="px-3 py-1 text-sm font-semibold rounded-full 
                                <?= $job['status'] === 'active' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' ?>">
                                <?= htmlspecialchars($job['status']) ?>
                            </span>
                        </p>

                        <!-- Applications info -->
                        <div class="absolute top-4 right-4">
                            <span class="bg-blue-100 text-blue-700 text-sm font-bold px-3 py-1 rounded-lg">
                                <?= $applicationCounts[$job['job_id']] ?? '0' ?> Applications
                            </span>
                        </div>

                        <div class="flex justify-between mt-4">
                            <button type="button" onclick="toggleModal('editModal-<?= $job['job_id'] ?>')" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Edit Post</button>
                            <!-- <a href="<?= site_url('user/employer/viewApplications/'.$job['job_id']) ?>">See Applications</a> -->
                            <form action="<?= site_url('user/employer/viewApplications') ?>" method="POST" class="inline">
                                <input type="hidden" name="job_id" value="<?= $job['job_id'] ?>">
                                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">See Applications</button>
                            </form>
                            <button type="button" onclick="confirmDelete(event, <?= $job['job_id'] ?>)" class="text-red-600 hover:underline">Delete</button>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div id="editModal-<?= $job['job_id'] ?>" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50">
                        <div class="bg-white rounded-lg shadow-lg max-w-md w-full p-6">
                            <h3 class="text-xl font-bold mb-4">Edit Job Post</h3>
                            <form id="edit-form-<?= $job['job_id'] ?>" action="<?= site_url('user/employer/updateJobPost/'.$job['job_id']) ?>" method="POST">
                                <!-- Form fields -->
                                <div class="mb-4">
                                    <label for="title-<?= $job['job_id'] ?>" class="block text-sm font-medium text-gray-700">Job Title</label>
                                    <input type="text" id="title-<?= $job['job_id'] ?>" name="title" value="<?= htmlspecialchars($job['title']) ?>" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-200">
                                </div>
                                <div class="mb-3">
                                    <label for="jobDescription" class="form-label">Job Description</label>
                                    <textarea class="form-control" id="jobDescription" name="description" rows="3" required><?= htmlspecialchars($job['description']) ?></textarea>
                                </div>

                                <!-- Job Requirements -->
                                <div class="mb-3">
                                    <label for="jobRequirements" class="form-label">Requirements</label>
                                    <textarea class="form-control" id="jobRequirements" name="requirements" rows="3" required><?= htmlspecialchars($job['requirements']) ?></textarea>
                                </div>

                                <!-- Job Location -->
                                <div class="mb-3">
                                    <label for="jobLocation" class="form-label">Location</label>
                                    <input type="text" class="form-control" id="jobLocation" name="location" value="<?= htmlspecialchars($job['location']) ?>" required>
                                </div>

                                <div class="mb-3">
                                    <label for="jobSalary" class="form-label">Salary</label>
                                    <input type="text" class="form-control" id="salary" name="salary" value="<?= htmlspecialchars($job['salary']) ?>" required>
                                </div>

                                <div class="mb-3">
                                    <label for="category" class="form-label">Category</label>
                                    <select class="form-select" id="category" name="category" required>
                                        <option value="Software Development">Software Development</option>
                                        <option value="Web Development & Design">Web Development & Design</option>
                                        <option value="Data & Analytics">Data & Analytics</option>
                                        <option value="Artificial Intelligence & Machine Learning">Artificial Intelligence & Machine Learning</option>
                                        <option value="Cloud Computing & DevOps">Cloud Computing & DevOps</option>
                                        <option value="Cybersecurity">Cybersecurity</option>
                                        <option value="IT Infrastructure & Networking">IT Infrastructure & Networking</option>
                                        <option value="IT Management & Leadership">IT Management & Leadership</option>
                                        <option value="Software Testing & Quality Assurance">Software Testing & Quality Assurance</option>
                                        <option value="Database Management">Database Management</option>
                                        <option value="Emerging Technologies">Emerging Technologies</option>
                                        <option value="Technical Writing & Documentation">Technical Writing & Documentation</option>
                                        <option value="IT Sales & Consulting">IT Sales & Consulting</option>
                                        <option value="Specialized IT Fields">Specialized IT Fields</option>
                                    </select>
                                </div>

                                <!-- Job Type -->
                                <div class="mb-3">
                                    <label for="jobType" class="form-label">Job Type</label>
                                    <select class="form-select" id="jobType" name="job_type" value="<?= htmlspecialchars($job['job_type']) ?>" required>
                                    <option value="full-time">Full-time</option>
                                    <option value="part-time">Part-time</option>
                                    <option value="remote">Remote</option>
                                    </select>
                                </div>

                                <!-- Job Status -->
                                <div class="mb-3">
                                    <label for="jobStatus" class="form-label">Status</label>
                                    <select class="form-select" id="jobStatus" name="status" required>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                    </select>
                                </div>

                                <div class="flex justify-end space-x-4">
                                    <button type="button" onclick="toggleModal('editModal-<?= $job['job_id'] ?>')" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">Cancel</button>
                                    <button type="submit" onclick="confirmSaveChanges(event, <?= $job['job_id'] ?>)" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="text-center text-gray-600">No job posts found.</p>
        <?php endif; ?>
    </div>

    <script>
        function toggleModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.classList.toggle('hidden');
        }

        function confirmSaveChanges(event, jobId) {
            event.preventDefault();

            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you want to save these changes?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, save changes!',
                cancelButtonText: 'No, cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('edit-form-' + jobId).submit();
                } else {
                    toastr.info('Job post update canceled.', 'Canceled');
                }
            });
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
                    const deleteUrl = "<?= site_url('user/employer/deleteJob/') ?>" + jobId;
                    window.location.href = deleteUrl;
                } else {
                    toastr.info('Job post delete canceled.', 'Canceled'); 
                }
            });
        }
    </script>

</body>
</html>
