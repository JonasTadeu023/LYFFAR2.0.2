<?php
    session_start();
    include('../functions/verificacao.php');
    include('../functions/dbh.php');
    
    $id = $_SESSION['id'];
    $nome = $_SESSION['nome'];

    $sql = "SELECT * from postagens WHERE post_usuario = '$nome' and post_id = '$id'";
    $result2 = mysqli_query($connect, $sql) or die(mysqli_error($connect));
    $row2 = mysqli_num_rows($result2);
    if($row2 > 0){
        $result3 = "DELETE FROM postagens WHERE post_usuario = '$nome' and post_id = '$id'";
        $result_perfil3 = mysqli_query($connect, $result3);
        if($result_perfil3){
            header('location: ../templates/perfil.php');
            exit();
        }
    }

    $query = "SELECT * from denuncias WHERE denuncia_usu = '$nome' and post_id = '$id'";
    $result = mysqli_query($connect, $query) or die(mysqli_error($connect));
    $row = mysqli_num_rows($result);

    if ($row == 0){
        $result = "INSERT INTO denuncias (post_id, denuncia_usu, denuncia_date) VALUES ('$id', '$nome', NOW())";
        $result_perfil = mysqli_query($connect, $result);
        if($result_perfil){
            echo "<script> window.history.back();</script>";
        }
    }

    if ($row > 0){
        $result1 = "DELETE FROM denuncias WHERE denuncia_usu = '$nome' and post_id = '$id'";
        $result_perfil1 = mysqli_query($connect, $result1);
        if($result_perfil1){
            echo "<script> window.history.back();</script>";
        }
    } 


?>