<?php
require_once '../../server/app/lib/config.php';
require_once 'Db.php';
require_once '../../server/app/models/ModelDB.php';
require_once '../../server/app/models/ModelAuthors.php';
class ModelAuthorsTest extends PHPUnit_Framework_TestCase
{
    protected $modelAuthors;
    protected $pdo;

    protected function setUp()
    {
        $this->modelAuthors = new ModelAuthors();
        $this->pdo = new Db();
    }

    protected function tearDown()
    {
        $this->modelAuthors = NULL;
        $this->pdo = NULL;
    }

    public function testGetAuthorsTrue()
    {
        $result=$this->modelAuthors->getAuthors();
        $this->assertArrayHasKey('id', $result[0]);
        $this->assertArrayHasKey('name', $result[0]);
    }

    public function testGetAuthorsNotFound()
    {
        $result=$this->modelAuthors->getAuthors(['id'=>'0']);
        $this->assertEquals(ERR_SEARCH, $result);
    }

    public function testGetAuthorsException()
    {
        $this->setExpectedException(Exception::class);
        $result=$this->modelAuthors->getAuthors(['i d'=>'0']);
    }

    public function testAddAuthorAccessDenied()
    {
        $result = $this->modelAuthors->addAuthor(['id'=>'2']);
        $this->assertEquals(ERR_ACCESS, $result);
    }

    public function testAddAuthorFalse()
    {
        $result = $this->modelAuthors->addAuthor(['hash'=>'0', 'id_client'=>'2']);
        $this->assertFalse(false);
    }

    public function testAddAuthorNoAddedData()
    {
        $this->pdo->execQuery('INSERT INTO clients(first_name, last_name, login, pass, discount, hash, role, active) VALUES ("test","test","test","test","1","test","admin","yes")');
        $id = $this->pdo->getPdo()->lastInsertId();
        $result = $this->modelAuthors->addAuthor(['hash'=>'test', 'id_client'=>$id]);
        $this->assertEquals(ERR_DATA, $result);
        $this->pdo->execQuery('DELETE FROM clients WHERE id='.$id);
    }

    public function testAddAuthorExist()
    {
        $this->pdo->execQuery('INSERT INTO authors (name) VALUES ("test")');
        $id_author = $this->pdo->getPdo()->lastInsertId();
        $this->pdo->execQuery('INSERT INTO clients(first_name, last_name, login, pass, discount, hash, role, active) VALUES ("test","test","test","test","1","test","admin","yes")');
        $id_user = $this->pdo->getPdo()->lastInsertId();
        $result = $this->modelAuthors->addAuthor(['hash'=>'test', 'id_client'=>$id_user, 'author'=>'test']);
        $this->assertEquals(AUTHOR_EXIST, $result);
        $this->pdo->execQuery('DELETE FROM authors WHERE id='.$id_author);
        $this->pdo->execQuery('DELETE FROM clients WHERE id='.$id_user);
    }

    public function testAddAuthor()
    {
        $this->pdo->execQuery('INSERT INTO clients(first_name, last_name, login, pass, discount, hash, role, active) VALUES ("test","test","test","test","1","test","admin","yes")');
        $id_user = $this->pdo->getPdo()->lastInsertId();
        $result = $this->modelAuthors->addAuthor(['hash'=>'test', 'id_client'=>$id_user, 'author'=>'test']);
        $this->assertEquals(1, $result);
        $this->pdo->execQuery('DELETE FROM authors WHERE name="test"');
        $this->pdo->execQuery('DELETE FROM clients WHERE id='.$id_user);
    }

    public function testEditAuthorAccessDenied()
    {
        $result = $this->modelAuthors->editAuthor(['id'=>'2']);
        $this->assertEquals(ERR_ACCESS, $result);
    }

    public function testEditAuthorFalse()
    {
        $result = $this->modelAuthors->editAuthor(['hash'=>'0', 'id_client'=>'2']);
        $this->assertFalse(false);
    }

    public function testEditAuthor()
    {
        $this->pdo->execQuery('INSERT INTO authors (name) VALUES ("test")');
        $id_author = $this->pdo->getPdo()->lastInsertId();
        $this->pdo->execQuery('INSERT INTO clients(first_name, last_name, login, pass, discount, hash, role, active) VALUES ("test","test","test","test","1","test","admin","yes")');
        $id_user = $this->pdo->getPdo()->lastInsertId();
        $result = $this->modelAuthors->editAuthor(['hash'=>'test', 'id_client'=>$id_user, 'name'=>'test1', 'id'=>$id_author]);
        $this->assertEquals(1, $result);
        $this->pdo->execQuery('DELETE FROM authors WHERE id='.$id_author);
        $this->pdo->execQuery('DELETE FROM clients WHERE id='.$id_user);
    }

    public function testDeleteAuthorAccessDenied()
    {
        $result = $this->modelAuthors->deleteAuthor(['id'=>'2']);
        $this->assertEquals(ERR_ACCESS, $result);
    }

    public function testDeleteAuthorFalse()
    {
        $this->pdo->execQuery('INSERT INTO clients(first_name, last_name, login, pass, discount, hash, role, active) VALUES ("test","test","test","test","1","test","admin","yes")');
        $id_user = $this->pdo->getPdo()->lastInsertId();
        $this->modelAuthors->deleteAuthor(['hash'=>'test', 'id_client'=>$id_user]);
        $this->assertFalse(false);
        $this->pdo->execQuery('DELETE FROM clients WHERE id='.$id_user);
    }

    public function testDeleteAuthors()
    {
        $this->pdo->execQuery('INSERT INTO clients(first_name, last_name, login, pass, discount, hash, role, active) VALUES ("test","test","test","test","1","test","admin","yes")');
        $id_user = $this->pdo->getPdo()->lastInsertId();
        $this->pdo->execQuery('INSERT INTO authors (name) VALUES ("test")');
        $id_author = $this->pdo->getPdo()->lastInsertId();
        $result = $this->modelAuthors->deleteAuthor(['hash'=>'test', 'id_client'=>$id_user, 'id'=>$id_author]);
        $this->assertEquals(1, $result);
        $this->pdo->execQuery('DELETE FROM clients WHERE id='.$id_user);
    }
}