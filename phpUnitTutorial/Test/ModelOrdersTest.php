<?php
require_once '../../server/app/lib/config.php';
require_once 'Db.php';
require_once '../../server/app/models/ModelDB.php';
require_once '../../server/app/models/ModelOrders.php';
class ModelOrdersTest extends PHPUnit_Framework_TestCase
{
    protected $modelOrders;
    protected $pdo;

    protected function setUp()
    {
        $this->modelOrders = new ModelOrders();
        $this->pdo = new Db();
    }

    protected function tearDown()
    {
        $this->modelOrders = NULL;
        $this->pdo = NULL;
    }

    public function testGetOrdersAllOrders()
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
        $result = $this->modelOrders->getOrders();
        $this->assertInternalType('array', $result);
        $this->assertTrue(count($result) > 0);
        $this->pdo->execQuery('DELETE FROM orders_full_info WHERE id='.$id_fullOrder);
        $this->pdo->execQuery('DELETE FROM orders WHERE id='.$id_order);
        $this->pdo->execQuery('DELETE FROM payment WHERE id='.$id_pay);
        $this->pdo->execQuery('DELETE FROM books WHERE id='.$id_book);
        $this->pdo->execQuery('DELETE FROM clients WHERE id='.$id_user);
    }

    public function testGetOrdersById()
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
        $result = $this->modelOrders->getOrders(['id'=>$id_order]);
        $this->assertInternalType('array', $result);
        $this->assertTrue(count($result) > 0);
        $this->pdo->execQuery('DELETE FROM orders_full_info WHERE id='.$id_fullOrder);
        $this->pdo->execQuery('DELETE FROM orders WHERE id='.$id_order);
        $this->pdo->execQuery('DELETE FROM payment WHERE id='.$id_pay);
        $this->pdo->execQuery('DELETE FROM books WHERE id='.$id_book);
        $this->pdo->execQuery('DELETE FROM clients WHERE id='.$id_user);
    }

    public function testAddToOrdersTrue()
    {
        $this->pdo->execQuery('INSERT INTO clients(first_name, last_name, login, pass, discount, hash, role, active) VALUES ("test","test","test","test","1","test","admin","yes")');
        $id_user = $this->pdo->getPdo()->lastInsertId();
        $this->pdo->execQuery('INSERT INTO payment (name) VALUES ("test")');
        $id_pay = $this->pdo->getPdo()->lastInsertId();
        $result = $this->modelOrders->addToOrders([
            'id_client'=>$id_user,
            'discount_client'=>1,
            'id_payment'=>$id_pay,
            'total_discount'=>1,
            'total_price'=>1
        ]);
        $this->assertInternalType('array', $result);
        $this->assertTrue(count($result) > 0);
        $this->pdo->execQuery('DELETE FROM orders WHERE id_client='.$id_user);
        $this->pdo->execQuery('DELETE FROM payment WHERE id='.$id_pay);
        $this->pdo->execQuery('DELETE FROM clients WHERE id='.$id_user);
    }

    public function testAddToOrdersException()
    {
        $this->setExpectedException(Exception::class);
        $this->modelOrders->addToOrders();
    }

    public function testupdateStatusTrue()
    {
        $this->pdo->execQuery('INSERT INTO clients(first_name, last_name, login, pass, discount, hash, role, active) VALUES ("test","test","test","test","1","test","admin","yes")');
        $id_user = $this->pdo->getPdo()->lastInsertId();
        $this->pdo->execQuery('INSERT INTO payment (name) VALUES ("test")');
        $id_pay = $this->pdo->getPdo()->lastInsertId();
        $this->pdo->execQuery('INSERT INTO orders (id_client,discount_client,id_payment,total_discount,total_price)'
            .' VALUES ("'.$id_user.'", "1", "'.$id_pay.'", "1","1")');
        $id_order = $this->pdo->getPdo()->lastInsertId();
        $result = $this->modelOrders->updateStatus([
            'hash'=>'test',
            'id_client'=>$id_user,
            'id_order'=>$id_order,
            'status'=>'sent'
        ]);
        $this->assertEquals(1, $result);
        $this->pdo->execQuery('DELETE FROM orders WHERE id_client='.$id_user);
        $this->pdo->execQuery('DELETE FROM payment WHERE id='.$id_pay);
        $this->pdo->execQuery('DELETE FROM clients WHERE id='.$id_user);
    }

    public function testupdateStatusAccessDenied()
    {
        $id_order = $this->pdo->getPdo()->lastInsertId();
        $result = $this->modelOrders->updateStatus([
            'hash'=>'1',
            'id_client'=>1,
            'id_order'=>1,
            'status'=>'sent'
        ]);
        $this->assertEquals(ERR_ACCESS, $result);
    }

    public function testupdateStatusAccessDenied2()
    {
        $id_order = $this->pdo->getPdo()->lastInsertId();
        $result = $this->modelOrders->updateStatus([
            'id_order'=>1,
            'status'=>'sent'
        ]);
        $this->assertEquals(ERR_ACCESS, $result);
    }
}