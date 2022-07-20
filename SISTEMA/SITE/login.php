<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Login</title>

  <!-- Bootstrap core CSS -->
  <link rel="shortcut icon" href="img/icone.png" type="image/x-icon" />

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

  <!-- Custom styles for this template -->
  <link href="css/login.css" type="text/css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Rock+Salt|Sintony" rel="stylesheet">
</head>

<body>

  <?php
  // Conexão
  include_once 'php_action/mensagem.php';
  require_once 'php_action/db_connect.php';


  function clear($input){
    global $connect;
    // Sql
    $var = mysqli_escape_string($connect,$input);

    // XSS

    $var = htmlspecialchars($var);

    return $var;
  }

  if (isset($_SESSION['adm'])) {
    if ($_SESSION['adm'] == true) {
      header('Location: adm/index.php');
    }
  }

  // Botão enviar
  if (isset($_POST['entrar'])) {

    $email = clear($_POST['txtEmail']);
    $senha = clear($_POST['txtSenha']);

    $senha = md5($senha);

    $sql = "select * from tbl_usuario where email = '$email' and senha = '$senha' and situacao = 'a'";

    $resultado = mysqli_query($connect,$sql);

    mysqli_close($connect);

    if (mysqli_num_rows($resultado) > 0) {
      $dados = mysqli_fetch_array($resultado);
      if ($dados['cargo'] == 'a') {
        $_SESSION['logado'] = true;
        $_SESSION['adm'] = true;
        $_SESSION['id'] = $dados['cod_usuario'];
        header('Location: adm/index.php');
      }
      else{
        $_SESSION['logado'] = true;
        $_SESSION['id'] = $dados['cod_usuario'];
        header('Location: index.php');
      }

    }
    else{
      header('Location: login.php');
      $_SESSION['msg'] = "Usuário ou senha inválidos";
    }

  }

  ?>

  <form class="form-signin" method="POST" action="">
    <div class="centro mb-5 pisca"><img src="img/Logo.png"></div>

    <div class="form-group">
      <label for="txtEmail" class="branco">Email</label>
      <input type="email" class="form-control" id="txtEmail" name="txtEmail" placeholder="Ex: joao@hotmail.com" required>
      <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
    </div>
    <div class="form-group">
      <label for="txtSenha" class="branco">Senha</label>
      <input type="password" class="form-control" id="txtSenha" name="txtSenha" required>
    </div>
    <!-- <div class="form-group form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Manter-me Logado</label>
  </div> -->
  <button type="submit" class="btn btn-primary btn-block mb-5 btClaro" id="entrar" name="entrar">Entrar</button>
  <div>
    <hr>
    <p class="mt-2 text-center branco">Não tem cadastro? <a href="cadastroUsuario.php">Cadastre-se</a></p>
    <p class="mt-4 text-center"><a href="index.php">Voltar</a></p>
  </div>
</form>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
<script type="text/javascript">$('#modalInfo').modal('show');</script>
</body>
</html>
