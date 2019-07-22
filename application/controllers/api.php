<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

	public function index(){
		$data["titulo"] = ".:: GRID - Levi A. Hurtado ::.";
		$this->load->view("inicio", $data);
	}

	public function registro(){

		$nombre = $this->input->post("nombre");
		$edad   = $this->input->post("edad");
		$rut    = $this->input->post("rut");
		$fecha  = ($this->input->post("fecha") == "") ? "N/A" : $this->input->post("fecha");
		
		if($this->modelo->guardar_persona($nombre, $edad, $rut, $fecha)){

			$total = $this->modelo->total_registros();

			$data = [ 'error' => false, 
					  'total' => $total
					];
			echo json_encode($data);
		}else{
			$data[] = [ 'error' => true ];
			echo json_encode($data);
		}
	}

	public function cantidad(){
		echo $this->modelo->total_registros();
	}


	public function truncate(){
		echo ($this->modelo->borrar_data() ? 1 : 2);
	}

}