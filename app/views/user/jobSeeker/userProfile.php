<?php
include APP_DIR.'views/templates/header.php';
?>
<body>

<?php
include APP_DIR.'views/templates/nav.php';
?> 

        <?php if (isset($_SESSION['success'])): ?>
            <script>
                toastr.success("<?php echo $_SESSION['success']; ?>", "Success");
            </script>
            <?php unset($_SESSION['success']); ?>
        <?php elseif (isset($_SESSION['error'])): ?>
            <script>
                toastr.error("<?php echo $_SESSION['error']; ?>", "Error");
            </script>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white text-center">
                    <h2>Welcome, <?= $user['username']; ?>!</h2>
                    <a href="<?= site_url('home'); ?>" class="text-white">Go back</a>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <!-- Display profile picture -->
                        <img src="<?= isset($job_seeker['profile_picture']) && !empty($job_seeker['profile_picture']) ? '../../../../uploads/profile_pictures/' . $job_seeker['profile_picture'] : '../../../public/images/default_profile.jpg'; ?>" 
                             alt="Profile Picture" 
                             class="rounded-circle mb-3 bg-gray" 
                             width="150" 
                             height="150">
                    </div>
                    <p><strong>Email:</strong> <?= $user['email']; ?></p>
                    <p><strong>Role:</strong> <?= $user['role']; ?></p>

                    <!-- Job Seeker Details -->
                    <hr>
                    <h5>Job Seeker Details</h5>
                    <p><strong>Full Name:</strong> <?= isset($job_seeker['full_name']) ? $job_seeker['full_name'] : 'Not Provided'; ?></p>
                    <p><strong>Location:</strong> <?= isset($job_seeker['location']) ? $job_seeker['location'] : 'Not Provided'; ?></p>
                    <p><strong>Bio:</strong> <?= isset($job_seeker['bio']) ? $job_seeker['bio'] : 'Not Provided'; ?></p>
                    <p><strong>Skills:</strong> <?= isset($job_seeker['skills']) ? $job_seeker['skills'] : 'Not Provided'; ?></p>
                    <p><strong>Education:</strong> <?= isset($job_seeker['education']) ? $job_seeker['education'] : 'Not Provided'; ?></p>
                    <p><strong>Experience:</strong> <?= isset($job_seeker['experience']) ? $job_seeker['experience'] : 'Not Provided'; ?></p>
                    <p><strong>Availability:</strong> <?= isset($job_seeker['availability']) ? $job_seeker['availability'] : 'Not Provided'; ?></p>
                    <p><strong>Resume:</strong> <?= isset($job_seeker['resume']) ? $job_seeker['resume'] : 'Not Provided'; ?></p>
                    
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-outline-primary mt-3" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                        Edit Profile
                    </button>
                </div>
                <div class="card-footer text-muted">
                    <p>Last updated: <?= date("F j, Y"); ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?=site_url('user/profile/edit-profile');?>" method="POST" enctype="multipart/form-data">
                    <!-- Profile Picture Upload -->
                    <div class="mb-3">
                        <label for="profile_picture" class="form-label">Profile Picture</label>
                        <?php if (isset($job_seeker['profile_picture']) && !empty($job_seeker['profile_picture'])): ?>
                            <p>Current Picture: <?= $job_seeker['profile_picture']; ?></p>
                        <?php endif; ?>
                        <input class="form-control" type="file" name="profile_picture" id="profile_picture" accept="image/*">
                    </div>
                    
                    <!-- Other Fields -->
                    <div class="mb-3">
                        <label for="full_name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="full_name" name="full_name" value="<?= isset($job_seeker['full_name']) ? $job_seeker['full_name'] : ''; ?>" placeholder="Enter your full name">
                    </div>
                    <div class="mb-3">
                        <label for="location" class="form-label">Location</label>
                        <input type="text" class="form-control" id="location" name="location" value="<?= isset($job_seeker['location']) ? $job_seeker['location'] : ''; ?>" placeholder="Enter your location">
                    </div>
                    <div class="mb-3">
                        <label for="bio" class="form-label">Bio</label>
                        <textarea class="form-control" id="bio" name="bio" rows="3" placeholder="Write a brief bio"><?= isset($job_seeker['bio']) ? $job_seeker['bio'] : ''; ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="skills" class="form-label">Skills</label>
                        <input type="text" class="form-control" id="skills" name="skills" value="<?= isset($job_seeker['skills']) ? $job_seeker['skills'] : ''; ?>" placeholder="List your skills (comma separated)">
                    </div>
                    <div class="mb-3">
                        <label for="education" class="form-label">Education</label>
                        <input type="text" class="form-control" id="education" name="education" value="<?= isset($job_seeker['education']) ? $job_seeker['education'] : ''; ?>" placeholder="Enter your education">
                    </div>
                    <div class="mb-3">
                        <label for="experience" class="form-label">Experience</label>
                        <textarea class="form-control" id="experience" name="experience" rows="3" placeholder="Describe your work experience"><?= isset($job_seeker['experience']) ? $job_seeker['experience'] : ''; ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="resume" class="form-label">Resume</label>
                        <?php if (isset($job_seeker['resume']) && !empty($job_seeker['resume'])): ?>
                            <p>Current Resume: <a href="<?= site_url('uploads/' . $job_seeker['resume']); ?>" target="_blank"><?= $job_seeker['resume']; ?></a></p>
                        <?php endif; ?>
                        <input class="form-control" type="file" name="resume" id="resume" accept=".pdf,.doc,.docx">
                    </div>

                    <div class="mb-3">
                        <label for="availability" class="form-label">Availability</label>
                        <select class="form-select" id="availability" name="availability">
                            <option value="available" <?= (isset($job_seeker['availability']) && $job_seeker['availability'] == 'available') ? 'selected' : ''; ?>>Available</option>
                            <option value="not_available" <?= (isset($job_seeker['availability']) && $job_seeker['availability'] == 'not_available') ? 'selected' : ''; ?>>Not Available</option>
                            <option value="open_to_offers" <?= (isset($job_seeker['availability']) && $job_seeker['availability'] == 'open_to_offers') ? 'selected' : ''; ?>>Open to Offers</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
