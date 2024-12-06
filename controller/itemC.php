<?php

include 'C:\xampp\htdocs\projetghaith\config2.php';
include 'C:\xampp\htdocs\projetghaith\model\item.php';

class ItemController
{
    // Add a new item
    public function addItem($item)
    {
        $sql = "INSERT INTO items (quantity, price, orderid_fk, productid_fk) 
                VALUES (:quantity, :price, :orderid_fk, :productid_fk)";
        $db = config2::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->execute([
                'quantity' => $item->getQuantity(),
                'price' => $item->getPrice(),
                'orderid_fk' => $item->getOrderIdFk(),
                'productid_fk' => $item->getProductIdFk()
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    // Update an existing item
    public function updateItem($item, $itemid)
    {
        $sql = "UPDATE items 
                SET quantity = :quantity, price = :price, orderid_fk = :orderid_fk, productid_fk = :productid_fk 
                WHERE itemid = :itemid";
        $db = config2::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->execute([
                'itemid' => $itemid,
                'quantity' => $item->getQuantity(),
                'price' => $item->getPrice(),
                'orderid_fk' => $item->getOrderIdFk(),
                'productid_fk' => $item->getProductIdFk()
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    // Delete an item
    public function deleteItem($itemid)
    {
        $sql = "DELETE FROM items WHERE itemid = :itemid";
        $db = config2::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->bindParam(':itemid', $itemid);
            $query->execute();
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    // List all items
    public function listItems()
    {
        $sql = "SELECT * FROM items";
        $db = config2::getConnexion();

        try {
            $query = $db->query($sql);
            $items = $query->fetchAll(PDO::FETCH_ASSOC);
            return $items ?: []; // Return an empty array if no data
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
            return [];
        }
    }

    // Show details of a specific item
    public function showItem($itemid)
    {
        $sql = "SELECT * FROM items WHERE itemid = :itemid";
        $db = config2::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->bindParam(':itemid', $itemid);
            $query->execute();
            $item = $query->fetch(PDO::FETCH_ASSOC);
            return $item ?: null; // Return null if no item found
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    // List items for a specific order
    public function listItemsByOrder($orderid_fk)
    {
        $sql = "SELECT * FROM items WHERE orderid_fk = :orderid_fk";
        $db = config2::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->bindParam(':orderid_fk', $orderid_fk);
            $query->execute();
            $items = $query->fetchAll(PDO::FETCH_ASSOC);
            return $items ?: []; // Return an empty array if no data
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
            return [];
        }
    }

    // List all items with order names
public function listItemsJ()
{
    $sql = "SELECT i.itemid, i.quantity, i.price, i.orderid_fk, i.productid_fk, o.nom 
            FROM items i
            JOIN ordres o ON i.orderid_fk = o.id"; // Joining with the orders table to get the order name
    $db = config2::getConnexion();

    try {
        $query = $db->query($sql);
        $items = $query->fetchAll(PDO::FETCH_ASSOC);
        return $items ?: []; // Return an empty array if no data
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
        return [];
    }
}

}
