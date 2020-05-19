<?php 
function main_menu(){

	return array(
		/*array(
			'title' => 'Inicio',
			'url' => base_url(),
		),*/
		array(
			'title' => '<i class="fas fa-stream"></i> Encuestas',
			'url' => base_url('encuesta'),
		),
		array(
			'title' => '<i class="fas fa-address-card"></i>Encuestados',
			'url' => base_url('encuestado'),
		),
		array(
			'title' => '<i class="fas fa-list-ol"></i> Reactivos',
			'url' => base_url('reactivo'),
		),
		array(
			'title' => '<i class="fas fa-check-square"></i> Aplicaciones',
			'url' => base_url('aplicacion'),
		),
	);
}
?>