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
    
    <?php
        include APP_DIR.'views/templates/employer/jobLists.php';
    ?> 
    

    </div>

    <!-- Bootstrap and jQuery Scripts -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script> -->
</body>
</html>
