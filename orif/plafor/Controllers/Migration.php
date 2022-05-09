<?php


namespace Plafor\Controllers;


use CodeIgniter\Config\Services;

class Migration extends \CodeIgniter\Controller
{
    public function index()
    {
        echo view("Plafor\migrationIndex");
    }

    public function init()
    {
        if ($this->request->getPost('password') === 'ys3vTFiR6gyGajz') {

            $file = fopen(WRITEPATH . 'appStatus.json', 'r+');
            $initDatas = fread($file, 100);

            if ((json_decode($initDatas, true))['initialized'] === false) {
                $this->response->setStatusCode('201')->send();
                $migrate = Services::migrations();
                $seeder = \Config\Database::seeder();
                $seeds = [
                    '\Plafor\Database\Seeds\addAcquisitionStatusDatas',
                    '\Plafor\Database\Seeds\addCompetenceDomainDatas',
                    '\Plafor\Database\Seeds\addCoursePlanDatas',
                    '\Plafor\Database\Seeds\addObjectiveDatas',
                    '\Plafor\Database\Seeds\addOperationalCompetencesDatas',
                    '\Plafor\Database\Seeds\addTrainerApprenticeDatas',
                    '\Plafor\Database\Seeds\addUserCoursesDatas',
                    '\Plafor\Database\Seeds\addUserDatas',
                    '\Plafor\Database\Seeds\addCompetenceDomain2021Datas',
                    '\Plafor\Database\Seeds\addCoursePlan2021Datas',
                    '\Plafor\Database\Seeds\addObjective2021Datas',
                    '\Plafor\Database\Seeds\addOperationalCompetences2021Datas',
                ];

                try {
                    $migrate->setNamespace('User');
                    $migrate->latest();
                    $migrate->setNamespace('Plafor');
                    $migrate->latest();

                    foreach ($seeds as $seed) {
                        $seeder->call($seed);
                    }
                } catch (\Exception $e) {
                    echo $e->getMessage();
                }
                fclose($file);
                fwrite(fopen(WRITEPATH . 'appStatus.json', 'w+'), json_encode(['initialized' => true]));
                unlink((new \ReflectionClass('\Plafor\Controllers\Migration'))->getFileName());
                unlink(ROOTPATH . 'orif/plafor/Views/migrationindex.php');
                return $this->response->setStatusCode(200);

            } else {
                return $this->response->setStatusCode('400');
            }
        } else {
            return $this->response->setStatusCode('401');
        }

    }
}






