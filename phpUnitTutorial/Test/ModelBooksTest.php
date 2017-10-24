<?php
require_once '../../server/app/lib/config.php';
require_once 'Db.php';
require_once '../../server/app/models/ModelDB.php';
require_once '../../server/app/models/ModelBooks.php';
class ModelBooksTest extends PHPUnit_Framework_TestCase
{
    protected $modelBooks;
    protected $pdo;

    protected function setUp()
    {
        $this->modelBooks = new ModelBooks();
        $this->pdo = new Db();
    }

    protected function tearDown()
    {
        $this->modelBooks = NULL;
        $this->pdo = NULL;
    }

    public function testGetBooksAllData()
    {
        $this->pdo->execQuery('INSERT INTO books (title, price, description) VALUES ("test book","15","test description")');
        $id_book = $this->pdo->getPdo()->lastInsertId();
        $result = $this->modelBooks->getBooks();
        $this->assertInternalType('array', $result);
        $this->assertTrue(count($result) > 0);
        $this->pdo->execQuery('DELETE FROM books WHERE id='.$id_book);
    }

    public function testGetBooksDataById()
    {
        $this->pdo->execQuery('INSERT INTO books (title, price, description) VALUES ("test book","15","test description")');
        $id_book = $this->pdo->getPdo()->lastInsertId();
        $result = $this->modelBooks->getBooks(['id'=>$id_book]);
        $this->assertInternalType('array', $result);
        $this->assertTrue(count($result) > 0);
        $this->pdo->execQuery('DELETE FROM books WHERE id='.$id_book);
    }

    public function testGetBooksAllDataAccessDenied()
    {
        $result = $this->modelBooks->getBooks(['hash'=>0, 'id_client'=>'2']);
        $this->assertEquals(ERR_ACCESS, $result);
    }

    public function testGetBooksAllDataAdmin()
    {
        $this->pdo->execQuery('INSERT INTO books (title, price, description, active) VALUES ("test book","15","test description","no")');
        $id_book = $this->pdo->getPdo()->lastInsertId();
        $this->pdo->execQuery('INSERT INTO clients(first_name, last_name, login, pass, discount, hash, role, active) VALUES ("test","test","test","test","1","test","admin","yes")');
        $id_user = $this->pdo->getPdo()->lastInsertId();
        $result = $this->modelBooks->getBooks(['hash'=>'test', 'id_client'=>$id_user]);
        $this->assertInternalType('array', $result);
        $this->assertTrue(count($result) > 0);
        $this->pdo->execQuery('DELETE FROM books WHERE id='.$id_book);
        $this->pdo->execQuery('DELETE FROM clients WHERE id='.$id_user);
    }

    public function testGetBooksDataByIdAdmin()
    {
        $this->pdo->execQuery('INSERT INTO books (title, price, description, active) VALUES ("test book","15","test description","no")');
        $id_book = $this->pdo->getPdo()->lastInsertId();
        $this->pdo->execQuery('INSERT INTO clients(first_name, last_name, login, pass, discount, hash, role, active) VALUES ("test","test","test","test","1","test","admin","yes")');
        $id_user = $this->pdo->getPdo()->lastInsertId();
        $result = $this->modelBooks->getBooks(['hash'=>'test', 'id_client'=>$id_user, 'id'=>$id_book]);
        $this->assertInternalType('array', $result);
        $this->assertTrue(count($result) > 0);
        $this->pdo->execQuery('DELETE FROM books WHERE id='.$id_book);
        $this->pdo->execQuery('DELETE FROM clients WHERE id='.$id_user);
    }

    public function testAddBookAccessDenied1()
    {
        $result = $this->modelBooks->addBook(['id'=>0]);
        $this->assertEquals(ERR_ACCESS, $result);
    }

    public function testAddBookAccessDenied2()
    {
        $result = $this->modelBooks->addBook(['hash'=>0, 'id_client'=>'2']);
        $this->assertEquals(ERR_ACCESS, $result);
    }

