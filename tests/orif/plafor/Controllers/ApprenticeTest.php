<?php
/**
 * Unit tests ApprenticeTest
 *
 * @author      Orif (CaLa)
 * @link        https://github.com/OrifInformatique
 * @copyright   Copyright (c), Orif (https://www.orif.ch)
 */

 namespace Plafor\Controllers;

 use CodeIgniter\Test\CIUnitTestCase;
 use CodeIgniter\Test\ControllerTestTrait;
 
 class ApprenticeTest extends CIUnitTestCase
{
    use ControllerTestTrait;

    /**
     * Asserts that the default index route redirects to login route (no session)
     */
    public function testindexWithoutSession()
    {
        // Execute index method of Apprentice class
        $result = $this->controller(Apprentice::class)
        ->execute('index');

        // Assertions
        $response = $result->response();
        $this->assertInstanceOf(\CodeIgniter\HTTP\RedirectResponse::class, $response);
        $this->assertEmpty($response->getBody());
        $result->assertOK();
        $result->assertHeader('Content-Type', 'text/html; charset=UTF-8');
        $result->assertRedirectTo(base_url('user/auth/login'));
    }

    /**
     * Asserts that the default index route redirects to list_user route (Administrator session)
     */
    public function testindexWithAdministratorSession()
    {
        // Initialize session
        $_SESSION['logged_in'] = true;
        $_SESSION['user_access'] = config('\User\Config\UserConfig')->access_lvl_admin;
        $_SESSION['user_id'] = 1;

        // Execute index method of Apprentice class
        $result = $this->controller(Apprentice::class)
        ->execute('index');

        // Assertions
        $response = $result->response();
        $this->assertInstanceOf(\CodeIgniter\HTTP\RedirectResponse::class, $response);
        $this->assertEmpty($response->getBody());
        $result->assertOK();
        $result->assertHeader('Content-Type', 'text/html; charset=UTF-8');
        $result->assertRedirectTo(base_url('user/admin/list_user'));
    }

    /**
     * Asserts that the default index route redirects to list_apprentice route (Trainer session)
     */
    public function testindexWithTrainerSession()
    {
        // Initialize session
        $_SESSION['logged_in'] = true;
        $_SESSION['user_access'] = config('\User\Config\UserConfig')->access_lvl_trainer;
        $_SESSION['user_id'] = 2;

        // Execute index method of Apprentice class
        $result = $this->controller(Apprentice::class)
        ->execute('index');

        // Assertions
        $response = $result->response();
        $this->assertInstanceOf(\CodeIgniter\HTTP\RedirectResponse::class, $response);
        $this->assertEmpty($response->getBody());
        $result->assertOK();
        $result->assertHeader('Content-Type', 'text/html; charset=UTF-8');
        $result->assertRedirectTo(base_url('plafor/apprentice/list_apprentice?trainer_id=2'));
    }

    /**
     * Asserts that the default index route redirects to view_apprentice route (Apprentice session)
     */
    public function testindexWithApprenticeSession()
    {
        // Initialize session
        $_SESSION['logged_in'] = true;
        $_SESSION['user_access'] = config('\User\Config\UserConfig')->access_lvl_guest;
        $_SESSION['user_id'] = 4;

        // Execute index method of Apprentice class
        $result = $this->controller(Apprentice::class)
        ->execute('index');

        // Assertions
        $response = $result->response();
        $this->assertInstanceOf(\CodeIgniter\HTTP\RedirectResponse::class, $response);
        $this->assertEmpty($response->getBody());
        $result->assertOK();
        $result->assertHeader('Content-Type', 'text/html; charset=UTF-8');
        $result->assertRedirectTo(base_url('plafor/apprentice/view_apprentice/4'));
    }

    /**
     * Asserts that the list_apprentice page is loaded correctly
     */
    public function testlist_apprentice() 
    {
        // Execute index method of Apprentice class
        $result = $this->controller(Apprentice::class)
        ->execute('list_apprentice');

        // Assertions
        $response = $result->response();
        $this->assertInstanceOf(\CodeIgniter\HTTP\Response::class, $response);
        $this->assertNotEmpty($response->getBody());
        $result->assertOK();
        $result->assertHeader('Content-Type', 'text/html; charset=UTF-8');
        $result->assertSee('FormateurDev', 'option');
        $result->assertSee('FormateurSysteme', 'option');
        $result->assertSee('FormateurOperateur', 'option');
        $result->assertSeeLink('ApprentiDev');
        $result->assertSeeLink(' Informaticien/-ne CFC Développement d\'applications');    
        $result->assertSeeLink('ApprentiSysteme');
        $result->assertSeeLink(' Informaticien/-ne CFC Technique des systèmes');
        $result->assertSeeLink('ApprentiOperateur');
        $result->assertSeeLink(' Opératrice en informatique / Opérateur en informatique CFC');
    }

    /**
     * Asserts that the list_apprentice page is loaded correctly for a given connected development trainer
     */
    public function testlist_apprenticeWithDevelopmentTrainerSession() 
    {
        // Initialize session for a development trainer
        $_SESSION['user_id'] = 2;

        // Execute index method of Apprentice class
        $result = $this->controller(Apprentice::class)
        ->execute('list_apprentice');

        // Assertions
        $response = $result->response();
        $this->assertInstanceOf(\CodeIgniter\HTTP\Response::class, $response);
        $this->assertNotEmpty($response->getBody());
        $result->assertOK();
        $result->assertHeader('Content-Type', 'text/html; charset=UTF-8');
        $result->assertSee('FormateurDev', 'option');
        $result->assertSee('FormateurSysteme', 'option');
        $result->assertSee('FormateurOperateur', 'option');
        $result->assertSeeLink('ApprentiDev');
        $result->assertSeeLink(' Informaticien/-ne CFC Développement d\'applications');    
        $result->assertDontSeeLink('ApprentiSysteme');
        $result->assertDontSeeLink(' Informaticien/-ne CFC Technique des systèmes');
        $result->assertDontSeeLink('ApprentiOperateur');
        $result->assertDontSeeLink(' Opératrice en informatique / Opérateur en informatique CFC');
    }
}