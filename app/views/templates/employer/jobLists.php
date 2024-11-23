<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Listings</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        function timeAgo(timestamp) {
            const now = new Date();
            const postedDate = new Date(timestamp);
            const seconds = Math.floor((now - postedDate) / 1000);

            if (seconds < 60) return "now";
            const minutes = Math.floor(seconds / 60);
            if (minutes < 60) return `${minutes} minute${minutes > 1 ? "s" : ""} ago`;
            const hours = Math.floor(minutes / 60);
            if (hours < 24) return `${hours} hour${hours > 1 ? "s" : ""} ago`;
            const days = Math.floor(hours / 24);
            return `${days} day${days > 1 ? "s" : ""} ago`;
        }

        function updateTimes() {
            document.querySelectorAll("[data-posted-at]").forEach((element) => {
                const timestamp = element.dataset.postedAt;
                element.textContent = timeAgo(timestamp);
            });
        }

        document.addEventListener("DOMContentLoaded", updateTimes);

        function openModal(jobId) {
            const modal = document.getElementById('applyModal');
            const jobIdField = document.getElementById('jobIdField');
            modal.classList.remove('hidden');
            jobIdField.value = jobId; // Pass job ID to the hidden field
        }

        function closeModal() {
            const modal = document.getElementById('applyModal');
            modal.classList.add('hidden');
        }
    </script>
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="container mx-auto mt-8">
        <h1 class="text-3xl font-bold mb-6">Job Listings</h1>

        <?php if($role === 'employer'): ?>
            <!-- Button to trigger Job Post Modal -->
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#jobPostModal">
                Post a Job
            </button>
        <?php endif;?>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php if (!empty($jobs)): ?>
                <?php foreach ($jobs as $job): ?>
                    <div class="bg-white rounded-lg shadow p-6">
                        <h2 class="text-xl font-semibold mb-2"><?= htmlspecialchars($job['title']); ?></h2>
                        <p class="text-gray-600 mb-4"><?= htmlspecialchars($job['description']); ?></p>
                        <p class="mb-2"><strong>Requirements:</strong> <?= htmlspecialchars($job['requirements']); ?></p>
                        <p class="mb-2"><strong>Location:</strong> <?= htmlspecialchars($job['location']); ?></p>
                        <p class="mb-2"><strong>Type:</strong> <?= htmlspecialchars($job['job_type']); ?></p>
                        <p class="mb-2"><strong>Salary:</strong> <?= htmlspecialchars($job['salary']); ?></p>
                        <p class="mb-4 text-sm text-gray-500">
                            Posted at: <span data-posted-at="<?= htmlspecialchars($job['posted_at']); ?>"></span>
                        </p>
                        <h3 class="text-lg font-bold mb-2">Employer Details</h3>
                        <p class="mb-2"><strong>Company:</strong> <?= htmlspecialchars($job['company_name']); ?></p>
                        <p class="mb-2"><strong>Contact:</strong> <?= htmlspecialchars($job['contact_info']); ?></p>
                        <p class="mb-4"><strong>Status:</strong> <?= htmlspecialchars($job['status']); ?></p>
                        
                        <?php if ($role === 'jobseeker'): ?>
                            <?php
                                // Initialize flags
                                $applied = false;
                                $hired = false;
                                $scheduled = false;

                                // Check the applications for this job
                                foreach ($applications as $app) {
                                    if ($app['job_id'] == $job['job_id']) {
                                        if ($app['status'] === 'Applied') {
                                            $applied = true;
                                        } elseif ($app['status'] === 'Hired') {
                                            $hired = true;
                                        } elseif ($app['status'] === 'Scheduled') {
                                            $scheduled = true;
                                        }
                                        break; // Stop checking once a match is found
                                    }
                                }
                            ?>
                            <?php if ($hired): ?>
                                <span class="text-green-500 font-semibold">Hired</span>
                            <?php elseif ($scheduled): ?>
                                <span class="text-yellow-500 font-semibold">Scheduled</span>
                            <?php elseif ($applied): ?>
                                <span class="text-blue-500 font-semibold">Applied</span>
                            <?php else: ?>
                                <button 
                                    class="mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600" 
                                    onclick="openModal(<?= $job['job_id']; ?>)"
                                    <?= $job['status'] === 'inactive' ? 'disabled' : ''; ?>>
                                    Apply to this Job
                                </button>
                            <?php endif; ?>
                        <?php endif; ?>


                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-gray-600">No jobs found.</p>
            <?php endif; ?>

        </div>
    </div>

    <!-- Modal -->
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
</body>
</html>
