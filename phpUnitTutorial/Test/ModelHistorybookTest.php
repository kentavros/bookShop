<?php
require_once '../../server/app/lib/config.php';
require_once 'Db.php';
require_once '../../server/app/models/ModelDB.php';
require_once '../../server/app/models/ModelHistorybook.php';
class ModelHistorybookTest extends PHPUnit_Framework_TestCase
{
    protected $modelHistory;
    protected $pdo;

    protected function setUp()
    {
        $this->modelHistory = new ModelHistorybook();
        $this->pdo = new Db();
    }

    protected function tearDown()
    {
        $this->modelHistory = NULL;
        $this->pdo = NULL;
    }

    public function testAddBookTrue()
    {
        $this->pdo->execQuery('INSERT INTO clients(first_name, last_name, login, pass, discount, hash, role, active) VALUES ("test","test","test","test","1","test","admin","yes")');
        $id_user = $this->pdo->getPdo()->lastInsertId();
        $result = $this->modelHistory->addBook([
            'hash'=>'test',
            'id_client'=>$id_user,
            'title'=>'test',
            'genre'=>'gtest',
            'author'=>'testa',
            'price'=>1
        ]);
        $this->assertEquals(1, $result);
        $this->pdo->execQuery('DELETE FROM history_book WHERE title="test" LIMIT 1');
        $this->pdo->execQuery('DELETE FROM clients WHERE id='.$id_user);
    }

    public function testAddBookAccessDenied()
    {
        $result = $this->modelHistory->addBook([
            'title'=>'test',
            'genre'=>'gtest',
            'author'=>'testa',
            'price'=>1
        ]);
        $this->assertEquals(ERR_ACCESS, $result);
    }

    public function testAddBookAccessDenied2()
    {
        $result = $this->modelHistory->addBook([
            'hash' =>2,
            'id_client'=>2,
            'title'=>'test',
            'genre'=>'gtest',
            'author'=>'testa',
            'price'=>1
        ]);
        $this->assertEquals(ERR_ACCESS, $result);
    }
}