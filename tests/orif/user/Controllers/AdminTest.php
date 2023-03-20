<?php
/**
 * Unit tests AdminTest
 *
 * @author      Orif (CaLa)
 * @link        https://github.com/OrifInformatique
 * @copyright   Copyright (c), Orif (https://www.orif.ch)
 */

 namespace User\Controllers;

 use CodeIgniter\Test\CIUnitTestCase;
 use CodeIgniter\Test\ControllerTestTrait;
 
 class AdminTest extends CIUnitTestCase
{
    use ControllerTestTrait;

    /**
     * Asserts that the list_user page is loaded correctly 
     */
    public function testlist_user() 
    {
        // Execute list_user method of Admin class
        $result = $this->controller(Admin::class)
        ->execute('list_user');

        // Assertions
        $response = $result->response();
        $this->assertInstanceOf(\CodeIgniter\HTTP\Response::class, $response);
        $this->assertNotEmpty($response->getBody());
        $result->assertOK();
        $result->assertHeader('Content-Type', 'text/html; charset=UTF-8');
        $result->assertSeeLink('Nouveau');
        $result->assertSeeElement('#userslist');
        $result->assertSee('Identifiant', 'th');
        $result->assertSee('Type d\'utilisateur', 'th');
        $result->assertSee('Activé', 'th');
        $result->assertDontSee('Fake User', 'th');
        $result->assertSeeLink('admin');
        $result->assertSeeLink('FormateurDev');
        $result->assertSeeLink('FormateurSysteme');
        $result->assertSeeLink('FormateurOperateur');
        $result->assertSeeLink('ApprentiDev');
        $result->assertSeeLink('ApprentiSysteme');
        $result->assertSeeLink('ApprentiOperateur');
    }

    /**
     * Asserts that the password_change_user page is loaded correctly for the user id 1
     */
    public function testpassword_change_user() 
    {
        // Execute password_change_user method of Admin class
        $result = $this->controller(Admin::class)
        ->execute('password_change_user', 1);

        // Assertions
        $response = $result->response();
        $this->assertInstanceOf(\CodeIgniter\HTTP\Response::class, $response);
        $this->assertNotEmpty($response->getBody());
        $result->assertOK();
        $result->assertHeader('Content-Type', 'text/html; charset=UTF-8');
        $result->assertSee('Réinitialiser le mot de passe', 'h1');
        $result->assertSee('admin', 'h4');
        $result->assertDontSee('Fake Reset', 'h1');
        $result->assertSeeElement('#user_password_new');
        $result->assertSeeElement('#user_password_again');
        $result->assertSeeElement('.btn btn-default');
        $result->assertSeeElement('.btn btn-primary');
    }

    /**
     * Asserts that the delete_user page displays a warning message for the user id 1 (no session)
     */
    public function testdelete_userWithoutSession() 
    {
        // Execute delete_user method of Admin class (no action parameter is passed to avoid deleting)
        $result = $this->controller(Admin::class)
        ->execute('delete_user', 1);

        // Assertions
        $response = $result->response();
        $this->assertInstanceOf(\CodeIgniter\HTTP\Response::class, $response);
        $this->assertNotEmpty($response->getBody());
        $result->assertOK();
        $result->assertHeader('Content-Type', 'text/html; charset=UTF-8');
        $result->assertSee('Vous ne pouvez pas désactiver ou supprimer votre propre compte. Cette opération doit être faite par un autre administrateur.', 'div');
    }

    /**
     * Asserts that the delete_user page is loaded correctly for the user id 1 (with a session)
     */
    public function testdelete_userWithSession() 
    {
        // Initialize session 
        $_SESSION['user_id'] = 2;

        // Execute delete_user method of Admin class (no action parameter is passed to avoid deleting)
        $result = $this->controller(Admin::class)
        ->execute('delete_user', 1);

        // Assertions
        $response = $result->response();
        $this->assertInstanceOf(\CodeIgniter\HTTP\Response::class, $response);
        $this->assertNotEmpty($response->getBody());
        $result->assertOK();
        $result->assertHeader('Content-Type', 'text/html; charset=UTF-8');
        $result->assertSee('Que souhaitez-vous faire ?', 'h4');
        $result->assertSeeLink('Annuler');
        $result->assertSeeLink('Désactiver cet utilisateur');
        $result->assertSeeLink('Supprimer cet utilisateur');
    }

    /**
     * Asserts that the form_user page is loaded correctly for the user id 1 
     */
    public function testsave_user() 
    {
        // Execute save_user method of Admin class 
        $result = $this->controller(Admin::class)
        ->execute('save_user', 1);

        // Assertions
        $response = $result->response();
        $this->assertInstanceOf(\CodeIgniter\HTTP\Response::class, $response);
        $this->assertNotEmpty($response->getBody());
        $result->assertOK();
        $result->assertHeader('Content-Type', 'text/html; charset=UTF-8');
        $result->assertSeeElement('#user_form');
        $result->assertSeeInField('user_name', 'admin');
        $result->assertSeeInField('user_email', '');
        $result->assertSeeLink('Annuler');
        $result->assertSeeLink('Réinitialiser le mot de passe');
        $result->assertSeeLink('Désactiver ou supprimer cet utilisateur');
        $result->assertSeeElement('.btn btn-default');
        $result->assertSeeElement('.btn btn-primary');
    }

}