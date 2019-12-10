<?php
    session_start();
    include('../functions/verificacao.php');
    include('../functions/dbh.php');
    
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    $_SESSION['id_post1'] = $id;

    $sql = mysqli_query($connect, "SELECT * FROM postagens WHERE post_id = '$id'");
    while ($linha = mysqli_fetch_array($sql)) {
      $legenda = $linha['post_legenda'];
      $descricao = $linha['post_descricao'];
      $ano =$linha['post_ano'];
      $foto =$linha['post_foto'];
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    <!-- link de icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <title>LYFFAR</title>
    <style>  
        .logo_img {width: 65px; margin-top: -10px; margin-left:40px}
        .perf_img {width: 200px; margin-top: 13px; margin-left: 450px}
    </style>
</head>
<body>
    <!--Side bar fodahhhh-->
    <!--Side bar fodahhhh-->
    <ul id="slide-out" class="sidenav sidenav-fixed grey darken-4 z-depth-5">
        <a href="postagens.php"><img src="../imgs/logo1.png" class="logo_img" style="margin-top:10px"></a>
        <li class="tab"><a href="perfil.php"><i class="material-icons white-text">people</i><p class="white-text"> Perfil</p></a></li>
        <li class="tab"><a href="postar.php"><i class="material-icons white-text">add_to_photos</i><p class="white-text"> Relembrar</p></a></li>
        <li class="tab"><a href="postagens.php"><i class="material-icons white-text">access_time</i><p class="white-text"> Lembranças</p></a></li>
        <li class="tab"><a href="../actions/notificacoes.php"><i class="material-icons white-text">notifications</i><p class="white-text"> notificações</p></a></li>
        <li class="tab" style="margin-top:220px"><a href="../functions/logout.php"><i class="material-icons white-text">close</i><p class="white-text"> Sair</p></a></li>
        <nav class="grey darken-4">
        <div class="nav-wrapper" style="margin-top:-250px; margin-left:30px; margin-right:10px">
            <form action="../actions/procurar.php" method="POST">
                <div class="input-field">
                    <input id="search" type="search" name="pesquisar" class="transparent white-text">
                    <label class="label-icon" for="search"> <i class="material-icons white-text">search</i></label>
                    <i class="material-icons white-text">close</i>
                </div>
            </form>
        </div>
        </nav>
    </ul>

    <br><br><br><br>
        
        <div class="row">
          <div class="container col s12" id="cadastro" >
            <div class="card hoverable center-align col s6 offset-s5 grey lighten-3">
              <div class="card-content black-text">
                <span class="card-title">Editar lembrança</span>
                  <form class="col s12" method="POST" action="editpost.php" enctype="multipart/form-data">
                    <p>
                      <div class="input-field">
                        <i class="material-icons prefixe"></i><input class="validate" name="legenda" value="<?php echo $legenda ?>" id="nome_cad" type="text" required="required">
                        <label for="nome_cad">Legenda </label>
                      </div>
                    <p>
                    <p>
                      <div class="input-field">
                        <i class="material-icons prefixe"></i><input class="validate" name="descricao" value="<?php echo $descricao ?>" id="email_cad" type="text" required="required">
                        <label for="email_cad">História/recordações</label>
                      </div>
                    <p>
                    <p>
                      <div class="input-field ">
                        <i class="material-icons prefixe"></i><input class="validate" name="ano"  value="<?php echo $ano ?>" id="senha_cad" type="number" required="required">
                        <label for="senha_cad">Ajude-nos a construir a nossa linha do tempo!!! Pode-nos dizer o ano desta foto</label>
                      </div>
                  
                        <div class="file-field input-field">
                          <div class="btn waves-effect waves-light #673ab7 grey darken-4">
                            <span>Fotos que deseja compartilhar</span>
                            <input name="arquivo" type="file">
                          </div>
                          <div class="file-path-wrapper">
                            <input class="file-path validate" value="<?php echo $foto ?>" type="text">
                            <br>
                          </div>
                          <br>
                        </div>
                        <button class="btn waves-effect waves-light #673ab7 grey darken-4" type="submit" name="action">Editar</button>
                        <br>
                    </form>
                    <br>
            </div>     
</body>
</html>