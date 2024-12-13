<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'C:\xampp\htdocs\projetghaith\controller\orderC.php';

$orderManager = new OrderP();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $address = $_POST['address'];
    $address2 = $_POST['address2'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $payment = $_POST['payment'];

        $order = new Order(null, $nom, $prenom, $address, $address2, $email, $phone, $payment);
        $orderManager->addOrder($order);
        header('Location: listO.php');
        exit();
    } else {
        $error = "Missing information";
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CropCortex E-commerce</title>
    <link rel="stylesheet" href="Order.css">
<style>
    .form-container {
            width: 100%;
            max-width: 600px;
            background: #4b4b4b;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #ffffff;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 15px;
        }

        .form-group label {
            margin-bottom: 5px;
            font-weight: bold;
            color: #ffffff;
        }

        .form-group input,
        .form-group select {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: #007BFF;
            outline: none;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        .form-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }

        .form-actions button {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            color: #fff;
        }

        .form-actions .btn-submit {
            background-color: #66FF00;
        }

        .form-actions .btn-submit:hover {
            background-color: #98ff53;
        }

        .form-actions .btn-reset {
            background-color: #dc3545;
        }

        .form-actions .btn-reset:hover {
            background-color: #c82333;
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
        <div class="main">
            <div class="order-details">
                <h2>Your Order Details</h2>
                <img src="totamte.png" alt="Tomato" style="width:50%; border-radius: 5px;">
                <p>Price: D.T 3.00</p>
                <h3>1 Kg</h3>
                
            </div>  
      
            <div class="form-container">
        <h2>Registration Form</h2>
        <form action="" method="POST" enctype="multipart/form-data" onsubmit="return validateForm();" novalidate>
            <div class="form-group">
                <label for="nom">Nom:</label>
                <input type="text" name="nom" id="nom">
            </div>

            <div class="form-group">
                <label for="prenom">Prénom:</label>
                <input type="text" name="prenom" id="prenom">
            </div>

            <div class="form-group">
                <label for="address">Adresse:</label>
                <input type="text" name="address" id="address">
            </div>

            <div class="form-group">
                <label for="address2">Adresse 2:</label>
                <input type="text" name="address2" id="address2">
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email">
            </div>

            <div class="form-group">
                <label for="phone">Téléphone:</label>
                <input type="text" name="phone" id="phone">
            </div>

            <div class="form-group">
                <label for="payment">Méthode de paiement:</label>
                <select name="payment" id="payment">
                    <option value="credit_card">Carte de Crédit</option>
                    <option value="paypal">PayPal</option>
                    <option value="cash">Espèces</option>
                </select>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">Save</button>
                <button type="reset" class="btn-reset">Reset</button>
            </div>
        </form>
    </div>

        </div>
    </main>

   
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
    
function validateForm() {
    var nom = document.getElementById('nom').value;
    var prenom = document.getElementById('prenom').value;
    var email = document.getElementById('email').value;
    var phone = document.getElementById('phone').value;
    var address = document.getElementById('address').value;
    var address2 = document.getElementById('address2').value;
    var payment = document.getElementById('payment').value;

    if (nom.trim() === '') {
        alert('Please enter your name.');
        return false;
    }

    if (prenom.trim() === '') {
        alert('Please enter your surname.');
        return false;
    }

    var emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if (email.trim() === '') {
        alert('Please enter an email address.');
        return false;
    } else if (!emailPattern.test(email)) {
        alert('Please enter a valid email address.');
        return false;
    }

    if (phone.trim() === '') {
        alert('Please enter your phone number.');
        return false;
    }

    if (address.trim() === '') {
        alert('Please enter your address.');
        return false;
    }

    if (address2.trim() === '') {
        alert('Please enter a second address (optional).');
        return false;
    }

    if (payment.trim() === '') {
        alert('Please enter your payment method.');
        return false;
    }

    return true;
}

    </script>
</body>
</html>
