<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .payment-container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 350px;
        }
        .payment-container img {
            display: block;
            margin: 0 auto 20px;
            max-width: 100%;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .btn {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
            margin-top: 10px;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="payment-container">
        <h2>Secure Payment</h2>
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b5/PayPal.svg/1200px-PayPal.svg.png" alt="PayPal Logo">
        <img src="https://upload.wikimedia.org/wikipedia/commons/a/a4/Mastercard_2019_logo.svg" alt="Mastercard Logo">
        
        <form action="listO.php" method="POST">
            <div class="form-group">
                <label for="card-number">Card Number</label>
                <input type="text" id="card-number" name="cardNumber" placeholder="Enter your card number" required>
            </div>
            <div class="form-group">
                <label for="expiry-date">Expiration Date</label>
                <input type="text" id="expiry-date" name="expiryDate" placeholder="MM/YY" required>
            </div>
            <div class="form-group">
                <label for="cvv">CVV</label>
                <input type="text" id="cvv" name="cvv" placeholder="Enter CVV" required>
            </div>
            <button type="submit" href="listO.php" class="btn">Pay Now</button>
        </form>

        <a href="listO.php" class="btn" style="background-color: #6c757d;">Return to List</a>
    </div>
</body>
</html>
