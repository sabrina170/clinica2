<?php
class SubCategoriasListadoJSON{
	var $data;
	function addData($datos){  
		if (!isset($this->data)){
		   $this->data = array();
		}
		$this->data = $datos;
	 }
}
?>