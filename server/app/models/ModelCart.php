<?php
class ModelCart extends ModelDB
{
    public function addToCart($param)
    {
        if (empty($param['count']))
        {
            return ERR_COUNT;
        }
        $idBook = $this->pdo->quote($param['id_book']);
        $idClient = $this->pdo->quote($param['id_client']);
        $count = $this->pdo->quote($param['count']);
        $sql = "SELECT count FROM cart WHERE id_book=".$idBook." AND id_client=".$idClient;
        $data = $this->selectQuery($sql);
        if (!is_array($data))
        {
            $sql = "INSERT INTO cart (id_book, id_client, count) VALUES (".$idBook.", ".$idClient.", ".$count.")";
            $result = $this->insertUpdateQuery($sql);
            return $result;
        }
        else
        {
            $count = trim($count, "'");
            $resCount = (int)$data[0]['count']+(int)$count;
            $count = $this->pdo->quote($resCount);
            $sql = "UPDATE cart SET count=".$count." WHERE id_book=".$idBook." AND id_client=".$idClient;
            $result = $this->insertUpdateQuery($sql);
            return $result;
        }
    }
}