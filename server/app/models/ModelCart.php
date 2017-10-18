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
        $idClient = array_shift($param);
        $idClient = $idClient['id_client'];
        if (!is_array($param))
        {
            return false;
        }

        foreach ($param as $book)
        {
            if ($book['checked'] === false)
            {
                $idBook = $this->pdo->quote($book['id']);
                $sql = "DELETE FROM cart WHERE id_book=".$idBook." AND id_client=".$idClient;
                $this->execQuery($sql);
            }
            else if ($book['checked'] === true)
            {
                $count = $this->pdo->quote($book['count']);
                $idBook = $this->pdo->quote($book['id']);
                $sql = "UPDATE cart SET count=".$count." WHERE id_book=".$idBook." AND id_client=".$idClient;
                $count = $this->execQuery($sql);
            }
        }
        return UPDATE;
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
            $result = $this->execQuery($sql);
            return $result;
        }
        else
        {
            $count = trim($count, "'");
            $resCount = (int)$data[0]['count']+(int)$count;
            $count = $this->pdo->quote($resCount);
            $sql = "UPDATE cart SET count=".$count." WHERE id_book=".$idBook." AND id_client=".$idClient;
            $result = $this->execQuery($sql);
            return $result;
        }
    }

    public function clearCart($param)
    {
        if (!$param['id'])
        {
            return ERR_DATA;
        }
        $idClient = $this->pdo->quote($param['id']);
        $sql = "DELETE FROM cart WHERE id_client=".$idClient;
        $result = $this->execQuery($sql);
        return $result;
    }
}
