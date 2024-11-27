<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Listings</title>
    <style>
        .job-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            padding: 20px;
        }

        .job-card {
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .job-card:hover {
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .job-header {
            display: flex;
            align-items: flex-start;
            gap: 15px;
            margin-bottom: 15px;
        }

        .company-logo {
            width: 48px;
            height: 48px;
            border-radius: 8px;
            background: #f3f4f6;
        }

        .job-title {
            font-size: 18px;
            font-weight: 600;
            color: #111827;
            margin: 0 0 5px 0;
        }

        .company-name {
            font-size: 14px;
            color: #4b5563;
            margin: 0;
        }

        .job-meta {
            display: flex;
            gap: 15px;
            margin-bottom: 15px;
        }

        .meta-item {
            font-size: 14px;
            color: #6b7280;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .job-status {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 500;
        }

        .status-active {
            background-color: #dcfce7;
            color: #166534;
        }

        .status-inactive {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .view-details-btn {
            color: #2563eb;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            background: none;
            border: none;
            padding: 0;
        }

        .view-details-btn:hover {
            text-decoration: underline;
        }

/* Updated Modal styles */
.modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 0;
            width: 90%;
            max-width: 1000px;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .modal-header {
            padding: 24px 32px;
            border-bottom: 1px solid #e5e7eb;
            position: relative;
        }

        .modal-body {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 32px;
            padding: 32px;
        }

        .modal-main {
            border-right: 1px solid #e5e7eb;
            padding-right: 32px;
        }

        .modal-sidebar {
            padding-left: 0;
        }

        .modal-title {
            font-size: 28px;
            font-weight: 600;
            color: #111827;
            margin: 0 0 16px 0;
        }

        .modal-meta {
            display: flex;
            gap: 24px;
            margin-bottom: 24px;
            color: #6b7280;
        }

        .modal-meta-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
        }

        .modal-company {
            margin-bottom: 24px;
        }

        .modal-company-logo {
            width: 64px;
            height: 64px;
            border-radius: 8px;
            margin-bottom: 16px;
        }

        .modal-company-name {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .modal-company-description {
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 16px;
        }

        .modal-section {
            margin-bottom: 24px;
        }

        .modal-section h3 {
            font-size: 16px;
            font-weight: 600;
            color: #111827;
            margin-bottom: 12px;
        }

        .modal-section p {
            font-size: 14px;
            color: #4b5563;
            line-height: 1.6;
        }

        .modal-actions {
            display: flex;
            gap: 12px;
            margin-bottom: 24px;
        }

        .modal-social {
            display: flex;
            gap: 8px;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-primary {
            background-color: #2563eb;
            color: white;
            border: none;
            width: 100%;
        }

        .btn-secondary {
            background-color: white;
            color: #374151;
            border: 1px solid #d1d5db;
        }

        .social-btn {
            padding: 8px;
            border-radius: 6px;
            background: #f3f4f6;
            border: none;
            cursor: pointer;
            color: #374151;
        }

        .close {
            position: absolute;
            right: 24px;
            top: 24px;
            font-size: 24px;
            color: #9ca3af;
            cursor: pointer;
            border: none;
            background: none;
        }

        .views-count {
            display: flex;
            align-items: center;
            gap: 4px;
            color: #6b7280;
            font-size: 14px;
        }
        .company-details {
            margin: 16px 0;
            font-size: 14px;
            color: #6b7280;
        }
        
        .company-details p {
            margin: 4px 0;
        }

        @media (max-width: 768px) {
            .modal-body {
                grid-template-columns: 1fr;
            }

            .modal-main {
                border-right: none;
                padding-right: 0;
            }

            .modal-sidebar {
                padding-left: 0;
                border-top: 1px solid #e5e7eb;
                padding-top: 24px;
            }
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-8">
        <h1 class="text-3xl font-bold mb-6">Job Listings</h1>
        
        <div class="job-grid">
            <?php if (!empty($jobs)): ?>
                <?php foreach ($jobs as $job): ?>
                    <div class="job-card" data-job-id="<?= $job['job_id']; ?>">
                        <!-- Basic Info (Always Visible) -->
                        <div class="job-header">
                            <img src="<?= htmlspecialchars($job['company_logo'] ?? '/path/to/default-logo.png'); ?>" 
                                 alt="<?= htmlspecialchars($job['company_name']); ?>" 
                                 class="company-logo">
                            <div>
                                <h2 class="job-title"><?= htmlspecialchars($job['title']); ?></h2>
                                <p class="company-name"><?= htmlspecialchars($job['company_name']); ?></p>
                            </div>
                        </div>

                        <div class="job-meta">
                            <span class="meta-item">📍 <?= htmlspecialchars($job['location']); ?></span>
                            <span class="meta-item">💼 <?= htmlspecialchars($job['job_type']); ?></span>
                        </div>

                        <span class="job-status <?= $job['status'] === 'active' ? 'status-active' : 'status-inactive' ?>">
                            <?= htmlspecialchars($job['status']); ?>
                        </span>

                        <button class="view-details-btn" onclick="openJobModal(<?= htmlspecialchars(json_encode($job)); ?>)">
                            View Details
                        </button>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-gray-600">No jobs found.</p>
            <?php endif; ?>
        </div>
    </div>

<!-- Updated Modal Structure -->
<div id="jobModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <button class="close">&times;</button>
        </div>
        <div class="modal-body">
            <div class="modal-main">
                <h1 id="modalJobTitle" class="modal-title"></h1>
                <div class="modal-meta">
                    <span class="modal-meta-item" id="modalLocation">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 22s-8-4.5-8-11.8A8 8 0 0 1 12 2a8 8 0 0 1 8 8.2c0 7.3-8 11.8-8 11.8z"/>
                            <circle cx="12" cy="10" r="3"/>
                        </svg>
                        <span></span>
                    </span>
                    <span class="modal-meta-item" id="modalJobType">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="2" y="7" width="20" height="14" rx="2" ry="2"/>
                            <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/>
                        </svg>
                        <span></span>
                    </span>
                    <span class="views-count">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                            <circle cx="12" cy="12" r="3"/>
                        </svg>
                        <span></span>
                    </span>
                </div>

                <div class="modal-section">
                    <h3>Description</h3>
                    <p id="modalDescription"></p>
                </div>

                <div class="modal-section">
                    <h3>Requirements</h3>
                    <p id="modalRequirements"></p>
                </div>

                <div class="modal-section">
                    <h3>Salary</h3>
                    <p id="modalSalary"></p>
                </div>

                <div class="modal-section">
                    <h3>Company Details</h3>
                    <p id="modalCompanyDetails"></p>
                </div>
            </div>

            <div class="modal-sidebar">
                <div class="modal-company">
                    <img id="modalCompanyLogo" class="modal-company-logo" src="" alt="">
                    <h2 id="modalCompanyName" class="modal-company-name"></h2>
                    <p class="modal-company-description">A leading online marketplace for extraordinary design.</p>

                    <!-- Company Details moved here -->
                    <div class="company-details">
                        <p><strong>Contact:</strong> <span id="modalCompanyContact"></span></p>
                        <p><strong>Posted:</strong> <span id="modalPostedDate"></span></p>
                    </div>
                    
                    <div class="modal-actions">
                        <a id="modalApplyButton" href="#" class="btn btn-primary">Apply to this job</a>
                    </div>
                    
                    <button class="btn btn-secondary" style="width: 100%;">
                        Save
                    </button>
                </div>

                <div class="modal-section">
                    <h3>Share this job</h3>
                    <div class="modal-social">
                        <button class="social-btn" onclick="shareJob('twitter')">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"/>
                            </svg>
                        </button>
                        <button class="social-btn" onclick="shareJob('facebook')">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
                            </svg>
                        </button>
                        <button class="social-btn" onclick="shareJob('linkedin')">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/>
                                <rect x="2" y="9" width="4" height="12"/>
                                <circle cx="4" cy="4" r="2"/>
                            </svg>
                        </button>
                        <button class="social-btn" onclick="shareJob('email')">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                <polyline points="22,6 12,13 2,6"/>
                            </svg>
                        </button>
                        <button class="social-btn" onclick="copyJobLink()">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="9" y="9" width="13" height="13" rx="2" ry="2"/>
                                <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <script>
        // Get the modal
        var modal = document.getElementById("jobModal");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        function openJobModal(job) {
        document.getElementById("modalJobTitle").textContent = job.title;
        document.getElementById("modalCompanyName").textContent = job.company_name;
        document.getElementById("modalCompanyLogo").src = job.company_logo || '/path/to/default-logo.png';
        document.getElementById("modalCompanyContact").textContent = job.contact_info;
        document.getElementById("modalPostedDate").textContent = job.posted_at;
        document.getElementById("modalLocation").querySelector("span").textContent = job.location;
        document.getElementById("modalJobType").querySelector("span").textContent = job.job_type;
        document.getElementById("modalDescription").textContent = job.description;
        document.getElementById("modalRequirements").textContent = job.requirements;
        document.getElementById("modalSalary").textContent = job.salary;
        document.getElementById("modalCompanyDetails").innerHTML = `
            <strong>Contact:</strong> ${job.contact_info}<br>
            <strong>Posted:</strong> ${job.posted_at}
        `;
        
        document.getElementById("modalApplyButton").href = `/job/apply/${job.job_id}`;
        
        modal.style.display = "block";
    }

    function copyJobLink() {
        navigator.clipboard.writeText(window.location.href);
        alert('Link copied to clipboard!');
    }

    function shareJob(platform) {
        const url = window.location.href;
        const title = document.getElementById("modalJobTitle").textContent;
        
        const platforms = {
            twitter: `https://twitter.com/intent/tweet?text=${encodeURIComponent(title)}&url=${encodeURIComponent(url)}`,
            facebook: `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}`,
            linkedin: `https://www.linkedin.com/sharing/share-offsite/?url=${encodeURIComponent(url)}`,
            email: `mailto:?subject=${encodeURIComponent(title)}&body=${encodeURIComponent(url)}`
        };

        if (platforms[platform]) {
            window.open(platforms[platform], '_blank');
        }
    }
    </script>
</body>
</html>