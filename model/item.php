<?php

class Item
{
    private $itemid;       // int
    private $quantity;     // int
    private $price;        // float
    private $orderid_fk;   // int
    private $productid_fk; // int

    // Constructor
    public function __construct($itemid, $quantity, $price, $orderid_fk, $productid_fk)
    {
        $this->itemid = $itemid;
        $this->quantity = $quantity;
        $this->price = $price;
        $this->orderid_fk = $orderid_fk;
        $this->productid_fk = $productid_fk;
    }

    // Getters and setters
    public function getItemId()
    {
        return $this->itemid;
    }

    public function setItemId($itemid)
    {
        $this->itemid = $itemid;
        return $this;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
        return $this;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    public function getOrderIdFk()
    {
        return $this->orderid_fk;
    }

    public function setOrderIdFk($orderid_fk)
    {
        $this->orderid_fk = $orderid_fk;
        return $this;
    }

    public function getProductIdFk()
    {
        return $this->productid_fk;
    }

    public function setProductIdFk($productid_fk)
    {
        $this->productid_fk = $productid_fk;
        return $this;
    }
}
