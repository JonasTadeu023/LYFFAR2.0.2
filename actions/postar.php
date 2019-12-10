<?php
  session_start();
  include('../functions/verificacao.php');
  include('../functions/dbh.php');
  $usuario = $_SESSION['email'];
  $fotousu = $_SESSION['foto'];
  $sql = mysqli_query($connect, "SELECT * FROM users WHERE user_email = '$usuario'");
    while ($linha = mysqli_fetch_array($sql)) {
      $foto = $linha['user_foto'];
      $nome = $linha['user_nome'];
    }

  $arquivo = $_FILES['arquivo']['name'];
  $legenda = mysqli_real_escape_string($connect, trim($_POST['legenda']));
  $recordacao = mysqli_real_escape_string($connect, trim($_POST['descricao']));
  $datafoto = mysqli_real_escape_string($connect, trim($_POST['ano']));

  $result = "INSERT INTO postagens (post_usuario, post_legenda, post_descricao, post_foto, post_ano, stats, post_fotousu, post_data) VALUES ('$nome', '$legenda', '$recordacao', '$arquivo', '$datafoto', '1', '$fotousu', NOW())";
  $result_perfil = mysqli_query($connect, $result);

  $salvar = '../users/'.$nome.'/';

  if (move_uploaded_file($_FILES['arquivo']['tmp_name'],$salvar.$arquivo)) {
    if ($connect->query($sql) == TRUE) {
        $_SESSION['status_cadastro'] = true;
      }
      $connect->close();
      header('location: ../templates/perfil.php');
      exit();
  }

?>
