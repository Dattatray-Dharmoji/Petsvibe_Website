<?php
session_start();
require_once('database.php'); // Include your DB connection

// Check if the cart is empty
if (empty($_SESSION['cart'])) {
    die("Your cart is empty. Please add items to the cart before proceeding.");
}

// Check if payment method is selected
if (!isset($_POST['paymentMode'])) {
    die("Payment method is required.");
}

$paymentMethod = $_POST['paymentMode']; // Either 'Online Payment' or 'Cash on Delivery'
$fullName = mysqli_real_escape_string($conn, $_POST['fullName']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$phone = mysqli_real_escape_string($conn, $_POST['phone']);
$city = mysqli_real_escape_string($conn, $_POST['city']);
$state = mysqli_real_escape_string($conn, $_POST['state']);
$zip = mysqli_real_escape_string($conn, $_POST['zip']);
$address = mysqli_real_escape_string($conn, $_POST['address']);

// Prepare the SQL query to insert order details
$stmt = $conn->prepare("INSERT INTO orders (full_name, email, phone, city, state, zip, address, payment_method, status) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

if ($stmt === false) {
    die("Error preparing query: " . $conn->error); // Output MySQL error if query preparation fails
}

$status = 'Pending';
$stmt->bind_param("sssssssss", $fullName, $email, $phone, $city, $state, $zip, $address, $paymentMethod, $status);

if ($stmt->execute()) {
    $orderId = $stmt->insert_id; // Get the inserted order ID

    // Prepare the query to insert order items
    $itemStmt = $conn->prepare("INSERT INTO order_items (order_id, item_name, price, quantity) VALUES (?, ?, ?, ?)");

    if ($itemStmt === false) {
        die("Error preparing order items query: " . $conn->error); // Output MySQL error if query preparation fails
    }

    // Insert each item in the cart into the order_items table
    foreach ($_SESSION['cart'] as $item) {
        $itemName = $item['name'];
        $itemPrice = $item['price'];
        $itemQuantity = $item['quantity'];

        $itemStmt->bind_param("isdi", $orderId, $itemName, $itemPrice, $itemQuantity);
        if (!$itemStmt->execute()) {
            die("Error inserting order item: " . $itemStmt->error); // Handle error for each item insertion
        }
    }

    // Redirect based on payment method
    if ($paymentMethod == "Online Payment") {
        // Redirect to the payment gateway page with the order ID
        header("Location: payment_gateway.php?order_id=$orderId");
        exit();
    } else {
        // For COD, immediately redirect to the "thank you" page
        header("Location: thank_you.php?order_id=$orderId");
        exit();
    }
} else {
    echo "Error executing query: " . $stmt->error; // Output MySQL error if query execution fails
}

$stmt->close();
$itemStmt->close();
$conn->close();
?>
<?php
session_start();
$formSubmitted = false;
$paymentStatus = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $paymentMethod = $_POST['paymentMode'];
    $receiptFile = $_FILES['receipt']['name'];

    // Process form
    $formSubmitted = true;
    $orderSummary = [
        'Name' => htmlspecialchars($fullName),
        'Email' => htmlspecialchars($email),
        'Payment Method' => htmlspecialchars($paymentMethod),
    ];

    // Handle file upload
    if ($paymentMethod === 'bank_transfer') {
        if ($receiptFile) {
            // Store uploaded image in the 'uploads' directory
            $targetDir = "uploads/";
            $targetFile = $targetDir . basename($receiptFile);
            if (move_uploaded_file($_FILES['receipt']['tmp_name'], $targetFile)) {
                $paymentStatus = "Bank transfer initiated. Receipt uploaded successfully!";
                // Save to the database or process further
            } else {
                $paymentStatus = "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        $paymentStatus = "Payment method: Online Payment (Dummy Process)";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Payment Page</h2>

        <!-- Display the form if it's not submitted yet -->
        <?php if (!$formSubmitted): ?>
            <form action="dummy_payment_gateway.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="fullName" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="fullName" name="fullName" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="paymentMode" class="form-label">Payment Method</label>
                    <select class="form-select" id="paymentMode" name="paymentMode" required>
                        <option value="online">Online Payment</option>
                        <option value="bank_transfer">Bank Transfer</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="receipt" class="form-label">Upload Payment Receipt (For Bank Transfer)</label>
                    <input type="file" class="form-control" id="receipt" name="receipt">
                </div>
                <button type="submit" class="btn btn-primary">Place Order</button>
            </form>
        <?php else: ?>
            <!-- Display the order summary and payment status after form submission -->
            <h3>Order Summary</h3>
            <ul class="list-group">
                <li class="list-group-item"><strong>Name:</strong> <?php echo $orderSummary['Name']; ?></li>
                <li class="list-group-item"><strong>Email:</strong> <?php echo $orderSummary['Email']; ?></li>
                <li class="list-group-item"><strong>Payment Method:</strong> <?php echo $orderSummary['Payment Method']; ?></li>
            </ul>
            <p><?php echo $paymentStatus; ?></p>
            <?php if ($paymentMethod === 'bank_transfer' && $receiptFile): ?>
                <p><strong>Receipt Screenshot:</strong></p>
                <img src="uploads/<?php echo htmlspecialchars($receiptFile); ?>" class="img-fluid" alt="Receipt">
            <?php endif; ?>
        <?php endif; ?>
    </div>
</body>
</html>
