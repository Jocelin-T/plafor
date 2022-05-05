<?php


namespace User\Database\Migrations;


class AddUser extends \CodeIgniter\Database\Migration
{

    /**
     * @inheritDoc
     */
    public function up()
    {
        $this->forge->addField([
            'id'=>[
                'type'              => 'INT',
                'unsigned'          => true,
                'auto_increment'    => true,
            ],
            'fk_user_type'=>[
                'type'              => 'INT',
                'unsigned'          => true,
                'null'              => false,
            ],
            'username'=>[
                'type'              => 'VARCHAR',
                'constraint'        => '45',
                'unique'            => true,
            ],
            'password'=>[
                'type'              => 'VARCHAR',
                'constraint'        => '255',
            ],
            'email'=>[
                'type'              => 'VARCHAR',
                'constraint'        => '100',
                'null'              => true,
                'default'           => null,
            ],
            'archive TIMESTAMP NULL',

            'date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP',

        ]);
        $this->forge->addKey('id',true,true);
        $this->forge->addForeignKey('fk_user_type','user_type','id');
        $this->forge->createTable('user',true);
        $seeder=\Config\Database::seeder();
        if (ENVIRONMENT === 'testing') $seeder->setSilent(TRUE);
        //for plafor module
        //$seeder->call('\User\Database\Seeds\AddUserDatas');
        // only for application
        $seeder->call('\Plafor\Database\Seeds\addUserDatas');
    }

    /**
     * @inheritDoc
     */
    public function down()
    {
        $this->forge->dropTable('user', TRUE);
    }
}
