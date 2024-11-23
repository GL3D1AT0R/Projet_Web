<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../../controller/orderC.php';

$OrderController = new OrderP();
$orders = $OrderController->listOrders();
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
                        <li>Order</li>
                    </ul>
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
                <a href="file:///C:/Users/yomna/OneDrive/Bureau/2A14/projet%20web/frontend%20produit/panier/panier.html">
                    <img src="panier .png" alt="panier" height="40px" width="40px">
                </a>
            </div>
        </header>

        <center>
            <h4>
                <a href="addO.php" class="button-link">Ajouter une Commande</a>
            </h4>
        </center>

        <!-- Displaying orders vertically -->
        <div class="order-container">
            <?php foreach ($orders as $order): ?>
                <div class="order-card">
                    <h3>Commande #<?= $order['id']; ?></h3>
                    <p><strong>Nom:</strong> <?= $order['nom']; ?></p>
                    <p><strong>Prénom:</strong> <?= $order['prenom']; ?></p>
                    <p><strong>Adresse:</strong> <?= $order['address']; ?></p>
                    <p><strong>Adresse 2:</strong> <?= $order['address2']; ?></p>
                    <p><strong>Email:</strong> <?= $order['email']; ?></p>
                    <p><strong>Téléphone:</strong> <?= $order['phone']; ?></p>
                    <p><strong>Mode de Paiement:</strong> <?= $order['payment']; ?></p>
                    <div class="buttons">
                        <a href="deleteO.php?id=<?= $order['id']; ?>">Annuler</a>
                    </div>
                </div>
            <?php endforeach; ?>
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
</body>

</html>
