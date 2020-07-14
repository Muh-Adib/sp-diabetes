<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class LogDiagnosis extends Migration
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
			'id_gejala' => [
				'type' => 'INT',			
			],
			'cf' => [
				'type' => 'FLOAT',
				'null' => FALSE	
						
			],'created_at' => [
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
		$this->forge->createTable('LogDiagnosis');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
		$this->forge->dropTable('LogDiagnosis');
	}
}
