  <html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
        <link rel="shortcut icon" href="../img/icone.png" type="image/x-icon" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/adm/admIndex.css">
    <link rel="stylesheet" type="text/css" href="../css/navbar.css">
    <link href="https://fonts.googleapis.com/css?family=Rock+Salt|Sintony" rel="stylesheet">
    <title>Pesquisar Usuários</title>
  </head>
  <body>

    <?php  
    include_once '../php_action/mensagem.php';
    include_once '../navbar/adm.php';
    $_SESSION['paginaAdm'] = 'index.php';
    if (!isset($_SESSION['adm']) || !$_SESSION['adm'] == true) {
      header('Location: ../index.php');
    }
    ?>

    <div class="container mt-5">
      <div class="row justify-content-center text-center">
        <div class="col-md-6">
          <h1 class="display-3 text-center mb-5 fonteHoje titulo">Novos Eventos</h1>

          <div class="table-responsive">
            <table class="table table-hover mt-4 table-striped text-center">
              <thead>
                <tr>
                  <th scope="col">Ação</th>
                  <th scope="col">Evento</th>
                  <th scope="col">Autor</th>
                  <th scope="col">Envio</th>
                  <th scope="col">Ação</th>
                </tr>
              </thead>
              <tbody>
                <?php  
                include_once '../php_action/db_connect.php';

                $sql = "select * from tbl_evento as e inner join tbl_usuario as u on u.cod_usuario = e.cod_usuario WHERE e.vizualizado = 'n' and e.situacao = 'a' order by e.cod_evento desc";
                $resultado = mysqli_query($connect,$sql);
                if (mysqli_num_rows($resultado)>0) {


                  while ($dados = mysqli_fetch_array($resultado)) {


                    ?>

                    <tr id="teste">
                      <th scope="row">

                        <a href="admInfoEvento.php?id=<?= $dados['cod_evento'] ?>" class="btn btn-outline-primary">Abrir</a>
                      </th>
                      <td><?= $dados['nm_evento'] ?></td>
                      <td><?= $dados['nm_usuario'] ?></td>
                      <td><?= $dados['dt_cadastro'] ?></td>
                      

                      <td><a href="../php_action/visualizar.php?id=<?= $dados['cod_evento'] ?>" class="btn btn-outline-danger">x</a></td>
                    </tr>

                    <?php
                  }
                }
                else{
                  ?>
                  <tr>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                  </tr>
                  <?php

                }

                ?>
                
              </tbody>
            </table>
          </div>
          <td></td>

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
    
  </body>
  </html>