<?php
class ModelOrders extends ModelDB
{
    public function getOrders($param = false)
    {
        return 'pust GET method';
    }

    public function addToOrders($param)
    {
//        date_default_timezone_set('Europe/Kiev');
        if (empty($param))
        {
            throw new Exception(ERR_DATA);
        }
        $idClient = $this->pdo->quote($param['id_client']);
        $clientDisc = $this->pdo->quote($param['discount_client']);
        $idPayment = $this->pdo->quote($param['id_payment']);
        $totalDisc = $this->pdo->quote($param['total_discount']);
        $totalPrice = $this->pdo->quote($param['total_price']);
        $sql = "INSERT INTO orders (id_client, discount_client, id_payment, total_discount, total_price)"
            ." VALUES (".$idClient.", ".$clientDisc.", ".$idPayment.", ".$totalDisc.", ".$totalPrice.")";
        $this->execQuery($sql);
        $result['id_order'] = $this->pdo->lastInsertId();
        return $result;
    }
}