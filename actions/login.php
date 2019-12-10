<?php
    session_start();
    include '../functions/dbh.php';
    if (empty($_POST['email']) || empty($_POST['senha'])) {
        header('location: ../viewsmodels/login.php');
        exit();
    }

    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $senha = mysqli_real_escape_string($connect, $_POST['senha']);

    $query = "SELECT * from users where user_email = '{$email}' and user_senha = md5('{$senha}')";
    $result = mysqli_query($connect, $query) or die(mysqli_error($connect));
    $row = mysqli_num_rows($result);
    $dados = mysqli_fetch_assoc($result);

    if ($row == 1) {
        $_SESSION['email'] = $email;
        header('location: ../templates/perfil.php');
        exit();
    } else {
        $connect->close();
        header('location: ../templates/login.php');
        exit();
    }
?>