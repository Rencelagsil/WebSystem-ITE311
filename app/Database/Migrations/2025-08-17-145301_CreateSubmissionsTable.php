<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSubmissionsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'        => ['type'=>'INT','unsigned'=>true,'auto_increment'=>true],
            'quiz_id'   => ['type'=>'INT','unsigned'=>true],
            'user_id'   => ['type'=>'INT','unsigned'=>true],
            'answer'    => ['type'=>'TEXT'],
            'score'     => ['type'=>'INT','null'=>true],
            'submitted_at' => ['type'=>'DATETIME','null'=>true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('quiz_id','quizzes','id','CASCADE','CASCADE');
        $this->forge->addForeignKey('user_id','users','id','CASCADE','CASCADE');
        $this->forge->createTable('submissions');
    }

    public function down()
    {
        $this->forge->dropTable('submissions');
    }
}
