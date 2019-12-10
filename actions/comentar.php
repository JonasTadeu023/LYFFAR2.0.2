<?php
    session_start();
    include('../functions/verificacao.php');
    include('../functions/dbh.php');
    
    $id = $_SESSION['id'];
    $nome = $_SESSION['nome'];
    $coment = mysqli_real_escape_string($connect, trim($_POST['senha']));

    $result = "INSERT INTO comentarios (post_id, coment_usuario, coment, coment_data) VALUES ('$id', '$nome', '$coment', NOW())";
    $result_perfil = mysqli_query($connect, $result);
    
    if($result_perfil){
        echo "<script> window.history.back();</script>";
    }
?>
