<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Diagnosis extends Migration
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
			
			'nama' => [
				'type' => 'VARCHAR',
				'constraint' => 128,
				'null' => FALSE			
			],
			'ket' => [
				'type' => 'VARCHAR',
				'constraint' => 128,
				'null' => FALSE			
			],
			'gejala' => [
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
		$this->forge->createTable('Diagnosis');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
		$this->forge->dropTable('Diagnosis');
	}
}
