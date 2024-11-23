<?php
include '../controller/orderC.php';
$PackController = new OrderP();

if (isset($_GET["id"])) {
    $PackController->deleteOrder($_GET["id"]); 
    header('Location: listO.php');  
    exit();  
}
?>
