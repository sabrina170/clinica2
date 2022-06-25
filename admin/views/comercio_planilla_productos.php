<?php
include("controlador/conexion.php");

$consulta = "SELECT * FROM tienda WHERE codigo_tienda = '#T73763474'";
$resultado = mysqli_query($cn, $consulta);

if (!$resultado) {
    echo "Fallo al realizar la consulta";
} else {
    while ($data = mysqli_fetch_assoc($resultado)) {
        $categorias_tienda = json_decode($data["categorias"], true);
    }
}

?>
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row m-t-20">
            <div class="col-lg-12 col-md-7 col-sm-12">
                <div class="card">
                    <div class="card-body p-44">
                        <div id="panel-dashboard">
                            <form id="frm_add_producto" class="data-grid-3 frm_object" enctype="multipart/form-data">
                                <h2 class="m-0">Agregar productos por planilla
                                    <button id="add-planilla-producto" class="btn btn-success btn-guardar float-right btn-confirm-2"><i class="fal fa-save"></i> Guardar planilla de productos</button></h2>
                                <label class="error_info m-0"></label><br>
                                <hr>
                                <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <!--<th scope="col">Imagen</th>-->
                                            <th scope="col">Código SKU</th>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Categoría</th>
                                            <th scope="col">Subcategoría</th>
                                            <th scope="col">Estado</th>
                                            <th scope="col">Descripción corta</th>
                                            <th scope="col">Precio unitario</th>
                                            <th scope="col">Precio oferta</th>
                                            <th scope="col">Stock disponible</th>
                                            <th scope="col">Producto destacado</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="item_pr">
                                            <td>
                                                <input type="text" name="sku_producto" placeholder="Código SKU" id="sku-prod" class="form-control txt-frm ob">
                                            </td>
                                            <td>
                                                <input type="text" name="nombre_producto" placeholder="Nombre del producto" id="nom-prod" class="form-control txt-frm ob"><br>
                                            </td>
                                            <td>
                                                <select name="categoria_producto" id="cate-prod" class="form-control ob categoria_producto">
                                                    <option data-ide="" selected disabled> Elija una categoria</option>
                                                    <?php
                                                    foreach ($categorias_tienda['data'] as $key => $value) {
                                                        echo "<option data-ide=" . $value["id_categoria"] . ">" . $value["nombre_categoria"] . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                            <td>
                                                <select name="subcategoria_producto" id="subcate-prod" class="form-control ob subcategoria_producto">
                                                    <option selected disabled> Elija una subcategoria</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select name="promocion_producto" id="prom-prod" class="form-control ob">
                                                    <option value="ninguno" selected>Ninguno</option>
                                                    <option value="oferta">Oferta</option>
                                                    <option value="nuevo">Nuevo</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input name="desc_producto" placeholder="Descripción corta" id="desc-prod" class="form-control txt-frm ob" style="width:100%;">
                                            </td>
                                            <td>
                                                <input type="number" name="precio_unitario_producto" placeholder="Precio unitario" id="preu-prod" class="form-control txt-frm ob" value="0"><br>
                                            </td>
                                            <td>
                                                <input type="number" name="precio_oferta_producto" placeholder="Precio de oferta" id="prem-prod" class="form-control txt-frm ob" value="0"><br>
                                            </td>
                                            <td>
                                                <input type="number" name="stock_producto" placeholder="Stock" id="stock-prod" class="form-control txt-frm ob" value="1"><br>
                                            </td>
                                            <td>
                                                <select name="destacado_producto" id="dest-prod" class="form-control ob">

                                                    <option value="1">Si</option>
                                                    <option value="2" selected>No</option>
                                                </select>
                                            </td>
                                            <td><button class="btn btn-danger delete-row-prod"><i class="far fa-trash-alt"></i></button></td>
                                        </tr>

                                        <tr class="item_pr">
                                            <td>
                                                <input type="text" name="sku_producto" placeholder="Código SKU" id="sku-prod" class="form-control txt-frm ob">
                                            </td>
                                            <td>
                                                <input type="text" name="nombre_producto" placeholder="Nombre del producto" id="nom-prod" class="form-control txt-frm ob"><br>
                                            </td>
                                            <td>
                                                <select name="categoria_producto" id="cate-prod" class="form-control ob categoria_producto">
                                                    <option data-ide="" selected disabled> Elija una categoria</option>
                                                    <?php
                                                    foreach ($categorias_tienda['data'] as $key => $value) {
                                                        echo "<option data-ide=" . $value["id_categoria"] . ">" . $value["nombre_categoria"] . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                            <td>
                                                <select name="subcategoria_producto" id="subcate-prod" class="form-control ob subcategoria_producto">
                                                    <option selected disabled> Elija una subcategoria</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select name="promocion_producto" id="prom-prod" class="form-control ob">
                                                    <option value="ninguno" selected>Ninguno</option>
                                                    <option value="oferta">Oferta</option>
                                                    <option value="nuevo">Nuevo</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input name="desc_producto" placeholder="Descripción corta" id="desc-prod" class="form-control txt-frm ob" style="width:100%;">
                                            </td>
                                            <td>
                                                <input type="number" name="precio_unitario_producto" placeholder="Precio unitario" id="preu-prod" class="form-control txt-frm ob" value="0"><br>
                                            </td>
                                            <td>
                                                <input type="number" name="precio_oferta_producto" placeholder="Precio de oferta" id="prem-prod" class="form-control txt-frm ob" value="0"><br>
                                            </td>
                                            <td>
                                                <input type="number" name="stock_producto" placeholder="Stock" id="stock-prod" class="form-control txt-frm ob" value="1"><br>
                                            </td>
                                            <td>
                                                <select name="destacado_producto" id="dest-prod" class="form-control ob">

                                                    <option value="1">Si</option>
                                                    <option value="2" selected>No</option>
                                                </select>
                                            </td>
                                            <td><button class="btn btn-danger delete-row-prod"><i class="far fa-trash-alt"></i></button></td>
                                        </tr>

                                        <tr class="item_pr">
                                            <td>
                                                <input type="text" name="sku_producto" placeholder="Código SKU" id="sku-prod" class="form-control txt-frm ob">
                                            </td>
                                            <td>
                                                <input type="text" name="nombre_producto" placeholder="Nombre del producto" id="nom-prod" class="form-control txt-frm ob"><br>
                                            </td>
                                            <td>
                                                <select name="categoria_producto" id="cate-prod" class="form-control ob categoria_producto">
                                                    <option data-ide="" selected disabled> Elija una categoria</option>
                                                    <?php
                                                    foreach ($categorias_tienda['data'] as $key => $value) {
                                                        echo "<option data-ide=" . $value["id_categoria"] . ">" . $value["nombre_categoria"] . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                            <td>
                                                <select name="subcategoria_producto" id="subcate-prod" class="form-control ob subcategoria_producto">
                                                    <option selected disabled> Elija una subcategoria</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select name="promocion_producto" id="prom-prod" class="form-control ob">
                                                    <option value="ninguno" selected>Ninguno</option>
                                                    <option value="oferta">Oferta</option>
                                                    <option value="nuevo">Nuevo</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input name="desc_producto" placeholder="Descripción corta" id="desc-prod" class="form-control txt-frm ob" style="width:100%;">
                                            </td>
                                            <td>
                                                <input type="number" name="precio_unitario_producto" placeholder="Precio unitario" id="preu-prod" class="form-control txt-frm ob" value="0"><br>
                                            </td>
                                            <td>
                                                <input type="number" name="precio_oferta_producto" placeholder="Precio de oferta" id="prem-prod" class="form-control txt-frm ob" value="0"><br>
                                            </td>
                                            <td>
                                                <input type="number" name="stock_producto" placeholder="Stock" id="stock-prod" class="form-control txt-frm ob" value="1"><br>
                                            </td>
                                            <td>
                                                <select name="destacado_producto" id="dest-prod" class="form-control ob">

                                                    <option value="1">Si</option>
                                                    <option value="2" selected>No</option>
                                                </select>
                                            </td>
                                            <td><button class="btn btn-danger delete-row-prod"><i class="far fa-trash-alt"></i></button></td>
                                        </tr>

                                        <tr class="item_pr">
                                            <td>
                                                <input type="text" name="sku_producto" placeholder="Código SKU" id="sku-prod" class="form-control txt-frm ob">
                                            </td>
                                            <td>
                                                <input type="text" name="nombre_producto" placeholder="Nombre del producto" id="nom-prod" class="form-control txt-frm ob"><br>
                                            </td>
                                            <td>
                                                <select name="categoria_producto" id="cate-prod" class="form-control ob categoria_producto">
                                                    <option data-ide="" selected disabled> Elija una categoria</option>
                                                    <?php
                                                    foreach ($categorias_tienda['data'] as $key => $value) {
                                                        echo "<option data-ide=" . $value["id_categoria"] . ">" . $value["nombre_categoria"] . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                            <td>
                                                <select name="subcategoria_producto" id="subcate-prod" class="form-control ob subcategoria_producto">
                                                    <option selected disabled> Elija una subcategoria</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select name="promocion_producto" id="prom-prod" class="form-control ob">
                                                    <option value="ninguno" selected>Ninguno</option>
                                                    <option value="oferta">Oferta</option>
                                                    <option value="nuevo">Nuevo</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input name="desc_producto" placeholder="Descripción corta" id="desc-prod" class="form-control txt-frm ob" style="width:100%;">
                                            </td>
                                            <td>
                                                <input type="number" name="precio_unitario_producto" placeholder="Precio unitario" id="preu-prod" class="form-control txt-frm ob" value="0"><br>
                                            </td>
                                            <td>
                                                <input type="number" name="precio_oferta_producto" placeholder="Precio de oferta" id="prem-prod" class="form-control txt-frm ob" value="0"><br>
                                            </td>
                                            <td>
                                                <input type="number" name="stock_producto" placeholder="Stock" id="stock-prod" class="form-control txt-frm ob" value="1"><br>
                                            </td>
                                            <td>
                                                <select name="destacado_producto" id="dest-prod" class="form-control ob">

                                                    <option value="1">Si</option>
                                                    <option value="2" selected>No</option>
                                                </select>
                                            </td>
                                            <td><button class="btn btn-danger delete-row-prod"><i class="far fa-trash-alt"></i></button></td>
                                        </tr>

                                        <tr class="item_pr">
                                            <td>
                                                <input type="text" name="sku_producto" placeholder="Código SKU" id="sku-prod" class="form-control txt-frm ob">
                                            </td>
                                            <td>
                                                <input type="text" name="nombre_producto" placeholder="Nombre del producto" id="nom-prod" class="form-control txt-frm ob"><br>
                                            </td>
                                            <td>
                                                <select name="categoria_producto" id="cate-prod" class="form-control ob categoria_producto">
                                                    <option data-ide="" selected disabled> Elija una categoria</option>
                                                    <?php
                                                    foreach ($categorias_tienda['data'] as $key => $value) {
                                                        echo "<option data-ide=" . $value["id_categoria"] . ">" . $value["nombre_categoria"] . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                            <td>
                                                <select name="subcategoria_producto" id="subcate-prod" class="form-control ob subcategoria_producto">
                                                    <option selected disabled> Elija una subcategoria</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select name="promocion_producto" id="prom-prod" class="form-control ob">
                                                    <option value="ninguno" selected>Ninguno</option>
                                                    <option value="oferta">Oferta</option>
                                                    <option value="nuevo">Nuevo</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input name="desc_producto" placeholder="Descripción corta" id="desc-prod" class="form-control txt-frm ob" style="width:100%;">
                                            </td>
                                            <td>
                                                <input type="number" name="precio_unitario_producto" placeholder="Precio unitario" id="preu-prod" class="form-control txt-frm ob" value="0"><br>
                                            </td>
                                            <td>
                                                <input type="number" name="precio_oferta_producto" placeholder="Precio de oferta" id="prem-prod" class="form-control txt-frm ob" value="0"><br>
                                            </td>
                                            <td>
                                                <input type="number" name="stock_producto" placeholder="Stock" id="stock-prod" class="form-control txt-frm ob" value="1"><br>
                                            </td>
                                            <td>
                                                <select name="destacado_producto" id="dest-prod" class="form-control ob">

                                                    <option value="1">Si</option>
                                                    <option value="2" selected>No</option>
                                                </select>
                                            </td>
                                            <td><button class="btn btn-danger delete-row-prod"><i class="far fa-trash-alt"></i></button></td>
                                        </tr>

                                        <tr class="item_pr">
                                            <td>
                                                <input type="text" name="sku_producto" placeholder="Código SKU" id="sku-prod" class="form-control txt-frm ob">
                                            </td>
                                            <td>
                                                <input type="text" name="nombre_producto" placeholder="Nombre del producto" id="nom-prod" class="form-control txt-frm ob"><br>
                                            </td>
                                            <td>
                                                <select name="categoria_producto" id="cate-prod" class="form-control ob categoria_producto">
                                                    <option data-ide="" selected disabled> Elija una categoria</option>
                                                    <?php
                                                    foreach ($categorias_tienda['data'] as $key => $value) {
                                                        echo "<option data-ide=" . $value["id_categoria"] . ">" . $value["nombre_categoria"] . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                            <td>
                                                <select name="subcategoria_producto" id="subcate-prod" class="form-control ob subcategoria_producto">
                                                    <option selected disabled> Elija una subcategoria</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select name="promocion_producto" id="prom-prod" class="form-control ob">
                                                    <option value="ninguno" selected>Ninguno</option>
                                                    <option value="oferta">Oferta</option>
                                                    <option value="nuevo">Nuevo</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input name="desc_producto" placeholder="Descripción corta" id="desc-prod" class="form-control txt-frm ob" style="width:100%;">
                                            </td>
                                            <td>
                                                <input type="number" name="precio_unitario_producto" placeholder="Precio unitario" id="preu-prod" class="form-control txt-frm ob" value="0"><br>
                                            </td>
                                            <td>
                                                <input type="number" name="precio_oferta_producto" placeholder="Precio de oferta" id="prem-prod" class="form-control txt-frm ob" value="0"><br>
                                            </td>
                                            <td>
                                                <input type="number" name="stock_producto" placeholder="Stock" id="stock-prod" class="form-control txt-frm ob" value="1"><br>
                                            </td>
                                            <td>
                                                <select name="destacado_producto" id="dest-prod" class="form-control ob">

                                                    <option value="1">Si</option>
                                                    <option value="2" selected>No</option>
                                                </select>
                                            </td>
                                            <td><button class="btn btn-danger delete-row-prod"><i class="far fa-trash-alt"></i></button></td>
                                        </tr>

                                        <tr class="item_pr">
                                            <td>
                                                <input type="text" name="sku_producto" placeholder="Código SKU" id="sku-prod" class="form-control txt-frm ob">
                                            </td>
                                            <td>
                                                <input type="text" name="nombre_producto" placeholder="Nombre del producto" id="nom-prod" class="form-control txt-frm ob"><br>
                                            </td>
                                            <td>
                                                <select name="categoria_producto" id="cate-prod" class="form-control ob categoria_producto">
                                                    <option data-ide="" selected disabled> Elija una categoria</option>
                                                    <?php
                                                    foreach ($categorias_tienda['data'] as $key => $value) {
                                                        echo "<option data-ide=" . $value["id_categoria"] . ">" . $value["nombre_categoria"] . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                            <td>
                                                <select name="subcategoria_producto" id="subcate-prod" class="form-control ob subcategoria_producto">
                                                    <option selected disabled> Elija una subcategoria</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select name="promocion_producto" id="prom-prod" class="form-control ob">
                                                    <option value="ninguno" selected>Ninguno</option>
                                                    <option value="oferta">Oferta</option>
                                                    <option value="nuevo">Nuevo</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input name="desc_producto" placeholder="Descripción corta" id="desc-prod" class="form-control txt-frm ob" style="width:100%;">
                                            </td>
                                            <td>
                                                <input type="number" name="precio_unitario_producto" placeholder="Precio unitario" id="preu-prod" class="form-control txt-frm ob" value="0"><br>
                                            </td>
                                            <td>
                                                <input type="number" name="precio_oferta_producto" placeholder="Precio de oferta" id="prem-prod" class="form-control txt-frm ob" value="0"><br>
                                            </td>
                                            <td>
                                                <input type="number" name="stock_producto" placeholder="Stock" id="stock-prod" class="form-control txt-frm ob" value="1"><br>
                                            </td>
                                            <td>
                                                <select name="destacado_producto" id="dest-prod" class="form-control ob">

                                                    <option value="1">Si</option>
                                                    <option value="2" selected>No</option>
                                                </select>
                                            </td>
                                            <td><button class="btn btn-danger delete-row-prod"><i class="far fa-trash-alt"></i></button></td>
                                        </tr>

                                        <tr class="item_pr">
                                            <td>
                                                <input type="text" name="sku_producto" placeholder="Código SKU" id="sku-prod" class="form-control txt-frm ob">
                                            </td>
                                            <td>
                                                <input type="text" name="nombre_producto" placeholder="Nombre del producto" id="nom-prod" class="form-control txt-frm ob"><br>
                                            </td>
                                            <td>
                                                <select name="categoria_producto" id="cate-prod" class="form-control ob categoria_producto">
                                                    <option data-ide="" selected disabled> Elija una categoria</option>
                                                    <?php
                                                    foreach ($categorias_tienda['data'] as $key => $value) {
                                                        echo "<option data-ide=" . $value["id_categoria"] . ">" . $value["nombre_categoria"] . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                            <td>
                                                <select name="subcategoria_producto" id="subcate-prod" class="form-control ob subcategoria_producto">
                                                    <option selected disabled> Elija una subcategoria</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select name="promocion_producto" id="prom-prod" class="form-control ob">
                                                    <option value="ninguno" selected>Ninguno</option>
                                                    <option value="oferta">Oferta</option>
                                                    <option value="nuevo">Nuevo</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input name="desc_producto" placeholder="Descripción corta" id="desc-prod" class="form-control txt-frm ob" style="width:100%;">
                                            </td>
                                            <td>
                                                <input type="number" name="precio_unitario_producto" placeholder="Precio unitario" id="preu-prod" class="form-control txt-frm ob" value="0"><br>
                                            </td>
                                            <td>
                                                <input type="number" name="precio_oferta_producto" placeholder="Precio de oferta" id="prem-prod" class="form-control txt-frm ob" value="0"><br>
                                            </td>
                                            <td>
                                                <input type="number" name="stock_producto" placeholder="Stock" id="stock-prod" class="form-control txt-frm ob" value="1"><br>
                                            </td>
                                            <td>
                                                <select name="destacado_producto" id="dest-prod" class="form-control ob">

                                                    <option value="1">Si</option>
                                                    <option value="2" selected>No</option>
                                                </select>
                                            </td>
                                            <td><button class="btn btn-danger delete-row-prod"><i class="far fa-trash-alt"></i></button></td>
                                        </tr>

                                        <tr class="item_pr">
                                            <td>
                                                <input type="text" name="sku_producto" placeholder="Código SKU" id="sku-prod" class="form-control txt-frm ob">
                                            </td>
                                            <td>
                                                <input type="text" name="nombre_producto" placeholder="Nombre del producto" id="nom-prod" class="form-control txt-frm ob"><br>
                                            </td>
                                            <td>
                                                <select name="categoria_producto" id="cate-prod" class="form-control ob categoria_producto">
                                                    <option data-ide="" selected disabled> Elija una categoria</option>
                                                    <?php
                                                    foreach ($categorias_tienda['data'] as $key => $value) {
                                                        echo "<option data-ide=" . $value["id_categoria"] . ">" . $value["nombre_categoria"] . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                            <td>
                                                <select name="subcategoria_producto" id="subcate-prod" class="form-control ob subcategoria_producto">
                                                    <option selected disabled> Elija una subcategoria</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select name="promocion_producto" id="prom-prod" class="form-control ob">
                                                    <option value="ninguno" selected>Ninguno</option>
                                                    <option value="oferta">Oferta</option>
                                                    <option value="nuevo">Nuevo</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input name="desc_producto" placeholder="Descripción corta" id="desc-prod" class="form-control txt-frm ob" style="width:100%;">
                                            </td>
                                            <td>
                                                <input type="number" name="precio_unitario_producto" placeholder="Precio unitario" id="preu-prod" class="form-control txt-frm ob" value="0"><br>
                                            </td>
                                            <td>
                                                <input type="number" name="precio_oferta_producto" placeholder="Precio de oferta" id="prem-prod" class="form-control txt-frm ob" value="0"><br>
                                            </td>
                                            <td>
                                                <input type="number" name="stock_producto" placeholder="Stock" id="stock-prod" class="form-control txt-frm ob" value="1"><br>
                                            </td>
                                            <td>
                                                <select name="destacado_producto" id="dest-prod" class="form-control ob">

                                                    <option value="1">Si</option>
                                                    <option value="2" selected>No</option>
                                                </select>
                                            </td>
                                            <td><button class="btn btn-danger delete-row-prod"><i class="far fa-trash-alt"></i></button></td>
                                        </tr>

                                        <tr class="item_pr">
                                            <td>
                                                <input type="text" name="sku_producto" placeholder="Código SKU" id="sku-prod" class="form-control txt-frm ob">
                                            </td>
                                            <td>
                                                <input type="text" name="nombre_producto" placeholder="Nombre del producto" id="nom-prod" class="form-control txt-frm ob"><br>
                                            </td>
                                            <td>
                                                <select name="categoria_producto" id="cate-prod" class="form-control ob categoria_producto">
                                                    <option data-ide="" selected disabled> Elija una categoria</option>
                                                    <?php
                                                    foreach ($categorias_tienda['data'] as $key => $value) {
                                                        echo "<option data-ide=" . $value["id_categoria"] . ">" . $value["nombre_categoria"] . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                            <td>
                                                <select name="subcategoria_producto" id="subcate-prod" class="form-control ob subcategoria_producto">
                                                    <option selected disabled> Elija una subcategoria</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select name="promocion_producto" id="prom-prod" class="form-control ob">
                                                    <option value="ninguno" selected>Ninguno</option>
                                                    <option value="oferta">Oferta</option>
                                                    <option value="nuevo">Nuevo</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input name="desc_producto" placeholder="Descripción corta" id="desc-prod" class="form-control txt-frm ob" style="width:100%;">
                                            </td>
                                            <td>
                                                <input type="number" name="precio_unitario_producto" placeholder="Precio unitario" id="preu-prod" class="form-control txt-frm ob" value="0"><br>
                                            </td>
                                            <td>
                                                <input type="number" name="precio_oferta_producto" placeholder="Precio de oferta" id="prem-prod" class="form-control txt-frm ob" value="0"><br>
                                            </td>
                                            <td>
                                                <input type="number" name="stock_producto" placeholder="Stock" id="stock-prod" class="form-control txt-frm ob" value="1"><br>
                                            </td>
                                            <td>
                                                <select name="destacado_producto" id="dest-prod" class="form-control ob">

                                                    <option value="1">Si</option>
                                                    <option value="2" selected>No</option>
                                                </select>
                                            </td>
                                            <td><button class="btn btn-danger delete-row-prod"><i class="far fa-trash-alt"></i></button></td>
                                        </tr>

                                        <tr class="item_pr">
                                            <td>
                                                <input type="text" name="sku_producto" placeholder="Código SKU" id="sku-prod" class="form-control txt-frm ob">
                                            </td>
                                            <td>
                                                <input type="text" name="nombre_producto" placeholder="Nombre del producto" id="nom-prod" class="form-control txt-frm ob"><br>
                                            </td>
                                            <td>
                                                <select name="categoria_producto" id="cate-prod" class="form-control ob categoria_producto">
                                                    <option data-ide="" selected disabled> Elija una categoria</option>
                                                    <?php
                                                    foreach ($categorias_tienda['data'] as $key => $value) {
                                                        echo "<option data-ide=" . $value["id_categoria"] . ">" . $value["nombre_categoria"] . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                            <td>
                                                <select name="subcategoria_producto" id="subcate-prod" class="form-control ob subcategoria_producto">
                                                    <option selected disabled> Elija una subcategoria</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select name="promocion_producto" id="prom-prod" class="form-control ob">
                                                    <option value="ninguno" selected>Ninguno</option>
                                                    <option value="oferta">Oferta</option>
                                                    <option value="nuevo">Nuevo</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input name="desc_producto" placeholder="Descripción corta" id="desc-prod" class="form-control txt-frm ob" style="width:100%;">
                                            </td>
                                            <td>
                                                <input type="number" name="precio_unitario_producto" placeholder="Precio unitario" id="preu-prod" class="form-control txt-frm ob" value="0"><br>
                                            </td>
                                            <td>
                                                <input type="number" name="precio_oferta_producto" placeholder="Precio de oferta" id="prem-prod" class="form-control txt-frm ob" value="0"><br>
                                            </td>
                                            <td>
                                                <input type="number" name="stock_producto" placeholder="Stock" id="stock-prod" class="form-control txt-frm ob" value="1"><br>
                                            </td>
                                            <td>
                                                <select name="destacado_producto" id="dest-prod" class="form-control ob">

                                                    <option value="1">Si</option>
                                                    <option value="2" selected>No</option>
                                                </select>
                                            </td>
                                            <td><button class="btn btn-danger delete-row-prod"><i class="far fa-trash-alt"></i></button></td>
                                        </tr>

                                        <tr class="item_pr">
                                            <td>
                                                <input type="text" name="sku_producto" placeholder="Código SKU" id="sku-prod" class="form-control txt-frm ob">
                                            </td>
                                            <td>
                                                <input type="text" name="nombre_producto" placeholder="Nombre del producto" id="nom-prod" class="form-control txt-frm ob"><br>
                                            </td>
                                            <td>
                                                <select name="categoria_producto" id="cate-prod" class="form-control ob categoria_producto">
                                                    <option data-ide="" selected disabled> Elija una categoria</option>
                                                    <?php
                                                    foreach ($categorias_tienda['data'] as $key => $value) {
                                                        echo "<option data-ide=" . $value["id_categoria"] . ">" . $value["nombre_categoria"] . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                            <td>
                                                <select name="subcategoria_producto" id="subcate-prod" class="form-control ob subcategoria_producto">
                                                    <option selected disabled> Elija una subcategoria</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select name="promocion_producto" id="prom-prod" class="form-control ob">
                                                    <option value="ninguno" selected>Ninguno</option>
                                                    <option value="oferta">Oferta</option>
                                                    <option value="nuevo">Nuevo</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input name="desc_producto" placeholder="Descripción corta" id="desc-prod" class="form-control txt-frm ob" style="width:100%;">
                                            </td>
                                            <td>
                                                <input type="number" name="precio_unitario_producto" placeholder="Precio unitario" id="preu-prod" class="form-control txt-frm ob" value="0"><br>
                                            </td>
                                            <td>
                                                <input type="number" name="precio_oferta_producto" placeholder="Precio de oferta" id="prem-prod" class="form-control txt-frm ob" value="0"><br>
                                            </td>
                                            <td>
                                                <input type="number" name="stock_producto" placeholder="Stock" id="stock-prod" class="form-control txt-frm ob" value="1"><br>
                                            </td>
                                            <td>
                                                <select name="destacado_producto" id="dest-prod" class="form-control ob">

                                                    <option value="1">Si</option>
                                                    <option value="2" selected>No</option>
                                                </select>
                                            </td>
                                            <td><button class="btn btn-danger delete-row-prod"><i class="far fa-trash-alt"></i></button></td>
                                        </tr>

                                        <tr class="item_pr">
                                            <td>
                                                <input type="text" name="sku_producto" placeholder="Código SKU" id="sku-prod" class="form-control txt-frm ob">
                                            </td>
                                            <td>
                                                <input type="text" name="nombre_producto" placeholder="Nombre del producto" id="nom-prod" class="form-control txt-frm ob"><br>
                                            </td>
                                            <td>
                                                <select name="categoria_producto" id="cate-prod" class="form-control ob categoria_producto">
                                                    <option data-ide="" selected disabled> Elija una categoria</option>
                                                    <?php
                                                    foreach ($categorias_tienda['data'] as $key => $value) {
                                                        echo "<option data-ide=" . $value["id_categoria"] . ">" . $value["nombre_categoria"] . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                            <td>
                                                <select name="subcategoria_producto" id="subcate-prod" class="form-control ob subcategoria_producto">
                                                    <option selected disabled> Elija una subcategoria</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select name="promocion_producto" id="prom-prod" class="form-control ob">
                                                    <option value="ninguno" selected>Ninguno</option>
                                                    <option value="oferta">Oferta</option>
                                                    <option value="nuevo">Nuevo</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input name="desc_producto" placeholder="Descripción corta" id="desc-prod" class="form-control txt-frm ob" style="width:100%;">
                                            </td>
                                            <td>
                                                <input type="number" name="precio_unitario_producto" placeholder="Precio unitario" id="preu-prod" class="form-control txt-frm ob" value="0"><br>
                                            </td>
                                            <td>
                                                <input type="number" name="precio_oferta_producto" placeholder="Precio de oferta" id="prem-prod" class="form-control txt-frm ob" value="0"><br>
                                            </td>
                                            <td>
                                                <input type="number" name="stock_producto" placeholder="Stock" id="stock-prod" class="form-control txt-frm ob" value="1"><br>
                                            </td>
                                            <td>
                                                <select name="destacado_producto" id="dest-prod" class="form-control ob">

                                                    <option value="1">Si</option>
                                                    <option value="2" selected>No</option>
                                                </select>
                                            </td>
                                            <td><button class="btn btn-danger delete-row-prod"><i class="far fa-trash-alt"></i></button></td>
                                        </tr>

                                        <tr class="item_pr">
                                            <td>
                                                <input type="text" name="sku_producto" placeholder="Código SKU" id="sku-prod" class="form-control txt-frm ob">
                                            </td>
                                            <td>
                                                <input type="text" name="nombre_producto" placeholder="Nombre del producto" id="nom-prod" class="form-control txt-frm ob"><br>
                                            </td>
                                            <td>
                                                <select name="categoria_producto" id="cate-prod" class="form-control ob categoria_producto">
                                                    <option data-ide="" selected disabled> Elija una categoria</option>
                                                    <?php
                                                    foreach ($categorias_tienda['data'] as $key => $value) {
                                                        echo "<option data-ide=" . $value["id_categoria"] . ">" . $value["nombre_categoria"] . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                            <td>
                                                <select name="subcategoria_producto" id="subcate-prod" class="form-control ob subcategoria_producto">
                                                    <option selected disabled> Elija una subcategoria</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select name="promocion_producto" id="prom-prod" class="form-control ob">
                                                    <option value="ninguno" selected>Ninguno</option>
                                                    <option value="oferta">Oferta</option>
                                                    <option value="nuevo">Nuevo</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input name="desc_producto" placeholder="Descripción corta" id="desc-prod" class="form-control txt-frm ob" style="width:100%;">
                                            </td>
                                            <td>
                                                <input type="number" name="precio_unitario_producto" placeholder="Precio unitario" id="preu-prod" class="form-control txt-frm ob" value="0"><br>
                                            </td>
                                            <td>
                                                <input type="number" name="precio_oferta_producto" placeholder="Precio de oferta" id="prem-prod" class="form-control txt-frm ob" value="0"><br>
                                            </td>
                                            <td>
                                                <input type="number" name="stock_producto" placeholder="Stock" id="stock-prod" class="form-control txt-frm ob" value="1"><br>
                                            </td>
                                            <td>
                                                <select name="destacado_producto" id="dest-prod" class="form-control ob">

                                                    <option value="1">Si</option>
                                                    <option value="2" selected>No</option>
                                                </select>
                                            </td>
                                            <td><button class="btn btn-danger delete-row-prod"><i class="far fa-trash-alt"></i></button></td>
                                        </tr>

                                        <tr class="item_pr">
                                            <td>
                                                <input type="text" name="sku_producto" placeholder="Código SKU" id="sku-prod" class="form-control txt-frm ob">
                                            </td>
                                            <td>
                                                <input type="text" name="nombre_producto" placeholder="Nombre del producto" id="nom-prod" class="form-control txt-frm ob"><br>
                                            </td>
                                            <td>
                                                <select name="categoria_producto" id="cate-prod" class="form-control ob categoria_producto">
                                                    <option data-ide="" selected disabled> Elija una categoria</option>
                                                    <?php
                                                    foreach ($categorias_tienda['data'] as $key => $value) {
                                                        echo "<option data-ide=" . $value["id_categoria"] . ">" . $value["nombre_categoria"] . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                            <td>
                                                <select name="subcategoria_producto" id="subcate-prod" class="form-control ob subcategoria_producto">
                                                    <option selected disabled> Elija una subcategoria</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select name="promocion_producto" id="prom-prod" class="form-control ob">
                                                    <option value="ninguno" selected>Ninguno</option>
                                                    <option value="oferta">Oferta</option>
                                                    <option value="nuevo">Nuevo</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input name="desc_producto" placeholder="Descripción corta" id="desc-prod" class="form-control txt-frm ob" style="width:100%;">
                                            </td>
                                            <td>
                                                <input type="number" name="precio_unitario_producto" placeholder="Precio unitario" id="preu-prod" class="form-control txt-frm ob" value="0"><br>
                                            </td>
                                            <td>
                                                <input type="number" name="precio_oferta_producto" placeholder="Precio de oferta" id="prem-prod" class="form-control txt-frm ob" value="0"><br>
                                            </td>
                                            <td>
                                                <input type="number" name="stock_producto" placeholder="Stock" id="stock-prod" class="form-control txt-frm ob" value="1"><br>
                                            </td>
                                            <td>
                                                <select name="destacado_producto" id="dest-prod" class="form-control ob">

                                                    <option value="1">Si</option>
                                                    <option value="2" selected>No</option>
                                                </select>
                                            </td>
                                            <td><button class="btn btn-danger delete-row-prod"><i class="far fa-trash-alt"></i></button></td>
                                        </tr>

                                    </tbody>
                                </table>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!----------------------------
AGREGAR PRODUCTO
----------------------------->

<script>

    $('.delete-row-prod').on('click', function(){
        $(this).closest('.item_pr').remove();
        return false
    });
    
    codigo_tienda = $('#code_tienda').text();

    ElegirSubcategoria();

    $('.color-ball').on('click', function() {
        $(this).toggleClass('color-active');
    });

    function ElegirSubcategoria() {

        $('.categoria_producto').on('change', function() {

            var ide_categoria = $('option:selected', this).data('ide');
            var subcate = $(this).closest('.item_pr').find('.subcategoria_producto');
            //alert(ide_categoria);
            $.ajax({
                type: "POST",
                url: "controlador/acciones.php",
                data: {
                    accion: 'CargarSubcategorias',
                    ide: ide_categoria,
                    codigo_tienda: '#T73763474'
                },
                success: function(data) {

                    if (data == "") {
                        subcate.html('<option data-ide="">No se encontraron subcategorias</option>')
                    } else {
                        subcate.html(data);
                    }

                    return false;
                }
            });
        });
    }

    $('#add-planilla-producto').on('click', function(e){
        e.preventDefault();
        agregar_planilla('.ob');
    });

    /*---------------------
    AGREGAR PRODUCTO
    ---------------------*/
    var cont_add = 0;
    function agregar_planilla(campo) {

        var ac_tallas = "0";
        var ac_colores = "0";
        var Filtros = {};
        var tallas = {};
        var colores_seleccionados = [];
        var filtros_encode = JSON.stringify(Filtros);

        $('.item_pr').each(function(){

        /*--------------------- 
        INFORMACION 
        ---------------------*/
        var sku_producto                    = $(this).find('#sku-prod').val();
        var nombre_producto                 = $(this).find('#nom-prod').val();
        var desc_corta                      = encodeURI($(this).find('#desc-prod').val());
        var descripcion_producto            = btoa(unescape(encodeURIComponent($(this).find('#descrip-prod').html())));
        var adicional_producto              = btoa(unescape(encodeURIComponent($(this).find('#adicional-prod').html())));
        var precio_unitario                 = $(this).find('#preu-prod').val();
        var precio_oferta                   = $(this).find('#prem-prod').val();
        var stock_producto                  = $(this).find('#stock-prod').val();
        var imagen_producto                 = $(this).find('#img_producto').attr('src');
        var destacado_producto              = $(this).find('#dest-prod').val();
        var estado_producto                 = $(this).find('#prom-prod').val();
        var id_categoria_producto           = $(this).find('#cate-prod option:selected').data('ide');
        var id_subcategoria_producto        = $(this).find('#subcate-prod option:selected').data('cat');
        var nombre_categoria_producto       = $(this).find('#cate-prod option:selected').text();
        var nombre_subcategoria_producto    = $(this).find('#subcate-prod option:selected').text();
        
        var galeria = [];
        var galeria_prod = JSON.stringify(galeria);

        var isValid = true;

        $(campo + ":visible").each(function() {
            var camp = $(this);
            if ($.trim($(this).val()) == '') {
                isValid = false;
                camp.css({

                    "outline": "2px solid indianred",
                    "background": ""
                });
                camp.focus();
                return false;
            } else {
                camp.css({

                    "outline": "2px solid seagreen",
                    "background": ""
                });
            }

        });

        if (isValid == false) {

            $('.error_info').css({
                'background-color': 'indianred'
            });
            $('.error_info').html("Ingrese los datos en los campos marcados en color rojo.");
            $('.error_info').fadeIn(1000);
            setTimeout(function() {
                $('.error_info').fadeOut();
            }, 2500);
            return false;
        } else if ($('#cate-prod option:selected').data('ide') == "") {

            $('.error_info').css({
                'background-color': 'indianred'
            });
            $('.error_info').html("Por favor, seleccione una categoria.");
            $('.error_info').fadeIn(1000);


        } else if ($('#subcate-prod option:selected').data('ide') == "") {

            $('.error_info').css({
                'background-color': 'indianred'
            });
            $('.error_info').html("Por favor, seleccione una subcategoria.");
            $('.error_info').fadeIn(1000);
        } else {

            $('.error_info').css({
                'background-color': 'seagreen'
            });
            $('.error_info').html("Datos validados correctamente");
            $('.error_info').fadeIn(500);

            setTimeout(function() {
                $('.error_info').fadeOut();
            }, 600);

            //alert(filtros_encode);


            $.ajax({
                type: "POST",
                url: "controlador/crud/productos.php",
                data: {
                    accion: 'AgregarPlanillaComercio',
                    codigo_comercio     : '<?php echo $storex; ?>',
                    prod_sku            : sku_producto,
                    prod_nombre         : nombre_producto,
                    prod_desc_c         : desc_corta,
                    prod_desc           : 'PGJyPg==',
                    prod_adic           : 'PGJyPg==',
                    prod_pu             : precio_unitario,
                    prod_po             : precio_oferta,
                    prod_stock          : stock_producto,
                    prod_img            : '',
                    prod_dest           : destacado_producto,
                    prod_est            : estado_producto,
                    prod_id_cate        : id_categoria_producto,
                    prod_id_subcate     : id_subcategoria_producto,
                    prod_nombre_cate    : nombre_categoria_producto,
                    prod_nombre_subcate : nombre_subcategoria_producto,
                    galeria             : 'W10=',
                    prod_metatit        : '',
                    prod_metadesc       : '',
                    prod_key            : '',
                    filtros_producto    : 'eyJjb2xvcmVzIjp7InNlbGVjY2lvbmFkb3MiOltdfSwiZXN0YWRvcyI6eyJ0YWxsYXMiOiIwIiwiY29sb3JlcyI6IjAifSwidGFsbGEiOnsiUyI6eyJub21icmUiOiJTIiwiZXh0cmEiOiIwIiwiaWRlIjoiLXMifSwiTSI6eyJub21icmUiOiJNIiwiZXh0cmEiOiIwIiwiaWRlIjoiLW0ifSwiTCI6eyJub21icmUiOiJMIiwiZXh0cmEiOiIwIiwiaWRlIjoiLWwifSwiWEwiOnsibm9tYnJlIjoiWEwiLCJleHRyYSI6IjAiLCJpZGUiOiIteGwifX19'
                },
                success: function(data) {
                    console.log(data);
                    if (data == 1) {

                        $('.txt-frm').val("");
                        $('.ob').css({
                            "outline": "0px solid indianred"
                        });
                        cont_add++;

                        console.log(cont_add);

                        if(cont_add == 3){
                            Swal.fire({
                                    icon: 'success',
                                    title: 'Productos agregados correctamente',
                                    text: 'Se agrego correctamente la planilla de productos'
                                }).then(function() {
                                    //location.reload();
                                });
                        }
                        //window.location = 'page-productos.php';
                        return false;
                    } else {
                        alert("No se pudo registrar el producto.")
                        return false;
                    }
                }
            });
        }
    });
    }


    /*=============================================
    CARGAR CATEGORIA
    =============================================*/
    function CargarCategorias(combo) {

        $.ajax({
            type: "POST",
            url: "controlador/crud/categoria.php",
            async: "false",
            data: {
                accion: 'ComboCategorias'
            },
            success: function(data) {

                $(combo).append(data);
                return false;
            }
        });
    }

    $('#gal_pro').on('change', function(e) {
        e.preventDefault();

        SubirGaleria($(this).attr('id'));
    });


    function SubirGaleria(element) {

        //alert("Subida de imagenes");

        $("#galeria-productos").append("<img id='load-pic' src='img/cargador.gif'>");

        var archivos = document.getElementById(element); //Creamos un objeto con el elemento que contiene los archivos: el campo input file, que tiene el id = 'archivos'
        var archivo = archivos.files; //Obtenemos los archivos seleccionados en el imput
        //Creamos una instancia del Objeto FormDara.
        var archivos = new FormData();
        /* Como son multiples archivos creamos un ciclo for que recorra la el arreglo de los archivos seleccionados en el input
        Este y añadimos cada elemento al formulario FormData en forma de arreglo, utilizando la variable i (autoincremental) como 
        indice para cada archivo, si no hacemos esto, los valores del arreglo se sobre escriben*/
        for (i = 0; i < archivo.length; i++) {
            archivos.append('archivo' + i, archivo[i]); //Añadimos cada archivo a el arreglo con un indice direfente
        }

        /*Ejecutamos la función ajax de jQuery*/
        $.ajax({
            url: 'controlador/galeria.php', //Url a donde la enviaremos
            type: 'POST', //Metodo que usaremos
            contentType: false, //Debe estar en false para que pase el objeto sin procesar
            data: archivos, //Le pasamos el objeto que creamos con los archivos
            processData: false, //Debe estar en false para que JQuery no procese los datos a enviar
            cache: false,
            beforeSend: function() {

            },
            success: function(data) {
                $('#load-pic').remove();
                $("#galeria-productos").append(data);

                EliminarPic();
            } //Para que el formulario no guarde cache
        }).done(function(data) { //Escuchamos la respuesta y capturamos el mensaje 

        });
    }

    function EliminarPic() {
        $('.delete-pic').on('click', function() {
            $(this).parent().remove();

            return false;
        });
    }
</script>