    public function testAddBookEmptyAll()
    {
        $this->pdo->execQuery('INSERT INTO clients(first_name, last_name, login, pass, discount, hash, role, active) VALUES ("test","test","test","test","1","test","admin","yes")');
        $id_user = $this->pdo->getPdo()->lastInsertId();
        $result = $this->modelBooks->addBook(['hash'=>'test', 'id_client'=>$id_user]);
        $this->assertEquals(ERR_FIELDS, $result);
        $this->pdo->execQuery('DELETE FROM clients WHERE id='.$id_user);
    }

    public function testAddBookEmptyTitle()
    {
        $this->pdo->execQuery('INSERT INTO clients(first_name, last_name, login, pass, discount, hash, role, active) VALUES ("test","test","test","test","1","test","admin","yes")');
        $id_user = $this->pdo->getPdo()->lastInsertId();
        $result = $this->modelBooks->addBook(['hash'=>'test', 'id_client'=>$id_user,
                'price'=>1,
                'description'=>'test',
                'active'=>'yes',
                'img'=>'test'
            ]);
        $this->assertEquals(ERR_FIELDS, $result);
        $this->pdo->execQuery('DELETE FROM clients WHERE id='.$id_user);
    }

    public function testAddBookEmptyPrice()
    {
        $this->pdo->execQuery('INSERT INTO clients(first_name, last_name, login, pass, discount, hash, role, active) VALUES ("test","test","test","test","1","test","admin","yes")');
        $id_user = $this->pdo->getPdo()->lastInsertId();
        $result = $this->modelBooks->addBook(['hash'=>'test', 'id_client'=>$id_user,
            'title'=>'test',
            'description'=>'test',
            'active'=>'yes',
            'img'=>'test'
        ]);
        $this->assertEquals(ERR_FIELDS, $result);
        $this->pdo->execQuery('DELETE FROM clients WHERE id='.$id_user);
    }

    public function testAddBookEmptyDescription()
    {
        $this->pdo->execQuery('INSERT INTO clients(first_name, last_name, login, pass, discount, hash, role, active) VALUES ("test","test","test","test","1","test","admin","yes")');
        $id_user = $this->pdo->getPdo()->lastInsertId();
        $result = $this->modelBooks->addBook(['hash'=>'test', 'id_client'=>$id_user,
            'title'=>'test',
            'price'=>1,
            'active'=>'yes',
            'img'=>'test'
        ]);
        $this->assertEquals(ERR_FIELDS, $result);
        $this->pdo->execQuery('DELETE FROM clients WHERE id='.$id_user);
    }

    public function testAddBookEmptyActive()
    {
        $this->pdo->execQuery('INSERT INTO clients(first_name, last_name, login, pass, discount, hash, role, active) VALUES ("test","test","test","test","1","test","admin","yes")');
        $id_user = $this->pdo->getPdo()->lastInsertId();
        $result = $this->modelBooks->addBook(['hash'=>'test', 'id_client'=>$id_user,
            'title'=>'test',
            'price'=>1,
            'description'=>'test',
            'img'=>'test'
        ]);
        $this->assertEquals(ERR_FIELDS, $result);
        $this->pdo->execQuery('DELETE FROM clients WHERE id='.$id_user);
    }

    public function testAddBookEmptyImg()
    {
        $this->pdo->execQuery('INSERT INTO clients(first_name, last_name, login, pass, discount, hash, role, active) VALUES ("test","test","test","test","1","test","admin","yes")');
        $id_user = $this->pdo->getPdo()->lastInsertId();
        $result = $this->modelBooks->addBook(['hash'=>'test', 'id_client'=>$id_user,
            'title'=>'test',
            'price'=>1,
            'description'=>'test',
            'active'=>'yes',
        ]);
        $this->assertEquals(ERR_FIELDS, $result);
        $this->pdo->execQuery('DELETE FROM clients WHERE id='.$id_user);
    }

    public function testAddBookWrongDisc()
    {
        $this->pdo->execQuery('INSERT INTO clients(first_name, last_name, login, pass, discount, hash, role, active) VALUES ("test","test","test","test","1","test","admin","yes")');
        $id_user = $this->pdo->getPdo()->lastInsertId();
        $result = $this->modelBooks->addBook(['hash'=>'test', 'id_client'=>$id_user,
            'title'=>'test',
            'price'=>1,
            'description'=>'test',
            'active'=>'yes',
            'img'=>'test',
            'discount'=>'test'
        ]);
        $this->assertEquals(ERR_DISC, $result);
        $this->pdo->execQuery('DELETE FROM clients WHERE id='.$id_user);
    }

