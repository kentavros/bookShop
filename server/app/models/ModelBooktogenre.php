<?php
class ModelBooktogenre extends ModelDB
{
    public function getIds($param=false)
    {
        $sql = 'SELECT id_book, id_genre FROM book_to_genre';
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

    public function addBookToGenre($param)
    {
        if (isset($param['hash']) && isset($param['id_client']))
        {
            if ($this->checkData($param) == 'admin')
            {
                $idBook = $this->pdo->quote($param['id_book']);
                $idGenre = $this->pdo->quote($param['id_genre']);
                $sql = 'INSERT INTO book_to_genre'
                    .' ('
                    .'id_book,'
                    .' id_genre'
                    .') VALUES ('
                    .$idBook.', '
                    .$idGenre.')';
                $result = $this->execQuery($sql);
                return $result;
            }
            else
            {
                return ERR_ACCESS;
            }
        }
        else
        {
            return ERR_ACCESS;
        }
    }

    public function deleteById($param)
    {
        if (isset($param['hash']) && isset($param['id_client']))
        {
            if ($this->checkData($param) == 'admin')
            {
                if (!$param['id'])
                {
                    return ERR_DATA;
                }
                $idBook = $this->pdo->quote($param['id']);
                $sql = "DELETE FROM book_to_genre WHERE id_book=".$idBook;
                $result = $this->execQuery($sql);
                return $result;
            }
            else
            {
                return ERR_ACCESS;
            }
        }
        else
        {
            return ERR_ACCESS;
        }

    }
}