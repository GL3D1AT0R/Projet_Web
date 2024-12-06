<?php

include 'C:\xampp\htdocs\projetghaith\config.php';
include 'C:\xampp\htdocs\projetghaith\model\voucher.php';

class VoucherV
{
    public function addVoucher($voucher) {
        $sql = "INSERT INTO voucher (code, perc)
                VALUES (:code, :perc)";
        $db = config::getConnexion();
    
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'code' => $voucher->getCode(),
                'perc' => $voucher->getPerc()
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function deleteVoucher($code)
    {
        $sql = "DELETE FROM voucher WHERE code = :code";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindParam(':code', $code);
            $query->execute();
        } catch (Exception $e) {
            error_log('Error : ' . $e->getMessage());
            echo 'An error occurred while deleting.';
        }
    }

    function listVouchers()
    {
        $sql = "SELECT * FROM voucher";
        $db = config::getConnexion();
        try {
            $query = $db->query($sql);
            $vouchers = $query->fetchAll(PDO::FETCH_ASSOC);
            return $vouchers ?: []; 
        } catch (Exception $e) {
            error_log('Error in vouchers: ' . $e->getMessage());
            echo 'An error occurred while fetching the vouchers.';
            return [];
        }
    }

}
