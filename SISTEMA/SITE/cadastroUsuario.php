<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Cadastre-se</title>

  <!-- Bootstrap core CSS -->
    <link rel="shortcut icon" href="img/icone.png" type="image/x-icon" />

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
  <!-- Custom styles for this template -->
  <link href="css/cadastroUsuario.css" type="text/css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Rock+Salt|Sintony" rel="stylesheet">
</head>
<body>


  <?php
  include_once 'php_action/mensagem.php';
  require_once 'php_action/db_connect.php';
  if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "select * from tbl_usuario where cod_usuario = '$id'";

    $resultado = mysqli_query($connect,$sql);


    $dados = mysqli_fetch_array($resultado);
  }
  ?>

  
  <?php  

  if (isset($_GET['id'])) {
    if ($_SESSION['logado'] != true) {
      header("Location: cadastroUsuario.php");
    }
    ?>

    <form class="form-signin" method="POST" action="php_action/alterarUsuario.php" name="form1">
      <div class="centro mb-5 pisca">
        <img src="img/Logo.png">
      </div>
      <h3 class="display-4 mb-4 text-center titulo branco fonteHoje">
        Alterar usuário
      </h3>
      <div class="form-group">
        <label for="txtNome" class="branco">Nome</label>
        <input type="text" class="form-control" id="txtNome" name="txtNome" placeholder="Ex: João da Silva" required value="<?= $dados['nm_usuario']; ?>">
      </div>
      <div class="form-group">
        <label for="txtEmail" class="branco">E-Mail</label>
        <input type="email" class="form-control" id="txtEmail" name="txtEmail" placeholder="Ex: joao@hotmail.com" required value="<?= $dados['email']; ?>">
      </div>
      <div class="form-group">
        <label for="cpf" class="branco">CPF</label>
        <input type="text" class="form-control" id="cpf" name="cpf" placeholder="Ex: 111.111.111-11" required minlength="11" onBlur="ValidarCPF(form1.cpf);" value="<?= $dados['cpf']; ?>"> 
      </div>
      <div class="form-group">
        <label for="txtSenha" class="branco">Senha</label>
        <input type="password" class="form-control" id="txtSenha" name="txtSenha" required>
      </div>
      <input type="hidden" name="txtCodigo" id="txtCodigo" value="<?= $dados['cod_usuario']; ?>">
      <div class="row ">
        <div class="col-md-4">
          <button type="submit" class="btn btn-primary mb-5 mt-3 p-2 rem-top btn-block" id="btAlterar" name="btAlterar">Salvar</button>
        </div>   
      </div>
    </form>
    <?php 
  }
  else{ ?>

    <!-- ---------------------------- Fim do editar -------------------- -->


    <form class="form-signin" method="POST" action="php_action/cadastrarUsuario.php"  name="form1">
      <div class="centro mb-5 pisca">
        <img src="img/Logo.png">
      </div>
      
      <h3 class="display-4 text-center titulo branco fonteHoje">
        Cadastre-se
      </h3>

      <div class="form-group mt-4">
        <label for="txtNome" class="branco">Nome</label>
        <input type="text" class="form-control" id="txtNome" name="txtNome" placeholder="Ex: João da Silva" required onkeypress="return Onlychars(event)">
      </div>
      <div class="form-group">
        <label for="txtEmail" class="branco">E-Mail</label>
        <input type="email" class="form-control" id="txtEmail" name="txtEmail" placeholder="Ex: joao@hotmail.com" required >
      </div>
      <div class="form-group">
        <label for="cpf" class="branco">CPF</label>
        <input type="text" class="form-control" id="cpf" name="cpf" placeholder="Ex: 111.111.111-11" required minlength="11" onBlur="ValidarCPF(form1.cpf);">
      </div>
      <div class="form-group">
        <label for="txtSenha" class="branco">Senha</label>
        <input type="password" class="form-control" id="txtSenha" name="txtSenha" required >
      </div>
      <div class="row ">
        <div class="col-md-8 mb-5 mt-4">
          <a href="login.php">Faça login em vez disso</a>
        </div>
        <div class="col-md-4">
          <button type="submit" class="btn btn-primary mb-5 mt-3 p-2 rem-top" id="btCadastrar" name="btCadastrar">Cadastrar</button>
        </div>   
      </div>
    </form>
    <?php
  }
  ?>





  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
  <script type="text/javascript" src="js/jquery.mask.js"></script>
  <script type="text/javascript" src="js/cadastroUsuario.js"></script>

  <script type="text/javascript">$('#modalInfo').modal('show');</script>
  <script type="text/javascript">
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
      if((tecla >= "33") && (tecla <= "47")){
        return false;
      }
    }
  </script>
</body>
</html>