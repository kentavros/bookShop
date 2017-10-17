<?php
class ModelCart extends ModelDB
{
    public function getBooksByIdClient($param)
    {
        if (empty($param['id']))
        {
            throw new Exception(ERR_DATA);
        }
        $idClient = $this->pdo->quote($param['id']);
        $sql = 'SELECT'
            .' b.id,'
            .' b.title,'
            .' b.price,'
            .' b.discount,'
            .' c.count'
            .' FROM books b'
            .' LEFT JOIN cart c'
            .' ON b.id = c.id_book'
            .' WHERE c.id_client='.$idClient;
        $data = $this->selectQuery($sql);
        return $data;
    }
    

    public function updateCart($param)
    {
        dump($param);
        exit();   
    }

    public function addToCart($param)
    {
        if ((int)$param['count'] <= 0)
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
