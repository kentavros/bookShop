<?php
class ModelOrders extends ModelDB
{
    public function getOrders($param = false)
    {
        $sql = 'SELECT o.id as id_order,'
            .' o.discount_client,'
            .' o.status,'
            .' o.total_discount,'
            .' o.total_price,'
            .' p.name as pay_name,'
            .' o.date_time,'
            .' of.id_book,'
            .' of.title_book,'
            .' of.count,'
            .' of.price,'
            .' of.discount_book'
            .' FROM orders o'
            .' LEFT JOIN orders_full_info of'
            .' ON o.id=of.id_order'
            .' LEFT JOIN payment p'
            .' ON o.id_payment=p.id';
        if ($param !== false)
        {
            if (is_array($param))
            {
                $sql .= " WHERE ";
                foreach ($param as $key => $val)
                {
                    $sql .= 'o.'.$key.'='.$this->pdo->quote($val).' AND ';
                }
                $sql = substr($sql, 0, -5);
            }
        }
        $data = $this->selectQuery($sql);
        $result = $this->filteredOrders($data);
        return $result;
    }

    protected function filteredOrders($data)
    {
        $arr = [];
        foreach ($data as $val)
        {
            if (!isset($arr[$val['id_order']]))
            {
                $arr[$val['id_order']] = $val;
            }


            if ($arr[$val['id_order']]['id_order'] == $val['id_order'])
            {
                $arr[$val['id_order']]['books'][] = [
                    'id_book'=>$val['id_book'],
                    'title_book'=>$val['title_book'],
                    'count'=>$val['count'],
                    'price'=>$val['price'],
                    'discount_book'=>$val['discount_book']
                ];
                unset(
                    $arr[$val['id_order']]['id_book'],
                    $arr[$val['id_order']]['title_book'],
                    $arr[$val['id_order']]['count'],
                    $arr[$val['id_order']]['price'],
                    $arr[$val['id_order']]['discount_book']
                );
            }
            //Remove duplicate elements of a multidimensional array
            $arr[$val['id_order']]['books'] = array_map("unserialize", array_unique(array_map("serialize", $arr[$val['id_order']]['books'])));
        }
        //Reindex arr
        $arr = array_values($arr);
        return $arr;
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