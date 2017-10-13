<?php
class ModelBooks extends ModelDB
{
    public function getBooks($param=false)
    {
        $sql = "SELECT b.id as id, b.title, b.price, b.description, b.discount, b.img, "
            ."g.id as g_id, g.name as g_name, a.id as a_id, a.name as a_name"
            ." from books b left join book_to_author bta on b.id=bta.id_book left join authors a on bta.id_author=a.id"
            ." left join book_to_genre btg on b.id=btg.id_book left join genre g on btg.id_genre=g.id order by b.id".
            " AND active='yes'";
        $data = $this->selectQuery($sql);
        $this->filteredBooks($data);
//        return $data;
    }

    public function filteredBooks($data)
    {
      // dump($data);
       $arrTest = [];
      // foreach($data as $key => $val)
      // {
            
      // }


        foreach($data as $key => $val)
        {
            if (!isset($arrTest[$val['id']]))
            {
                $arrTest[$val['id']] = $val;
            }

        }
       dump($arrTest);
        exit();
    }
}
