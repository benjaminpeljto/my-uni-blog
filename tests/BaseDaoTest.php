<?php

use PHPUnit\Framework\TestCase;
require_once './rest/dao/BaseDao.class.php';

class BaseDaoTest extends TestCase
{
    private $baseDao;
    private $testEntities = [];

    protected function setUp(): void
    {
        $this->baseDao = new BaseDao('users');
    }

    public function testConnection()
    {
        $this->assertNotNull($this->baseDao->get_connection(), "Database connection should not be null.");
    }

    public function testGetAll()
    {
        $results = $this->baseDao->get_all();
        $this->assertIsArray($results, "Expected results to be an array.");
    }

    public function testAddEntity()
    {
        $entity = ['first_name' => 'TestName', 'last_name' => 'TestLast', 'email' => "test1@email.com", 'password' => "testPassword", 'age' => 33];
        $addedEntity = $this->baseDao->add($entity);
        $this->testEntities[] = $addedEntity['id'];

        $this->assertArrayHasKey('id', $addedEntity, "Added entity should have an 'id' key.");
        $this->assertEquals('TestName', $addedEntity['first_name'], "Entity first name should be 'TestName'.");
        $this->assertEquals('test1@email.com', $addedEntity['email'], "Entity email should be 'benjamin@email.com'.");
    }

    public function testGetById()
    {
        $entity = ['first_name' => 'TestName', 'last_name' => 'TestLast', 'email' => "test2@email.com", 'password' => "testPassword", 'age' => 33];
        $addedEntity = $this->baseDao->add($entity);
        $this->testEntities[] = $addedEntity['id'];

        $fetchedEntity = $this->baseDao->get_by_id($addedEntity['id']);
        $this->assertCount(1, $fetchedEntity, "Expected to fetch exactly one entity.");
        $this->assertEquals($addedEntity['first_name'], $fetchedEntity[0]['first_name'], "Fetched entity first name should match.");
        $this->assertEquals($addedEntity['email'], $fetchedEntity[0]['email'], "Fetched entity email should match.");
    }

    public function testDeleteEntity()
    {
        $entity = ['first_name' => 'TestName', 'last_name' => 'TestLast', 'email' => "benjamin@email.com", 'password' => "testPassword", 'age' => 33];
        $addedEntity = $this->baseDao->add($entity);

        $this->baseDao->delete($addedEntity['id']);
        $fetchedEntity = $this->baseDao->get_by_id($addedEntity['id']);

        $this->assertEmpty($fetchedEntity, "Fetched entity should be empty after deletion.");
    }

    protected function tearDown(): void
    {
        foreach ($this->testEntities as $entityId) {
            $this->baseDao->delete($entityId);
        }
        $this->baseDao = null;
    }
}
