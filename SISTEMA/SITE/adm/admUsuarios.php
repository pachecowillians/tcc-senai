<html lang="pt-br">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
      <link rel="shortcut icon" href="../img/icone.png" type="image/x-icon" />

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="../css/adm/admUsuarios.css">
  <link rel="stylesheet" type="text/css" href="../css/navbar.css">
  <link href="https://fonts.googleapis.com/css?family=Rock+Salt|Sintony" rel="stylesheet">
  <title>Pesquisar Usuários</title>
</head>
<body>

  <?php  
  include_once '../php_action/mensagem.php';
  include_once '../navbar/adm.php';
  $_SESSION['paginaAdm'] = 'admUsuarios.php';
  if (!isset($_SESSION['adm']) || !$_SESSION['adm'] == true) {
    header('Location: ../index.php');
  }
  ?>
  <br>
  <br>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <h1 class="display-3 text-center mb-5 fonteHoje titulo">Usuários</h1>

        <div class="accordion" id="accordionExample">
         <div class="card">
          <h5 class="mb-0">
            <button class="list-group-item list-group-item-action list-group-item-light collapsed" type="button" data-toggle="collapse" data-target="#collapse1" aria-expanded="false" aria-controls="collapseTwo">
              Usuários
            </button>
          </h5>
          <div id="collapse1" class="collapsed show" aria-labelledby="headingTwo" data-parent="#accordionExample">
            <div class="card-body">
              <form>
                <div class="input-group mb-3">
                  <input type="text" class="form-control" placeholder="Nome do usuário" aria-label="Recipient's username" aria-describedby="basic-addon2" required id="txtUsuario" name="txtUsuario">
                  <div class="input-group-append">
                    <button class="btn btn-outline-primary" type="submit">Pesquisar</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="card">
          <h5 class="mb-0">
            <button class="list-group-item list-group-item-action list-group-item-light collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
              Situação
            </button>
          </h5>
          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
            <div class="card-body">
              <form>
                <div class="btn-group" role="group" aria-label="Basic example">
                  <button type="submit" class="btn btn-outline-success" id="btAtivo" name="btAtivo">Ativo</button>
                  <button type="submit" class="btn btn-outline-danger" id="btInativo" name="btInativo">Inativo</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        
        <div class="card">
          <h5 class="mb-0">
            <button class="list-group-item list-group-item-action list-group-item-light collapsed" type="button" data-toggle="collapse" data-target="#collapse3" aria-expanded="false" aria-controls="collapseTwo">
              Nº Reprovações
            </button>
          </h5>
          <div id="collapse3" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
            <div class="card-body">
              <form action="" method="GET">
                <div class="input-group mb-3">
                  <select class="custom-select" id="cbReprovacoes" name="cbReprovacoes">
                    <option value="1">Maior que</option>
                    <option value="2">Menor que</option>
                  </select>  
                  <input type="number" class="form-control" placeholder="Nº Reprovações" aria-label="Recipient's username" aria-describedby="basic-addon2" required id="txtReprovacoes" name="txtReprovacoes">
                  <div class="input-group-append">
                    <button class="btn btn-outline-primary" type="submit" id="btReprovacoes" name="btReprovacoes">Pesquisar</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="card">
          <h5 class="mb-0">
            <button class="list-group-item list-group-item-action list-group-item-light collapsed" type="button" data-toggle="collapse" data-target="#collapse4" aria-expanded="false" aria-controls="collapseTwo">
              CPF
            </button>
          </h5>
          <div id="collapse4" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
            <div class="card-body">
              <form>
                <div class="input-group mb-3">
                  <input type="text" class="form-control" placeholder="Ex: 111.111.111-11" aria-label="Recipient's username" aria-describedby="basic-addon2" id='txtCpf' name="txtCpf" required>
                  <div class="input-group-append">
                    <button class="btn btn-outline-primary"  id="btCpf" name="btCpf" type="submit">Pesquisar</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <div class="table-responsive">
        <table class="table table-hover mt-4 table-striped">


          <?php
          require_once '../php_action/db_connect.php';
          if (isset($_GET['txtUsuario'])) {
            $nome = $_GET['txtUsuario'];

            $sql = "select cod_usuario,nm_usuario,situacao from tbl_usuario where cargo = 'u' and nm_usuario like '%".$nome."%'";

            $resultado = mysqli_query($connect,$sql);
            if (mysqli_num_rows($resultado)>0) {
              ?>
              <thead>
                <tr>
                  <th scope="col">Nome</th>
                  <th scope="col">Situação</th>
                  <th scope="col">Aprov.</th>
                  <th scope="col">Reprov.</th>
                </tr>
              </thead>
              <?php
              while ($dados = mysqli_fetch_array($resultado)) {
                $cod = $dados['cod_usuario'];
                ?>
                
                <tr id="teste" onclick="location.href = 'admPerfil.php?id=<?= $cod; ?>';">
                  <td><?= $dados['nm_usuario'] ?></td>
                  <td>
                    <?php
                    if ($dados['situacao'] == 'a') {
                      echo 'Ativo';
                    }
                    else if ($dados['situacao'] == 'i') {
                      echo 'Inativo';
                    }
                    $sql1 = "select COUNT(cod_evento) as aprovado from tbl_evento where reprovado = 'n' and cod_usuario = ".$cod;
                    $resultado1 = mysqli_query($connect,$sql1);
                    $dados1 = mysqli_fetch_array($resultado1);
                    ?>                       
                  </td>
                  <td> <?= $dados1['aprovado'] ?></td>
                  <?php

                  $sql2 = "select COUNT(cod_evento) as reprovado from tbl_evento where reprovado = 's' and cod_usuario = ".$cod;
                  $resultado2 = mysqli_query($connect,$sql2);
                  $dados2 = mysqli_fetch_array($resultado2);

                  ?>
                  <td><?= $dados2['reprovado'] ?></td>
                </tr>
                <?php
              }
            }
          }
          ?>

          <?php
          require_once '../php_action/db_connect.php';
          if (isset($_GET['txtCpf'])) {
            $cpf = $_GET['txtCpf'];

            $sql = "select cod_usuario,nm_usuario,situacao from tbl_usuario where cargo = 'u' and cpf = '$cpf'";

            $resultado = mysqli_query($connect,$sql);
            if (mysqli_num_rows($resultado)>0) {
              ?>
              <thead>
                <tr>
                  <th scope="col">Nome</th>
                  <th scope="col">Situação</th>
                  <th scope="col">Aprov.</th>
                  <th scope="col">Reprov.</th>
                </tr>
              </thead>
              <?php
              while ($dados = mysqli_fetch_array($resultado)) {
                $cod = $dados['cod_usuario'];
                ?>

                <tr id="teste" onclick="location.href = 'admPerfil.php?id=<?= $cod; ?>';">
                  <td><?= $dados['nm_usuario'] ?></td>
                  <td>
                    <?php
                    if ($dados['situacao'] == 'a') {
                      echo 'Ativo';
                    }
                    else if ($dados['situacao'] == 'i') {
                      echo 'Inativo';
                    }
                    $sql1 = "select COUNT(cod_evento) as aprovado from tbl_evento where reprovado = 'n' and cod_usuario = ".$cod;
                    $resultado1 = mysqli_query($connect,$sql1);
                    $dados1 = mysqli_fetch_array($resultado1);
                    ?>                       
                  </td>
                  <td> <?= $dados1['aprovado'] ?></td>
                  <?php

                  $sql2 = "select COUNT(cod_evento) as reprovado from tbl_evento where reprovado = 's' and cod_usuario = ".$cod;
                  $resultado2 = mysqli_query($connect,$sql2);
                  $dados2 = mysqli_fetch_array($resultado2);

                  ?>
                  <td><?= $dados2['reprovado'] ?></td>
                </tr>
              </tbody>
              <?php
            }
          }
        }
        ?>

        <?php
        require_once '../php_action/db_connect.php';
        if (isset($_GET['btAtivo'])) {
          $cpf = $_GET['btAtivo'];

          $sql = "select cod_usuario,nm_usuario,situacao from tbl_usuario where cargo = 'u' and situacao = 'a'";

          $resultado = mysqli_query($connect,$sql);
          if (mysqli_num_rows($resultado)>0) {
            ?>
            <thead>
              <tr>
                <th scope="col">Nome</th>
                <th scope="col">Situação</th>
                <th scope="col">Aprov.</th>
                <th scope="col">Reprov.</th>
              </tr>
            </thead>
            <?php
            while ($dados = mysqli_fetch_array($resultado)) {
              $cod = $dados['cod_usuario'];
              ?>

              <tr id="teste" onclick="location.href = 'admPerfil.php?id=<?= $cod; ?>';">
                <td><?= $dados['nm_usuario'] ?></td>
                <td>
                  <?php
                  if ($dados['situacao'] == 'a') {
                    echo 'Ativo';
                  }
                  else if ($dados['situacao'] == 'i') {
                    echo 'Inativo';
                  }
                  $sql1 = "select COUNT(cod_evento) as aprovado from tbl_evento where reprovado = 'n' and cod_usuario = ".$cod;
                  $resultado1 = mysqli_query($connect,$sql1);
                  $dados1 = mysqli_fetch_array($resultado1);
                  ?>                       
                </td>
                <td> <?= $dados1['aprovado'] ?></td>
                <?php

                $sql2 = "select COUNT(cod_evento) as reprovado from tbl_evento where reprovado = 's' and cod_usuario = ".$cod;
                $resultado2 = mysqli_query($connect,$sql2);
                $dados2 = mysqli_fetch_array($resultado2);

                ?>
                <td><?= $dados2['reprovado'] ?></td>
              </tr>
            </tbody>
            <?php
          }
        }
      }
      ?>

      <?php
      require_once '../php_action/db_connect.php';
      if (isset($_GET['btInativo'])) {
        $cpf = $_GET['btInativo'];

        $sql = "select cod_usuario,nm_usuario,situacao from tbl_usuario where cargo = 'u' and situacao = 'i'";

        $resultado = mysqli_query($connect,$sql);
        if (mysqli_num_rows($resultado)>0) {
          ?>
          <thead>
            <tr>
              <th scope="col">Nome</th>
              <th scope="col">Situação</th>
              <th scope="col">Aprov.</th>
              <th scope="col">Reprov.</th>
            </tr>
          </thead>
          <?php
          while ($dados = mysqli_fetch_array($resultado)) {
            $cod = $dados['cod_usuario'];
            ?>

            <tr id="teste" onclick="location.href = 'admPerfil.php?id=<?= $cod; ?>';">
              <td><?= $dados['nm_usuario'] ?></td>
              <td>
                <?php
                if ($dados['situacao'] == 'a') {
                  echo 'Ativo';
                }
                else if ($dados['situacao'] == 'i') {
                  echo 'Inativo';
                }
                $sql1 = "select COUNT(cod_evento) as aprovado from tbl_evento where reprovado = 'n' and cod_usuario = ".$cod;
                $resultado1 = mysqli_query($connect,$sql1);
                $dados1 = mysqli_fetch_array($resultado1);
                ?>                       
              </td>
              <td> <?= $dados1['aprovado'] ?></td>
              <?php

              $sql2 = "select COUNT(cod_evento) as reprovado from tbl_evento where reprovado = 's' and cod_usuario = ".$cod;
              $resultado2 = mysqli_query($connect,$sql2);
              $dados2 = mysqli_fetch_array($resultado2);

              ?>
              <td><?= $dados2['reprovado'] ?></td>
            </tr>
          </tbody>
          <?php
        }
      }
    }
    ?>

    <?php
    if (isset($_GET['txtReprovacoes'])) {
      $reprovacoes = $_GET['txtReprovacoes'];
      if ($_GET['cbReprovacoes'] == "2") {
        $sql = "select distinct u.cod_usuario from tbl_usuario as u inner join tbl_evento as e on e.cod_usuario = u.cod_usuario where cargo = 'u'";
        $resultado = mysqli_query($connect,$sql);
        if (mysqli_num_rows($resultado)>0) {
          ?>

          <thead>
            <tr>
              <th scope="col">Nome</th>
              <th scope="col">Situação</th>
              <th scope="col">Aprov.</th>
              <th scope="col">Reprov.</th>
            </tr>
          </thead>

          <?php

          while ($dados = mysqli_fetch_array($resultado)) {
            $cod = $dados['cod_usuario'];

            $sql2 = "select count(u.cod_usuario) as reprov from tbl_usuario as u inner join tbl_evento as e on e.cod_usuario = u.cod_usuario where u.cod_usuario = $cod and e.reprovado = 's'";   
            $resultado2 = mysqli_query($connect,$sql2);
            $dados2 = mysqli_fetch_array($resultado2);

            $reprovados = $dados2['reprov'];

            if ($reprovados <= $reprovacoes) {

              $sql3 = "select * from tbl_usuario where cod_usuario = ".$cod;   
              $resultado3 = mysqli_query($connect,$sql3);
              $dados3 = mysqli_fetch_array($resultado3);              

              ?>

              <tr id="teste" onclick="location.href = 'admPerfil.php?id=<?= $cod; ?>';">
                <td><?= $dados3['nm_usuario'] ?></td>
                <td>
                  <?php
                  if ($dados3['situacao'] == 'a') {
                    echo 'Ativo';
                  }
                  else if ($dados3['situacao'] == 'i') {
                    echo 'Inativo';
                  }

                  ?>                       
                </td>
                <?php

                $sql4 = "select COUNT(cod_evento) as aprovado from tbl_evento where reprovado = 'n' and cod_usuario = ".$cod;
                $resultado4 = mysqli_query($connect,$sql4);
                $dados4 = mysqli_fetch_array($resultado4);

                ?>
                <td><?= $dados4['aprovado']; ?></td>

                <td><?= $dados2['reprov']; ?> </td>
              </tr>
            </tbody>
            <?php
          }
        }
      }
      else{
        ?>
        <tr>
          <td>-</td>
          <td>-</td>
          <td>-</td>
          <td>-</td>
        </tr>
        <?php
      }

    }

    if ($_GET['cbReprovacoes'] == "1") {
      $sql = "select distinct u.cod_usuario from tbl_usuario as u inner join tbl_evento as e on e.cod_usuario = u.cod_usuario where cargo = 'u'";
      $resultado = mysqli_query($connect,$sql);
      if (mysqli_num_rows($resultado)>0) {


        ?>

        <thead>
          <tr>
            <th scope="col">Nome</th>
            <th scope="col">Situação</th>
            <th scope="col">Aprov.</th>
            <th scope="col">Reprov.</th>
          </tr>
        </thead>

        <?php

        while ($dados = mysqli_fetch_array($resultado)) {
          $cod = $dados['cod_usuario'];

          $sql2 = "select count(u.cod_usuario) as reprov from tbl_usuario as u inner join tbl_evento as e on e.cod_usuario = u.cod_usuario where u.cod_usuario = $cod and e.reprovado = 's'";   
          $resultado2 = mysqli_query($connect,$sql2);
          $dados2 = mysqli_fetch_array($resultado2);

          $reprovados = $dados2['reprov'];

          if ($reprovados >= $reprovacoes) {

            $sql3 = "select * from tbl_usuario where cod_usuario = ".$cod;   
            $resultado3 = mysqli_query($connect,$sql3);
            $dados3 = mysqli_fetch_array($resultado3);              

            ?>

            <tr id="teste" onclick="location.href = 'admPerfil.php?id=<?= $cod; ?>';">
              <td><?= $dados3['nm_usuario'] ?></td>
              <td>
                <?php
                if ($dados3['situacao'] == 'a') {
                  echo 'Ativo';
                }
                else if ($dados3['situacao'] == 'i') {
                  echo 'Inativo';
                }

                ?>                       
              </td>
              <?php

              $sql4 = "select COUNT(cod_evento) as aprovado from tbl_evento where reprovado = 'n' and cod_usuario = ".$cod;
              $resultado4 = mysqli_query($connect,$sql4);
              $dados4 = mysqli_fetch_array($resultado4);

              ?>
              <td><?= $dados4['aprovado']; ?></td>

              <td><?= $dados2['reprov']; ?> </td>
            </tr>
          </tbody>
          <?php
        }
      }
    }
    else{
      ?>
      <tr>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
      </tr>
      <?php
    }

  }

}
?>

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
</body>
</html>