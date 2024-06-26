<?php
/**
 * Fichier de migration créant la table trainer_apprentice
 *
 * @author      Orif (ViDi, HeMa)
 * @link        https://github.com/OrifInformatique
 * @copyright   Copyright (c), Orif (https://www.orif.ch)
 */
namespace Plafor\Database\Migrations;
use CodeIgniter\Database\Migration;
class AddTrainerApprentice extends Migration{
    public function up()
    {


        $this->db->disableForeignKeyChecks();
        $this->forge->addField([
            'id'=>[
                'type'=>'int',
                'constraint'=>'11',
                'auto_increment'=>true,
            ],
            'fk_trainer'=>[
                'type'=>'int',
                'constraint'=>'11',
                'null'=>true,
                'unsigned' => true,
            ],
            'fk_apprentice'=>[
                'type'=>'int',
                'constraint'=>'11',
                'null'=>true,
                'unsigned' => true,
            ],
        ]);
        $this->forge->addKey('id',true,true);
        $this->forge->addForeignKey('fk_trainer','user','id');
        $this->forge->addForeignKey('fk_apprentice','user','id');

        $this->forge->createTable('trainer_apprentice');
        $seeder = \Config\Database::seeder();
        $seeder->call('\Plafor\Database\Seeds\addTrainerApprenticeDatas');
    }
    public function down()
    {
        $this->forge->dropTable('trainer_apprentice');
    }
}