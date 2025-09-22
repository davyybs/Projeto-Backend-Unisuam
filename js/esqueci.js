const cpfInput = document.getElementById("cpf");
const cpfErro = document.getElementById("cpf-erro");
const btnEnviar = document.getElementById("btnEnviar");
const mensagemContainer = document.getElementById("mensagem-container");

function formatarCPF(valor) {
  return valor
    .replace(/\D/g, "")
    .replace(/(\d{3})(\d)/, "$1.$2")
    .replace(/(\d{3})(\d)/, "$1.$2")
    .replace(/(\d{3})(\d{1,2})$/, "$1-$2");
}

function validarCPF(cpf) {
  cpf = cpf.replace(/\D/g, "");
  if (cpf.length !== 11 || /^(\d)\1+$/.test(cpf)) return false;
  let soma = 0;
  for (let i = 0; i < 9; i++) soma += parseInt(cpf[i]) * (10 - i);
  let resto = (soma * 10) % 11;
  if (resto === 10 || resto === 11) resto = 0;
  if (resto !== parseInt(cpf[9])) return false;
  soma = 0;
  for (let i = 0; i < 10; i++) soma += parseInt(cpf[i]) * (11 - i);
  resto = (soma * 10) % 11;
  if (resto === 10 || resto === 11) resto = 0;
  return resto === parseInt(cpf[10]);
}

cpfInput.addEventListener("input", () => {
  cpfInput.value = formatarCPF(cpfInput.value);
  const cpfLimpo = cpfInput.value.replace(/\D/g, "");
  if (cpfLimpo.length === 11 && validarCPF(cpfLimpo)) {
    cpfErro.classList.add("d-none");
    btnEnviar.disabled = false;
  } else {
    cpfErro.classList.remove("d-none");
    btnEnviar.disabled = true;
  }
});

document.getElementById("formRecuperar").addEventListener("submit", async (e) => {
  e.preventDefault();
  btnEnviar.disabled = true;
  mostrarMensagem("Enviando...", "alert-info");
  try {
    const response = await fetch("http://localhost/php/enviar.php", {
      method: "POST",
      headers: { "Content-Type": "application/json", "Accept": "application/json" },
      body: JSON.stringify({ cpf: cpfInput.value.replace(/\D/g, "") })
    });
    const data = await response.json();
    if (response.ok) {
      mostrarMensagem(data.sucesso || "Link enviado para o e-mail cadastrado!", "alert-success");
      cpfInput.value = "";
      btnEnviar.disabled = true;
    } else {
      mostrarMensagem(data.erro || "Erro ao enviar e-mail", "alert-danger");
    }
  } catch (error) {
    mostrarMensagem("Erro de conexão. Tente novamente.", "alert-danger");
  }
});

function mostrarMensagem(texto, classe) {
  mensagemContainer.innerHTML = `<div class="alert ${classe}" role="alert">${texto}</div>`;
}
