<html lang="pt-br">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
      <link rel="shortcut icon" href="../img/icone.png" type="image/x-icon" />

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="../css/adm/admEventos.css">
  <link rel="stylesheet" type="text/css" href="../css/navbar.css">
  <link href="https://fonts.googleapis.com/css?family=Rock+Salt|Sintony" rel="stylesheet">
  <title>Pesquisar Usuários</title>
</head>
<body>

  <?php
  include_once '../navbar/adm.php';
  include_once '../php_action/mensagem.php';
  $_SESSION['paginaAdm'] = 'admEventos.php';
  if (!isset($_SESSION['adm']) || !$_SESSION['adm'] == true) {
    header('Location: ../index.php');
  }
  ?>
  <br>
  <br>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <h1 class="display-3 text-center mb-5 fonteHoje titulo">Eventos</h1>

        <div class="accordion" id="accordionExample">

          <div class="card">
            <h5 class="mb-0">
              <button class="list-group-item list-group-item-action list-group-item-light collapsed" type="button" data-toggle="collapse" data-target="#collapse2" aria-expanded="false" aria-controls="collapseTwo">
                Data
              </button>
            </h5>
            <div id="collapse2" class="collapsed show" aria-labelledby="headingTwo" data-parent="#accordionExample">
              <div class="card-body">
                <form>
                  <div class="input-group mb-3">
                    <select class="custom-select" id="cbData" name="cbData" required>
                      <option value="1">A partir de</option>
                      <option value="2">Até</option>
                    </select>  
                    <input type="date" class="form-control" aria-label="Recipient's username" aria-describedby="basic-addon2" required id="txtData" name="txtData">
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
              <button class="list-group-item list-group-item-action list-group-item-light collapsed" type="button" data-toggle="collapse" data-target="#collapse1" aria-expanded="false" aria-controls="collapseTwo">
                Autor
              </button>
            </h5>
            <div id="collapse1" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
              <div class="card-body">
                <form action="" method="GET">
                  <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Nome do autor" aria-label="Recipient's username" aria-describedby="basic-addon2" required name="txtAutor">
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
              <button class="list-group-item list-group-item-action list-group-item-light collapsed" type="button" data-toggle="collapse" data-target="#collapse3" aria-expanded="false" aria-controls="collapseTwo">
                Hora
              </button>
            </h5>
            <div id="collapse3" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
              <div class="card-body">
                <form>
                  <div class="input-group mb-3">
                    <select class="custom-select" id="cbHora" name="cbHora">
                      <option value="1">A partir de</option>
                      <option value="2">Até</option>
                    </select>  
                    <input type="time" class="form-control" aria-label="Recipient's username" aria-describedby="basic-addon2" required id="txtHora" name="txtHora">
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
              <button class="list-group-item list-group-item-action list-group-item-light collapsed" type="button" data-toggle="collapse" data-target="#collapse4" aria-expanded="false" aria-controls="collapseTwo">
                Bairro
              </button>
            </h5>
            <div id="collapse4" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
              <div class="card-body">
                <form>
                  <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Nome do bairro" aria-label="Recipient's username" aria-describedby="basic-addon2" required id="txtBairro" name="txtBairro">
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
              <button class="list-group-item list-group-item-action list-group-item-light collapsed" type="button" data-toggle="collapse" data-target="#collapse5" aria-expanded="false" aria-controls="collapseTwo">
                Valor
              </button>
            </h5>
            <div id="collapse5" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
              <div class="card-body">
                <form>
                  <div class="input-group mb-3">
                    <input type="text" class="form-control" id="txtValor" name="txtValor" placeholder="R$" required onkeypress="return numericValidation(this,event);"> 
                    <div class="input-group-append">
                      <button class="btn btn-outline-primary" type="submit">Pesquisar</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>

        </div>
        <div class="table-responsive">
          <table class="table table-hover mt-4 table-striped">
            <tbody>

              <?php
              require_once '../php_action/db_connect.php';
              if (isset($_GET['txtAutor'])) {
                $nome = $_GET['txtAutor'];
                $sql = "select * from tbl_evento as e inner join tbl_usuario as u on e.cod_usuario = u.cod_usuario WHERE u.nm_usuario like '%".$nome."%'";
                $resultado = mysqli_query($connect,$sql);
                if (mysqli_num_rows($resultado)>0) {

                  ?>
                  <thead>
                    <tr>
                      <th scope="col">Nome</th>
                      <th scope="col">Autor</th>
                      <th scope="col">Valor</th>
                      <th scope="col">Inicio</th>
                      <th scope="col">Fim</th>
                    </tr>
                  </thead>
                  <?php

                  while ($dados = mysqli_fetch_array($resultado)) {


                    ?>

                    <tr id="teste" onclick="location.href = 'admInfoEvento.php?id=<?= $dados['cod_evento'] ?>';">
                      <td><?= $dados['nm_evento'] ?></td>
                      <td ><?= $dados['nm_usuario'] ?></td>
                      <td><?= $dados['valor'] ?></td>
                      <td><?= $dados['dt_inicio'] ?></td>
                      <td><?= $dados['dt_fim'] ?></td>
                    </tr>
                    <?php
                  }
                }
              }


              if (isset($_GET['txtBairro'])) {
                $nome = $_GET['txtBairro'];
                $sql = "select * from tbl_evento as e inner join tbl_usuario as u on e.cod_usuario = u.cod_usuario WHERE e.bairro like '%".$nome."%'";
                $resultado = mysqli_query($connect,$sql);
                if (mysqli_num_rows($resultado)>0) {


                  ?>
                  <thead>
                    <tr>
                      <th scope="col">Nome</th>
                      <th scope="col">Autor</th>
                      <th scope="col">Valor</th>
                      <th scope="col">Inicio</th>
                      <th scope="col">Fim</th>
                    </tr>
                  </thead>
                  <?php

                  while ($dados = mysqli_fetch_array($resultado)) {


                    ?>

                  </thead>
                  <tr id="teste" onclick="location.href = 'admInfoEvento.php?id=<?= $dados['cod_evento'] ?>';">
                    <td><?= $dados['nm_evento'] ?></td>
                    <td ><?= $dados['nm_usuario'] ?></td>
                    <td><?= $dados['valor'] ?></td>
                    <td><?= $dados['dt_inicio'] ?></td>
                    <td><?= $dados['dt_fim'] ?></td>
                  </tr>
                  <?php
                }
              }
            }


            if (isset($_GET['txtValor'])) {
              $nome = $_GET['txtValor'];
              $sql = "select * from tbl_evento as e inner join tbl_usuario as u on e.cod_usuario = u.cod_usuario WHERE e.valor like '%".$nome."%'";
              $resultado = mysqli_query($connect,$sql);
              if (mysqli_num_rows($resultado)>0) {


                ?>
                <thead>
                  <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Autor</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Inicio</th>
                    <th scope="col">Fim</th>
                  </tr>
                </thead>
                <?php

                while ($dados = mysqli_fetch_array($resultado)) {


                  ?>
                  <tr id="teste" onclick="location.href = 'admInfoEvento.php?id=<?= $dados['cod_evento'] ?>';">
                    <td><?= $dados['nm_evento'] ?></td>
                    <td ><?= $dados['nm_usuario'] ?></td>
                    <td><?= $dados['valor'] ?></td>
                    <td><?= $dados['dt_inicio'] ?></td>
                    <td><?= $dados['dt_fim'] ?></td>
                  </tr>
                  <?php
                }
              }
            }

            if (isset($_GET['txtData'])) {
              $data = $_GET['txtData'];
              if ($_GET['cbData'] == "1") {
                $sql = "select * from tbl_evento as e inner join tbl_usuario as u on e.cod_usuario = u.cod_usuario WHERE e.dt_inicio >= '$data' ";
              }
              if ($_GET['cbData'] == "2") {
                $sql = "select * from tbl_evento as e inner join tbl_usuario as u on e.cod_usuario = u.cod_usuario WHERE e.dt_inicio <= '$data'";
              }

              $resultado = mysqli_query($connect,$sql);
              if (mysqli_num_rows($resultado)>0) {

                ?>
                <thead>
                  <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Autor</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Inicio</th>
                    <th scope="col">Fim</th>
                  </tr>
                </thead>
                <?php


                while ($dados = mysqli_fetch_array($resultado)) {


                  ?>
                  <tr id="teste" onclick="location.href = 'admInfoEvento.php?id=<?= $dados['cod_evento'] ?>';">
                    <td><?= $dados['nm_evento'] ?></td>
                    <td ><?= $dados['nm_usuario'] ?></td>
                    <td><?= $dados['valor'] ?></td>
                    <td><?= $dados['dt_inicio'] ?></td>
                    <td><?= $dados['dt_fim'] ?></td>
                  </tr>
                  <?php
                }
              }
            }

            if (isset($_GET['txtHora'])) {
              $hora = $_GET['txtHora'];
              if ($_GET['cbHora'] == "1") {
                $sql = "select * from tbl_evento as e inner join tbl_usuario as u on e.cod_usuario = u.cod_usuario WHERE e.hr_inicio >= '$hora' ";
              }
              if ($_GET['cbHora'] == "2") {
                $sql = "select * from tbl_evento as e inner join tbl_usuario as u on e.cod_usuario = u.cod_usuario WHERE e.hr_inicio <= '$hora'";
              }

              $resultado = mysqli_query($connect,$sql);
              if (mysqli_num_rows($resultado)>0) {


                ?>
                <thead>
                  <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Autor</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Inicio</th>
                    <th scope="col">Fim</th>
                  </tr>
                </thead>
                <?php

                while ($dados = mysqli_fetch_array($resultado)) {


                  ?>
                  <tr id="teste" onclick="location.href = 'admInfoEvento.php?id=<?= $dados['cod_evento'] ?>';">
                    <td><?= $dados['nm_evento'] ?></td>
                    <td ><?= $dados['nm_usuario'] ?></td>
                    <td><?= $dados['valor'] ?></td>
                    <td><?= $dados['dt_inicio'] ?></td>
                    <td><?= $dados['dt_fim'] ?></td>
                  </tr>
                  <?php
                }
              }
            }
            ?>
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
<script type="text/javascript" src="../js/adm/admEventos.js"></script>
<script type="text/javascript">$('#modalInfo').modal('show');</script>
<script type="text/javascript">
  function numericValidation(obj,evt) {
        var e = event || evt; // for trans-browser compatibility

        var charCode = e.which || e.keyCode;        

        if (charCode == 46) { //one dot
          if (obj.value.indexOf(".") > -1)
            return false;
          else {
                //---if the dot is positioned in the middle give the user a surprise, remember: just 2 decimals allowed
                var idx = doGetCaretPosition(obj);
                var part1 = obj.value.substr(0,idx),
                part2 = obj.value.substring(idx);

                if (part2.length > 2) {
                  obj.value = part1 + "." + part2.substr(0,2);
                  setCaretPosition(obj, idx + 1);
                  return false;
                }//---

                //allow one dot if not cheating
                return true;
              }
            }
        else if (charCode > 31 && (charCode < 48 || charCode > 57)) { //just numbers
          return false;
        }

        //---just 2 decimals stubborn!
        var arr = obj.value.split(".") , pos = doGetCaretPosition(obj);

        if (arr.length == 2 && pos > arr[0].length && arr[1].length == 2)                               
          return false;
        //---

        //ok it's a number
        return true;
      }

      function doGetCaretPosition (ctrl) {
        var CaretPos = 0;   // IE Support
        if (document.selection) {
          ctrl.focus ();
          var Sel = document.selection.createRange ();
          Sel.moveStart ('character', -ctrl.value.length);
          CaretPos = Sel.text.length;
        }
        // Firefox support
        else if (ctrl.selectionStart || ctrl.selectionStart == '0')
          CaretPos = ctrl.selectionStart;
        return (CaretPos);
      }

      function setCaretPosition(ctrl, pos){
        if(ctrl.setSelectionRange)
        {
          ctrl.focus();
          ctrl.setSelectionRange(pos,pos);
        }
        else if (ctrl.createTextRange) {
          var range = ctrl.createTextRange();
          range.collapse(true);
          range.moveEnd('character', pos);
          range.moveStart('character', pos);
          range.select();
        }
      }
    </script>
  </body>
  </html>