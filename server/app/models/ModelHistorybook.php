<?php
class ModelHistorybook extends ModelDB
{
    public function addBook($param)
    {
        if (isset($param['hash']) && isset($param['id_client']))
        {
            if ($this->checkData($param) == 'admin')
            {
                $title = $this->pdo->quote($param['title']);
                $genre = $this->pdo->quote($param['genre']);
                $author = $this->pdo->quote($param['author']);
                $price = $this->pdo->quote($param['price']);
                $sql = 'INSERT INTO history_book'
                    .'('
                    .'title, '
                    .'genre, '
                    .'author, '
                    .'price'
                    .') VALUES ('
                    .$title.', '
                    .$genre.', '
                    .$author.', '
                    .$price
                    .')';
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