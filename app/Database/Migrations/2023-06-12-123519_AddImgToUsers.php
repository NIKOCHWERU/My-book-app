<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddImgToUsers extends Migration
{
    public function up()
    {
        $this->forge->addColumn('users', [
            'img' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
        ]);
    }

    public function down()
    {
        //
    }
}
