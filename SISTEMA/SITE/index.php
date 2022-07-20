<!doctype html>
<html lang="pt-br">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="shortcut icon" href="img/icone.png" type="image/x-icon" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/index.css">
  <link rel="stylesheet" type="text/css" href="css/navbar.css">
  <link href="https://fonts.googleapis.com/css?family=Rock+Salt|Sintony" rel="stylesheet">
  <title>Radar da Festa</title>
</head>
<body>

  <?php

  session_start();

  $_SESSION['pagina'] = 'index.php';


  if (isset($_SESSION['adm'])) {
    if ($_SESSION['adm'] == true) {
      header('Location: adm/index.php');
    }
  }

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

  require_once 'php_action/db_connect.php';


  $data = date('Y-m-d');

  $sql = "update tbl_evento set situacao = 'i' where dt_fim < '$data' or reprovado = 's' ";

  $resultado = mysqli_query($connect,$sql);
  echo mysqli_error($connect);
  ?>

  <div class="container mt-5">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner d-flex align-items-center">
        <div class="carousel-item active">
          <div class="row justify-content-center">
            <table style="height: 120px;">
              <tbody>
                <tr>
                  <td><img class="d-block w-100" src="img/imgUsuario/AgoraVai.png" alt="First slide"></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <?php

        require_once 'php_action/db_connect.php';


        $data = date('d-m-Y');

        $dtInicio = date('Y-m-d', strtotime('sunday last week', strtotime($data)));
        $dtFim = date('Y-m-d', strtotime('saturday this week', strtotime($data)));



        $dtInicio = date('Y-m-d',strtotime($dtInicio));
        $dtFim = date('Y-m-d',strtotime($dtFim));

        $sql = "select * from tbl_evento as e inner join tbl_usuario as u inner join tbl_img as i on u.cod_usuario = e.cod_usuario and e.cod_evento = i.cod_evento  where i.principal = 's' and e.situacao = 'a' and e.dt_inicio >= '$dtInicio' and e.dt_fim <='$dtFim'";

        $resultado = mysqli_query($connect,$sql);
        echo mysqli_error($connect);
        if (mysqli_num_rows($resultado)>0) {

          while ($dados = mysqli_fetch_array($resultado)) {
            $foto = "img/imgUsuario/".$dados['nm_img'];
            ?>
            <div class="carousel-item">
              <div class="row justify-content-center">
                <a href="infoEvento.php?id=<?=$dados['cod_evento'];?>">
                  <table style="height: 120px;">
                    <tbody>
                      <tr>
                        <td><img class="d-block w-100" src="<?= $foto?>" alt="First slide"></td>
                      </tr>
                    </tbody>
                  </table>
                </a>
              </div>
            </div>
            <?php

          }
        }

        ?>
      </div>

      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </div>

  <div>
    <br>
    <a href="index.php" class="hj"><h1 class=" mb-4 fonteHoje text-center titulo mt-4 mb-5">Pesquisar</h1></a>
  </div>
  <div class="container mt-5">
    <div class="pesquisa">

      <div class="row">

        <div class="col-md-6">
          <form action="" method="get">
            <div class="input-group">

              <input type="text" aria-label="First name" class="form-control" placeholder="Pesquisar por nome" name="txtPesquisaNome">
              <div class="input-group-append">
                <button type="submit" class="btn btn-outline-primary" name="pesquisarNome">Pesquisar</button>
              </div>
            </div>
          </form>
        </div>

        <div class="col-md-6">
          <form action="" method="get">
            <div class="input-group">
              <select class="form-control" id="cbCategoria" name="cbCategoria" required>
                <option value="0">Selecione a categoria</option>
                <?php

                require_once 'php_action/db_connect.php';


                $sql = "select * from tbl_categoria where situacao = 'a'";

                $resultado = mysqli_query($connect,$sql);


                if (mysqli_num_rows($resultado)>0) {
                  while ( $dados = mysqli_fetch_array($resultado)) {

                    ?>

                    <option value="<?= $dados['cod_categoria']; ?>"><?= $dados['nm_categoria']; ?></option>

                    <?php
                  }
                }
                else{

                  ?>

                  <option value="0" disabled="true">Nenhuma categoria cadastrada</option>

                  <?php

                }

                ?>

              </select>
              <div class="input-group-append">
                <button class="btn btn-outline-primary" type="submit" id="btPesquisarCategoria">Pesquisar</button>
              </div>
            </div>
          </form>
        </div>

      </div>
    </div>



    <div class="pesquisaSemBorda mt-4">
      <div class="row text-center justify-content-around justify-content-center align-items-center">


        <?php
        require_once 'php_action/db_connect.php';
        if (isset($_GET['cbCategoria'])) {
          $nome1 = $_GET['cbCategoria'];

          $sql1 = "select * from tbl_evento as e inner join tbl_img as i inner join tbl_categoria as c  on i.cod_evento = i.cod_evento and c.cod_categoria = e.cod_categoria and i.cod_evento = e.cod_evento where i.principal = 's' and e.situacao = 'a' and e.reprovado = 'n' and e.cod_categoria = $nome1 GROUP BY e.cod_evento";

          $resultado1 = mysqli_query($connect,$sql1);


          if (mysqli_num_rows($resultado1)>0) {


            while ($dados1 = mysqli_fetch_array($resultado1)) {

              $foto1 = "img/imgUsuario/".$dados1['nm_img'];
              ?>
              <a href="infoEvento.php?id=<?= $dados1['cod_evento']?> ">
                <div class="contDiv">
                  <div class="estruturaCard  p-3">

                    <div class="fotoCard mb-2">

                      <div class="row justify-content-center">
                        <table style="height: 120px;">
                          <tbody>
                            <tr>
                              <td><img class="d-block w-100 imgPesquisa" src="<?= $foto1?>" alt="First slide"></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>

                    </div>
                    <div class="rodapeCard p-2">
                      <span class="text-uppercase"><?= $dados1['nm_evento']?></span>

                    </div>
                  </div>
                </div>
              </a>
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
        <?php
        if (isset($_GET['txtPesquisaNome'])) {
          $nome = $_GET['txtPesquisaNome'];

          $sql = "select * from tbl_evento as e inner join tbl_img as i on i.cod_evento = e.cod_evento  and i.cod_evento = e.cod_evento where   i.principal = 's' and e.situacao = 'a' and e.reprovado = 'n' and nm_evento LIKE '%".$nome."%' group by e.cod_evento";

          $resultado = mysqli_query($connect,$sql);

          if (mysqli_num_rows($resultado)>0) {


            while ($dados = mysqli_fetch_array($resultado)) {

              $foto = "img/imgUsuario/".$dados['nm_img'];
              ?>

              <a class="bordaCard" href="infoEvento.php?id=<?= $dados['cod_evento']?> ">
                <div class="contDiv">

                  <div class="estruturaCard p-3">

                    <div class="fotoCard mb-2">

                      <div class="row justify-content-center">
                        <table style="height: 120px;">
                          <tbody>
                            <tr>
                              <td><img class="d-block w-100 imgPesquisa" src="<?= $foto?>" alt="First slide"></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>

                    </div>
                    <div class="rodapeCard p-2">
                      <span class="text-uppercase"><?= $dados['nm_evento']?></span>

                    </div>
                  </div>
                </div>
              </a>
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

        <?php
        require_once 'php_action/db_connect.php';
        if (!isset($_GET['cbCategoria']) && !isset($_GET['txtPesquisaNome'])) {


          $sql1 = "select * from tbl_evento as e inner join tbl_usuario as u inner join tbl_img as i on u.cod_usuario = e.cod_usuario and e.cod_evento = i.cod_evento  where i.principal = 's' and e.situacao = 'a' and e.reprovado = 'n' and e.dt_inicio >= '$dtInicio' and e.dt_fim <='$dtFim'";

          $resultado1 = mysqli_query($connect,$sql1);


          if (mysqli_num_rows($resultado1)>0) {


            while ($dados1 = mysqli_fetch_array($resultado1)) {

              $foto1 = "img/imgUsuario/".$dados1['nm_img'];
              ?>
              <a href="infoEvento.php?id=<?= $dados1['cod_evento']?> ">
                <div class="contDiv">
                  <div class="estruturaCard  p-3">

                    <div class="fotoCard mb-2">

                      <div class="row justify-content-center">
                        <table style="height: 120px;">
                          <tbody>
                            <tr>
                              <td><img class="d-block w-100 imgPesquisa" src="<?= $foto1?>" alt="First slide"></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>

                    </div>
                    <div class="rodapeCard p-2">
                      <span class="text-uppercase"><?= $dados1['nm_evento']?></span>

                    </div>
                  </div>
                </div>
              </a>
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

  <?php
  include_once 'navbar/footer.php'
  ?>


  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
  <script type="text/javascript" src="js/home.js"></script>
  <script type="text/javascript">
  $('#cbCategoria').change(function(){
    $('#btPesquisarCategoria').click();
  });
  </script>
</body>
</html>
