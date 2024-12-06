<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include '../controller/voucherC.php';

$voucherManager = new VoucherV();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $code = $_POST['code'];
    $perc = $_POST['perc'];
   

        $voucher = new Voucher($code, $perc);
        $voucherManager->addVoucher($voucher);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Voucher</title>
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
            max-width: 600px;
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
        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-top: 5px;
        }

        /* Focus effect on input fields */
        input[type="text"]:focus, input[type="number"]:focus {
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
     
    </center>
    <div class="form-container">
        <h2 class="text-center">Add Voucher</h2>

        <form action="" method="POST" enctype="multipart/form-data">

            <table>
                <tr>
                    <td><label for="code">Voucher Code:</label></td>
                    <td><input type="text" name="code" id="code"></td>
                </tr>
                <tr>
                    <td><label for="perc">Discount Percentage:</label></td>
                    <td><input type="number" name="perc" id="perc"></td>
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

</body>
</html>
