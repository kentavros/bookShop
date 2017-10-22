<?php
class ModelBooktogenre extends ModelDB
{
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
}