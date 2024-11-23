<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../controller/orderC.php';

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
            height: calc(100vh - 100px); /* Adjust the height to keep the table vertically centered */
        }

        table {
            margin-top: 20px; /* Space between link and table */
            width: 80%; /* Adjust the table width as needed */
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
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
        <h4>
            <a href="addO.php" class="button-link">Ajouter un Ordre</a>
        </h4>
    </center>

    <!-- Table displaying orders -->
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
                            <input type="submit" name="update" value="Update" class="button-link">
                            <input type="hidden" value="<?= $order['id']; ?>" name="id">
                        </form>
                    </td>

                    <!-- Delete button -->
                    <td>
                    <a href="deleteO.php?id=<?php echo $order['id']; ?>">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>