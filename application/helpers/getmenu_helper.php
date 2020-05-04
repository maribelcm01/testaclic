<?php 
function main_menu(){

	return array(
		/*array(
			'title' => 'Inicio',
			'url' => base_url(),
		),*/
		array(
			'title' => 'Encuestado',
			'url' => base_url('encuestado'),
		),
		array(
			'title' => 'Encuesta',
			'url' => base_url('encuesta'),
		),
		array(
			'title' => 'Reactivos',
			'url' => base_url('reactivo'),
		),
	);
}
?>