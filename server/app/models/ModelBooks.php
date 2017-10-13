<?php
class ModelBooks extends ModelDB
{
    public function getBooks($param=false)
    {
        $sql = "SELECT * FROM books";
        $data = $this->selectQuery($sql);
        return $data;
    }
}