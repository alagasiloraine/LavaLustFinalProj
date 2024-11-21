<?php
include APP_DIR.'views/templates/header.php';
?>
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
                        <img src="<?= isset($employer['profile_picture']) && !empty($employer['profile_picture']) ? '../../../../uploads/profile_pictures/' . $employer['profile_picture'] : '../../../public/images/default_profile.jpg'; ?>" 
                             alt="Profile Picture" 
                             class="rounded-circle mb-3 bg-gray" 
                             width="150" 
                             height="150">
                    </div>
                    <p><strong>Email:</strong> <?= $user['email']; ?></p>
                    <p><strong>Role:</strong> <?= $user['role']; ?></p>

                    <!-- Job Seeker Details -->
                    <hr>
                    <p><strong>Company Name:</strong> <?= $employer['company_name']; ?></p>
                    <p><strong>Company Address:</strong> <?= $employer['company_address']; ?></p>
                    <p><strong>Contact Information:</strong> <?= $employer['contact_info']; ?></p>

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
                <form action="<?=site_url('user/profile/editEmployerProfile');?>" method="POST" enctype="multipart/form-data">
                    <!-- Profile Picture Upload -->
                    <div class="mb-3">
                        <label for="profile_picture" class="form-label">Profile Picture</label>
                        <?php if (isset($employer['profile_picture']) && !empty($employer['profile_picture'])): ?>
                            <p>Current Picture: <?= $employer['profile_picture']; ?></p>
                        <?php endif; ?>
                        <input class="form-control" type="file" name="profile_picture" id="profile_picture" accept="image/*">
                    </div>
                    
                    <!-- Company Name -->
                    <div class="mb-3">
                        <label for="company_name" class="form-label">Company Name</label>
                        <input type="text" class="form-control" id="company_name" name="company_name" value="<?= isset($employer['company_name']) ? $employer['company_name'] : ''; ?>" placeholder="Enter your company name">
                    </div>
                    
                    <!-- Company Address -->
                    <div class="mb-3">
                        <label for="company_address" class="form-label">Company Address</label>
                        <input type="text" class="form-control" id="company_address" name="company_address" value="<?= isset($employer['company_address']) ? $employer['company_address'] : ''; ?>" placeholder="Enter your company address">
                    </div>
                    
                    <!-- Contact Info -->
                    <div class="mb-3">
                        <label for="contact_info" class="form-label">Contact Info</label>
                        <input type="number" class="form-control" id="contact_info" name="contact_info" value="<?= isset($employer['contact_info']) ? $employer['contact_info'] : ''; ?>">
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
