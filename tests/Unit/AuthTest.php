<?php

namespace Tests\Unit;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Http\Request;
use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * Password without symbols.
     */
    public function testLoginValidateFailedPassword()
    {
        $controller = new LoginController();
        $request = new Request([
            'email' => 'ahhdfgdfg@efnejf.com',
            'password' => 'hgfdhfhdghdfg34r',
        ]);
        $response = $controller->login($request);
        $this->assertEquals(401, $response->status());
    }

    /**
     * Invalid mail for login.
     */
    public function testLoginInvalidEmail()
    {
        $controller = new LoginController();
        $request = new Request([
            'email' => 'ahhdfgdfaaa.com',
            'password' => 'hgfdhfh12!',
        ]);
        $response = $controller->login($request);
        $this->assertEquals(401, $response->status());
    }

    /**
     * Failed password length.
     */
    public function testLoginFailedPasswordLength()
    {
        $controller = new LoginController();
        $request = new Request([
            'email' => 'ahhdfgdfaaa@ffff.com',
            'password' => 'hg12!',
        ]);
        $response = $controller->login($request);
        $this->assertEquals(401, $response->status());
    }

    /**
     * Failed password - without letters.
     */
    public function testLoginFailedPasswordWOLetters()
    {
        $controller = new LoginController();
        $request = new Request([
            'email' => 'ahhdfgdfaaa@ffff.com',
            'password' => '546666712!',
        ]);
        $response = $controller->login($request);
        $this->assertEquals(401, $response->status());
    }

    /**
     * Failed password - without numbers.
     */
    public function testLoginFailedPasswordWONumbers()
    {
        $controller = new LoginController();
        $request = new Request([
            'email' => 'ahhdfgdfaaa@ffff.com',
            'password' => 'aarfrffrf!',
        ]);
        $response = $controller->login($request);
        $this->assertEquals(401, $response->status());
    }

    /**
     * Successful
     */
    public function testLoginSuccessful()
    {
        $controller = new LoginController();
        $request = new Request([
            'email' => 'minasaryangayane2@gmail.com',
            'password' => 'gayane2!',
        ]);
        $response = $controller->login($request);
        $token = $response['token'];
        $this->assertNotEmpty($token);
    }

    /**
     * Failed - wrong password
     */
    public function testLoginWrongPassword()
    {
        $controller = new LoginController();
        $request = new Request([
            'email' => 'minasaryangayane2@gmail.com',
            'password' => 'gayane2!!!!',
        ]);
        $response = $controller->login($request);
        $this->assertEquals(401, $response->status());
    }

    /**
     * Failed - wrong email
     */
    public function testLoginWrongEmail()
    {
        $controller = new LoginController();
        $request = new Request([
            'email' => 'minasaryangayane2222@gmail.com',
            'password' => 'gayane2!',
        ]);
        $response = $controller->login($request);
        $this->assertEquals(401, $response->status());
    }

    /**
     * Failed - password doesn't exist
     */
    public function testLoginPasswordNotExist()
    {
        $controller = new LoginController();
        $request = new Request([
            'email' => 'minasaryangayane2222@gmail.com'
        ]);
        $response = $controller->login($request);
        $this->assertEquals(401, $response->status());
    }

    /**
     * Failed - email doesn't exist
     */
    public function testLoginEmailNotExist()
    {
        $controller = new LoginController();
        $request = new Request([
            'password' => 'gayane2!'
        ]);
        $response = $controller->login($request);
        $this->assertEquals(401, $response->status());
    }

    /**
     * Failed - empty password
     */
    public function testLoginEmptyPassword()
    {
        $controller = new LoginController();
        $request = new Request([
            'email' => 'minasaryangayane2222@gmail.com',
            'password' => ''
        ]);
        $response = $controller->login($request);
        $this->assertEquals(401, $response->status());
    }

    /**
     * Failed - empty email
     */
    public function testLoginEmptyEmail()
    {
        $controller = new LoginController();
        $request = new Request([
            'email' => '',
            'password' => 'gayane2!'
        ]);
        $response = $controller->login($request);
        $this->assertEquals(401, $response->status());
    }

    // Register

    /**
     * Successful
     */
    public function testRegisterSuccessful()
    {
        $controller = new RegisterController();
        $request = new Request([
            'email' => 'minasaryangaya@gmail.com',
            'name' => 'Gayane',
            'password' => 'gayane8!',
            'password_confirmation' => 'gayane8!'
        ]);
        $response = $controller->register($request);
        $this->assertEquals(200, $response->status());
    }

    /**
     * Not the same passwords
     */
    public function testRegisterPasswordsNotSame()
    {
        $controller = new RegisterController();
        $request = new Request([
            'email' => 'ahhdfgdfg@efnejf.com',
            'name' => 'Gayane',
            'password' => 'gayane2!',
            'password_confirmation' => 'gayane2!!'
        ]);
        $response = $controller->register($request);
        $this->assertEquals(401, $response->status());
    }

    /**
     * Invalid email
     */
    public function testRegisterInvalidEmail()
    {
        $controller = new RegisterController();
        $request = new Request([
            'email' => 'ahhdfgdfgefnejf.com',
            'name' => 'Gayane',
            'password' => 'gayane2!',
            'password_confirmation' => 'gayane2!'
        ]);
        $response = $controller->register($request);
        $this->assertEquals(401, $response->status());
    }

    /**
     * Password w/o letters
     */
    public function testRegisterPasswordWOLetters()
    {
        $controller = new RegisterController();
        $request = new Request([
            'email' => 'minasaryangayane7@gmail.com',
            'name' => 'Gayane',
            'password' => '657576772!',
            'password_confirmation' => '657576772!'
        ]);
        $response = $controller->register($request);
        $this->assertEquals(401, $response->status());
    }

    /**
     * Password w/o numbers
     */
    public function testRegisterPasswordWONumbers()
    {
        $controller = new RegisterController();
        $request = new Request([
            'email' => 'minasaryangayane7@gmail.com',
            'name' => 'Gayane',
            'password' => 'gbvcbcbnbn!',
            'password_confirmation' => 'gbvcbcbnbn!'
        ]);
        $response = $controller->register($request);
        $this->assertEquals(401, $response->status());
    }

    /**
     * Password length
     */
    public function testRegisterPasswordLength()
    {
        $controller = new RegisterController();
        $request = new Request([
            'email' => 'minasaryangayane7@gmail.com',
            'name' => 'Gayane',
            'password' => 'gay1!',
            'password_confirmation' => 'gay1!'
        ]);
        $response = $controller->register($request);
        $this->assertEquals(401, $response->status());
    }

    /**
     * Password w/o symbols
     */
    public function testRegisterPasswordWOSymbols()
    {
        $controller = new RegisterController();
        $request = new Request([
            'email' => 'minasaryangayane7@gmail.com',
            'name' => 'Gayane',
            'password' => 'gbvcbcbnbn1',
            'password_confirmation' => 'gbvcbcbnbn1'
        ]);
        $response = $controller->register($request);
        $this->assertEquals(401, $response->status());
    }

    /**
     * Empty name
     */
    public function testRegisterEmptyName()
    {
        $controller = new RegisterController();
        $request = new Request([
            'email' => 'minasaryangayane7@gmail.com',
            'name' => '',
            'password' => 'gayane7!',
            'password_confirmation' => 'gayane7!'
        ]);
        $response = $controller->register($request);
        $this->assertEquals(401, $response->status());
    }

    /**
     * Empty email
     */
    public function testRegisterEmptyEmail()
    {
        $controller = new RegisterController();
        $request = new Request([
            'email' => '',
            'name' => 'Gayane',
            'password' => 'gayane7!',
            'password_confirmation' => 'gayane7!'
        ]);
        $response = $controller->register($request);
        $this->assertEquals(401, $response->status());
    }

    /**
     * Empty passwords
     */
    public function testRegisterEmptyPasswords()
    {
        $controller = new RegisterController();
        $request = new Request([
            'email' => 'minasaryangayane7@gmail.com',
            'name' => 'Gayane',
            'password' => '',
            'password_confirmation' => ''
        ]);
        $response = $controller->register($request);
        $this->assertEquals(401, $response->status());
    }

    /**
     * Email doesn't exist
     */
    public function testRegisterEmailNotExist()
    {
        $controller = new RegisterController();
        $request = new Request([
            'name' => 'Gayane',
            'password' => 'gayane7!',
            'password_confirmation' => 'gayane7!'
        ]);
        $response = $controller->register($request);
        $this->assertEquals(401, $response->status());
    }

    /**
     * Name doesn't exist
     */
    public function testRegisterNameNotExist()
    {
        $controller = new RegisterController();
        $request = new Request([
            'email' => 'minasaryangayane7@gmail.com',
            'password' => 'gayane7!',
            'password_confirmation' => 'gayane7!'
        ]);
        $response = $controller->register($request);
        $this->assertEquals(401, $response->status());
    }

    /**
     * Password doesn't exist
     */
    public function testRegisterPasswordNotExist()
    {
        $controller = new RegisterController();
        $request = new Request([
            'email' => 'minasaryangayane7@gmail.com',
            'name' => 'Gayane',
            'password_confirmation' => 'gayane7!'
        ]);
        $response = $controller->register($request);
        $this->assertEquals(401, $response->status());
    }

    /**
     * Password confirmation doesn't exist
     */
    public function testRegisterPasswordConfirmationNotExist()
    {
        $controller = new RegisterController();
        $request = new Request([
            'email' => 'minasaryangayane7@gmail.com',
            'name' => 'Gayane',
            'password' => 'gayane7!'
        ]);
        $response = $controller->register($request);
        $this->assertEquals(401, $response->status());
    }

    /**
     * Empty passwords
     */
    public function testRegisterEmailExist()
    {
        $controller = new RegisterController();
        $request = new Request([
            'email' => 'minasaryangayane2@gmail.com',
            'name' => 'Gayane',
            'password' => 'gayane2!',
            'password_confirmation' => 'gayane2!'
        ]);
        $response = $controller->register($request);
        $this->assertEquals(401, $response->status());
    }


}