    public function testAddBookWrongDisc2()
    {
        $this->pdo->execQuery('INSERT INTO clients(first_name, last_name, login, pass, discount, hash, role, active) VALUES ("test","test","test","test","1","test","admin","yes")');
        $id_user = $this->pdo->getPdo()->lastInsertId();
        $result = $this->modelBooks->addBook(['hash'=>'test', 'id_client'=>$id_user,
            'title'=>'test',
            'price'=>1,
            'description'=>'test',
            'active'=>'yes',
            'img'=>'test',
            'discount'=>'10000'
        ]);
        $this->assertEquals(ERR_DISC_INC, $result);
        $this->pdo->execQuery('DELETE FROM clients WHERE id='.$id_user);
    }

    public function testAddBookWrongPrice()
    {
        $this->pdo->execQuery('INSERT INTO clients(first_name, last_name, login, pass, discount, hash, role, active) VALUES ("test","test","test","test","1","test","admin","yes")');
        $id_user = $this->pdo->getPdo()->lastInsertId();
        $result = $this->modelBooks->addBook(['hash'=>'test', 'id_client'=>$id_user,
            'title'=>'test',
            'price'=>'test',
            'description'=>'test',
            'active'=>'yes',
            'img'=>'test',
            'discount'=>'1'
        ]);
        $this->assertEquals(ERR_PRICE, $result);
        $this->pdo->execQuery('DELETE FROM clients WHERE id='.$id_user);
    }

    public function testAddBookWrongPrice2()
    {
        $this->pdo->execQuery('INSERT INTO clients(first_name, last_name, login, pass, discount, hash, role, active) VALUES ("test","test","test","test","1","test","admin","yes")');
        $id_user = $this->pdo->getPdo()->lastInsertId();
        $result = $this->modelBooks->addBook(['hash'=>'test', 'id_client'=>$id_user,
            'title'=>'test',
            'price'=>'-100',
            'description'=>'test',
            'active'=>'yes',
            'img'=>'test',
            'discount'=>'1'
        ]);
        $this->assertEquals(ERR_PRICE, $result);
        $this->pdo->execQuery('DELETE FROM clients WHERE id='.$id_user);
    }

    public function testAddBookTrue()
    {
        $this->pdo->execQuery('INSERT INTO clients(first_name, last_name, login, pass, discount, hash, role, active) VALUES ("test","test","test","test","1","test","admin","yes")');
        $id_user = $this->pdo->getPdo()->lastInsertId();
        $result = $this->modelBooks->addBook(['hash'=>'test', 'id_client'=>$id_user,
            'title'=>'test',
            'price'=>'1',
            'description'=>'test',
            'active'=>'yes',
            'img'=>'test',
            'discount'=>'1'
        ]);
        $this->assertInternalType('array', $result);
        $this->assertTrue(count($result) > 0);
        $this->pdo->execQuery('DELETE FROM clients WHERE id='.$id_user);
        $this->pdo->execQuery('DELETE FROM books WHERE id='.$result['id_book']);
    }

    public function testEditBookAccessDenied1()
    {
        $result = $this->modelBooks->editBook(['id'=>0]);
        $this->assertEquals(ERR_ACCESS, $result);
    }

    public function testEditBookAccessDenied2()
    {
        $result = $this->modelBooks->editBook(['hash'=>0, 'id_client'=>'2']);
        $this->assertEquals(ERR_ACCESS, $result);
    }

    public function testEditBookEmptyAll()
    {
        $this->pdo->execQuery('INSERT INTO clients(first_name, last_name, login, pass, discount, hash, role, active) VALUES ("test","test","test","test","1","test","admin","yes")');
        $id_user = $this->pdo->getPdo()->lastInsertId();
        $result = $this->modelBooks->editBook(['hash'=>'test', 'id_client'=>$id_user]);
        $this->assertEquals(ERR_FIELDS, $result);
        $this->pdo->execQuery('DELETE FROM clients WHERE id='.$id_user);
    }

