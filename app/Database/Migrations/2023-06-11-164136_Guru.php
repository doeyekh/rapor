<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Guru extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_guru' => [
                'type'           => 'VARCHAR',
                'constraint'     => 36,
                'unsigned'       => FALSE,
                'auto_increment' => FALSE,
            ],
            'nama_guru' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'gelar_depan' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
            ],
            'gelar_belakang' => [
                'type'  => 'VARCHAR',
                'constraint'    => '20'
            ],
            'jk' => [
                'type'  => 'ENUM',
                'constraint'    => ['L','P']
            ],
            'tmp_lahir' => [
                'type'  => 'VARCHAR',
                'constraint'    => '50'
            ],
            'tgl_lahir' => [
                'type'  => 'VARCHAR',
                'constraint'    => '50'
            ],
            'alamat' => [
                'type'  => 'VARCHAR',
                'constraint'    => '50'
            ],
            'rt' => [
                'type'  => 'VARCHAR',
                'constraint'    => '3'
            ],
            'rw' => [
                'type'  => 'VARCHAR',
                'constraint'    => '3'
            ],
            'desa' => [
                'type'  => 'VARCHAR',
                'constraint'    => '50'
            ],
            'kecamatan' => [
                'type'  => 'VARCHAR',
                'constraint'    => '50'
            ],
            'kabupaten' => [
                'type'  => 'VARCHAR',
                'constraint'    => '50'
            ],
            'provinsi' => [
                'type'  => 'VARCHAR',
                'constraint'    => '50'
            ],
            'email' => [
                'type'  => 'VARCHAR',
                'constraint'    => '100'
            ],
            'password' => [
                'type'  => 'VARCHAR',
                'constraint'    => '300'
            ],
            'idinduk' => [
                'type'  => 'ENUM',
                'constraint'    => ['NUKS','NUPTK','NIP']
            ],
            'noinduk' => [
                'type'  => 'VARCHAR',
                'constraint'    => '50'
            ],
            'foto' => [
                'type'  => 'VARCHAR',
                'constraint'    => '50'
            ],
            'is_active' => [
                'type'  => 'ENUM',
                'constraint'    => ['1','0']
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
        $this->forge->addKey('id_guru', true);
        $this->forge->createTable('guru');
    }
    
    public function down()
    {
        $this->forge->dropTable('guru');
        //
    }
}
