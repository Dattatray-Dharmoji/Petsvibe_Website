<?php
session_start();
$formSubmitted = false;
$paymentStatus = "";
$paymentMethod = ""; // Define the variable to avoid undefined error

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $paymentMethod = $_POST['paymentMode']; // Now it gets value from POST data
    $receiptFile = $_FILES['receipt']['name'];

    // Process the order based on payment method
    $formSubmitted = true;
    $orderSummary = [
        'Name' => htmlspecialchars($fullName),
        'Email' => htmlspecialchars($email),
        'Payment Method' => htmlspecialchars($paymentMethod),
    ];

    // Handle file upload for Bank Transfer
    if ($paymentMethod === 'bank_transfer') {
        if ($receiptFile) {
            // Define the target directory for file uploads
            $targetDir = "uploads/";
            $targetFile = $targetDir . basename($receiptFile);

            // Move the uploaded file to the server
            if (move_uploaded_file($_FILES['receipt']['tmp_name'], $targetFile)) {
                $paymentStatus = "Bank transfer initiated. Receipt uploaded successfully!";
            } else {
                $paymentStatus = "Error uploading receipt file.";
            }
        }
    } else {
        // Online payment method (dummy, no actual payment process)
        $paymentStatus = "Online Payment (Dummy Process) initiated.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Payment Gateway</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Payment Gateway</h2>

        <!-- Display the form if it's not submitted yet -->
        <?php if (!$formSubmitted): ?>
            <form action="" method="POST" enctype="multipart/form-data">
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
                    <input type="file" class="form-control" id="receipt" name="receipt" <?php echo ($paymentMethod === 'bank_transfer') ? 'required' : ''; ?>>
                </div>
                <button type="submit" class="btn btn-primary">Place Order</button>
            </form>
        <?php else: ?>
            <!-- Order Summary after form submission -->
            <h3>Order Summary</h3>
            <ul class="list-group">
                <li class="list-group-item"><strong>Name:</strong> <?php echo $orderSummary['Name']; ?></li>
                <li class="list-group-item"><strong>Email:</strong> <?php echo $orderSummary['Email']; ?></li>
                <li class="list-group-item"><strong>Payment Method:</strong> <?php echo $orderSummary['Payment Method']; ?></li>
            </ul>

            <!-- Payment Status -->
            <p class="mt-3"><?php echo $paymentStatus; ?></p>

            <!-- Display uploaded receipt if bank transfer is selected -->
            <?php if ($paymentMethod === 'bank_transfer' && $receiptFile): ?>
                <p><strong>Receipt Screenshot:</strong></p>
                <img src="uploads/<?php echo htmlspecialchars($receiptFile); ?>" class="img-fluid" alt="Receipt">
            <?php endif; ?>
        <?php endif; ?>
    </div>
</body>
</html>
