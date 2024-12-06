<?php

include 'C:\xampp\htdocs\projetghaith\config.php';
include 'C:\xampp\htdocs\projetghaith\model\order.php';

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
}
