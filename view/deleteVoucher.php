<?php
include '../controller/voucherC.php';
$voucherManager = new VoucherV();

if (isset($_GET["code"])) {
    $voucherManager->deleteVoucher($_GET["code"]); 
    header('Location: listVoucher.php');  
    exit();  
}
?>
