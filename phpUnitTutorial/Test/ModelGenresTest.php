<?php
require_once '../../server/app/lib/config.php';
require_once 'Db.php';
require_once '../../server/app/models/ModelDB.php';
require_once '../../server/app/models/ModelGenres.php';
class ModelGenresTest extends PHPUnit_Framework_TestCase
{
    protected $modelGenres;
    protected $pdo;

    protected function setUp()
    {
        $this->modelGenres = new ModelGenres();
        $this->pdo = new Db();
    }

    protected function tearDown()
    {
        $this->modelGenres = NULL;
        $this->pdo = NULL;
    }

    public function testGetGenresTrue()
    {
        $this->pdo->execQuery('INSERT INTO genres (name) VALUES ("test")');
        $id_genre = $this->pdo->getPdo()->lastInsertId();
        $result = $this->modelGenres->getGenres();
        $this->assertInternalType('array', $result);
        $this->assertTrue(count($result) > 0);
        $this->pdo->execQuery('DELETE FROM genres WHERE id='.$id_genre);
    }

    public function testGetGenresErr()
    {
        $this->pdo->execQuery('INSERT INTO genres (name) VALUES ("test")');
        $id_genre = $this->pdo->getPdo()->lastInsertId();
        $result = $this->modelGenres->getGenres(['id'=>0]);
        $this->assertEquals(ERR_SEARCH, $result);
        $this->pdo->execQuery('DELETE FROM genres WHERE id='.$id_genre);
    }

    public function testAddGenreErrDataAccessDenied()
    {
        $result = $this->modelGenres->addGenre([
            'genre'=>'test'
        ]);
        $this->assertEquals(ERR_ACCESS, $result);

    }

    public function testAddGenreTrue()
    {
        $this->pdo->execQuery('INSERT INTO clients(first_name, last_name, login, pass, discount, hash, role, active) VALUES ("test","test","test","test","1","test","admin","yes")');
        $id_user = $this->pdo->getPdo()->lastInsertId();
        $result = $this->modelGenres->addGenre([
            'hash'=>'test',
            'id_client'=>$id_user,
            'genre'=>'test'
        ]);
        $this->assertEquals(1, $result);
        $this->pdo->execQuery('DELETE FROM genres WHERE name="test"');
        $this->pdo->execQuery('DELETE FROM clients WHERE id='.$id_user);
    }

    public function testAddGenreErrData()
    {
        $this->pdo->execQuery('INSERT INTO clients(first_name, last_name, login, pass, discount, hash, role, active) VALUES ("test","test","test","test","1","test","admin","yes")');
        $id_user = $this->pdo->getPdo()->lastInsertId();
        $result = $this->modelGenres->addGenre([
            'hash'=>'test',
            'id_client'=>$id_user,
            'genre'=>''
        ]);
        $this->assertEquals(ERR_DATA, $result);
        $this->pdo->execQuery('DELETE FROM clients WHERE id='.$id_user);
    }

    public function testAddGenreErrData2()
    {
        $this->pdo->execQuery('INSERT INTO clients(first_name, last_name, login, pass, discount, hash, role, active) VALUES ("test","test","test","test","1","test","admin","yes")');
        $id_user = $this->pdo->getPdo()->lastInsertId();
        $this->pdo->execQuery('INSERT INTO genres (name) VALUES ("test")');
        $id_genre = $this->pdo->getPdo()->lastInsertId();
        $result = $this->modelGenres->addGenre([
            'hash'=>'test',
            'id_client'=>$id_user,
            'genre'=>'test'
        ]);
        $this->assertEquals(AUTHOR_EXIST, $result);
        $this->pdo->execQuery('DELETE FROM genres WHERE id='.$id_genre);
        $this->pdo->execQuery('DELETE FROM clients WHERE id='.$id_user);
    }

    public function testEditGenresTrue()
    {
        $this->pdo->execQuery('INSERT INTO clients(first_name, last_name, login, pass, discount, hash, role, active) VALUES ("test","test","test","test","1","test","admin","yes")');
        $id_user = $this->pdo->getPdo()->lastInsertId();
        $this->pdo->execQuery('INSERT INTO genres (name) VALUES ("test")');
        $id_genre = $this->pdo->getPdo()->lastInsertId();
        $result = $this->modelGenres->editGenres([
            'hash'=>'test',
            'id_client'=>$id_user,
            'id'=>$id_genre,
            'name'=>'test2'
        ]);
        $this->assertEquals(1, $result);
        $this->pdo->execQuery('DELETE FROM genres WHERE id='.$id_genre);
        $this->pdo->execQuery('DELETE FROM clients WHERE id='.$id_user);
    }

    public function testEditGenresErrAccess()
    {
        $result = $this->modelGenres->editGenres([
            'id'=>'2',
            'name'=>'test2'
        ]);
        $this->assertEquals(ERR_ACCESS, $result);
    }

    public function testDeleteGenreTrue()
    {
        $this->pdo->execQuery('INSERT INTO clients(first_name, last_name, login, pass, discount, hash, role, active) VALUES ("test","test","test","test","1","test","admin","yes")');
        $id_user = $this->pdo->getPdo()->lastInsertId();
        $this->pdo->execQuery('INSERT INTO genres (name) VALUES ("test")');
        $id_genre = $this->pdo->getPdo()->lastInsertId();
        $result = $this->modelGenres->deleteGenre([
            'hash'=>'test',
            'id_client'=>$id_user,
            'id'=>$id_genre
        ]);
        $this->assertEquals(1, $result);
        $this->pdo->execQuery('DELETE FROM clients WHERE id='.$id_user);
    }

    public function testDeleteErrAccess()
    {
        $result = $this->modelGenres->deleteGenre([
            'id'=>0
        ]);
        $this->assertEquals(ERR_ACCESS, $result);
    }
}