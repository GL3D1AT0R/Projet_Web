<?php
include '../controller/itemC.php';

$error = "";
$item = null;
$itemController = new ItemController();

// Check if itemid exists in GET parameters for preloading form
if (isset($_GET['itemid'])) {
    $item = $itemController->showItem($_GET['itemid']);
}

// Handle form submission
if (
    isset($_POST["itemid"]) &&
    isset($_POST["quantity"]) &&
    isset($_POST["price"]) &&
    isset($_POST["orderid_fk"]) &&
    isset($_POST["productid_fk"])
) {
    if (
        !empty($_POST["itemid"]) &&
        !empty($_POST["quantity"]) &&
        !empty($_POST["price"]) &&
        !empty($_POST["orderid_fk"]) &&
        !empty($_POST["productid_fk"])
    ) {
        $item = new Item(
            $_POST["itemid"],
            $_POST["quantity"],
            $_POST["price"],
            $_POST["orderid_fk"],
            $_POST["productid_fk"]
        );

        $itemController->updateItem($item, $_POST["itemid"]);

        header('Location: listItem.php');
        exit();
    } else {
        $error = "Missing information";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Update Item</title>
    <link href="styles.css" rel="stylesheet">
    <script src="../view/scriptItem.js"></script>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="styles.css" rel="stylesheet">
    <link rel="stylesheet" href="min.css">
    <style>
        main {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            height: calc(100vh - 100px);
        }

        form {
            width: 60%;
            margin-top: 20px;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 5px;
        }

        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        #error {
            color: red;
            text-align: center;
            margin-top: 10px;
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
    <main>
        <button><a href="listItem.php">Back to list</a></button>
        <hr>

        <div id="error">
            <?php echo $error; ?>
        </div>

        <?php if ($item) { ?>
        <form action="" method="POST" novalidate>
            <table align="center">
                <tr>
                    <td><label for="itemid">Item ID:</label></td>
                    <td><input type="text" name="itemid" id="itemid" value="<?php echo htmlspecialchars($item['itemid']); ?>" readonly></td>
                </tr>
                <tr>
                    <td><label for="quantity">Quantity:</label></td>
                    <td><input type="number" name="quantity" id="quantity" value="<?php echo htmlspecialchars($item['quantity']); ?>"></td>
                </tr>
                <tr>
                    <td><label for="price">Price:</label></td>
                    <td><input type="number" name="price" id="price" step="0.01" value="<?php echo htmlspecialchars($item['price']); ?>"></td>
                </tr>
                <tr>
                    <td><label for="orderid_fk">Order ID:</label></td>
                    <td><input type="number" name="orderid_fk" id="orderid_fk" value="<?php echo htmlspecialchars($item['orderid_fk']); ?>"></td>
                </tr>
                <tr>
                    <td><label for="productid_fk">Product ID:</label></td>
                    <td><input type="number" name="productid_fk" id="productid_fk" value="<?php echo htmlspecialchars($item['productid_fk']); ?>"></td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <input type="submit" name="submit" value="Update">
                    </td>
                </tr>
            </table>
        </form>
        <?php } else { ?>
            <p>No item found. Please check the item ID.</p>
        <?php } ?>
    </main>
</body>
</html>
