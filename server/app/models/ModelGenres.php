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

    public function addGenre($param)
    {
        if (isset($param['hash']) && isset($param['id_client']))
        {
            if ($this->checkData($param) == 'admin')
            {
                if (empty($param['genre']))
                {
                    return ERR_DATA;
                }
                $genreName = $this->pdo->quote($param['genre']);
                $sql = "INSERT INTO genres (name) VALUES (".$genreName.")";
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

    public function editGenres($param)
    {
        if (isset($param['hash']) && isset($param['id_client']))
        {
            if ($this->checkData($param) == 'admin')
            {
                if (isset($param['id']) && isset($param['name']))
                {
                    $id = $this->pdo->quote($param['id']);
                    $name = $this->pdo->quote($param['name']);
                    $sql = "UPDATE genres SET name=".$name." WHERE id=".$id;
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

    public function deleteGenre($param)
    {
        if (isset($param['hash']) && isset($param['id_client']))
        {
            if ($this->checkData($param) == 'admin')
            {
                unset($param['hash'], $param['id_client']);
                if ($param['id']) {
                    $id = $this->pdo->quote($param['id']);
                    $sql = "DELETE FROM book_to_genre WHERE id_genre=".$id;
                    $this->execQuery($sql);
                    $sql = "DELETE FROM genres WHERE id=".$id;
                    $result = $this->execQuery($sql);
                    return $result;
                }
                else
                {
                    return false;
                }
            }
        }
        else
        {
            return ERR_ACCESS;
        }
    }
}