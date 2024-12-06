<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../controller/itemC.php';
include '../controller/orderC.php'; // Include controller for orders

$itemManager = new ItemController();
$orderManager = new OrderP(); // Assuming you have a controller for orders

// Fetch all orders to populate the combobox
$orders = $orderManager->listOrders(); // Ensure this method fetches orders from the database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $orderid_fk = $_POST['orderid_fk'];
    $productid_fk = $_POST['productid_fk'];

    // Validate form inputs
    if (!is_numeric($quantity) || $quantity <= 0) {
        echo '<script>alert("Please enter a valid quantity.");</script>';
    } elseif (!is_numeric($price) || $price <= 0) {
        echo '<script>alert("Please enter a valid price.");</script>';
    } elseif (empty($orderid_fk)) {
        echo '<script>alert("Please select a valid order.");</script>';
    } elseif (!is_numeric($productid_fk) || $productid_fk <= 0) {
        echo '<script>alert("Please enter a valid product ID.");</script>';
    } else {
        // Create an Item object and add it to the database
        $item = new Item(null, $quantity, $price, $orderid_fk, $productid_fk);
        $itemManager->addItem($item);
        echo '<script>alert("Item successfully added!");</script>';
        header('Location: listItem.php');  

    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Item</title>
    <link href="styles.css" rel="stylesheet">
    <script src="../view/scriptItem.js"></script>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="styles.css" rel="stylesheet">
    <link rel="stylesheet" href="min.css">
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
    <div id="content">
        <center>
            <h4><a href="addItem.php" class="button-link">Ajouter un Item</a></h4>
        </center>
        <form action="" method="POST" onsubmit="return validateForm();" novalidate>
            <table border="1" align="center">
                <tr>
                    <td><label for="quantity">Quantity:</label></td>
                    <td><input type="number" name="quantity" id="quantity" min="1"></td>
                </tr>
                <tr>
                    <td><label for="price">Price:</label></td>
                    <td><input type="number" name="price" id="price" step="0.01" min="0.01"></td>
                </tr>
                <tr>
                    <td><label for="orderid_fk">Order:</label></td>
                    <td>
                        <select name="orderid_fk" id="orderid_fk">
                            <option value="">Select an Order</option>
                            <?php foreach ($orders as $order) : ?>
                                <option value="<?php echo $order['id']; ?>">
                                    <?php echo htmlspecialchars($order['nom']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="productid_fk">Product ID:</label></td>
                    <td><input type="number" name="productid_fk" id="productid_fk"></td>
                </tr>
                <tr align="center">
                    <td><input type="submit" value="Save"></td>
                    <td><input type="reset" value="Reset"></td>
                </tr>
            </table>
        </form>
    </div>
    <script>
        function validateForm() {
            var quantity = document.getElementById('quantity').value;
            var price = document.getElementById('price').value;
            var orderid_fk = document.getElementById('orderid_fk').value;
            var productid_fk = document.getElementById('productid_fk').value;

            if (quantity.trim() === '' || isNaN(quantity) || quantity <= 0) {
                alert('Please enter a valid quantity.');
                return false;
            }

            if (price.trim() === '' || isNaN(price) || price <= 0) {
                alert('Please enter a valid price.');
                return false;
            }

            if (orderid_fk.trim() === '') {
                alert('Please select a valid order.');
                return false;
            }

            if (productid_fk.trim() === '' || isNaN(productid_fk) || productid_fk <= 0) {
                alert('Please enter a valid product ID.');
                return false;
            }

            return true;
        }
    </script>
</body>
</html>
