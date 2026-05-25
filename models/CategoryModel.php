<?php

class CategoryModel extends BaseModel {

    public function getAll()
    {
        $sql =
        "SELECT * FROM categories";

        $result =
        $this->conn->query($sql);

        return
        $result->fetch_all(MYSQLI_ASSOC);
    }
}