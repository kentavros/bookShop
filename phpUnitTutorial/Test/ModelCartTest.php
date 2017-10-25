<?php
require_once '../../server/app/lib/config.php';
require_once 'Db.php';
require_once '../../server/app/models/ModelDB.php';
require_once '../../server/app/models/ModelCart.php';
class ModelCartTest extends PHPUnit_Framework_TestCase
{
    protected $modelCart;
    protected $pdo;

    protected function setUp()
    {
        $this->modelCart = new ModelCart();
        $this->pdo = new Db();
    }

    protected function tearDown()
    {
        $this->modelCart = NULL;
        $this->pdo = NULL;
    }

    public function testGetBooksByIdClientException1()
    {
        $this->setExpectedException(Exception::class);
        $this->modelCart->getBooksByIdClient(['i d'=>'0']);
    }

    public function testGetBooksByIdClientException2()
    {
        $this->setExpectedException(Exception::class);
        $this->modelCart->getBooksByIdClient(['id'=>'']);
    }

    public function testGetBooksByIdTrue()
    {
        $this->pdo->execQuery('INSERT INTO books (title, price, description) VALUES ("test book","15","test description")');
        $id_book = $this->pdo->getPdo()->lastInsertId();
        $this->pdo->execQuery('INSERT INTO clients(first_name, last_name, login, pass, discount, hash, role, active) VALUES ("test","test","test","test","1","test","admin","yes")');
        $id_user = $this->pdo->getPdo()->lastInsertId();
        $this->pdo->execQuery('INSERT INTO cart (id_book, id_client, count) VALUES ("'.$id_book.'", "'.$id_user.'", "1")');
        $id_cart = $this->pdo->getPdo()->lastInsertId();
        $result = $this->modelCart->getBooksByIdClient(['id'=>$id_user]);
        $this->assertInternalType('array', $result);
        $this->assertTrue(count($result) > 0);
        $this->pdo->execQuery('DELETE FROM cart WHERE id='.$id_cart);
        $this->pdo->execQuery('DELETE FROM clients WHERE id='.$id_user);
        $this->pdo->execQuery('DELETE FROM books WHERE id='.$id_book);
    }

    public function testUpdateCartFalse()
    {
        $this->modelCart->updateCart(['id_client'=>2]);
        $this->assertFalse(false);
    }

    public function testUpdateCartUpdate()
    {
        $this->pdo->execQuery('INSERT INTO books (title, price, description) VALUES ("test book","15","test description")');
        $id_book = $this->pdo->getPdo()->lastInsertId();
        $this->pdo->execQuery('INSERT INTO clients(first_name, last_name, login, pass, discount, hash, role, active) VALUES ("test","test","test","test","1","test","admin","yes")');
        $id_user = $this->pdo->getPdo()->lastInsertId();
        $this->pdo->execQuery('INSERT INTO cart (id_book, id_client, count) VALUES ("'.$id_book.'", "'.$id_user.'", "1")');
        $id_cart = $this->pdo->getPdo()->lastInsertId();
        $result = $this->modelCart->updateCart([['id_client'=>$id_user], ['checked'=>true, 'count'=>5, 'id'=>$id_book]]);
        $this->assertEquals(UPDATE, $result);
        $this->pdo->execQuery('DELETE FROM cart WHERE id='.$id_cart);
        $this->pdo->execQuery('DELETE FROM clients WHERE id='.$id_user);
        $this->pdo->execQuery('DELETE FROM books WHERE id='.$id_book);
    }

    public function testAddToCartErrorCount()
    {
        $result = $this->modelCart->addToCart(['count'=>'-1']);
        $this->assertEquals(ERR_COUNT, $result);
    }

    public function testAddToCartData()
    {
        $this->pdo->execQuery('INSERT INTO books (title, price, description) VALUES ("test book","15","test description")');
        $id_book = $this->pdo->getPdo()->lastInsertId();
        $this->pdo->execQuery('INSERT INTO clients(first_name, last_name, login, pass, discount, hash, role, active) VALUES ("test","test","test","test","1","test","admin","yes")');
        $id_user = $this->pdo->getPdo()->lastInsertId();
        $result = $this->modelCart->addToCart(['count'=>3, 'id_book'=>$id_book, 'id_client'=>$id_user]);
        $this->assertEquals(1, $result);
        $this->pdo->execQuery('DELETE FROM cart WHERE id_client='.$id_user);
        $this->pdo->execQuery('DELETE FROM clients WHERE id='.$id_user);
        $this->pdo->execQuery('DELETE FROM books WHERE id='.$id_book);
    }

    public function testClearCart()
    {
        $result = $this->modelCart->clearCart(['id'=>false]);
        $this->assertEquals(ERR_DATA, $result);
    }

    public function testClearCartTrue()
    {
        $this->pdo->execQuery('INSERT INTO books (title, price, description) VALUES ("test book","15","test description")');
        $id_book = $this->pdo->getPdo()->lastInsertId();
        $this->pdo->execQuery('INSERT INTO clients(first_name, last_name, login, pass, discount, hash, role, active) VALUES ("test","test","test","test","1","test","admin","yes")');
        $id_user = $this->pdo->getPdo()->lastInsertId();
        $this->pdo->execQuery('INSERT INTO cart (id_book, id_client, count) VALUES ("'.$id_book.'", "'.$id_user.'", "1")');
        $id_cart = $this->pdo->getPdo()->lastInsertId();
        $result = $this->modelCart->clearCart(['id'=>$id_user]);
        $this->assertEquals(1, $result);
        $this->pdo->execQuery('DELETE FROM clients WHERE id='.$id_user);
        $this->pdo->execQuery('DELETE FROM books WHERE id='.$id_book);
    }
}