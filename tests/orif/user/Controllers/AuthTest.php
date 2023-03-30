<?php
/**
 * Unit tests AuthTest
 *
 * @author      Orif (CaLa)
 * @link        https://github.com/OrifInformatique
 * @copyright   Copyright (c), Orif (https://www.orif.ch)
 */

 namespace User\Controllers;

 use CodeIgniter\Test\CIUnitTestCase;
 use CodeIgniter\Test\ControllerTestTrait;
 
 class AuthTest extends CIUnitTestCase
{
    use ControllerTestTrait;

    /**
     * Asserts that the login page is loaded correctly (no session)
     */
    public function testloginPageWithoutSession()
    {
        // Execute login method of Auth class
        $result = $this->controller(Auth::class)
        ->execute('login');

        // Assertions
        $response = $result->response();
        $this->assertInstanceOf(\CodeIgniter\HTTP\Response::class, $response);
        $this->assertNotEmpty($response->getBody());
        $result->assertOK();
        $result->assertHeader('Content-Type', 'text/html; charset=UTF-8');
        $result->assertSeeElement('#username');
        $result->assertSeeElement('#password');
        $result->assertSeeElement('#btn_cancel');
        $result->assertSeeElement('#btn_login');
        $result->assertDontSeeElement('#fake_element');
        $result->assertSeeInField('username', '');
        $result->assertSeeInField('password', '');
        $result->assertSeeLink('Se connecter');
    }

    /**
     * Asserts that the login page is redirected 
     */
    public function testloginPageWithSession()
    {
        // Initialize session
        $_SESSION['logged_in'] = true;

        // Execute login method of Auth class
        $result = $this->controller(Auth::class)
        ->execute('login');

        // Assertions
        $response = $result->response();
        $this->assertInstanceOf(\CodeIgniter\HTTP\RedirectResponse::class, $response);
        $this->assertEmpty($response->getBody());
        $result->assertOK();
        $result->assertHeader('Content-Type', 'text/html; charset=UTF-8');
        $result->assertRedirectTo(base_url());
    }

    /**
     * Asserts that the change_password page is redirected (no session)
     */
    public function testchange_passwordPageWithoutSession()
    {
        // Execute change_password method of Auth class
        $result = $this->controller(Auth::class)
        ->execute('change_password');

        // Assertions
        $response = $result->response();
        $this->assertInstanceOf(\CodeIgniter\HTTP\RedirectResponse::class, $response);
        $this->assertEmpty($response->getBody());
        $result->assertOK();
        $result->assertHeader('Content-Type', 'text/html; charset=UTF-8');
        $result->assertRedirectTo(base_url('user/auth/login'));
    }

    /**
     * Asserts that the change_password page is loaded correctly (with session)
     */
    public function testchange_passwordPageWithSession()
    {
        // Initialize session
        $_SESSION['logged_in'] = true;
        $_SESSION['user_access'] = config('\User\Config\UserConfig')->access_lvl_guest;

        // Execute change_password method of Auth class
        $result = $this->controller(Auth::class)
        ->execute('change_password');

        // Assertions
        $response = $result->response();
        $this->assertInstanceOf(\CodeIgniter\HTTP\Response::class, $response);
        $this->assertNotEmpty($response->getBody());
        $result->assertOK();
        $result->assertHeader('Content-Type', 'text/html; charset=UTF-8');
        $result->assertSeeElement('#old_password');
        $result->assertSeeElement('#new_password');
        $result->assertSeeElement('#confirm_password');
        $result->assertSeeElement('#btn_change_password');
        $result->assertDontSeeElement('#fake_element');
        $result->assertSeeInField('old_password', '');
        $result->assertSeeInField('new_password', '');
        $result->assertSeeLink('Annuler');
    }

    /**
     * Asserts that logout resets the session
     */
    public function testlogout()
    {
        // Initialize session
        $_SESSION['logged_in'] = true;

        // Assertion
        $this->assertNotEmpty($_SESSION);

        // Execute logout method of Auth class
        $result = $this->controller(Auth::class)
        ->execute('logout');

        // Assertion
        $this->assertEmpty($_SESSION);
    }
}