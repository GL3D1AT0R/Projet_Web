<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../../controller/orderC.php';

$OrderController = new OrderP();
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
$sortOrder = isset($_GET['sortOrder']) ? $_GET['sortOrder'] : '';

if (!empty($searchTerm)) {
    $orders = $OrderController->search($searchTerm);
} elseif (!empty($sortOrder)) {
    $orders = $OrderController->sortS($sortOrder);
} else {
    $orders = $OrderController->listOrders(); 
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $voucherCode = $_POST['voucherCode'] ?? null;
    $orderId = $_POST['orderId'] ?? null;

    if ($orderId) {
        $checkoutResult = $OrderController->checkout($orderId, $voucherCode);
        if (isset($checkoutResult['error'])) {
            $errorMessage = $checkoutResult['error'];
        } else {
            $successMessage = "Checkout successful! Final Price: " . $checkoutResult['final_price'];
        }
    }
}
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
        .custom-button {
            background-color: #66ff00;
            color: rgb(255, 255, 255);
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            cursor: pointer;
            font-family: Arial, sans-serif;
            font-size: 21px;
            margin-bottom: 15px;
        }
        
        .custom-button:hover {
            opacity: 0.8;
        }
/*-------------------------------------------------------------------------------------------------------------*/
/* Header Container */
.custom-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 10px 20px;
    background-color: #2a2a2a;
    /* border-bottom: 1px solid #ddd; */
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    margin-bottom: 21px;
}

/* Search Form */
.custom-search {
    flex-grow: 1; /* Makes the search bar take available space */
    max-width: 600px; /* Restrict the maximum width of the search form */
}

.custom-search-form {
    display: flex;
    align-items: center;
    gap: 10px;
}

.custom-search-bar {
    flex: 1;
    padding: 10px 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
    transition: border-color 0.3s, box-shadow 0.3s;
}

.custom-search-bar:focus {
    outline: none;
    border-color: #66ff00;
    box-shadow: 0 0 6px #66ff00;
}

.custom-search-button {
    background-color: #66ff00;
    color: #fff;
    border: none;
    padding: 8px 16px;
    border-radius: 5px;
    font-size: 14px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.custom-search-button:hover {
    background-color: #55cc00;
}

/* Icons Container */
.custom-header-icons {
    display: flex;
    align-items: center;
    gap: 20px; /* Space between the icons */
}

.custom-header-icons img {
    cursor: pointer;
    transition: transform 0.3s;
}

.custom-header-icons img:hover {
    transform: scale(1.1); /* Slight zoom on hover */
}

/* Responsive Design */
@media (max-width: 768px) {
    .custom-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 15px;
    }

    .custom-search {
        width: 100%;
    }

    .custom-header-icons {
        justify-content: flex-start;
    }
}
/*----------------------------------------------------------*/
/* Success Message Styling */
.success-message {
    color: #28a745;
    font-size: 18px;
    font-weight: bold;
    text-align: center;
    margin-bottom: 20px;
    margin-top: 20px;
}

/* Pay Now Button Container */
.pay-now-container {
    display: flex;
    justify-content: center; /* Center the button */
    margin-top: 10px; /* Add space between the button and previous content */
}

/* Pay Now Button Styling */
.pay-now-button {
    background-color: #007bff; /* Blue background */
    color: white; /* White text */
    text-decoration: none;
    padding: 10px 20px; /* Adjust padding for size */
    font-size: 16px;
    font-weight: bold;
    border-radius: 5px;
    text-align: center;
    transition: background-color 0.3s, transform 0.2s;
    width: auto; /* Allow button to shrink to fit content */
    display: inline-block; /* Ensure size consistency */
}

.pay-now-button:hover {
    background-color: #0056b3; /* Darker blue on hover */
    transform: scale(1.05); /* Slight zoom on hover */
}

.pay-now-button:active {
    background-color: #004494; /* Even darker blue when clicked */
    transform: scale(0.98); /* Slight shrink effect on click */
}

