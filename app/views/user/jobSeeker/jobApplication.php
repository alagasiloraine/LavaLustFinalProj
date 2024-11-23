<?php
include APP_DIR.'views/templates/header.php';
?>
<body class="bg-gray-100 text-gray-800">

    <?php
        include APP_DIR.'views/templates/nav.php';
    ?> 
    <div class="container mx-auto mt-9">
        <h1 class="text-3xl font-bold mb-6">Your Job Applications</h1>

        <script>
            $(document).ready(function() {
                <?php if (isset($_SESSION['toastr'])): ?>
                    <?php $toastr = $_SESSION['toastr']; ?>
                    toastr.<?php echo $toastr['type']; ?>("<?php echo $toastr['message']; ?>", "<?php echo ucfirst($toastr['type']); ?>");
                    <?php unset($_SESSION['toastr']); ?>
                <?php endif; ?>
            });

            // Function to confirm cancelation with SweetAlert
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
                        // If confirmed, redirect to cancel action
                        window.location.href = '<?= site_url('user/jobseeker/cancel-application/'); ?>' + applicationId;
                    }
                });
            }
        </script>

        <?php if (!empty($applications)): ?>
            <div class="space-y-6">
                <?php foreach ($applications as $index => $application): ?>
                    <div class="bg-white rounded-lg shadow p-6">
                        <!-- Job Application Details -->
                        <h2 class="text-2xl font-semibold mb-2"><?= htmlspecialchars($application['job_title']); ?></h2>
                        <p class="text-gray-600 mb-4"><?= htmlspecialchars($application['job_description']); ?></p>
                        <p class="mb-2"><strong>Location:</strong> <?= htmlspecialchars($application['location']); ?></p>
                        <p class="mb-2"><strong>Salary:</strong> <?= htmlspecialchars($application['salary']); ?></p>
                        <p class="mb-2"><strong>Job Status:</strong> <?= htmlspecialchars($application['job_status']); ?></p>

                        <!-- Employer Details -->
                        <div class="mt-4">
                            <h3 class="text-lg font-bold">Employer Details</h3>
                            <p class="mb-2"><strong>Company:</strong> <?= htmlspecialchars($application['company_name']); ?></p>
                            <p class="mb-2"><strong>Contact Info:</strong> <?= htmlspecialchars($application['contact_info']); ?></p>
                        </div>

                        <!-- Application Status -->
                        <div class="mt-4">
                            <p class="text-sm font-semibold text-gray-500"><strong>Application Status:</strong> <?= htmlspecialchars($application['application_status']); ?></p>
                            <p class="text-sm text-gray-500">Applied on: <?= date('F j, Y', strtotime($application['application_date'])); ?></p>
                        </div>

                        <!-- Action Buttons -->
                        <div class="mt-6 flex space-x-4">
                           <!-- Edit Button: Only show if the application status is not "Cancelled" -->
                            <?php if ($application['application_status'] !== 'Cancelled'): ?>
                                <button 
                                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
                                    onclick="document.getElementById('editModal<?= $index; ?>').classList.remove('hidden')">
                                    Edit Application
                                </button>
                                <button 
                                    class="bg-red-300 text-red-700 px-4 py-2 rounded hover:bg-red-400"
                                    onclick="confirmCancel(<?= $application['application_id']; ?>)">
                                    Cancel
                                </button>
                            <?php endif; ?>

                        </div>
                    </div>

                    <!-- Modal -->
                    <div id="editModal<?= $index; ?>" class="hidden fixed inset-0 flex items-center justify-center z-50 bg-gray-600 bg-opacity-50">
                        <div class="bg-white rounded-lg p-6 w-1/3">
                            <h3 class="text-xl font-semibold mb-4">Edit Application</h3>

                            <form action="<?=site_url('user/jobseeker/update-application/' . $application['application_id'])?>" method="POST" enctype="multipart/form-data">
                                <!-- First Name -->
                                <div class="mb-4">
                                    <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                                    <input 
                                        type="text" 
                                        name="first_name" 
                                        value="<?= htmlspecialchars($application['first_name']); ?>" 
                                        class="block w-full mt-2 border-gray-300 rounded-md" 
                                        required>
                                </div>

                                <!-- Last Name -->
                                <div class="mb-4">
                                    <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                                    <input 
                                        type="text" 
                                        name="last_name" 
                                        value="<?= htmlspecialchars($application['last_name']); ?>" 
                                        class="block w-full mt-2 border-gray-300 rounded-md" 
                                        required>
                                </div>

                                <!-- Email -->
                                <div class="mb-4">
                                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                    <input 
                                        type="email" 
                                        name="email" 
                                        value="<?= htmlspecialchars($application['email']); ?>" 
                                        class="block w-full mt-2 border-gray-300 rounded-md" 
                                        required>
                                </div>

                                <!-- Resume -->
                                <div class="mb-4">
                                    <label for="resume" class="block text-sm font-medium text-gray-700">Resume</label>
                                    <input type="file" name="resume" class="block w-full mt-2 border-gray-300 rounded-md">
                                    <p class="text-sm text-gray-500 mt-2">Current Resume: <?= htmlspecialchars($application['resume']); ?></p>
                                </div>

                                <!-- Submit Button -->
                                <div class="flex justify-end">
                                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Save Changes</button>
                                </div>
                            </form>

                            <!-- Cancel Button inside Modal -->
                            <button 
                                class="mt-4 text-red-500" 
                                onclick="document.getElementById('editModal<?= $index; ?>').classList.add('hidden')">
                                Cancel
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="text-gray-600">You haven't applied to any jobs yet.</p>
        <?php endif; ?>
    </div>

    <!-- Include SweetAlert2 JS -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->

</body>
</html>
