<?php
class TerceraCategoriasListadoJSON{
	var $data;
	function addData($datos){  
		if (!isset($this->data)){
		   $this->data = array();
		}
		$this->data = $datos;
	 }
}
?>