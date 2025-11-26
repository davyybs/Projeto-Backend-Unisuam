document.addEventListener("DOMContentLoaded", () => {
  const form = document.querySelector(".form-livro");
  const fileInput = document.getElementById("capa");
  const linkInput = document.getElementById("link_capa");

  form.addEventListener("submit", (e) => {
    const fileFilled = fileInput.files.length > 0;
    const linkFilled = linkInput.value.trim() !== "";

    if ((fileFilled && linkFilled) || (!fileFilled && !linkFilled)) {
      e.preventDefault(); // Impede o envio
      alert("❌ Escolha apenas UMA opção: envie uma imagem OU insira um link da capa.");
      
      // Limpa os dois campos
      fileInput.value = "";
      linkInput.value = "";
      
      // Dá foco no campo da imagem pra guiar o usuário
      fileInput.focus();
      return false;
    }
  });
});
