<?php

class Voucher
{
    private $code;   
    private $perc; 

    // Constructor
    public function __construct($code, $perc)
    {
        $this->code = $code;
        $this->perc = $perc;
    }

    // Getters and setters
    public function getCode()
    {
        return $this->code;
    }

    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }

    public function getPerc()
    {
        return $this->perc;
    }

    public function setPerc($perc)
    {
        $this->perc = $perc;
        return $this;
    }
}
