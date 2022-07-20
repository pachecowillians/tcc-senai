<!doctype html>
<html lang="pt-br">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
    <link rel="shortcut icon" href="img/icone.png" type="image/x-icon" />

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

  <link rel="stylesheet" type="text/css" href="css/cadastroEvento.css">
  <link rel="stylesheet" type="text/css" href="css/navbar.css">
  <link href="https://fonts.googleapis.com/css?family=Rock+Salt|Sintony" rel="stylesheet">
  <title>Cadastro de Eventos</title>
</head>
<body>

  <?php
  
  include_once 'php_action/mensagem.php';
  if ($_SESSION['logado'] != true) {
    header("Location: index.php");
  }
  if (isset($_SESSION['logado'])) {
    if ($_SESSION['logado'] == true) {
      include_once 'navbar/voltarInicio.php';
    }
    else{
      include_once 'navbar/voltar.php';
    }
  }
  else{
    include_once 'navbar/voltar.php';
  }

  ?>

  <?php
  if (isset($_GET['id'])) {

    require_once 'php_action/db_connect.php';
    $id = $_GET['id'];

    $sql = "select * from tbl_evento as e inner join tbl_categoria as c on c.cod_categoria = e.cod_categoria where e.cod_evento = '$id'";

    $resultado = mysqli_query($connect,$sql);


    $dados = mysqli_fetch_array($resultado);
    ?>

    <div class="container">
      <div class="row justify-content-center text-center">
        <h5 class="fonteTitulo mt-5 mb-5 mr-auto ml-auto fonteHoje titulo">Altere seu evento</h5>
      </div>

      <form method="POST" action="php_action/alterarEvento.php" enctype="multipart/form-data">
        <div class="row justify-content-center mt-4" >
          <div class="col-md-9 mb-5">
            <div class="fundoImagemPrincipal">
              <button type="button" class="btFechar btn btn-danger ml-auto mr-auto" name="btRemp" id="btRemp">x</button>
              <?php

              $id = $_GET['id'];
              $sql3 = "select i.nm_img from tbl_img as i inner join tbl_evento as e on e.cod_evento = i.cod_evento WHERE e.cod_evento = '$id' and i.principal = 's'";
              $resultado3 = mysqli_query($connect,$sql3);
              $dados3 = mysqli_fetch_array($resultado3);

              $foto = "img/imgUsuario/".$dados3['nm_img'];

              ?>
              <img src="<?= $foto; ?>" id="imgPrincipal" class="imagemPrincipal" name="imgPrincipal">
              <input id="fileUploadPrincipal" name="fileUploadPrincipal" type="file"><br/>

            </div> 
          </div>
        </div>


        <div class="row justify-content-center">
          <div class="col-md-9">
            <div class="row justify-content-around text-center align-items-center">

              <?php

              $id = $_GET['id'];

              $sql3 = "select i.nm_img from tbl_img as i inner join tbl_evento as e on e.cod_evento = i.cod_evento WHERE e.cod_evento = '$id' and i.principal = 'n' and i.secundaria = '1'";
              $resultado3 = mysqli_query($connect,$sql3);
              if (mysqli_num_rows($resultado3)>0) {

                $dados3 = mysqli_fetch_array($resultado3);


                $foto = "img/imgUsuario/".$dados3['nm_img'];

                ?>

                <div class="col-md-4 mb-4">
                  <div class="fundoImagem">
                    <button type="button" class="btFecharSec btn btn-danger ml-auto mr-auto" name="btRem1" id="btRem1">x</button>
                    <img src="<?= $foto; ?>" id="img1" name="img1" class="imagem">
                    <input id="fileUpload1" name="fileUpload1" type="file"><br/>
                  </div>            
                </div>

                <?php
              }

              // Fim img 1

              $sql3 = "select i.nm_img from tbl_img as i inner join tbl_evento as e on e.cod_evento = i.cod_evento WHERE e.cod_evento = '$id' and i.principal = 'n' and i.secundaria = '2'";
              $resultado3 = mysqli_query($connect,$sql3);
              if (mysqli_num_rows($resultado3)>0) {

                $dados3 = mysqli_fetch_array($resultado3);


                $foto = "img/imgUsuario/".$dados3['nm_img'];

                ?>

                <div class="col-md-4 mb-4">
                  <div class="fundoImagem">
                    <button type="button" class="btFecharSec btn btn-danger ml-auto mr-auto" name="btRem2" id="btRem2">x</button>
                    <img src="<?= $foto; ?>" id="img2" name="img2" class="imagem">
                    <input id="fileUpload2" name="fileUpload2" type="file"><br/>
                  </div>  
                </div>

                <?php
              }


              // Fim img 2

              $sql3 = "select i.nm_img from tbl_img as i inner join tbl_evento as e on e.cod_evento = i.cod_evento WHERE e.cod_evento = '$id' and i.principal = 'n' and i.secundaria = '3'";
              $resultado3 = mysqli_query($connect,$sql3);
              if (mysqli_num_rows($resultado3)>0) {

                $dados3 = mysqli_fetch_array($resultado3);


                $foto = "img/imgUsuario/".$dados3['nm_img'];

                ?>

                <div class="col-md-4 mb-4">
                  <div class="fundoImagem">
                    <button type="button" class="btFecharSec btn btn-danger ml-auto mr-auto" name="btRem3" id="btRem3">x</button>
                    <img src="<?= $foto; ?>" id="img3" name="img3" class="imagem">
                    <input id="fileUpload3" name="fileUpload3" type="file"><br/>
                  </div>  
                </div>

                <?php
              }

              // Fim img 3

              ?>

              <input type="hidden" name="txtFotoPrincipal" id="txtFotoPrincipal">
              <input type="hidden" name="txtFotoSec1" id="txtFotoSec1">
              <input type="hidden" name="txtFotoSec2" id="txtFotoSec2">
              <input type="hidden" name="txtFotoSec3" id="txtFotoSec3">
            </div>
          </div>
        </div>

        <div class="row justify-content-center mt-3">
          <div class="col-md-9">

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="txtNome">Nome evento:</label>
                <input type="text" class="form-control" id="txtNome" name="txtNome" placeholder="Nome evento" required value="<?=$dados['nm_evento']?>">
              </div>
              <div class="form-group col-md-6">
                <label for="txtTelefone">Telefone de contato:</label>
                <input type="text" class="form-control" id="txtTelefone" name="txtTelefone" placeholder="Telefone do responsável" required minlength="10" value="<?=$dados['telefone']?>">
              </div>

            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="txtDtInicio">Data início:</label>
                <input type="date" class="form-control" id="txtDtInicio" name="txtDtInicio" placeholder="Data início" required value="<?=$dados['dt_inicio']?>">
              </div>
              <div class="form-group col-md-6">
                <label for="txtDtFim">Data fim:</label>
                <input type="date" class="form-control" id="txtDtFim" name="txtDtFim" placeholder="Data fim" required value="<?=$dados['dt_fim']?>">
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="txtHrInicio">Hora início:</label>
                <input type="time" class="form-control" id="txtHrInicio" name="txtHrInicio" placeholder="Hora início" required value="<?=$dados['hr_inicio']?>">
              </div>
              <div class="form-group col-md-6">
                <label for="txtHrFim">Hora fim:</label>
                <input type="time" class="form-control" id="txtHrFim" name="txtHrFim" placeholder="Hora fim" required value="<?=$dados['hr_fim']?>">
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="cbCategoria">Categoria:</label>
                <select class="form-control" id="cbCategoria" name="cbCategoria" required value="<?=$dados['nm_categoria']?>">
                  <?php  

                  require_once 'php_action/db_connect.php';


                  $sql1 = "select * from tbl_categoria as c inner join tbl_evento as e on e.cod_categoria = c.cod_categoria where c.situacao = 'a' and e.cod_evento = '$id'";

                  $resultado1 = mysqli_query($connect,$sql1);

                  $dados1 = mysqli_fetch_array($resultado1);


                  ?>

                  <option value="<?= $dados1['cod_categoria']; ?>"><?= $dados1['nm_categoria']; ?></option>

                  <?php


                  $sql1 = "select * from tbl_categoria where situacao = 'a' and cod_categoria not in (select c.cod_categoria from tbl_categoria as c inner join tbl_evento as e on e.cod_categoria = c.cod_categoria where c.situacao = 'a' and e.cod_evento = '$id')";

                  $resultado1 = mysqli_query($connect,$sql1);

                  mysqli_close($connect);

                  if (mysqli_num_rows($resultado)>0) {
                    while ( $dados1 = mysqli_fetch_array($resultado1)) {

                      ?>

                      <option value="<?= $dados1['cod_categoria']; ?>"><?= $dados1['nm_categoria']; ?></option>

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
              </div>



              <div class="form-group col-md-6">
                <label for="txtValor">Valor:</label>
                <input type="text" class="form-control" id="txtValor" name="txtValor" placeholder="R$" required onkeypress="return numericValidation(this,event);" value="<?=$dados['valor']?>">
              </div>
            </div>


            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="txtCidade">Cidade:</label>
                <input type="text" class="form-control" id="txtCidade" name="txtCidade" placeholder="Localidade do evento" require value="<?=$dados['cidade']?>">
              </div>
              <div class="form-group col-md-6">
                <label for="txtBairro">Bairro:</label>
                <input type="text" class="form-control" id="txtBairro" name="txtBairro" placeholder="Bairro do evento" required value="<?=$dados['bairro']?>">
              </div>  
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="txtRua">Rua:</label>
                <input type="text" class="form-control" id="txtRua" name="txtRua" placeholder="Rua do evento" required value="<?=$dados['rua']?>">
              </div>
              <div class="form-group col-md-6">
                <label for="txtNumero">Número:</label>
                <input type="number" min="0" class="form-control" id="txtNumero" name="txtNumero" placeholder="Número do estabelecimento" required onkeypress="return Onlynumbers(event)" value="<?=$dados['numero']?>">
              </div>     
            </div>

            <div class="form-row justify-content-center mt-3 mb-4">

              <textarea placeholder="Descrição do evento" cols="100" rows="4" class="form-control" name="txtDescricao" id="txtDescricao" required><?=$dados['descricao']?></textarea>

            </div>

            <div class="form-row justify-content-center mt-3 mb-4">

              <textarea placeholder="Informações adicionais" cols="100" rows="4" class="form-control" name="txtAdicional" id="txtAdicional" required><?=$dados['adicionais']?></textarea>

            </div>
            
            <div class="custom-control custom-checkbox mb-3">
              <input type="checkbox" class="custom-control-input" id="cboxTermos" name="cboxTermos" required>
              <input type="hidden" name="txtCodEvento" id="txtCodEvento" value="<?=$_GET['id']?>">
              <label class="custom-control-label" for="cboxTermos">Aceito os <a href="termos.php">Termos</a></label>
            </div>
            <button type="submit" class="btn btn-primary mb-3" id="btFinalizar" name="btAlterar">Alterar</button>
          </form>
        </div>    

        <?php

      }
      else{
// -------------------------- AQUI COMEÇA O SEM EDITAR -------------------
        ?>
        <div class="container">
          <div class="row justify-content-center text-center">
            <h5 class="fonteTitulo mt-5 mb-5 mr-auto ml-auto fonteHoje titulo">Cadastre seu evento</h5>
          </div>

          <form method="POST" action="php_action/cadastrarEvento.php" enctype="multipart/form-data">
            <div class="row justify-content-center mt-4" >
              <div class="col-md-9 mb-5">
                <div class="fundoImagemPrincipal">
                  <button type="button" class="btFechar btn btn-danger ml-auto mr-auto" name="btRemp" id="btRemp">x</button>
                  <img src="img/addImg.png" id="imgPrincipal" class="imagemPrincipal" name="imgPrincipal">
                  <input id="fileUploadPrincipal" name="fileUploadPrincipal" type="file"><br/>
                </div> 
              </div>
            </div>


            <div class="row justify-content-center">
              <div class="col-md-9">
                <div class="row justify-content-around text-center align-items-center">

                  <div class="col-md-4 mb-4">
                    <div class="fundoImagem ">
                      <button type="button" class="btFecharSec btn btn-danger ml-auto mr-auto" name="btRem1" id="btRem1">x</button>
                      <img src="img/imgUsuario/addImg.jpg" id="img1" name="img1" class="imagem">
                      <input id="fileUpload1" name="fileUpload1" type="file"><br/>
                    </div>            
                  </div>

                  <div class="col-md-4 mb-4">
                    <div class="fundoImagem">
                      <button type="button" class="btFecharSec btn btn-danger ml-auto mr-auto" name="btRem2" id="btRem2">x</button>
                      <img src="img/imgUsuario/addImg.jpg" id="img2" name="img2" class="imagem">
                      <input id="fileUpload2" name="fileUpload2" type="file"><br/>
                    </div>  
                  </div>

                  <div class="col-md-4 mb-4">
                    <div class="fundoImagem">
                      <button type="button" class="btFecharSec btn btn-danger ml-auto mr-auto" name="btRem2" id="btRem3">x</button>
                      <img src="img/imgUsuario/addImg.jpg" id="img3" name="img3" class="imagem">
                      <input id="fileUpload3" name="fileUpload3" type="file"><br/>
                    </div>  
                  </div>
                </div>
              </div>
            </div>

            <div class="row justify-content-center mt-3">
              <div class="col-md-9">

                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="txtNome">Nome evento:</label>
                    <input type="text" class="form-control" id="txtNome" name="txtNome" placeholder="Nome evento" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="txtTelefone">Telefone de contato:</label>
                    <input type="text" class="form-control" id="txtTelefone" name="txtTelefone" placeholder="Telefone do responsável" required minlength="10">
                  </div>

                </div>

                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="txtDtInicio">Data início:</label>
                    <input type="date" class="form-control" id="txtDtInicio" name="txtDtInicio" placeholder="Data início" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="txtDtFim">Data fim:</label>
                    <input type="date" class="form-control" id="txtDtFim" name="txtDtFim" placeholder="Data fim" required>
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="txtHrInicio">Hora início:</label>
                    <input type="time" class="form-control" id="txtHrInicio" name="txtHrInicio" placeholder="Hora início" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="txtHrFim">Hora fim:</label>
                    <input type="time" class="form-control" id="txtHrFim" name="txtHrFim" placeholder="Hora fim" required>
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="cbCategoria">Categoria:</label>
                    <select class="form-control" id="cbCategoria" name="cbCategoria" required>
                      <?php  

                      require_once 'php_action/db_connect.php';


                      $sql = "select * from tbl_categoria where situacao = 'a'";

                      $resultado = mysqli_query($connect,$sql);

                      mysqli_close($connect);

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
                  </div>



                  <div class="form-group col-md-6">
                    <label for="txtValor">Valor:</label>
                    <input type="text" class="form-control" id="txtValor" name="txtValor" placeholder="R$" required onkeypress="return numericValidation(this,event);">
                  </div>
                </div>


                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="txtCidade">Cidade:</label>
                    <input type="text" class="form-control" id="txtCidade" name="txtCidade" placeholder="Localidade do evento" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="txtBairro">Bairro:</label>
                    <input type="text" class="form-control" id="txtBairro" name="txtBairro" placeholder="Bairro do evento" required>
                  </div>  
                </div>

                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="txtRua">Rua:</label>
                    <input type="text" class="form-control" id="txtRua" name="txtRua" placeholder="Rua do evento">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="txtNumero">Número:</label>
                    <input type="number" min="0" class="form-control" id="txtNumero" name="txtNumero" placeholder="Número do estabelecimento" required onkeypress="return Onlynumbers(event)">
                  </div>     
                </div>


                <div class="form-row justify-content-center mt-3 mb-4">

                  <textarea placeholder="Descrição do evento" cols="100" rows="4" class="form-control" name="txtDescricao" id="txtDescricao" required></textarea>

                </div>

                <div class="form-row justify-content-center mt-3 mb-4">

                  <textarea placeholder="Informações adicionais" cols="100" rows="4" class="form-control" name="txtAdicional" id="txtAdicional" required></textarea>

                </div>
                <div class="custom-control custom-checkbox mb-3">
                  <input type="checkbox" class="custom-control-input" id="cboxTermos" name="cboxTermos" required>
                  <label class="custom-control-label" for="cboxTermos">Aceito os <a href="termos.php">Termos</a></label>
                </div>
                <button type="submit" class="btn btn-primary mb-3" id="btFinalizar" name="btFinalizar">Finalizar</button>
              </form>
            </div>
            <?php

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

    <script type="text/javascript" src="js/jquery.mask.js"></script>
    <script type="text/javascript" src="js/cadastroEvento.js"></script>
    <script type="text/javascript" src="js/imgPrev.min.js"></script>
    <script type="text/javascript">$('#modalInfo').modal('show');</script>

    <script type="text/javascript">

      function dataAtualFormatada(){
        var data = new Date(),
        dia  = data.getDate().toString(),
        diaF = (dia.length == 1) ? '0'+dia : dia,
        mes  = (data.getMonth()+1).toString(), //+1 pois no getMonth Janeiro começa com zero.
        mesF = (mes.length == 1) ? '0'+mes : mes,
        anoF = data.getFullYear();
        return anoF+"-"+mesF+"-"+diaF;
      }   

      $('#txtDtInicio').focusout(function(){
        if ($(this).val()< dataAtualFormatada()) {
          alert("Insira uma data maior que o dia atual.");
          $(this).val('');
        }
        $('#txtDtFim').focusout();
      });

      $('#txtDtFim').focusout(function(){
        var dt1 = $('#txtDtInicio').val();
        var dt2 = $('#txtDtFim').val();
        if ((dt1.length > 0 && dt2.length > 0) && dt1 > dt2) {
          alert("A data de fim deve ser maior que a de início");
          $('#txtDtFim').val('');
        }
      });



      function Onlynumbers(e)
      {
        var tecla=new Number();
        if(window.event) {
          tecla = e.keyCode;
        }
        else if(e.which) {
          tecla = e.which;
        }
        else {
          return true;
        }
        if((tecla >= "97") && (tecla <= "122")){
          return false;
        }
        if((tecla >= "33") && (tecla <= "47")){
          return false;
        }
        if(tecla == "69"){
          return false;
        }
      }

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

      function Onlychars(e)
      {
        var tecla=new Number();
        if(window.event) {
          tecla = e.keyCode;
        }
        else if(e.which) {
          tecla = e.which;
        }
        else {
          return true;
        }
        if((tecla >= "48") && (tecla <= "57")){
          return false;
        }
      }

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