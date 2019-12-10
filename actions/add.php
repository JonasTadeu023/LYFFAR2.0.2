<?php
    session_start();
    include('../functions/verificacao.php');
    include('../functions/dbh.php');
    
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    $id_usu = $_SESSION['idu'];

    $result = "INSERT INTO amigos (amigo_1, amigo_2, sim, nao, data_amizade) VALUES ('$id_usu', '$id', 'Sim', 'Não', NOW())";
    $result_perfil = mysqli_query($connect, $result);
    
    if($result_perfil){
        echo "<script> window.history.back();</script>";
    }
?>