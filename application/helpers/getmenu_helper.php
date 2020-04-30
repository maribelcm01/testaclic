<?php 
function main_menu(){

	return array(
		array(
			'title' => 'Inicio',
			'url' => base_url(),
		),
		array(
			'title' => 'Registro',
			'url' => base_url('registro'),
		),
		array(
			'title' => 'Encuesta',
			'url' => base_url('encuesta'),
		),
	);
}
?>