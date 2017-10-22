<?php
class ModelBooktoauthor extends ModelDB
{
    public function getIds($param=false)
    {
        $sql = 'SELECT id_book, id_author FROM book_to_author';
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

    public function addBookToAuthor($param)
    {
        if (isset($param['hash']) && isset($param['id_client']))
        {
            if ($this->checkData($param) == 'admin')
            {
                $idBook = $this->pdo->quote($param['id_book']);
                $idAuthor = $this->pdo->quote($param['id_author']);
                $sql = 'INSERT INTO book_to_author'
                    .' ('
                    .'id_book,'
                    .' id_author'
                    .') VALUES ('
                    .$idBook.', '
                    .$idAuthor.')';
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
                $sql = "DELETE FROM book_to_author WHERE id_book=".$idBook;
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