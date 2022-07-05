<!-------- 
  SIDEBAR 
--------->
<aside class="left-sidebar" id="adm-sidebar">
  <div class="scroll-sidebar">
    <nav class="sidebar-nav">
      <div class="navbar-wrapper text-white">
        <div class="navbar-toggle d-inline ml-16">
          <a class="d-inline-block d-lg-none nav-link nav-toggler waves-effect waves-light font-16 text-white" href="javascript:void(0)"><i class="fal fa-bars"></i></a>
          <a class="nav-lock waves-effect waves-dark ml-auto hidden-md-down font-20 text-white" href="javascript:void(0)"><i class="far fa-list-ul"></i></a>
        </div>
        <a class="navbar-brand" href="javascript:void(0)"><img src="assets/img/logo-vibra-sana-blanco.png" class="ml-12" width="80%" id="logo-topbar"></a>
      </div>

      <ul id="sidebarnav" class="trend-sidebar mt-20">

        <?php if ($id_perfil == 1) { ?>

          <li class="titulo-side">
            <h4>Historia Clínica</h4>
          </li>
          <li class="nav-small-cap m-t-10 m-b-10"></li>
          <li><a class="waves-effect waves-dark" aria-expanded="false" href="page-agregar-paciente.php"> <i class="fal fa-shopping-bag"></i> <span class="text-side">Nueva Historia</span> </a></li>
          <li><a class="waves-effect waves-dark" aria-expanded="false" href="page-historias.php"> <i class="fal fa-clipboard-list-check"></i><span class="text-side">Base de datos</span> </a></li>
          <li><a class="waves-effect waves-dark" aria-expanded="false" href="page-historias-registradas.php"> <i class="fal fa-clipboard-list"></i><span class="text-side">Listado de historias</span> </a></li>
          <li class="nav-small-cap m-t-10 m-b-10"></li>
          <li class="titulo-side">
            <h4>Recetas</h4>
          </li>
          <li class="nav-small-cap m-t-10 m-b-10"></li>
          <li><a class="waves-effect waves-dark" aria-expanded="false" href="page-agregar-receta.php"> <i class="fal fa-shopping-bag"></i> <span class="text-side">Nueva Receta</span> </a></li>
          <li><a class="waves-effect waves-dark" aria-expanded="false" href="page-recetas.php"> <i class="fal fa-clipboard-list"></i> <span class="text-side">Listado de Recetas</span> </a></li>

          <li class="nav-small-cap m-t-10 m-b-10"></li>
          <li class="titulo-side">
            <h4>Pre-Registro</h4>
          </li>
          <li class="nav-small-cap m-t-10 m-b-10"></li>
          <li><a class="waves-effect waves-dark" aria-expanded="false" href="page-pacientes.php"> <i class="far fa-user"></i> <span class="text-side">Listado</span> </a></li>

          <li class="nav-small-cap m-t-10 m-b-10"></li>
          <li class="titulo-side">
            <h4>Extras</h4>
          </li>
          <li class="nav-small-cap m-t-10 m-b-10"></li>
          <li><a class="waves-effect waves-dark" aria-expanded="false" href="page-usuarios.php"> <i class="far fa-user"></i> <span class="text-side">Usuarios</span> </a></li>
          <li><a class="waves-effect waves-dark" aria-expanded="false" href="page-citas.php"> <i class="fal fa-clipboard-list"></i><span class="text-side">Citas</span> </a></li>
          <li><a class="waves-effect waves-dark" aria-expanded="false" href="page-estadisticas.php"> <i class="fal fa-clipboard-list"></i><span class="text-side">Estadisticas</span> </a></li>

        <?php } else { ?>
          <li class="nav-small-cap m-t-10 m-b-10"></li>
          <li class="titulo-side">
            <h4>Ajustes</h4>
          </li>
          <li class="nav-small-cap m-t-10 m-b-10"></li>
          <li><a class="waves-effect waves-dark" aria-expanded="false" href="page-edit-usuario.php"> <i class="far fa-user"></i> <span class="text-side">Perfil</span> </a></li>
          <li><a class="waves-effect waves-dark" aria-expanded="false" href="page-citas.php"> <i class="fal fa-clipboard-list"></i><span class="text-side">Citas</span> </a></li>
          <li><a class="waves-effect waves-dark" aria-expanded="false" href="page-estadisticas.php"> <i class="fal fa-clipboard-list"></i><span class="text-side">Estadisticas</span> </a></li>
          <li class="nav-small-cap m-t-10 m-b-10"></li>
          <li class="titulo-side">
            <h4>Historia Clínica</h4>
          </li>
          <li class="nav-small-cap m-t-10 m-b-10"></li>
          <li><a class="waves-effect waves-dark" aria-expanded="false" href="page-agregar-paciente.php"> <i class="fal fa-shopping-bag"></i> <span class="text-side">Nueva Historia</span> </a></li>
          <li><a class="waves-effect waves-dark" aria-expanded="false" href="page-historias.php"> <i class="fal fa-clipboard-list-check"></i><span class="text-side">Base de datos</span> </a></li>
          <li><a class="waves-effect waves-dark" aria-expanded="false" href="page-historias-registradas.php"> <i class="fal fa-clipboard-list"></i><span class="text-side">Listado de historias</span> </a></li>
          <li class="nav-small-cap m-t-10 m-b-10"></li>
          <li class="titulo-side">
            <h4>Recetas</h4>
          </li>
          <li class="nav-small-cap m-t-10 m-b-10"></li>
          <li><a class="waves-effect waves-dark" aria-expanded="false" href="page-agregar-receta.php"> <i class="fal fa-shopping-bag"></i> <span class="text-side">Nueva Receta</span> </a></li>
          <li><a class="waves-effect waves-dark" aria-expanded="false" href="page-recetas.php"> <i class="fal fa-clipboard-list"></i> <span class="text-side">Listado de Recetas</span> </a></li>


        <?php } ?>
      </ul>
    </nav>
  </div>
