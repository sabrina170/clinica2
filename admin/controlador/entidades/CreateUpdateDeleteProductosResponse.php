<?php
class CreateUpdateDeleteProductosResponse{
    var $codigo;
	var $descripcion = "";
	var $idproducto;
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
	function addIdproducto($idproducto) {  
		if (!isset($this->idproducto)){
		   $this->idproducto = 0;
		}
		$this->idproducto = $idproducto;
	}
}
?>