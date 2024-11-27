<?php
include APP_DIR . 'views/templates/header.php';
?>

<body>
    <?php include APP_DIR . 'views/templates/nav.php'; ?>

    <div class="container mx-auto mt-10 px-4">
        <h2 class="text-3xl font-semibold text-gray-900 mb-8">Saved Jobs</h2>

        <?php if (isset($savedJobs) && !empty($savedJobs)): ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach ($savedJobs as $job): ?>
                    <?php
                        // Check if the job is already applied, hired, rejected, or scheduled
                        $shouldHide = false;
                        foreach ($applications as $app) {
                            // Ensure $app is an array and contains 'job_id' and 'status'
                            if (is_array($app) && isset($app['job_id'])) {
                                if ($app['job_id'] == $job['job_id'] && in_array($app['status'], ['Applied', 'Hired', 'Rejected', 'Scheduled'])) {
                                    $shouldHide = true;
                                    break;
                                }
                            }
                        }
                    ?>
                    <?php if (!$shouldHide): ?>
                        <div class="bg-white rounded-lg shadow-lg p-6 border border-gray-200 hover:shadow-xl transition job-card">
                            <h2 class="text-xl font-bold mb-2 text-gray-800"><?= htmlspecialchars($job['title']); ?></h2>
                            <p class="text-gray-600 mb-4"><?= htmlspecialchars($job['description']); ?></p>
                            <p class="mb-2"><strong>Requirements:</strong> <?= htmlspecialchars($job['requirements']); ?></p>
                            <p class="mb-2"><strong>Location:</strong> <?= htmlspecialchars($job['location']); ?></p>
                            <p class="mb-2 job-type"><strong>Type:</strong> <?= htmlspecialchars($job['job_type']); ?></p>
                            <p class="mb-2"><strong>Salary:</strong> <?= htmlspecialchars($job['salary']); ?></p>
                            <p class="mb-4 text-sm text-gray-500">
                                Posted at: <span data-posted-at="<?= htmlspecialchars($job['posted_at']); ?>"></span>
                            </p>
                            <h3 class="text-lg font-bold mb-2">Employer Details</h3>
                            <p class="mb-2"><strong>Company:</strong> <?= htmlspecialchars($job['company_name']); ?></p>
                            <p class="mb-2"><strong>Contact:</strong> <?= htmlspecialchars($job['contact_info']); ?></p>
                            <p class="mb-4"><strong>Status:</strong> <?= htmlspecialchars($job['status']); ?></p>

                            <?php if ($role === 'jobseeker'): ?>
                                <?php if ($job['status'] === 'inactive'): ?>
                                    <span class="text-red-500 font-semibold">Inactive</span>
                                <?php else: ?>
                                    <button 
                                        class="mt-4 bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition"
                                        onclick="openModal(<?= $job['job_id']; ?>)"
                                    >
                                        Apply to this Job
                                    </button>
                                <?php endif; ?>
                            <?php endif; ?>
                            <button 
                                class="save-job-button" 
                                data-job-id="<?= htmlspecialchars($job['job_id']); ?>" 
                                onclick="saveJob(this)"
                            >
                                <i class="bx bx-heart"></i>
                            </button>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="text-center text-gray-500 text-lg">No saved jobs found.</p>
        <?php endif; ?>

    </div>

    <div id="applyModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg w-1/3">
            <div class="flex justify-between items-center px-6 py-4 border-b">
                <h3 class="text-xl font-semibold">Apply for Job</h3>
                <button onclick="closeModal()" class="text-gray-500 hover:text-gray-800">&times;</button>
            </div>
            <form action="<?= site_url('user/jobseeker/job/apply') ?>" method="POST" enctype="multipart/form-data" class="p-6">
                <input type="hidden" id="jobIdField" name="job_id" value="<?= htmlspecialchars($job['job_id']); ?>">
                <div class="mb-4">
                    <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                    <input type="text" id="first_name" name="first_name" required class="mt-1 p-2 border border-gray-300 rounded w-full">
                </div>
                <div class="mb-4">
                    <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                    <input type="text" id="last_name" name="last_name" required class="mt-1 p-2 border border-gray-300 rounded w-full">
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" required class="mt-1 p-2 border border-gray-300 rounded w-full">
                </div>
                <div class="mb-4">
                    <label for="resume" class="block text-sm font-medium text-gray-700">Resume (Optional)</label>
                    <input type="file" id="resume" name="resume" class="mt-1 p-2 border border-gray-300 rounded w-full">
                </div>
                <div class="flex justify-end">
                    <button type="button" onclick="closeModal()" class="mr-4 bg-gray-200 px-4 py-2 rounded hover:bg-gray-300">Cancel</button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <script>
         function openModal(jobId) {
            console.log('opening the modal with id:' + jobId);
            const modal = document.getElementById('applyModal'); // Corrected the ID reference
            const jobIdField = document.getElementById('jobIdField'); // Corrected the ID reference
            modal.classList.remove('hidden');
            jobIdField.value = jobId; 
        }


        function closeModal() {
            const modal = document.getElementById('applyModal');
            modal.classList.add('hidden');
        }

        function saveJob(button) {
            window.location.href = '<?= site_url("user/jobseeker/saved-jobs") ?>';

            const jobId = button.dataset.jobId;
            const icon = button.querySelector("svg");

            fetch('<?= site_url("user/jobseeker/save-job") ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({ job_id: jobId }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    // Toggle the heart icon class
                    // if (icon.classList.contains('bx-heart')) {
                    //     icon.classList.remove('bx-heart', 'text-gray-500');
                    //     icon.classList.add('bxs-heart', 'text-red-500');
                    // } else {
                    //     icon.classList.remove('bxs-heart', 'text-red-500');
                    //     icon.classList.add('bx-heart', 'text-gray-500');
                    // }

                    // Refresh the entire page (if you want the whole page to reload)
                    window.location.href = '<?= site_url("user/jobseeker/saved-jobs") ?>';

                } else {
                    alert(data.message || "Failed to save the job.");
                }
            })
            .catch(error => console.error('Error:', error));
        }

       
    </script>

</body>
</html>
