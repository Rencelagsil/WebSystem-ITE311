<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMaterialsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => ['type'=>'INT','unsigned'=>true,'auto_increment'=>true],
            'course_id'   => ['type'=>'INT','unsigned'=>true],
            'file_name'   => ['type'=>'VARCHAR','constraint'=>'255'],
            'file_path'   => ['type'=>'VARCHAR','constraint'=>'255'],
            'created_at'  => ['type'=>'DATETIME','null'=>true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('course_id','courses','id','CASCADE','CASCADE');
        $this->forge->createTable('materials');
    }

    public function down()
    {
        $this->forge->dropTable('materials');
    }
}
