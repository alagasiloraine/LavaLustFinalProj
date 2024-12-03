<?php
// Updated function to check if the current page matches the given path
function isCurrentPage($path) {
    $current_url = $_SERVER['REQUEST_URI'];
    return (strpos($current_url, $path) !== false) ? 'active' : '';
}
?>

<nav class="navbar">
    <div class="navbar-container">
        <!-- Logo and Branding (unchanged) -->
        <a href="<?= site_url('home'); ?>" class="navbar-logo">
            <img src="\public\images\imagelogo2.1.png" alt="Career Connect Logo" class="brand-logo">
            <span class="brand-text">Career Connect</span>
        </a>

        <!-- Updated Main Navigation -->
        <div class="navbar-links">
            <ul>
                <li><a href="<?= site_url('home'); ?>" class="<?= isCurrentPage('/home') ?>">Home</a></li>
                <li><a href="<?= site_url('user/jobs') ?>" class="<?= isCurrentPage('/jobs') ?>">Find Job</a></li>
                <li><a href="/user/aboutUs" class="<?= isCurrentPage('/aboutUs') ?>">About Us</a></li>
                <li><a href="/user/Contact" class="<?= isCurrentPage('/Contact') ?>">Contact Us</a></li>
            </ul>
        </div>

        <!-- User Dropdown (unchanged) -->
        <?php if (logged_in()): ?>
            <?php
                $username = html_escape(get_username($user['id']));
                $profileLink = $user['role'] === 'employer' ? site_url('user/employer/profile') : site_url('user/jobseeker/profile');
            ?>
            <div class="user-dropdown">
                <button id="dropdownUserButton" class="dropdown-toggle">
                    <img src="https://ui-avatars.com/api/?name=<?= urlencode($username) ?>&background=0D8ABC&color=fff" alt="<?= $username ?>" class="user-avatar">
                    <?= $username ?> <span class="dropdown-arrow"></span>
                </button>
                <div id="userDropdown" class="dropdown-menu">
                    <a href="<?= $profileLink; ?>" class="dropdown-item">Profile</a>
                    <a href="<?= site_url('user/jobApplication'); ?>" class="dropdown-item">Job Application</a>
                    <a href="<?= site_url('user/savedJob'); ?>" class="dropdown-item">Saved Job</a>
                    <a href="<?= site_url('auth/logout'); ?>" class="dropdown-item">Logout</a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</nav>

<div class="content-wrapper">
    <!-- Your page content here -->
</div>

<style>
/* Navbar Styles */
.navbar {
    background-color: #ffffff;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    padding: 0.75rem 1.5rem;
    height: 95px;
    display: flex;
    align-items: center;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 1000;
    border-bottom: 1px solid #e5e7eb;
}

.navbar-container {
    max-width: 1400px;
    width: 100%;
    margin: 0 auto;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.navbar-logo {
    display: flex;
    align-items: center;
    text-decoration: none;
    color: #1a202c;
    font-weight: 700;
    font-size: 1.5rem;
    transition: all 0.3s ease;
}

.navbar-logo:hover {
    color: #2563eb;
}

.brand-logo {
    height: 48px;
    width: auto;
    margin-right: 0.75rem;
}

.navbar-links {
    display: flex;
    align-items: center;
}

.navbar-links ul {
    display: flex;
    list-style-type: none;
    margin: 0;
    padding: 0;
    gap: 2rem;
}

.navbar-links a {
    text-decoration: none;
    color: #4b5563;
    font-size: 1rem;
    font-weight: 500;
    transition: all 0.3s ease;
    padding: 0.5rem 0;
    position: relative;
}

.navbar-links a.active {
    color: #002147;
    font-weight: 600;
}

.navbar-links a::after {
    content: '';
    position: absolute;
    width: 100%;
    height: 2px;
    bottom: 0;
    left: 0;
    background-color:  #002147;
    transform: scaleX(0);
    transition: transform 0.3s ease;
}

.navbar-links a.active::after {
    transform: scaleX(1);
}

.navbar-links a:hover::after {
    transform: scaleX(1);
}

.navbar-links a:hover,
.navbar-links a.active {
    color:  #003366;
}

.navbar-links a::after {
    content: '';
    position: absolute;
    width: 100%;
    height: 2px;
    bottom: 0;
    left: 0;
    background-color:  #003366;
    transform: scaleX(0);
    transition: transform 0.3s ease;
}

.navbar-links a:hover::after,
.navbar-links a.active::after {
    transform: scaleX(1);
}

/* User Dropdown Styles */
.user-dropdown {
    position: relative;
}

.dropdown-toggle {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    background-color: #f3f4f6;
    border: 1px solid #e5e7eb;
    cursor: pointer;
    font-size: 0.95rem;
    color: #4b5563;
    padding: 0.5rem 1rem;
    border-radius: 9999px;
    transition: all 0.3s ease;
}

.dropdown-toggle:hover {
    background-color: #e5e7eb;
}

.user-avatar {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    border: 2px solid #ffffff;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
}

.dropdown-arrow::after {
    content: '\25BC';
    font-size: 0.75rem;
    color: #718096;
    transition: transform 0.3s ease;
    margin-left: 0.25rem;
    display: inline-block;
}

.dropdown-toggle > .dropdown-arrow:not(:last-child) {
    display: none;
}

.dropdown-toggle.active .dropdown-arrow::after {
    transform: rotate(180deg);
}

.dropdown-menu {
    display: none;
    position: absolute;
    right: 0;
    top: calc(100% + 0.5rem);
    background-color: white;
    border-radius: 0.75rem;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    min-width: 200px;
    padding: 0.5rem 0;
    border: 1px solid #e5e7eb;
    z-index: 1000;
}

.dropdown-menu.show {
    display: block;
    animation: dropdownFade 0.2s ease-out;
}

@keyframes dropdownFade {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.dropdown-item {
    display: flex;
    align-items: center;
    padding: 0.5rem 1rem;
    color: #4b5563;
    text-decoration: none;
    font-size: 0.95rem;
    transition: all 0.2s ease;
    border-left: 2px solid transparent;
}

.dropdown-item:hover {
    background-color: #f3f4f6;
    color: #2563eb;
    border-left-color: #2563eb;
}

.dropdown-item + .dropdown-item {
    border-top: 1px solid #f3f4f6;
}

.dropdown-item:last-child {
    border-top: 1px solid #e5e7eb;
    margin-top: 0.25rem;
    color: #dc2626;
}

.dropdown-item:last-child:hover {
    background-color: #fef2f2;
    color: #dc2626;
    border-left-color: #dc2626;
}

.content-wrapper {
    margin-top: 96px;
}

@media (max-width: 768px) {
    .navbar {
        height: 70px;
        padding: 0.75rem 1rem;
    }
    
    .brand-logo {
        height: 40px;
    }
    
    .navbar-logo {
        font-size: 1.25rem;
    }
    
    .navbar-links {
        display: none;
    }
    
    /* Add styles for mobile menu toggle if needed */
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const dropdownButton = document.getElementById('dropdownUserButton');
    const dropdownMenu = document.getElementById('userDropdown');
    
    if (dropdownButton && dropdownMenu) {
        dropdownButton.addEventListener('click', (e) => {
            e.stopPropagation();
            dropdownButton.classList.toggle('active');
            dropdownMenu.classList.toggle('show');
        });

        document.addEventListener('click', (e) => {
            if (!dropdownButton.contains(e.target) && !dropdownMenu.contains(e.target)) {
                dropdownButton.classList.remove('active');
                dropdownMenu.classList.remove('show');
            }
        });
    }
});
</script>