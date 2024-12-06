<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../controller/orderC.php';

$OrderController = new OrderP();
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
$sortOrder = isset($_GET['sortOrder']) ? $_GET['sortOrder'] : '';

if (!empty($searchTerm)) {
    $orders = $OrderController->search($searchTerm);
} elseif (!empty($sortOrder)) {
    $orders = $OrderController->sort($sortOrder);
} else {
    $orders = $OrderController->listOrders(); 
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

    <title>Gestion Des Ordres</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="styles.css" rel="stylesheet">
    <link rel="stylesheet" href="min.css">

    <style>
        /* Centering the table and making the link aligned to the top left */
   
        main {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            height: calc(100vh - 100px);
        }

        table {
            border-collapse: collapse;
            width: 80%;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            color: #333;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .button-container {
            margin-top: 20px;
        }

        button {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
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
        <div class="input-group-prepend">
        <form action="listO.php" method="GET" class="search-container mb-4">
            <input type="text" name="search" class="form-control" placeholder="Search by nom" value="<?= htmlspecialchars($searchTerm) ?>">
            
            <!-- Search Button -->
            <button class="btn btn-primary" type="submit">Search</button>
           
        </form>
    </div>
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
    <li class="nav-item">
        <a class="nav-link collapsed" href="listVoucher.php" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Gestion Vouchers</span>
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
    <h1>List of Orders</h1>
        <div class="button-container">
            <button><a href="addO.php" style="color: white;">Add New Order</a></button>
        </div>
<br> <br>
    <div>
  <form method="GET" action="listO.php">
    <button type="submit" name="sortOrder" value="niveau_asc" class="btn btn-primary">Sort by prenom (Asc)</button>
    <button type="submit" name="sortOrder" value="niveau_desc" class="btn btn-primary">Sort by prenom (Desc)</button>
  </form>
</div>     </center>

    <table border="1" align="center" width="70%">
        <thead>
            <tr>
                <th>Id Commande</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Adresse</th>
                <th>Adresse 2</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Mode de Paiement</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): ?> <!-- Loop through each order to display its details -->
                <tr>
                    <td><?= $order['id']; ?></td>
                    <td><?= $order['nom']; ?></td>
                    <td><?= $order['prenom']; ?></td>
                    <td><?= $order['address']; ?></td>
                    <td><?= $order['address2']; ?></td>
                    <td><?= $order['email']; ?></td>
                    <td><?= $order['phone']; ?></td>
                    <td><?= $order['payment']; ?></td>

                    <!-- Update button -->
                    <td align="center">
                        <form method="POST" action="editO.php">
                            <input type="submit" name="update" value="Update" class="btn btn-primary">
                            <input type="hidden" value="<?= $order['id']; ?>" name="id">
                        </form>
                    </td>

                    <!-- Delete button -->
                    <td>
                    <a href="deleteO.php?id=<?php echo $order['id']; ?> " class="btn btn-primary">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>
