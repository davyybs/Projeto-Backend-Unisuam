
  let tamanhoFonteAtual = 16;

  function alterarFonte(delta) {
    tamanhoFonteAtual += delta;
    if (tamanhoFonteAtual < 10) tamanhoFonteAtual = 10;
    if (tamanhoFonteAtual > 22) tamanhoFonteAtual = 22;
    document.body.style.fontSize = tamanhoFonteAtual + "px";
  }

  function resetarFonte() {
    tamanhoFonteAtual = 16;
    document.body.style.fontSize = tamanhoFonteAtual + "px";
  }

  function toggleControles() {
    const controles = document.getElementById("mnr-fonte");
    controles.style.display = controles.style.display === "none" ? "flex" : "none";
  }

