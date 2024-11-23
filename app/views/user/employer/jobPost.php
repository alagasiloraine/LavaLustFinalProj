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

        <!-- Check if there are jobs to display -->
        <?php if (!empty($jobs)): ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Loop through each job and display its details -->
                <?php foreach ($jobs as $job): ?>
                    <div class="bg-white rounded-lg shadow-md p-6">
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
                        <div class="flex justify-between">
                            <button type="button" onclick="toggleModal('editModal-<?= $job['job_id'] ?>')" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Edit Post</button>
                            <button type="button" onclick="confirmDelete(event, <?= $job['job_id'] ?>)" class="text-red-600 hover:underline">Delete</button>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div id="editModal-<?= $job['job_id'] ?>" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50">
                        <div class="bg-white rounded-lg shadow-lg max-w-md w-full p-6">
                            <h3 class="text-xl font-bold mb-4">Edit Job Post</h3>
                            <form id="edit-form-<?= $job['job_id'] ?>" action="<?=site_url('user/employer/updateJobPost/'.$job['job_id'])?>" method="POST">
                                <div class="mb-4">
                                    <label for="title-<?= $job['job_id'] ?>" class="block text-sm font-medium text-gray-700">Job Title</label>
                                    <input type="text" id="title-<?= $job['job_id'] ?>" name="title" value="<?= htmlspecialchars($job['title']) ?>" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-200">
                                </div>
                                <div class="mb-4">
                                    <label for="description-<?= $job['job_id'] ?>" class="block text-sm font-medium text-gray-700">Description</label>
                                    <input type="text" id="description-<?= $job['job_id'] ?>" name="description" value="<?= htmlspecialchars($job['description']) ?>" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-200">
                                </div>
                                <div class="mb-4">
                                    <label for="requirements-<?= $job['job_id'] ?>" class="block text-sm font-medium text-gray-700">Requirements</label>
                                    <input type="text" id="requirements-<?= $job['job_id'] ?>" name="requirements" value="<?= htmlspecialchars($job['requirements']) ?>" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-200">
                                </div>
                                <div class="mb-4">
                                    <label for="location-<?= $job['job_id'] ?>" class="block text-sm font-medium text-gray-700">Location</label>
                                    <input type="text" id="location-<?= $job['job_id'] ?>" name="location" value="<?= htmlspecialchars($job['location']) ?>" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-200">
                                </div>
                                <div class="mb-4">
                                    <label for="salary-<?= $job['job_id'] ?>" class="block text-sm font-medium text-gray-700">Salary</label>
                                    <input type="text" id="salary-<?= $job['job_id'] ?>" name="salary" value="<?= htmlspecialchars($job['salary']) ?>" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-200">
                                </div>
                                <div class="mb-4">
                                    <label for="job_type-<?= $job['job_id'] ?>" class="block text-sm font-medium text-gray-700">Job Type</label>
                                    <select id="job_type-<?= $job['job_id'] ?>" name="job_type" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-200">
                                        <option value="full-time" <?= $job['job_type'] === 'full-time' ? 'selected' : '' ?>>Full-time</option>
                                        <option value="part-time" <?= $job['job_type'] === 'part-time' ? 'selected' : '' ?>>Part-Time</option>
                                        <option value="remote" <?= $job['job_type'] === 'remote' ? 'selected' : '' ?>>Remote</option>
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label for="status-<?= $job['job_id'] ?>" class="block text-sm font-medium text-gray-700">Status</label>
                                    <select id="status-<?= $job['job_id'] ?>" name="status" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-200">
                                        <option value="active" <?= $job['status'] === 'active' ? 'selected' : '' ?>>Active</option>
                                        <option value="inactive" <?= $job['status'] === 'inactive' ? 'selected' : '' ?>>Inactive</option>
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
                    // Properly concatenate the site URL with the jobId in JavaScript
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