/* Add Space Between Elements */
.success-message + .pay-now-container {
    margin-top: 15px; /* Ensure spacing between success message and button */
}
/*----------------------------------------------*/
button {
    background-color: #346513;
    color: rgb(255, 255, 255);
    padding: 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}
/*-------------------------------------------------------------------------------------------------------*/
/* Base Button Styling */
a {
    display: inline-block;
    text-decoration: none; /* Remove the underline */
    padding: 10px 20px;
    font-size: 16px;
    font-weight: bold;
    border-radius: 5px;
    text-align: center;
    transition: transform 0.3s ease;
}

/* Annuler Button (Red) */
.annuler-button {
    background-color: #dc3545; /* Red background */
    color: white;
}

.annuler-button:hover {
    transform: scale(0.8); /* Shrink effect on hover */
    background-color: #c82333; /* Darker red */
}

/* Consulter Items Button (Green) */
.consulter-button {
    background-color: #28a745; /* Green background */
    color: white;
}

.consulter-button:hover {
    transform: scale(0.8); /* Shrink effect on hover */
    background-color: #218838; /* Darker green */
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
            <!--
            <div class="User">
                <a href="file:///C:/Users/yomna/OneDrive/Bureau/2A14/projet%20web/frontend%20produit/user/user.html">
                    <img src="user.png" alt="user" height="60px" width="60px">
                </a>
            </div>  -->
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
    <header class="custom-header">
    <div class="custom-search">
        <form action="listO.php" method="GET" class="custom-search-form">
            <input 
                type="text" 
                name="search" 
                class="custom-search-bar" 
                placeholder="Search by nom" 
                value="<?= htmlspecialchars($searchTerm) ?>"
            >
            <button class="custom-search-button" type="submit">Search</button>
        </form>
    </div>
    <div class="custom-header-icons">
        <div class="search-icon">
            <img src="search.png" alt="search" height="40px" width="40px">
        </div>
       
    </div>
</header>


        <center>
             <h4>
             <a href="addO.php" class="custom-button">Ajouter une Commande</a>
             </h4>

            <div>
  <form method="GET" action="listO.php">
    <button type="submit" name="sortOrder" value="niveau_asc" class="btn btn-primary">Sort by Completed (Asc)</button>
    <button type="submit" name="sortOrder" value="niveau_desc" class="btn btn-primary">Sort by pending (Desc)</button>
  </form>
</div>     
        </center>
        <?php if (!empty($successMessage)): ?>
            <div class="success-message">
    <?= htmlspecialchars($successMessage) ?>
</div>
<div class="pay-now-container">
    <a href="checkout.php" class="pay-now-button">Pay Now</a>
</div>


        <?php endif; ?>

        <?php if (!empty($errorMessage)): ?>
            <div style="color: red; text-align: center;"><?= htmlspecialchars($errorMessage) ?></div>
        <?php endif; ?>
        <!-- Displaying orders vertically -->
        <div class="order-container">
            <?php foreach ($orders as $order): ?>
                <div class="order-card">
                    <h3>Commande #<?= $order['id']; ?></h3>
                    <p><strong>Nom:</strong> <?= $order['nom']; ?></p>
                    <p><strong>Email:</strong> <?= $order['email']; ?></p>
                    <p><strong>Téléphone:</strong> <?= $order['phone']; ?></p>
                    <p><strong>Mode de Paiement:</strong> <?= $order['payment']; ?></p>
                    <p><strong>Statut :</strong> <?= $order['status']; ?></p>
                    <form method="POST" class="buttons">
                        <input type="hidden" name="orderId" value="<?= $order['id']; ?>">
                        <input type="text" name="voucherCode" placeholder="Voucher Code" style="margin-bottom: 10px; padding: 5px;">
                        <button type="submit">Checkout</button>
                    </form>
                    <a href="deleteO.php?id=<?= $order['id']; ?>" class="annuler-button">Annuler</a>
                    <a href="listItem.php?id=<?= $order['id']; ?>" class="consulter-button">Consulter Items</a>


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
