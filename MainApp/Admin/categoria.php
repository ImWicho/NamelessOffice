<?php
    include '../../inc/funciones/session.php';
    include 'inc/layout/header.php';
    include 'inc/funciones/funciones.php';
    verificarAdmin();
    error_reporting(0);
?>

<div class="contenido">
    <?php include 'inc/layout/menu.php'; ?>
    <div class="main">
        <div class="headermain sombra">
            <h1>Categorias</h1>
        </div>
        <div class="noti"></div>
        <div class="bg-azul contenedor sombra xd">
            <form action="" id="categoria">
                <legend>Añada una Categoria <span>Todos los campos son obligatorios.</span></legend>

                <?php 
                    include 'inc/layout/formularioCategoria.php';
                ?>
            </form>
        </div>

        <div class="contenedor sombra items bg-azul">
            <div class="contenedor-items">
                <h2>Categorias</h2>
                <input type="text" id="buscar" class="buscador sombra" placeholder="Buscar Categorias...">

                <p class="total-items"><span>2</span> Categorias</p>

                <div class="contenedor-tabla">
                    <table id="listado-items" class="listado-items">
                        <thead>
                            <tr>
                                <th>Categoria</th>
                                <th>Descripcion</th>
                                <th>Acciones</th>
                            </tr>

                        </thead>
                        <tbody>
                            <?php $categorias = obtenerCategorias();
                                if($categorias->num_rows){
                                    foreach($categorias as $categoria) { ?>
                            <tr>
                                <td><?php echo $categoria['nombre']; ?></td>
                                <td><?php echo $categoria['descripcion']; ?></td>
                                <td>
                                    <a href="categoriaEditar.php?ID_categoria=<?php echo $categoria['ID_categoria']; ?>"
                                        class="btn-editar btn"><i class="fas fa-pen-square"></i></a>
                                    <button type="button" data-id="<?php echo $categoria['ID_categoria']; ?>"
                                        class="btn-borrar btn"><i class="fas fa-trash-alt"></i></button>
                                </td>
                            </tr>
                            <?php }
                             } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="js/jQuery.js"></script>
<script src="js/menu.js"></script>
<script src="js/categoria.js"></script>
<script src="js/buscador.js"></script>
</body>

</html>