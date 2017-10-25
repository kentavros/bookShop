<?php
require_once '../../server/app/lib/config.php';
require_once 'Db.php';
require_once '../../server/app/models/ModelDB.php';
require_once '../../server/app/models/ModelClients.php';
class ModelClientTest extends PHPUnit_Framework_TestCase
{
    protected $modelClients;
    protected $pdo;

    protected function setUp()
    {
        $this->modelClients = new ModelClients();
        $this->pdo = new Db();
    }

    protected function tearDown()
    {
        $this->modelClients = NULL;
        $this->pdo = NULL;
    }

    public function testGetClientsAccessDenied()
    {
        $result = $this->modelClients->getClients(['hash'=>2, 'id_client'=>2]);
        $this->assertEquals(ERR_ACCESS, $result);
    }

    public function testGetClientsTrue()
    {
        $this->pdo->execQuery('INSERT INTO clients(first_name, last_name, login, pass, discount, hash, role, active) VALUES ("test","test","test","test","1","test","admin","yes")');
        $id_user = $this->pdo->getPdo()->lastInsertId();
        $result = $this->modelClients->getClients(['hash'=>'test', 'id_client'=>$id_user]);
        $this->assertInternalType('array', $result);
        $this->assertTrue(count($result) > 0);
        $this->pdo->execQuery('DELETE FROM clients WHERE id='.$id_user);
    }

    public function testCheckClientsErrSearch()
    {
        $result=$this->modelClients->checkClients(['id'=>'0']);
        $this->assertEquals(ERR_SEARCH, $result);
    }

    public function testCheckClientsTrue()
    {
        $this->pdo->execQuery('INSERT INTO clients(first_name, last_name, login, pass, discount, hash, role, active) VALUES ("test","test","test","test","1","test","admin","yes")');
        $id_user = $this->pdo->getPdo()->lastInsertId();
        $result = $this->modelClients->checkClients(['id'=>$id_user]);
        $this->assertInternalType('array', $result);
        $this->assertTrue(count($result) > 0);
        $this->pdo->execQuery('DELETE FROM clients WHERE id='.$id_user);
    }

    public function testAddClientTrue()
    {
        $result = $this->modelClients->addClient(['first_name'=>'testf', 'last_name'=>'testl', 'login'=>'testtest', 'pass'=>'test']);
        $this->assertEquals(1, $result);
        $this->pdo->execQuery('DELETE FROM clients WHERE login="testtest"');
    }

    public function testAddClientErrLogin()
    {
        $result = $this->modelClients->addClient(['first_name'=>'testf', 'last_name'=>'testl', 'login'=>'@@"%', 'pass'=>'test']);
        $this->assertEquals(ERR_LOGIN_NAME, $result);
    }

    public function testAddClientErrLogin2()
    {
        $result = $this->modelClients->addClient(['first_name'=>'testf', 'last_name'=>'testl', 'login'=>'a', 'pass'=>'test']);
        $this->assertEquals(ERR_LOGIN_LEN, $result);
    }

    public function testAddClientErrLogin3()
    {
        $this->pdo->execQuery('INSERT INTO clients(first_name, last_name, login, pass, discount, hash, role, active) VALUES ("test","test","test","test","1","test","admin","yes")');
        $id_user = $this->pdo->getPdo()->lastInsertId();
        $result = $this->modelClients->addClient(['first_name'=>'testf', 'last_name'=>'testl', 'login'=>'test', 'pass'=>'test']);
        $this->assertEquals(ERR_LOGIN, $result);
        $this->pdo->execQuery('DELETE FROM clients WHERE id='.$id_user);
    }

    public function testEditClientsTrue()
    {
        $this->pdo->execQuery('INSERT INTO clients(first_name, last_name, login, pass, discount, hash, role, active) VALUES ("test","test","test","test","1","test","admin","yes")');
        $id_user = $this->pdo->getPdo()->lastInsertId();
        $result = $this->modelClients->editClients([
            'hash'=>'test',
            'id_client'=>$id_user,
            'id'=>$id_user,
            'first_name'=>'testf',
            'last_name'=>'testl',
            'role'=>'user',
            'active'=>'yes',
            'discount'=>1,
        ]);
        $this->assertEquals(1, $result);
        $this->pdo->execQuery('DELETE FROM clients WHERE id='.$id_user);
    }

