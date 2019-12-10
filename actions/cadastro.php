<?php
    session_start();
    include('../functions/dbh.php');

    $nome = mysqli_real_escape_string($connect, trim($_POST['nome']));
    $email = mysqli_real_escape_string($connect, trim($_POST['email']));
    $senha = mysqli_real_escape_string($connect, trim(md5($_POST['senha'])));
    $image = $_FILES['arquivo']['name'];

    $sql = "SELECT count(*) as total from users where user_email = '$email'";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($result);

    if ($row['total'] == 1) {
      $_SESSION['Usuario com este email já existe!!!'] = true;
      header('location: ../index.html');
      $connect->close();
      exit();
    }

    $result = "INSERT INTO users (user_nome, user_email, user_senha, user_foto, user_newdate) VALUES ('$nome', '$email', '$senha', '$image', NOW())";
    $result_perfil = mysqli_query($connect, $result);

    $pastausu = '../users/'.$nome.'/';
    mkdir($pastausu, 0777);

    if (move_uploaded_file($_FILES['arquivo']['tmp_name'],$pastausu.$image)) {
      if ($connect->query($sql) == TRUE) {
          $_SESSION['Cadastro concluido com sucesso!!!'] = true;
        }
        $connect->close();
        header('location: ../templates/login.php');
        exit();
    }
?>