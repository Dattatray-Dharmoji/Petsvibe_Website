<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    $showLoginPopup = true;
} else {
    $showLoginPopup = false;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/dashboard.css">
    <title>Dashboard</title>
</head>
<body>
    <div class="dash-container">
        <!-- Sidebar -->
        <aside class="dash-sidebar">
            <h3 class="dash-title">Dashboard</h3>
            <ul class="dash-menu">
                <li><a href="manage_pets.php" class="dash-link">Pets</a></li>
                <li><a href="manage_products.php" class="dash-link">Products</a></li>
                <li><a href="manage_blog.php" class="dash-link">Blog</a></li>
                <li><a href="auth.php?logout=true" class="dash-link">Logout</a></li>

            </ul>
        </aside>
        
        <!-- Main Content -->
        <main class="dash-content">
            <h1 class="dash-header">Welcome to the Dashboard</h1>
            <section id="pets">
                <h2 class="dash-subheader">Pets Section</h2>
            </section>
            <section id="products">
                <h2 class="dash-subheader">Products Section</h2>
            </section>
        </main>
    </div>

    <!-- Login Popup -->
    <?php if ($showLoginPopup): ?>
    <div class="login-overlay">
        <div class="login-box">
            <form action="auth.php" method="POST">
                <h2 class="login-header">Login</h2>
                <input type="text" name="username" placeholder="Username" class="login-input" required>
                <input type="password" name="password" placeholder="Password" class="login-input" required>
                <button type="submit" name="login" class="login-button">Login</button>
            </form>
        </div>
    </div>
    <?php endif; ?>
</body>
</html>
