<?php
function startLayout($title = "Admin Panel") {
    echo <<<HTML
    <!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>{$title}</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
      <link rel="stylesheet" href="Mainpage.css">
    </head>
    <body>
      <div class="navbar">
        <div class="logo">Product Management & User Registration System</div>
        <div class="nav-links">
          <a href="MainPage.html">Home</a>
          <a href="login.html">Login</a>
          <a href="Register.html">Register</a>
          <a href="Admin.php">Admin</a>
        </div>
      </div>
      <div class="container my-4">
        <div class="d-flex justify-content-end mb-3">
          <a href="add.php" class="btn btn-success">+ Add Product</a>
        </div>
HTML;
}

function endLayout() {
    echo <<<HTML
    </body>
    </html>
HTML;
}
?>
