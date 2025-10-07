<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateEnrollmentsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'              => ['type'=>'INT','unsigned'=>true,'auto_increment'=>true],
            'user_id'         => ['type'=>'INT','unsigned'=>true],
            'course_id'       => ['type'=>'INT','unsigned'=>true],
            'enrollment_date' => ['type'=>'DATETIME','null'=>true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id','users','id','CASCADE','CASCADE');
        $this->forge->addForeignKey('course_id','courses','id','CASCADE','CASCADE');
        $this->forge->createTable('enrollments');
    }

    public function down()
    {
        $this->forge->dropTable('enrollments');
    }
}
