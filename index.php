<!DOCTYPE html>
<html lang="pt-BR" data-bs-theme="light">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/index.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <title>UniLivros</title>
</head>
<body>
  <header class="p-3 bg-dark">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="index.php" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
          <img src="images/logoWhiteI.png" alt="Logo UniLivros" class="logoImg">
        </a>
        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="index.php" class="nav-link px-2 text-secondary">Home</a></li>
          <li><a href="modeloBD.php" class="nav-link px-2 text-white">Modelo de BD</a></li>
          <li><a href="log.php" class="nav-link px-2 text-white">Tela de LOG</a></li>
          <li><a href="usuario.php" class="nav-link px-2 text-white">Consulta de Usuário</a></li>
        </ul>
        <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
          <div class="input-group">
            <input type="search" class="form-control text-dark" placeholder="Pesquisar por..." aria-label="Search"/>
            <span class="input-group-text">
              <button type="submit" class="searchBtn">
                <i class="bi bi-search"></i>
              </button>
            </span>
          </div>
        </form>
        <div class="me-3">
          <button type="button" class="btn btn-secondary" id="darkmode"><i class="bi bi-sun-fill" id="iconeModo"></i></button>
        </div>
        <div class="text-end">
          <a href="login.php" class="text-decoration-none">
            <button type="button" class="btn btn-outline-light me-2">
              Login
            </button>
          </a>
          <a href="cadastroU.php">
            <button type="button" class="btn btn-primary">Cadastre-se</button>
          </a>
        </div>
      </div>
    </div>
  </header>

  <section class="hero">
    <div class="container px-4 py-5" id="custom-cards">
      <h2 class="pb-2 border-bottom">Custom cards</h2>
        <div class="row row-cols-1 row-cols-lg-3 align-items-stretch g-4 py-5">
          <div class="col">
            <div
              class="card card-cover h-100 overflow-hidden text-bg-dark rounded-4 shadow-lg"
              style="background-image: url(&quot;unsplash-photo-1.jpg&quot;)"
            >
              <div
                class="d-flex flex-column h-100 p-5 pb-3 text-white text-shadow-1"
              >
                <h3 class="pt-5 mt-5 mb-4 display-6 lh-1 fw-bold">
                  Short title, long jacket
                </h3>
                <ul class="d-flex list-unstyled mt-auto">
                  <li class="me-auto">
                    <img
                      src="https://github.com/twbs.png"
                      alt="Bootstrap"
                      width="32"
                      height="32"
                      class="rounded-circle border border-white"
                    />
                  </li>
                  <li class="d-flex align-items-center me-3">
                    <svg
                      class="bi me-2"
                      width="1em"
                      height="1em"
                      role="img"
                      aria-label="Location"
                    >
                      <use xlink:href="#geo-fill"></use>
                    </svg>
                    <small>Earth</small>
                  </li>
                  <li class="d-flex align-items-center">
                    <svg
                      class="bi me-2"
                      width="1em"
                      height="1em"
                      role="img"
                      aria-label="Duration"
                    >
                      <use xlink:href="#calendar3"></use>
                    </svg>
                    <small>3d</small>
                  </li>
                </ul>
              </div>
            </div>
    </div>
  </section>

  <footer class="d-flex bg-body">
    <div class="container">
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-5 py-5 my-5 border-top">
        <div class="col mb-3">
          <a href="index.php" class="d-flex align-items-center mb-3 link-body-emphasis text-decoration-none" aria-label="Bootstrap">
            <img src="images/logoC.png" alt="Logo UniLivros" class="logoImgFooter" id="imagemTema">
          </a>
          <p class="text-body-secondary">&copy; 2025 UniLivros. Todos os direitos reservados.</p>
        </div>
        <div class="col mb-3"></div>
        <div class="col mb-3">
          <h5>Seções</h5>
          <ul class="nav flex-column">
            <li class="nav-item mb-2">
              <a href="index.php" class="nav-link p-0">Home</a>
            </li>
            <li class="nav-item mb-2">
              <a href="modeloBD.php" class="nav-link p-0">Modelo de BD</a>
            </li>
            <li class="nav-item mb-2">
              <a href="log.php" class="nav-link p-0">Tela de LOG</a>
            </li>
            <li class="nav-item mb-2">
              <a href="usuario.php" class="nav-link p-0">Consulta de Usuário</a>
            </li>
          </ul>
        </div>
        <div class="col mb-3">
          <h5>Redes Sociais</h5>
          <ul class="nav flex-column">
            <li class="nav-item mb-2">
              <a href="#" class="nav-link p-0"><i class="bi bi-instagram"> @unilivros</i></a>
            </li>
            <li class="nav-item mb-2">
              <a href="#" class="nav-link p-0"><i class="bi bi-tiktok"> @_unilivros</i></a>
            </li>
            <li class="nav-item mb-2">
              <a href="#" class="nav-link p-0"><i class="bi bi-youtube"> /@unilivrosyt</i></a>
            </li>
            <li class="nav-item mb-2">
              <a href="#" class="nav-link p-0">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-twitter-x" viewBox="0 0 16 16"> <path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z"/></svg> @unilivros
              </a>
            </li>
          </ul>
        </div>
        <div class="col mb-3">
          <h5>Recursos</h5>
          <ul class="nav flex-column">
            <li class="nav-item mb-2">
              <a href="#" class="nav-link p-0">Política de Privacidade</a>
            </li>
            <li class="nav-item mb-2">
              <a href="#" class="nav-link p-0">Termos de Uso</a>
            </li>
            <li class="nav-item mb-2">
              <a href="#" class="nav-link p-0">Ajuda</a>
            </li>
            <li class="nav-item mb-2">
              <a href="#" class="nav-link p-0">Fale Conosco</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  <script src="js/darkmode.js"></script>
</body>
</html>