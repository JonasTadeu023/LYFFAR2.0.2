<?php
    session_start();
    include('../functions/verificacao.php');
    include('../functions/dbh.php');
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    $result = "DELETE FROM denuncias WHERE post_id = '$id'";
    $result_perfil = mysqli_query($connect, $result);

    $result = "DELETE FROM comentarios WHERE post_id = '$id'";
    $result_perfil = mysqli_query($connect, $result);

    $result = "DELETE FROM curtidas WHERE like_post = '$id'";
    $result_perfil = mysqli_query($connect, $result);

    $result3 = "DELETE FROM postagens WHERE post_id = '$id'";
    $result_perfil3 = mysqli_query($connect, $result3);
        if($result_perfil3){
            header('location: ../templates/perfil.php');
            exit();
    }
?>