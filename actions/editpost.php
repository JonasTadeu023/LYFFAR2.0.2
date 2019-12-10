<?php
  session_start();
  include('../functions/verificacao.php');
  include('../functions/dbh.php');

  $id = $_SESSION['id_post1'];
  $arquivo = $_FILES['arquivo']['name'];
  $legenda = mysqli_real_escape_string($connect, trim($_POST['legenda']));
  $recordacao = mysqli_real_escape_string($connect, trim($_POST['descricao']));
  $datafoto = mysqli_real_escape_string($connect, trim($_POST['ano']));

  $result = "UPDATE postagens SET post_legenda = '$legenda', post_descricao = '$recordacao', post_ano = '$datafoto' WHERE post_id = '$id'";
  $result_perfil = mysqli_query($connect, $result);


      $connect->close();
      header('location: ../templates/perfil.php');
      exit();

?>