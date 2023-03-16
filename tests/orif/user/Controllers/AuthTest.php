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
     * Asserts that the login page is loaded correctly
     */
    public function testlogin()
    {
        $result = $this->controller(Auth::class)
        ->execute('login');

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
}