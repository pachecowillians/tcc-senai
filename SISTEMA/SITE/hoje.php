<!doctype html>
<html lang="pt-br">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
    <link rel="shortcut icon" href="img/icone.png" type="image/x-icon" />

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
  
  <link rel="stylesheet" type="text/css" href="css/navbar.css">
  <link rel="stylesheet" type="text/css" href="css/hoje.css">
  <link href="https://fonts.googleapis.com/css?family=Rock+Salt|Sintony" rel="stylesheet">
  <title>Hoje</title>
</head>
<body>

  <?php
  
  include_once 'php_action/mensagem.php';
  require_once 'php_action/db_connect.php';
  if (isset($_SESSION['logado'])) {
    if ($_SESSION['logado'] == true) {
      include_once 'navbar/logado.php';
    }
    else{
      include_once 'navbar/semLogar.php';
    }
  }
  else{
    include_once 'navbar/semLogar.php';
  }
  $_SESSION['pagina'] = 'hoje.php';
  ?>

  <section class="testimonial-section">  
   <div class="container">
    <div class="row text-center pb-5">
     <div class="col-12">
      <div class="titulo fonteHoje mt-4">Hoje</div>
    </div>
  </div>

  <?php
  $date = date('Y-m-d');
  $data = date('d-m-Y');
  $sql = "select * from tbl_evento as e inner join tbl_usuario as u inner join tbl_img as i on u.cod_usuario = e.cod_usuario and e.cod_evento = i.cod_evento where i.principal = 's' and e.situacao = 'a' and e.dt_inicio = '$date'";

  $resultado = mysqli_query($connect,$sql);
  echo mysqli_error($connect);
  if (mysqli_num_rows($resultado)>0) {


    while ($dados = mysqli_fetch_array($resultado)) {

      $foto = "img/imgUsuario/".$dados['nm_img'];

      ?>
      <div class="row">
        <div class="col-md-12">
          <div id="testimonial-slider" class="owl-carousel">
            <div class="testimonial">
              <div class="pic">
                <table style="height: 120px;">
                  <tbody>
                    <tr>
                    <td class="align-middle"><img src="<?= $foto ?>"></td>
                    </tr>
                  </tbody>
                </table>
                
              </div>
              <h3 class="title" value=""><?= $dados['nm_evento'] ?></h3><br>
              
              <br>
              <small class="post mb-2"><?= $dados['cidade'] ?></small>
              <p class="description"><?= $dados['descricao']?></p>
              <small class="post mb-2 corPreco">R$ <?= $dados['valor'] ?></small>
              <br>
              <a href="infoEvento.php?id=<?= $dados['cod_evento']?>" class="btn btn-outline-primary margembtAbrirEvento mt-2">Abrir Evento</a>

            </div>
          </div>
        </div>
      </div>
      
      <?php
      
    }
    if (mysqli_num_rows($resultado)==1) {
      ?>
      <br>
      <br>
      <br>
      <br>
      <br>
      <?php
    } 
  }
  else{
    ?>
    <div class ="row">
      <div class="col-md-12 text-center mt-5">
        <h1 class="textoNormal mt-3">Não há eventos para o dia de hoje</h1>
        <h1 class="textoNormal mt-5">(<?= "$data" ?>)</h1>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>

      </div>
    </div>
    <?php
  }
  

  ?>

</div>
</div>
</div>
</div>
</div>
</section>
<?php 
include_once 'navbar/footer.php'
?>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
<script type="text/javascript" src="js/hoje.js"></script>
<script type="text/javascript">$('#modalInfo').modal('show');</script>
</body>
</html>