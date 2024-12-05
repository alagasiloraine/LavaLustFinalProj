<?php
include APP_DIR . 'views/templates/header.php';
?>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f8f9fa;
        color: #333;
        line-height: 1.6;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem;
    }

    .page-title {
        font-size: 24px;
        font-weight: 600;
        color: #2d3748;
        margin: 0;
        margin-bottom: 6px;
        line-height: 1.2;
    }

    .subtitle {
        font-size: 1rem;
        color: #6c757d;
        margin-bottom: 2rem;
    }

    .application-card {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        margin-bottom: 1.5rem;
        transition: box-shadow 0.3s ease;
    }

    .application-card:hover {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }

    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem;
        border-bottom: 1px solid #e9ecef;
    }

    .status-badge {
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.875rem;
        font-weight: 500;
    }

    .status-hired {
        background-color: #d4edda;
        color: #155724;
    }

    .status-scheduled {
        background-color: #cce5ff;
        color: #004085;
    }

    .status-cancelled {
        background-color: #f8d7da;
        color: #721c24;
    }

    .status-pending {
        background-color: #fff3cd;
        color: #856404;
    }

    .application-date {
        font-size: 0.875rem;
        color: #6c757d;
    }

    .card-body {
        padding: 1rem;
    }

    .job-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 0.5rem;
    }

    .company-name {
        font-size: 1rem;
        color: #6c757d;
        margin-bottom: 1rem;
    }

    .job-details {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
        margin-bottom: 1rem;
    }

    .detail-item {
        display: flex;
        align-items: center;
    }

    .detail-icon {
        margin-right: 0.5rem;
        color: #6c757d;
    }

    .card-actions {
        display: flex;
        justify-content: flex-end;
        padding-top: 1rem;
        border-top: 1px solid #e9ecef;
    }

    .btn {
        padding: 0.5rem 1rem;
        border-radius: 4px;
        font-weight: 500;
        text-align: center;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-primary {
        background-color: #007bff;
        color: #fff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .btn-danger {
        background-color: #dc3545;
        color: #fff;
    }

    .btn-danger:hover {
        background-color: #bd2130;
    }

    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
    }

    .modal-content {
        background-color: #fff;
        margin: 15% auto;
        padding: 2rem;
        border-radius: 8px;
        max-width: 500px;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
    }

    .close:hover {
        color: #000;
    }

    .empty-state {
        text-align: center;
        padding: 3rem 0;
    }

    .empty-icon {
        font-size: 3rem;
        color: #6c757d;
        margin-bottom: 1rem;
    }

    .empty-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 0.5rem;
    }

    .empty-description {
        color: #6c757d;
    }
</style>

<body>
    <?php include APP_DIR . 'views/templates/nav.php'; ?>

    <div class="container">
        <h1 class="page-title">My Applications</h1>
        <p class="subtitle">Track and manage your job applications</p>

        <script>
            // Keep existing JavaScript functions unchanged
            $(document).ready(function() {
                <?php if (isset($_SESSION['toastr'])): ?>
                    <?php $toastr = $_SESSION['toastr']; ?>
                    toastr.<?php echo $toastr['type']; ?>("<?php echo $toastr['message']; ?>", "<?php echo ucfirst($toastr['type']); ?>");
                    <?php unset($_SESSION['toastr']); ?>
                <?php endif; ?>
            });

            function confirmCancel(applicationId) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You are about to cancel this job application.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, cancel it!',
                    cancelButtonText: 'No, keep it'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '<?= site_url('user/jobseeker/cancel-application/'); ?>' + applicationId;
                    }
                });
            }
        </script>

        <?php if (!empty($applications)): ?>
            <?php foreach ($applications as $index => $application): ?>
                <div class="application-card">
                    <div class="card-header">
                        <span class="status-badge status-<?= strtolower($application['application_status']); ?>">
                            <?= htmlspecialchars($application['application_status']); ?>
                        </span>
                        <span class="application-date">
                            Applied <?= date('M j, Y', strtotime($application['application_date'])); ?>
                        </span>
                    </div>
                    <div class="card-body">
                        <h2 class="job-title"><?= htmlspecialchars($application['job_title']); ?></h2>
                        <p class="company-name"><?= htmlspecialchars($application['company_name']); ?></p>
                        <div class="job-details">
                            <div class="detail-item">
                                <span class="detail-icon">📍</span>
                                <?= htmlspecialchars($application['location']); ?>
                            </div>
                            <div class="detail-item">
                                <span class="detail-icon">💰</span>
                                <?= htmlspecialchars($application['salary']); ?>
                            </div>
                        </div>
                        <div class="card-actions">
                            <?php if ($application['application_status'] !== 'Cancelled'): ?>
                                <?php if ($application['application_status'] === 'Hired'): ?>
                                    <button class="btn btn-primary" disabled>Hired</button>
                                <?php elseif ($application['application_status'] === 'Scheduled'): ?>
                                    <button class="btn btn-primary" onclick="document.getElementById('scheduleModal<?= $index; ?>').style.display='block'">
                                        View Schedule
                                    </button>
                                <?php else: ?>
                                    <button class="btn btn-danger" onclick="confirmCancel(<?= $application['application_id']; ?>)">
                                        Cancel Application
                                    </button>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <?php if ($application['application_status'] === 'Scheduled'): ?>
                    <div id="scheduleModal<?= $index; ?>" class="modal">
                        <div class="modal-content">
                            <span class="close" onclick="document.getElementById('scheduleModal<?= $index; ?>').style.display='none'">&times;</span>
                            <h2>Interview Schedule</h2>
                            <p><strong>Date:</strong> <?= htmlspecialchars($application['interview_date']); ?></p>
                            <p><strong>Time:</strong> <?= htmlspecialchars($application['interview_time']); ?></p>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="empty-state">
                <div class="empty-icon">📋</div>
                <h2 class="empty-title">No applications yet</h2>
                <p class="empty-description">Start your journey by applying to jobs that match your skills and interests.</p>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>