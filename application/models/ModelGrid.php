<?php

class ModelGrid extends CI_Model {

	public function guardar_persona($nombre, $edad, $rut, $fecha){
		$data = array(
            'nombre' => $nombre,
            'edad'   => $edad,
            'rut'    => $rut,
            'fecha'  => $fecha
         );

		return $this->db->insert('persona', $data);
	}

	public function total_registros() {	
	  $this->db->from('persona');
	  return $num_rows = $this->db->count_all_results();
	}

	public function borrar_data(){		
		$truncate = "TRUNCATE TABLE persona";
		return $this->db->query($truncate);
	}
}

?>

