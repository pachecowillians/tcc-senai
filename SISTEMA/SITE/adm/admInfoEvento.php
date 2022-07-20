<!doctype html>
<html lang="pt-br">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
      <link rel="shortcut icon" href="../img/icone.png" type="image/x-icon" />

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="../css/adm/admInfoEvento.css">
  <link rel="stylesheet" type="text/css" href="../css/navbar.css">
  <link href="https://fonts.googleapis.com/css?family=Rock+Salt|Sintony" rel="stylesheet">
  <title>Página do Evento</title>
</head>
<body>

  <?php 
  session_start();
  include_once '../navbar/voltarAdm.php'; 
  if (!isset($_SESSION['adm']) || !$_SESSION['adm'] == true) {
    header('Location: ../index.php');
  }
  ?>
  <br>
  <br>
  <div class="container">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner d-flex align-items-center">
        <?php
        require_once '../php_action/db_connect.php';
        if (isset($_GET['id'])) {
          $id = $_GET['id'];
          $sql = "select i.nm_img from tbl_img as i inner join tbl_evento as e on e.cod_evento = i.cod_evento WHERE e.cod_evento = '$id' and i.principal = 's'";
          $resultado = mysqli_query($connect,$sql);
          $dados = mysqli_fetch_array($resultado);

          $foto = "../img/imgUsuario/".$dados['nm_img'];

          ?>
          <div class="carousel-item active">
            <div class="row justify-content-center">
              <table style="height: 120px;">
                <tbody>
                  <tr>
                    <td><img class="d-block w-100" src="<?= $foto?>" alt="First slide"></td>
                  </tr>
                </tbody>
              </table>  
            </div>
          </div>

          <?php
          $sql = "select i.nm_img from tbl_img as i inner join tbl_evento as e on e.cod_evento = i.cod_evento WHERE e.cod_evento = '$id' and i.principal = 'n'";
          $resultado = mysqli_query($connect,$sql);
          
          
          while ($dados = mysqli_fetch_array($resultado)) {
            $foto = "../img/imgUsuario/".$dados['nm_img'];
            ?>
            <div class="carousel-item">
              <div class="row justify-content-center">
                <table style="height: 120px;">
                  <tbody>
                    <tr>
                      <td><img class="d-block w-100" src="<?= $foto?>" alt="First slide"></td>
                    </tr>
                  </tbody>
                </table>  
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

  <div class="container">
    
        <?php  
        require_once '../php_action/db_connect.php';
        if (isset($_GET['id'])) {
          $id = $_GET['id'];
          $sql = "select * from tbl_evento as e inner join tbl_categoria as c inner join tbl_usuario as u on e.cod_categoria = c.cod_categoria and u.cod_usuario = e.cod_usuario where e.cod_evento = '$id'";
          $resultado = mysqli_query($connect,$sql);
          $dados = mysqli_fetch_array($resultado);

        }
        ?>

         <div class="row text-center justify-content-center">
      <h1 class="display-3 mt-5 text-center"><?= $dados['nm_evento']; ?></h1>
    </div>
    <div class="row justify-content-center mt-5">
      <div class="col-md-4">
        <h1 class="display-3 mb-4 text-center nm_coluna">Sobre o autor</h1>
        <br>
        <div class="table-responsive">
          <table class="table table-striped">
            <tbody>
              <tr class="text-center">
                <th scope="row">Nome: </th>
                <td><?= $dados['nm_usuario']; ?> </td>
              </tr>
              <tr class="text-center">
                <th scope="row">Contato: </th>
                <td><?= $dados['telefone']; ?> </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <br>
      <div class="col-md-4 linhas" >
        <h1 class="display-3 mb-4 text-center nm_coluna">Sobre o evento</h1>
        <br>
        <div class="table-responsive">
          <table class="table table-striped">
            <tbody>
              <tr class="text-center">
                <th scope="row" colspan="2">Categoria: </th>
                <td colspan="2"><?= $dados['nm_categoria']; ?> </td>
              </tr>
              <tr class="text-center">
                <th scope="row" colspan="2">Valor: </th>
                <td colspan="2"><?= $dados['valor']; ?> </td>
              </tr>
              <tr class="text-center">
                <th scope="row" >Data de início: </th>
                <td><?= $dados['dt_inicio']; ?> </td>
                <th scope="row">Data de fim: </th>
                <td><?= $dados['dt_fim']; ?> </td>
              </tr>
              <tr class="text-center">
                <th scope="row">Hora de início: </th>
                <td><?= $dados['hr_inicio']; ?> </td>
                <th scope="row">Hora de fim: </th>
                <td><?= $dados['hr_fim']; ?> </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="col-md-4">
        <h1 class="display-3 mb-4 text-center nm_coluna">Sobre o local</h1>
        <br>
        <div class="table-responsive">
          <table class="table table-striped">
            <tbody>
              <tr class="text-center">
                <th scope="row" colspan="2">Cidade: </th>
                <td colspan="2"><?= $dados['cidade']; ?> </td>
              </tr>
              <tr class="text-center">
                <th scope="row" colspan="2">Bairro: </th>
                <td colspan="2"><?= $dados['bairro']; ?> </td>
              </tr>
              <tr class="text-center">
                <th scope="row" colspan="2">Rua: </th>
                <td colspan="2"><?= $dados['rua']; ?> </td>
              </tr>
              <tr class="text-center">
                <th scope="row" colspan="2">Número: </th>
                <td colspan="2"><?= $dados['numero']; ?> </td>
              </tr>
              <tr class="text-center">
                <th scope="row" colspan="2">Descrição: </th>
                <td colspan="2"><?= $dados['descricao']; ?> </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="row justify-content-center text-center mt-4">
      <div class="col-md-6">
        <div class="row mb-5">
          <div class="col-md-12">

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
              Reprovar
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Atenção!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    Deseja realmente reprovar este evento?
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a role="button" href="../php_action/reprovarEvento.php?id=<?= $dados['cod_evento'] ?>" class="btn btn-danger">Reprovar</a>
                  </div>
                </div>
              </div>
            </div>

          </div>

        </div>
      </div>

    </div>
  </div>



  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</body>
</html>