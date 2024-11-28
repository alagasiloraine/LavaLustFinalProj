<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</head>
<body>

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
    
</body>
</html>