    public function testEditClientsAccessDenied()
    {
        $this->pdo->execQuery('INSERT INTO clients(first_name, last_name, login, pass, discount, hash, role, active) VALUES ("test","test","test","test","1","test","admin","yes")');
        $id_user = $this->pdo->getPdo()->lastInsertId();
        $result = $this->modelClients->editClients([
            'hash'=>'1',
            'id_client'=>$id_user,
            'id'=>$id_user,
            'first_name'=>'testf',
            'last_name'=>'testl',
            'role'=>'user',
            'active'=>'yes',
            'discount'=>1,
        ]);
        $this->assertEquals(ERR_ACCESS, $result);
        $this->pdo->execQuery('DELETE FROM clients WHERE id='.$id_user);
    }

    public function testEditClientsErrDicsount1()
    {
        $this->pdo->execQuery('INSERT INTO clients(first_name, last_name, login, pass, discount, hash, role, active) VALUES ("test","test","test","test","1","test","admin","yes")');
        $id_user = $this->pdo->getPdo()->lastInsertId();
        $result = $this->modelClients->editClients([
            'hash'=>'test',
            'id_client'=>$id_user,
            'id'=>$id_user,
            'first_name'=>'testf',
            'last_name'=>'testl',
            'role'=>'user',
            'active'=>'yes',
            'discount'=>'fffff',
        ]);
        $this->assertEquals(ERR_DISC, $result);
        $this->pdo->execQuery('DELETE FROM clients WHERE id='.$id_user);
    }

    public function testEditClientsErrDicsount2()
    {
        $this->pdo->execQuery('INSERT INTO clients(first_name, last_name, login, pass, discount, hash, role, active) VALUES ("test","test","test","test","1","test","admin","yes")');
        $id_user = $this->pdo->getPdo()->lastInsertId();
        $result = $this->modelClients->editClients([
            'hash'=>'test',
            'id_client'=>$id_user,
            'id'=>$id_user,
            'first_name'=>'testf',
            'last_name'=>'testl',
            'role'=>'user',
            'active'=>'yes',
            'discount'=>'10000',
        ]);
        $this->assertEquals(ERR_DISC_INC, $result);
        $this->pdo->execQuery('DELETE FROM clients WHERE id='.$id_user);
    }

    public function testLoginClientTrue()
    {
        $pass = md5(md5(trim('test')));
        $this->pdo->execQuery('INSERT INTO clients(first_name, last_name, login, pass, discount, hash, role, active) VALUES ("test","test","test","'.$pass.'","1","test","admin","yes")');
        $id_user = $this->pdo->getPdo()->lastInsertId();
        $result = $this->modelClients->loginClient(['pass'=>'test', 'login'=>'test']);
        $this->assertInternalType('array', $result);
        $this->assertTrue(count($result) > 0);
        $this->pdo->execQuery('DELETE FROM clients WHERE id='.$id_user);
    }

    public function testLoginClientErrPass()
    {
        $pass = md5(md5(trim('test2')));
        $this->pdo->execQuery('INSERT INTO clients(first_name, last_name, login, pass, discount, hash, role, active) VALUES ("test","test","test","'.$pass.'","1","test","admin","yes")');
        $id_user = $this->pdo->getPdo()->lastInsertId();
        $result = $this->modelClients->loginClient(['pass'=>'test', 'login'=>'test']);
        $this->assertEquals(ERR_AUTH, $result);
        $this->pdo->execQuery('DELETE FROM clients WHERE id='.$id_user);
    }

    public function testLoginClientActiveNo()
    {
        $pass = md5(md5(trim('test')));
        $this->pdo->execQuery('INSERT INTO clients(first_name, last_name, login, pass, discount, hash, role, active) VALUES ("test","test","test","'.$pass.'","1","test","admin","no")');
        $id_user = $this->pdo->getPdo()->lastInsertId();
        $result = $this->modelClients->loginClient(['pass'=>'test', 'login'=>'test']);
        $this->assertEquals(NO_ACTIVE, $result);
        $this->pdo->execQuery('DELETE FROM clients WHERE id='.$id_user);
    }
}