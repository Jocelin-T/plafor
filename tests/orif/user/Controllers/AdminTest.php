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

 use User\Models;
 
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
    public function testsave_userWithUserId() 
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
        $result->assertSee('Modifier un utilisateur', 'h1');
        $result->assertSeeElement('#user_form');
        $result->assertSee('Identifiant', 'label');
        $result->assertSeeInField('user_name', 'admin');
        $result->assertSee('Adresse e-mail', 'label');
        $result->assertSeeInField('user_email', '');
        $result->assertSee('Type d\'utilisateur', 'label');
        $result->assertSeeElement('#user_usertype');
        $result->assertSee('Administrateur', 'option');
        $result->assertSee('Formateur', 'option');
        $result->assertSee('Apprenti', 'option');
        $result->assertDontSee('Mot de passe', 'label');
        $result->assertDontSeeElement('#user_password');
        $result->assertDontSee('Confirmer le mot de passe', 'label');
        $result->assertDontSeeElement('#user_password_again');
        $result->assertSeeLink('Réinitialiser le mot de passe');
        $result->assertSeeLink('Désactiver ou supprimer cet utilisateur');
        $result->assertSeeElement('.btn btn-default');
        $result->assertSeeElement('.btn btn-primary');
        $result->assertSeeLink('Annuler');
        $result->assertSeeInField('save', 'Enregistrer');
    }

    /**
     * Asserts that the form_user page is loaded correctly for a new user (no user id)
     */
    public function testsave_userWithoutUserId() 
    {
        // Execute save_user method of Admin class 
        $result = $this->controller(Admin::class)
        ->execute('save_user');

        // Assertions
        $response = $result->response();
        $this->assertInstanceOf(\CodeIgniter\HTTP\Response::class, $response);
        $this->assertNotEmpty($response->getBody());
        $result->assertOK();
        $result->assertHeader('Content-Type', 'text/html; charset=UTF-8');
        $result->assertSee('Ajouter un utilisateur', 'h1');
        $result->assertSeeElement('#user_form');
        $result->assertSee('Identifiant', 'label');
        $result->assertSeeInField('user_name', '');
        $result->assertSee('Adresse e-mail', 'label');
        $result->assertSeeInField('user_email', '');
        $result->assertSee('Type d\'utilisateur', 'label');
        $result->assertSeeElement('#user_usertype');
        $result->assertSee('Administrateur', 'option');
        $result->assertSee('Formateur', 'option');
        $result->assertSee('Apprenti', 'option');
        $result->assertSee('Mot de passe', 'label');
        $result->assertSeeElement('#user_password');
        $result->assertSee('Confirmer le mot de passe', 'label');
        $result->assertSeeElement('#user_password_again');
        $result->assertSeeElement('.btn btn-default');
        $result->assertSeeElement('.btn btn-primary');
        $result->assertSeeLink('Annuler');
        $result->assertSeeInField('save', 'Enregistrer');
    }

    /**
     * Asserts that the form_user page is loaded correctly for the user id 1 with the session user id 1
     */
    public function testsave_userWithUserIdWithSameSessionUserId() 
    {
        // Initialize the session
        $_SESSION['user_id'] = 1;

        // Execute save_user method of Admin class 
        $result = $this->controller(Admin::class)
        ->execute('save_user', 1);

        // Assertions
        $response = $result->response();
        $this->assertInstanceOf(\CodeIgniter\HTTP\Response::class, $response);
        $this->assertNotEmpty($response->getBody());
        $result->assertOK();
        $result->assertHeader('Content-Type', 'text/html; charset=UTF-8');
        $result->assertSee('Modifier un utilisateur', 'h1');
        $result->assertSeeElement('#user_form');
        $result->assertSee('Identifiant', 'label');
        $result->assertSeeInField('user_name', 'admin');
        $result->assertSee('Adresse e-mail', 'label');
        $result->assertSeeInField('user_email', '');
        $result->assertSee('Administrateur', 'option');
        $result->assertSee('Vous ne pouvez pas modifier votre propre type d\'utilisateur. Cette opération doit être faite par un autre administrateur.', 'div');
        $result->assertSeeElement('#user_usertype');
        $result->assertSee('Administrateur', 'option');
        $result->assertSee('Formateur', 'option');
        $result->assertSee('Apprenti', 'option');
        $result->assertDontSee('Mot de passe', 'label');
        $result->assertDontSeeElement('#user_password');
        $result->assertDontSee('Confirmer le mot de passe', 'label');
        $result->assertDontSeeElement('#user_password_again');
        $result->assertSeeLink('Réinitialiser le mot de passe');
        $result->assertSeeLink('Désactiver ou supprimer cet utilisateur');
        $result->assertSeeElement('.btn btn-default');
        $result->assertSeeElement('.btn btn-primary');
        $result->assertSeeLink('Annuler');
        $result->assertSeeInField('save', 'Enregistrer');
    }

    /**
     * Asserts that the form_user page is loaded correctly for an archived user id
     */
    public function testsave_userWithArchivedUserId()
    {
        $user_id = 1;

        // Disable user id 1
        \User\Models\User_model::getInstance()->update($user_id, ['archive' => '2023-03-30 10:32:00']);

        // Execute save_user method of Admin class 
        $result = $this->controller(Admin::class)
        ->execute('save_user', 1);

        // Assertions
        $response = $result->response();
        $this->assertInstanceOf(\CodeIgniter\HTTP\Response::class, $response);
        $this->assertNotEmpty($response->getBody());
        $result->assertOK();
        $result->assertHeader('Content-Type', 'text/html; charset=UTF-8');
        $result->assertSee('Modifier un utilisateur', 'h1');
        $result->assertSee('Cet utilisateur est désactivé. Vous pouvez le réactiver en cliquant sur le lien correspondant.', 'div');
        $result->assertSeeElement('#user_form');
        $result->assertSee('Identifiant', 'label');
        $result->assertSeeInField('user_name', 'admin');
        $result->assertSee('Adresse e-mail', 'label');
        $result->assertSeeInField('user_email', '');
        $result->assertSee('Type d\'utilisateur', 'label');
        $result->assertSeeElement('#user_usertype');
        $result->assertSee('Administrateur', 'option');
        $result->assertSee('Formateur', 'option');
        $result->assertSee('Apprenti', 'option');
        $result->assertDontSee('Mot de passe', 'label');
        $result->assertDontSeeElement('#user_password');
        $result->assertDontSee('Confirmer le mot de passe', 'label');
        $result->assertDontSeeElement('#user_password_again');
        $result->assertSeeLink('Réinitialiser le mot de passe');
        $result->assertSeeLink('Réactiver cet utilisateur');
        $result->assertSeeLink('Supprimer cet utilisateur');
        $result->assertSeeElement('.btn btn-default');
        $result->assertSeeElement('.btn btn-primary');
        $result->assertSeeLink('Annuler');
        $result->assertSeeInField('save', 'Enregistrer');

        // Enable user id 1
        \User\Models\User_model::getInstance()->update($user_id, ['archive' => NULL]);
    }
}