    public function testEditBookEmptyTitle()
    {
        $this->pdo->execQuery('INSERT INTO clients(first_name, last_name, login, pass, discount, hash, role, active) VALUES ("test","test","test","test","1","test","admin","yes")');
        $id_user = $this->pdo->getPdo()->lastInsertId();
        $result = $this->modelBooks->editBook(['hash'=>'test', 'id_client'=>$id_user,
            'price'=>1,
            'description'=>'test',
            'active'=>'yes',
            'img'=>'test'
        ]);
        $this->assertEquals(ERR_FIELDS, $result);
        $this->pdo->execQuery('DELETE FROM clients WHERE id='.$id_user);
    }

    public function testEditBookEmptyPrice()
    {
        $this->pdo->execQuery('INSERT INTO clients(first_name, last_name, login, pass, discount, hash, role, active) VALUES ("test","test","test","test","1","test","admin","yes")');
        $id_user = $this->pdo->getPdo()->lastInsertId();
        $result = $this->modelBooks->editBook(['hash'=>'test', 'id_client'=>$id_user,
            'title'=>'test',
            'description'=>'test',
            'active'=>'yes',
            'img'=>'test'
        ]);
        $this->assertEquals(ERR_FIELDS, $result);
        $this->pdo->execQuery('DELETE FROM clients WHERE id='.$id_user);
    }

    public function testEditBookEmptyDescription()
    {
        $this->pdo->execQuery('INSERT INTO clients(first_name, last_name, login, pass, discount, hash, role, active) VALUES ("test","test","test","test","1","test","admin","yes")');
        $id_user = $this->pdo->getPdo()->lastInsertId();
        $result = $this->modelBooks->editBook(['hash'=>'test', 'id_client'=>$id_user,
            'title'=>'test',
            'price'=>1,
            'active'=>'yes',
            'img'=>'test'
        ]);
        $this->assertEquals(ERR_FIELDS, $result);
        $this->pdo->execQuery('DELETE FROM clients WHERE id='.$id_user);
    }

    public function testEditBookEmptyActive()
    {
        $this->pdo->execQuery('INSERT INTO clients(first_name, last_name, login, pass, discount, hash, role, active) VALUES ("test","test","test","test","1","test","admin","yes")');
        $id_user = $this->pdo->getPdo()->lastInsertId();
        $result = $this->modelBooks->editBook(['hash'=>'test', 'id_client'=>$id_user,
            'title'=>'test',
            'price'=>1,
            'description'=>'test',
            'img'=>'test'
        ]);
        $this->assertEquals(ERR_FIELDS, $result);
        $this->pdo->execQuery('DELETE FROM clients WHERE id='.$id_user);
    }

    public function testEditBookEmptyImg()
    {
        $this->pdo->execQuery('INSERT INTO clients(first_name, last_name, login, pass, discount, hash, role, active) VALUES ("test","test","test","test","1","test","admin","yes")');
        $id_user = $this->pdo->getPdo()->lastInsertId();
        $result = $this->modelBooks->editBook(['hash'=>'test', 'id_client'=>$id_user,
            'title'=>'test',
            'price'=>1,
            'description'=>'test',
            'active'=>'yes',
        ]);
        $this->assertEquals(ERR_FIELDS, $result);
        $this->pdo->execQuery('DELETE FROM clients WHERE id='.$id_user);
    }

    public function testEditBookWrongDisc()
    {
        $this->pdo->execQuery('INSERT INTO clients(first_name, last_name, login, pass, discount, hash, role, active) VALUES ("test","test","test","test","1","test","admin","yes")');
        $id_user = $this->pdo->getPdo()->lastInsertId();
        $result = $this->modelBooks->editBook(['hash'=>'test', 'id_client'=>$id_user,
            'title'=>'test',
            'price'=>1,
            'description'=>'test',
            'active'=>'yes',
            'img'=>'test',
            'discount'=>'test'
        ]);
        $this->assertEquals(ERR_DISC, $result);
        $this->pdo->execQuery('DELETE FROM clients WHERE id='.$id_user);
    }

