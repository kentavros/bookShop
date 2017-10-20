<?php
class ModelAuthors extends ModelDB
{
    public function getAuthors($param=false)
    {
        $sql = 'SELECT id, name FROM authors';
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

    public function addAuthor($param)
    {
        if (isset($param['hash']) && isset($param['id_client']))
        {
            if ($this->checkData($param) == 'admin')
            {
                if (empty($param['author']))
                {
                   return ERR_DATA;
                }
                $authorName = $this->pdo->quote($param['author']);
                $sql = "INSERT INTO authors (name) VALUES (".$authorName.")";
                $data = $this->execQuery($sql);
                if ($data === false)
                {
                    return AUTHOR_EXIST;
                }
                return $data;
            }
        }
        else
        {
            return ERR_ACCESS;
        }
    }

    public function deleteAuthor($param)
    {
//        dump($param);
//        exit();
        if (isset($param['hash']) && isset($param['id_client']))
        {
            if ($this->checkData($param) == 'admin')
            {
                unset($param['hash'], $param['id_client']);
                if(!$param['id'])
                {
                    $id = $this->pdo->quote($param['id']);
                    $sql = "DELETE FROM authors WHERE id=".$id;
                    $result = $this->execQuery($sql);
                    return $result;
                }
            }
        }
        else
        {
            return ERR_ACCESS;
        }
    }
}