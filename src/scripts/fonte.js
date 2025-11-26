let tamanhoFonteAtual = 16;

// Ajusta a fonte em delta (positivo ou negativo)
function alterarFonte(delta) {
  tamanhoFonteAtual += delta;
  if (tamanhoFonteAtual < 10) tamanhoFonteAtual = 10;
  if (tamanhoFonteAtual > 22) tamanhoFonteAtual = 22;
  document.body.style.fontSize = tamanhoFonteAtual + "px";
}

// Reseta o tamanho da fonte
function resetarFonte() {
  tamanhoFonteAtual = 16;
  document.body.style.fontSize = tamanhoFonteAtual + "px";
}

// Alterna visibilidade dos controles de fonte
function toggleControles() {
  // Desktop
  const controlesDesktop = document.getElementById("mnr-fonte");
  if (controlesDesktop) {
    controlesDesktop.style.display = controlesDesktop.style.display === "none" ? "flex" : "none";
  }

  // Mobile
  const controlesMobile = document.getElementById("mnr-fonte-mobile");
  if (controlesMobile) {
    controlesMobile.style.display = controlesMobile.style.display === "none" ? "flex" : "none";
  }
}

// Garante que os controles comecem ocultos
document.addEventListener("DOMContentLoaded", () => {
  const controlesDesktop = document.getElementById("mnr-fonte");
  if (controlesDesktop) controlesDesktop.style.display = "none";

  const controlesMobile = document.getElementById("mnr-fonte-mobile");
  if (controlesMobile) controlesMobile.style.display = "none";
});
