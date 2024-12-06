<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include '../controller/orderC.php';

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
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Order</title>
    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="styles.css" rel="stylesheet">
    <link rel="stylesheet" href="min.css">
    <script src="../view/scriptOrder.js"></script>

    <style>
        /* Body styling */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f1f8ff;
            margin: 0;
            padding: 0;
        }

        /* Form container styling */
        .form-container {
            background-color: white;
            max-width: 700px;
            margin: 50px auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Table styling */
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        /* Table row styling */
        td {
            padding: 10px;
            text-align: left;
            font-size: 16px;
        }

        /* Label styling */
        label {
            font-weight: bold;
            color: #333;
        }

        /* Input fields styling */
        input[type="text"], input[type="email"], input[type="number"], select {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-top: 5px;
        }

        /* Focus effect on input fields */
        input[type="text"]:focus, input[type="email"]:focus, input[type="number"]:focus, select:focus {
            border-color: #007bff;
            outline: none;
        }

        /* Submit and reset button styling */
        input[type="submit"], input[type="reset"] {
            background-color: #007bff;
            color: white;
            font-size: 16px;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        /* Hover effect for buttons */
        input[type="submit"]:hover, input[type="reset"]:hover {
            background-color: #0056b3;
        }

        /* Align buttons */
        .button-container {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }
    </style>
</head>
<body id="page-top">
    
 <!-- Page Wrapper -->
 <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dach.html">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3">CorpCortex <sup></sup></div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="dach.html">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Interface
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="listO.php" data-toggle="collapse" data-target="#collapseUtilities"
                aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-wrench"></i>
                <span>Gestion Ordres</span>
            </a>
        </li>
        <li class="nav-item">
        <a class="nav-link collapsed" href="listItem.php" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Gestion Items</span>
        </a>
    </li>
        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Addons
        </div>

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>
            </nav>
    <!-- Centered heading and link to add a new order -->
    <center>
     
    </center>
    <div class="form-container">
        <h2 class="text-center">Add Order</h2>

        <!-- Form for Adding Order -->
        <form action="" method="POST" enctype="multipart/form-data" onsubmit="return validateForm();" novalidate>

            <table>
                <tr>
                    <td><label for="nom">Nom:</label></td>
                    <td><input type="text" name="nom" id="nom"></td>
                </tr>
                <tr>
                    <td><label for="prenom">Prénom:</label></td>
                    <td><input type="text" name="prenom" id="prenom"></td>
                </tr>
                <tr>
                    <td><label for="address">Adresse:</label></td>
                    <td><input type="text" name="address" id="address"></td>
                </tr>
                <tr>
                    <td><label for="address2">Adresse 2:</label></td>
                    <td><input type="text" name="address2" id="address2"></td>
                </tr>
                <tr>
                    <td><label for="email">Email:</label></td>
                    <td><input type="email" name="email" id="email"></td>
                </tr>
                <tr>
                    <td><label for="phone">Téléphone:</label></td>
                    <td><input type="text" name="phone" id="phone"></td>
                </tr>
                <tr>
                    <td><label for="payment">Méthode de paiement:</label></td>
                    <td>
                        <select name="payment" id="payment">
                            <option value="credit_card">Carte de Crédit</option>
                            <option value="paypal">PayPal</option>
                            <option value="cash">Espèces</option>
                        </select>
                    </td>
                </tr>
            </table>

            <div class="button-container">
                <input type="submit" value="Save">
                <input type="reset" value="Reset">
            </div>

        </form>
    </div>
    </div>
</div>
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
