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
        // Execute list_apprentice method of Apprentice class
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
        $result->assertSee('Liste des apprentis', 'h1');
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
        $_SESSION['logged_in'] = true;
        $_SESSION['user_access'] = config('\User\Config\UserConfig')->access_lvl_trainer;
        $_SESSION['user_id'] = 2;
        
        // Execute list_apprentice method of Apprentice class
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
        $result->assertSee('Liste des apprentis', 'h1');
        $result->assertSeeLink('ApprentiDev');
        $result->assertSeeLink(' Informaticien/-ne CFC Développement d\'applications');    
        $result->assertDontSeeLink('ApprentiSysteme');
        $result->assertDontSeeLink(' Informaticien/-ne CFC Technique des systèmes');
        $result->assertDontSeeLink('ApprentiOperateur');
        $result->assertDontSeeLink(' Opératrice en informatique / Opérateur en informatique CFC');
    }

    /**
     * Asserts that the view_apprentice page redirects to the list_apprentice view when no apprentice id is given
     */
    public function testview_apprenticeWithoutApprenticeId()
    {
        // Execute view_apprentice method of Apprentice class
        $result = $this->controller(Apprentice::class)
        ->execute('view_apprentice');

        // Assertions
        $response = $result->response();
        $this->assertInstanceOf(\CodeIgniter\HTTP\RedirectResponse::class, $response);
        $this->assertEmpty($response->getBody());
        $result->assertOK();
        $result->assertHeader('Content-Type', 'text/html; charset=UTF-8');
        $result->assertRedirectTo(base_url('plafor/apprentice/list_apprentice'));
    }

    /**
     * Asserts that the view_apprentice page redirects to the list_apprentice view when a trainer id is given
     */
    public function testview_apprenticeWithTrainerId()
    {
        // Execute view_apprentice method of Apprentice class
        $result = $this->controller(Apprentice::class)
        ->execute('view_apprentice', 2);

        // Assertions
        $response = $result->response();
        $this->assertInstanceOf(\CodeIgniter\HTTP\RedirectResponse::class, $response);
        $this->assertEmpty($response->getBody());
        $result->assertOK();
        $result->assertHeader('Content-Type', 'text/html; charset=UTF-8');
        $result->assertRedirectTo(base_url('plafor/apprentice/list_apprentice'));
    }

    /**
     * Asserts that the view_apprentice page is loaded correctly when an apprentice id is given
     */
    public function testview_apprenticeWithApprenticeId()
    {
        // Execute view_apprentice method of Apprentice class
        $result = $this->controller(Apprentice::class)
        ->execute('view_apprentice', 4);

        // Assertions
        $response = $result->response();
        $this->assertInstanceOf(\CodeIgniter\HTTP\Response::class, $response);
        $this->assertNotEmpty($response->getBody());
        $result->assertOK();
        $result->assertHeader('Content-Type', 'text/html; charset=UTF-8');
        $result->assertSee('Détail de l\'apprenti', 'p');
        $result->assertSee('ApprentiDev', 'span');
        $result->assertSee('FormateurDev', 'p');
        $result->assertSeeElement('#usercourseSelector');
        $result->assertSee(' Informaticien/-ne CFC Développement d\'applications', 'option');
        $result->assertSee('09.07.2020', '.user-course-details-begin-date');
        $result->assertSee('En cours', '.user-course-details-status');
        $result->assertSee('Avancement du plan de formation', 'p');
        $result->assertSee(' Informaticien/-ne CFC Développement d\'applications', '.font-weight-bold user-course-details-course-plan-name');
    }

    /**
     * Asserts that the save_user_course page redirects to the 403 error view when no session user access is set
     */
    public function testsave_user_courseWithoutSessionUserAccess()
    {
        // Initialize session previous url (needed for 403 error view)
        $_SESSION['_ci_previous_url'] = 'url';

        // Execute save_user_course method of Apprentice class
        $result = $this->controller(Apprentice::class)
        ->execute('save_user_course');

        // Assertions
        $response = $result->response();
        $this->assertInstanceOf(\CodeIgniter\HTTP\Response::class, $response);
        $this->assertNotEmpty($response->getBody());
        $result->assertOK();
        $result->assertHeader('Content-Type', 'text/html; charset=UTF-8');
        $result->assertSee('403 - Accès refusé', 'h2');
        $result->assertSee('Vous n\'êtes pas autorisé à accéder à cette fonction.', 'p');
        $result->assertSeeLink('Retour');
    }

    /**
     * Asserts that the save_user_course page redirects to the 403 error view when an apprentice session is set
     */
    public function testsave_user_courseWithApprenticeSession()
    {
        // Initialize session
        $_SESSION['_ci_previous_url'] = 'url';
        $_SESSION['user_access'] = config('\User\Config\UserConfig')->access_lvl_guest;

        // Execute save_user_course method of Apprentice class
        $result = $this->controller(Apprentice::class)
        ->execute('save_user_course');

        // Assertions
        $response = $result->response();
        $this->assertInstanceOf(\CodeIgniter\HTTP\Response::class, $response);
        $this->assertNotEmpty($response->getBody());
        $result->assertOK();
        $result->assertHeader('Content-Type', 'text/html; charset=UTF-8');
        $result->assertSee('403 - Accès refusé', 'h2');
        $result->assertSee('Vous n\'êtes pas autorisé à accéder à cette fonction.', 'p');
        $result->assertSeeLink('Retour');
    }

    /**
     * Asserts that the save_user_course page redirects to the list_apprentice view when no apprentice id and user course id are given
     */
    public function testsave_user_courseWithTrainerSessionWithoutApprenticeIdAndUserCourseId()
    {
        // Initialize session
        $_SESSION['_ci_previous_url'] = 'url';
        $_SESSION['user_access'] = config('\User\Config\UserConfig')->access_lvl_trainer;

        // Execute save_user_course method of Apprentice class
        $result = $this->controller(Apprentice::class)
        ->execute('save_user_course');

        // Assertions
        $response = $result->response();
        $this->assertInstanceOf(\CodeIgniter\HTTP\RedirectResponse::class, $response);
        $this->assertEmpty($response->getBody());
        $result->assertOK();
        $result->assertHeader('Content-Type', 'text/html; charset=UTF-8');
        $result->assertRedirectTo(base_url('plafor/apprentice/list_apprentice'));
    }

    /**
     * Asserts that the save_user_course page redirects to the list_apprentice view when a trainer id and user course id are given
     */
    public function testsave_user_courseWithTrainerSessionWithTrainerIdAndUserCourseId()
    {
        // Initialize session
        $_SESSION['_ci_previous_url'] = 'url';
        $_SESSION['user_access'] = config('\User\Config\UserConfig')->access_lvl_trainer;

        // Execute save_user_course method of Apprentice class
        $result = $this->controller(Apprentice::class)
        ->execute('save_user_course', 2, 1);

        // Assertions
        $response = $result->response();
        $this->assertInstanceOf(\CodeIgniter\HTTP\RedirectResponse::class, $response);
        $this->assertEmpty($response->getBody());
        $result->assertOK();
        $result->assertHeader('Content-Type', 'text/html; charset=UTF-8');
        $result->assertRedirectTo(base_url('plafor/apprentice/list_apprentice'));
    }

    /**
     * Asserts that the save_user_course page redirects to the list_apprentice view when an apprentice id and user course id are given
     */
    public function testsave_user_courseWithTrainerSessionWithApprenticeIdAndUserCourseId()
    {
        // Initialize session
        $_SESSION['_ci_previous_url'] = 'url';
        $_SESSION['user_access'] = config('\User\Config\UserConfig')->access_lvl_trainer;

        // Execute save_user_course method of Apprentice class
        $result = $this->controller(Apprentice::class)
        ->execute('save_user_course', 4, 1);

        // Assertions
        $response = $result->response();
        $this->assertInstanceOf(\CodeIgniter\HTTP\Response::class, $response);
        $this->assertNotEmpty($response->getBody());
        $result->assertOK();
        $result->assertHeader('Content-Type', 'text/html; charset=UTF-8');
        $result->assertSee('Formation', 'label');
        $result->assertSeeElement('#course_plan');
        $result->assertSee(' Informaticien/-ne CFC Développement d\'applications', 'option');
        $result->assertSee('Statut de la formation', 'label');
        $result->assertSee('En cours', 'option');
        $result->assertSeeInField('date_begin', '2020-07-09');
        $result->assertSeeInField('date_end', '0000-00-00');
        $result->assertSeeLink('Annuler');
    }

    /**
     * Asserts that the save_apprentice_link page redirects to the base url when an apprentice session is set
     */
    public function testsave_apprentice_linkWithApprenticeSession()
    {
        // Initialize session
        $_SESSION['user_access'] = config('\User\Config\UserConfig')->access_lvl_guest;

        // Execute save_apprentice_link method of Apprentice class
        $result = $this->controller(Apprentice::class)
        ->execute('save_apprentice_link');

        // Assertions
        $response = $result->response();
        $this->assertInstanceOf(\CodeIgniter\HTTP\RedirectResponse::class, $response);
        $this->assertEmpty($response->getBody());
        $result->assertOK();
        $result->assertHeader('Content-Type', 'text/html; charset=UTF-8');
        $result->assertRedirectTo(base_url());
    }

    /**
     * Asserts that the save_apprentice_link page redirects to the base url view when a trainer session is set without apprentice id
     */
    public function testsave_apprentice_linkWithTrainerSessionWithoutApprenticeId()
    {
        // Initialize session
        $_SESSION['user_access'] = config('\User\Config\UserConfig')->access_lvl_trainer;

        // Execute save_apprentice_link method of Apprentice class
        $result = $this->controller(Apprentice::class)
        ->execute('save_apprentice_link');

        // Assertions
        $response = $result->response();
        $this->assertInstanceOf(\CodeIgniter\HTTP\RedirectResponse::class, $response);
        $this->assertEmpty($response->getBody());
        $result->assertOK();
        $result->assertHeader('Content-Type', 'text/html; charset=UTF-8');
        $result->assertRedirectTo(base_url());
    }

    /**
     * Asserts that the save_apprentice_link page redirects to the base url view when a trainer session is set with apprentice id
     */
    public function testsave_apprentice_linkWithTrainerSessionWithTrainerId()
    {
        // Initialize session
        $_SESSION['user_access'] = config('\User\Config\UserConfig')->access_lvl_trainer;

        // Execute save_apprentice_link method of Apprentice class
        $result = $this->controller(Apprentice::class)
        ->execute('save_apprentice_link', 2);

        // Assertions
        $response = $result->response();
        $this->assertInstanceOf(\CodeIgniter\HTTP\RedirectResponse::class, $response);
        $this->assertEmpty($response->getBody());
        $result->assertOK();
        $result->assertHeader('Content-Type', 'text/html; charset=UTF-8');
        $result->assertRedirectTo(base_url());
    }

    /**
     * Asserts that the save_apprentice_link page is loaded correctly when no limk between apprentice and trainer is provided
     */
    public function testsave_apprentice_linkWithTrainerSessionWithApprenticeId()
    {
        // Initialize session
        $_SESSION['user_access'] = config('\User\Config\UserConfig')->access_lvl_trainer;

        // Execute save_apprentice_link method of Apprentice class
        $result = $this->controller(Apprentice::class)
        ->execute('save_apprentice_link', 4);

        // Assertions
        $response = $result->response();
        $this->assertInstanceOf(\CodeIgniter\HTTP\Response::class, $response);
        $this->assertNotEmpty($response->getBody());
        $result->assertOK();
        $result->assertHeader('Content-Type', 'text/html; charset=UTF-8');
        $result->assertSee('Ajouter un formateur', 'h1');
        $result->assertDontSee('Modifer le formateur', 'h1');
        $result->assertSeeElement('#apprentice_link_form');
        $result->assertSeeInField('id', 4);
        $result->assertSee('Nom de l\'apprenti', 'label');
        $result->assertSeeInField('apprentice', 4);
        $result->assertSee('ApprentiDev', 'p');
        $result->assertSee('Formateur(s) lié(s)', 'label');
        $result->assertSee('FormateurDev', 'option');
        $result->assertSee('FormateurSysteme', 'option');
        $result->assertSee('FormateurOperateur', 'option');
        $result->assertSeeLink('Annuler');
    }

    /**
     * Asserts that the save_apprentice_link page is loaded correctly when a limk between apprentice and trainer is provided
     */
    public function testsave_apprentice_linkWithTrainerSessionWithApprenticeIdAndLinkId()
    {
        // Initialize session
        $_SESSION['user_access'] = config('\User\Config\UserConfig')->access_lvl_trainer;

        // Execute save_apprentice_link method of Apprentice class
        $result = $this->controller(Apprentice::class)
        ->execute('save_apprentice_link', 4, 1);

        // Assertions
        $response = $result->response();
        $this->assertInstanceOf(\CodeIgniter\HTTP\Response::class, $response);
        $this->assertNotEmpty($response->getBody());
        $result->assertOK();
        $result->assertHeader('Content-Type', 'text/html; charset=UTF-8');
        $result->assertDontSee('Ajouter un formateur', 'h1');
        $result->assertSee('Modifer le formateur', 'h1');
        $result->assertSeeElement('#apprentice_link_form');
        $result->assertSeeInField('id', 4);
        $result->assertSee('Nom de l\'apprenti', 'label');
        $result->assertSeeInField('apprentice', 4);
        $result->assertSee('ApprentiDev', 'p');
        $result->assertSee('Formateur(s) lié(s)', 'label');
        $result->assertSee('FormateurDev', 'option');
        $result->assertSee('FormateurSysteme', 'option');
        $result->assertSee('FormateurOperateur', 'option');
        $result->assertSeeLink('Annuler');
    }

    /**
     * Asserts that the delete_apprentice_link page redirects to the 403 error view when an apprentice session is set
     */
    public function testdelete_apprentice_linkWithApprenticeSession()
    {
        // Initialize session
        $_SESSION['_ci_previous_url'] = 'url';
        $_SESSION['user_access'] = config('\User\Config\UserConfig')->access_lvl_guest;

        // Execute delete_apprentice_link method of Apprentice class
        $result = $this->controller(Apprentice::class)
        ->execute('delete_apprentice_link', 1);

        // Assertions
        $response = $result->response();
        $this->assertInstanceOf(\CodeIgniter\HTTP\Response::class, $response);
        $this->assertNotEmpty($response->getBody());
        $result->assertOK();
        $result->assertHeader('Content-Type', 'text/html; charset=UTF-8');
        $result->assertSee('403 - Accès refusé', 'h2');
        $result->assertSee('Vous n\'êtes pas autorisé à accéder à cette fonction.', 'p');
        $result->assertSeeLink('Retour');
    }

    /**
     * Asserts that the delete_apprentice_link page (confirmation message) is loaded correctly
     */
    public function testdelete_apprentice_linkWithTrainerSession()
    {
        // Initialize session
        $_SESSION['_ci_previous_url'] = 'url';
        $_SESSION['user_access'] = config('\User\Config\UserConfig')->access_lvl_trainer;

        // Execute delete_apprentice_link method of Apprentice class
        $result = $this->controller(Apprentice::class)
        ->execute('delete_apprentice_link', 1);

        // Assertions
        $response = $result->response();
        $this->assertInstanceOf(\CodeIgniter\HTTP\Response::class, $response);
        $this->assertNotEmpty($response->getBody());
        $result->assertOK();
        $result->assertHeader('Content-Type', 'text/html; charset=UTF-8');
        $result->assertSee('Apprenti et formateur lié', 'h1');
        $result->assertSee('Apprenti \'ApprentiDev\'', 'h1');
        $result->assertSee('Formateur \'FormateurDev\'', 'h1');
        $result->assertSee('Toutes les informations concernant le lien entre cet apprenti et ce formateur seront désactivées.', 'div');
        $result->assertSeeLink('Annuler');
        $result->assertSeeLink('Désactiver');
    }

    /**
     * Asserts that the view_acquisition_status redirects to the list_apprentice view when no status id is provided
     */
    public function testview_acquisition_statusWithoutStatusId() 
    {
        // Execute save_apprentice_link method of Apprentice class
        $result = $this->controller(Apprentice::class)
        ->execute('view_acquisition_status');

        // Assertions
        $response = $result->response();
        $this->assertInstanceOf(\CodeIgniter\HTTP\RedirectResponse::class, $response);
        $this->assertEmpty($response->getBody());
        $result->assertOK();
        $result->assertHeader('Content-Type', 'text/html; charset=UTF-8');
        $result->assertRedirectTo(base_url('plafor/apprentice/list_apprentice'));
    }

    /**
     * Asserts that the view_acquisition_status redirects to the list_apprentice view when a status id is provided (apprentice session)
     */
    public function testview_acquisition_statusWithStatusIdWithApprenticeSession() 
    {
        // Initialize session
        $_SESSION['user_access'] = config('\User\Config\UserConfig')->access_lvl_guest;

        // Execute save_apprentice_link method of Apprentice class
        $result = $this->controller(Apprentice::class)
        ->execute('view_acquisition_status', 1);

        // Assertions
        $response = $result->response();
        $this->assertInstanceOf(\CodeIgniter\HTTP\Response::class, $response);
        $this->assertNotEmpty($response->getBody());
        $result->assertOK();
        $result->assertHeader('Content-Type', 'text/html; charset=UTF-8');
        $result->assertSee('Détail du statut d\'acquisition', 'p');
        $result->assertSee('Symboles de l\'objectif', 'p');
        $result->asserttSeeLink('A.1.1');
        $result->assertSee('Nom de l\'objectif', 'p');
        $result->asserttSeeLink('Enregistrer les besoins et discuter les solutions possibles, s’entretenir avec le client/supérieur sur les restrictions des exigences');
        $result->assertSee('Taxonomie de l\'objectif', 'p');
        $result->assertSeeLink('4');
        $result->assertSee('Niveau d\'acquisition', 'p');
        $result->assertSee('Non expliqué', 'p');
        $result->assertDonttSeeLink('Ajouter un commentaire');

        //TODO
    }

}