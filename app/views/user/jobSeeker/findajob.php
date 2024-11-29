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
      <!-- <main class="mt-3 pt-3">
          <div class="container mx-auto px-4">
              <div class="flex justify-center">
                  <div class="w-full max-w-md">
                      <div class="bg-white shadow-lg rounded-lg">
                          <div class="bg-indigo-600 text-white text-xl font-semibold py-4 px-6 rounded-t-lg">Dashboard</div>
                          <div class="p-6">
                              <p class="text-lg">You are logged in as
                             
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </main> -->

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
    
    <?php include APP_DIR.'views/templates/footer.php'; ?>
</body>
</html>
