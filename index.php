<?php 
  session_start();
  require_once 'src/config/conexao.php';
?>

<!DOCTYPE html>
<html lang="pt-BR" data-bs-theme="light">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <link rel="stylesheet" href="src/css/user.css">
  <link rel="stylesheet" href="src/css/index.css">
  <link rel="stylesheet" href="src/css/responsividade.css">
  <script src="src/scripts/user.js" defer></script>
  <script src="src/scripts/fonte.js" defer></script>
  <title>UniLivros</title>
</head>

<body>

  <?php 
    include('src/pages/includes/header.php');
  ?>

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

  <?php 
    include('src/pages/includes/footer.php');
  ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
  </script>
  <script src="src/scripts/darkmode.js"></script>
</body>

</html>