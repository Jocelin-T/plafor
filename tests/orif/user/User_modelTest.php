<?php
/**
 * Unit test User_modelTest 
 *
 * @author      Orif (CaLa)
 * @link        https://github.com/OrifInformatique
 * @copyright   Copyright (c), Orif (https://www.orif.ch)
 */
namespace User\Models;

use CodeIgniter\Test\CIUnitTestCase;

class User_modelTest extends CIUnitTestCase
{
    /**
     * Asserts that getInstance method of User_model returns an instance of User_model
     */
    public function testgetUser_modelInstance()
    {
        $userModel = User_model::getInstance();
        $this->assertTrue($userModel instanceof User_model);
    }

    /**
     * Asserts that getInstance method of User_model does not return an instance of User_type_model
     */
    public function testgetUser_type_modelInstance()
    {
        $userModel = User_model::getInstance();
        $this->assertFalse($userModel instanceof User_type_model);
    }

    /**
     * Tests that the check_password_name correctly checks the user password using the username
     */
    public function testcheck_password_name()
    {
        // Insert user into database
        $userType = 3;
        $username = 'ApprenticeUnitTest';
        $userPassword = 'ApprenticeUnitTestPassword';
        $userWrongPassword = 'ApprenticeUnitTestWrongPassword';
        
        $user = array(
            'fk_user_type' => $userType,
            'username' => $username,
            'password' => password_hash($userPassword, config('\User\Config\UserConfig')->password_hash_algorithm),
        );

        User_model::getInstance()->insert($user);

        // Check user password using username (Assertion)
        $checkPasswordName = User_model::check_password_name($username, $userPassword);
        $this->assertTrue($checkPasswordName);

        // Check wrong user password using username (Assertion)
        $checkPasswordName = User_model::check_password_name($username, $userWrongPassword);
        $this->assertFalse($checkPasswordName);

        // Delete inserted user after assertions
        $userDb=User_model::getInstance()->where("username", $username)->first();
        User_model::getInstance()->delete($userDb['id'], TRUE);
    }

    /**
     * Tests that the check_password_email correctly checks the user password using the user email
     */
    public function testcheck_password_email()
    {
        // Insert user into database
        $userType = 3;
        $username = 'ApprenticeUnitTest';
        $userEmail = 'apprenticeunittest@unittest.com';
        $userPassword = 'ApprenticeUnitTestPassword';
        $userWrongPassword = 'ApprenticeUnitTestWrongPassword';
        
        $user = array(
            'fk_user_type' => $userType,
            'username' => $username,
            'email' => $userEmail,
            'password' => password_hash($userPassword, config('\User\Config\UserConfig')->password_hash_algorithm),
        );

        User_model::getInstance()->insert($user);

        // Check user password using username (Assertion)
        $checkPasswordEmail = User_model::check_password_email($userEmail, $userPassword);
        $this->assertTrue($checkPasswordEmail);

        // Check wrong user password using username (Assertion)
        $checkPasswordEmail = User_model::check_password_email($userEmail, $userWrongPassword);
        $this->assertFalse($checkPasswordEmail);

        // Delete inserted user after assertions
        $userDb=User_model::getInstance()->where("email", $userEmail)->first();
        User_model::getInstance()->delete($userDb['id'], TRUE);
    }
}