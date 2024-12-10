<?php
include APP_DIR.'views/templates/header.php';
?>
<body>
    <?php
        include APP_DIR.'views/templates/nav.php';
    ?>  
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6 text-center text-blue-800"><?= htmlspecialchars($job['title']) ?> - <a href="<?= site_url('user/employer/jobPosts') ?>">Applications</a></h1>

        <?php if (!empty($_SESSION['toastr'])): ?>
        <script>
            $(document).ready(function() {
                toastr.<?= $_SESSION['toastr']['type']; ?>("<?= $_SESSION['toastr']['message']; ?>");
            });
        </script>
        <?php unset($_SESSION['toastr']); endif; ?>

        <!-- Check if there are applications to display -->
        <?php if (!empty($applications)): ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($applications as $application): ?>
                    <!-- Check if application status is not 'Cancelled' -->
                    <?php if ($application['application_status'] !== 'Cancelled'): ?>
                        <div class="bg-white p-4 border border-gray-300 rounded-lg shadow-lg">
                            <h3 class="text-xl font-semibold"><?= htmlspecialchars($application['full_name']) ?></h3>
                            <p class="text-gray-600"><?= htmlspecialchars($application['email']) ?></p>
                            <p class="text-gray-600"><?= htmlspecialchars($application['location']) ?></p>
                            <p class="text-gray-600"><?= htmlspecialchars($application['education']) ?></p>
                            <p class="text-gray-600"><?= htmlspecialchars($application['skills']) ?></p>

                            <div class="mt-4">
                           
                                <?php if (!empty($application['resume'])): ?>
                                    <a href="javascript:void(0)" 
                                    class="view-resume-btn" 
                                    onclick="downloadResume('<?= htmlspecialchars($application['resume']) ?>')">View Resume</a>
                                <?php else: ?>
                                    <span class="no-resume-available">No Resume Available</span>
                                <?php endif; ?>


                            </div> 
                            <div class="mt-2">
                                <a href="<?= site_url('user/jobseeker/profile/'.$application['id']) ?>" class="text-blue-500 hover:underline" target="_blank">View Profile</a>
                            </div>
                            <div class="mt-2">
                                <span class="px-3 py-1 text-sm font-semibold rounded-full 
                                    <?= $application['application_status'] === 'approved' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' ?>">
                                    <?= htmlspecialchars($application['application_status']) ?>
                                </span>
                            </div>
                            <div class="mt-2">
                                <p class="text-gray-600">Applied At: <?= htmlspecialchars(date('F j, Y', strtotime($application['applied_at']))) ?></p>
                            </div>

                            <div class="mt-4 flex space-x-4">
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
                                <button class="bg-blue-800 text-white px-4 py-2 rounded-lg hover:bg-blue-600" onclick="openModal(<?= $application['application_id'] ?>)">Schedule Interview</button>
                            </div>
                        </div>

                        <div id="interviewModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center hidden">
                            <div class="bg-white p-6 rounded-lg shadow-lg w-72 md:w-72">
                                <h2 class="text-2xl font-bold mb-4 text-blue-800">Schedule Interview</h2>
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
                                        <button type="submit" class="bg-blue-800 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
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
   
        function downloadResume(resumeFile) {
        // Construct the URL to the PHP function that serves the file
        var downloadUrl = "<?= site_url('user/employer/download_resume/') ?>" + resumeFile;

        // Create a new XMLHttpRequest to fetch the file
        var xhr = new XMLHttpRequest();
        xhr.open("GET", downloadUrl, true);
        xhr.responseType = 'blob';  // Expect a blob response (binary data)

        xhr.onload = function() {
            if (xhr.status === 200) {
                // Create a Blob from the response
                var blob = xhr.response;
                var link = document.createElement('a');
                
                // Create an object URL from the Blob
                var url = window.URL.createObjectURL(blob);
                
                // Set the download attribute to suggest the filename
                link.href = url;
                link.download = resumeFile;  // Use the resume filename as the downloaded file name
                
                // Append the link to the body (required for triggering the click event)
                document.body.appendChild(link);
                
                // Trigger the download by simulating a click
                link.click();
                
                // Clean up: remove the link and revoke the object URL
                document.body.removeChild(link);
                window.URL.revokeObjectURL(url);
            } else {
                alert("Failed to download the file. Please try again.");
            }
        };

        xhr.onerror = function() {
            alert("Error while downloading the file. Please try again.");
        };

        // Send the request to the server
        xhr.send();
    }

   </script>
</body>