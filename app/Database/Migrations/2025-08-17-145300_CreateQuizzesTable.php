<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateQuizzesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'        => ['type'=>'INT','unsigned'=>true,'auto_increment'=>true],
            'lesson_id' => ['type'=>'INT','unsigned'=>true],
            'question'  => ['type'=>'TEXT'],
            'answer'    => ['type'=>'VARCHAR','constraint'=>'255'],
            'created_at'=> ['type'=>'DATETIME','null'=>true],
            'updated_at'=> ['type'=>'DATETIME','null'=>true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('lesson_id','lessons','id','CASCADE','CASCADE');
        $this->forge->createTable('quizzes');
    }

    public function down()
    {
        $this->forge->dropTable('quizzes');
    }
}
