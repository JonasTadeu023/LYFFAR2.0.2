<?php
    session_start();
    include('../functions/verificacao.php');
    include('../functions/dbh.php');
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    $result3 = "DELETE FROM amizade WHERE amizade_id = '$id'";
    $result_perfil3 = mysqli_query($connect, $result3);
        if($result_perfil3){
            header('location: ../templates/perfil.php');
            exit();
    }
?>