<?php
require_once '../../server/app/lib/config.php';
require_once 'Db.php';
require_once '../../server/app/models/ModelDB.php';
require_once '../../server/app/models/ModelBooktogenre.php';
class ModelBooktogenreTest extends PHPUnit_Framework_TestCase
{
    protected $modelBooktogenre;
    protected $pdo;

    protected function setUp()
    {
        $this->modelBooktogenre = new ModelBooktogenre();
        $this->pdo = new Db();
    }

    protected function tearDown()
    {
        $this->modelBooktogenre = NULL;
        $this->pdo = NULL;
    }

    public function testGetIdsException()
    {
        $this->setExpectedException(Exception::class);
        $this->modelBooktogenre->getIds(['i d'=>'0']);
    }

    public function testGetIdsData()
    {
        $this->pdo->execQuery('INSERT INTO books (title, price, description) VALUES ("test book","15","test description")');
        $id_book = $this->pdo->getPdo()->lastInsertId();
        $this->pdo->execQuery('INSERT INTO genres (name) VALUES ("test")');
        $id_genre = $this->pdo->getPdo()->lastInsertId();
        $this->pdo->execQuery('INSERT INTO book_to_genre (id_book, id_genre) VALUES ("'.$id_book.'", "'.$id_genre.'")');
        $result = $this->modelBooktogenre->getIds();
        $this->assertInternalType('array', $result);
        $this->assertTrue(count($result) > 0);
        $this->pdo->execQuery('DELETE FROM book_to_genre WHERE id_book='.$id_book);
        $this->pdo->execQuery('DELETE FROM books WHERE id='.$id_book);
        $this->pdo->execQuery('DELETE FROM genres WHERE id='.$id_genre);
    }

    public function testGetIdsDataById()
    {
        $this->pdo->execQuery('INSERT INTO books (title, price, description) VALUES ("test book","15","test description")');
        $id_book = $this->pdo->getPdo()->lastInsertId();
        $this->pdo->execQuery('INSERT INTO genres (name) VALUES ("test")');
        $id_genre = $this->pdo->getPdo()->lastInsertId();
        $this->pdo->execQuery('INSERT INTO book_to_genre (id_book, id_genre) VALUES ("'.$id_book.'", "'.$id_genre.'")');
        $result = $this->modelBooktogenre->getIds(['id_book'=>$id_book]);
        $this->assertInternalType('array', $result);
        $this->assertTrue(count($result) > 0);
        $this->pdo->execQuery('DELETE FROM book_to_genre WHERE id_book='.$id_book);
        $this->pdo->execQuery('DELETE FROM books WHERE id='.$id_book);
        $this->pdo->execQuery('DELETE FROM genres WHERE id='.$id_genre);
    }

    public function testAddBookToGenreErrAccess()
    {
        $result = $this->modelBooktogenre->addBookToGenre(['id'=>0]);
        $this->assertEquals(ERR_ACCESS, $result);
    }

    public function testAddBookToGenreErrAccess2()
    {
        $result = $this->modelBooktogenre->addBookToGenre(['hash'=>2, 'id_client'=>2]);
        $this->assertEquals(ERR_ACCESS, $result);
    }

    public function testAddBookToGenreTrue()
    {
        $this->pdo->execQuery('INSERT INTO clients(first_name, last_name, login, pass, discount, hash, role, active) VALUES ("test","test","test","test","1","test","admin","yes")');
        $id_user = $this->pdo->getPdo()->lastInsertId();
        $this->pdo->execQuery('INSERT INTO books (title, price, description) VALUES ("test book","15","test description")');
        $id_book = $this->pdo->getPdo()->lastInsertId();
        $this->pdo->execQuery('INSERT INTO genres (name) VALUES ("test")');
        $id_genre = $this->pdo->getPdo()->lastInsertId();
        $result = $this->modelBooktogenre->addBookToGenre(['hash'=>'test', 'id_client'=>$id_user, 'id_book'=>$id_book, 'id_genre'=>$id_genre]);
        $this->assertEquals(1, $result);
        $this->pdo->execQuery('DELETE FROM book_to_genre WHERE id_book='.$id_book);
        $this->pdo->execQuery('DELETE FROM books WHERE id='.$id_book);
        $this->pdo->execQuery('DELETE FROM genres WHERE id='.$id_genre);
        $this->pdo->execQuery('DELETE FROM clients WHERE id='.$id_user);
    }

    public function testDeleteByIdErrAccess()
    {
        $result = $this->modelBooktogenre->deleteById(['id'=>0]);
        $this->assertEquals(ERR_ACCESS, $result);
    }

    public function testDeleteByIdErrAccess2()
    {
        $result = $this->modelBooktogenre->deleteById(['hash'=>2, 'id_client'=>2]);
        $this->assertEquals(ERR_ACCESS, $result);
    }

    public function testdeleteById()
    {
        $this->pdo->execQuery('INSERT INTO clients(first_name, last_name, login, pass, discount, hash, role, active) VALUES ("test","test","test","test","1","test","admin","yes")');
        $id_user = $this->pdo->getPdo()->lastInsertId();
        $this->pdo->execQuery('INSERT INTO books (title, price, description) VALUES ("test book","15","test description")');
        $id_book = $this->pdo->getPdo()->lastInsertId();
        $this->pdo->execQuery('INSERT INTO genres (name) VALUES ("test")');
        $id_genre = $this->pdo->getPdo()->lastInsertId();
        $this->pdo->execQuery('INSERT INTO book_to_genre (id_book, id_genre) VALUES ("'.$id_book.'", "'.$id_genre.'")');
        $result = $this->modelBooktogenre->deleteById(['hash'=>'test', 'id_client'=>$id_user, 'id'=>$id_book]);
        $this->assertEquals(1, $result);
        $this->pdo->execQuery('DELETE FROM books WHERE id='.$id_book);
        $this->pdo->execQuery('DELETE FROM genres WHERE id='.$id_genre);
        $this->pdo->execQuery('DELETE FROM clients WHERE id='.$id_user);
    }
}