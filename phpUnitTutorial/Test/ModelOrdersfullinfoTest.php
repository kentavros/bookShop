<?php
require_once '../../server/app/lib/config.php';
require_once 'Db.php';
require_once '../../server/app/models/ModelDB.php';
require_once '../../server/app/models/ModelOrdersfullinfo.php';
class ModelOrdersfullinfoTest extends PHPUnit_Framework_TestCase
{
    protected $modelOrdersfullinfo;
    protected $pdo;

    protected function setUp()
    {
        $this->modelOrdersfullinfo = new ModelOrdersfullinfo();
        $this->pdo = new Db();
    }

    protected function tearDown()
    {
        $this->modelOrdersfullinfo = NULL;
        $this->pdo = NULL;
    }

    public function testGetOrdersfullinfoGetAll()
    {
        $this->pdo->execQuery('INSERT INTO clients(first_name, last_name, login, pass, discount, hash, role, active) VALUES ("test","test","test","test","1","test","admin","yes")');
        $id_user = $this->pdo->getPdo()->lastInsertId();
        $this->pdo->execQuery('INSERT INTO books (title, price, description) VALUES ("test book","15","test description")');
        $id_book = $this->pdo->getPdo()->lastInsertId();
        $this->pdo->execQuery('INSERT INTO payment (name) VALUES ("test")');
        $id_pay = $this->pdo->getPdo()->lastInsertId();
        $this->pdo->execQuery('INSERT INTO orders (id_client,discount_client,id_payment,total_discount,total_price)'
            .' VALUES ("'.$id_user.'", "1", "'.$id_pay.'", "1","1")');
        $id_order = $this->pdo->getPdo()->lastInsertId();
        $this->pdo->execQuery('INSERT INTO orders_full_info (id_order,id_book,title_book,count,price,discount_book)'
            .' VALUES ("'.$id_order.'", "'.$id_book.'", "test", "1", "1", "1")');
        $id_fullOrder = $this->pdo->getPdo()->lastInsertId();
        $result = $this->modelOrdersfullinfo->getOrdersfullinfo();
        $this->assertInternalType('array', $result);
        $this->assertTrue(count($result) > 0);
        $this->pdo->execQuery('DELETE FROM orders_full_info WHERE id='.$id_fullOrder);
        $this->pdo->execQuery('DELETE FROM orders WHERE id='.$id_order);
        $this->pdo->execQuery('DELETE FROM payment WHERE id='.$id_pay);
        $this->pdo->execQuery('DELETE FROM books WHERE id='.$id_book);
        $this->pdo->execQuery('DELETE FROM clients WHERE id='.$id_user);
    }

    public function testGetOrdersfullinfoGetById()
    {
        $this->pdo->execQuery('INSERT INTO clients(first_name, last_name, login, pass, discount, hash, role, active) VALUES ("test","test","test","test","1","test","admin","yes")');
        $id_user = $this->pdo->getPdo()->lastInsertId();
        $this->pdo->execQuery('INSERT INTO books (title, price, description) VALUES ("test book","15","test description")');
        $id_book = $this->pdo->getPdo()->lastInsertId();
        $this->pdo->execQuery('INSERT INTO payment (name) VALUES ("test")');
        $id_pay = $this->pdo->getPdo()->lastInsertId();
        $this->pdo->execQuery('INSERT INTO orders (id_client,discount_client,id_payment,total_discount,total_price)'
            .' VALUES ("'.$id_user.'", "1", "'.$id_pay.'", "1","1")');
        $id_order = $this->pdo->getPdo()->lastInsertId();
        $this->pdo->execQuery('INSERT INTO orders_full_info (id_order,id_book,title_book,count,price,discount_book)'
            .' VALUES ("'.$id_order.'", "'.$id_book.'", "test", "1", "1", "1")');
        $id_fullOrder = $this->pdo->getPdo()->lastInsertId();
        $result = $this->modelOrdersfullinfo->getOrdersfullinfo(['id_order'=>$id_order]);
        $this->assertInternalType('array', $result);
        $this->assertTrue(count($result) > 0);
        $this->pdo->execQuery('DELETE FROM orders_full_info WHERE id='.$id_fullOrder);
        $this->pdo->execQuery('DELETE FROM orders WHERE id='.$id_order);
        $this->pdo->execQuery('DELETE FROM payment WHERE id='.$id_pay);
        $this->pdo->execQuery('DELETE FROM books WHERE id='.$id_book);
        $this->pdo->execQuery('DELETE FROM clients WHERE id='.$id_user);
    }

    public function testGetOrdersfullinfoNotFound()
    {
        $result = $this->modelOrdersfullinfo->getOrdersfullinfo(['id_order'=>0]);
        $this->assertEquals(ERR_SEARCH, $result);
    }

    public function testAddToOrdersfullinfoTrue()
    {
        $this->pdo->execQuery('INSERT INTO clients(first_name, last_name, login, pass, discount, hash, role, active) VALUES ("test","test","test","test","1","test","admin","yes")');
        $id_user = $this->pdo->getPdo()->lastInsertId();
        $this->pdo->execQuery('INSERT INTO books (title, price, description) VALUES ("test book","15","test description")');
        $id_book = $this->pdo->getPdo()->lastInsertId();
        $this->pdo->execQuery('INSERT INTO payment (name) VALUES ("test")');
        $id_pay = $this->pdo->getPdo()->lastInsertId();
        $this->pdo->execQuery('INSERT INTO orders (id_client,discount_client,id_payment,total_discount,total_price)'
            .' VALUES ("'.$id_user.'", "1", "'.$id_pay.'", "1","1")');
        $id_order = $this->pdo->getPdo()->lastInsertId();
        $result = $this->modelOrdersfullinfo->addToOrdersfullinfo([
            'id_order'=>$id_order,
            'id_book'=>$id_book,
            'title_book'=>'test',
            'count'=>1,
            'price'=>1,
            'discount_book'=>1
        ]);
        $this->assertEquals(1, $result);
        $this->pdo->execQuery('DELETE FROM orders_full_info WHERE id_order='.$id_order);
        $this->pdo->execQuery('DELETE FROM orders WHERE id='.$id_order);
        $this->pdo->execQuery('DELETE FROM payment WHERE id='.$id_pay);
        $this->pdo->execQuery('DELETE FROM books WHERE id='.$id_book);
        $this->pdo->execQuery('DELETE FROM clients WHERE id='.$id_user);
    }

    public function testAddToOrdersfullinfoException()
    {
        $this->setExpectedException(Exception::class);
        $result = $this->modelOrdersfullinfo->addToOrdersfullinfo([]);
    }
}