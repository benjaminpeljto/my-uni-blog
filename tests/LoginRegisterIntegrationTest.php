<?php

use GuzzleHttp\Exception\GuzzleException;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

require_once './rest/dao/UsersDao.class.php';

class LoginRegisterIntegrationTest extends TestCase
{
    private $client;
    private $userToAdd;
    private static $addedUserId;
    private $usersDao;

    protected function setUp(): void
    {
        $this->client = new Client([
            'base_uri' => 'http://localhost/my-uni-blog/rest/',
            'http_errors' => false
        ]);

        $this->userToAdd = [
            'first_name' => 'Test',
            'last_name' => 'User',
            'email' => 'testregister@example.com',
            'password' => 'password1234',
            'age' => 32,
        ];

        $this->usersDao = new UsersDao();
    }

    /**
     * @throws GuzzleException
     */
    public function testRegisterSuccess()
    {
        $response = $this->client->post('register', [
            'json' => $this->userToAdd
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $data = json_decode($response->getBody(), true);

        // Store the added user's ID in the static property
        self::$addedUserId = $data['id'];
        $this->assertEquals("User added sucessfully.", $data['message'], "Response should contain success message.");
    }

    public function testLoginSuccess()
    {
        $response = $this->client->post('login', [
            'json' => [
                'email' => $this->userToAdd['email'],
                'password' => $this->userToAdd['password']
            ]
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $data = json_decode($response->getBody(), true);
        $this->assertArrayHasKey('token', $data, "Response should contain a JWT token.");
    }

    public function testLoginWrongPassword()
    {
        $response = $this->client->post('login', [
            'json' => [
                'email' => $this->userToAdd['email'],
                'password' => "wrongpassword"
            ]
        ]);

        $this->assertEquals(404, $response->getStatusCode());
        $data = json_decode($response->getBody(), true);
        $this->assertEquals("Wrong password", $data['message'], "Response should indicate wrong password.");
    }

    public function testLoginNonExistingUser()
    {
        $response = $this->client->post('login', [
            'json' => [
                'email' => "nonexistinguser@imaginary.com",
                'password' => "itdoesntmatter"
            ]
        ]);

        $this->assertEquals(404, $response->getStatusCode());
        $data = json_decode($response->getBody(), true);
        $this->assertEquals("User doesn't exist", $data['message'], "Response should indicate that user doesn't exist.");
    }

    public function testLoginBannedUser()
    {
        $this->usersDao->ban_user(self::$addedUserId);

        $response = $this->client->post('login', [
            'json' => [
                'email' => $this->userToAdd['email'],
                'password' => $this->userToAdd['password']
            ]
        ]);

        $this->assertEquals(409, $response->getStatusCode());
        $data = json_decode($response->getBody(), true);
        $this->assertEquals("Your account has been banned.", $data['message'], "Response should indicate that user's account has been banned.");
    }

    protected function tearDown(): void
    {
        // Reset instance variables
        $this->client = null;
        $this->usersDao = null;
        $this->userToAdd = null;
    }

    public static function tearDownAfterClass(): void
    {
        // Initialize UsersDao to delete the user
        $usersDao = new UsersDao();

        // Delete the test user after all tests
        if (isset(self::$addedUserId)) {
            $usersDao->delete(self::$addedUserId);
        }
        self::$addedUserId = null;
    }
}
