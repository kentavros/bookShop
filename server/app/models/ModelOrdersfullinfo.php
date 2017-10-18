<?php
class ModelOrdersfullinfo extends ModelDB
{
    public function getOrdersfullinfo($param = false)
    {
        return 'pust GET method';
    }

    public function addToOrdersfullinfo($param)
    {
        date_default_timezone_set('Europe/Kiev');
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
        //$discount_client = $this->pdo->quote($param['discount_client']);

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
