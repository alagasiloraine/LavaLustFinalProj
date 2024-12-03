<?php
include APP_DIR . 'views/templates/header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saved Jobs - Career Connect</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            color: #333;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }

        .main-content {
            padding-top: 40px; 
            max-width: 1200px;
            margin: 0 auto;
            padding-left: 24px;
            padding-right: 24px;
        }

        .page-header {
            margin-bottom: 30px;
        }

        .page-title {
            font-size: 24px;
            font-weight: 600;
            color: #2d3748;
            margin: 0;
            margin-bottom: 6px;
            line-height: 1.2;
        }

        .page-subtitle {
            font-size: 14px;
            color: #6b7280;
            margin: 0;
            font-weight: 400;
        }

        .jobs-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 24px;
            margin-top: 24px;
        }

        .job-card {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            padding: 24px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            border: 1px solid #e2e8f0;
            position: relative;
        }

        .job-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .job-title {
            font-size: 20px;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 12px;
            line-height: 1.4;
        }

        .job-company {
            font-size: 16px;
            color: #4a5568;
            margin-bottom: 16px;
        }

        .job-details {
            margin: 16px 0;
            padding: 16px 0;
            border-top: 1px solid #e2e8f0;
            border-bottom: 1px solid #e2e8f0;
        }

        .job-detail-item {
            display: flex;
            align-items: center;
            margin-bottom: 8px;
            color: #4a5568;
        }

        .detail-label {
            font-weight: 500;
            min-width: 100px;
            color: #2d3748;
        }

        .job-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 500;
            font-size: 14px;
            transition: all 0.2s ease;
            cursor: pointer;
            border: none;
        }

        .btn-apply {
            background-color: #4299e1;
            color: white;
        }

        .btn-apply:hover {
            background-color: #3182ce;
        }

        .btn-apply[disabled] {
            background-color: #cbd5e0;
            cursor: not-allowed;
        }

        .save-job-button {
            position: absolute;
            top: 20px;
            right: 20px;
            background: none;
            border: none;
            cursor: pointer;
            font-size: 24px;
            color: #e53e3e;
            transition: transform 0.2s ease;
        }

        .save-job-button:hover {
            transform: scale(1.1);
        }

        .modal {
            display: none;
            position: fixed;
            inset: 0;
            background-color: rgba(0, 0, 0, 0.5);
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }

        .modal-content {
            background: white;
            border-radius: 12px;
            width: 90%;
            max-width: 500px;
            position: relative;
        }

        .modal-header {
            padding: 20px;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-body {
            padding: 20px;
        }

        .form-group {
            margin-bottom: 16px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #2d3748;
        }

        .form-input {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            font-size: 14px;
        }

        .form-input:focus {
            outline: none;
            border-color: #4299e1;
            box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.1);
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .empty-state-icon {
            font-size: 48px;
            color: #a0aec0;
            margin-bottom: 16px;
        }

        .empty-state-text {
            font-size: 18px;
            color: #4a5568;
            margin-bottom: 8px;
        }

        .empty-state-subtext {
            color: #718096;
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .main-content {
                padding-top: 64px;
                padding-left: 16px;
                padding-right: 16px;
            }

            .page-title {
                font-size: 28px;
            }

            .page-subtitle {
                font-size: 14px;
            }

            .jobs-grid {
                grid-template-columns: 1fr;
            }

            .modal-content {
                width: 95%;
                margin: 0 16px;
            }
        }
    </style>
</head>
<body>
    <?php include APP_DIR . 'views/templates/nav.php'; ?>

    <div class="main-content">
        <div class="page-header">
            <h1 class="page-title">Saved Jobs</h1>
            <p class="page-subtitle">Track and manage your favorite job opportunities</p>
        </div>

        <?php if (isset($savedJobs) && !empty($savedJobs)): ?>
            <div class="jobs-grid">
                <?php foreach ($savedJobs as $job): ?>
                    <?php
                        $shouldHide = false;
                        foreach ($applications as $app) {
                            if (is_array($app) && isset($app['job_id'])) {
                                if ($app['job_id'] == $job['job_id'] && in_array($app['status'], ['Applied', 'Hired', 'Rejected', 'Scheduled'])) {
                                    $shouldHide = true;
                                    break;
                                }
                            }
                        }
                    ?>
                    <?php if (!$shouldHide): ?>
                        <div class="job-card">
                            <h2 class="job-title"><?= htmlspecialchars($job['title']); ?></h2>
                            <p class="job-company"><?= htmlspecialchars($job['company_name']); ?></p>
                            
                            <div class="job-details">
                                <div class="job-detail-item">
                                    <span class="detail-label">Location:</span>
                                    <span><?= htmlspecialchars($job['location']); ?></span>
                                </div>
                                <div class="job-detail-item">
                                    <span class="detail-label">Type:</span>
                                    <span><?= htmlspecialchars($job['job_type']); ?></span>
                                </div>
                                <div class="job-detail-item">
                                    <span class="detail-label">Salary:</span>
                                    <span><?= htmlspecialchars($job['salary']); ?></span>
                                </div>
                                <div class="job-detail-item">
                                    <span class="detail-label">Status:</span>
                                    <span><?= htmlspecialchars($job['status']); ?></span>
                                </div>
                            </div>

                            <div class="job-actions">
                                <?php if ($role === 'jobseeker'): ?>
                                    <?php if ($job['status'] === 'inactive'): ?>
                                        <button class="btn btn-apply" disabled>Position Inactive</button>
                                    <?php else: ?>
                                        <button class="btn btn-apply" onclick="openModal(<?= $job['job_id']; ?>)">
                                            Apply Now
                                        </button>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>

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
            <div class="empty-state">
                <div class="empty-state-icon">📌</div>
                <h3 class="empty-state-text">No saved jobs found</h3>
                <p class="empty-state-subtext">Start saving jobs you're interested in to view them here</p>
            </div>
        <?php endif; ?>
    </div>

    <div id="applyModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Apply for Job</h3>
                <button onclick="closeModal()" class="close-button">&times;</button>
            </div>
            <div class="modal-body">
                <form action="<?= site_url('user/jobseeker/job/apply') ?>" method="POST" enctype="multipart/form-data">
                    <input type="hidden" id="jobIdField" name="job_id">
                    <div class="form-group">
                        <label class="form-label" for="first_name">First Name</label>
                        <input type="text" id="first_name" name="first_name" required class="form-input">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="last_name">Last Name</label>
                        <input type="text" id="last_name" name="last_name" required class="form-input">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="email">Email</label>
                        <input type="email" id="email" name="email" required class="form-input">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="resume">Resume (Optional)</label>
                        <input type="file" id="resume" name="resume" class="form-input">
                    </div>
                    <div class="job-actions">
                        <button type="button" onclick="closeModal()" class="btn">Cancel</button>
                        <button type="submit" class="btn btn-apply">Submit Application</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openModal(jobId) {
            console.log('opening the modal with id:' + jobId);
            const modal = document.getElementById('applyModal');
            const jobIdField = document.getElementById('jobIdField');
            modal.style.display = 'flex';
            jobIdField.value = jobId; 
        }

        function closeModal() {
            const modal = document.getElementById('applyModal');
            modal.style.display = 'none';
        }

        function saveJob(button) {
            const jobId = button.dataset.jobId;
            const icon = button.querySelector("i");

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
                    if (icon.classList.contains('bx-heart')) {
                        icon.classList.remove('bx-heart');
                        icon.classList.add('bxs-heart');
                    } else {
                        icon.classList.remove('bxs-heart');
                        icon.classList.add('bx-heart');
                    }
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

