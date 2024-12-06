<?php

require_once 'C:\xampp\htdocs\projetghaith\config.php';
require_once 'C:\xampp\htdocs\projetghaith\model\order.php';

class OrderP
{
    public function addOrder($order) {
        $sql = "INSERT INTO ordres (nom, prenom, address, address2, email, phone, payment) 
                VALUES (:nom, :prenom, :address, :address2, :email, :phone, :payment)";
        $db = config::getConnexion();
    
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'nom' => $order->getNom(),
                'prenom' => $order->getPrenom(),
                'address' => $order->getAddress(),
                'address2' => $order->getAddress2(),
                'email' => $order->getEmail(),
                'phone' => $order->getPhone(),
                'payment' => $order->getPayment()
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    

    function updateOrder($order, $id)
    {
        $sql = "UPDATE ordres 
                SET nom = :nom, prenom = :prenom, address = :address, address2 = :address2, 
                    email = :email, phone = :phone, payment = :payment 
                WHERE id = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'id' => $id,
                'nom' => $order->getNom(),
                'prenom' => $order->getPrenom(),
                'address' => $order->getAddress(),
                'address2' => $order->getAddress2(),
                'email' => $order->getEmail(),
                'phone' => $order->getPhone(),
                'payment' => $order->getPayment(),
            ]);
        } catch (PDOException $e) {
            error_log('Error in updateOrder: ' . $e->getMessage());
            echo 'An error occurred while updating the order.';
        }
    }

    function deleteOrder($id)
    {
        $sql = "DELETE FROM ordres WHERE id = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindParam(':id', $id);
            $query->execute();
        } catch (Exception $e) {
            error_log('Error in deleteOrder: ' . $e->getMessage());
            echo 'An error occurred while deleting the order.';
        }
    }

    function listOrders()
    {
        $sql = "SELECT * FROM ordres";
        $db = config::getConnexion();
        try {
            $query = $db->query($sql);
            $orders = $query->fetchAll(PDO::FETCH_ASSOC);
            return $orders ?: []; // Return an empty array if no data
        } catch (Exception $e) {
            error_log('Error in listOrders: ' . $e->getMessage());
            echo 'An error occurred while fetching the orders.';
            return [];
        }
    }

    function showOrder($id)
    {
        $sql = "SELECT * FROM ordres WHERE id = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindParam(':id', $id);
            $query->execute();
            $order = $query->fetch(PDO::FETCH_ASSOC);
            return $order ?: null; // Return null if no order found
        } catch (Exception $e) {
            error_log('Error in showOrder: ' . $e->getMessage());
            echo 'An error occurred while fetching the order.';
        }
    }

    public function search($searchTerm)
{
    $sql = "SELECT * FROM ordres WHERE nom LIKE :searchTerm";
    $db = config::getConnexion();
    try {
        $query = $db->prepare($sql);
        $query->execute(['searchTerm' => '%' . $searchTerm . '%']);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

function sort($sortOrder = '')
{
$sql = "SELECT * FROM ordres";

if ($sortOrder) {
    switch ($sortOrder) {
        case 'niveau_asc':
            $sql .= " ORDER BY prenom ASC"; 
            break;
        case 'niveau_desc':
            $sql .= " ORDER BY prenom DESC"; 
            break;
        default:
            break;
    }
}

$db = config::getConnexion();
try {
    $query = $db->query($sql);
    $cours = $query->fetchAll(PDO::FETCH_ASSOC);
    return $cours; 
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
}
public function applyVoucher($orderId, $voucherCode)
{
    $db = config::getConnexion();

    try {
        $voucherSql = "SELECT perc FROM voucher WHERE code = :code";
        $voucherQuery = $db->prepare($voucherSql);
        $voucherQuery->execute(['code' => $voucherCode]);
        $voucher = $voucherQuery->fetch(PDO::FETCH_ASSOC);

        if (!$voucher) {
            throw new Exception('Invalid voucher code.');
        }

        $orderSql = "SELECT SUM(i.price * i.quantity) AS total 
                     FROM items i 
                     WHERE i.orderid_fk = :orderId";
        $orderQuery = $db->prepare($orderSql);
        $orderQuery->execute(['orderId' => $orderId]);
        $order = $orderQuery->fetch(PDO::FETCH_ASSOC);

        if (!$order || $order['total'] === null) {
            throw new Exception('Order not found or has no items.');
        }
        $totalPrice = $order['total'];
        $discount = ($totalPrice * $voucher['perc']) / 100;
        $finalPrice = $totalPrice - $discount;
        return [
            'original_price' => $totalPrice,
            'discount' => $discount,
            'final_price' => $finalPrice
        ];
    } catch (Exception $e) {
        error_log('Error in applyVoucher: ' . $e->getMessage());
        return [
            'error' => $e->getMessage()
        ];
    }
}


public function checkout($orderId, $voucherCode = null)
{
    $db = config::getConnexion();

    try {
        $finalPriceData = $voucherCode ? $this->applyVoucher($orderId, $voucherCode) : null;

        if (isset($finalPriceData['error'])) {
            throw new Exception($finalPriceData['error']);
        }
        $finalPrice = $finalPriceData ? $finalPriceData['final_price'] : null;
        $updateSql = "UPDATE ordres SET final_price = :final_price, status = 'completed' WHERE id = :orderId";
        $updateQuery = $db->prepare($updateSql);
        $updateQuery->execute([
            'final_price' => $finalPrice,
            'orderId' => $orderId
        ]);
        return [
            'success' => true,
            'final_price' => $finalPrice
        ];
    } catch (Exception $e) {
        error_log('Error in checkout: ' . $e->getMessage());
        return [
            'error' => $e->getMessage()
        ];
    }
}
//tri statut 

function sortS($sortOrder = '')
{
$sql = "SELECT * FROM ordres";

if ($sortOrder) {
    switch ($sortOrder) {
        case 'niveau_asc':
            $sql .= " ORDER BY status ASC"; 
            break;
        case 'niveau_desc':
            $sql .= " ORDER BY status DESC"; 
            break;
        default:
            break;
    }
}

$db = config::getConnexion();
try {
    $query = $db->query($sql);
    $order = $query->fetchAll(PDO::FETCH_ASSOC);
    return $order; 
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
}


}
