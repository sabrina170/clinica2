<div class="ed-container full">
    <div class="ed-item xl-20 l-20"></div>
        <div class="ed-item xl-75 l-75" id="panel-dashboard">
            <div id="view-usuarios" class="view-tab">
  <h2>Administrar Usuarios</h2><br>
<button class="bt-modal" data-modal="ctn-modal-add-user"><i class="fas fa-plus"></i> AGREGAR USUARIO</button>  
<table id="td_usuarios" class="table-info" style="width: 100%;">
  <thead>
    <tr>
      <th>id</th>
      <th>Nombre</th>
      <th>Perfil</th>
      <th>Estado</th>
      <th>Acciones</th>
    </tr>
  </thead>
</table>
</div>
        </div>
    </div>


<div class="cnt-modal" id="ctn-modal-add-user">
<div class="body-modal" style="">
        <div id="view-add-usuarios">

<center><h2>Agregar Usuario </h2> </center>
<center><label class="error_info"></label></center>
  
<form id="frm_add_usu" class="data-grid-2 frm_object" enctype="multipart/form-data">
<center><label class="error"></label></center><br>
  
<article>

<i class="fas fa-code"></i>
  <input type="text" name="nombre_usuario" placeholder="Nombre" id="nom-usu" class="txt-frm ou"><br>

  <i class="fas fa-code"></i>
  <input type="password" name="pass_usuario" placeholder="Password" id="pass-usu" class="txt-frm ou"><br>
</article>

<article>
<i class="fas fa-code"></i>
  <select id="perfil_new_usu" class="perfiles" name="perfil_usuario"></select><br>
 <!--<input type="file" name="imagen_producto" id="upload_img-user">-->
  <!--<input type="hidden" name="codigo_usuario" id="-cod_usu" >-->
<input type="hidden" name="accion" value="AgregarUsuario">
</article>
<button class="close-tab btn-cancel" data-href="#view-productos">CANCELAR</button>
  <button id="add-usu" class="-edit-confirm">AGREGAR</button>
  
</form>

</div>
</div>
</div>


<!----------------------------
MODIFICAR SUBCATEGORIA 
----------------------------->
<div class="cnt-modal" id="ctn-modal-edit-usuario">
<div class="body-modal" style="">
        <div id="view-add-productos">

<center><h2>Modificar Usuario </h2> </center>
<center><label class="error_info"></label></center><br>
  
<form id="frm_edit_usu" class="data-grid-2 frm_object" enctype="multipart/form-data">
<center><label class="error"></label></center>
  
<article>

<label>Nombre de usuario</label><br>
<i class="fas fa-code"></i>
  <input type="text" name="nombre_usuario" placeholder="Nombre" id="-nom-usu" class="txt-frm op"><br>

<label>Activo:</label><br>
<i class="fas fa-code"></i>
  <select name="estado_usuario" placeholder="Estado" id="-estado-usu" class="txt-frm op">
      <option value="0">NO</option>
      <option value="1">SI</option>
  </select><br>
</article>

<article>

<label>Perfil de usuario:</label><br>
<i class="fas fa-code"></i>
  <select id="-perfil_usu" class="perfiles" name="perfil_usuario"></select><br>

  <input type="hidden" name="-codigo_usuario" id="-cod_usu" >
  <input type="hidden" name="accion" value="EditarUsuario">
</article>
<button class="close-tab btn-cancel" data-href="#view-productos">CANCELAR</button>
  <button id="edit-usu" class="-edit-confirm">MODIFICAR</button>
  
</form>
</div>
</div>
</div>

