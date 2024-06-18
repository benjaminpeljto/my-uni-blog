<?php

use GuzzleHttp\Exception\GuzzleException;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
require_once './rest/dao/UsersDao.class.php';
class LoginTest extends TestCase
{
    private $client;
    private $usersDao;
    private $userToAdd;
    private $addedUser;
    protected function setUp(): void
    {
        $this->client = new Client([
            'base_uri' => 'http://localhost/my-uni-blog/rest/',
            'http_errors' => false
        ]);

        $this->userToAdd = [
            'first_name' => 'Test',
            'last_name' => 'User',
            'email' => 'testuser@example.com',
            'password' => md5('password123'),
            'age' => 30,
            'banned' => 0,
            'admin' => 0
        ];
    }

    /**
     * @throws GuzzleException
     */
    public function testLoginSuccess()
    {
        $this->usersDao = new UsersDao();
        $this->addedUser = $this->usersDao->add($this->userToAdd);

        $response = $this->client->post('login', [
            'json' => [
                'email' => 'testuser@example.com',
                'password' => 'password123'
            ]
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $data = json_decode($response->getBody(), true);
        $this->assertArrayHasKey('token', $data, "Response should contain a JWT token.");
    }

    public function testLoginWrongPassword()
    {
        $this->usersDao = new UsersDao();
        $this->addedUser = $this->usersDao->add($this->userToAdd);

        $response = $this->client->post('login', [
            'json' => [
                'email' => 'testuser@example.com',
                'password' => 'wrongpassword'
            ]
        ]);

        $this->assertEquals(404, $response->getStatusCode());
        $data = json_decode($response->getBody(), true);
        $this->assertEquals("Wrong password", $data['message'], "Response should indicate wrong password.");
    }

    protected function tearDown(): void
    {
        $this->usersDao->delete($this->addedUser['id']);
        $this->client = null;
        $this->usersDao = null;
        $this->userToAdd = null;
        $this->addedUser = null;
    }
}