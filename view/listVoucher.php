<?php
include '../controller/voucherC.php';

$voucherController = new VoucherV();

    $vouchers = $voucherController->listVouchers();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Vouchers</title>
    <link href="styles.css" rel="stylesheet">
    <script src="../view/scriptItem.js"></script>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
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
    <main>
   
        <h1>List of Vouchers</h1>
        <div class="button-container">
            <button><a href="addVoucher.php" style="color: white;">Add New  Voucher</a></button>
        </div>
        <br>
            <table>
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Percentage</th>
                
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($vouchers)) : ?>
                    <?php foreach ($vouchers as $voucher) : ?>
                        <tr>
                            <td><?php echo $voucher['code']; ?></td>
                            <td><?php echo $voucher['perc']; ?></td>
                            <td>
                                <a href="deleteVoucher.php?code=<?php echo $voucher['code']; ?>" class="btn btn-primary" onclick="return confirm('Are you sure you want to delete this voucher?');">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="6" style="text-align: center;">No vouchers found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </main>
</body>
</html>
