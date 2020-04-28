<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Migration_Create_User extends CI_Migration{
	public function up(){
		$this->dbforge->add_field(array(
			'idUsuario' => array(
				'type' => 'INT',
				'constraint' => 10,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'nombre' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',
			),
			'contrasena' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => TRUE,
			),
			'estatus' => array(
				'type' => 'TYNYINT',
				'constraint' => '1',
				'null' => TRUE,
			),
			'rango' => array(
				'type' => 'TYNYINT',
				'constraint' => '1',
				'null' => TRUE,
			),
		));
		$this->dbforge->addkey('idUsuario',TRUE);
		$this->dbforge->create_table('usuario');
	}

	public function down(){
		$this->dbforge->drop_table('usuario');
	}
}

 ?>