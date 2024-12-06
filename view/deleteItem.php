<?php
include '../controller/itemC.php';
$ItemController = new ItemController();

if (isset($_GET["itemid"])) {
    $ItemController->deleteItem($_GET["itemid"]); 
    header('Location: listItem.php');  
    exit();  
}
?>