</aside>
<!-------- 
  /SIDEBAR 
--------->
<style>
  #menu-movil {
    box-shadow: #0000004d 0px 0px 10px;
    width: 50px;
    height: 50px;
    background: white;
    padding: 15px 15px;
    font-size: 23px;
    border-radius: 50%;
    position: fixed;
    bottom: 24px;
    left: 50%;
    transform: translate(-50%, 10px);
    right: 50%;
    z-index: 999;
  }
</style>
<a href="#" id="menu-movil" class="d-block d-lg-none"><i class="far fa-bars"></i></a>

<script>
  $('#menu-movil').on('click', function() {
    Swal.fire({

      title: '<strong>Opciones</strong>',
      html: '<ul class="text-left"><li>' +
        '<h4 class="font-weight-bold font-20">Historia Clínica</h4>' +
        '</li>' +
        '<li></li>' +
        '<li><a class="text-light" aria-expanded="false" href="page-agregar-paciente.php">Nueva Historia</a></li>' +
        '<li><a class="text-light" aria-expanded="false" href="page-historias.php">Listado de  Historias</a></li>' +
        '<li></li>' +
        '<li>' +
        '<h4 class="font-weight-bold font-20">Recetas</h4>' +
        '</li>' +
        '<li"></li>' +
        '<li><a  class="text-light" aria-expanded="false" href="page-agregar-receta.php">Nueva Receta</a></li>' +
        '<li><a  class="text-light" aria-expanded="false" href="page-recetas.php">Listado de Recetas</a></li>' +
        '<li>' +
        '<h4 class="font-weight-bold font-20">Pacientes Externos</h4>' +
        '</li>' +
        '<li></li>' +
        '<li><a class="text-light" aria-expanded="false" href="page-pacientes.php">Listado de pacientes</a></li>' +
        '</ul>',
      showCloseButton: true,
    });
  });
</script>