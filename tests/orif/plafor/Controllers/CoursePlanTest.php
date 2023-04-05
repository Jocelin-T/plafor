<?php
/**
 * Unit tests CoursePlanTest
 *
 * @author      Orif (CaLa)
 * @link        https://github.com/OrifInformatique
 * @copyright   Copyright (c), Orif (https://www.orif.ch)
 */

 namespace Plafor\Controllers;

 use CodeIgniter\Test\CIUnitTestCase;
 use CodeIgniter\Test\ControllerTestTrait;

 use Plafor\Models;
 
 class CoursePlanTest extends CIUnitTestCase
{
    use ControllerTestTrait;

    /**
     * Asserts that the save_course_plan page redirects to the 403 error view when an apprentice session user access is set
     */
    public function testsave_course_planWithApprenticeSessionUserAccess()
    {
        // Initialize session
        $_SESSION['_ci_previous_url'] = 'url'; // (needed for 403 error view)
        $_SESSION['user_access'] = config('\User\Config\UserConfig')->access_lvl_guest;

        // Execute save_course_plan method of CoursePlan class
        $result = $this->controller(CoursePlan::class)
        ->execute('save_course_plan');

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
     * Asserts that the save_course_plan page redirects to the 403 error view when a trainer session user access is set
     */
    public function testsave_course_planWithTrainerSessionUserAccess()
    {
        // Initialize session
        $_SESSION['_ci_previous_url'] = 'url'; // (needed for 403 error view)
        $_SESSION['user_access'] = config('\User\Config\UserConfig')->access_lvl_trainer;

        // Execute save_course_plan method of CoursePlan class
        $result = $this->controller(CoursePlan::class)
        ->execute('save_course_plan');

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
     * Asserts that the save_course_plan page is loaded correctly when an administrator session user access is set without course plan id
     */
    public function testsave_course_planWithAdministratorSessionUserAccessWithoutCoursePlanId()
    {
        // Initialize session 
        $_SESSION['user_access'] = config('\User\Config\UserConfig')->access_lvl_admin;

        // Execute save_course_plan method of CoursePlan class
        $result = $this->controller(CoursePlan::class)
        ->execute('save_course_plan');

        // Assertions
        $response = $result->response();
        $this->assertInstanceOf(\CodeIgniter\HTTP\Response::class, $response);
        $this->assertNotEmpty($response->getBody());
        $result->assertOK();
        $result->assertSee('Ajouter un plan de formation', 'h1');
        $result->assertSeeElement('#course_plan_form');
        $result->assertSee('Numéro du plan de formation', 'label');
        $result->assertSeeInField('formation_number', '');
        $result->assertSee('Nom du plan de formation', 'label');
        $result->assertSeeInField('official_name', '');
        $result->assertSee('Date de création du plan de formation', 'label');
        $result->assertSeeInField('date_begin', '');
        $result->assertSeeInField('coursePlanId', '');
        $result->assertSeeLink('Annuler');
        $result->assertSeeInField('save', 'Enregistrer');
    }

    /**
     * Asserts that the save_course_plan page is loaded correctly when an administrator session user access is set with a course plan id
     */
    public function testsave_course_planWithAdministratorSessionUserAccessWithCoursePlanId()
    {
        // Initialize session 
        $_SESSION['user_access'] = config('\User\Config\UserConfig')->access_lvl_admin;

        // Execute save_course_plan method of CoursePlan class
        $result = $this->controller(CoursePlan::class)
        ->execute('save_course_plan', 1);

        // Assertions
        $response = $result->response();
        $this->assertInstanceOf(\CodeIgniter\HTTP\Response::class, $response);
        $this->assertNotEmpty($response->getBody());
        $result->assertOK();
        $result->assertSee('Modifier le plan de formation', 'h1');
        $result->assertSeeElement('#course_plan_form');
        $result->assertSee('Numéro du plan de formation', 'label');
        $result->assertSeeInField('formation_number', '88601');
        $result->assertSee('Nom du plan de formation', 'label');
        $result->assertSeeInField('official_name', ' Informaticien/-ne CFC Développement d\'applications');
        $result->assertSee('Date de création du plan de formation', 'label');
        $result->assertSeeInField('date_begin', '2014-08-01');
        $result->assertSeeInField('coursePlanId', '1');
        $result->assertSeeLink('Annuler');
        $result->assertSeeInField('save', 'Enregistrer');
    }

    /**
     * Asserts that the delete_course_plan page redirects to the 403 error view when an apprentice session user access is set
     */
    public function testdelete_course_planWithApprenticeSessionUserAccess()
    {
        // Initialize session
        $_SESSION['_ci_previous_url'] = 'url'; // (needed for 403 error view)
        $_SESSION['user_access'] = config('\User\Config\UserConfig')->access_lvl_guest;

        // Execute delete_course_plan method of CoursePlan class
        $result = $this->controller(CoursePlan::class)
        ->execute('delete_course_plan', 1);

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
     * Asserts that the delete_course_plan page redirects to the 403 error view when a trainer session user access is set
     */
    public function testdelete_course_planWithTrainerSessionUserAccess()
    {
        // Initialize session
        $_SESSION['_ci_previous_url'] = 'url'; // (needed for 403 error view)
        $_SESSION['user_access'] = config('\User\Config\UserConfig')->access_lvl_trainer;

        // Execute delete_course_plan method of CoursePlan class
        $result = $this->controller(CoursePlan::class)
        ->execute('delete_course_plan', 1);

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
     * Asserts that the delete_course_plan page is loaded correctly (confirmation message) when an administrator session user access is set (with action equals 0)
     */
    public function testdelete_course_planWithAdministratorSessionUserAccessAndActionToConfirm()
    {
        // Initialize session
        $_SESSION['_ci_previous_url'] = 'url'; // (needed for delete_course_plan view)
        $_SESSION['user_access'] = config('\User\Config\UserConfig')->access_lvl_admin;

        // Execute delete_course_plan method of CoursePlan class
        $result = $this->controller(CoursePlan::class)
        ->execute('delete_course_plan', 1, 0);

        // Assertions
        $response = $result->response();
        $this->assertInstanceOf(\CodeIgniter\HTTP\Response::class, $response);
        $this->assertNotEmpty($response->getBody());
        $result->assertOK();
        $result->assertHeader('Content-Type', 'text/html; charset=UTF-8');
        $result->assertSee('Apprenti \'ApprentiDev\'', 'h1');
        $result->assertSee('Plan de formation \' Informaticien/-ne CFC Développement d\'applications\'', 'h1');
        $result->assertSee('Statut de la formation \'En cours\'', 'h1');
        $result->assertSee('Toutes les informations concernant cette formation liée seront désactivées.', 'div');
        $result->assertSeeLink('Annuler');
        $result->assertSeeLink('Désactiver');
    }

    /**
     * Asserts that the delete_course_plan page redirects to the list_course_plan view when an administrator session user access is set (with a fake action)
     */
    public function testdelete_course_planWithAdministratorSessionUserAccessAndFakeAction()
    {
        // Initialize session
        $_SESSION['user_access'] = config('\User\Config\UserConfig')->access_lvl_admin;

        // Execute delete_course_plan method of CoursePlan class
        $result = $this->controller(CoursePlan::class)
        ->execute('delete_course_plan', 1, 9);

        // Assertions
        $response = $result->response();
        $this->assertInstanceOf(\CodeIgniter\HTTP\RedirectResponse::class, $response);
        $this->assertEmpty($response->getBody());
        $result->assertOK();
        $result->assertHeader('Content-Type', 'text/html; charset=UTF-8');
        $result->assertRedirectTo(base_url('plafor/courseplan/list_course_plan'));
    }

    /**
     * Asserts that the delete_course_plan page redirects to the list_course_plan view when an administrator session user access is set (with a non existing course plan)
     */
    public function testdelete_course_planWithAdministratorSessionUserAccessAndNonExistingCoursePlan()
    {
        // Initialize session
        $_SESSION['user_access'] = config('\User\Config\UserConfig')->access_lvl_admin;

        // Execute delete_course_plan method of CoursePlan class
        $result = $this->controller(CoursePlan::class)
        ->execute('delete_course_plan', 999999);

        // Assertions
        $response = $result->response();
        $this->assertInstanceOf(\CodeIgniter\HTTP\RedirectResponse::class, $response);
        $this->assertEmpty($response->getBody());
        $result->assertOK();
        $result->assertHeader('Content-Type', 'text/html; charset=UTF-8');
        $result->assertRedirectTo(base_url('plafor/courseplan/list_course_plan'));
    }

    /**
     * Asserts that the delete_course_plan page redirects to the list_course_plan view when an administrator session user access is set (with an  existing course plan and the enable action)
     */
    public function testdelete_course_planWithAdministratorSessionUserAccessAndExistingCoursePlanAndEnableAction()
    {
        $course_plan_id = 1;

        // Disable course plan
        \Plafor\Models\CoursePlanModel::getInstance()->delete($course_plan_id, FALSE);

        // Initialize session
        $_SESSION['user_access'] = config('\User\Config\UserConfig')->access_lvl_admin;

        // Execute delete_course_plan method of CoursePlan class
        $result = $this->controller(CoursePlan::class)
        ->execute('delete_course_plan', $course_plan_id, 3);

        // Assertions
        $response = $result->response();
        $this->assertInstanceOf(\CodeIgniter\HTTP\RedirectResponse::class, $response);
        $this->assertEmpty($response->getBody());
        $result->assertOK();
        $result->assertHeader('Content-Type', 'text/html; charset=UTF-8');
        $result->assertRedirectTo(base_url('plafor/courseplan/list_course_plan'));
    }

    /**
     * Asserts that the save_competence_domain page redirects to the 403 error view when an apprentice session user access is set
     */
    public function testsave_competence_domainWithApprenticeSessionUserAccess()
    {
        // Initialize session
        $_SESSION['_ci_previous_url'] = 'url'; // (needed for 403 error view)
        $_SESSION['user_access'] = config('\User\Config\UserConfig')->access_lvl_guest;

        // Execute save_competence_domain method of CoursePlan class
        $result = $this->controller(CoursePlan::class)
        ->execute('save_competence_domain');

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
     * Asserts that the save_competence_domain page redirects to the 403 error view when a trainer session user access is set
     */
    public function testsave_competence_domainWitTrainerSessionUserAccess()
    {
        // Initialize session
        $_SESSION['_ci_previous_url'] = 'url'; // (needed for 403 error view)
        $_SESSION['user_access'] = config('\User\Config\UserConfig')->access_lvl_trainer;

        // Execute save_competence_domain method of CoursePlan class
        $result = $this->controller(CoursePlan::class)
        ->execute('save_competence_domain');

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
     * Asserts that the save_competence_domain page is loaded correctly when an administrator session user access is set (no competenvce domain id and course plan id)
     */
    public function testsave_competence_domainWitAdministratorSessionUserAccessWithoutCompetenceDomainIdAndCoursePlanId()
    {
        // Initialize session
        $_SESSION['user_access'] = config('\User\Config\UserConfig')->access_lvl_admin;

        // Execute save_competence_domain method of CoursePlan class
        $result = $this->controller(CoursePlan::class)
        ->execute('save_competence_domain');

        // Assertions
        $response = $result->response();
        $this->assertInstanceOf(\CodeIgniter\HTTP\Response::class, $response);
        $this->assertNotEmpty($response->getBody());
        $result->assertOK();
        $result->assertHeader('Content-Type', 'text/html; charset=UTF-8');
        $result->assertSee('Ajouter un domaine de compétence', 'h1');
        $result->assertSeeElement('#competence_domain_form');
        $result->assertSee('Plan de formation lié au domaine de compétence', 'label');
        $result->assertSeeElement('#course_plan');
        $result->assertSee(' Informaticien/-ne CFC Développement d\'applications', 'option');
        $result->assertSee(' Informaticien/-ne CFC Informatique d\'entreprise', 'option');
        $result->assertSee('Symbole du domaine de compétence', 'label');
        $result->assertSeeElement('#competence_domain_symbol');
        $result->assertSee('Nom du domaine de compétence', 'label');
        $result->assertSeeElement('#competence_domain_name');
        $result->assertSeeLink('Annuler');
        $result->assertSeeInField('save', 'Enregistrer');
    }

    /**
     * Asserts that the save_competence_domain page is loaded correctly when an administrator session user access is set (competenvce domain id and course plan id are set)
     */
    public function testsave_competence_domainWitAdministratorSessionUserAccessWithCompetenceDomainIdAndCoursePlanId()
    {
        // Initialize session
        $_SESSION['user_access'] = config('\User\Config\UserConfig')->access_lvl_admin;

        // Execute save_competence_domain method of CoursePlan class
        $result = $this->controller(CoursePlan::class)
        ->execute('save_competence_domain', 1, 1);

        // Assertions
        $response = $result->response();
        $this->assertInstanceOf(\CodeIgniter\HTTP\Response::class, $response);
        $this->assertNotEmpty($response->getBody());
        $result->assertOK();
        $result->assertHeader('Content-Type', 'text/html; charset=UTF-8');
        $result->assertSee('Modifier le domaine de compétence', 'h1');
        $result->assertSeeElement('#competence_domain_form');
        $result->assertSee('Plan de formation lié au domaine de compétence', 'label');
        $result->assertSeeElement('#course_plan');
        $result->assertSee(' Informaticien/-ne CFC Développement d\'applications', 'option');
        $result->assertSee(' Informaticien/-ne CFC Informatique d\'entreprise', 'option');
        $result->assertSee('Symbole du domaine de compétence', 'label');
        $result->assertSeeElement('#competence_domain_symbol');
        $result->assertSee('Nom du domaine de compétence', 'label');
        $result->assertSeeElement('#competence_domain_name');
        $result->assertSeeLink('Annuler');
        $result->assertSeeInField('save', 'Enregistrer');
    }

    /**
     * Asserts that the delete_competence_domain page redirects to the 403 error view when an apprentice session user access is set
     */
    public function testdelete_competence_domainithApprenticeSessionUserAccess()
    {
        // Initialize session
        $_SESSION['_ci_previous_url'] = 'url'; // (needed for 403 error view)
        $_SESSION['user_access'] = config('\User\Config\UserConfig')->access_lvl_guest;

        // Execute delete_competence_domain method of CoursePlan class
        $result = $this->controller(CoursePlan::class)
        ->execute('delete_competence_domain');

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
     * Asserts that the delete_competence_domain page redirects to the 403 error view when a trainer session user access is set
     */
    public function testdelete_competence_domainWitTrainerSessionUserAccess()
    {
        // Initialize session
        $_SESSION['_ci_previous_url'] = 'url'; // (needed for 403 error view)
        $_SESSION['user_access'] = config('\User\Config\UserConfig')->access_lvl_trainer;

        // Execute delete_competence_domain method of CoursePlan class
        $result = $this->controller(CoursePlan::class)
        ->execute('delete_competence_domain');

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
     * Asserts that the delete_competence_domain page redirects to the list_course_plan view when an administrator session user access is set (without compentence domain id)
     */
    public function testdelete_competence_domainWitAdministratorSessionUserAccessWithoutCompetenceDomainId()
    {
        // Initialize session
        $_SESSION['user_access'] = config('\User\Config\UserConfig')->access_lvl_admin;

        // Execute delete_competence_domain method of CoursePlan class
        $result = $this->controller(CoursePlan::class)
        ->execute('delete_competence_domain');

        // Assertions
        $response = $result->response();
        $this->assertInstanceOf(\CodeIgniter\HTTP\RedirectResponse::class, $response);
        $this->assertEmpty($response->getBody());
        $result->assertOK();
        $result->assertHeader('Content-Type', 'text/html; charset=UTF-8');
        $result->assertRedirectTo(base_url('plafor/courseplan/list_course_plan'));
    }

    /**
     * Asserts that the delete_competence_domain page redirects to the list_course_plan view when an administrator session user access is set (with a non existing compentence domain id)
     */
    public function testdelete_competence_domainWitAdministratorSessionUserAccessWithNonExistingCompetenceDomainId()
    {
        // Initialize session
        $_SESSION['user_access'] = config('\User\Config\UserConfig')->access_lvl_admin;

        // Execute delete_competence_domain method of CoursePlan class
        $result = $this->controller(CoursePlan::class)
        ->execute('delete_competence_domain', 999999);

        // Assertions
        $response = $result->response();
        $this->assertInstanceOf(\CodeIgniter\HTTP\RedirectResponse::class, $response);
        $this->assertEmpty($response->getBody());
        $result->assertOK();
        $result->assertHeader('Content-Type', 'text/html; charset=UTF-8');
        $result->assertRedirectTo(base_url('plafor/courseplan/list_course_plan'));
    }

    /**
     * Asserts that the delete_competence_domain page is loaded correctly when an administrator session user access is set (with compentence domain id and no action)
     */
    public function testdelete_competence_domainWitAdministratorSessionUserAccessWithCompetenceDomainIdAndNoAction()
    {
        // Initialize session
        $_SESSION['user_access'] = config('\User\Config\UserConfig')->access_lvl_admin;

        // Execute delete_competence_domain method of CoursePlan class
        $result = $this->controller(CoursePlan::class)
        ->execute('delete_competence_domain', 1);

        // Assertions
        $response = $result->response();
        $this->assertInstanceOf(\CodeIgniter\HTTP\Response::class, $response);
        $this->assertNotEmpty($response->getBody());
        $result->assertOK();
        $result->assertHeader('Content-Type', 'text/html; charset=UTF-8');
        $result->assertSee('Domaine de compétence \'Saisie, interprétation et mise en œuvre des exigences des applications\'', 'h1');
        $result->assertSee('Que souhaitez-vous faire ?', 'h4');
        $result->assertSee('Toutes les informations concernant ce domaine de compétence (symbole, nom, compétences oppérationnelles et objectifs) seront désactivées.', 'div');
        $result->assertSeeLink('Annuler');
        $result->assertSeeLink('Désactiver');
    }

    /**
     * Asserts that the delete_competence_domain page redirects to the view_course_plan view when an administrator session user access is set (with compentence domain id and fake action)
     */
    public function testdelete_competence_domainWitAdministratorSessionUserAccessWithCompetenceDomainIdAndFakeAction()
    {
        // Initialize session
        $_SESSION['user_access'] = config('\User\Config\UserConfig')->access_lvl_admin;

        // Execute delete_competence_domain method of CoursePlan class
        $result = $this->controller(CoursePlan::class)
        ->execute('delete_competence_domain', 1, 9);

        // Assertions
        $response = $result->response();
        $this->assertInstanceOf(\CodeIgniter\HTTP\RedirectResponse::class, $response);
        $this->assertEmpty($response->getBody());
        $result->assertOK();
        $result->assertHeader('Content-Type', 'text/html; charset=UTF-8');
        $result->assertRedirectTo(base_url('plafor/courseplan/view_course_plan/1'));
    }

    /**
     * Asserts that the delete_competence_domain page redirects to the view_course_plan view when an administrator session user access is set (with compentence domain id and enable action)
     */
    public function testdelete_competence_domainWitAdministratorSessionUserAccessWithCompetenceDomainIdAndEnableAction()
    {
        $competence_domain_id = 1;

        // Disable competence domain
        \Plafor\Models\CompetenceDomainModel::getInstance()->delete($competence_domain_id, FALSE);

        // Initialize session
        $_SESSION['user_access'] = config('\User\Config\UserConfig')->access_lvl_admin;

        // Execute delete_competence_domain method of CoursePlan class
        $result = $this->controller(CoursePlan::class)
        ->execute('delete_competence_domain', $competence_domain_id, 3);

        // Assertions
        $response = $result->response();
        $this->assertInstanceOf(\CodeIgniter\HTTP\RedirectResponse::class, $response);
        $this->assertEmpty($response->getBody());
        $result->assertOK();
        $result->assertHeader('Content-Type', 'text/html; charset=UTF-8');
        $result->assertRedirectTo(base_url('plafor/courseplan/view_course_plan/1'));
    }

    /**
     * Asserts that the save_operational_competence page redirects to the 403 error view when an apprentice session user access is set
     */
    public function testsave_operational_competenceWithApprenticeSessionUserAccess()
    {
        // Initialize session
        $_SESSION['_ci_previous_url'] = 'url'; // (needed for 403 error view)
        $_SESSION['user_access'] = config('\User\Config\UserConfig')->access_lvl_guest;

        // Execute save_operational_competence method of CoursePlan class
        $result = $this->controller(CoursePlan::class)
        ->execute('save_operational_competence');

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
     * Asserts that the save_operational_competence page redirects to the 403 error view when a trainer session user access is set
     */
    public function testsave_operational_competenceWitTrainerSessionUserAccess()
    {
        // Initialize session
        $_SESSION['_ci_previous_url'] = 'url'; // (needed for 403 error view)
        $_SESSION['user_access'] = config('\User\Config\UserConfig')->access_lvl_trainer;

        // Execute save_operational_competence method of CoursePlan class
        $result = $this->controller(CoursePlan::class)
        ->execute('save_operational_competence');

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
     * Asserts that the save_operational_competence page is loaded correctly when an administrator session user access is set (no operational competence id)
     */
    public function testsave_operational_competenceWitAdministratorSessionUserAccessWithoutOperationalCompetenceId()
    {
        // Initialize session
        $_SESSION['user_access'] = config('\User\Config\UserConfig')->access_lvl_admin;

        // Execute save_operational_competence method of CoursePlan class
        $result = $this->controller(CoursePlan::class)
        ->execute('save_operational_competence');

        // Assertions
        $response = $result->response();
        $this->assertInstanceOf(\CodeIgniter\HTTP\Response::class, $response);
        $this->assertNotEmpty($response->getBody());
        $result->assertOK();
        $result->assertHeader('Content-Type', 'text/html; charset=UTF-8');
        $result->assertSee('Ajouter une compétence opérationnelle', 'h1');
        $result->assertSeeElement('#operational_competence_form');
        $result->assertSee('Domaine de compétence lié à la compétence opérationnelle', 'label');
        $result->assertSeeElement('#competence_domain');
        $result->assertSee('Saisie, interprétation et mise en œuvre des exigences des applications', 'option');
        $result->assertSee('Symbole de la compétence opérationnelle', 'label');
        $result->assertSeeInField('symbol', '');
        $result->assertSee('Nom de la compétence opérationnelle', 'label');
        $result->assertSeeInField('name', '');
        $result->assertSee('Compétence méthodologique', 'label');
        $result->assertSeeElement('#operational_competence_methodologic');
        $result->assertSee('Compétence sociale', 'label');
        $result->assertSeeElement('#operational_competence_social');
        $result->assertSee('Compétence personnelle', 'label');
        $result->assertSeeElement('#operational_competence_personal');
        $result->assertSeeLink('Annuler');
        $result->assertSeeInField('save', 'Enregistrer');
    }

    /**
     * Asserts that the save_operational_competence page is loaded correctly when an administrator session user access is set (operational competence id)
     */
    public function testsave_operational_competenceWitAdministratorSessionUserAccessWithOperationalCompetenceId()
    {
        // Initialize session
        $_SESSION['user_access'] = config('\User\Config\UserConfig')->access_lvl_admin;

        // Execute save_operational_competence method of CoursePlan class
        $result = $this->controller(CoursePlan::class)
        ->execute('save_operational_competence', 1);

        // Assertions
        $response = $result->response();
        $this->assertInstanceOf(\CodeIgniter\HTTP\Response::class, $response);
        $this->assertNotEmpty($response->getBody());
        $result->assertOK();
        $result->assertHeader('Content-Type', 'text/html; charset=UTF-8');
        $result->assertSee('Modifier la compétence opérationnelle', 'h1');
        $result->assertSeeElement('#operational_competence_form');
        $result->assertSee('Domaine de compétence lié à la compétence opérationnelle', 'label');
        $result->assertSeeElement('#competence_domain');
        $result->assertSee('Saisie, interprétation et mise en œuvre des exigences des applications', 'option');
        $result->assertSee('Symbole de la compétence opérationnelle', 'label');
        $result->assertSeeInField('symbol', 'A1');
        $result->assertSee('Nom de la compétence opérationnelle', 'label');
        $result->assertSeeInField('name', 'Analyser, structurer et documenter les exigences ainsi que les besoins');
        $result->assertSee('Compétence méthodologique', 'label');
        $result->assertSeeElement('#operational_competence_methodologic');
        $result->assertSee('Travail structuré, documentation adéquate', 'textarea');
        $result->assertSee('Compétence sociale', 'label');
        $result->assertSeeElement('#operational_competence_social');
        $result->assertSee('Comprendre et sentir les problèmes du client, communication avec des partenaires', 'textarea');
        $result->assertSee('Compétence personnelle', 'label');
        $result->assertSeeElement('#operational_competence_personal');
        $result->assertSee('Fiabilité, autoréflexion, interrogation constructive du problème', 'textarea');
        $result->assertSeeLink('Annuler');
        $result->assertSeeInField('save', 'Enregistrer');
    }

    /**
     * Asserts that the delete_operational_competence page redirects to the 403 error view when an apprentice session user access is set
     */
    public function testdelete_operational_competenceWithApprenticeSessionUserAccess()
    {
        // Initialize session
        $_SESSION['_ci_previous_url'] = 'url'; // (needed for 403 error view)
        $_SESSION['user_access'] = config('\User\Config\UserConfig')->access_lvl_guest;

        // Execute delete_operational_competence method of CoursePlan class
        $result = $this->controller(CoursePlan::class)
        ->execute('delete_operational_competence', 1);

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
     * Asserts that the delete_operational_competence page redirects to the 403 error view when a trainer session user access is set
     */
    public function testdelete_operational_competenceWitTrainerSessionUserAccess()
    {
        // Initialize session
        $_SESSION['_ci_previous_url'] = 'url'; // (needed for 403 error view)
        $_SESSION['user_access'] = config('\User\Config\UserConfig')->access_lvl_trainer;

        // Execute delete_operational_competence method of CoursePlan class
        $result = $this->controller(CoursePlan::class)
        ->execute('delete_operational_competence', 1);

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
     * Asserts that the delete_operational_competence page is loaded correctly when an administrator session user access is set (no action)
     */
    public function testdelete_operational_competenceWitAdministratorSessionUserAccessWithoutAction()
    {
        // Initialize session
        $_SESSION['user_access'] = config('\User\Config\UserConfig')->access_lvl_admin;

        // Execute delete_operational_competence method of CoursePlan class
        $result = $this->controller(CoursePlan::class)
        ->execute('delete_operational_competence', 1);

        // Assertions
        $response = $result->response();
        $this->assertInstanceOf(\CodeIgniter\HTTP\Response::class, $response);
        $this->assertNotEmpty($response->getBody());
        $result->assertOK();
        $result->assertHeader('Content-Type', 'text/html; charset=UTF-8');
        $result->assertSee('Compétence opérationnelle \'Analyser, structurer et documenter les exigences ainsi que les besoins\'', 'h1');
        $result->assertSee('Que souhaitez-vous faire ?', 'h4');
        $result->assertSee('Toutes les informations concernant cette compétence opérationnelle (nom, symbole, compétences, objectifs) seront désactivées.', 'div');
        $result->assertSeeLink('Annuler');
        $result->assertSeeLink('Désactiver');
    }

    /**
     * Asserts that the delete_operational_competence page redirects to the view_competence_domain view when an administrator session user access is set (fake action)
     */
    public function testdelete_operational_competenceWitAdministratorSessionUserAccessWithFakeAction()
    {
        // Initialize session
        $_SESSION['user_access'] = config('\User\Config\UserConfig')->access_lvl_admin;

        // Execute delete_operational_competence method of CoursePlan class
        $result = $this->controller(CoursePlan::class)
        ->execute('delete_operational_competence', 1, 9);

        // Assertions
        $response = $result->response();
        $this->assertInstanceOf(\CodeIgniter\HTTP\RedirectResponse::class, $response);
        $this->assertEmpty($response->getBody());
        $result->assertOK();
        $result->assertHeader('Content-Type', 'text/html; charset=UTF-8');
        $result->assertRedirectTo(base_url('plafor/courseplan/view_competence_domain/1'));
    }

    /**
     * Asserts that the delete_operational_competence page redirects to the view_competence_domain view when an administrator session user access is set (non existing operational competence)
     */
    public function testdelete_operational_competenceWitAdministratorSessionUserAccessForNonExistingOperationalCompetenceId()
    {
        // Initialize session
        $_SESSION['user_access'] = config('\User\Config\UserConfig')->access_lvl_admin;

        // Execute delete_operational_competence method of CoursePlan class
        $result = $this->controller(CoursePlan::class)
        ->execute('delete_operational_competence', 999999);

        // Assertions
        $response = $result->response();
        $this->assertInstanceOf(\CodeIgniter\HTTP\RedirectResponse::class, $response);
        $this->assertEmpty($response->getBody());
        $result->assertOK();
        $result->assertHeader('Content-Type', 'text/html; charset=UTF-8');
        $result->assertRedirectTo(base_url('plafor/courseplan/list_course_plan'));
    }

    /**
     * Asserts that the delete_operational_competence page redirects to the view_competence_domain view when an administrator session user access is set (enable action)
     */
    public function testdelete_operational_competenceWitAdministratorSessionUserAccessWithEnableAction()
    {
        $operational_competence_id = 1;

        // Disable operational competence
        \Plafor\Models\OperationalCompetenceModel::getInstance()->delete($operational_competence_id, FALSE);

        // Initialize session
        $_SESSION['user_access'] = config('\User\Config\UserConfig')->access_lvl_admin;

        // Execute delete_operational_competence method of CoursePlan class
        $result = $this->controller(CoursePlan::class)
        ->execute('delete_operational_competence', $operational_competence_id, 3);

        // Assertions
        $response = $result->response();
        $this->assertInstanceOf(\CodeIgniter\HTTP\RedirectResponse::class, $response);
        $this->assertEmpty($response->getBody());
        $result->assertOK();
        $result->assertHeader('Content-Type', 'text/html; charset=UTF-8');
        $result->assertRedirectTo(base_url('plafor/courseplan/view_competence_domain/1'));
    }

    /**
     * Asserts that the delete_user_course page redirects to the 403 error view when an apprentice session user access is set
     */
    public function testdelete_user_courseWithApprenticeSessionUserAccess()
    {
        // Initialize session
        $_SESSION['_ci_previous_url'] = 'url'; // (needed for 403 error view)
        $_SESSION['user_access'] = config('\User\Config\UserConfig')->access_lvl_guest;

        // Execute delete_user_course method of CoursePlan class
        $result = $this->controller(CoursePlan::class)
        ->execute('delete_user_course', 1);

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
     * Asserts that the delete_user_course page redirects to the 403 error view when a trainer session user access is set
     */
    public function testdelete_user_courseWitTrainerSessionUserAccess()
    {
        // Initialize session
        $_SESSION['_ci_previous_url'] = 'url'; // (needed for 403 error view)
        $_SESSION['user_access'] = config('\User\Config\UserConfig')->access_lvl_trainer;

        // Execute delete_user_course method of CoursePlan class
        $result = $this->controller(CoursePlan::class)
        ->execute('delete_user_course', 1);

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
     * Asserts that the delete_user_course page is loaded correctly when an administrator session user access is set (no action)
     */
    public function testdelete_user_courseWitAdministratorSessionUserAccessAndNoAction()
    {
        // Initialize session
        $_SESSION['user_access'] = config('\User\Config\UserConfig')->access_lvl_admin;

        // Execute delete_user_course method of CoursePlan class
        $result = $this->controller(CoursePlan::class)
        ->execute('delete_user_course', 1);

        // Assertions
        $response = $result->response();
        $this->assertInstanceOf(\CodeIgniter\HTTP\Response::class, $response);
        $this->assertNotEmpty($response->getBody());
        $result->assertOK();
        $result->assertHeader('Content-Type', 'text/html; charset=UTF-8');
        $result->assertSee('Apprenti \'ApprentiDev\'', 'h1');
        $result->assertSee('Plan de formation \' Informaticien/-ne CFC Développement d\'applications\'', 'h1');
        $result->assertSee('Statut de la formation \'En cours\'', 'h1');
        $result->assertSee('Que souhaitez-vous faire ?', 'h4');
        $result->assertSee('Toutes les informations concernant cette formation liée seront désactivées.', 'div');
        $result->assertSeeLink('Annuler');
        $result->assertSeeLink('Désactiver');
    }

    /**
     * Asserts that the delete_user_course page redirects to the list_apprentice view when an administrator session user access is set (fake action)
     */
    public function testdelete_user_courseWitAdministratorSessionUserAccessAndFakeAction()
    {
        // Initialize session
        $_SESSION['user_access'] = config('\User\Config\UserConfig')->access_lvl_admin;

        // Execute delete_user_course method of CoursePlan class
        $result = $this->controller(CoursePlan::class)
        ->execute('delete_user_course', 1, 9);

        // Assertions
        $response = $result->response();
        $this->assertInstanceOf(\CodeIgniter\HTTP\RedirectResponse::class, $response);
        $this->assertEmpty($response->getBody());
        $result->assertOK();
        $result->assertHeader('Content-Type', 'text/html; charset=UTF-8');
        $result->assertRedirectTo(base_url('plafor/apprentice/list_apprentice'));
    }

    /**
     * Asserts that the save_objective page redirects to the 403 error view when an apprentice session user access is set
     */
    public function testsave_objectiveWithApprenticeSessionUserAccess()
    {
        // Initialize session
        $_SESSION['_ci_previous_url'] = 'url'; // (needed for 403 error view)
        $_SESSION['user_access'] = config('\User\Config\UserConfig')->access_lvl_guest;

        // Execute save_objective method of CoursePlan class
        $result = $this->controller(CoursePlan::class)
        ->execute('save_objective');

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
     * Asserts that the save_objective page redirects to the 403 error view when a trainer session user access is set
     */
    public function testsave_objectiveWitTrainerSessionUserAccess()
    {
        // Initialize session
        $_SESSION['_ci_previous_url'] = 'url'; // (needed for 403 error view)
        $_SESSION['user_access'] = config('\User\Config\UserConfig')->access_lvl_trainer;

        // Execute save_objective method of CoursePlan class
        $result = $this->controller(CoursePlan::class)
        ->execute('save_objective');

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
     * Asserts that the save_objective page is loaded correctly when an administrator session user access is set
     */
    public function testsave_objectiveWitAdministratorSessionUserAccess()
    {
        // Initialize session
        $_SESSION['user_access'] = config('\User\Config\UserConfig')->access_lvl_admin;

        // Execute save_objective method of CoursePlan class
        $result = $this->controller(CoursePlan::class)
        ->execute('save_objective');

        // Assertions
        $response = $result->response();
        $this->assertInstanceOf(\CodeIgniter\HTTP\Response::class, $response);
        $this->assertNotEmpty($response->getBody());
        $result->assertOK();
        $result->assertHeader('Content-Type', 'text/html; charset=UTF-8');
        $result->assertSee('Ajouter un objectif', 'h1');
        $result->assertSeeElement('#objective_form');
        $result->assertSee('Compétence opérationnelle liée à l\'objectif', 'label');
        $result->assertSeeElement('#operational_competence');
        $result->assertSee('Analyser, structurer et documenter les exigences ainsi que les besoins', 'option');
        $result->assertSee('Symboles de l\'objectif', 'label');
        $result->assertSeeElement('#objective_symbol');
        $result->assertSeeInField('symbol', '');
        $result->assertSee('Taxonomie de l\'objectif', 'label');
        $result->assertSeeElement('#objective_taxonomy');
        $result->assertSeeInField('taxonomy', '');
        $result->assertSee('Nom de l\'objectif', 'label');
        $result->assertSeeElement('#objective_name');
        $result->assertSeeInField('name', '');
        $result->assertSeeLink('Annuler');
        $result->assertSeeInField('save', 'Enregistrer');
    }

    /**
     * Asserts that the save_objective page is loaded correctly when an administrator session user access is set (objective id is given)
     */
    public function testsave_objectiveWitAdministratorSessionUserAccessWithObjectiveId()
    {
        // Initialize session
        $_SESSION['user_access'] = config('\User\Config\UserConfig')->access_lvl_admin;

        // Execute save_objective method of CoursePlan class
        $result = $this->controller(CoursePlan::class)
        ->execute('save_objective', 1);

        // Assertions
        $response = $result->response();
        $this->assertInstanceOf(\CodeIgniter\HTTP\Response::class, $response);
        $this->assertNotEmpty($response->getBody());
        $result->assertOK();
        $result->assertHeader('Content-Type', 'text/html; charset=UTF-8');
        $result->assertSee('Modifier l\'objectif', 'h1');
        $result->assertSeeElement('#objective_form');
        $result->assertSee('Compétence opérationnelle liée à l\'objectif', 'label');
        $result->assertSeeElement('#operational_competence');
        $result->assertSee('Analyser, structurer et documenter les exigences ainsi que les besoins', 'option');
        $result->assertSee('Symboles de l\'objectif', 'label');
        $result->assertSeeElement('#objective_symbol');
        $result->assertSeeInField('symbol', 'A.1.1');
        $result->assertSee('Taxonomie de l\'objectif', 'label');
        $result->assertSeeElement('#objective_taxonomy');
        $result->assertSeeInField('taxonomy', '4');
        $result->assertSee('Nom de l\'objectif', 'label');
        $result->assertSeeElement('#objective_name');
        $result->assertSeeInField('name', 'Enregistrer les besoins et discuter les solutions possibles, s’entretenir avec le client/supérieur sur les restrictions des exigences');
        $result->assertSeeLink('Annuler');
        $result->assertSeeInField('save', 'Enregistrer');
    }

    /**
     * Asserts that the delete_objective page redirects to the 403 error view when an apprentice session user access is set
     */
    public function testdelete_objectiveWithApprenticeSessionUserAccess()
    {
        // Initialize session
        $_SESSION['_ci_previous_url'] = 'url'; // (needed for 403 error view)
        $_SESSION['user_access'] = config('\User\Config\UserConfig')->access_lvl_guest;

        // Execute delete_objective method of CoursePlan class
        $result = $this->controller(CoursePlan::class)
        ->execute('delete_objective', 1);

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
     * Asserts that the delete_objective page redirects to the 403 error view when a trainer session user access is set
     */
    public function testdelete_objectiveWitTrainerSessionUserAccess()
    {
        // Initialize session
        $_SESSION['_ci_previous_url'] = 'url'; // (needed for 403 error view)
        $_SESSION['user_access'] = config('\User\Config\UserConfig')->access_lvl_trainer;

        // Execute delete_objective method of CoursePlan class
        $result = $this->controller(CoursePlan::class)
        ->execute('delete_objective', 1);

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
     * Asserts that the delete_objective page is loaded correctly when an administrator session user access is set
     */
    public function testdelete_objectiveWitAdministratorSessionUserAccess()
    {
        // Initialize session
        $_SESSION['user_access'] = config('\User\Config\UserConfig')->access_lvl_admin;

        // Execute delete_objective method of CoursePlan class
        $result = $this->controller(CoursePlan::class)
        ->execute('delete_objective', 1);

        // Assertions
        $response = $result->response();
        $this->assertInstanceOf(\CodeIgniter\HTTP\Response::class, $response);
        $this->assertNotEmpty($response->getBody());
        $result->assertOK();
        $result->assertHeader('Content-Type', 'text/html; charset=UTF-8');
        $result->assertSee('Objectif \'Enregistrer les besoins et discuter les solutions possibles, s’entretenir avec le client/supérieur sur les restrictions des exigences\'', 'h1');
        $result->assertSee('Que souhaitez-vous faire ?', 'h4');
        $result->assertSee('Toutes les informations concernant cet objectif (symbole, taxonomie, nom) seront désactivées.', 'div');
        $result->assertSeeLink('Annuler');
        $result->assertSeeLink('Désactiver');
    }

    /**
     * Asserts that the delete_objective page redirects to the view_operational_competence view when an administrator session user access is set (fake action)
     */
    public function testdelete_objectiveWitAdministratorSessionUserAccessAndFakeAction()
    {
        // Initialize session
        $_SESSION['user_access'] = config('\User\Config\UserConfig')->access_lvl_admin;

        // Execute delete_objective method of CoursePlan class
        $result = $this->controller(CoursePlan::class)
        ->execute('delete_objective', 1, 9);

        // Assertions
        $response = $result->response();
        $this->assertInstanceOf(\CodeIgniter\HTTP\RedirectResponse::class, $response);
        $this->assertEmpty($response->getBody());
        $result->assertOK();
        $result->assertHeader('Content-Type', 'text/html; charset=UTF-8');
        $result->assertRedirectTo(base_url('plafor/courseplan/view_operational_competence/1'));
    }

    /**
     * Asserts that the delete_objective page redirects to the view_operational_competence view when an administrator session user access is set (disable action)
     */
    public function testdelete_objectiveWitAdministratorSessionUserAccessAndDisableAction()
    {
        $objective_id = 1;

        // Initialize session
        $_SESSION['user_access'] = config('\User\Config\UserConfig')->access_lvl_admin;

        // Execute delete_objective method of CoursePlan class
        $result = $this->controller(CoursePlan::class)
        ->execute('delete_objective', $objective_id, 1);

        // Assertions
        $response = $result->response();
        $this->assertInstanceOf(\CodeIgniter\HTTP\RedirectResponse::class, $response);
        $this->assertEmpty($response->getBody());
        $result->assertOK();
        $result->assertHeader('Content-Type', 'text/html; charset=UTF-8');
        $result->assertRedirectTo(base_url('plafor/courseplan/view_operational_competence/1'));

        // Enable objective
        \Plafor\Models\ObjectiveModel::getInstance()->withDeleted()->update($objective_id, ['archive' => null]);
    }

    /**
     * Asserts that the delete_objective page redirects to the view_operational_competence view when an administrator session user access is set (enable action)
     */
    public function testdelete_objectiveWitAdministratorSessionUserAccessAndEnableAction()
    {
        $objective_id = 1;

        // Disable objective
        \Plafor\Models\ObjectiveModel::getInstance()->delete($objective_id, FALSE);

        // Initialize session
        $_SESSION['user_access'] = config('\User\Config\UserConfig')->access_lvl_admin;

        // Execute delete_objective method of CoursePlan class
        $result = $this->controller(CoursePlan::class)
        ->execute('delete_objective', $objective_id, 3);

        // Assertions
        $response = $result->response();
        $this->assertInstanceOf(\CodeIgniter\HTTP\RedirectResponse::class, $response);
        $this->assertEmpty($response->getBody());
        $result->assertOK();
        $result->assertHeader('Content-Type', 'text/html; charset=UTF-8');
        $result->assertRedirectTo(base_url('plafor/courseplan/view_operational_competence/1'));
    }

    /**
     * Asserts that the list_course_plan page is loaded correctly when no apprentice id is given
     */
    public function testlist_course_planWithNoApprenticeId() 
    {
        // Execute list_course_plan method of CoursePlan class
        $result = $this->controller(CoursePlan::class)
        ->execute('list_course_plan');

        // Assertions
        $response = $result->response();
        $this->assertInstanceOf(\CodeIgniter\HTTP\Response::class, $response);
        $this->assertNotEmpty($response->getBody());
        $result->assertOK();
        $result->assertHeader('Content-Type', 'text/html; charset=UTF-8');
        $result->assertSee('Liste des plans de formation', 'h1');
        $result->assertSeeLink('Nouveau');
        $result->assertSeeElement('#toggle_deleted');
        $result->assertSee('Afficher les éléments désactivés', 'label');
        $result->assertSee('Nom du plan de formation', 'th');
        $result->assertSeeElement('#course_planslist');
        $result->assertSee('88601', 'span');
        $result->assertSee('88602', 'span');
        $result->assertSee('88603', 'span');
        $result->assertSee('88605', 'span');
        $result->assertSee('88611', 'span');        // Informaticienne / Informaticien Sys
        $result->assertSee('88611', 'span');        // Informaticienne / Informaticien Dev
        $result->assertSee('88614', 'span');
    }

    /**
     * Asserts that the list_course_plan page is loaded correctly when an apprentice id is given
     */
    public function testlist_course_planWithApprenticeId() 
    {
        // Execute list_course_plan method of CoursePlan class
        $result = $this->controller(CoursePlan::class)
        ->execute('list_course_plan', 4);

        // Assertions
        $response = $result->response();
        $this->assertInstanceOf(\CodeIgniter\HTTP\Response::class, $response);
        $this->assertNotEmpty($response->getBody());
        $result->assertOK();
        $result->assertHeader('Content-Type', 'text/html; charset=UTF-8');
        $result->assertSee('Liste des plans de formation', 'h1');
        $result->assertSeeLink('Nouveau');
        $result->assertSeeElement('#toggle_deleted');
        $result->assertSee('Afficher les éléments désactivés', 'label');
        $result->assertSee('Nom du plan de formation', 'th');
        $result->assertSeeElement('#course_planslist');
        $result->assertSee('88601', 'span');
        $result->assertDontSee('88602', 'span');
        $result->assertDontSee('88603', 'span');
        $result->assertDontSee('88605', 'span');
        $result->assertDontSee('88611', 'span');        // Informaticienne / Informaticien Sys
        $result->assertDontSee('88611', 'span');        // Informaticienne / Informaticien Dev
        $result->assertDontSee('88614', 'span');
    }

    /**
     * Asserts that the view_course_plan page redirects to the list_course_plan view when no course plan id is given
     */
    public function testview_course_planWithNoCoursePlanId()
    {
        // Execute view_course_plan method of CoursePlan class
        $result = $this->controller(CoursePlan::class)
        ->execute('view_course_plan');

        // Assertions
        $response = $result->response();
        $this->assertInstanceOf(\CodeIgniter\HTTP\RedirectResponse::class, $response);
        $this->assertEmpty($response->getBody());
        $result->assertOK();
        $result->assertHeader('Content-Type', 'text/html; charset=UTF-8');
        $result->assertRedirectTo(base_url('plafor/courseplan/list_course_plan'));
    }

    /**
     * Asserts that the view_course_plan page redirects to the list_course_plan view when a course plan id is given
     */
    public function testview_course_planWithCoursePlanId()
    {
        // Execute view_course_plan method of CoursePlan class
        $result = $this->controller(CoursePlan::class)
        ->execute('view_course_plan', 1);

        // Assertions
        $response = $result->response();
        $this->assertInstanceOf(\CodeIgniter\HTTP\Response::class, $response);
        $this->assertNotEmpty($response->getBody());
        $result->assertOK();
        $result->assertHeader('Content-Type', 'text/html; charset=UTF-8');
        $result->assertSee('Détail du plan de formation', 'p');
        $result->assertSee(' Informaticien/-ne CFC Développement d\'applications', 'p');
        $result->assertSee('No 88601, entré en vigueur le 01.08.2014', 'p');
        $result->assertSee('Domaines de compétences liés', 'p');
        $result->assertSee('Symbole', 'span');
        $result->assertSee('Domaine de compétence', 'span');
        $result->assertSeeLink('A');
        $result->assertSeeLink('Saisie, interprétation et mise en œuvre des exigences des applications');
        $result->assertSeeLink('B');
        $result->assertSeeLink('Développement d’applications en tenant compte des caractéristiques de qualité');
        $result->assertSeeLink('C');
        $result->assertSeeLink('Création et maintenance de données ainsi que de leurs structures');
        $result->assertSeeLink('D');
        $result->assertSeeLink(' Mise en service d’appareils TIC');
        $result->assertSeeLink('E');
        $result->assertSeeLink('Travail sur des projets');
    }

    /**
     * Asserts that the view_course_plan page redirects to the list_course_plan view when non existing course plan id is given
     */
    public function testview_course_planWithNonExistingCoursePlanId()
    {
        // Execute view_course_plan method of CoursePlan class
        $result = $this->controller(CoursePlan::class)
        ->execute('view_course_plan', 999999);

        // Assertions
        $response = $result->response();
        $this->assertInstanceOf(\CodeIgniter\HTTP\RedirectResponse::class, $response);
        $this->assertEmpty($response->getBody());
        $result->assertOK();
        $result->assertHeader('Content-Type', 'text/html; charset=UTF-8');
        $result->assertRedirectTo(base_url('plafor/courseplan/list_course_plan'));
    }

    /**
     * Asserts that the view_competence_domain page redirects to the list_course_plan view when no competenvce domain id is given
     */
    public function testview_competence_domainWithNoCompetenceDomainId()
    {
        // Execute view_competence_domain method of CoursePlan class
        $result = $this->controller(CoursePlan::class)
        ->execute('view_competence_domain');

        // Assertions
        $response = $result->response();
        $this->assertInstanceOf(\CodeIgniter\HTTP\RedirectResponse::class, $response);
        $this->assertEmpty($response->getBody());
        $result->assertOK();
        $result->assertHeader('Content-Type', 'text/html; charset=UTF-8');
        $result->assertRedirectTo(base_url('plafor/courseplan/list_course_plan'));
    }

    /**
     * Asserts that the view_competence_domain page is loaded correctly when a competence domain id is given
     */
    public function testview_competence_domainWithCompetenceDomainId()
    {
        // Execute view_competence_domain method of CoursePlan class
        $result = $this->controller(CoursePlan::class)
        ->execute('view_competence_domain', 1);

        // Assertions
        $response = $result->response();
        $this->assertInstanceOf(\CodeIgniter\HTTP\Response::class, $response);
        $this->assertNotEmpty($response->getBody());
        $result->assertOK();
        $result->assertHeader('Content-Type', 'text/html; charset=UTF-8');
        $result->assertSee('Détail du plan de formation', 'p');
        $result->assertSee(' Informaticien/-ne CFC Développement d\'applications', 'p');
        $result->assertSee('No 88601, entré en vigueur le 01.08.2014', 'p');
        $result->assertSee('Détail du domaine de compétence', 'p');
        $result->assertSee('A : Saisie, interprétation et mise en œuvre des exigences des applications', 'p');
        $result->assertSee('Symbole', 'span');
        $result->assertSee('Compétence opérationnelle', 'span');
        $result->assertSeeLink('A1');
        $result->assertSeeLink('Analyser, structurer et documenter les exigences ainsi que les besoins');
        $result->assertSeeLink('A2');
        $result->assertSeeLink('Elaborer diverses propositions de solutions incluant les interfaces utilisateurs requises');
        $result->assertSeeLink('A3');
        $result->assertSeeLink('Vérifier l’exhaustivité des exigences et des besoins dans les propositions de solution choisies');
    }

    /**
     * Asserts that the view_competence_domain page redirects to the list_course_plan view when non existing competenvce domain id is given
     */
    public function testview_competence_domainWithNonExistingCompetenceDomainId()
    {
        // Execute view_competence_domain method of CoursePlan class
        $result = $this->controller(CoursePlan::class)
        ->execute('view_competence_domain', 999999);

        // Assertions
        $response = $result->response();
        $this->assertInstanceOf(\CodeIgniter\HTTP\RedirectResponse::class, $response);
        $this->assertEmpty($response->getBody());
        $result->assertOK();
        $result->assertHeader('Content-Type', 'text/html; charset=UTF-8');
        $result->assertRedirectTo(base_url('plafor/courseplan/list_course_plan'));
    }

    /**
     * Asserts that the view_operational_competence page redirects to the list_course_plan view when no operational competenvce id is given
     */
    public function testview_operational_competenceWithNoOperationalCompetenceId()
    {
        // Execute view_operational_competence method of CoursePlan class
        $result = $this->controller(CoursePlan::class)
        ->execute('view_operational_competence');

        // Assertions
        $response = $result->response();
        $this->assertInstanceOf(\CodeIgniter\HTTP\RedirectResponse::class, $response);
        $this->assertEmpty($response->getBody());
        $result->assertOK();
        $result->assertHeader('Content-Type', 'text/html; charset=UTF-8');
        $result->assertRedirectTo(base_url('plafor/courseplan/list_course_plan'));
    }

    /**
     * Asserts that the view_operational_competence page is loaded correctly when an operational competenvce id is given
     */
    public function testview_operational_competenceWithOperationalCompetenceId()
    {
        // Execute view_operational_competence method of CoursePlan class
        $result = $this->controller(CoursePlan::class)
        ->execute('view_operational_competence', 1);

        // Assertions
        $response = $result->response();
        $this->assertInstanceOf(\CodeIgniter\HTTP\Response::class, $response);
        $this->assertNotEmpty($response->getBody());
        $result->assertOK();
        $result->assertHeader('Content-Type', 'text/html; charset=UTF-8');
        $result->assertSee('Détail du plan de formation', 'p');
        $result->assertSee('Numéro du plan de formation', 'p');
        $result->assertSeeLink('88601');
        $result->assertSeeLink(' Informaticien/-ne CFC Développement d\'applications');
        $result->assertSee('Détail du domaine de compétence', 'p');
        $result->assertSee('Symbole du domaine de compétence', 'p');
        $result->assertSeeLink('A');
        $result->assertSee('Nom du domaine de compétence', 'p');
        $result->assertSeeLink('Saisie, interprétation et mise en œuvre des exigences des applications');
        $result->assertSee('Détail de la compétence opérationnelle', 'p');
        $result->assertSee('Symbole de la compétence opérationnelle', 'p');
        $result->assertSee('A1', 'p');
        $result->assertSee('Nom de la compétence opérationnelle', 'p');
        $result->assertSee('Analyser, structurer et documenter les exigences ainsi que les besoins', 'p');
        $result->assertSee('Compétence méthodologique', 'p');
        $result->assertSee('Travail structuré, documentation adéquate', 'p');
        $result->assertSee('Compétence sociale', 'p');
        $result->assertSee('Comprendre et sentir les problèmes du client, communication avec des partenaires', 'p');
        $result->assertSee('Compétence personnelle', 'p');
        $result->assertSee('Fiabilité, autoréflexion, interrogation constructive du problème', 'p');
        $result->assertSee('Objectifs liés à la compétence opérationnelle', 'p');
        $result->assertSee('Symbole des objectifs', 'span');
        $result->assertSee('Taxonomie des objectifs', 'span');
        $result->assertSee('Nom des objectifs', 'span');
        $result->assertSeeLink('A.1.1');
        $result->assertSeeLink('4');
        $result->assertSeeLink('Enregistrer les besoins et discuter les solutions possibles, s’entretenir avec le client/supérieur sur les restrictions des exigences');
    }

    /**
     * Asserts that the view_operational_competence page redirects to the list_course_plan view when a non existing operational competenvce id is given
     */
    public function testview_operational_competenceWithNonExistingOperationalCompetenceId()
    {
        // Execute view_operational_competence method of CoursePlan class
        $result = $this->controller(CoursePlan::class)
        ->execute('view_operational_competence', 999999);

        // Assertions
        $response = $result->response();
        $this->assertInstanceOf(\CodeIgniter\HTTP\RedirectResponse::class, $response);
        $this->assertEmpty($response->getBody());
        $result->assertOK();
        $result->assertHeader('Content-Type', 'text/html; charset=UTF-8');
        $result->assertRedirectTo(base_url('plafor/courseplan/list_course_plan'));
    }

    /**
     * Asserts that the view_objective page redirects to the list_course_plan view when no objective id is given
     */
    public function testview_objectiveWithNoObjectiveId()
    {
        // Execute view_objective method of CoursePlan class
        $result = $this->controller(CoursePlan::class)
        ->execute('view_objective');

        // Assertions
        $response = $result->response();
        $this->assertInstanceOf(\CodeIgniter\HTTP\RedirectResponse::class, $response);
        $this->assertEmpty($response->getBody());
        $result->assertOK();
        $result->assertHeader('Content-Type', 'text/html; charset=UTF-8');
        $result->assertRedirectTo(base_url('plafor/courseplan/list_course_plan'));
    }

    /**
     * Asserts that the view_objective page is loaded correctly when an objective id is given
     */
    public function testview_objectiveWithObjectiveId()
    {
        // Execute view_objective method of CoursePlan class
        $result = $this->controller(CoursePlan::class)
        ->execute('view_objective', 1);

        // Assertions
        $response = $result->response();
        $this->assertInstanceOf(\CodeIgniter\HTTP\Response::class, $response);
        $this->assertNotEmpty($response->getBody());
        $result->assertOK();
        $result->assertHeader('Content-Type', 'text/html; charset=UTF-8');
        $result->assertSee('Détail du plan de formation', 'p');
        $result->assertSee('Numéro du plan de formation', 'p');
        $result->assertSeeLink('88601');
        $result->assertSeeLink(' Informaticien/-ne CFC Développement d\'applications');
        $result->assertSee('Détail du domaine de compétence', 'p');
        $result->assertSee('Symbole du domaine de compétence', 'p');
        $result->assertSeeLink('A');
        $result->assertSee('Nom du domaine de compétence', 'p');
        $result->assertSeeLink('Saisie, interprétation et mise en œuvre des exigences des applications');
        $result->assertSee('Détail de la compétence opérationnelle', 'p');
        $result->assertSee('Symbole de la compétence opérationnelle', 'p');
        $result->assertSeeLink('A1');
        $result->assertSee('Nom de la compétence opérationnelle', 'p');
        $result->assertSeeLink('Analyser, structurer et documenter les exigences ainsi que les besoins');
        $result->assertSee('Compétence méthodologique', 'p');
        $result->assertSeeLink('Travail structuré, documentation adéquate');
        $result->assertSee('Compétence sociale', 'p');
        $result->assertSeeLink('Comprendre et sentir les problèmes du client, communication avec des partenaires');
        $result->assertSee('Compétence personnelle', 'p');
        $result->assertSeeLink('Fiabilité, autoréflexion, interrogation constructive du problème');
        $result->assertSee('Détails de l\'objectif', 'p');
        $result->assertSee('Symboles de l\'objectif', 'p');
        $result->assertSee('A.1.1', 'p');
        $result->assertSee('Taxonomie de l\'objectif', 'p');
        $result->assertSee('4', 'p');
        $result->assertSee('Nom de l\'objectif', 'p');
        $result->assertSee('Enregistrer les besoins et discuter les solutions possibles, s’entretenir avec le client/supérieur sur les restrictions des exigences', 'p');
    }

    /**
     * Asserts that the view_objective page redirects to the list_course_plan view when a non existing objective id is given
     */
    public function testview_objectiveWithNonExistingObjectiveId()
    {
        // Execute view_objective method of CoursePlan class
        $result = $this->controller(CoursePlan::class)
        ->execute('view_objective', 999999);

        // Assertions
        $response = $result->response();
        $this->assertInstanceOf(\CodeIgniter\HTTP\RedirectResponse::class, $response);
        $this->assertEmpty($response->getBody());
        $result->assertOK();
        $result->assertHeader('Content-Type', 'text/html; charset=UTF-8');
        $result->assertRedirectTo(base_url('plafor/courseplan/list_course_plan'));
    }

    /**
     * Asserts that the save_course_plan page is loaded correctly when an administrator session user access is set with a posted course plan id
     */
    /*
    public function testsave_course_planPostedWithAdministratorSessionUserAccessWithPostedCoursePlanId()
    {
        // Initialize session 
        $_SESSION['user_access'] = config('\User\Config\UserConfig')->access_lvl_admin;

        // Prepare the POST request
        $_SERVER['REQUEST_METHOD'] = 'post';
        $_POST['coursePlanId'] = 1;
        $_REQUEST['coursePlanId'] = 1;

        // Execute save_course_plan method of CoursePlan class
        $result = $this->controller(CoursePlan::class)
        ->execute('save_course_plan');

        // Assertions
        $response = $result->response();
        $this->assertInstanceOf(\CodeIgniter\HTTP\Response::class, $response);
        $this->assertNotEmpty($response->getBody());
        $result->assertOK();
        $result->assertSee('Modifier le plan de formation', 'h1');
        $result->assertSeeElement('#course_plan_form');
        $result->assertSee('Numéro du plan de formation', 'label');
        $result->assertSeeInField('formation_number', '88601');
        $result->assertSee('Nom du plan de formation', 'label');
        $result->assertSeeInField('official_name', ' Informaticien/-ne CFC Développement d\'applications');
        $result->assertSee('Date de création du plan de formation', 'label');
        $result->assertSeeInField('date_begin', '2014-08-01');
        $result->assertSeeInField('coursePlanId', '1');
        $result->assertSeeLink('Annuler');
        $result->assertSeeInField('save', 'Enregistrer');

        // Reset $_POST and $_REQUEST variables
        $_POST = array();
        $_REQUEST = array(); 
    }
    */
}