<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
	<script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
	<link rel="stylesheet" type="text/css"  href="https://cdn.datatables.net/buttons/1.4.0/css/buttons.dataTables.min.css" />

</head>
<body class="bg-gray-100 text-gray-800">

    <div class="container mx-auto mt-8">
        <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">Job Listings</h1>

        <?php
            include APP_DIR.'views/templates/employer/postModal.php';
        ?> 

        <div class="mb-6 flex flex-col md:flex-row md:justify-between gap-4">
            <div class="flex-grow">
                <input
                    type="text"
                    id="searchInput"
                    oninput="searchJobs()"
                    placeholder="Search for jobs..."
                    class="p-3 border border-gray-300 rounded-lg w-full shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none"
                />
            </div>

            <div class="flex-grow md:flex-grow-0">
                <select
                    id="filterSelect"
                    onchange="filterJobs()"
                    class="p-3 border border-gray-300 rounded-lg w-full shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none"
                >
                    <option value="all">All Job Types</option>
                    <option value="full-time">Full-Time</option>
                    <option value="part-time">Part-Time</option>
                    <option value="remote">Remote</option>
                </select>
            </div>
        </div>

        <div class="mb-6 flex justify-between items-center">
            <button 
                onclick="changePage('prev')" 
                class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition shadow-sm"
            >
                Previous
            </button>
            <span id="paginationInfo" class="text-gray-700 font-medium"></span>
            <button 
                onclick="changePage('next')" 
                class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition shadow-sm"
            >
                Next
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php if (!empty($jobs)): ?>
                <?php foreach ($jobs as $job): ?>
                    <?php
                        $shouldHide = false;
                        foreach ($applications as $app) {
                            if ($app['job_id'] == $job['job_id'] && in_array($app['status'], ['Applied', 'Hired', 'Rejected', 'Scheduled'])) {
                                $shouldHide = true;
                                break;
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
                            <p class="mb-2"><strong>Category:</strong> <?= htmlspecialchars($job['category'] ?? 'Undefined'); ?></p>
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
            <?php else: ?>
                <p class="text-gray-600 text-center col-span-full">No jobs found.</p>
            <?php endif; ?>
        </div>
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

        function searchJobs() {
            const searchInput = document.getElementById("searchInput").value.toLowerCase();
            const jobCards = document.querySelectorAll(".job-card"); 
            jobCards.forEach((card) => {
                const title = card.querySelector("h2").textContent.toLowerCase(); 
                const description = card.querySelector("p").textContent.toLowerCase(); 
                card.style.display =
                    title.includes(searchInput) || description.includes(searchInput) ? "block" : "none";
            });
        }

        function filterJobs() {
            const filterValue = document.getElementById("filterSelect").value.toLowerCase();
            const jobCards = document.querySelectorAll(".job-card"); 
            jobCards.forEach((card) => {
                const type = card.querySelector(".job-type").textContent.toLowerCase();
                card.style.display =
                    filterValue === "all" || type.includes(filterValue) ? "block" : "none";
            });
        }

        let currentPage = 1;
        const jobsPerPage = 6;

        function paginateJobs() {
            const jobCards = Array.from(document.querySelectorAll(".job-card"));
            const totalJobs = jobCards.length;
            const totalPages = Math.ceil(totalJobs / jobsPerPage);

            jobCards.forEach((card, index) => {
                card.style.display =
                    index >= (currentPage - 1) * jobsPerPage && index < currentPage * jobsPerPage
                        ? "block"
                        : "none";
            });

            document.getElementById("paginationInfo").textContent = `Page ${currentPage} of ${totalPages}`;
        }

        function changePage(direction) {
            const jobCards = Array.from(document.querySelectorAll(".job-card"));
            const totalJobs = jobCards.length;
            const totalPages = Math.ceil(totalJobs / jobsPerPage);

            if (direction === "next" && currentPage < totalPages) currentPage++;
            if (direction === "prev" && currentPage > 1) currentPage--;

            paginateJobs();
        }

        document.addEventListener("DOMContentLoaded", () => {
            paginateJobs();
        });

        function saveJob(button) {
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
                        if (icon.classList.contains('bx-heart')) {
                            icon.classList.remove('bx-heart', 'text-gray-500');
                            icon.classList.add('bxs-heart', 'text-red-500');
                        } else {
                            icon.classList.remove('bxs-heart', 'text-red-500');
                            icon.classList.add('bx-heart', 'text-gray-500');
                        }
                    } else {
                        alert(data.message || "Failed to save the job.");
                    }
                })
                .catch(error => console.error('Error:', error));
        }


    </script>
