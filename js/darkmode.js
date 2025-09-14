// Função para alternar o tema e salvar a preferência
function alternarTema() {
  const htmlTag = document.documentElement;
  const novoTema = htmlTag.getAttribute("data-bs-theme") === "dark" ? "light" : "dark";
  htmlTag.setAttribute("data-bs-theme", novoTema);
  localStorage.setItem("tema", novoTema);

  // Atualiza ícone e imagem
  trocarIcone(novoTema === "dark");
  trocarImagem(novoTema === "dark");
}

// Função para aplicar o tema salvo quando a página carrega
function aplicarTemaSalvo() {
  const temaSalvo = localStorage.getItem("tema") || 'light'; // Garante 'light' como padrão
  document.documentElement.setAttribute("data-bs-theme", temaSalvo);

  // Atualiza ícone e imagem
  trocarIcone(temaSalvo === "dark");
  trocarImagem(temaSalvo === "dark");
}

// Função para trocar o ícone baseada no tema
function trocarIcone(escuro) {
  const icone = document.getElementById('iconeModo');
  if (icone) {
    if (escuro) {
      icone.classList.remove('bi-moon-stars-fill');
      icone.classList.add('bi-sun-fill');
    } else {
      icone.classList.remove('bi-sun-fill');
      icone.classList.add('bi-moon-stars-fill');
    }
  }
}

// Função para trocar a imagem baseada no tema
function trocarImagem(escuro) {
  const imagem = document.getElementById('imagemTema');
  if (imagem) {
    imagem.src = escuro ? 'images/logoWhite.png' : 'images/logoC.png';
  }
}

function trocarImagem(escuro) {
  const imagem = document.getElementById('imagemTema2');
  if (imagem) {
    imagem.src = escuro ? 'images/logoWhiteI.png' : 'images/logoI.png';
  }
}

// Executa quando o conteúdo da página for carregado
document.addEventListener("DOMContentLoaded", () => {
  aplicarTemaSalvo();

  const botaoTema = document.getElementById("darkmode");
  if (botaoTema) {
    botaoTema.addEventListener("click", alternarTema);
  }
});