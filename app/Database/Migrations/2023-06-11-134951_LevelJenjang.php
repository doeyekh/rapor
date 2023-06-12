<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class LevelJenjang extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_jenjang' => [
                'type'           => 'VARCHAR',
                'constraint'     => 36,
                'unsigned'       => FALSE,
                'auto_increment' => FALSE,
            ],
            'nama_jenjang' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'total_smt' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
            ],
            'total_level' => [
                'type'  => 'VARCHAR',
                'constraint'    => '2'
            ],
            'kelas_awal' => [
                'type'  => 'VARCHAR',
                'constraint'    => '2'
            ],
            'kelas_akhir' => [
                'type'  => 'VARCHAR',
                'constraint'    => '2'
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_jenjang', true);
        $this->forge->createTable('jenjang');
    }

    public function down()
    {
        $this->forge->dropTable('jenjang');
    }
}
