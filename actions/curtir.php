<?php
    session_start();
    include('../functions/verificacao.php');
    include('../functions/dbh.php');
    
    $id = $_SESSION['id'];
    $nome = $_SESSION['nome'];

    $query = "SELECT * from curtidas where like_usuario = '$nome' and like_post = '$id'";
    $result = mysqli_query($connect, $query) or die(mysqli_error($connect));
    $row = mysqli_num_rows($result);

    if ($row == 0){
        $result = "INSERT INTO curtidas (like_usuario, like_post, like_data) VALUES ('$nome', '$id', NOW())";
        $result_perfil = mysqli_query($connect, $result);
        if($result_perfil){
            echo "<script> window.history.back();</script>";
        }
    }

    if ($row > 0){
        $result1 = "DELETE FROM curtidas WHERE like_usuario = '$nome' and like_post = '$id'";
        $result_perfil1 = mysqli_query($connect, $result1);
        if($result_perfil1){
            echo "<script> window.history.back();</script>";
        }
    } 
?>