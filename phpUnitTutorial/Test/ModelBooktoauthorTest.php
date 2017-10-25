<?php
require_once '../../server/app/lib/config.php';
require_once 'Db.php';
require_once '../../server/app/models/ModelDB.php';
require_once '../../server/app/models/ModelBooktoauthor.php';
class ModelBooktoauthorTest extends PHPUnit_Framework_TestCase
{
    protected $modelBooktoauthor;
    protected $pdo;

    protected function setUp()
    {
        $this->modelBooktoauthor = new ModelBooktoauthor();
        $this->pdo = new Db();
    }

    protected function tearDown()
    {
        $this->modelBooktoauthor = NULL;
        $this->pdo = NULL;
    }

    public function testGetIdsException()
    {
        $this->setExpectedException(Exception::class);
        $this->modelBooktoauthor->getIds(['i d'=>'0']);
    }

    public function testGetIdsData()
    {
        $this->pdo->execQuery('INSERT INTO clients(first_name, last_name, login, pass, discount, hash, role, active) VALUES ("test","test","test","test","1","test","admin","yes")');
        $id_user = $this->pdo->getPdo()->lastInsertId();
        $this->pdo->execQuery('INSERT INTO books (title, price, description) VALUES ("test book","15","test description")');
        $id_book = $this->pdo->getPdo()->lastInsertId();
        $this->pdo->execQuery('INSERT INTO authors (name) VALUES ("test")');
        $id_author = $this->pdo->getPdo()->lastInsertId();
        $this->pdo->execQuery('INSERT INTO book_to_author (id_book, id_author) VALUES ("'.$id_book.'", "'.$id_author.'")');
        $result = $this->modelBooktoauthor->getIds();
        $this->assertInternalType('array', $result);
        $this->assertTrue(count($result) > 0);
        $this->pdo->execQuery('DELETE FROM book_to_author WHERE id_book='.$id_book);
        $this->pdo->execQuery('DELETE FROM clients WHERE id='.$id_user);
        $this->pdo->execQuery('DELETE FROM books WHERE id='.$id_book);
        $this->pdo->execQuery('DELETE FROM authors WHERE id='.$id_author);
    }

    public function testGetIdsDataById()
    {
        $this->pdo->execQuery('INSERT INTO clients(first_name, last_name, login, pass, discount, hash, role, active) VALUES ("test","test","test","test","1","test","admin","yes")');
        $id_user = $this->pdo->getPdo()->lastInsertId();
        $this->pdo->execQuery('INSERT INTO books (title, price, description) VALUES ("test book","15","test description")');
        $id_book = $this->pdo->getPdo()->lastInsertId();
        $this->pdo->execQuery('INSERT INTO authors (name) VALUES ("test")');
        $id_author = $this->pdo->getPdo()->lastInsertId();
        $this->pdo->execQuery('INSERT INTO book_to_author (id_book, id_author) VALUES ("'.$id_book.'", "'.$id_author.'")');
        $result = $this->modelBooktoauthor->getIds(['id_book'=>$id_book]);
        $this->assertInternalType('array', $result);
        $this->assertTrue(count($result) > 0);
        $this->pdo->execQuery('DELETE FROM book_to_author WHERE id_book='.$id_book);
        $this->pdo->execQuery('DELETE FROM clients WHERE id='.$id_user);
        $this->pdo->execQuery('DELETE FROM books WHERE id='.$id_book);
        $this->pdo->execQuery('DELETE FROM authors WHERE id='.$id_author);
    }

    public function testGetIdsNotFound()
    {
        $result = $this->modelBooktoauthor->getIds(['id_book'=>0]);
        $this->assertEquals(ERR_SEARCH, $result);
    }

    public function testAddBookToAuthorErrAccess()
    {
        $result = $this->modelBooktoauthor->addBookToAuthor(['id'=>0]);
        $this->assertEquals(ERR_ACCESS, $result);
    }


    public function testAddBookToAuthorErrAccess2()
    {
        $result = $this->modelBooktoauthor->addBookToAuthor(['hash'=>2, 'id_client'=>2]);
        $this->assertEquals(ERR_ACCESS, $result);
    }

    public function testAddBookToAuthorTrue()
    {
        $this->pdo->execQuery('INSERT INTO clients(first_name, last_name, login, pass, discount, hash, role, active) VALUES ("test","test","test","test","1","test","admin","yes")');
        $id_user = $this->pdo->getPdo()->lastInsertId();
        $this->pdo->execQuery('INSERT INTO books (title, price, description) VALUES ("test book","15","test description")');
        $id_book = $this->pdo->getPdo()->lastInsertId();
        $this->pdo->execQuery('INSERT INTO authors (name) VALUES ("test")');
        $id_author = $this->pdo->getPdo()->lastInsertId();
        $result = $this->modelBooktoauthor->addBookToAuthor(['hash'=>'test', 'id_client'=>$id_user, 'id_book'=>$id_book, 'id_author'=>$id_author]);
        $this->assertEquals(1, $result);
        $this->pdo->execQuery('DELETE FROM book_to_author WHERE id_book='.$id_book);
        $this->pdo->execQuery('DELETE FROM clients WHERE id='.$id_user);
        $this->pdo->execQuery('DELETE FROM books WHERE id='.$id_book);
        $this->pdo->execQuery('DELETE FROM authors WHERE id='.$id_author);
    }

    public function testDeleteByIdErrAccess()
    {
        $result = $this->modelBooktoauthor->deleteById(['id'=>0]);
        $this->assertEquals(ERR_ACCESS, $result);
    }


    public function testDeleteByIdrErrAccess2()
    {
        $result = $this->modelBooktoauthor->deleteById(['hash'=>2, 'id_client'=>2]);
        $this->assertEquals(ERR_ACCESS, $result);
    }

    public function testDeleteByIdTrue()
    {
        $this->pdo->execQuery('INSERT INTO clients(first_name, last_name, login, pass, discount, hash, role, active) VALUES ("test","test","test","test","1","test","admin","yes")');
        $id_user = $this->pdo->getPdo()->lastInsertId();
        $this->pdo->execQuery('INSERT INTO books (title, price, description) VALUES ("test book","15","test description")');
        $id_book = $this->pdo->getPdo()->lastInsertId();
        $this->pdo->execQuery('INSERT INTO authors (name) VALUES ("test")');
        $id_author = $this->pdo->getPdo()->lastInsertId();
        $this->pdo->execQuery('INSERT INTO book_to_author (id_book, id_author) VALUES ("'.$id_book.'", "'.$id_author.'")');
        $result = $this->modelBooktoauthor->deleteById(['hash'=>'test', 'id_client'=>$id_user, 'id'=>$id_book]);
        $this->assertEquals(1, $result);
        $this->pdo->execQuery('DELETE FROM clients WHERE id='.$id_user);
        $this->pdo->execQuery('DELETE FROM books WHERE id='.$id_book);
        $this->pdo->execQuery('DELETE FROM authors WHERE id='.$id_author);
    }



}