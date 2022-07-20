<nav class="navbar navbar-expand-lg navbar-dark">

  <a class="navbar-brand" href="index.php"><img src="img/ic.png" class="d-inline-block align-top" alt=""></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active margemD">
        <a class="nav-link" href="<?= $_SESSION['pagina']; ?>">Voltar</a>
      </li>
      <li class="nav-item dropdown active">
      <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span class="usuario">
            <?php  

            require_once 'php_action/db_connect.php';

            if (isset($_SESSION['id'])) {
              $id = $_SESSION['id'];

              $sql = "select nm_usuario from tbl_usuario where cod_usuario = '$id'";

              $resultado = mysqli_query($connect,$sql);

              $dados = mysqli_fetch_array($resultado);

              echo $dados['nm_usuario'];
            }

            ?>
          </span>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="perfil.php">Perfil</a>
          <a class="dropdown-item" href="php_action/logout.php">Sair</a>
        </div>
      </li>
    </ul>

  </div>
</nav>