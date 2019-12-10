<?php
    session_start();
    include('../functions/verificacao.php');
    include('../functions/dbh.php');
    $id_usu = $_SESSION['idu'];
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
        <li class="tab"><a href="../templates/perfil.php"><i class="material-icons white-text">people</i><p class="white-text"> Perfil</p></a></li>
        <li class="tab"><a href="../templates/postar.php"><i class="material-icons white-text">add_to_photos</i><p class="white-text"> Relembrar</p></a></li>
        <li class="tab"><a href="../templates/postagens.php"><i class="material-icons white-text">access_time</i><p class="white-text"> Lembranças</p></a></li>
        <li class="tab"><a href="notificacoes.php"><i class="material-icons white-text">notifications</i><p class="white-text"> notificações</p></a></li>
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
            $sql = "SELECT * from amizade WHERE amigo_1 = '$id_usu' OR amigo_2 = '$id_usu'";
            $result2 = mysqli_query($connect, $sql);

            while ($post1 = mysqli_fetch_array($result2)) {
                $amigo1 = $post1['amigo_1'];
                $amigo2 = $post1['amigo_2'];

                if($amigo1 == $id_usu){
                    $sql = "SELECT * FROM users WHERE user_id = '$amigo2'";

                    $resultado1 = mysqli_query($connect, $sql);
                    foreach ($resultado1 as $rows1){
                        $nomeusu = $rows1['user_nome'];
                        $fotousu = $rows1['user_foto'];
                        $ida = $rows1['user_id'];
                        echo "
                            <a href='perfil.php?id=$ida'><img src='../users/$nomeusu/$fotousu' class='left' style='width: 50px; margin-top: 13px; margin-left: 2px;border-radius:5px'> </a>
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
                            <a href='perfil.php?id=$ida1'><img src='../users/$nomeusu2/$fotousu2' class='left' style='width: 50px; margin-top: 13px; margin-left:2px;border-radius:5px'> </a>
                            <h5 class=' white-text center'>$nomeusu2</h5>
                            <br>";
                            
                    }
                }
            }
            echo" <li><div class='divider'> chat</div></li>";
        ?>
    </ul>
    <div class="row ">
        <div class="col s12 m6 l6  grey darken-4  " style="margin-left:375px; margin-top:-19px">
            <h5 class=" white-text center left" >notificações</h5 >
        </div>
    </div>
   <?php
    $query = "SELECT * from users WHERE user_id = '$id_usu' and lvl = '1'";
    $result = mysqli_query($connect, $query) or die(mysqli_error($connect));
    $row = mysqli_num_rows($result);
   
    if ($row == 0){
    $result = "SELECT * FROM amigos WHERE amigo_2 = '$id_usu'";
    $resultado= mysqli_query($connect, $result);
    while($rows = mysqli_fetch_array($resultado)){
        $id_amizade = $rows['id_amizade'];
        $id_amigo = $rows['amigo_1'];
        $um = $rows['sim'];
        $dois = $rows['nao'];

        $_SESSION['id_amizade'] = $id_amizade;
        $_SESSION['id_amigo'] = $id_amigo;

        $sql = "SELECT * FROM users WHERE user_id = '$id_amigo'";

        $resultado1 = mysqli_query($connect, $sql);
        foreach ($resultado1 as $rows1){
            $nome = $rows1['user_nome'];

            $my_array = array("$um", "$dois");
   
   echo" <div class='row'>";
        echo "<div class='col s12 m6 l6  grey darken-4 center' style='margin-left:375px; margin-top:-18px'>";
        echo "<h5 class=' white-text center'> Você deseja aceitar o pedido de amizade de $nome</h5>";
        foreach($my_array as $ops){
          echo"  
            <form action='confirma.php' method='POST'>
                <p>
                    <label>
                        <input type='radio'  name='hue' value='$ops' >
                        <span>$ops</span>
                    </label>
                </p>

            ";

            }
        }}}else{ 
            
                $result2 = "SELECT * FROM denuncias";
                $resultado2= mysqli_query($connect, $result2);
                while($post2 = mysqli_fetch_array($resultado2)){
                    $iddenun = $post2['denuncia_id'];
                    $idpost = $post2['post_id'];
                    
                    $sql5 = "SELECT * FROM postagens WHERE post_id = '$idpost'";

                    $resultado5 = mysqli_query($connect, $sql5);
                    foreach ($resultado5 as $rows5){
                        $id = $rows5['post_id'];
                        $usuario = $rows5['post_usuario'];
                        $datapost = $rows5['post_data'];
                        $fotousu = $rows5['post_fotousu'];
                        $fotopos = $rows5['post_foto'];
                        $legenda = $rows5['post_legenda'];   
                        $descricao = $rows5['post_descricao'];

                        echo "<div class='row'>
                        <div class='col s12 m6 l6  grey darken-4 center' style='margin-left:375px; margin-top:-18px'>
                            <img 'src='../users/$usuario/$fotousu' class='left' style='width: 50px; margin-top: 13px; margin-left: 80px;border-radius:5px'> 
                            <h6 class=' white-text right' > $usuario </h6>
                            <br><br>
                            <h5 class=' white-text center' > $legenda</h5>
                            
                             <a href='../actions/postagem.php?id=$id'> <img style='border-radius:15px;height:150px;shadow-color:white' class='hoverable '  src='../users/$usuario/$fotopos'></a>
                            
                            <br>
                            <a href='#modal1' class='btn-floating  waves-light grey darken-4 modal-trigger' style='margin-right:800px;'><i class='material-icons '>delete</i></a>
                            <a href='delet_denuncia.php?id=$iddenun' class='btn-floating  waves-light grey darken-4 ' style='margin-right:860px;'><i class='material-icons '>thumb_up</i></a>
                        </div>
                    </div>";
                    }
                }
                $result = "SELECT * FROM amigos WHERE amigo_2 = '$id_usu'";
                $resultado= mysqli_query($connect, $result);
                while($rows = mysqli_fetch_array($resultado)){
                    $id_amizade = $rows['id_amizade'];
                    $id_amigo = $rows['amigo_1'];
                    $um = $rows['sim'];
                    $dois = $rows['nao'];
            
                    $_SESSION['id_amizade'] = $id_amizade;
                    $_SESSION['id_amigo'] = $id_amigo;
            
                    $sql = "SELECT * FROM users WHERE user_id = '$id_amigo'";
            
                    $resultado1 = mysqli_query($connect, $sql);
                    foreach ($resultado1 as $rows1){
                        $nome = $rows1['user_nome'];
            
                        $my_array = array("$um", "$dois");
               
               echo" <div class='row'>";
                    echo "<div class='col s12 m6 l6  grey darken-4 center' style='margin-left:375px; margin-top:-18px'>";
                    echo "<h5 class=' white-text center'> Você deseja aceitar o pedido de amizade de $nome</h5>";
                    foreach($my_array as $ops){
                      echo"  
                        <form action='confirma.php' method='POST'>
                            <p>
                                <label>
                                    <input type='radio'  name='hue' value='$ops' >
                                    <span>$ops</span>
                                </label>
                            </p>
            
                        ";
            
                        }}}
            }
            ?>
            <button class='btn waves-effect waves-light #673ab7 grey darken-4' type='submit' name='action'>Responder
            <i class='fa fa-send'></i>
            </button>

<div id="modal1" class="modal">
            <div class="modal-content">
              <h4>Apagar</h4>
              <p>Deseja realmente apagar esta postagem?</p>
            </div>
            <div class="modal-footer">
              <a href="delet.php?id=<?php echo$id; ?>" class="modal-close waves-effect waves-green btn-flat">Sim</a>
            </div>
          </div>
        </div>

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