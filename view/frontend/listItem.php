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
        /* Add your styles here for the new layout */
        .order-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
            margin: 20px;
        }

        .order-card {
            width: 70%;
            background-color: rgba(255, 255, 255, 0.8); /* Transparent white background */
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: left;
        }

        .order-card h3 {
            margin-bottom: 15px;
            color: #333;
        }

        .order-card p {
            margin: 5px 0;
        }

        .order-card .buttons {
            margin-top: 15px;
        }

        .order-card .buttons a {
            text-decoration: none;
            padding: 10px 15px;
            color: white;
            border-radius: 5px;
            background-color: #ff6347; /* Tomato color for delete button */
            transition: background-color 0.3s ease;
        }

        .order-card .buttons a:hover {
            background-color: #ff4500; /* Darker tomato color */
        }
    </style>
    <style>
        /* Add your styles here */
        .item-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
            margin: 20px;
        }

        .item-card {
            width: 70%;
            background-color: rgba(255, 255, 255, 0.8); /* Transparent white background */
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: left;
        }

        .item-card h3 {
            margin-bottom: 15px;
            color: #333;
        }

        .item-card p {
            margin: 5px 0;
        }

        .item-card .buttons {
            margin-top: 15px;
        }

        .item-card .buttons a {
            text-decoration: none;
            padding: 10px 15px;
            color: white;
            border-radius: 5px;
            background-color: #ff6347; /* Tomato color for delete button */
            transition: background-color 0.3s ease;
        }

        .item-card .buttons a:hover {
            background-color: #ff4500; /* Darker tomato color */
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
     
      
            <div class="form-container">
    

        <center>
            <h4>Items for Order #<?= $orderid ?></h4>
            <!-- If no items found, display a message -->
            <?php if (empty($items)): ?>
                <p>No items found for this order.</p>
            <?php else: ?>
                <!-- Display the items related to the order -->
                <div class="item-container">
                    <?php foreach ($items as $item): ?>
                        <div class="item-card">
                            <h3>Item #<?= $item['itemid']; ?></h3>
                            <p><strong>Quantity:</strong> <?= $item['quantity']; ?></p>
                            <p><strong>Price:</strong> <?= $item['price']; ?> USD</p>
                            <div class="buttons">
                                <a href="listO.php">Retour</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </center>
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
