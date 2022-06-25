<div class="ed-container full">
    <div class="ed-item xl-20 l-20"></div>
        <div class="ed-item xl-75 l-75" id="panel-dashboard">
            
<div id="view-tallas" class="view-tab">
  <h2>Administrar tallas</h2><br>

<button class="bt-modal" data-modal="ctn-modal-add-talla">
  <i class="fas fa-plus"></i> NUEVA TALLA
</button>  

  <table id="td_tallas" class="table-info" style="width: 100% !important;">
      <thead>
        <tr>
          <th>CODIGO</th>
          <th>NOMBRE</th>
          <th>ACCIONES</th>
        </tr>
      </thead>
  </table>
</div>
            
        </div>
    </div>

<!----------------------------
AGREGAR TAG
----------------------------->

<div class="cnt-modal" id="ctn-modal-add-talla">
<div class="body-modal" id="cnt-add-talla" style="">
<h2>Agregar Talla</h2>
<h4>Ingrese el nombre de la talla:</h4><br>
<input type="text" name="nombre-talla" id="name_new_talla" class="ot"> <br>

<button id="add-talla" class="btn-confirm">Agregar</button>

<button class="close-tab btn-cancel" data-href="#view-tallas">Cancelar</button>
</div>
</div>


<!----------------------------
MODIFICAR SUBCATEGORIA 
----------------------------->
<div class="cnt-modal" id="ctn-modal-edit-talla">
<div class="body-modal" id="cnt-edit-talla" style="">
<h2>Actualizar Talla</h2>
<h4>Ingrese un nuevo nombre de la talla:</h4><br>
<form id="frm_edit_talla">
<input type="text" name="nombre_talla" id="name_talla"> <br>
<input type="hidden" name="accion" value="EditarTalla">
<input type="hidden" name="codigo_talla" id="code_talla">
</form>
<button id="upd-talla" class="btn-confirm">Actualizar</button>

<button class="close-tab btn-cancel" data-href="#view-talla" id="cancel-upd-cat">Cancelar</button>


</div>
</div>

