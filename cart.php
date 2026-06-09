<?php
session_start();
include 'database.php'; // Ensure database connection is included

// Remove item from cart functionality
if (isset($_POST['remove_from_cart'])) {
    $productId = $_POST['product_id'];
    unset($_SESSION['cart'][$productId]);
    header('Location: cart.php'); // Redirect to cart after removal
    exit();
}

// Fetch cart items
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

// Calculate total price
$totalPrice = 0;
foreach ($cart as $item) {
    $totalPrice += $item['price'] * $item['quantity'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link rel="stylesheet" href="css/cart.css">
</head>
<body>
    <header>
        <h1>Your Cart</h1>
        <a href="productlisting.php">Back to Shop</a>
    </header>

    <div class="cart-container">
        <?php if (empty($cart)) : ?>
            <p>Your cart is empty. <a href="productlisting.php">Continue shopping</a>.</p>
        <?php else : ?>
            <table>
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cart as $productId => $item) : ?>
                        <tr>
                            <td>
                                <img src="<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" width="100">
                            </td>
                            <td><?php echo htmlspecialchars($item['name']); ?></td>
                            <td>₹<?php echo number_format($item['price'], 2); ?></td>
                            <td><?php echo $item['quantity']; ?></td>
                            <td>₹<?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
                            <td>
                                <form action="cart.php" method="post">
                                    <input type="hidden" name="product_id" value="<?php echo $productId; ?>">
                                    <button type="submit" name="remove_from_cart">Remove</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="total-price">
                <p>Total Price: ₹<?php echo number_format($totalPrice, 2); ?></p>
            </div>
            <a href="checkout.php" class="checkout-btn">Proceed to Checkout</a>
        <?php endif; ?>
    </div>
</body>
</html>
