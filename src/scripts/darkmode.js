// Função para alternar o tema e salvar a preferência
function alternarTema() {
  const htmlTag = document.documentElement;
  const novoTema = htmlTag.getAttribute("data-bs-theme") === "dark" ? "light" : "dark";
  htmlTag.setAttribute("data-bs-theme", novoTema);
  localStorage.setItem("tema", novoTema);

  // Atualiza ícone, imagem e classe no body
  trocarIcone(novoTema === "dark");
  trocarImagens(novoTema === "dark");
  aplicarClasseBody(novoTema === "dark");
}

// Função para aplicar o tema salvo quando a página carrega
function aplicarTemaSalvo() {
  const temaSalvo = localStorage.getItem("tema") || 'light'; // Garante 'light' como padrão
  document.documentElement.setAttribute("data-bs-theme", temaSalvo);

  // Atualiza ícone, imagem e classe no body
  trocarIcone(temaSalvo === "dark");
  trocarImagens(temaSalvo === "dark");
  aplicarClasseBody(temaSalvo === "dark");
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

// Função unificada para trocar as imagens baseada no tema
function trocarImagens(escuro) {
  const imagem1 = document.getElementById('imagemTema');
  const imagem2 = document.getElementById('imagemTema2');

  if (imagem1) {
    imagem1.src = escuro ? '../images/logoWhite.png' : '../images/logoC.png';
  }
  if (imagem2) {
    imagem2.src = escuro ? '../images/logoWhiteI.png' : '../images/logoI.png';
  }
}

// Função para adicionar/remover a classe "darkmode" no body
function aplicarClasseBody(escuro) {
  if (escuro) {
    document.body.classList.add("darkmode");
  } else {
    document.body.classList.remove("darkmode");
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