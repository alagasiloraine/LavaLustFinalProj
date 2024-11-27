<nav class="navbar">
    <div class="navbar-container">
        <!-- Logo and Branding -->
        <a href="<?= site_url('home'); ?>" class="navbar-logo">
            <img src="\public\images\imagelogo2.1.png" alt="Career Connect Logo" class="brand-logo">
            <span class="brand-text">Career Connect</span>
        </a>

        <!-- Main Navigation -->
        <div class="navbar-links">
            <ul>
                <li><a href="<?= site_url('home'); ?>">Home</a></li>
                <li><a href="<?= site_url('user/jobs') ?>">Find a Job</a></li>
                <li><a href="/user/aboutUs">About Us</a></li>
                <li><a href="/user/Contact">Contact Us</a></li>
            </ul>
        </div>

        <!-- User Dropdown -->
        <?php if (logged_in()): ?>
            <?php
                $username = html_escape(get_username($user['id']));
                $profileLink = $user['role'] === 'employer' ? site_url('user/employer/profile') : site_url('user/jobseeker/profile');
            ?>
            <div class="user-dropdown">
                <button id="dropdownUserButton" class="dropdown-toggle">
                    <?= $username ?> <span class="dropdown-arrow"></span>
                </button>
                <div id="userDropdown" class="dropdown-menu">
                    <a href="<?= $profileLink; ?>" class="dropdown-item">Profile</a>
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
.navbar {
    background-color: #ffffff;
    box-shadow: 0 1px 0 rgba(0, 0, 0, 0.1);
    padding: 0 20px;
    height: 64px;
    display: flex;
    align-items: center;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 1000;
}

.navbar-container {
    max-width: 1200px;
    width: 100%;
    margin: 0 auto;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 20px;
}

.navbar-logo {
    display: flex;
    align-items: center;
    text-decoration: none;
    color: #0066cc;
    font-weight: bold;
    font-size: 18px;
}

.brand-logo {
    height: 40px;
    width: auto;
    margin-right: 8px;
}

.navbar-links {
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
}

.navbar-links ul {
    display: flex;
    list-style-type: none;
    margin: 0;
    padding: 0;
    gap: 32px;
}

.navbar-links a {
    text-decoration: none;
    color: #333;
    font-size: 14px;
    font-weight: 500;
}

.user-dropdown {
    margin-left: auto;
}

.dropdown-toggle {
    display: flex;
    align-items: center;
    gap: 4px;
    background: none;
    border: none;
    cursor: pointer;
    font-size: 14px;
    color: #333;
    padding: 6px 8px;
}

.dropdown-arrow {
    font-size: 12px;
    color: #666;
    margin-left: 2px;
}

.dropdown-menu {
    display: none;
    position: absolute;
    background-color: #fff;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    border-radius: 4px;
    top: 100%;
    right: 0;
    min-width: 150px;
    margin-top: 4px;
}

.dropdown-menu.show {
    display: block;
}

.dropdown-item {
    display: block;
    padding: 8px 16px;
    color: #333;
    text-decoration: none;
    font-size: 14px;
}

.dropdown-item:hover {
    background-color: #f5f5f5;
}

.content-wrapper {
    margin-top: 80px; /* Add space below fixed navbar */
}

@media (max-width: 768px) {
    .navbar-links {
        display: none;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const dropdownButton = document.getElementById('dropdownUserButton');
    const dropdownMenu = document.getElementById('userDropdown');
    
    if (dropdownButton && dropdownMenu) {
        dropdownButton.addEventListener('click', (e) => {
            e.stopPropagation();
            dropdownMenu.classList.toggle('show');
        });

        document.addEventListener('click', (e) => {
            if (!dropdownButton.contains(e.target) && !dropdownMenu.contains(e.target)) {
                dropdownMenu.classList.remove('show');
            }
        });
    }
});
</script>

