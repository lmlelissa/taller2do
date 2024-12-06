<?php

session_start();
require './conexion.php';

$user = $_POST['vusuario'];
$pass = $_POST['vpass'];
$consulta = "SELECT md5('" . $pass . "')";
$passmd5 = consultas::get_datos($consulta);
$contra = $passmd5[0]['md5'];
$fecha = date('Y-m-d');
//print_r($fecha);

$existeusuario = "SELECT * FROM v_ref_usuarios WHERE usu_nick='" . $user . "'";
$usuario = consultas::get_datos($existeusuario);
if ($usuario[0]['id_usuario'] != NULL) {
    if ($usuario[0]['usu_estado'] != "BLOQUEADO") {
        if ($usuario[0]['usu_clave'] != $contra) {
            if ($usuario[0]['intentos'] >= 3 && $usuario[0]['fecha_intento'] == $fecha) {
                if ($usuario[0]['auditoria'] == NULL) {
                    $auditoria = "'BLOQUEO " . $fecha . "'";
                } else {
                    $auditoria = "COALESCE(auditoria,'')||chr(10)||'BLOQUEO/'||now()";
                }
                $bloqueando = "UPDATE ref_usuarios SET usu_estado='BLOQUEADO', auditoria=" . $auditoria . " WHERE id_usuario=" . $usuario[0]['id_usuario'];
                $bloqueo = consultas::get_datos($bloqueando);
                $_SESSION['mensaje'] = "SUPERO EL MAXIMO DE INTENTOS!";
                $_SESSION['tipo_mensaje'] = "error";
                header('Location: /sysmeli');
            } else {
                if ($usuario[0]['intentos'] < 3 && $usuario[0]['fecha_intento'] == $fecha) {
                    $intentos = $usuario[0]['intentos'] + 1;
                    $bloqueando = "UPDATE ref_usuarios SET intentos=" . $intentos . ", fecha_intento='" . $fecha . "' WHERE id_usuario=" . $usuario[0]['id_usuario'];
                    $bloqueo = consultas::get_datos($bloqueando);
                    $_SESSION['mensaje'] = "INTENTOS N° " . $intentos;
                    $_SESSION['tipo_mensaje'] = "error";
                    header('Location: /sysmeli');
                } else {
                    if ($usuario[0]['intentos'] < 3 && $usuario[0]['fecha_intento'] != $fecha) {
                        $intentos = 0;
                        $bloqueando = "UPDATE ref_usuarios SET intentos=" . $intentos . ", fecha_intento='" . $fecha . "' WHERE id_usuario=" . $usuario[0]['id_usuario'];
                        $bloqueo = consultas::get_datos($bloqueando);
                        $_SESSION['mensaje'] = "INTENTE DE NUEVO";
                        $_SESSION['tipo_mensaje'] = "error";
                        header('Location: /sysmeli');
                    }
                }
            }
        } else {
            $sql = "SELECT * FROM v_ref_usuarios WHERE usu_nick='" . $user . "' AND usu_clave='" . $contra . "'";
            $resultado = consultas::get_datos($sql);
            if (!empty($resultado)) {
                if ($resultado[0]['usu_estado'] == 'BLOQUEADO') {
                    $desbloqueando = "UPDATE ref_usuarios SET intentos=0, fecha_intento=now(), usu_estado='ACTIVO' WHERE id_usuario=" . $resultado[0]['id_usuario'];
                    $desbloqueo = consultas::get_datos($desbloqueando);
                }if ($usuario[0]['primera'] == "t") {
                    $_SESSION['id_usuario'] = $resultado[0]['id_usuario'];
                    $_SESSION['id_perfil'] = $resultado[0]['id_perfil'];
                    $_SESSION['perf_nombre'] = $resultado[0]['perf_nombre'];
                    $_SESSION['usu_nick'] = $resultado[0]['usu_nick'];
                    $_SESSION['usu_foto'] = $resultado[0]['usu_foto'];
                    $_SESSION['nombres'] = $resultado[0]['nombres'];
                    $_SESSION['persona'] = $resultado[0]['nombres'];
                    $_SESSION['id_sucursal'] = $resultado[0]['id_sucursal'];
                    $_SESSION['sucursal'] = $resultado[0]['suc_nombre'];
                    header('location:menu.php');
                } else {
                    $_SESSION['id_usuario'] = $resultado[0]['id_usuario'];
                    $_SESSION['id_perfil'] = $resultado[0]['id_perfil'];
                    $_SESSION['perf_nombre'] = $resultado[0]['perf_nombre'];
                    $_SESSION['usu_nick'] = $resultado[0]['usu_nick'];
                    $_SESSION['usu_foto'] = $resultado[0]['usu_foto'];
                    $_SESSION['nombres'] = $resultado[0]['nombres'];
                    $_SESSION['id_sucursal'] = $resultado[0]['id_sucursal'];
                    $_SESSION['sucursal'] = $resultado[0]['suc_nombre'];
                    $_SESSION['persona'] = $resultado[0]['nombres'];
                    header('location:menu1.php');
                }
            }
        }
    } else {
        $_SESSION['mensaje'] = "USUARIO BLOQUEADO, CONTACTE CON EL ADMINISTRADOR";
        $_SESSION['tipo_mensaje'] = "error";
        header('Location: /sysmeli');
    }
    //aaa
// aaaaaa
} else {
    $_SESSION['mensaje'] = "NO EXISTE USUARIO!!!";
    $_SESSION['tipo_mensaje'] = "error";
    header('Location: /sysmeli');
}
