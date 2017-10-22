<?php
class ModelBooktoauthor extends ModelDB
{
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
}