<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Listings</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="container mx-auto mt-8">
        <h1 class="text-3xl font-bold mb-6">Job Listings</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php if (!empty($jobs)): ?>
                <?php foreach ($jobs as $job): ?>
                    <div class="bg-white rounded-lg shadow p-20">
                        <h2 class="text-xl font-semibold mb-2"><?= htmlspecialchars($job['title']); ?></h2>
                        <p class="text-gray-600 mb-4"><?= htmlspecialchars($job['description']); ?></p>
                        <p class="mb-2"><strong>Requirements:</strong> <?= htmlspecialchars($job['requirements']); ?></p>
                        <p class="mb-2"><strong>Location:</strong> <?= htmlspecialchars($job['location']); ?></p>
                        <p class="mb-2"><strong>Type:</strong> <?= htmlspecialchars($job['job_type']); ?></p>
                        <p class="mb-2"><strong>Salary:</strong> <?= htmlspecialchars($job['salary']); ?></p>
                        <p class="mb-4 text-sm text-gray-500">Posted at: <?= htmlspecialchars($job['posted_at']); ?></p>
                        <h3 class="text-lg font-bold mb-2">Employer Details</h3>
                        <p class="mb-2"><strong>Company:</strong> <?= htmlspecialchars($job['company_name']); ?></p>
                        <p class="mb-2"><strong>Contact:</strong> <?= htmlspecialchars($job['contact_info']); ?></p>
                        <p class="mb-4"><strong>Status:</strong> <?= htmlspecialchars($job['status']); ?></p>
                        <a href="/job/view/<?= $job['job_id']; ?>" class="text-blue-500 hover:underline">View Details</a>
                      
                    </div>

                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-gray-600">No jobs found.</p>
            <?php endif; ?>
           

        </div>
       
    </div>
</body>
</html>
