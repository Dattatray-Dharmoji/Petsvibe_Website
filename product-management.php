<?php
include 'database.php';

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM products WHERE id = $id");
    header("Location: product-management.php");
}

$products = mysqli_query($conn, "SELECT * FROM products");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products</title>
</head>
<body>
    <h1>Manage Products</h1>
    <table border="1">
        <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Category</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
        <?php while ($product = mysqli_fetch_assoc($products)) { 
            // Decode the JSON string of images
            $images = json_decode($product['images'], true);
            // Get the first image
            $firstImage = isset($images[0]) ? $images[0] : ''; 
        ?>
            <tr>
                <td><?php echo $product['name']; ?></td>
                <td><?php echo $product['price']; ?> INR</td>
                <td><?php echo $product['category']; ?></td>
                <td>
                    <?php if ($firstImage) { ?>
                        <img src="<?php echo $firstImage; ?>" alt="Product Image" width="100">
                    <?php } else { ?>
                        No Image
                    <?php } ?>
                </td>
                <td>
                    <a href="update-product.php?id=<?php echo $product['id']; ?>">Edit</a> |
                    <a href="?delete=<?php echo $product['id']; ?>" onclick="return confirm('Delete this product?');">Delete</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
