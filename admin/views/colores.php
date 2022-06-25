<div class="ed-container full">
    <div class="ed-item xl-20 l-20"></div>
        <div class="ed-item xl-75 l-75" id="panel-dashboard">
            
<div id="view-colores" class="view-tab">
  <h2>Administrar Colores</h2><br>

<button class="bt-modal" data-modal="ctn-modal-add-color">
  <i class="fas fa-plus"></i> NUEVO COLOR
</button>  

  <table id="td_colores" class="table-info" style="width: 100% !important;">
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
AGREGAR COLOR
----------------------------->

<div class="cnt-modal" id="ctn-modal-add-color">
<div class="body-modal" id="cnt-add-color" style="">
<h2>AGREGAR COLOR</h2>
<h4>Ingrese el nombre del color:</h4><br>
<input type="text" name="nombre-color" id="name_new_color" class="oc" placeholder="NOMBRE DEL COLOR"> <br>
<input type="text" name="codigo-color" id="code_new_color" class="oc" placeholder="#CODIGO DE COLOR"> <br>
<input type="hidden" name="codigo_color" id="-code_color">
<button id="add-color" class="btn-confirm">Agregar</button>

<button class="close-tab btn-cancel"  data-href="#view-colores">Cancelar</button>
</div>
</div>


<!----------------------------
MODIFICAR COLOR
----------------------------->
<div class="cnt-modal" id="ctn-modal-edit-color">
<div class="body-modal" id="cnt-edit-color" style="">
<h2>Editar Color</h2>
<h4>Ingrese un nuevo nombre de color:</h4><br>
<form id="frm_edit_color">
<input type="text" name="nombre_color" id="name_color"> <br>
<input type="hidden" name="accion" value="EditarColor">
<input type="hidden" name="codigo_color" id="code_color">
</form>
<button id="upd-color" class="btn-confirm">Actualizar</button>

<button class="close-tab btn-cancel" data-href="#view-colores" id="cancel-upd-color">Cancelar</button>


</div>
</div>

