<?php
include APP_DIR.'views/templates/header.php';
?>
<body>
    <?php
        include APP_DIR.'views/templates/nav.php';
    ?>  
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6 text-center"><?= htmlspecialchars($job['title']) ?> - Applications</h1>

        <?php if (!empty($_SESSION['toastr'])): ?>
        <script>
            $(document).ready(function() {
                toastr.<?= $_SESSION['toastr']['type']; ?>("<?= $_SESSION['toastr']['message']; ?>");
            });
        </script>
        <?php unset($_SESSION['toastr']); endif; ?>

        <!-- Check if there are applications to display -->
        <?php if (!empty($applications)): ?>
            <div class="overflow-x-auto">
                <table id="applicationsTable" class="min-w-full bg-white border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="py-2 px-4 text-left">Applicant Name</th>
                            <th class="py-2 px-4 text-left">Email</th>
                            <th class="py-2 px-4 text-left">Location</th>
                            <th class="py-2 px-4 text-left">Education</th>
                            <th class="py-2 px-4 text-left">Skills</th>
                            <th class="py-2 px-4 text-left">Resume</th>
                            <th class="py-2 px-4 text-left">View Profile</th>
                            <th class="py-2 px-4 text-left">Application Status</th>
                            <th class="py-2 px-4 text-left">Applied At</th>
                            <th class="py-2 px-4 text-left">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($applications as $application): ?>
                            <!-- Check if application status is not 'Cancelled' -->
                            <?php if ($application['application_status'] !== 'Cancelled'): ?>
                                <tr class="border-b">
                                    <td class="py-2 px-4"><?= htmlspecialchars($application['full_name']) ?></td>
                                    <td class="py-2 px-4"><?= htmlspecialchars($application['email']) ?></td>
                                    <td class="py-2 px-4"><?= htmlspecialchars($application['location']) ?></td>
                                    <td class="py-2 px-4"><?= htmlspecialchars($application['education']) ?></td>
                                    <td class="py-2 px-4"><?= htmlspecialchars($application['skills']) ?></td>
                                    <td class="py-2 px-4">
                                        <a href="<?= site_url('uploads/resumes/'.$application['resume']) ?>" class="text-blue-500 hover:underline" target="_blank">View Resume</a>
                                    </td>
                                    <td class="py-2 px-4">
                                        <a href="<?= site_url('user/jobseeker/profile/'.$application['id']) ?>" class="text-blue-500 hover:underline" target="_blank">View Profile</a>
                                    </td>
                                    <td class="py-2 px-4">
                                        <span class="px-3 py-1 text-sm font-semibold rounded-full 
                                            <?= $application['application_status'] === 'approved' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' ?>">
                                            <?= htmlspecialchars($application['application_status']) ?>
                                        </span>
                                    </td>
                                    <td class="py-2 px-4"><?= htmlspecialchars(date('F j, Y', strtotime($application['applied_at']))) ?></td>
                                    <td class="py-2 px-4">
                                        <div class="flex space-x-4">
                                            <!-- Action buttons -->
                                            <form id="hireForm_<?= $application['application_id'] ?>" action="<?= site_url('user/employer/updateApplicationStatus/'.$application['application_id']) ?>" method="POST" class="inline">
                                                <input type="hidden" id="status" name="status" value="Hired">
                                                <input type="hidden" id="job_id" name="job_id" value="<?= htmlspecialchars($application['job_id']) ?>">
                                                <button type="button" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 hire-button" data-id="<?= $application['application_id'] ?>">Hired</button>
                                            </form>
                                            <form id="rejectForm_<?= $application['application_id'] ?>" action="<?= site_url('user/employer/updateApplicationStatus/'.$application['application_id']) ?>" method="POST" class="inline">
                                                <input type="hidden" id="status" name="status" value="Rejected">
                                                <input type="hidden" id="job_id" name="job_id" value="<?= htmlspecialchars($application['job_id']) ?>">
                                                <button type="button" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 reject-button" data-id="<?= $application['application_id'] ?>">Rejected</button>
                                            </form>
                                            <!-- Button to trigger modal -->
                                            <button class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600" onclick="openModal(<?= $application['application_id'] ?>)">Schedule Interview</button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>

                             <!-- Modal for Scheduling Interview -->
                            <div id="interviewModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center hidden">
                                <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
                                    <h2 class="text-2xl font-bold mb-4">Schedule Interview</h2>
                                    <form id="scheduleInterviewForm">
                                        <input type="hidden" id="job_id" name="job_id" value="<?= htmlspecialchars($application['job_id']) ?>">
                                        <input type="hidden" id="application_id" name="application_id" value="">

                                        <div class="mb-4">
                                            <label for="interviewDate" class="block text-sm font-semibold text-gray-700">Interview Date</label>
                                            <input type="date" id="interviewDate" name="interview_date" class="w-full px-4 py-2 border border-gray-300 rounded-lg" required>
                                        </div>
                                        <div class="mb-4">
                                            <label for="interviewTime" class="block text-sm font-semibold text-gray-700">Interview Time</label>
                                            <input type="time" id="interviewTime" name="interview_time" class="w-full px-4 py-2 border border-gray-300 rounded-lg" required>
                                        </div>
                                        <div class="flex justify-end space-x-4">
                                            <button type="button" onclick="closeModal()" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">Cancel</button>
                                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="text-center text-gray-600">No applications for this job yet.</p>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Confirm action using SweetAlert
        function openModal(applicationId) {
            document.getElementById('interviewModal').classList.remove('hidden');
            $('#application_id').val(applicationId); // Set the application ID in the hidden input
        }

        // Close the modal
        function closeModal() {
            document.getElementById('interviewModal').classList.add('hidden');
            $('#scheduleInterviewForm')[0].reset(); // Reset the form fields
        }

        // Handle AJAX form submission for scheduling an interview
        $(document).on('submit', '#scheduleInterviewForm', function(event) {
            event.preventDefault(); // Prevent the default form submission

            const formData = $(this).serialize(); // Serialize the form data

            // Show confirmation dialog before proceeding
            Swal.fire({
                title: 'Confirm Schedule',
                text: 'Are you sure you want to schedule this interview?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, schedule it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Proceed with AJAX submission if confirmed
                    $.ajax({
                        url: '<?= site_url("user/employer/scheduleInterview/". $application["application_id"]) ?>', // Update this URL if necessary
                        type: 'POST',
                        data: formData,
                        success: function(response) {
                            Swal.fire({
                                title: 'Success!',
                                text: 'Interview scheduled successfully.',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                closeModal(); // Close the modal
                                window.location.reload(); // Refresh the page
                            });
                        },
                        error: function(xhr) {
                            Swal.fire({
                                title: 'Error!',
                                text: 'There was an issue scheduling the interview.',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    });
                }
            });
        });

        $(document).on('click', '.hire-button, .reject-button', function() {
            var status = $(this).hasClass('hire-button') ? 'Hired' : 'Rejected'; // Determine the status
            var formId = $(this).hasClass('hire-button') ? '#hireForm_' : '#rejectForm_'; // Get form ID
            var form = $(formId + $(this).data('id')); // Target the specific form

            // Show confirmation dialog before proceeding
            Swal.fire({
                title: `Confirm ${status}`,
                text: `Are you sure you want to mark this applicant as ${status}?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: `Yes, ${status.toLowerCase()}!`
            }).then((result) => {
                if (result.isConfirmed) {
                    // Proceed with AJAX submission if confirmed
                    $.ajax({
                        url: form.attr('action'),
                        type: 'POST',
                        data: form.serialize(),
                        success: function(response) {
                            Swal.fire({
                                title: 'Success!',
                                text: `Applicant has been marked as ${status}.`,
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                window.location.reload(); // Reload the page
                            });
                        },
                        error: function() {
                            Swal.fire({
                                title: 'Error!',
                                text: `An error occurred while updating the status to ${status}.`,
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    });
                }
            });
        });
    </script>
</body>
