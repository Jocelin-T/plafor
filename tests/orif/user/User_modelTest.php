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
    public function testgetUser_modelInstance()
    {
        $userModel = User_model::getInstance();
        $this->assertTrue($userModel instanceof User_model);
    }

    public function testgetUser_type_modelInstance()
    {
        $userModel = User_model::getInstance();
        $this->assertFalse($userModel instanceof User_type_model);
    }
}