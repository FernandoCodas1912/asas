<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FormaCobro_model extends CI_Model {
	//estos son metodos q tienen q ver con bd
	
	//este metodo es para mostrar todos los campos
	public function getFormasCobros(){
		$this->db->where("estado", "1");
		$resultados= $this->db->get("formacobro");//nombre tabla
		return $resultados->result();
	}
	
	//esta es la parte para guardar en la bd
	public function save($data)
	{
		return $this->db->insert("formapago", $data);
	}
	
	//esto es una funcion o metodo para mostrar 1 empleado por id
	public function getFormapago($id){
		$this->db->where("id_formapago",$id);
		$resultado= $this->db->get("formapago");
		return $resultado->row();
	}
	//esto es para actualizar los empleados
	public function update($id, $data){
		$this->db->where("id_formapago", $id);
		return $this->db->update("formapago", $data);

	}
}