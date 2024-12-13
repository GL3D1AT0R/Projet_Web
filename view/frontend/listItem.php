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
    <meta name="description" content="">
    <meta name="author" content="">
    <title>CropCortex E-commerce</title>
    <link rel="stylesheet" href="Order.css">
    <title>CropCortex E-commerce</title>
    <link rel="stylesheet" href="Order.css">
    <style>
       .page-body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        .order-container {
    margin: 20px auto;
    padding: 20px;
    max-width: 700px;
    background-color: #2a2a2a;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

        .order-header {
            text-align: center;
            font-size: 28px;
            color: ##eaf4ff;
            margin-bottom: 15px;
        }

        .no-items-message {
            text-align: center;
            font-size: 18px;
            color: #7f8c8d;
            margin-top: 20px;
        }

        .items-list {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .item-card {
            background-color: #a5f9d8;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 15px;
            transition: transform 0.2s ease-in-out;
        }

        .item-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }

        .item-title {
            font-size: 20px;
            color: #34495e;
            margin-bottom: 10px;
        }

        .item-detail {
            font-size: 16px;
            color: #7f8c8d;
            margin: 5px 0;
        }

        .button-container {
            text-align: right;
            margin-top: 15px;
        }

        .back-button {
            text-decoration: none;
            padding: 10px 15px;
            color: #ffffff;
            background-color: #66FF00;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .back-button:hover {
            background-color: #3f9904;
        }
        .print-button {
            text-decoration: none;
            padding: 10px 15px;
            color: #ffffff;
            background-color: #c000ff;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .print-button:hover {
            background-color: #4b0064;
        }
    </style>
</head>

<body>
    

<aside class="sidebar">
            <div class="header-container">
                <div class="Logo">
                    <a href="file:///C:/Users/yomna/OneDrive/Bureau/2A14/projet%20web/frontend%20produit/main/main.html">
                    <img src="logo site.png" alt="logo" height="90px" width="90px"> 
                    </a>
                </div>
                <div class="User">
                    <a href="file:///C:/Users/yomna/OneDrive/Bureau/2A14/projet%20web/frontend%20produit/user/user.html">
                    <img src="user.png" alt="user" height="60px" width="60px">
                    </a>
                </div>
            </div>
            <div class="sidebar-menu">
            <ul>
                    <li>
                        <span class="menu-item has-submenu">Go Back ▾</span>
                        <ul class="submenuL">
                            <li>Home</li>
                            <li>Prix</li>
                            <li>Stock</li>
                            <li><a href="listO.php">Order</a></li>

                    </li>
                    
                </ul>
            </div>
            <footer>
                <p>© 2024 CROPCORTEX. All rights reserved.</p>
            </footer>
        </aside>
        
    
        <main>
    
        <header class="header">
            <input type="text" placeholder="What are you looking for?" class="search-bar">
            <div class="search-icon">
                <img src="search.png" alt="search" height="40px" width="40px">
            </div>
            <div class="cart-icon">
                <a href="listO.php">
    <img src="panier .png" alt="panier" height="40px" width="40px">
</a>
                </a>
            </div>    
        </header>
     
      
        <div class="order-container">
        <h4 class="order-header">Items for Order #<?= $orderid ?></h4>

        <!-- Display message if no items are found -->
        <?php if (empty($items)): ?>
            <p class="no-items-message">No items found for this order.</p>
        <?php else: ?>
            <div class="items-list">
                <?php foreach ($items as $item): ?>
                    <div class="item-card">
                        <h3 class="item-title">Item #<?= $item['itemid']; ?></h3>
                        <p class="item-detail"><strong>Quantity:</strong> <?= $item['quantity']; ?></p>
                        <p class="item-detail"><strong>Price:</strong> <?= $item['price']; ?> USD</p>
                        <div class="button-container">
                            <a href="listO.php" class="back-button">Retour</a>
                            <a href="print.php?id=<?= $item['orderid_fk']; ?>" class="print-button">Print Item</a>
                            

                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
    </main>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const submenus = document.querySelectorAll(".has-submenu");
            submenus.forEach(menu => {
                menu.addEventListener("click", function () {
                    this.classList.toggle("active");
                    const submenu = this.nextElementSibling;
                    submenu.style.display = submenu.style.display === "block" ? "none" : "block";
                });
            });
        });
    </script>
     <script>
        document.addEventListener("DOMContentLoaded", function() {
            const submenus = document.querySelectorAll(".has-submenu");
            
            submenus.forEach(menu => {
                menu.addEventListener("click", function() {
                    this.classList.toggle("active");
                    const submenu = this.nextElementSibling;
                    submenu.style.display = submenu.style.display === "block" ? "none" : "block";
                });
            });
        });
    </script>
    <script> 
</body>

</html>