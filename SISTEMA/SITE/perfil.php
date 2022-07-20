<html lang="pt-br">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
    <link rel="shortcut icon" href="img/icone.png" type="image/x-icon" />

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

  <link rel="stylesheet" type="text/css" href="css/perfil.css">
  <link rel="stylesheet" type="text/css" href="css/navbar.css">
  <link href="https://fonts.googleapis.com/css?family=Rock+Salt|Sintony" rel="stylesheet">
  <title>Perfil</title>
</head>
<body>
  <?php  
  session_start();
  include_once 'navbar/voltar.php';
  require_once 'php_action/db_connect.php';
  if ($_SESSION['logado'] != true) {
    header("Location: index.php");
  }
  if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];

    $sql = "select * from tbl_usuario where cod_usuario = '$id'";

    $resultado = mysqli_query($connect,$sql);


    $dados = mysqli_fetch_array($resultado);

  }
  ?>

  <br>
  <br>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <h1 class="display-3 text-center mb-5 fonteHoje titulo"><?= $dados['nm_usuario']; ?></h1>
        <div class="table-responsive">
          <table class="table table-striped">

            <tbody>
              <tr class="">
                <th scope="row">Email: </th>
                <td><?= $dados['email']; ?> </td>
              </tr>
              <tr>
                <th scope="row">CPF: </th>
                <td><?= $dados['cpf']; ?></td>
              </tr>
              <tr>
                <th scope="row">Removidos: </th>
                <td><?php

                $sql2 = "select count(u.cod_usuario) as reprov from tbl_usuario as u inner join tbl_evento as e on e.cod_usuario = u.cod_usuario where u.cod_usuario = $id and e.reprovado = 's'";   
                $resultado2 = mysqli_query($connect,$sql2);
                $dados2 = mysqli_fetch_array($resultado2);
                echo $dados2['reprov'];
                ?></td>
              </tr>
              <tr>
                <th scope="row">Total de eventos: </th>
                <td><?php

                $sql2 = "select count(u.cod_usuario) as total from tbl_evento as e inner join tbl_usuario as u on u.cod_usuario = e.cod_usuario where u.cod_usuario=".$id;   
                $resultado2 = mysqli_query($connect,$sql2);
                $dados2 = mysqli_fetch_array($resultado2);
                echo $dados2['total'];
                ?></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="row justify-content-center text-center mt-4">
      <div class="col-md-6">
        <div class="row">
          <div class="col-md-12">
            <a href="cadastroUsuario.php?id=<?= $dados['cod_usuario']; ?>" class="btn btn-primary mb">Alterar</a>
          </div>
        </div>
      </div>

    </div>

  </div>
  <br>
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
  <script type="text/javascript" src="../js/jquery.mask.js"></script>
  <script type="text/javascript" src="../js/cadastroUsuario.js"></script>

  <?php  

  if (isset($_SESSION['msg'])) {
    ?>

    <!-- Modal -->
    <div class="modal fade" id="modalInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle"><?= $_SESSION['msg']; ?></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
          </div>
        </div>
      </div>
    </div>

    <script type="text/javascript">$('#modalInfo').modal('show');</script>
    <?php
  }

  ?>


  <?php

  unset($_SESSION['msg']); 

  ?> 

</body>
</html>