<?php
include APP_DIR.'views/templates/header.php';
?>
<body class="bg-gray-100">
    <div id="app">
      <?php
      include APP_DIR.'views/templates/nav.php';
      ?>  

        <?php if (!empty($_SESSION['toastr'])): ?>
        <script>
            $(document).ready(function() {
                toastr.<?= $_SESSION['toastr']['type']; ?>("<?= $_SESSION['toastr']['message']; ?>");
            });
        </script>
        <?php unset($_SESSION['toastr']); endif; ?>
      <main class="mt-3 pt-3">
          <div class="container mx-auto px-4">
              <div class="flex justify-center">
                  <div class="w-full max-w-md">
                      <div class="bg-white shadow-lg rounded-lg">
                          <div class="bg-indigo-600 text-white text-xl font-semibold py-4 px-6 rounded-t-lg">Dashboard</div>
                          <div class="p-6">
                              <p class="text-lg">You are logged in as
                              <?php
                                  $role = $user['role'];
                                  $id = $user['id'];
                                  echo $role;
                                  echo " with ID: $id";
                              ?>!</p>

                              <?php if($role == 'employer'): ?>
                                  <a href="<?=site_url('user/employer/profile');?>" class="text-indigo-600 hover:text-indigo-800">Go to employer's profile</a>
                                  <button type="button" class="mt-4 bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600" data-bs-toggle="modal" data-bs-target="#jobPostModal">Post a Job</button>
                              <?php else: ?>
                                  <a href="<?=site_url('user/jobseeker/profile');?>" class="text-indigo-600 hover:text-indigo-800">Go to jobseeker's profile</a>
                              <?php endif; ?>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </main>

      <?php
      include APP_DIR.'views/templates/employer/jobLists.php';
      ?> 

      <?php
      include APP_DIR.'views/templates/employer/postModal.php';
      ?>  

    </div>

    <!-- Bootstrap and jQuery Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <!-- Optional: AJAX handling of job post form submission -->
    <script>
    //   $('#jobPostForm').on('submit', function(e) {
    //     e.preventDefault();
    //     // Handle form submission here (AJAX or regular form submission)
    //     alert('Job posted successfully!');

    //     // You can optionally close the modal after submission
    //     $('#jobPostModal').modal('hide');
    //   });
    </script>
</body>
</html>
