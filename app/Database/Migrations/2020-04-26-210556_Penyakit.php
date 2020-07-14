<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Penyakit extends Migration
{
	public function up()
	{
		//
		$this->forge->addField([
			'id' => [
				'type' => 'INT',
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'kode' => [
				'type' => 'VARCHAR',
				'constraint' => 128,
				'null' => FALSE,
			],
			'nama' => [
				'type' => 'VARCHAR',
				'constraint' => 128,
				'null' => FALSE,
			],
			'penyebab' => [
				'type' => 'TEXT',
				'null' => TRUE,
			],
			'solusi' => [
				'type' => 'TEXT',
				'null' => TRUE
			],
			'slug' => [
				'type' => 'VARCHAR',
				'constraint' => 128,
				'null' => TRUE
			],
			'created_at' => [
				'type' => 'datetime',
				'null' => TRUE
			],
			'updated_at' => [
				'type' => 'datetime',
				'null' => TRUE
			],
			'deleted_at' => [
				'type' => 'datetime',
				'null' => TRUE
			]
		]);

		$this->forge->addKey('id', TRUE);
		$this->forge->createTable('penyakit');

		
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
		$this->forge->dropTable('penyakit');
	}
}
