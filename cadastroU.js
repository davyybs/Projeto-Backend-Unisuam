
function validarCpf() {
  const cpfInput = document.getElementById('cpf');
  const cpfErro = document.getElementById('cpfErro');
  let cpf = cpfInput.value.replace(/\D/g, '');

  if (!validarCPF(cpf)) {
    cpfErro.style.display = 'block';
    cpfInput.setCustomValidity('CPF inválido.');
    return false;
  } else {
    cpfErro.style.display = 'none';
    cpfInput.setCustomValidity('');
    return true;
  }
}
function validarCPF(cpf) {
  if (cpf.length !== 11 || /^(\d)\1+$/.test(cpf)) return false;

  let soma = 0;
  for (let i = 0; i < 9; i++) {
    soma += parseInt(cpf.charAt(i)) * (10 - i);
  }
  let resto = (soma * 10) % 11;
  if (resto === 10 || resto === 11) resto = 0;
  if (resto !== parseInt(cpf.charAt(9))) return false;

  soma = 0;
  for (let i = 0; i < 10; i++) {
    soma += parseInt(cpf.charAt(i)) * (11 - i);
  }
  resto = (soma * 10) % 11;
  if (resto === 10 || resto === 11) resto = 0;
  if (resto !== parseInt(cpf.charAt(10))) return false;

  return true;
}
document.addEventListener('DOMContentLoaded', () => {
  const selectSexo = document.getElementById('sexo');
  const selectEstado = document.getElementById('estado');

  function removerOpcaoSelecione(selectElement) {
    const optionSelecione = selectElement.querySelector('option[value=""]');
    if (optionSelecione) {
      optionSelecione.remove();
    }
  }

  if (selectSexo) {
    selectSexo.addEventListener('focus', () => removerOpcaoSelecione(selectSexo));
  }

  if (selectEstado) {
    selectEstado.addEventListener('focus', () => removerOpcaoSelecione(selectEstado));
  }
});


function formatarTelefone(input) {
  let valor = input.value.replace(/\D/g, '');


  if (valor.startsWith('55')) {
    valor = valor.slice(2);
  }


  if (valor.length > 11) {
    valor = valor.slice(0, 11);
  }

  let formatted = '(+55)';

  if (valor.length > 0) {
    formatted += valor.slice(0, 2); 
  }
  if (valor.length >= 3) {
    formatted += '-';
    formatted += valor.slice(2); 
  }

  input.value = formatted;
}


function buscarEndereco() {
  const cep = document.getElementById('cep').value.replace(/\D/g, '');
  if (cep.length !== 8) return;

  fetch(`https://viacep.com.br/ws/${cep}/json/`)
    .then(res => res.json())
    .then(data => {
      if (data.erro) {
        alert('CEP não encontrado.');
        limparEndereco();
        return;
      }
      document.getElementById('rua').value = data.logradouro || '';
      document.getElementById('bairro').value = data.bairro || '';
      document.getElementById('cidade').value = data.localidade || '';
      document.getElementById('estado').value = data.uf || '';
    })
    .catch(() => {
      alert('Erro ao buscar o CEP.');
      limparEndereco();
    });
}

function limparEndereco() {
  document.getElementById('rua').value = '';
  document.getElementById('bairro').value = '';
  document.getElementById('cidade').value = '';
  document.getElementById('estado').value = '';
}


function toggleSenha() {
  const senha = document.getElementById('senha');
  const btn = event.target;
  if (senha.type === 'password') {
    senha.type = 'text';
    btn.textContent = 'Ocultar';
  } else {
    senha.type = 'password';
    btn.textContent = 'Mostrar';
  }
}

function toggleCSenha() {
  const senha = document.getElementById('confirma_senha');
  const btn = event.target;
  if (senha.type === 'password') {
    senha.type = 'text';
    btn.textContent = 'Ocultar';
  } else {
    senha.type = 'password';
    btn.textContent = 'Mostrar';
  }
}


function validarSenha() {
  const senha = document.getElementById('senha').value;
  const min = document.getElementById('min');
  const letras = document.getElementById('letras');
  const senhaN = document.getElementById('senhaN');
  const especial = document.getElementById('especial');

  min.style.color = senha.length >= 8 ? 'green' : 'red';
  letras.style.color = /[A-Za-z]/.test(senha) ? 'green' : 'red';
  senhaN.style.color = /\d/.test(senha) ? 'green' : 'red';
  especial.style.color = /[\W_]/.test(senha) ? 'green' : 'red';
}


function confirmarSenha() {
  const senha = document.getElementById('senha').value;
  const confirma = document.getElementById('confirma_senha').value;
  if (senha !== confirma) {
    document.getElementById('confirma_senha').setCustomValidity('As senhas não coincidem.');
    return false;
  } else {
    document.getElementById('confirma_senha').setCustomValidity('');
    return true;
  }
}


function validarFormulario(event) {
  event.preventDefault();

  const form = event.target;

  const camposObrigatorios = [
    'nome', 'data_nasc', 'sexo', 'nomeM', 'cpf', 'email',
    'celular', 'cep', 'rua', 'numero', 'bairro', 'cidade',
    'estado', 'login', 'senha', 'confirma_senha'
  ];

  for (const id of camposObrigatorios) {
    const campo = document.getElementById(id);
    if (!campo || !campo.value.trim()) {
      alert(`Por favor, preencha o campo "${campo.previousElementSibling.textContent}" corretamente.`);
      campo.focus();
      return false;
    }
  }

  if (!validarCpf()) {
    alert('CPF inválido.');
    document.getElementById('cpf').focus();
    return false;
  }

  if (!confirmarSenha()) {
    alert('As senhas não coincidem.');
    document.getElementById('confirma_senha').focus();
    return false;
  }

  if (!form.checkValidity()) {
    alert('Por favor, preencha o formulário corretamente.');
    return false;
  }

  
  form.submit();
}
document.addEventListener('DOMContentLoaded', () => {
  const form = document.querySelector('form');

  form.addEventListener('submit', validarFormulario);

  document.getElementById('celular').addEventListener('input', (e) => {
    formatarTelefone(e.target);
  });

  document.getElementById('senha').addEventListener('input', () => {
    validarSenha();
  });

  document.getElementById('cpf').addEventListener('input', () => {
    document.getElementById('cpfErro').style.display = 'none';
    document.getElementById('cpf').setCustomValidity('');
  });
});