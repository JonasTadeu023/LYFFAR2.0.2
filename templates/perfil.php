<?php
    session_start();
    include('../functions/verificacao.php');
    include('../functions/dbh.php');
    $usuario = $_SESSION['email'];
  
    $sql = mysqli_query($connect, "SELECT * FROM users WHERE user_email = '$usuario'");
    while ($linha = mysqli_fetch_array($sql)) {
      $foto = $linha['user_foto'];
      $nome = $linha['user_nome'];
      $foto = $linha['user_foto'];
      $idu = $linha['user_id'];
      $lvl = $linha['lvl'];
    }
    $_SESSION['idu'] = $idu;
    $_SESSION['nome'] = $nome;
    $_SESSION['foto'] = $foto;
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

    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>

    <title>LYFFAR</title>
    <style>  
        .logo_img {width: 65px; margin-top: -10px; margin-left:40px}
        .perf_img {width: 200px; margin-top: 13px; margin-left: 450px}
    </style>
</head>
<body>

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

    <ul id="slide-out" class="sidenav sidenav-fixed grey darken-4 col s1" style="margin-left:1225px">
        <li><a class="subheader white-text center" href="#"> Amigos</a></li>
        <?php
            $sql = "SELECT * from amizade WHERE amigo_1 = '$idu' OR amigo_2 = '$idu'";
            $result2 = mysqli_query($connect, $sql);

            while ($post1 = mysqli_fetch_array($result2)) {
                $amigo1 = $post1['amigo_1'];
                $amigo2 = $post1['amigo_2'];

                if($amigo1 == $idu){
                    $sql = "SELECT * FROM users WHERE user_id = '$amigo2'";

                    $resultado1 = mysqli_query($connect, $sql);
                    foreach ($resultado1 as $rows1){
                        $nomeusu = $rows1['user_nome'];
                        $fotousu = $rows1['user_foto'];
                        $ida = $rows1['user_id'];
                        echo "
                            <a href='../actions/perfil.php?id=$ida'><img src='../users/$nomeusu/$fotousu' class='left' style='width: 50px; margin-top: 13px; margin-left: 2px;border-radius:5px'> </a>
                            <h5 class=' white-text center'>$nomeusu</h5>
                            <br>";
                    }
                } 
               
                else{
                    $sql2 = "SELECT * FROM users WHERE user_id = '$amigo1'";

                    $resultado2 = mysqli_query($connect, $sql2);
                    foreach ($resultado2 as $rows2){
                        $nomeusu2 = $rows2['user_nome'];
                        $fotousu2 = $rows2['user_foto'];
                        $ida1 = $rows2['user_id'];
                        echo "
                            <a  href='../actions/perfil.php?id=$ida1'><img src='../users/$nomeusu2/$fotousu2' class='left' style='width: 50px; margin-top: 13px; margin-left:2px;border-radius:5px'> </a>
                            <h5 class=' white-text center'>$nomeusu2</h5>
                            <br>";
                            
                    }
                }
            }
            echo" <li><div class='divider'> chat</div></li>";
        ?>
    </ul>

    <div class="row">
        <div class="col s12 m6 l6 grey darken-3 " style="margin-left:375px;">
            <img <?php echo "src='../users/$nome/$foto'"?>style="width: 200px; margin-top: 13px; margin-left: 80px;border-radius:150px">
        </div>
    </div>

    <div class="row">
        <div class="col s12 m6 l6 grey z-depth-5 " style="margin-left:375px; margin-top:-19px">
            <h5 class=" white-text" style="margin-left:80px;fo"><?php echo $nome?></h5>
            <p class=" white-text" style="margin-left:80px"><?php echo $usuario; ?></p>
            <p class=" white-text" style="margin-left:80px"><?php 
            if($lvl == 1){
                echo 'Administradorª';}; 
            ?></p>
            <a href="editar.php?id=<?php echo $idu?>" class="waves-effect grey darken-4 btn-large right" style="margin-top:-70px;margin-bottom:20px"><i class="material-icons right">border_color</i>Editar perfil</a>
        </div>
    </div>

    <?php
        $sql1 = mysqli_query($connect, "SELECT * FROM postagens WHERE post_usuario = '$nome' ORDER BY post_data DESC");

          while ($post1 = mysqli_fetch_array($sql1)) {
            $fotopos = $post1['post_foto'];
            $legenda = $post1['post_legenda'];   
            $descricao = $post1['post_descricao'];
            $id = $post1['post_id'];
            $_SESSION['id'] = $id;
            
      ?>
    <div class="row">
        <div class="col s12 m6 l6 grey darken-4 z-depth-5 center" style="margin-left:375px; margin-top:-18px">
            <h5 class=" white-text" ><?php echo $legenda?></h5>
            <img style="border-radius:15px;height:150px;"<?php echo "src='../users/$nome/$fotopos'"?>>
            <h6 class=" white-text" ><?php echo $descricao?></h6>
            <a href="#modal1" class="btn-floating  waves-light grey darken-4 modal-trigger" style="margin-right:800px;"><i class="material-icons ">delete</i></a>
            <?php echo "<a href='../actions/editarpost.php?id=$id' class='btn-floating  waves-light grey darken-4 modal-trigger' style='margin-left:-600px;margin-top:-67px'><i class='material-icons '>edit</i></a>"?>
                <!-- Modal Structure -->
          <div id="modal1" class="modal">
            <div class="modal-content">
              <h4>Apagar</h4>
              <p>Deseja realmente apagar esta postagem?</p>
            </div>
            <div class="modal-footer">
              <a href="../actions/denunciar.php" class="modal-close waves-effect waves-green btn-flat">Sim</a>
            </div>
          </div>
        </div>
    </div>
    <?php } ?>

    <!-- Compiled and minified CSS -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
  document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.modal');
    var instances = M.Modal.init(elems, options);
  });

  // Or with jQuery

  $(document).ready(function(){
    $('.modal').modal();
  });
</script>
</body>
</html>