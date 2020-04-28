<?php 
function getLoginRules(){
	return array(
			array(
				'field' => 'usuario',
				'label' => 'Nombre de Usuario',
				'rules' => 'required',
				'errors' => array(
					'required' => 'El %s es requerido.'
				),
			),
			array(
				'field' => 'contrasena',
				'label' => 'Contrasena',
				'rules' => 'required',
				'errors' => array(
					'required' => 'La %s es requerida.',
				)
			),
		);
}
 ?>
