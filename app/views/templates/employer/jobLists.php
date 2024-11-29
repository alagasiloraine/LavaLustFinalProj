<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find Your Dream Job Here</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&display=swap');
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        h1 {
            color: #FFFFFF;
        }
        .hero-section {
            background-color: #2B5592;
            max-width: 800vh;
            margin-left: -150px;
            margin-right: -150px;
            position: relative;
            text-align: center;
            padding: 25px 15px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .hero-title {
            color: #FFFFFF;
            font-size: 30px;
            font-weight: 600;
            margin-bottom: 24px;
            text-transform: uppercase;
            max-width: 800px;
            line-height: 1.2;
        }

        .hero-h1{
            color: #2B5592;
            font-size: 20px;
            font-weight: 600;
            margin-top: 50px;
            max-width: 700px;
            line-height: 1.2;
        }

        .search-container {
            max-width: 450px;
            width: 50%;
            margin: 20px auto;
            display: flex;
            gap: 10px;
            padding: 10px;
            background: white;
            border-radius: 50px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .search-input {
            flex: 1;
            padding: 12px 20px;
            border: none;
            background: transparent;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            outline: none;
        }

        .search-button {
            background: #2563eb;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 25px;
            font-family: 'Poppins', sans-serif;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .search-button:hover {
            background: #1d4ed8;
        }
        .job-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 24px;
            padding: 10px;
            height: -50px;
            max-width: 1500px;
            margin: 0 auto;
        }

        .job-card {
            background: white;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            border: 1px solid #eee;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .job-card:hover {
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            background-color: #e6f3ff;
        }

        .job-header {
            display: flex;
            align-items: flex-start;
            gap: 16px;
            margin-bottom: 16px;
        }

        .company-logo {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            object-fit: cover;
        }

        .job-title {
            font-size: 18px;
            font-weight: 600;
            color: #111827;
            margin: 0 0 4px 0;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .company-name {
            font-size: 14px;
            color: #4b5563;
            margin: 0;
        }

        .job-meta {
            display: flex;
            gap: 30px;
            margin-top: 15px;
            margin-bottom: 20px;
        }

        .meta-item {
            font-size: 14px;
            color: #6b7280;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .job-status {
            font-size: 13px;
            font-weight: 500;
            padding: 5px 20px;
            border-radius: 12px;
            width: fit-content;
            display: inline-flex;
            align-items: center;
        }

        .status-active {
            background-color: rgba(220, 252, 231, 0.6);
            color: #15803d;
        }

        .status-inactive {
            background-color: rgba(254, 226, 226, 0.6);
            color: #dc2626;
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

        /* Add these new styles */
.recommended-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 40px;
    margin-top: 50px;
}

.view-all-btn {
    background-color: #2B5592;
    color: white;
    border: none;
    padding: 8px 20px;
    border-radius: 6px;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    transition: background-color 0.2s;
}

.view-all-btn:hover {
    background-color: #1e3a66;
}

.pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 5px;
    padding: 25px 0 48px;
    margin-left: 1050px;
}

.pagination-btn {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 8px 16px;
    border: 1px solid #e5e7eb;
    border-radius: 6px;
    background: white;
    color: #374151;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s;
}

.pagination-btn:hover:not(:disabled) {
    background: #f3f4f6;
    border-color: #d1d5db;
}

.pagination-btn:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

.page-numbers {
    display: flex;
    align-items: center;
    gap: 8px;
}

.current-page {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    border-radius: 6px;
    background: #2B5592;
    color: white;
    font-size: 14px;
    font-weight: 500;
}

/* Update the existing hero-h1 style */
.hero-h1 {
    color: #2B5592;
    font-size: 20px;
    font-weight: 600;
    margin: 0; /* Remove top margin since it's handled by the container */
    line-height: 1.2;
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
            .hero-title {
                font-size: 20px;
            }

            .search-container {
                flex-direction: column;
                border-radius: 12px;
                gap: 5px;
            }

            .location-input {
                border-left: none;
                border-top: 1px solid #eee;
            }

            .search-button {
                width: 100%;
            }
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-8">
        <div class="hero-section">
            <h1 class="hero-title">FIND YOUR DREAM JOB HERE</h1>
            <div class="search-container">
                <input type="text" class="search-input" placeholder="Job title or keyword">
                <button class="search-button">Search</button>
            </div>
        </div>
       
        <div class="recommended-header">
            <h1 class="hero-h1">Recommended jobs</h1>
            <button class="view-all-btn">View All Jobs</button>
        </div>
        <!-- Add pagination after the job grid -->
        <div class="pagination">
            <button id="prevPage" class="pagination-btn" disabled>
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M15 18l-6-6 6-6"/>
                </svg>
                Previous
            </button>
            <div id="pageNumbers" class="page-numbers">
                <span class="current-page">1</span>
            </div>
            <button id="nextPage" class="pagination-btn">
                Next
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M9 18l6-6-6-6"/>
                </svg>
            </button>
        </div>
        <div class="job-grid">
            <?php if (!empty($jobs)): ?>
                <?php foreach ($jobs as $job): ?>
                    <div class="job-card" data-job-id="<?= $job['job_id']; ?>">
                        <div class="job-header">
                            <img src="<?= htmlspecialchars($job['company_logo'] ?? '/path/to/default-logo.png'); ?>" 
                                 alt="<?= htmlspecialchars($job['company_name']); ?>" 
                                 class="company-logo">
                            <div>
                                <h2 class="job-title"><?= htmlspecialchars($job['title']); ?></h2>
                                <p class="company-name"><?= htmlspecialchars($job['company_name']); ?></p>
                            </div>
                        </div>

                        <span class="job-status <?= $job['status'] === 'active' ? 'status-active' : 'status-inactive' ?>">
                            <?= htmlspecialchars($job['status']); ?>
                        </span>

                        <div class="job-meta">
                            <span class="meta-item">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M12 22s-8-4.5-8-11.8A8 8 0 0 1 12 2a8 8 0 0 1 8 8.2c0 7.3-8 11.8-8 11.8z"/>
                                    <circle cx="12" cy="10" r="3"/>
                                </svg>
                                <?= htmlspecialchars($job['location']); ?>
                            </span>
                            <span class="meta-item">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="2" y="7" width="20" height="14" rx="2" ry="2"/>
                                    <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/>
                                </svg>
                                <?= htmlspecialchars($job['job_type']); ?>
                            </span>
                        </div>

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
                </div>

                <div class="modal-sidebar">
                    <div class="modal-company">
                        <img id="modalCompanyLogo" class="modal-company-logo" src="" alt="">
                        <h2 id="modalCompanyName" class="modal-company-name"></h2>
                        <p class="modal-company-description">A leading online marketplace for extraordinary design.</p>

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
        const ITEMS_PER_PAGE = 6;
        let currentPage = 1;
        var modal = document.getElementById("jobModal");
        var span = document.getElementsByClassName("close")[0];

        span.onclick = function() {
            modal.style.display = "none";
        }

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

            // Add pagination functionality
    const prevButton = document.getElementById('prevPage');
    const nextButton = document.getElementById('nextPage');
    const pageNumbers = document.getElementById('pageNumbers');

    function updateJobGrid() {
        const startIndex = (currentPage - 1) * ITEMS_PER_PAGE;
        const endIndex = startIndex + ITEMS_PER_PAGE;
        const visibleJobs = jobs.slice(startIndex, endIndex);

        // Clear existing job grid
        jobGrid.innerHTML = '';

        // Add visible jobs
        visibleJobs.forEach(job => {
            const jobCard = createJobCard(job);
            jobGrid.appendChild(jobCard);
        });

        // Update pagination state
        prevButton.disabled = currentPage === 1;
        nextButton.disabled = endIndex >= jobs.length;
        
        // Update page number
        pageNumbers.innerHTML = `
            <span class="current-page">${currentPage}</span>
        `;
    }

    prevButton.addEventListener('click', () => {
        if (currentPage > 1) {
            currentPage--;
            updateJobGrid();
            // Smooth scroll to top of grid
            jobGrid.scrollIntoView({ behavior: 'smooth' });
        }
    });

    nextButton.addEventListener('click', () => {
        if (currentPage * ITEMS_PER_PAGE < jobs.length) {
            currentPage++;
            updateJobGrid();
            // Smooth scroll to top of grid
            jobGrid.scrollIntoView({ behavior: 'smooth' });
        }
    });

    // Initialize the grid with the first page
    updateJobGrid();

    // Add click handler for "View All Jobs" button
    document.querySelector('.view-all-btn').addEventListener('click', function() {
        // Add your "View All" functionality here
        // For example, redirect to a full job listing page
        // window.location.href = '/all-jobs';
        alert('View all jobs clicked!');
    });
    </script>
</body>
</html>