</body>
</html> -->


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find Your Dream Job Here</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&display=swap');

        :root {
            --gradient-primary: linear-gradient(135deg, #2B5592 0%, #1e40af 100%);
            --gradient-secondary: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            --gradient-success: linear-gradient(135deg, #10b981 0%, #059669 100%);
            --gradient-danger: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            --animation-duration: 0.3s;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        html,
        body {
            max-width: 100%;
            overflow-x: hidden;
            margin: 0;
            padding: 0;
        }

        .hero-section {
            background: linear-gradient(135deg, #2B5592 0%, #1a365d 100%);
            width: 100%;
            margin: 0;
            padding: 60px 24px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at center, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            pointer-events: none;
        }


        .container {
            width: 100%;
            max-width: 100%;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            position: relative;
        }

        .hero-title {
            font-size: 2.2rem;
            font-weight: 800;
            text-align: center;
            background: linear-gradient(to right, #ffffff 20%, #e2e8f0 40%, #f8fafc 60%, #ffffff 80%);
            background-size: 200% auto;
            color: #fff;
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: shine 3s ease-in-out infinite;
            text-shadow: 0 0 30px rgba(255, 255, 255, 0.2);
            letter-spacing: -0.5px;
            position: relative;
            padding: 20px 0;
            margin: 0;
            display: inline-block;
        }


        /* Add decorative elements */
        .hero-title::before,
        .hero-title::after {
            content: '';
            position: absolute;
            width: 40px;
            height: 3px;
            background: linear-gradient(90deg, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0.5) 50%, rgba(255, 255, 255, 0) 100%);
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            border-radius: 2px;
        }

        .hero-title::before {
            bottom: auto;
            top: 0;
        }

        @keyframes shine {
            to {
                background-position: 200% center;
            }
        }

        /* Add wrapper for additional effects */
        .hero-title-wrapper {
            position: relative;
            padding: 10px;
            text-align: center;
        }

        .hero-title-wrapper::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at center, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            pointer-events: none;
        }

        /* Add responsive styles */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 1.8rem;
                padding: 15px 0;
            }

            .hero-title::before,
            .hero-title::after {
                width: 30px;
            }
        }

        .hero-h1 {
            color: #2B5592;
            font-size: 20px;
            font-weight: 600;
            margin-top: 50px;
            max-width: 700px;
            line-height: 1.2;
        }

        .search-container {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            width: 90%;
            max-width: 700px;
            margin: 24px auto 0;
            display: flex;
            align-items: center;
            padding: 6px;
            border-radius: 50px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .search-container:hover,
        .search-container:focus-within {
            background: rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            transform: translateY(-1px);
        }

        .search-input {
            flex: 1;
            background: transparent;
            border: none;
            padding: 16px 24px;
            color: white;
            font-size: 16px;
            font-weight: 500;
            width: 100%;
            transition: all 0.3s ease;
        }

        .search-input::placeholder {
            color: rgba(255, 255, 255, 0.7);
            font-weight: 400;
        }

        .search-input:focus {
            outline: none;
        }

        .search-button {
            background: white;
            color: #2B5592;
            border: none;
            padding: 14px 32px;
            border-radius: 25px;
            font-weight: 600;
            font-size: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-right: 4px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .search-button:hover {
            background: #f8fafc;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        /* Add animation for the search container */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .search-container {
            animation: fadeInUp 0.6s ease-out;
        }

        /* Enhanced grid layout */
        .job-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
            /* Increased from 320px */
            gap: 32px;
            padding: 32px;
            max-width: 1400px;
            /* Added max-width */
            margin: 0 auto;
            /* Center the grid */
            background: linear-gradient(135deg, rgba(248, 250, 252, 0.5) 0%, rgba(241, 245, 249, 0.5) 100%);
            border-radius: 24px;
        }



        .job-card {
            background: white;
            border-radius: 20px;
            padding: 32px;
            transition: all var(--animation-duration) cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid rgba(226, 232, 240, 0.8);
            display: flex;
            flex-direction: column;
            gap: 24px;
            position: relative;
            overflow: hidden;
            min-height: 280px;
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1),
                0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .job-card:hover {
            transform: translateY(-4px) scale(1.01);
            box-shadow: 0 20px 25px -5px rgba(43, 85, 146, 0.1),
                0 10px 10px -5px rgba(43, 85, 146, 0.04);
            border-color: rgba(43, 85, 146, 0.4);
        }

        /* Enhanced decorative elements */
        .job-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: var(--gradient-primary);
            opacity: 0;
            transition: opacity var(--animation-duration) ease;
        }

        .job-card::after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 150px;
            height: 150px;
            background: radial-gradient(circle at top right,
                    rgba(43, 85, 146, 0.08),
                    transparent 70%);
            opacity: 0;
            transition: opacity var(--animation-duration) ease;
        }

        .job-card:hover::before,
        .job-card:hover::after {
            opacity: 1;
        }

        .job-card:hover::after {
            background: linear-gradient(135deg, transparent 50%, rgba(43, 85, 146, 0.06) 50%);
        }


        .job-header {
            display: flex;
            align-items: flex-start;
            gap: 16px;
            position: relative;
        }

        .company-logo {
            width: 64px;
            height: 64px;
            border-radius: 16px;
            object-fit: cover;
            padding: 12px;
            background: var(--gradient-secondary);
            border: 2px solid transparent;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            transition: all var(--animation-duration) ease;
        }

        .job-card:hover .company-logo {
            border-color: #2B5592;
            transform: scale(1.05);
            box-shadow: 0 8px 12px rgba(43, 85, 146, 0.15);
        }

        .job-title {
            color: #1e3a8a;
            font-size: 20px;
            font-weight: 700;
            line-height: 1.4;
            transition: all var(--animation-duration) ease;
            letter-spacing: -0.02em;
        }

        .job-card:hover .job-title {
            color: #2B5592;
            transform: translateX(4px);
        }

        .company-name {
            color: #64748b;
            font-size: 15px;
            font-weight: 500;
            margin-top: 4px;
            transition: all var(--animation-duration) ease;
        }

        .job-card:hover .company-name {
            color: #475569;
        }

        .job-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            margin-top: 4px;
        }

        .meta-item {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            background: rgba(248, 250, 252, 0.8);
            border: 1px solid rgba(226, 232, 240, 0.8);
            border-radius: 25px;
            color: #475569;
            font-size: 14px;
            font-weight: 500;
            transition: all var(--animation-duration) ease;
            backdrop-filter: blur(4px);
        }

        .job-card:hover .meta-item {
            background: rgba(248, 250, 252, 0.9);
            border-color: rgba(43, 85, 146, 0.3);
            transform: translateY(-1px);
        }

        .meta-item svg {
            width: 16px;
            height: 16px;
            color: #2B5592;
            transition: transform var(--animation-duration) ease;
        }

        .job-card:hover .meta-item svg {
            transform: scale(1.1);
        }

        .job-status {
            display: inline-flex;
            align-items: center;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 500;
            width: fit-content;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 8px 16px;
            border-radius: 30px;
            font-size: 14px;
            font-weight: 600;
            letter-spacing: 0.01em;
            transition: all var(--animation-duration) ease;
        }

        .status-active {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.1) 0%, rgba(5, 150, 105, 0.1) 100%);
            color: #059669;
            border: 1px solid rgba(16, 185, 129, 0.2);
        }

        .status-active::before {
            content: '';
            display: inline-block;
            width: 8px;
            height: 8px;
            margin-right: 8px;
            background: var(--gradient-success);
            border-radius: 50%;
            box-shadow: 0 0 0 2px rgba(16, 185, 129, 0.2);
            animation: pulse 2s infinite;
        }

        .status-inactive {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.1) 0%, rgba(220, 38, 38, 0.1) 100%);
            color: #dc2626;
            border: 1px solid rgba(239, 68, 68, 0.2);
        }

        .status-inactive::before {
            content: '';
            display: inline-block;
            width: 8px;
            height: 8px;
            margin-right: 8px;
            background: var(--gradient-danger);
            border-radius: 50%;
            box-shadow: 0 0 0 2px rgba(239, 68, 68, 0.2);
        }


        /* .status-active::before,
.status-inactive::before {
    content: '';
    display: inline-block;
    width: 6px;
    height: 6px;
    border-radius: 50%;
    margin-right: 8px;
} */

        .status-active::before {
            background-color: #15803d;
            box-shadow: 0 0 0 2px rgba(21, 128, 61, 0.2);
        }

        .status-inactive::before {
            background-color: #dc2626;
            box-shadow: 0 0 0 2px rgba(220, 38, 38, 0.2);
        }

        /* Ensure text is centered with dot */
        .job-status span {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(21, 128, 61, 0.4);
            }

            70% {
                box-shadow: 0 0 0 6px rgba(21, 128, 61, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(21, 128, 61, 0);
            }
        }

        .view-details-btn {
            background: transparent;
            color: #2B5592;
            font-weight: 600;
            padding: 12px 24px;
            border: 2px solid rgba(43, 85, 146, 0.2);
            border-radius: 12px;
            transition: all var(--animation-duration) ease;
            position: relative;
            overflow: hidden;
            z-index: 1;
            margin-top: auto;
        }

        .view-details-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: var(--gradient-primary);
            opacity: 0;
            z-index: -1;
            transition: opacity var(--animation-duration) ease;
        }

        .view-details-btn:hover {
            color: white;
            border-color: transparent;
            transform: translateY(-1px);
        }

        .view-details-btn:hover::before {
            opacity: 1;
        }

        /* Pulse animation for active status */
        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.4);
            }

            70% {
                box-shadow: 0 0 0 6px rgba(16, 185, 129, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(16, 185, 129, 0);
            }
        }


        /* Modal Base */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(8px);
            animation: fadeIn 0.3s ease-out;
        }

        /* Modal Content */
        .modal-content {
            background: #ffffff;
            margin: 3% auto;
            width: 95%;
            max-width: 1000px;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            animation: modalSlideIn 0.4s ease-out;
            border: 1px solid rgba(0, 0, 0, 0.1);
        }

        .modal-content::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 4px;
            background: linear-gradient(to bottom, #2563eb, #3b82f6);
        }

        .modal-content::after {
            content: '';
            position: absolute;
            right: 0;
            top: 0;
            height: 100%;
            width: 4px;
            background: linear-gradient(to bottom, #3b82f6, #2563eb);
        }

        /* Modal Header */
        .modal-header {
            padding: 24px 32px;
            border-bottom: 1px solid #e5e7eb;
            position: relative;
            background: #f8fafc;
        }

        .modal-title {
            font-size: 28px;
            font-weight: 700;
            color: #1a202c;
            margin: 0 0 16px 0;
        }

        .modal-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            margin-bottom: 0;
        }

        .modal-meta-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            color: #4a5568;
            background: #edf2f7;
            padding: 6px 12px;
            border-radius: 20px;
        }

        /* Modal Body */
        .modal-body {
            display: grid;
            grid-template-columns: 1.5fr 1fr;
            gap: 32px;
            padding: 32px;
        }

        /* Main Content */
        .modal-main {
            border-right: 1px solid #e5e7eb;
            padding-right: 32px;
        }

        .modal-section {
            margin-bottom: 36px;
            margin-top: 36px;
        }

        .modal-section h3 {
            font-size: 18px;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 16px;
            padding-bottom: 8px;
            border-bottom: 2px solid #e2e8f0;
        }

        .modal-section p {
            font-size: 16px;
            color: #4a5568;
            line-height: 1.6;
        }

        /* Sidebar */
        .modal-sidebar {
            padding-left: 0;
        }

        .modal-company {
            background: #f8fafc;
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 24px;
        }

        .modal-company-logo {
            width: 80px;
            height: 80px;
            border-radius: 12px;
            margin-bottom: 16px;
            object-fit: cover;
        }

        .modal-company-name {
            font-size: 20px;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 8px;
        }

        .modal-company-description {
            font-size: 14px;
            color: #4a5568;
            margin-bottom: 16px;
            line-height: 1.6;
        }

        .company-details {
            margin: 16px 0;
            font-size: 14px;
            color: #4a5568;
        }

        .company-details p {
            margin: 8px 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Buttons */
        .modal-actions {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-bottom: 24px;
        }

        .btn {
            padding: 12px 24px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 500;
            text-decoration: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
        }

        /* Primary Button */
        .btn-primary {
            background: linear-gradient(135deg, #2563eb, #3b82f6);
            color: white;
            border: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px -4px rgba(37, 99, 235, 0.4);
        }

        .btn-primary:hover::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(120deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            animation: shimmer 1.5s infinite;
        }

        /* Secondary Button */
        .btn-secondary {
            background-color: white;
            color: #4a5568;
            border: 1px solid #e2e8f0;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .btn-secondary:hover {
            background-color: #f8fafc;
            border-color: #2563eb;
            color: #2563eb;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.15);
        }

        .btn-secondary:hover::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(120deg, transparent, rgba(37, 99, 235, 0.05), transparent);
            animation: shimmer 1.5s infinite;
        }

        @keyframes shimmer {
            0% {
                transform: translateX(-100%);
            }

            100% {
                transform: translateX(100%);
            }
        }

        /* Share section */
        .modal-social {
            margin-top: 24px;
            padding-top: 24px;
            border-top: 1px solid #e5e7eb;
        }

        .modal-social h3 {
            font-size: 16px;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 16px;
        }

        .social-btn {
            padding: 10px;
            border-radius: 8px;
            background: #edf2f7;
            border: none;
            cursor: pointer;
            color: #4a5568;
            transition: all 0.2s ease;
        }

        .social-btn:hover {
            background: #e2e8f0;
            transform: translateY(-2px);
        }

        /* Close button */
        .close {
            position: absolute;
            top: 24px;
            right: 24px;
            width: 36px;
            height: 36px;
            background: #edf2f7;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #4a5568;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
            font-size: 20px;
        }

        .close:hover {
            background: #e2e8f0;
            color: #2d3748;
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes modalSlideIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .modal-body {
                grid-template-columns: 1fr;
            }

            .modal-main {
                border-right: none;
                padding-right: 0;
                border-bottom: 1px solid #e5e7eb;
                padding-bottom: 32px;
            }

            .modal-sidebar {
                padding-top: 32px;
            }
        }

        @media (max-width: 640px) {

            .modal-header,
            .modal-body {
                padding: 20px;
            }

            .modal-title {
                font-size: 24px;
            }

            .modal-meta {
                flex-direction: column;
                align-items: flex-start;
            }
        }

        /* Add these new styles */
        .recommended-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 40px 40px 20px 40px;
            position: relative;
        }

        .recommended-header h1 {
            font-size: 28px;
            font-weight: 700;
            color: #1a365d;
            position: relative;
            padding-bottom: 8px;
        }

        .recommended-header h1::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 4px;
            background: linear-gradient(90deg, #2B5592, #3b82f6);
            border-radius: 2px;
        }

        .view-all-btn {
            appearance: none;
            background: white;
            border: 1px solid #e5e7eb;
            padding: 10px 40px 10px 16px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            color: #1a365d;
            cursor: pointer;
            transition: all 0.2s ease;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%232B5592'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            background-size: 16px;
        }

        .view-all-btn:hover {
            border-color: #2B5592;
            background-color: #f8fafc;
            box-shadow: 0 2px 4px rgba(43, 85, 146, 0.1);
        }

        .pagination {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            padding: 24px;
            margin: 0;
            box-sizing: border-box;
        }


        .pagination-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            background: white;
            color: #1a365d;
            font-weight: 500;
            transition: all 0.2s;
        }

        .pagination-btn:hover:not(:disabled) {
            background: #f8fafc;
            border-color: #2B5592;
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
            background: #2B5592;
            color: white;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            font-weight: 500;
        }


        /* Update the existing hero-h1 style */
        .hero-h1 {
            color: #2B5592;
            font-size: 20px;
            font-weight: 600;
            margin: 0;
            /* Remove top margin since it's handled by the container */
            line-height: 1.2;
        }

        @media (max-width: 768px) {
            .job-grid {
                grid-template-columns: 1fr;
                padding: 16px;
            }

            .job-card {
                padding: 24px;
            }

            .company-logo {
                width: 56px;
                height: 56px;
            }

            .job-title {
                font-size: 18px;
            }
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .recommended-header {
                flex-direction: column;
                gap: 16px;
                padding: 24px 20px;
                align-items: flex-start;
            }

            .recommended-header h1 {
                font-size: 24px;
            }

            .view-all-btn {
                width: 100%;
            }
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .job-card {
                padding: 20px;
            }

            .company-logo {
                width: 48px;
                height: 48px;
            }

            .job-title {
                font-size: 16px;
            }

            .meta-item {
                font-size: 13px;
                padding: 3px 10px;
            }
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .job-grid {
                grid-template-columns: 1fr;
                padding: 16px;
            }

            .job-card {
                padding: 20px;
            }
        }

        @media (max-width: 768px) {
            .job-status {
                padding: 6px 12px;
                font-size: 12px;
            }

            .job-status::before {
                width: 6px;
                height: 6px;
                margin-right: 6px;
            }
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 1.8rem;
            }

            .search-container {
                flex-direction: column;
                gap: 12px;
                padding: 12px;
            }

            .search-button {
                width: 100%;
            }
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
    <?php if (!empty($_SESSION['toastr'])): ?>
        <script>
            $(document).ready(function() {
                toastr.<?= $_SESSION['toastr']['type']; ?>("<?= $_SESSION['toastr']['message']; ?>");
            });
        </script>
    <?php unset($_SESSION['toastr']); endif; ?>   
    <div class="container">
        <div class="hero-section">
            <div class="hero-title-wrapper">
                <h1 class="hero-title">FIND YOUR DREAM JOB HERE</h1>
            </div>
            <div class="search-container">
                <input type="text"  id="searchInput" oninput="searchJobs()" class="search-input" placeholder="Search for job title or keyword...">
                <button class="search-button">
                    Search
                </button>
            </div>
        </div>

        <div class="recommended-header">
            <h1>Recommended Jobs</h1>
            <select class="view-all-btn" id="filterSelect" onchange="filterJobs()">
                <option value="all">All Job Types</option>
                <option value="full-time">Full-Time</option>
                <option value="part-time">Part-Time</option>
                <option value="remote">Remote</option>
                <!-- <option>Contract</option>
                <option>Internship</option> -->
            </select>
        </div>

        <!-- Add pagination after the job grid -->
        <div class="pagination">
            <button id="prevPage" class="pagination-btn" disabled>
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M15 18l-6-6 6-6" />
                </svg>
                Previous
            </button>
            <div id="pageNumbers" class="page-numbers">
                <span class="current-page">1</span>
            </div>
            <button id="nextPage" class="pagination-btn">
                Next
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M9 18l6-6-6-6" />
                </svg>
            </button>
        </div>
        <div class="job-grid">
            <?php if (!empty($jobs)): ?>
                <?php foreach ($jobs as $job): ?>
                    <?php
                        $shouldHide = false;
                        foreach ($applications as $app) {
                            if ($app['job_id'] == $job['job_id'] && in_array($app['status'], ['Applied', 'Hired', 'Rejected', 'Scheduled'])) {
                                $shouldHide = true;
                                break;
                            }
                        }
                    ?>
                    <?php if (!$shouldHide): ?>
                        <div class="job-card" data-job-id="<?= $job['job_id']; ?>">
                            <div class="job-header">
                                <img src="<?= htmlspecialchars($job['company_logo'] ?? '/path/to/default-logo.jpg'); ?>"
                                    alt="<?= htmlspecialchars($job['company_name']); ?>"
                                    class="company-logo">
                                <div>
                                    <h2 class="job-title"><?= htmlspecialchars($job['title']); ?></h2>
                                    <p class="company-name"><?= htmlspecialchars($job['company_name']); ?></p>
                                    <p class="company-name" data-posted-at="<?= htmlspecialchars($job['posted_at']); ?>"></p>
                                </div>
                            </div>

                            <span class="job-status <?= $job['status'] === 'active' ? 'status-active' : 'status-inactive' ?>">
                                <?= htmlspecialchars($job['status']); ?>
                            </span>

                            <div class="job-meta">
                                <span class="meta-item">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M12 22s-8-4.5-8-11.8A8 8 0 0 1 12 2a8 8 0 0 1 8 8.2c0 7.3-8 11.8-8 11.8z" />
                                        <circle cx="12" cy="10" r="3" />
                                    </svg>
                                    <?= htmlspecialchars($job['location']); ?>
                                </span>
                                <span class="meta-item job-type">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <rect x="2" y="7" width="20" height="14" rx="2" ry="2" />
                                        <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16" />
                                    </svg>
                                    <?= htmlspecialchars($job['job_type']); ?>
                                </span>
                            </div>

                            <button class="view-details-btn" onclick="openJobModal(<?= htmlspecialchars(json_encode($job)); ?>)">
                                <span>View Details</span>
                            </button>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-gray-600 text-center col-span-full">No jobs found.</p>
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
                                <path d="M12 22s-8-4.5-8-11.8A8 8 0 0 1 12 2a8 8 0 0 1 8 8.2c0 7.3-8 11.8-8 11.8z" />
                                <circle cx="12" cy="10" r="3" />
                            </svg>
                            <span></span>
                        </span>
                        <span class="modal-meta-item" id="modalJobType">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="2" y="7" width="20" height="14" rx="2" ry="2" />
                                <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16" />
                            </svg>
                            <span></span>
                        </span>
                        <span class="views-count">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                <circle cx="12" cy="12" r="3" />
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

                        <button class="btn btn-secondary" data-job-id="<?= htmlspecialchars($job['job_id']); ?>" onclick="saveJob(this)" style="width: 100%;">
                            Save
                        </button>
                    </div>

                    <div class="modal-section">
                        <h3>Share this job</h3>
                        <div class="modal-social">
                            <button class="social-btn" onclick="shareJob('twitter')">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z" />
                                </svg>
                            </button>
                            <button class="social-btn" onclick="shareJob('facebook')">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z" />
                                </svg>
                            </button>
                            <button class="social-btn" onclick="shareJob('linkedin')">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z" />
                                    <rect x="2" y="9" width="4" height="12" />
                                    <circle cx="4" cy="4" r="2" />
                                </svg>
                            </button>
                            <button class="social-btn" onclick="shareJob('email')">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                                    <polyline points="22,6 12,13 2,6" />
                                </svg>
                            </button>
                            <button class="social-btn" onclick="copyJobLink()">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="9" y="9" width="13" height="13" rx="2" ry="2" />
                                    <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="applyModal" class="modal">
        <div class="modal-content" style="max-width: 500px;">
            <div class="modal-header">
                <h2 style="margin: 0;">Apply to this job</h2>
                <button class="close" onclick="closeApplyModal()">&times;</button>
            </div>
            <div class="modal-body" style="display: block; padding: 20px;">
                <form id="jobApplicationForm" method="post" action="/user/jobApplication" enctype="multipart/form-data">
                    <input type="hidden" id="jobId" name="job_id" value="">
                    <div style="margin-bottom: 15px;">
                        <label for="firstName" style="display: block; margin-bottom: 5px;">First Name</label>
                        <input type="text" id="firstName" name="first_name" required style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                    </div>
                    <div style="margin-bottom: 15px;">
                        <label for="lastName" style="display: block; margin-bottom: 5px;">Last Name</label>
                        <input type="text" id="lastName" name="last_name" required style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                    </div>
                    <div style="margin-bottom: 15px;">
                        <label for="email" style="display: block; margin-bottom: 5px;">Email</label>
                        <input type="email" id="email" name="email" required style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                    </div>
                    <div style="margin-bottom: 15px;">
                        <label for="resume" style="display: block; margin-bottom: 5px;">Resume</label>
                        <input type="file" id="resume" name="resume" required accept=".pdf,.doc,.docx" style="width: 100%;">
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-top: 20px;">
                        <button type="submit" style="padding: 10px 20px; background-color: #2563eb; color: white; border: none; border-radius: 4px; cursor: pointer; margin-left: 265px;">Submit Application</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
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
            document.getElementById("modalCompanyLogo").src = job.company_logo || '../../../../../public/images/default_profile.jpg';
            document.getElementById("modalCompanyContact").textContent = job.contact_info;
            document.getElementById("modalPostedDate").textContent = job.posted_at;
            document.getElementById("modalLocation").querySelector("span").textContent = job.location;
            document.getElementById("modalJobType").querySelector("span").textContent = job.job_type;
            document.getElementById("modalDescription").textContent = job.description;
            document.getElementById("modalRequirements").textContent = job.requirements;

            // document.getElementById("modalApplyButton").href = `/job/apply/${job.job_id}`;
            // Update the Apply button to open the new modal
            document.getElementById("modalApplyButton").onclick = function(e) {
                e.preventDefault();
                openApplyModal(job.job_id);
            };

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

        const ITEMS_PER_PAGE = 6; // Adjust the number of items per page
        let currentPage = 1;

        const jobGrid = document.querySelector('.job-grid');
        const prevButton = document.getElementById('prevPage');
        const nextButton = document.getElementById('nextPage');
        const pageNumbers = document.getElementById('pageNumbers');

        let jobs = JSON.parse('<?= json_encode($jobs); ?>') || [];
        let applications = JSON.parse('<?= json_encode($applications); ?>') || [];

        function filterJobsByStatus(jobs, applications) {
            return jobs.filter((job) => {
                const isExcluded = applications.some((app) => {
                    return (
                        app.job_id === job.job_id &&
                        ['Applied', 'Hired', 'Scheduled', 'Rejected'].includes(app.status)
                    );
                });
                return !isExcluded; // Include only jobs not in the restricted list
            });
        }

        let filteredJobs = filterJobsByStatus(jobs, applications);

        function createJobCard(job) {
            const jobCard = document.createElement('div');
            jobCard.className = 'job-card';

            jobCard.innerHTML = `
                <div class="job-header">
                    <img src="${job.company_logo || '/path/to/default-logo.jpg'}" alt="${job.company_name}" class="company-logo">
                    <div>
                        <h2 class="job-title">${job.title}</h2>
                        <p class="company-name">${job.company_name}</p>
                        <p class="company-name" data-posted-at="<?= htmlspecialchars($job['posted_at']); ?>"></p>
                    </div>
                </div>
                <span class="job-status ${job.status === 'active' ? 'status-active' : 'status-inactive'}">
                    ${job.status}
                </span>
                <div class="job-meta">
                    <span class="meta-item">${job.location}</span>
                    <span class="meta-item job-type">${job.job_type}</span>
                </div>
                <button class="view-details-btn" onclick="openJobModal(<?= htmlspecialchars(json_encode($job)); ?>)">View Details</button>
            `;
            return jobCard;
        }

        function updateJobGrid() {
            const startIndex = (currentPage - 1) * ITEMS_PER_PAGE;
            const endIndex = startIndex + ITEMS_PER_PAGE;
            const visibleJobs = filteredJobs.slice(startIndex, endIndex);

            jobGrid.innerHTML = '';

            visibleJobs.forEach((job) => {
                const jobCard = createJobCard(job);
                jobGrid.appendChild(jobCard);
            });

            prevButton.disabled = currentPage === 1;
            nextButton.disabled = endIndex >= filteredJobs.length;

            pageNumbers.innerHTML = `<span class="current-page">${currentPage}</span>`;
        }

        prevButton.addEventListener('click', () => {
            if (currentPage > 1) {
                currentPage--;
                updateJobGrid();
                jobGrid.scrollIntoView({ behavior: 'smooth' });
            }
        });

        nextButton.addEventListener('click', () => {
            if (currentPage * ITEMS_PER_PAGE < filteredJobs.length) {
                currentPage++;
                updateJobGrid();
                jobGrid.scrollIntoView({ behavior: 'smooth' });
            }
        });

        document.addEventListener('DOMContentLoaded', updateJobGrid);

        function openApplyModal(jobId) {
            document.getElementById('jobId').value = jobId;
            document.getElementById('applyModal').style.display = 'block';
        }

        function closeApplyModal() {
            document.getElementById('applyModal').style.display = 'none';
        }

        function searchJobs() {
            const searchInput = document.getElementById("searchInput").value.toLowerCase();
            const jobCards = document.querySelectorAll(".job-card"); 
            jobCards.forEach((card) => {
                const title = card.querySelector("h2").textContent.toLowerCase(); 
                const description = card.querySelector("p").textContent.toLowerCase(); 
                card.style.display =
                    title.includes(searchInput) || description.includes(searchInput) ? "block" : "none";
            });
        }

        function filterJobs() {
            const filterValue = document.getElementById("filterSelect").value.toLowerCase();
            const jobCards = document.querySelectorAll(".job-card"); 
            jobCards.forEach((card) => {
                const type = card.querySelector(".job-type").textContent.toLowerCase();
                card.style.display =
                    filterValue === "all" || type.includes(filterValue) ? "block" : "none";
            });
        }

        function calculateTimeSince(postedAt) {
            const now = new Date();
            const postedDate = new Date(postedAt.replace(" ", "T")); // Convert to ISO format

            if (isNaN(postedDate)) {
                console.error(`Invalid date format: ${postedAt}`);
                return "Invalid date";
            }

            const seconds = Math.floor((now - postedDate) / 1000);

            if (seconds < 60) return `${seconds} second${seconds !== 1 ? "s" : ""} ago`;
            const minutes = Math.floor(seconds / 60);
            if (minutes < 60) return `${minutes} minute${minutes !== 1 ? "s" : ""} ago`;
            const hours = Math.floor(minutes / 60);
            if (hours < 24) return `${hours} hour${hours !== 1 ? "s" : ""} ago`;
            const days = Math.floor(hours / 24);
            if (days < 7) return `${days} day${days !== 1 ? "s" : ""} ago`;
            const weeks = Math.floor(days / 7);
            if (weeks < 4) return `${weeks} week${weeks !== 1 ? "s" : ""} ago`;
            const months = Math.floor(weeks / 4.33);
            if (months < 12) return `${months} month${months !== 1 ? "s" : ""} ago`;
            const years = Math.floor(months / 12);
            return `${years} year${years !== 1 ? "s" : ""} ago`;
        }

        function updatePostedTimes() {
            // Select all elements with the `data-posted-at` attribute
            const elements = document.querySelectorAll("[data-posted-at]");
            elements.forEach((element) => {
                const postedAt = element.getAttribute("data-posted-at");

                if (!postedAt) {
                    console.error("Missing `data-posted-at` attribute on element:", element);
                    return;
                }

                const timeSince = calculateTimeSince(postedAt);
                element.textContent = timeSince;
            });
        }

        // Run the function once the DOM is fully loaded
        document.addEventListener("DOMContentLoaded", updatePostedTimes);

        function saveJob(button) {
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
                        if (icon.classList.contains('bx-heart')) {
                            icon.classList.remove('bx-heart', 'text-gray-500');
                            icon.classList.add('bxs-heart', 'text-red-500');
                        } else {
                            icon.classList.remove('bxs-heart', 'text-red-500');
                            icon.classList.add('bx-heart', 'text-gray-500');
                        }
                    } else {
                        alert(data.message || "Failed to save the job.");
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    </script>
</body>

</html>