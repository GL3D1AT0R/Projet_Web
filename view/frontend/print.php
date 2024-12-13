<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../../controller/itemC.php';

// Get the order ID from the query string
$orderid = $_GET['id']; 

// Create an instance of ItemController
$ItemController = new ItemController();

// Fetch items for this specific order
$items = $ItemController->listItemsByOrder($orderid);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Receipt for Order #<?= $orderid ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            flex-direction: column;
        }

        .receipt-container {
            width: 400px;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .receipt-header {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #333;
        }

        .receipt-details {
            font-size: 14px;
            color: #555;
            margin-bottom: 20px;
        }

        .items-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .item {
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
        }

        .item:last-child {
            border-bottom: none;
        }

        .item-title {
            font-size: 16px;
            font-weight: bold;
            color: #333;
        }

        .item-detail {
            font-size: 14px;
            color: #666;
        }

        .total {
            text-align: right;
            font-size: 16px;
            font-weight: bold;
            margin-top: 20px;
            color: #333;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            color: #aaa;
            margin-top: 20px;
        }

        .receipt-image {
            display: block;
            width: 150px;
            height: 150px;
            margin-left: 144px;
        }

        /* Button styles */
        .print-button {
            background-color: #c000ff;
            color: white;
            font-size: 16px;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .print-button:hover {
            background-color: #4b0064;
        }
    </style>
</head>

<body>
    <div class="receipt-container">
        <!-- Image placeholder above the title -->
        <img src="logo.png" alt="Receipt Image" class="receipt-image">

        <h1 class="receipt-header">Receipt for Order #<?= $orderid ?></h1>

        <div class="receipt-details">
            <p><strong>Date:</strong> <?= date('Y-m-d H:i:s'); ?></p>
            <p><strong>Order ID:</strong> <?= $orderid ?></p>
        </div>

        <?php if (empty($items)): ?>
            <p class="no-items-message">No items found for this order.</p>
        <?php else: ?>
            <ul class="items-list">
                <?php $total = 0; foreach ($items as $item): ?>
                    <li class="item">
                        <div class="item-title">Item #<?= htmlspecialchars($item['itemid']); ?></div>
                        <div class="item-detail">Quantity: <?= htmlspecialchars($item['quantity']); ?></div>
                        <div class="item-detail">Price: <?= htmlspecialchars($item['price']); ?> USD</div>
                        <?php $total += $item['quantity'] * $item['price']; ?>
                    </li>
                <?php endforeach; ?>
            </ul>

            <div class="total">Total: $<?= number_format($total, 2); ?></div>
        <?php endif; ?>

        <div class="footer">Thank you for your purchase!</div>
    </div>

    <!-- Print Button -->
    <button class="print-button" onclick="printReceipt()">Print Now</button>

    <script>
        function printReceipt() {
            var printContents = document.querySelector('.receipt-container').innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>
</body>

</html>
