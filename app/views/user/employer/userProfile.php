<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php
      include APP_DIR.'views/templates/nav.php';
      ?> 

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
                        <img src="../../../public/images/profile1.jpg" alt="Profile Picture" class="rounded-circle mb-3 bg-gray" width="150" height="150">
                    </div>
                    <p><strong>Email:</strong> <?= $user['email']; ?></p>
                    <p><strong>Role:</strong> <?= $user['role']; ?></p>

                    <!-- Job Seeker Details -->
                    <hr>
                                       
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
                    <div class="mb-3">
                        <label for="location" class="form-label">Company Name</label>
                        <input type="text" class="form-control" id="company_name" name="company_name" value="<?= isset($job_seeker['company_name']) ? $job_seeker['company_name'] : ''; ?>" placeholder="Enter your Company name">
                    </div>
                    </div>
                    <!-- Location -->
                    <div class="mb-3">
                        <label for="location" class="form-label">Company address</label>
                        <input type="text" class="form-control" id="company_address" name="company_address" value="<?= isset($job_seeker['company_address']) ? $job_seeker['company_address'] : ''; ?>" placeholder="Enter your company location">
                    </div>
                  
                    <!-- Skills -->
                    <div class="mb-3">
                        <label for="skills" class="form-label">Contact Info</label>
                        <input type="number" class="form-control" id="contact_info" name="contact_info" value="<?= isset($job_seeker['contact_info']) ? $job_seeker['contact_info'] : ''; ?>" >
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
