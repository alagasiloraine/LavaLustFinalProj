<?php
include APP_DIR.'views/templates/header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            min-height: 100vh;
            background: #f5f5f5;
        }
        .profile-container {
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: 2rem;
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        /* Sidebar Styles */
        .profile-sidebar {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            border-radius: 1rem;
            padding: 2rem;
            color: white;
            position: sticky;
            top: 2rem;
            height: fit-content;
            margin-left: 45px;
            flex: 0 0 300px;
        }

        .profile-header {
            text-align: center;
        }

        .profile-image-container {
            position: relative;
            width: 150px;
            height: 150px;
            margin: 0 auto 1.5rem;
        }

        .profile-image {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid rgba(255, 255, 255, 0.2);
        }

        .edit-image-btn {
            position: absolute;
            bottom: 0;
            right: 0;
            background: white;
            border: none;
            border-radius: 50%;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: #6366f1;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .profile-name {
            font-size: 1.5rem;
            font-weight: 600;
            margin: 0.5rem 0;
        }

        .profile-role {
            font-size: 0.9rem;
            opacity: 0.9;
        }

        /* Completion Card */
        .completion-card {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 0.75rem;
            padding: 1rem;
            margin: 1.5rem 0;
        }

        .completion-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
        }

        .progress-bar {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 1rem;
            height: 8px;
            overflow: hidden;
        }

        .progress {
            background: white;
            height: 100%;
            border-radius: 1rem;
            transition: width 0.3s ease;
        }

        .completion-text {
            font-size: 0.8rem;
            margin-top: 0.5rem;
            opacity: 0.8;
        }

        /* Quick Info */
        .quick-info {
            margin-top: 1.5rem;
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.5rem 0;
            font-size: 0.9rem;
        }

        .info-item i {
            opacity: 0.8;
        }

        /* Main Content */
        .profile-main {
            max-width: 1200px;
            margin: auto;
            margin-bottom: 120px;
            padding: 2rem;
            background: #fff;
            border-radius: 0.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .main-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .main-header h1 {
            font-size: 2.5rem;  /* Increased from 2rem */
            font-weight: 600;
            color: #111827;
        }

        .edit-profile-btn {
            background: transparent;
            color: #6366f1;
            border: none;
            padding: 0.5rem 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.875rem;
        }

        .edit-profile-btn:hover {
            background: transparent;
            color: #4f46e5;
        }

        /* Tabs */
        .profile-tabs {
            display: flex;
            gap: 2rem;
            margin-bottom: 2rem;
            border-bottom: none;
        }

        .tab-btn {
            padding: 0.5rem 0;
            color: #6b7280;
            font-size: 1rem;
            border: none;
            background: none;
            cursor: pointer;
        }

        .tab-btn.active {
            color: #6366f1;
            font-weight: 500;
        }

        .tab-btn.active::after {
            display: none;
        }

        /* Tab Content */
        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
            background: #f8fafc;
            padding: 2rem;
            border-radius: 0.5rem;
        }

        .info-group {
            margin-bottom: 1.5rem;
        }

        .info-group label {
            display: block;
            color: #6b7280;
            font-size: 0.875rem;
            margin-bottom: 0.5rem;
        }

        .info-group p {
            padding: 0.5rem;
            background: white;
            border-radius: 0.375rem;
            border: 1px solid #e5e7eb;
        }

        /* Skills */
        .skills-container {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .skill-tag {
            background: #e0e7ff;
            color: #6366f1;
            padding: 0.25rem 0.75rem;
            border-radius: 1rem;
            font-size: 0.9rem;
        }

        /* Availability Badge */
        .availability-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 1rem;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .availability-badge.available {
            background: #dcfce7;
            color: #16a34a;
        }

        .availability-badge.not_available {
            background: #fee2e2;
            color: #dc2626;
        }

        .availability-badge.open_to_offers {
            background: #e0e7ff;
            color: #6366f1;
        }
        .modal-content {
        border-radius: 0.5rem;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }
    .modal-header {
        background-color: #f8fafc;
        border-top-left-radius: 0.5rem;
        border-top-right-radius: 0.5rem;
    }
    .modal-body {
        max-height: calc(100vh - 200px);
        overflow-y: auto;
    }
    .form-control, .form-select {
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }
    .form-control:focus, .form-select:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 0.2rem rgba(59, 130, 246, 0.25);
    }
    .profile-container {
        display: flex;
        gap: 2rem;
        max-width: 1200px;
        margin: 2rem auto;
        padding: 0 1rem;
    }

    .profile-sidebar {
        flex: 0 0 300px;
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        border-radius: 1rem;
        padding: 2rem;
        color: white;
        height: fit-content;
    }

    .profile-main {
        flex: 1;
        background: #fff;
        border-radius: 0.5rem;
        padding: 2rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .profile-image-container {
        width: 150px;
        height: 150px;
        margin: 0 auto 1.5rem;
    }

        /* Responsive Design */
        @media (max-width: 768px) {
            .profile-container {
                grid-template-columns: 1fr;
            }

            .profile-sidebar {
                position: static;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

<?php include APP_DIR.'views/templates/nav.php'; ?>

<div class="profile-container">
    <!-- Left Sidebar -->
    <div class="profile-sidebar">
        <div class="profile-header">
            <div class="profile-image-container">
                <img src="<?= isset($job_seeker['profile_picture']) && !empty($job_seeker['profile_picture']) ? '../../../../uploads/profile_pictures/' . $job_seeker['profile_picture'] : '../../../public/images/default_profile.jpg'; ?>" 
                    alt="Profile Picture" 
                    class="profile-image">
                <button class="edit-image-btn">
                    <i class="fas fa-edit"></i>
                </button>
            </div>
            <h2 class="profile-name"><?= isset($job_seeker['full_name']) ? $job_seeker['full_name'] : $user['username']; ?></h2>
            <p class="profile-role"><?= $user['role']; ?></p>
            
            <!-- Profile Completion -->
            <div class="completion-card">
                <div class="completion-header">
                    <span>Profile Completion</span>
                    <span class="completion-percentage">0%</span>
                </div>
                <div class="progress-bar">
                    <div class="progress" style="width: 0%"></div>
                </div>
                <p class="completion-text">Complete your profile to increase visibility</p>
            </div>

            <!-- Quick Info -->
            <div class="quick-info">
                <div class="info-item">
                    <i class="fas fa-file-alt"></i>
                    <a href="<?= isset($job_seeker['resume']) ? site_url('uploads/' . $job_seeker['resume']) : '#'; ?>" 
                       class="resume-link" target="_blank">View Resume</a>
                </div>
                <!-- <div class="info-item">
                    <i class="fas fa-envelope"></i>
                    <span><?= $user['email']; ?></span>
                </div> -->
                <div class="info-item">
                    <i class="fas fa-calendar"></i>
                    <span>Member since <?= date('F Y'); ?></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="profile-main">
        <div class="main-header">
            <h1>Profile Information</h1>
            <button type="button" class="edit-profile-btn" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                <i class="fas fa-pen"></i> Edit Profile
            </button>
        </div>

        <!-- Tabs -->
        <div class="profile-tabs">
            <button class="tab-btn active" data-tab="personal">Personal</button>
            <button class="tab-btn" data-tab="professional">Professional</button>
        </div>

        <!-- Tab Content -->
        <div class="tab-content active" id="personal">
            <div class="info-grid">
                <div class="info-section">
                    <h3>Basic Information</h3>
                    <div class="info-group">
                        <label>Full Name</label>
                        <p><?= isset($job_seeker['full_name']) ? $job_seeker['full_name'] : 'Not Provided'; ?></p>
                    </div>
                    <div class="info-group">
                        <label>Location</label>
                        <p><?= isset($job_seeker['location']) ? $job_seeker['location'] : 'Not Provided'; ?></p>
                    </div>
                    <div class="info-group">
                        <label>Email</label>
                        <p><?= $user['email']; ?></p>
                    </div>
                </div>
                
                <div class="info-section">
                    <h3>Skills & Bio</h3>
                    <div class="info-group">
                        <label>Skills</label>
                        <div class="skills-container">
                            <?php 
                            if(isset($job_seeker['skills']) && !empty($job_seeker['skills'])) {
                                $skills = explode(',', $job_seeker['skills']);
                                foreach($skills as $skill) {
                                    echo "<span class='skill-tag'>".trim($skill)."</span>";
                                }
                            } else {
                                echo "<p>No skills listed</p>";
                            }
                            ?>
                        </div>
                    </div>
                    <div class="info-group">
                        <label>Bio</label>
                        <p class="bio-text"><?= isset($job_seeker['bio']) ? $job_seeker['bio'] : 'Not Provided'; ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-content" id="professional">
            <div class="info-grid">
                <div class="info-section">
                    <h3>Education</h3>
                    <div class="info-group">
                        <p><?= isset($job_seeker['education']) ? $job_seeker['education'] : 'Not Provided'; ?></p>
                    </div>
                </div>
                
                <div class="info-section">
                    <h3>Experience</h3>
                    <div class="info-group">
                        <p><?= isset($job_seeker['experience']) ? $job_seeker['experience'] : 'Not Provided'; ?></p>
                    </div>
                </div>

                <div class="info-section">
                    <h3>Availability</h3>
                    <div class="info-group">
                        <span class="availability-badge <?= isset($job_seeker['availability']) ? strtolower($job_seeker['availability']) : ''; ?>">
                            <?= isset($job_seeker['availability']) ? ucfirst($job_seeker['availability']) : 'Not Specified'; ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title text-2xl font-semibold" id="editProfileModalLabel">Edit Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-4 py-4">
                <form action="<?=site_url('user/profile/edit-profile');?>" method="POST" enctype="multipart/form-data">
                    <!-- Profile Picture Upload -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Profile Picture</label>
                        <div class="flex items-center gap-4">
                            <div class="w-20 h-20 rounded-full overflow-hidden bg-gray-100 border-2 border-blue-500">
                                <img src="<?= isset($job_seeker['profile_picture']) && !empty($job_seeker['profile_picture']) ? '../../../../uploads/profile_pictures/' . $job_seeker['profile_picture'] : '../../../public/images/default_profile.jpg'; ?>" 
                                alt="Current profile picture"
                                    class="w-full h-full object-cover"
                                >
                            </div>
                            <div class="flex-1">
                                <input 
                                    type="file" 
                                    name="profile_picture" 
                                    id="profile_picture" 
                                    accept="image/*"
                                    class="form-control file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                                >
                            </div>
                        </div>
                    </div>
                    
                    <!-- Full Name -->
                    <div class="mb-4">
                        <label for="full_name" class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                        <input 
                            type="text" 
                            class="form-control border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 rounded-md shadow-sm" 
                            id="full_name" 
                            name="full_name" 
                            value="<?= isset($job_seeker['full_name']) ? $job_seeker['full_name'] : ''; ?>"
                            placeholder="Enter your full name"
                        >
                    </div>

                    <!-- Location -->
                    <div class="mb-4">
                        <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                        <input 
                            type="text" 
                            class="form-control border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 rounded-md shadow-sm" 
                            id="location" 
                            name="location" 
                            value="<?= isset($job_seeker['location']) ? $job_seeker['location'] : ''; ?>"
                            placeholder="City, Province, Country"
                        >
                    </div>

                    <!-- Bio -->
                    <div class="mb-4">
                        <label for="bio" class="block text-sm font-medium text-gray-700 mb-2">Bio</label>
                        <textarea 
                            class="form-control border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 rounded-md shadow-sm" 
                            id="bio" 
                            name="bio" 
                            rows="4"
                            placeholder="Tell us about yourself"
                        ><?= isset($job_seeker['bio']) ? $job_seeker['bio'] : ''; ?></textarea>
                    </div>

                    <!-- Skills -->
                    <div class="mb-4">
                        <label for="skills" class="block text-sm font-medium text-gray-700 mb-2">Skills</label>
                        <input 
                            type="text" 
                            class="form-control border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 rounded-md shadow-sm" 
                            id="skills" 
                            name="skills" 
                            value="<?= isset($job_seeker['skills']) ? $job_seeker['skills'] : ''; ?>"
                            placeholder="e.g., Data Analysis, Project Management"
                        >
                        <small class="text-gray-500 mt-1 block">Separate skills with commas</small>
                    </div>

                    <!-- Education -->
                    <div class="mb-4">
                        <label for="education" class="block text-sm font-medium text-gray-700 mb-2">Education</label>
                        <input 
                            type="text" 
                            class="form-control border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 rounded-md shadow-sm" 
                            id="education" 
                            name="education" 
                            value="<?= isset($job_seeker['education']) ? $job_seeker['education'] : ''; ?>"
                            placeholder="Your highest education level"
                        >
                    </div>

                    <!-- Experience -->
                    <div class="mb-4">
                        <label for="experience" class="block text-sm font-medium text-gray-700 mb-2">Experience</label>
                        <textarea 
                            class="form-control border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 rounded-md shadow-sm" 
                            id="experience" 
                            name="experience" 
                            rows="4"
                            placeholder="Describe your work experience"
                        ><?= isset($job_seeker['experience']) ? $job_seeker['experience'] : ''; ?></textarea>
                    </div>

                    <!-- Resume -->
                    <div class="mb-4">
                        <label for="resume" class="block text-sm font-medium text-gray-700 mb-2">Resume</label>
                        <input 
                            type="file" 
                            class="form-control file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" 
                            name="resume" 
                            id="resume" 
                            accept=".pdf,.doc,.docx"
                        >
                        <small class="text-gray-500 mt-1 block">Accepted formats: PDF, DOC, DOCX</small>
                    </div>

                    <!-- Availability -->
                    <div class="mb-4">
                        <label for="availability" class="block text-sm font-medium text-gray-700 mb-2">Availability</label>
                        <select class="form-select border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 rounded-md shadow-sm" id="availability" name="availability">
                            <option value="">Select your availability</option>
                            <option value="available" <?= (isset($job_seeker['availability']) && $job_seeker['availability'] == 'available') ? 'selected' : ''; ?>>Available</option>
                            <option value="not_available" <?= (isset($job_seeker['availability']) && $job_seeker['availability'] == 'not_available') ? 'selected' : ''; ?>>Not Available</option>
                            <option value="open_to_offers" <?= (isset($job_seeker['availability']) && $job_seeker['availability'] == 'open_to_offers') ? 'selected' : ''; ?>>Open to Offers</option>
                        </select>
                    </div>

                    <div class="modal-footer border-0 px-0 pt-4">
                        <button type="button" class="btn btn-light rounded-md px-4 py-2 text-gray-700 bg-gray-100 hover:bg-gray-200" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary rounded-md px-4 py-2 bg-blue-600 text-white hover:bg-blue-700">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Tab switching functionality
        const tabBtns = document.querySelectorAll('.tab-btn');
        const tabContents = document.querySelectorAll('.tab-content');

        tabBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                // Remove active class from all buttons and contents
                tabBtns.forEach(b => b.classList.remove('active'));
                tabContents.forEach(c => c.classList.remove('active'));

                // Add active class to clicked button and show corresponding content
                btn.classList.add('active');
                const tabId = btn.dataset.tab;
                document.getElementById(tabId).classList.add('active');
            });
        });

        // Calculate profile completion
        function calculateProfileCompletion() {
            const fields = [
                'full_name',
                'location',
                'bio',
                'skills',
                'education',
                'experience',
                'availability',
                'resume'
            ];
            
            let completed = 0;
            fields.forEach(field => {
                const element = document.querySelector(`[name="${field}"]`);
                if (element && element.value && element.value !== 'Not Provided') {
                    completed++;
                }
            });

            const percentage = Math.round((completed / fields.length) * 100);
            document.querySelector('.completion-percentage').textContent = `${percentage}%`;
            document.querySelector('.progress').style.width = `${percentage}%`;
        }

        // Calculate initial completion
        calculateProfileCompletion();

        // Update completion when form is submitted
        const form = document.querySelector('form');
        if (form) {
            form.addEventListener('submit', () => {
                setTimeout(calculateProfileCompletion, 500); // Delay to allow for form submission
            });
        }

        // Edit profile picture functionality
        document.querySelector('.edit-image-btn').addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('profile_picture').click();
        });

        document.getElementById('profile_picture').addEventListener('change', function() {
            document.querySelector('form').submit();
        });
    });
</script>

<?php include APP_DIR.'views/templates/footer.php'; ?>

</body>
</html>

