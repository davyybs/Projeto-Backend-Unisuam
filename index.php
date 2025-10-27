<!DOCTYPE html>
<html lang="pt-BR" data-bs-theme="light">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <link rel="stylesheet" href="src/css/index.css">
  <script src="src/scripts/fonte.js" defer></script>
  <title>UniLivros</title>
</head>

<body>

  <!-- Header -->
  <header class="p-3 bg-dark">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="index.php" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
          <img src="src/images/logoWhiteI.png" alt="Logo UniLivros" class="logoImg">
        </a>
        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="index.php" class="nav-link px-2 text-secondary">Home</a></li>
          <li><a href="src/pages/modeloBD.php" class="nav-link px-2 text-white">Modelo de BD</a></li>
          <li><a href="src/pages/log.php" class="nav-link px-2 text-white">Registros de Usuário</a></li>
          <li><a href="src/pages/consulta_usuario.php" class="nav-link px-2 text-white">Consulta de Usuário</a></li>
        </ul>
        <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
          <div class="input-group">
            <input type="search" class="form-control text-body" placeholder="Pesquisar por..." aria-label="Search" />
            <span class="input-group-text">
              <button type="submit" class="searchBtn">
                <i class="bi bi-search"></i>
              </button>
            </span>
          </div>
        </form>

        <div class="position-relative me-3">
          <button class="btn btn-secondary" onclick="toggleControles()" title="Acessibilidade">
            <i class="bi bi-type"></i>
          </button>

          <div id="mnr-fonte" class="mnr  text-body" style="display:none; left:-60px;">
            <button class="btn btn-primary w-100 mb-2 text-body" onclick="alterarFonte(2)">A+</button>
            <button class="btn btn-primary w-100 mb-2 text-body" onclick="alterarFonte(-2)">A-</button>
            <button class="btn btn-primary w-100 mb-2 text-body" onclick="resetarFonte()">Resetar</button>
          </div>
        </div>

        <div class="me-3">
          <button type="button" class="btn btn-secondary" id="darkmode"><i class="bi bi-sun-fill"
              id="iconeModo"></i></button>
        </div>
        <div class="text-end">
          <a href="src/pages/login.php" class="btn btn-outline-light me-2 text-decoration-none">Login</a>
        </div>
        <div class="text-end">
          <a href="src/pages/cadastro_usuario.php" class="btn btn-primary me-2 text-decoration-none">Cadastre-se</a>
        </div>
      </div>
    </div>
    </div>
  </header>

  <!-- Seção Hero -->
  <section class="hero">
    <div class="container px-4 py-3" id="custom-cards">

      <div class="row row-cols-1 row-cols-lg-3 align-items-stretch g-4 py-5 cardH">
        <div class="col">
          <a href="#lancamentos" class="link-underline-opacity-0">
            <div class="card card-cover h-100 overflow-hidden text-bg-dark rounded-4 shadow-lg card1">
              <div class="d-flex flex-column h-100 p-5 pb-3 text-white text-shadow-1">
                <div class="overlay"></div>
                <h3 class="pt-5 mt-5 mb-4 display-6 lh-1 fw-bold">Lançamentos</h3>
              </div>
            </div>
          </a>
        </div>

        <div class="col">
          <a href="#populares" class="link-underline-opacity-0">
            <div class="card card-cover h-100 overflow-hidden text-bg-dark rounded-4 shadow-lg card2">
              <div class="d-flex flex-column h-100 p-5 pb-3 text-white text-shadow-1">
                <div class="overlay"></div>
                <h3 class="pt-5 mt-5 mb-4 display-6 lh-1 fw-bold">Populares no momento</h3>
              </div>
            </div>
          </a>
        </div>

        <div class="col">
          <a href="#recomendacoes" class="link-underline-opacity-0">
            <div class="card card-cover h-100 overflow-hidden text-bg-dark rounded-4 shadow-lg card3">
              <div class="d-flex flex-column h-100 p-5 pb-3 text-shadow-1">
                <div class="overlay"></div>
                <h3 class="pt-5 mt-5 mb-4 display-6 lh-1 fw-bold">Recomendações</h3>
              </div>
            </div>
          </a>
        </div>
      </div>
      <hr>
    </div>
  </section>

  <!-- Seção Conteúdo -->
  <section class="conteudo">
    <div class="container">
      <div class="lancamentos mb-4" id="lancamentos">
        <div>
          <h2 class="text-primary-emphasis fs-3 fw-semibold nav-link mb-4"><span class="text-primary fs-3">|</span>
            Lançamentos</h2>
        </div>
        <div class="row mb-2">
          <div class="col-md-6">
            <div
              class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative cardConteudo">
              <div class="col p-4 d-flex flex-column position-static">
                <strong class="d-inline-block mb-2 text-warning-emphasis">HQ</strong>
                <h3 class="mb-0">Supergirl: Mulher do Amanhã</h3>
                <div class="mb-1 text-body-secondary">Tom King</div>
                <p class="card-text mt-2 mb-auto">
                  Kara Zor-El passou por muitas aventuras épicas ao longo dos anos, mas hoje acredita estar sem
                  propósito. Até que tudo muda, quando uma garota alienígena a procura para uma missão de vingança
                  contra os vilões que exterminaram seu planeta.
                </p>
              </div>
              <div class="col-auto d-none d-lg-block">
                <img src="https://m.media-amazon.com/images/I/81WCblz7GnL._UF1000,1000_QL80_.jpg"
                  alt="Capa Supergirl Mulher do Amanhã" width="163">
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div
              class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative cardConteudo">
              <div class="col p-4 d-flex flex-column position-static">
                <strong class="d-inline-block mb-2 text-success-emphasis">Livros</strong>
                <h3 class="mb-0">Noites Brancas</h3>
                <div class="mb-1 text-body-secondary">Fiódor Dostoiévski</div>
                <p class="card-text mt-2 mb-auto">
                  Noites Brancas é uma obra do escritor russo Fiódor Dostoiévski. O livro que mais aproxima Dostoiévski
                  do romantismo, foi publicado em 1848, antes de sua prisão.
                </p>
              </div>
              <div class="col-auto d-none d-lg-block">
                <img src="https://m.media-amazon.com/images/I/71F-Uf20+UL._SL1000_.jpg" alt="Capa Noites Brancas"
                  width="174">
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="populares mb-4" id="populares">
        <div>
          <h2 class="text-primary-emphasis fs-3 fw-semibold nav-link mb-4"><span class="text-primary fs-3">|</span>
            Populares no momento</h2>
        </div>
        <div class="row mb-2">
          <div class="col-md-6">
            <div
              class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative cardConteudo">
              <div class="col p-4 d-flex flex-column position-static">
                <strong class="d-inline-block mb-2 text-success-emphasis">Livros</strong>
                <h3 class="mb-0">A Biblioteca da Meia Noite</h3>
                <div class="mb-1 text-body-secondary">Matt Haig</div>
                <p class="card-text mt-2 mb-auto">
                  Após uma tentativa de suicídio, uma mulher tem a chance de viver todas as suas vidas alternativas em
                  uma biblioteca mágica para descobrir o que faz a vida valer a pena.
                </p>
              </div>
              <div class="col-auto d-none d-lg-block">
                <img src="https://m.media-amazon.com/images/I/81iqH8dpjuL._SL1500_.jpg"
                  alt="Capa A Biblioteca da Meia Noite" width="172.2">
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div
              class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative cardConteudo">
              <div class="col p-4 d-flex flex-column position-static">
                <strong class="d-inline-block mb-2 text-success-emphasis">Livros</strong>
                <h3 class="mb-0">A Metamorfose</h3>
                <div class="mb-1 text-body-secondary">Franz Kafka</div>
                <p class="card-text mt-2 mb-auto">
                  O caixeiro-viajante Gregor acorda transformado em um enorme inseto. Isolado, ele passa a observar a
                  reação de sua família à sua metamorfose e, enquanto luta para sobreviver, reflete sobre sua nova e
                  estranha condição.
                </p>
              </div>
              <div class="col-auto d-none d-lg-block">
                <img src="https://m.media-amazon.com/images/I/715JOcuqSSL._SL1021_.jpg" alt="Capa A Metamorfose"
                  width="173.9">
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="recomendacoes mb-4" id="recomendacoes">
        <div>
          <h2 class="text-primary-emphasis fs-3 fw-semibold nav-link mb-4"><span class="text-primary fs-3">|</span>
            Recomendações</h2>
        </div>
        <div class="row mb-2">
          <div class="col-md-6">
            <div
              class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative cardConteudo">
              <div class="col p-4 d-flex flex-column position-static">
                <strong class="d-inline-block mb-2 text-success-emphasis">Livros</strong>
                <h3 class="mb-0">A Vida Invisível de Addie Larue</h3>
                <div class="mb-1 text-body-secondary">V. E. Schwab</div>
                <p class="card-text mt-2 mb-auto">
                  Para ganhar a imortalidade, Addie LaRue faz um pacto que a condena a ser esquecida por todos, vivendo
                  invisível por 300 anos, até encontrar o único homem que se lembra do seu nome.
                </p>
              </div>
              <div class="col-auto d-none d-lg-block">
                <img src="https://m.media-amazon.com/images/I/71X245OYRBL._SL1500_.jpg"
                  alt="Capa A Vida Invisível de Addie Larue" width="168.5">
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div
              class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative cardConteudo">
              <div class="col p-4 d-flex flex-column position-static">
                <strong class="d-inline-block mb-2 text-danger-emphasis">Mangá</strong>
                <h3 class="mb-0">Frieren e a Jornada Para o Além</h3>
                <div class="mb-1 text-body-secondary">Kanehito Yamada</div>
                <p class="card-text mt-2 mb-auto">
                  Depois de derrotar o Rei Demônio, a elfa Frieren inicia uma longa jornada para entender a passagem do
                  tempo, a vida e os sentimentos de seus falecidos companheiros humanos, após a grande aventura ter
                  chegado ao fim.
                </p>
              </div>
              <div class="col-auto d-none d-lg-block">
                <img src="https://m.media-amazon.com/images/I/71t11qhOQVL._SL1000_.jpg"
                  alt="Capa Frieren e a Jornada Para o Além" width="171">
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>

  <!-- Footer -->
  <footer class="d-flex bg-body">
    <div class="container">
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-5 py-5 my-5 border-top">
        <div class="col mb-3">
          <a href="index.php" class="d-flex align-items-center mb-3 link-body-emphasis text-decoration-none"
            aria-label="Bootstrap">
            <img src="src/images/logoC.png" alt="Logo UniLivros" class="logoImgFooter" id="imagemTema">
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
              <a href="src/pages/modeloBD.php" class="nav-link p-0">Modelo de BD</a>
            </li>
            <li class="nav-item mb-2">
              <a href="src/pages/log.php" class="nav-link p-0">Tela de LOG</a>
            </li>
            <li class="nav-item mb-2">
              <a href="src/pages/consulta_usuario.php" class="nav-link p-0">Consulta de Usuário</a>
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
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                  class="bi bi-twitter-x" viewBox="0 0 16 16">
                  <path
                    d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z" />
                </svg> @unilivros
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

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
  </script>
  <script src="src/scripts/darkmode.js"></script>
</body>

</html>