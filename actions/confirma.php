<?php
    session_start();
    include('../functions/verificacao.php');
    include('../functions/dbh.php');
    
    $id_amizade = $_SESSION['id_amizade'];
    $idu = $_SESSION['idu'];
    $id_amigo = $_SESSION['id_amigo'];

    $resposta = $_POST['hue'];

    $result = "INSERT INTO amizade (amigo_1, amigo_2, data_amizade) VALUES ('$id_amigo', '$idu', NOW())";
    $result_perfil = mysqli_query($connect, $result)or die(mysqli_error($connect)); 

        $sql = "SELECT * from amigos WHERE id_amizade = '$id_amizade'";
        $result2 = mysqli_query($connect, $sql) or die(mysqli_error($connect));
        $row2 = mysqli_num_rows($result2);
        if($row2 > 0){
            $result3 = "DELETE FROM amigos WHERE id_amizade = '$id_amizade'";
            $result_perfil3 = mysqli_query($connect, $result3);
            if($result_perfil3){
                header('location: ../templates/perfil.php');
                exit();
        }
    }
       
?>