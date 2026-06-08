<?php

class Database
{
    private $db_host = '103.57.220.210';
    private $db_name = 'tgivmjcjhosting_shop_thoitrang';
    private $db_user = 'tgivmjcjhosting_test';
    private $db_pass = '?vUvL-Gj57PZ9:$';

    public function connect()
    {
        try {

            $dsn = "mysql:host={$this->db_host};dbname={$this->db_name};charset=utf8mb4";

            $pdo = new PDO(
                $dsn,
                $this->db_user,
                $this->db_pass
            );

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            return $pdo;
        } catch (PDOException $e) {

            die("Kết nối thất bại: " . $e->getMessage());
        }
    }
}
