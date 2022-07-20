<html lang="pt-br">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
    <link rel="shortcut icon" href="../img/icone.png" type="image/x-icon" />

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="../css/adm/admCategoria.css">
  <link rel="stylesheet" type="text/css" href="../css/navbar.css">
  <link href="https://fonts.googleapis.com/css?family=Rock+Salt|Sintony" rel="stylesheet">
  <title>Pesquisar Usuários</title>
</head>
<body>

  <?php include_once '../navbar/adm.php' ?>

  <?php  

  include_once '../php_action/mensagem.php';
  $_SESSION['paginaAdm'] = 'admCategoria.php';
  if (!isset($_SESSION['adm']) || !$_SESSION['adm'] == true) {
    header('Location: ../index.php');
  }
  ?>   

  <div class="container mt-5">
    <div class="row justify-content-center text-center">
      <div class="col-md-6">
        <h1 class="fonteFina text-center mb-5  fonteHoje titulo">Categoria</h1>  
        <div class="row justify-content-center mb-4">
          <div class="col-md-12">
            <form method="POST" action="../php_action/cadastrarCategoria.php">
              <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Nome da categoria" aria-label="Recipient's username" aria-describedby="basic-addon2" required id="txtCategoria" name="txtCategoria">
                <div class="input-group-append">
                  <button class="btn btn-outline-primary" type="submit" id="btCategoria" name="btCategoria">+</button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <h3 class="mb-2 subtituloAtiva">Ativas</h3>
        <div class="table-responsive">
          <table class="table table-hover mt-4 table-striped text-center">
            <thead>
              <tr>
                <th scope="col">Ação</th>
                <th scope="col">Nome</th>
              </tr>
            </thead>
            <tbody>
              <tr id="teste">


                <?php  
                include_once '../php_action/db_connect.php';

                $sql = "select * from tbl_categoria where situacao = 'a'";
                $resultado = mysqli_query($connect,$sql);
                if (mysqli_num_rows($resultado)>0) {


                  while ($dados = mysqli_fetch_array($resultado)) {


                    ?>
                    <tr>
                      <td scope="row">
                        <div class="btn-group" role="group" aria-label="Basic example">
                          <a href="../php_action/desativarCategoria.php?id=<?= $dados['cod_categoria'] ?>" class="btn btn-outline-danger">x</a>
                        </div>
                      </td>
                      <td><?= $dados['nm_categoria'] ?></td>
                    </tr>

                    <?php 
                  }
                }


                
                else{
                 ?>

                 
                 <tr>
                  <td>-</td>
                  <td>-</td>
                </tr>

                <?php

              }

              ?>
            </tr>
          </tbody>
        </table>
      </div>

      <h3 class="mb-2 mt-4 subtituloInativa">Inativas</h3>

      <div class="table-responsive">
        <table class="table table-hover mt-4 table-striped text-center">
          <thead>
            <tr>
              <th scope="col">Ação</th>
              <th scope="col">Nome</th>
            </tr>
          </thead>
          <tbody>
            <tr id="teste">

              <?php  
              include_once '../php_action/db_connect.php';

              $sql = "select * from tbl_categoria where situacao = 'i'";
              $resultado = mysqli_query($connect,$sql);
              if (mysqli_num_rows($resultado)>0) {


                while ($dados = mysqli_fetch_array($resultado)) {


                  ?>

                  <tr>
                    <td scope="row">
                      <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="../php_action/ativarCategoria.php?id=<?= $dados['cod_categoria'] ?>" class="btn btn-outline-success">+</a>
                      </div>
                    </td>
                    <td><?= $dados['nm_categoria'] ?></td>
                  </tr>

                  <?php
                }
              }
              else{
                ?>
                <tr>
                  <td>-</td>
                  <td>-</td>
                </tr>
                <?php

              }

              ?>
              



            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>



<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
<script type="text/javascript" src="../js/jquery.mask.js"></script>
<script type="text/javascript" src="../js/cadastroUsuario.js"></script>
<script type="text/javascript">$('#modalInfo').modal('show');</script>
<script type="text/javascript">
  function SoLetra(){
   var regex = new RegExp("^[a-zA-Z ]+$");
   var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
   if (!regex.test(key)) {
    event.preventDefault();
    return false;
  }
}
</script>
</body>
</html>