<!doctype html>
<html lang="pt-br">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
    <link rel="shortcut icon" href="img/icone.png" type="image/x-icon" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/buscarEvento.css">
  <link rel="stylesheet" type="text/css" href="css/navbar.css">
  <link href="https://fonts.googleapis.com/css?family=Rock+Salt|Sintony" rel="stylesheet">
  <title>Buscar eventos</title>
</head>
<body>

  <?php

  session_start();
  $_SESSION['pagina'] = 'buscarEvento.php';
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

  ?>

  <section class="testimonial-section">  
   <div class="container">
    <div class="row text-center pb-3">
     <div class="col-12">
      <div class="fonteHoje titulo mt-5 mb-3"><span class="fontePrincipal">Eventos</span></div>
    </div>
  </div>

  <div class="row justify-content-center text-center">
    <div class="col-md-7">
      <div class="custom-control custom-radio custom-control-inline marginTop">
        <input type="radio" id="rbEvento" name="rbEvento" class="custom-control-input" checked="true">
        <label class="custom-control-label" for="rbEvento">Pesquisar pelo evento</label>
      </div>
      <div class="custom-control custom-radio custom-control-inline marginTop">
        <input type="radio" id="rbData" name="rbEvento" class="custom-control-input">
        <label class="custom-control-label" for="rbData">Pesquisar por data</label>
      </div>

      <form action="" method="GET">
        <div class="input-group mb-5 mt-5">
          <input type="text" class="form-control" placeholder="Digite o nome do evento..." aria-label="Recipient's username" id="txtPesquisaNome" name="txtPesquisaNome" aria-describedby="button-addon2" required>
          <div class="input-group-append">
            <button class="btn btn-outline-primary" type="submit" id="btPesquisarNome">Pesquisar</button>
          </div>
        </div>

        <div class="form-row">
          <div class="col-md-5 mb-3">
            <label for="validationDefault01">A partir de</label>
            <input type="date" class="form-control" id="txtApartir" name="txtApartir" required disabled="true">
          </div>
          <div class="col-md-5 mb-3">
            <label for="validationDefault02">Até</label>
            <input type="date" class="form-control" id="txtAte" name="txtAte" required disabled="true">
          </div>
          <div class="col-md-2 marginTop mb-5">
            <button class="btn btn-outline-primary" type="submit" id="btPesquisarData" disabled="true">Pesquisar</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <div class="row mt-2">
    <div class="col-md-12">
      <div id="testimonial-slider" class="owl-carousel">


        <?php  
        require_once 'php_action/db_connect.php';
        if (isset($_GET['txtPesquisaNome'])) {
          $nome = $_GET['txtPesquisaNome'];

          $sql = "select * from tbl_evento as e inner join tbl_usuario as u INNER join tbl_img as i on u.cod_usuario = e.cod_usuario and e.cod_evento = i.cod_evento WHERE i.principal = 's' and e.situacao = 'a' and e.nm_evento LIKE '%".$nome."%'";

          $resultado = mysqli_query($connect,$sql);
          if (mysqli_num_rows($resultado)>0) {


            while ($dados = mysqli_fetch_array($resultado)) {

              $foto = "img/imgUsuario/".$dados['nm_img'];
              ?>


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
                <h3 class="title"><?= $dados['nm_evento'] ?></h3><br>
                <small class="post mb-2"><?= $dados['cidade'] ?></small>
                <p class="description"><?= $dados['descricao']?></p>
                <small class="post mb-2 corPreco">R$ <?= $dados['valor'] ?></small>
                <br>
                <a href="infoEvento.php?id=<?= $dados['cod_evento']?>" class="btn btn-outline-primary margembtAbrirEvento mt-2">Abrir Evento</a>
              </div>

              <?php 
            }
          }
          else{
            ?>
            <div class="container mt-4">
              <div class="row justify-content-center text-center">
                <div class="col-md-5">
                  <h3 class="textoNormal">Não possuem eventos correspondentes a pesquisa</h3>
                </div>
              </div>
            </div>
            <?php
          }
        }



        if (isset($_GET['txtApartir'])) {
          $inicio = $_GET['txtApartir'];
          $fim = $_GET['txtAte'];


          $sql = "select * from tbl_evento as e inner join tbl_usuario as u INNER join tbl_img as i on u.cod_usuario = e.cod_usuario and e.cod_evento = i.cod_evento WHERE i.principal = 's' and e.situacao = 'a' and e.dt_inicio >= '$inicio' and e.dt_fim <= '$fim'";

          $resultado = mysqli_query($connect,$sql);
          if (mysqli_num_rows($resultado)>0) {


            while ($dados = mysqli_fetch_array($resultado)) {

              $foto = "img/imgUsuario/".$dados['nm_img'];
              ?>


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
                <h3 class="title"><?= $dados['nm_evento'] ?></h3><br>
                <small class="post mb-2"><?= $dados['cidade'] ?></small>
                <p class="description"><?= $dados['descricao']?></p>
                <small class="post mb-2 corPreco">R$ <?= $dados['valor'] ?></small>
                <br>
                <a href="infoEvento.php?id=<?= $dados['cod_evento']?>" class="btn btn-outline-primary margembtAbrirEvento mt-2">Abrir Evento</a>
              </div>

              <?php 
            }
          }
          else{
            ?>
            <div class="container mt-4">
              <div class="row justify-content-center text-center">
                <div class="col-md-5">
                  <h3 class="textoNormal">Não possuem eventos correspondentes a pesquisa</h3>
                </div>
              </div>
            </div>
            <?php
          }
        }
        ?>

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
<script type="text/javascript">
  $('#rbEvento').change(function(){
    $("#txtPesquisaNome").prop('disabled', false);
    $("#btPesquisarNome").prop('disabled', false);

    $("#txtApartir").prop('disabled', true);
    $("#txtAte").prop('disabled', true);
    $("#btPesquisarData").prop('disabled', true);
  });
  
  $('#rbData').change(function(){
    $("#txtPesquisaNome").prop('disabled', true);
    $("#btPesquisarNome").prop('disabled', true);

    $("#txtApartir").prop('disabled', false);
    $("#txtAte").prop('disabled', false);
    $("#btPesquisarData").prop('disabled', false);
  });

  function dataAtualFormatada(){
    var data = new Date(),
    dia  = data.getDate().toString(),
    diaF = (dia.length == 1) ? '0'+dia : dia,
        mes  = (data.getMonth()+1).toString(), //+1 pois no getMonth Janeiro começa com zero.
        mesF = (mes.length == 1) ? '0'+mes : mes,
        anoF = data.getFullYear();
        return anoF+"-"+mesF+"-"+diaF;
      }   

      $('#txtApartir').focusout(function(){
        if ($(this).val()< dataAtualFormatada()) {
          alert("Insira uma data maior que o dia atual.");
          $(this).val('');
        }
        $('#txtAte').focusout();
      });

      $('#txtAte').focusout(function(){
        var dt1 = $('#txtApartir').val();
        var dt2 = $('#txtAte').val();
        if ((dt1.length > 0 && dt2.length > 0) && dt1 > dt2) {
          alert("A data de fim deve ser maior que a de início");
          $('#txtAte').val('');
        }
      });
    </script>
  </body>
  </html>