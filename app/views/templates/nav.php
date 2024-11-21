<nav class="bg-white shadow-sm">
    <div class="container mx-auto px-4 py-2 flex justify-between items-center">
        <a href="<?=site_url('home');?>" class="text-lg font-semibold text-gray-800">
            LavaLust UI
        </a>
        <button class="lg:hidden text-gray-800 focus:outline-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="lg:flex flex-grow items-center hidden" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="flex space-x-4 ml-auto">
                <!-- Authentication Links -->
                <?php if(! logged_in()): ?>
                <li class="nav-item">
                    <a href="<?=site_url('auth/login');?>" class="text-gray-800 hover:text-indigo-600">Login</a>
                </li>
                <li class="nav-item">
                    <a href="<?=site_url('auth/register');?>" class="text-gray-800 hover:text-indigo-600">Register</a>
                </li>
                <?php endif; ?>
                <?php
                    $role = $user['role'];
                ?>
                <?php if($role == 'employer'): ?>
                    <a href="<?=site_url('user/employer/jobPosts');?>" class="text-indigo-600 hover:text-indigo-800">Job Posts</a>
                <?php else: ?>
                    <a href="<?=site_url('user/jobseeker/jobApplication');?>" class="text-indigo-600 hover:text-indigo-800">Job Application</a>
                <?php endif; ?>
                <li class="nav-item">
                    <a href="" class="text-gray-800 hover:text-indigo-600"><?=html_escape(get_username(get_user_id()));?></a>
                </li>
                <li class="nav-item">
                    <a href="<?=site_url('auth/logout');?>" class="text-gray-800 hover:text-indigo-600">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
