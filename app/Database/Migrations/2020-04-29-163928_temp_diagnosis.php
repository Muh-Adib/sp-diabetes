<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TempDiagnosis extends Migration
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
				'type' => 'VARCHAR',
				'constraint' => 128,
				'null' => FALSE				
			],
			'list_gejala' => [
				'type' => 'VARCHAR',
				'constraint' => 128,
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
		$this->forge->createTable('TempDiagnosis');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
		$this->forge->dropTable('TempDiagnosis');
	}
}
