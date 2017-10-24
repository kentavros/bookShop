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

    public function testGetIds()
    {

    }
}