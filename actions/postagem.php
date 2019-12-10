<html>
    <head>
        
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

<!-- link de icons -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>

    </head>
</html>
<?php
    session_start();
    include('../functions/verificacao.php');
    include('../functions/dbh.php');
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    $_SESSION['id'] = $id;
    
    $sql1 = mysqli_query($connect, "SELECT * FROM postagens WHERE stats = '1' AND post_id = '$id' ORDER BY post_data DESC");

      while ($post1 = mysqli_fetch_array($sql1)) {
        $id = $post1['post_id'];
        $usuario = $post1['post_usuario'];
        $datapost = $post1['post_data'];
        $fotousu = $post1['post_fotousu'];
        $fotopos = $post1['post_foto'];
        $legenda = $post1['post_legenda'];   
        $descricao = $post1['post_descricao'];
?>
<div class=" grey darken-4">
  <div class="row" style="margin-left:250px">
    <div class="col s12 m9 center">
      <div class="card center">
        <div class="card-image">
          <img <?php echo "src='../users/$usuario/$fotopos'"?>>
          <span class="card-title"><?php echo $legenda?></span>
        <?php
          $sql2 = mysqli_query($connect, "SELECT * FROM curtidas WHERE like_post = '$id'");
          $likes = mysqli_num_rows($sql2);
                    
        ?>
          <a href="curtir.php" class="btn-floating halfway-fab waves-effect waves-light grey darken-4"><i class="material-icons ">favorite_border</i></a>
          <h5 class="btn-floating halfway-fab waves-effect waves-light grey darken-4" style="margin-top:200px;margin-right:50px"><?php echo $likes?></h5>
          <a href="#modal1" class="btn-floating halfway-fab waves-light grey darken-4 modal-trigger" style="margin-right:100px"><i class="material-icons ">flag</i></a>
          <?php echo " <a target='_blank' href='http://www.facebook.com/sharer.php?u=http://inf.fw.iffarroupilha.edu.br/~jonas.saldanha/LYFFAR/actions/postagem.php?id=$id' class='btn-floating halfway-fab waves-light grey darken-4' style='margin-right:150px'><i class='material-icons '>share</i>>Compartilhar FB</a>"?>
          
        <!-- Modal Structure -->
          <div id="modal1" class="modal">
            <div class="modal-content">
              <h4>Denunciar</h4>
              <p>Deseja realmente denunciar esta postagem?</p>
            </div>
            <div class="modal-footer">
              <a href="denunciar.php" class="modal-close waves-effect waves-green btn-flat">Sim</a>
            </div>
          </div>
        </div>
        <div class="card-content">
          <h5> <?php echo $descricao?></h5>
        </div>
        <div class="row">
          <div class="input-field col s6 ">
            <form action="comentar.php" method="POST">
              <label class="active" for="first_name2" style="margin-left:370px">Comentário</label>
              <input id="first_name2" type="text" name="senha" class="validate" required="required"style="margin-left:200px">
              <button style="margin-left:350px" class="btn waves-effect waves-light #673ab7 grey darken-4" type="submit" name="action">Comentar
                  <i class="fa fa-send"></i>
            </form>
            <?php }?>
          </div>  
        </div>
        <div class="card-content">
          <h5> Comentários</h5>
        </div>
        </div>
      </div>
    </div>
  </div>

    <?php
        $sql3 = mysqli_query($connect, "SELECT * FROM comentarios WHERE post_id = '$id' ORDER BY coment_data DESC");
        
        while ($post3 = mysqli_fetch_array($sql3)) {
          $id_coment = $post3['coment_id'];
          $usuario_coment = $post3['coment_usuario'];
          $coment = $post3['coment'];
          $data = $post3['coment_data'];
    ?>
      <div class=" grey darken-4">
        <div class="row" style="margin-left:250px;margin-top:-20px">
          <div class="col s12 m9">
            <div class="card">
              <div class="card-content">
                <p><?php echo $usuario_coment?></p>
                <p style="margin-left:800px;margin-top:-22px"><?php echo date('d/m/Y', strtotime($data))?></p>
                <p><?php echo $coment?></p>
                <?php echo"<a href='denunciar_coment.php?id=$id_coment' class='btn-floating halfway-fab waves-light grey darken-4' style='margin-right:100px'><i class='material-icons '>flag</i></a>" ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php }?>

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