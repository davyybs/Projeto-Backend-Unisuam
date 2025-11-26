<!-- Header -->
<header class="p-3 bg-dark">
  <div class="container d-flex align-items-center justify-content-between">

    <!-- Logo -->
    <a href="/Projeto-Backend-Unisuam/index.php" class="d-flex align-items-center text-white text-decoration-none">
      <img src="/Projeto-Backend-Unisuam/src/images/logoWhiteI.png" alt="Logo UniLivros" class="logoImg">
    </a>

    <!-- Botão Mobile -->
    <button class="btn btn-secondary d-lg-none" 
      type="button" 
      data-bs-toggle="collapse"
      data-bs-target="#mobileMenu"
      aria-controls="mobileMenu"
      aria-expanded="false"
      aria-label="Abrir Menu">
      <i class="bi bi-list"></i>
    </button>

    <!-- Menu Desktop -->
    <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0 d-none d-lg-flex">
      <li><a href="/Projeto-Backend-Unisuam/src/pages/modeloBD.php" class="nav-link px-2 text-white">Modelo Conceitual</a></li>
      <li><a href="/Projeto-Backend-Unisuam/src/pages/visualizar_livros.php" class="nav-link px-2 text-white">Visualizar Livros</a></li>
      <?php 
        if (isset($_SESSION['usuario_id'])) {
          $idUsuario = $_SESSION['usuario_id'];
          $sql = "SELECT tipo_usuario FROM cadastrou WHERE id = '$idUsuario'";
          $query = mysqli_query($conexao, $sql);
          $tipo_usuario = mysqli_fetch_assoc($query);

          if ($tipo_usuario['tipo_usuario'] == 'admin') {
      ?>      
        <li><a href="/Projeto-Backend-Unisuam/src/pages/cadastro_livro.php" class="nav-link px-2 text-white">Cadastro de Livros</a></li>
        <li><a href="/Projeto-Backend-Unisuam/src/pages/log.php" class="nav-link px-2 text-white">Registros de Usuário</a></li>
        <li><a href="/Projeto-Backend-Unisuam/src/pages/consulta_usuario.php" class="nav-link px-2 text-white">Consulta de Usuário</a></li>
      <?php
          } 
        }
      ?>
    </ul>

    <!-- Desktop: Fonte, Dark Mode, Login, Cadastro -->
    <div class="d-none d-lg-flex align-items-center">

      <!-- Acessibilidade -->
      <div class="me-3 aumentarfonte" id="fonte-desktop">
        <button onclick="toggleControles()" class="btn btn-secondary" title="Acessibilidade">
          <i class="bi bi-type"></i>
        </button>

        <div id="mnr-fonte" class="mnr" style="display:none;">
          <button onclick="alterarFonte(2)">A+</button>
          <button onclick="alterarFonte(-2)">A-</button>
          <button onclick="resetarFonte()">Resetar</button>
        </div>
      </div>

      <!-- Dark Mode -->
      <div class="me-3">
        <button type="button" class="btn btn-secondary" id="darkmode">
          <i class="bi bi-sun-fill" id="iconeModo"></i>
        </button>
      </div>

      <!-- Login & Cadastro -->
      <?php 
        if (!isset($_SESSION['usuario_id'])) {
      ?>
        <div class="text-end">
          <a href="/Projeto-Backend-Unisuam/src/pages/login.php" class="btn btn-outline-light me-2 text-decoration-none">Login</a>
        </div>
        <div class="text-end">
          <a href="/Projeto-Backend-Unisuam/src/pages/cadastro_usuario.php" class="btn btn-primary me-2 text-decoration-none">Cadastre-se</a>
        </div>
      <?php 
        } else {
      ?>
        <div class="user-panel-trigger" onclick="togglePanel()">
          <img src="/Projeto-Backend-Unisuam/src/images/userImg.png" class="user-icon">
        </div>
        <div class="overlay-user" id="overlay" onclick="closePanel()"></div>
        <?php 
          $userID = $_SESSION['usuario_id'];
          $sql = "SELECT * FROM cadastrou WHERE id = '$userID'";
          $query = mysqli_query($conexao, $sql);

          if (mysqli_num_rows($query) > 0) {
            foreach ($query as $usuario) {
        ?>
        <!-- Painel do Usuário -->
        <div class="user-panel" id="userPanel">
          <div class="panel-header d-flex align-items-center justify-content-between">
            <div class="user-email"><?= $usuario['email'] ?></div>
            <button class="close-panel" onclick="closePanel()"><i class="bi bi-x"></i></button>
          </div>

          <div class="text-center">
            <div class="user-avatar-large">
              <img src="/Projeto-Backend-Unisuam/src/images/userImg.png" class="user-icon">
            </div>
            <div class="greeting">Seja Bem-vindo, <?= $usuario['nome'] ?>!</div>
          </div>
          <?php 
           }
          }
          ?>
          <a href="/Projeto-Backend-Unisuam/src/actions/logout.php" class="action-btn text-decoration-none">
            <i class="bi bi-box-arrow-right"></i>
            <span>Terminar sessão</span>
          </a>
        </div>
        <?php }?>
      </div>

    </div>

  </div>

  <!-- Menu Mobile -->
  <div class="collapse d-lg-none mt-2" id="mobileMenu">

    <ul class="nav flex-column text-center mb-2">
      <li><a href="/Projeto-Backend-Unisuam/index.php" class="nav-link text-white">Home</a></li>
      <li><a href="/Projeto-Backend-Unisuam/src/pages/modeloBD.php" class="nav-link text-white">Modelo de BD</a></li>
      <li><a href="/Projeto-Backend-Unisuam/src/pages/log.php" class="nav-link text-white">Registros de Usuário</a></li>
      <li><a href="/Projeto-Backend-Unisuam/src/pages/consulta_usuario.php" class="nav-link text-white">Consulta de Usuário</a></li>
    </ul>

    <!-- Mobile: Fonte e Dark Mode -->
    <div class="d-flex justify-content-center mb-2 flex-wrap">
      <div class="me-2">
        <button onclick="toggleControles()" class="btn btn-secondary mb-1" title="Acessibilidade">
          <i class="bi bi-type"></i>
        </button>
      </div>

      <div>
        <button type="button" class="btn btn-secondary mb-1" onclick="alternarTema()">
          <i class="bi bi-sun-fill" id="iconeModoMobile"></i>
        </button>
      </div>
    </div>

    <?php 
      if (!isset($_SESSION['usuario_id'])) {
    ?>
      <div class="text-end">
        <a href="/Projeto-Backend-Unisuam/src/pages/login.php" class="btn btn-outline-light me-2 text-decoration-none">Login</a>
      </div>
      <div class="text-end">
        <a href="/Projeto-Backend-Unisuam/src/pages/cadastro_usuario.php" class="btn btn-primary me-2 text-decoration-none">Cadastre-se</a>
      </div>
      <?php 
        } else {
      ?>

        <!-- Botão para abrir o painel -->
        <div class="user-panel-trigger" onclick="togglePanel()">
          <img src="/Projeto-Backend-Unisuam/src/images/userImg.png" class="user-icon">
        </div>

        <!-- Overlay -->
        <div class="overlay-user" id="overlay" onclick="closePanel()"></div>
        <?php 
          $userID = $_SESSION['usuario_id'];
          $sql = "SELECT * FROM cadastrou WHERE id = '$userID'";
          $query = mysqli_query($conexao, $sql);

          if (mysqli_num_rows($query) > 0) {
            foreach ($query as $usuario) {
        ?>
        <!-- Painel do Usuário -->
        <div class="user-panel" id="userPanel">
          <div class="panel-header">
            <button class="close-panel" onclick="closePanel()">×</button>
            <div class="user-email"><?= $usuario['email'] ?></div>
          </div>

          <div class="text-center">
            <div class="user-avatar-large">
              <img src="/Projeto-Backend-Unisuam/src/images/userImg.png" class="user-icon">
            </div>
            <div class="greeting">Seja Bem-vindo, <?= $usuario['nome'] ?>!</div>
          </div>
          <?php 
           }
          }
          ?>
          <a href="/Projeto-Backend-Unisuam/src/actions/logout.php" class="action-btn text-decoration-none">
            <i class="bi bi-box-arrow-right"></i>
            <span>Terminar sessão</span>
          </a>
        </div>
        <?php }?>

  </div>
</header>