<?php
class ModelOrdersfullinfo extends ModelDB
{
    public function getOrdersfullinfo($param = false)
    {
        $sql = 'SELECT id_book,'
            .' title_book,'
            .' count,'
            .' price,'
            .' discount_book'
            .' FROM orders_full_info';
        if ($param !== false)
        {
            if (is_array($param))
            {
                $sql .= " WHERE ";
                foreach ($param as $key => $val)
                {
                    $sql .= $key.'='.$this->pdo->quote($val).' AND ';
                }
                $sql = substr($sql, 0, -5);
            }
        }
        $data = $this->selectQuery($sql);
        return $data;
    }

    public function addToOrdersfullinfo($param)
    {
        if (empty($param))
        {
            throw new Exception(ERR_DATA);
        }
        $idOrder = $this->pdo->quote($param['id_order']);
        $idBook = $this->pdo->quote($param['id_book']);
        $titleBook = $this->pdo->quote($param['title_book']);
        $count = $this->pdo->quote($param['count']);
        $price = $this->pdo->quote($param['price']);
        $discount_book = $this->pdo->quote($param['discount_book']);
        $sql = "INSERT INTO orders_full_info"
            ." (id_order,"
            ." id_book,"
            ." title_book,"
            ." count,"
            ." price,"
            ." discount_book)"
            ." VALUES"
            ." (".$idOrder.","
            ." ".$idBook.","
            ." ".$titleBook.","
            ." ".$count.","
            ." ".$price.","
            ." ".$discount_book.")";
        $count = $this->execQuery($sql);
        return $count;
    }
}
