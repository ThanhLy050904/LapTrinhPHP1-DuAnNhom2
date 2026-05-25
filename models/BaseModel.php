<?php

class BaseModel {

    protected $conn;

    public function __construct()
    {
        $this->conn =
        new mysqli(
            "localhost",
            "root",
            "mysql",
            "shop_thoitrang"
        );

        if($this->conn->connect_error){

            die("Kết nối thất bại");

        }
    }
}