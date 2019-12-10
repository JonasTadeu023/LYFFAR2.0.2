<?php
    session_start();
    include('../functions/verificacao.php');
    include('../functions/dbh.php');
    
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    $nome = $_SESSION['nome'];

    $query = "SELECT * from denuncia_coment WHERE denuncia_usu = '$nome' and coment_id = '$id'";
    $result = mysqli_query($connect, $query) or die(mysqli_error($connect));
    $row = mysqli_num_rows($result);

    if ($row == 0){
        $result = "INSERT INTO denuncia_coment (coment_id, denuncia_usu, data_denun) VALUES ('$id', '$nome', NOW())";
        $result_perfil = mysqli_query($connect, $result);
        if($result_perfil){
            echo "<script> window.history.back();</script>";
        }
    }

    if ($row > 0){
        $result1 = "DELETE FROM denuncia_coment WHERE denuncia_usu = '$nome' and coment_id = '$id'";
        $result_perfil1 = mysqli_query($connect, $result1);
        if($result_perfil1){
            echo "<script> window.history.back();</script>";
        }
    } 


?>