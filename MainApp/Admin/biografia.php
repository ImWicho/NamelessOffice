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
            <h1>Biografias</h1>
        </div>
        <div class="noti"></div>
        <div class="bg-azul contenedor sombra xd">
            <form action="" id="biografia">
                <legend>Añada una Biografia<span>Todos los campos son obligatorios.</span></legend>

                <?php 
                    include 'inc/layout/formularioBiografia.php';
                ?>
            </form>
        </div>

        <div class="contenedor sombra items bg-azul">
            <div class="contenedor-items">
                <h2>Biografias</h2>
                <input type="text" id="buscar" class="buscador sombra" placeholder="Buscar Biografias...">

                <p class="total-items"><span>2</span> Biografias</p>

                <div class="contenedor-tabla">
                    <table id="listado-items" class="listado-items">
                        <thead>
                            <tr>
                                <th>Numero</th>
                                <th>Personaje</th>
                                <th>Acciones</th>
                            </tr>

                        </thead>
                        <tbody>
                            <?php $biografias = obtenerBiografias();
                                if($biografias->num_rows){
                                    foreach($biografias as $biografia) { ?>
                            <tr>
                                <td><?php echo $biografia['numero']; ?></td>
                                <td><?php echo $biografia['nombre']; ?></td>
                                <td>
                                    <a href="biografiaEditar.php?ID_biografia=<?php echo $biografia['ID_biografia']; ?>"
                                        class="btn-editar btn"><i class="fas fa-pen-square"></i></a>
                                    <button type="button" data-id="<?php echo $biografia['ID_biografia']; ?>"
                                        class="btn-borrar btn"><i class="fas fa-trash-alt"></i></button>
                                </td>
                            </tr>
                            <?php }
                             }  ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="js/jQuery.js"></script>
<script src="js/menu.js"></script>
<script src="js/biografia.js"></script>
<script src="js/buscador.js"></script>
</body>

</html>