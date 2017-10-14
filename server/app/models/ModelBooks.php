<?php
class ModelBooks extends ModelDB
{
    /**
     * Get All books or book by param - id
     * @param bool $param
     * @return array
     */
    public function getBooks($param=false)
    {
        $sql = 'SELECT b.id as id,'
            .' b.title,'
            .' a.id as a_id,'
            .' a.name as a_name,'
            .' g.id as g_id,'
            .' g.name as g_name'
            .' FROM books b '
            .' LEFT JOIN book_to_author ba'
            .' ON b.id=ba.id_book'
            .' LEFT JOIN authors a'
            .' ON a.id=ba.id_author'
            .' LEFT JOIN book_to_genre bg'
            .' ON b.id=bg.id_book'
            .' LEFT JOIN genres g'
            .' ON bg.id_genre=g.id'
            .' WHERE active="yes"';
        if ($param !== false)
        {
            if (is_array($param))
            {
                $sql .= " AND ";
                foreach ($param as $key => $val)
                {
                    $sql .= 'b.'.$key.'='.$this->pdo->quote($val).' AND ';
                }
                $sql = substr($sql, 0, -5);
            }
            $sql .= ' ORDER BY b.id';
        }
        else
        {
            $sql .= ' ORDER BY b.id';
        }
        $data = $this->selectQuery($sql);
        $result = $this->filteredBooks($data);
        return $result;
    }

    /**
     * Cleans and copies received after the request, the book - author - genre
     * @param $data
     * @return array
     */
    public function filteredBooks($data)
    {
        $arr = [];
        foreach ($data as $val)
        {
            if (!isset($arr[$val['id']]))
            {
                $arr[$val['id']] = $val;
            }
            if ($arr[$val['id']]['id'] == $val['id'])
            {
                $arr[$val['id']]['authors'][] = ['id'=>$val['a_id'], 'name'=>$val['a_name']];
                $arr[$val['id']]['genres'][] = ['id'=>$val['g_id'], 'name'=>$val['g_name']];
            }
            //Remove duplicate elements of a multidimensional array
            $arr[$val['id']]['authors'] = array_map("unserialize", array_unique(array_map("serialize", $arr[$val['id']]['authors'])));
            $arr[$val['id']]['genres'] = array_map("unserialize", array_unique(array_map("serialize", $arr[$val['id']]['genres'])));
        }
        //Reindex arr
        $arr = array_values($arr);
        return $arr;
    }
}
