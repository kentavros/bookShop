<?php
class ModelGenres extends ModelDB
{
    public function getGenres($param=false)
    {
        $sql = 'SELECT id, name FROM genres';
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
}