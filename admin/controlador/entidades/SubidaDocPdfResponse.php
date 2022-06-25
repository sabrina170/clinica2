<?php
class SubidaDocPdfResponse{
    var $codigo;
	var $descripcion = "";
	var $ruta= "";
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
	function addRuta($ruta) {  
		if (!isset($this->ruta)){
		   $this->ruta = "";
		}
		$this->ruta = $ruta;
	}
}
?>