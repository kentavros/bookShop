<?php
require_once '../../server/app/lib/config.php';
require_once 'Db.php';
require_once '../../server/app/models/ModelDB.php';
require_once '../../server/app/models/ModelPayment.php';
class ModelPaymentTest extends PHPUnit_Framework_TestCase
{
    protected $modelPayment;
    protected $pdo;

    protected function setUp()
    {
        $this->modelPayment = new ModelPayment();
        $this->pdo = new Db();
    }

    protected function tearDown()
    {
        $this->modelPayment = NULL;
        $this->pdo = NULL;
    }

    public function testGetPaymentAllData()
    {
        $this->pdo->execQuery('INSERT INTO payment (name) VALUES ("test")');
        $id_pay = $this->pdo->getPdo()->lastInsertId();
        $result = $this->modelPayment->getPayment();
        $this->assertInternalType('array', $result);
        $this->assertTrue(count($result) > 0);
        $this->pdo->execQuery('DELETE FROM payment WHERE id='.$id_pay);
    }

    public function testGetPaymentById()
    {
        $this->pdo->execQuery('INSERT INTO payment (name) VALUES ("test")');
        $id_pay = $this->pdo->getPdo()->lastInsertId();
        $result = $this->modelPayment->getPayment(['id'=>$id_pay]);
        $this->assertInternalType('array', $result);
        $this->assertTrue(count($result) > 0);
        $this->pdo->execQuery('DELETE FROM payment WHERE id='.$id_pay);
    }

    public function testGetPaymentNotFound()
    {
        $result = $this->modelPayment->getPayment(['id'=>0]);
        $this->assertEquals(ERR_SEARCH, $result);
    }

    public function testGetPaymentException()
    {
        $this->setExpectedException(Exception::class);
        $result = $this->modelPayment->getPayment(['i d'=>0]);
    }
}