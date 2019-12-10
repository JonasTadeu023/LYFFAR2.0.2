<?php
    session_start();
    include('functions/dbh.php');
    
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
        <a href="#!"><img src="imgs/logo1.png" class="logo_img" style="margin-top:10px;margin-left:30px;"></a>
        <li class="tab"><a href="templates/cadastro.php"><i class="white-text material-icons">person_add</i><p class="white-text"> Criar conta</p></a></li>
        <li class="tab "><a href="templates/login.php"><i class="white-text material-icons">people</i><p class="white-text">Entrar em sua conta</p></a></li>
        <li class="tab"><a href="postagens.php"><i class="white-text material-icons">photo_library</i><p class="white-text">Lembranças do IFFAR-FW</p></a></li>
    </ul>

    <div class="row ">
        <div class="col s12 m6 l6  grey darken-4  " style="margin-left:375px; margin-top:-19px">
            <h5 class=" white-text center left" >Lembranças</h5 >
        </div>
    </div>

    <?php
        $sql1 = mysqli_query($connect, "SELECT * FROM postagens ORDER BY post_data DESC");

          while ($post1 = mysqli_fetch_array($sql1)) {
            $id = $post1['post_id'];
            $usuario = $post1['post_usuario'];
            $datapost = $post1['post_data'];
            $fotousu = $post1['post_fotousu'];
            $fotopos = $post1['post_foto'];
            $legenda = $post1['post_legenda'];   
            $descricao = $post1['post_descricao'];
      ?>
    <div class="row">
        <div class="col s12 m6 l6  grey darken-4 center" style="margin-left:375px; margin-top:-18px">
            <img <?php echo "src='users/$usuario/$fotousu'"?> class="left" style="width: 50px; margin-top: 13px; margin-left: 80px;border-radius:5px"> 
            <h6 class=" white-text right" ><?php echo "$usuario -"?><?php echo date('d/m/Y', strtotime($datapost))?></h6>
            <br><br>
            <h5 class=" white-text center" ><?php echo $legenda?></h5>
            
            <?php echo "<a href='templates/login.php'> <img style='border-radius:15px;height:150px;shadow-color:white' class='hoverable '  src='users/$usuario/$fotopos'></a>" ?>
            
            <br>
        </div>
    </div>
    <?php } ?>
</body>
</html>