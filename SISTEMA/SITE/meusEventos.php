<!doctype html>
<html lang="pt-br">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
    <link rel="shortcut icon" href="img/icone.png" type="image/x-icon" />

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/meusEventos.css">
  <link rel="stylesheet" type="text/css" href="css/navbar.css">
  <link href="https://fonts.googleapis.com/css?family=Rock+Salt|Sintony" rel="stylesheet">
  <title>Meus eventos</title>
</head>
<body>

  <?php
  include_once 'php_action/mensagem.php';
  if ($_SESSION['logado'] != true) {
    header("Location: index.php");
  }
  $_SESSION['pagina'] = 'meusEventos.php';
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

  <?php  

  require_once 'php_action/db_connect.php';

  if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];

    $sql = "select * from tbl_usuario where cod_usuario = '$id'";

    $resultado = mysqli_query($connect,$sql);


    $dados = mysqli_fetch_array($resultado);

    $nome = ucfirst ($dados['nm_usuario']);

  }
  ?>
  <div class="container mt-3">
    <div class="row text-center pb-5 justify-content-center">
     <div class="col-12">
      <div class="display-3 mt-5"><span class="tituloMeusEventos fonteHoje titulo"><?= $nome; ?></span></div>
    </div>
  </div>
  <div class="row text-center pb-5 justify-content-center">
   <div class="col-12">
    <!-- Button trigger modal -->
    <?php

    $id = $_SESSION['id'];

    $sql = "select COUNT(u.cod_usuario) as reprovado from tbl_evento as e inner join tbl_usuario as u on e.cod_usuario = u.cod_usuario where e.reprovado = 's' and u.cod_usuario = '$id'";

    $resultado = mysqli_query($connect,$sql);

    $dados = mysqli_fetch_array($resultado)

    ?>
    <div class="fontePequena mt-2 "><a href="#exampleModalCenter" data-toggle="modal">Eventos reprovados (<?= $dados['reprovado']; ?>)</a></div>



    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">Eventos reprovados</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <section class="testimonial-section">  
             <div class="container">

              <div class="row text-center">
                <div class="col-md-12">
                  <div class="display-4 mt-4 mb-4 fontePequena eventosPassados">Eventos reprovados</div>
                  <div id="testimonial-slider" class="owl-carousel">


                    <?php  

                    if (isset($_SESSION['id'])) {
                      $id = $_SESSION['id'];

                      $sql = "select * from tbl_evento as e inner join tbl_usuario as u INNER join tbl_img as i on u.cod_usuario = e.cod_usuario and e.cod_evento = i.cod_evento WHERE i.principal = 's' and e.reprovado = 's' and u.cod_usuario = ".$id." order by e.cod_evento desc";

                      $resultado = mysqli_query($connect,$sql);
                      if (mysqli_num_rows($resultado)>0) {


                        while ($dados = mysqli_fetch_array($resultado)) {

                          $foto = "img/imgUsuario/".$dados['nm_img'];
                          ?>


                          <div class="testimonial testimonialEventosPassados">
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
                            <small class="post mb-2"><?= $dados['nm_usuario'] ?></small>
                            <p class="description">
                              <?= $dados['descricao'] ?>
                            </p>

                            <a href="infoEvento.php?id=<?= $dados['cod_evento'] ?>" class="btn btn-outline-danger margembtAbrirEvento">Abrir Evento</a>
                          </div>

                          <?php 
                        }
                      }
                      else{
                        ?>
                        <div class="container">
                          <div class="row text-center pb-5 justify-content-center">
                           <div class="col-12">
                            <div class="display-4 mt-4 textoNormal">Você não possui eventos reprovados</div>
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
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>

</div>
</div>
</div>
<div class="container">
  <div class="row">
    <div class="col-md-6">
      <section class="testimonial-section">  
       <div class="container">

        <div class="row text-center">
          <div class="col-md-12">
            <div class="display-4 mt-4 mb-4 fontePequena ">Eventos futuros</div>
            <div id="testimonial-slider" class="owl-carousel">


              <?php  

              if (isset($_SESSION['id'])) {
                $id = $_SESSION['id'];

                $sql = "select * from tbl_evento as e inner join tbl_usuario as u INNER join tbl_img as i on u.cod_usuario = e.cod_usuario and e.cod_evento = i.cod_evento WHERE i.principal = 's' and e.situacao = 'a' and u.cod_usuario = ".$id." order by e.cod_evento desc";

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
                      <small class="post mb-2"><?= $dados['nm_usuario'] ?></small>
                      <p class="description">
                        <?= $dados['descricao'] ?>
                      </p>

                      <a href="infoEvento.php?id=<?= $dados['cod_evento'] ?>" class="btn btn-outline-primary margembtAbrirEvento">Abrir Evento</a>
                    </div>

                    <?php 
                  }
                }
                else{
                  ?>
                  <div class="container">
                    <div class="row text-center pb-5 justify-content-center">
                     <div class="col-12">
                       <div class="display-4 mt-4 textoNormal">Você não possui eventos para acontecer</div>
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
 </div>
 <div class="col-md-6">
  <section class="testimonial-section">  
   <div class="container">

     <div class="row text-center">
      <div class="col-md-12">
        <div class="display-4 mt-4 mb-4 eventosPassados fontePequena">Eventos passados</div>
        <div id="testimonial-slider" class="owl-carousel">

          <?php  

          if (isset($_SESSION['id'])) {
            $id = $_SESSION['id'];

            $sql = "select * from tbl_evento as e inner join tbl_usuario as u INNER join tbl_img as i on u.cod_usuario = e.cod_usuario and e.cod_evento = i.cod_evento WHERE i.principal = 's' and e.situacao = 'i' and e.reprovado = 'n' and u.cod_usuario = ".$id." order by e.cod_evento desc";

            $resultado = mysqli_query($connect,$sql);
            if (mysqli_num_rows($resultado)>0) {


              while ($dados = mysqli_fetch_array($resultado)) {

                $foto = "img/imgUsuario/".$dados['nm_img'];
                ?>


                <div class="testimonial testimonialEventosPassados">
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
                  <small class="post mb-2"><?= $dados['nm_usuario'] ?></small>
                  <p class="description">
                    <?= $dados['descricao'] ?>
                  </p>

                  <a href="infoEvento.php?id=<?= $dados['cod_evento'] ?>" class="btn btn-outline-danger margembtAbrirEvento">Abrir Evento</a>
                </div>

                <?php 
              }
            }
            else{
              ?>

              <div class="container">
                <div class="row text-center pb-5 justify-content-center">
                 <div class="col-12">
                   <div class="display-4 mt-4 textoNormal">Você não possui eventos finalizados</div>
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
</div>
</div>  
</div>
<br>
<br>




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