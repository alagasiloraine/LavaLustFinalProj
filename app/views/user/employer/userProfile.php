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

        <div class="container py-5">
    <div class="row">

        <!-- Profile Card -->
        <div class="col-lg-4 mb-4">
            <div class="card c1 shadow-lg border-0">
                <div class="card-body text-center">
                    <img src="<?= isset($employer['profile_picture']) && !empty($employer['profile_picture']) ? '../../../../uploads/profile_pictures/' . $employer['profile_picture'] : '../../../public/images/default_profile.jpg'; ?>" 
                         alt="Profile Picture" 
                         class="rounded-circle profile-image mb-3">
                    <h5 class="mb-1 text-2xl font-semibold"><?= $user['username']; ?></h5>
                    <p class=" text-md text-white mb-2"><?= $user['email']; ?></p>
                    <span class="badge bg-blue-800"><?= ucfirst($user['role']); ?></span>
                    <hr>
                    <button type="button" class="btn ebt btn-edit-profile bg-blue-800 opacity-80 border" data-toggle="modal" data-target="#editProfileModal">
                        Edit Profile
                    </button>
                </div>
            </div>
        </div>

        <!-- Company Information Card -->
        <div class="col-lg-8 rounded-md">
            <div class="card rounded-md shadow-lg border-0">
                <div class="card-header bg-light">
                    <h5 class="text-2xl font-semibold text-blue-800">Company Information</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-6">
                            <p class="text-muted text-lg">Company Name</p>
                            <h6 class="text-lg"><?= isset($employer['company_name']) ? $employer['company_name'] : 'Not Provided'; ?></h6>
                        </div>
                        <div class="col-6">
                            <p class="text-muted text-lg">Company Address</p>
                            <h6 class="text-lg"><?= isset($employer['company_address']) ? $employer['company_address'] : 'Not Provided'; ?></h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <p class="text-muted text-lg">Contact Information</p>
                            <h6 class="text-lg"><?= isset($employer['contact_info']) ? $employer['contact_info'] : 'Not Provided'; ?></h6>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-light text-muted">
                    Last updated: <?= date("F j, Y"); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Profile Editing -->
<div class="modal" id="editProfileModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Profile</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="<?= site_url('user/profile/editEmployerProfile'); ?>" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="profile_picture">Profile Picture</label>
                        <input class="form-control" type="file" name="profile_picture" id="profile_picture" accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label for="company_name">Company Name</label>
                        <input type="text" class="form-control" id="company_name" name="company_name" value="<?= isset($employer['company_name']) ? $employer['company_name'] : ''; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="company_address">Company Address</label>
                        <input type="text" class="form-control" id="company_address" name="company_address" value="<?= isset($employer['company_address']) ? $employer['company_address'] : ''; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="contact_info">Contact Info</label>
                        <input type="number" class="form-control" id="contact_info" name="contact_info" value="<?= isset($employer['contact_info']) ? $employer['contact_info'] : ''; ?>">
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    /* General Styling */
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f8f9fa;
        color: #333;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
    }

    /* Card Styling */
    .card {
        border-radius: 12px;
        background-color: #ffffff;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        margin-bottom: 30px;
    }

    .card-header, .card-footer {
        background-color: #f1f3f5;
        padding: 18px;
    }

    .card-header h5, .card-footer {
        margin: 0;
    }

    .card-body {
        padding: 24px;
    }
    .c {
        border-radius: 3rem;
    }
    .c1 {
        background: #003366;
        color: white;
    }
    .ebt {
        background-color: #0066cc;
    }
    /* Profile Image Styling */
    .profile-image {
        width: 160px;
        height: 160px;
        border-radius: 50%;
        object-fit: cover;
        border: 5px solid #e0e0e0;
        transition: transform 0.3s ease;
    }

    .profile-image:hover {
        transform: scale(1.1);
    }

    .text-center {
        text-align: center;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .badge {
        color: white;
        padding: 6px 12px;
        border-radius: 20px;
        margin-top: 8px;
    }

    /* Buttons */
    .btn {
        background-color: #0056b3;
        color: white;
        padding: 10px 20px;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        width: 100%;
    }

    .btn:hover {
        background-color: #0056b3;
    }

    .btn-edit-profile {
        background-color: #0066cc;
        color: white;
        border-radius: 15px;
        margin-top: 10px;
    }

 

    /* Modal Styling */
    .modal {
        display: none;
        position: fixed;
        z-index: 1050;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.7);
        justify-content: center;
        align-items: center;
    }

    .modal-dialog {
        width: 500px;
        background-color: white;
        padding: 30px;
        border-radius: 12px;
    }

    .modal-header {
        border-bottom: 1px solid #ddd;
    }

    .modal-body {
        padding: 20px;
    }

    .close {
        font-size: 30px;
        cursor: pointer;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .col-lg-4, .col-lg-8 {
            width: 100%;
            margin-bottom: 20px;
        }

        .modal-dialog {
            width: 90%;
        }

        .card-header, .card-footer {
            padding: 12px;
        }

        .profile-image {
            width: 140px;
            height: 140px;
        }
    }
</style>

<script>
    // Modal toggle logic
    var modal = document.getElementById('editProfileModal');
    var btn = document.querySelector('[data-toggle="modal"]');
    var close = document.querySelector('.close');
    
    btn.onclick = function() {
        modal.style.display = 'flex';
    }

    close.onclick = function() {
        modal.style.display = 'none';
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }
</script>




</body>
</html>
