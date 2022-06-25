    <!-------- 
      SIDEBAR 
    --------->
    <aside class="left-sidebar" id="adm-sidebar">
            <div class="d-flex no-block nav-text-box align-items-center">
               <span><a href="dashboard.php"><img src="img/logo-blanco.png" width="150"></a></span>
               <a class="nav-lock waves-effect waves-dark ml-auto hidden-md-down" href="javascript:void(0)"><i class="fal fa-toggle-on"></i></a>
               <a class="nav-toggler waves-effect waves-dark ml-auto hidden-sm-up" href="javascript:void(0)"><i class="fal fa-times"></i></a>
            </div>
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
               <!-- Sidebar navigation-->
               <nav class="sidebar-nav">
                  <ul id="sidebarnav" class="trend-sidebar">

                    <li class="text-center"><img src="<?php echo $StoreImage; ?>" class="img-comercio" > <h3 class="text-white"><?php echo $nameStore;?> </h3> </li>
                    <li class="nav-small-cap m-t-10 m-b-10"></li>
                    <li><a class="waves-effect waves-dark" aria-expanded="false" href="page_comercio_productos.php"><i class="fal fa-shopping-cart"></i>  &nbsp;&nbsp;Listar productos</a></li>
                    <li><a class="waves-effect waves-dark" aria-expanded="false" href="page_comercio_agregar_producto.php"><i class="fal fa-shopping-cart"></i>  &nbsp;&nbsp;Agregar producto</a></li>
                    <li><a class="waves-effect waves-dark" aria-expanded="false" href="page_comercio_informacion.php">   <i class="fal fa-store-alt"></i>&nbsp;&nbsp;Información</a></li>
                  </ul>
                </nav>
               <!-- Fin Sidebar navigation -->
            </div>
            <!-- Fin Sidebar scroll-->
</aside>
    <!-------- 
      /SIDEBAR 
    --------->