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
        .logo_img {width: 65px; margin-top: -10px;}
        .perf_img {width: 40px; margin-top: 13px; margin-right: 0px}
    </style>
</head>
<body>
    <!--Side bar fodahhhh-->
    <ul id="slide-out" class="sidenav sidenav-fixed grey darken-4 z-depth-5">
        <a href="#"><img src="../imgs/logo1.png" class="logo_img" style="margin-top:10px;margin-left:30px;"></a>
        <li class="tab"><a href="cadastro.php"><i class="white-text material-icons">person_add</i><p class="white-text"> Criar conta</p></a></li>
        <li class="tab "><a href="login.php"><i class="white-text material-icons">people</i><p class="white-text">Entrar em sua conta</p></a></li>
        <li class="tab "><a href="../linha.php"><i class="white-text material-icons">book</i><p class="white-text">Linha do tempo</p></a></li>
        <li class="tab"><a href="../postagens.php"><i class="white-text material-icons">photo_library</i><p class="white-text">Lembranças do IFFAR-FW</p></a></li>
    </ul>

    <br><br><br><br>
        
    <div class="row">
      <div class="container " id="cadastro" >
        <div class="card hoverable center-align col s6 offset-s5 grey lighten-3">
          <div class="card-content black-text">
            <span class="card-title">Cadastro</span>
              <form class="col s12" method="POST" action="../actions/cadastro.php" enctype="multipart/form-data">
                <p>
                  <div class="input-field">
                    <i class="material-icons prefixe">people</i><input class="validate" name="nome" placeholder="Joaquim Nabuco" id="nome_cad" type="text" required="required">
                    <label for="nome_cad">Seu nome completo</label>
                  </div>
                <p>
                <p>
                  <div class="input-field">
                    <i class="material-icons prefixe">mail_outline</i><input class="validate" name="email" placeholder="contato@htmlecsspro.com" id="email_cad" type="email" required="required">
                    <label for="email_cad">Seu e-mail</label>
                  </div>
                <p>
                <p>
                  <div class="input-field ">
                    <i class="material-icons prefixe">vpn_key</i><input class="validate" name="senha" placeholder="ex. 1234" id="senha_cad" type="password" required="required">
                    <label for="senha_cad">Sua senha</label>
                  </div>
              
                    <div class="file-field input-field">
                      <div class="btn waves-effect waves-light #673ab7 grey darken-4  z-depth-5">
                        <span>Foto de perfil</span>
                        <input name="arquivo" required="required" type="file">
                      </div>
                      <div class="file-path-wrapper">
                        <input class="file-path validate" type="text">
                      </div>
                    </div>
                    <button class="btn waves-effect waves-light #673ab7 grey darken-4 z-depth-2" type="submit" name="action">Cadastrar-se</button>
                    <br><br>
                </form>
                
        </div>
        
</body>
</html>