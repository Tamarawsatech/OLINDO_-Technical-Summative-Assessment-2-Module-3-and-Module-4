<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPasswordAndArchiveColumns extends Migration
{
    public function up()
    {
        if (! $this->db->fieldExists('password', 'users')) {
            $this->forge->addColumn('users', [
                'password' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 255,
                    'null'       => true,
                ],
            ]);
        }

        if (! $this->db->fieldExists('is_archived', 'tasks')) {
            $this->forge->addColumn('tasks', [
                'is_archived' => [
                    'type'       => 'TINYINT',
                    'constraint' => 1,
                    'unsigned'   => true,
                    'default'    => 0,
                    'null'       => false,
                ],
            ]);
        }
    }

    public function down()
    {
        if ($this->db->fieldExists('password', 'users')) {
            $this->forge->dropColumn('users', 'password');
        }

        if ($this->db->fieldExists('is_archived', 'tasks')) {
            $this->forge->dropColumn('tasks', 'is_archived');
        }
    }
}
