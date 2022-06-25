<?php
class CreateUpdateDeleteCategoriaResponse{
    var $codigo;
    var $descripcion = "";
    function addCodigo($codigo) {  
		if (!isset($this->codigo)){
		   $this->codigo = 0;
		}
		$this->codigo = $codigo;
	}
	function addDescripcion($descripcion) {  
		if (!isset($this->descripcion)){
		   $this->descripcion = "";
		}
		$this->descripcion = $descripcion;
	}
}
?>