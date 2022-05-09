<?php
namespace Plafor\Database\Migrations\mig2021;
use CodeIgniter\Database\Migration;

class AddObjective extends Migration {

    public function up() {

        $this->db->disableForeignKeyChecks();
        $this->forge->addField([
            'id' => [
                'type' => 'int',
                'contraint' => '11',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'fk_operational_competence' => [
                'type' => 'int',
                'null'=>true,
                'unsigned' => true,
            ],
            'symbol' => [
                'type' => 'varchar',
                'constraint' => '10',
            ],
            'taxonomy' => [
                'type' => 'int',
                'constraint' => '5',
            ],
            'name' => [
                'type' => 'varchar',
                'constraint' => '350',
            ],
            'archive timestamp null',
        ]);

        $this->forge->addKey('id', true, true);
        $this->forge->addForeignKey('fk_operational_competence','operational_competence','id');
        $this->forge->createTable('objective', TRUE);
        try {
        }catch (\Exception $e){
            echo $e->getMessage();
        }
    }

    public function down() {
        $this->forge->dropTable('objective', TRUE);
    }
}
