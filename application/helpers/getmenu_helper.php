<?php 
function main_menu(){

	return array(
		/*array(
			'title' => 'Inicio',
			'url' => base_url(),
		),*/
		array(
			'title' => 'Encuestas',
			'url' => base_url('encuesta'),
		),
		array(
			'title' => 'Encuestados',
			'url' => base_url('encuestado'),
		),
		array(
			'title' => 'Reactivos',
			'url' => base_url('reactivo'),
		),
		array(
			'title' => 'Aplicaciones',
			'url' => base_url('aplicacion'),
		),
	);
}
?>