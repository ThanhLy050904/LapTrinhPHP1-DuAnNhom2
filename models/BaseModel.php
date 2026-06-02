<?php

class BaseModel
{
    private $db_host = '103.57.220.210';
    private $db_name = 'tgivmjcjhosting_shop_thoitrang';
    private $db_user = 'tgivmjcjhosting_test';
    private $db_pass = '?vUvL-Gj57PZ9:$';

    protected function connect()
    {
        $dsn = "mysql:host={$this->db_host};port=3306;dbname={$this->db_name};charset=utf8mb4";

        try {

            $pdo = new PDO(
                $dsn,
                $this->db_user,
                $this->db_pass
            );

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $pdo;

        } catch (PDOException $e) {

            die("Kết nối thất bại: " . $e->getMessage());

        }
    }
}