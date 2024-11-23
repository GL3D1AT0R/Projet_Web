<?php
include '../controller/orderC.php';

$error = "";
$order = null;

$orderController = new orderP();

if (
    isset($_POST["id"]) &&
    isset($_POST["nom"]) &&
    isset($_POST["prenom"]) &&
    isset($_POST["address"]) &&
    isset($_POST["address2"]) &&
    isset($_POST["email"]) &&
    isset($_POST["phone"]) &&
    isset($_POST["payment"])
) {
    if (
        !empty($_POST["id"]) &&
        !empty($_POST['nom']) &&
        !empty($_POST["prenom"]) &&
        !empty($_POST["address"]) &&
        !empty($_POST["email"]) &&
        !empty($_POST["phone"]) &&
        !empty($_POST["payment"])
    ) {
        $order = new Order(
            $_POST['id'],
            $_POST['nom'],
            $_POST['prenom'],
            $_POST['address'],
            $_POST['address2'],
            $_POST['email'],
            $_POST['phone'],
            $_POST['payment']
        );

        $orderController->updateOrder($order, $_POST["id"]);

        header('Location: listO.php');
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
    <title>Update Order</title>
    <link href="styles.css" rel="stylesheet">
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

        input[type="text"], input[type="email"], input[type="tel"] {
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
        <script src="scriptOrder.js" defer></script>

</head>
<body>
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
    <main>
        <button><a href="listO.php">Back to list</a></button>
        <hr>

        <div id="error">
            <?php echo $error; ?>
        </div>

        <?php
        if (isset($_POST['id'])) {
            $order = $orderController->showOrder($_POST['id']);
        ?>
        <form action="" method="POST" novalidate>
            <table align="center">
                <tr>
                    <td><label for="id">Order ID:</label></td>
                    <td><input type="text" name="id" id="id" value="<?php echo $order['id']; ?>" readonly></td>
                </tr>
                <tr>
                    <td><label for="nom">Nom:</label></td>
                    <td><input type="text" name="nom" id="nom" value="<?php echo $order['nom']; ?>"></td>
                </tr>
                <tr>
                    <td><label for="prenom">Prenom:</label></td>
                    <td><input type="text" name="prenom" id="prenom" value="<?php echo $order['prenom']; ?>"></td>
                </tr>
                <tr>
                    <td><label for="address">Address:</label></td>
                    <td><input type="text" name="address" id="address" value="<?php echo $order['address'] ?>"></td>
                </tr>
                <tr>
                    <td><label for="address2">Address 2:</label></td>
                    <td><input type="text" name="address2" id="address2" value="<?php echo $order['address2']; ?>"></td>
                </tr>
                <tr>
                    <td><label for="email">Email:</label></td>
                    <td><input type="email" name="email" id="email" value="<?php echo $order['email']; ?>"></td>
                </tr>
                <tr>
                    <td><label for="phone">Phone:</label></td>
                    <td><input type="tel" name="phone" id="phone" value="<?php echo $order['phone']; ?>"></td>
                </tr>
                <tr>
                    <td><label for="payment">Payment:</label></td>
                    <td><input type="text" name="payment" id="payment" value="<?php echo $order['payment']; ?>"></td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <input type="submit" name="submit" value="Update">
                    </td>
                </tr>
            </table>
        </form>
        <?php } ?>
    </main>
</body>
</html>
