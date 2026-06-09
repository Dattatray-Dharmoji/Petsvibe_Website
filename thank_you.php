<?php
$orderId = $_GET['order_id'] ?? 'Unknown';
$status = $_GET['status'] ?? 'Pending';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Confirmation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5 text-center">
        <h2>Thank You!</h2>
        <p>Your order has been placed successfully.</p>
        <p>Order ID: <strong><?php echo htmlspecialchars($orderId); ?></strong></p>
        <p>Status: <strong><?php echo htmlspecialchars(ucfirst($status)); ?></strong></p>
        <a href="index.php" class="btn btn-primary mt-3">Return to Home</a>
    </div>
</body>
</html>