    public function testEditBookWrongDisc2()
    {
        $this->pdo->execQuery('INSERT INTO clients(first_name, last_name, login, pass, discount, hash, role, active) VALUES ("test","test","test","test","1","test","admin","yes")');
        $id_user = $this->pdo->getPdo()->lastInsertId();
        $result = $this->modelBooks->editBook(['hash'=>'test', 'id_client'=>$id_user,
            'title'=>'test',
            'price'=>1,
            'description'=>'test',
            'active'=>'yes',
            'img'=>'test',
            'discount'=>'10000'
        ]);
        $this->assertEquals(ERR_DISC_INC, $result);
        $this->pdo->execQuery('DELETE FROM clients WHERE id='.$id_user);
    }

    public function testEditBookWrongPrice()
    {
        $this->pdo->execQuery('INSERT INTO clients(first_name, last_name, login, pass, discount, hash, role, active) VALUES ("test","test","test","test","1","test","admin","yes")');
        $id_user = $this->pdo->getPdo()->lastInsertId();
        $result = $this->modelBooks->editBook(['hash'=>'test', 'id_client'=>$id_user,
            'title'=>'test',
            'price'=>'test',
            'description'=>'test',
            'active'=>'yes',
            'img'=>'test',
            'discount'=>'1'
        ]);
        $this->assertEquals(ERR_PRICE, $result);
        $this->pdo->execQuery('DELETE FROM clients WHERE id='.$id_user);
    }

    public function testEditBookWrongPrice2()
    {
        $this->pdo->execQuery('INSERT INTO clients(first_name, last_name, login, pass, discount, hash, role, active) VALUES ("test","test","test","test","1","test","admin","yes")');
        $id_user = $this->pdo->getPdo()->lastInsertId();
        $result = $this->modelBooks->editBook(['hash'=>'test', 'id_client'=>$id_user,
            'title'=>'test',
            'price'=>'-100',
            'description'=>'test',
            'active'=>'yes',
            'img'=>'test',
            'discount'=>'1'
        ]);
        $this->assertEquals(ERR_PRICE, $result);
        $this->pdo->execQuery('DELETE FROM clients WHERE id='.$id_user);
    }

    public function testEditBookTrue()
    {
        $this->pdo->execQuery('INSERT INTO clients(first_name, last_name, login, pass, discount, hash, role, active) VALUES ("test","test","test","test","1","test","admin","yes")');
        $id_user = $this->pdo->getPdo()->lastInsertId();
        $this->pdo->execQuery('INSERT INTO books (title, price, description) VALUES ("test book","15","test description")');
        $id_book = $this->pdo->getPdo()->lastInsertId();
        $result = $this->modelBooks->editBook(['hash'=>'test', 'id_client'=>$id_user,
            'title'=>'test',
            'price'=>'1',
            'description'=>'test',
            'active'=>'yes',
            'img'=>'test',
            'discount'=>'1',
            'id'=>$id_book
        ]);
        $this->assertEquals(1, $result);
        $this->pdo->execQuery('DELETE FROM clients WHERE id='.$id_user);
        $this->pdo->execQuery('DELETE FROM books WHERE id='.$id_book);
    }

//    public function testAddBookTrue()
//    {
//        $this->pdo->execQuery('INSERT INTO clients(first_name, last_name, login, pass, discount, hash, role, active) VALUES ("test","test","test","test","1","test","admin","yes")');
//        $id_user = $this->pdo->getPdo()->lastInsertId();
//        $result = $this->modelBooks->addBook(['hash'=>'test', 'id_client'=>$id_user,
//            'title'=>'test',
//            'price'=>'1',
//            'description'=>'test',
//            'active'=>'yes',
//            'img'=>'test',
//            'discount'=>'1'
//        ]);
//        $this->assertInternalType('array', $result);
//        $this->assertTrue(count($result) > 0);
//        $this->pdo->execQuery('DELETE FROM clients WHERE id='.$id_user);
//        $this->pdo->execQuery('DELETE FROM books WHERE id='.$result['id_book']);
//    }
}