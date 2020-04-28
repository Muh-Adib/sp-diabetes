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
			'id_penyakit' => [
				'type' => 'INT',			
			],
			'id_gejala' => [
				'type' => 'VARCHAR',
				'constraint' => 128,
				'null' => FALSE			
			],
			'cf' => [
				'type' => 'FLOAT',
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
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
