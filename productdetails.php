<?php
include 'database.php'; // Include the file containing your fetch functions

// Fetch product details
$id = isset($_GET['id']) ? intval($_GET['id']) : 0; // Validate ID input
$productQuery = "SELECT * FROM products WHERE id = ?";
$stmt = $conn->prepare($productQuery);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

if (!$product) {
  die("<h1>Product Not Found!</h1>"); // Display error if product is missing

}

// Decode images from JSON (all images)
$images = json_decode($product['images'], true); // Decoding JSON string to PHP array
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Monito - Product Details</title>
  <link rel="stylesheet" href="css/products.css"> <!-- Link to CSS file -->
</head>
<body>

  <!-- Header -->
  <header>
    <h1>Monito - Puppies</h1>
    <button id="cart-btn">🛒 Cart</button>
  </header>

  <!-- Product Details Section -->
  <div class="product-details">
    <div class="carousel">
      <!-- Display all product images -->
      <?php if (!empty($images)): ?>
        <?php foreach ($images as $img): ?>
          <img src="<?php echo htmlspecialchars($img); ?>" alt="Product Image">
        <?php endforeach; ?>
      <?php else: ?>
        <p>No images available.</p>
      <?php endif; ?>
    </div>

    <div class="product-info">
      <h2><?php echo htmlspecialchars($product['name']); ?></h2>
      <p class="price">Price: <?php echo number_format($product['price']); ?> VND</p>
      <table class="product-table">
        <tr><td>Breed:</td><td><?php echo htmlspecialchars($product['description']); ?></td></tr>
      </table>
      <button id="add-to-cart" class="btn">Add to Cart</button>
    </div>
  </div>

  <!-- Suggested Products Section -->
  <section class="suggested-products">
    <h3>See More Puppies</h3>
    <div class="product-list">
      <?php
      // Fetch related products based on category or other criteria
      $relatedProducts = [];// Fetch related products logic can go here
      if (!empty($relatedProducts)): ?>
        <?php foreach ($relatedProducts as $item): ?>
          <div class="product-card">
            <img src="<?php echo htmlspecialchars($item['image_url']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>">
            <h4><?php echo htmlspecialchars($item['name']); ?></h4>
            <p><?php echo number_format($item['price']); ?> VND</p>
            <a href="product-details.php?id=<?php echo $item['id']; ?>" class="btn">View Details</a>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p>No related products available.</p>
      <?php endif; ?>
    </div>
  </section>

</body>
</html>
