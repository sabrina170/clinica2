<?php
class CategoriasListadoJSON{
	var $data;
	function addData($datos){  
		if (!isset($this->data)){
		   $this->data = array();
		}
		$this->data = $datos;
	 }
}
?>