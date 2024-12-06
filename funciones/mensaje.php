<?php session_start();?>
<?php if (!empty($_SESSION['mensaje'])) { ?>
    <?php
    $mensaje = explode("_/_", $_SESSION['mensaje']);
    if (($mensaje[0] == 'NOTICIA')) {
        $class = "success";
    } else {
        $class = "danger";
    }
    ?>
    <div class="alert alert-<?= $class; ?>" role="alert" id="mensaje">
        <i class="ion ion-information-circled"></i>
        <?php
        echo $mensaje[1];
        $_SESSION['mensaje'] = '';
        ?>
    </div>
<?php } ?>