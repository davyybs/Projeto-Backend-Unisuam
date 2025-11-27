document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('formCadastro');
  const cpfInput = document.getElementById('cpf');
  const celularInput = document.getElementById('celular');


  const loginInput = document.getElementById('login') || document.querySelector('input[name="login"]');
  const senhaInput = document.getElementById('senha') || document.querySelector('input[name="senha"]');

  if (cpfInput) {
    cpfInput.addEventListener('input', () => {
      aplicarMascaraCPF(cpfInput);
      const erroElement = document.getElementById('cpfErro');
      if (erroElement) erroElement.style.display = 'none';
      cpfInput.setCustomValidity('');
    });
  }

  
  if (loginInput) {
  
    loginInput.setAttribute('pattern', '[A-Za-z]{6}');
    loginInput.setAttribute('minlength', '6');
    loginInput.setAttribute('maxlength', '6');
    loginInput.setAttribute('inputmode', 'text');

   
    loginInput.addEventListener('input', () => {
      const cleaned = loginInput.value.replace(/[^A-Za-z]/g, '').slice(0, 6);
      if (loginInput.value !== cleaned) loginInput.value = cleaned;
     
      if (cleaned.length === 6) loginInput.setCustomValidity('');
      else loginInput.setCustomValidity('usuario deve ter exatamente 6 letras.');
    });
  }


  if (senhaInput) {
    senhaInput.setAttribute('pattern', '[A-Za-z]{8}');
    senhaInput.setAttribute('minlength', '8');
    senhaInput.setAttribute('maxlength', '8');
    senhaInput.setAttribute('inputmode', 'text');

    senhaInput.addEventListener('input', () => {
      const cleaned = senhaInput.value.replace(/[^A-Za-z]/g, '').slice(0, 8);
      if (senhaInput.value !== cleaned) senhaInput.value = cleaned;
      if (cleaned.length === 8) senhaInput.setCustomValidity('');
      else senhaInput.setCustomValidity('Senha deve ter exatamente 8 letras.');
    });
  }

  if (form) {
    form.addEventListener('submit', validarFormulario);
  }

 
  document.getElementById('senha')?.addEventListener('input', validarSenha);
  document.getElementById('confirma_senha')?.addEventListener('input', () => {
    const senha = document.getElementById('senha').value;
    const confirma = document.getElementById('confirma_senha').value;
    if (senha === confirma) {
      document.getElementById('confirma_senha').setCustomValidity('');
    }
  });
});



function aplicarMascaraCPF(input) {
  let cpf = input.value.replace(/\D/g, '');

  if (cpf.length > 11) cpf = cpf.slice(0, 11);

  cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2');
  cpf = cpf.replace(/(\d{3})\.(\d{3})(\d)/, '$1.$2.$3');
  cpf = cpf.replace(/(\d{3})\.(\d{3})\.(\d{3})(\d{1,2})/, '$1.$2.$3-$4');

  input.value = cpf;
}

function validarCPF(cpf) {
  cpf = cpf.replace(/\D/g, '');

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

function validarCpf() {
  const cpfInput = document.getElementById('cpf');
  const cpfErro = document.getElementById('cpfErro');
  let cpf = cpfInput.value;

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

function formatarTelefone(input) {
  let tel = input.value.replace(/\D/g, '');

  if (!tel.startsWith('55')) tel = "55" + tel;

  tel = tel.substring(0, 13);

  const ddi = tel.substring(0, 2);
  const ddd = tel.substring(2, 4);
  const numero = tel.substring(4);

  if (tel.length <= 4) {
    input.value = `(+${ddi})${ddd}`;
    return;
  }

  if (numero.length <= 5) {
    input.value = `(+${ddi})${ddd}-${numero}`;
    return;
  }

  input.value = `(+${ddi})${ddd}-${numero.substring(0,5)}-${numero.substring(5)}`;
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

function toggleSenha(id) {
  const input = document.getElementById(id);
  if (input.type === 'password') {
    input.type = 'text';
  } else {
    input.type = 'password';
  }
}

function validarSenha() {
  const senha = document.getElementById('senha').value;
  const min = document.getElementById('min');
  const letras = document.getElementById('letras');
  const senhaN = document.getElementById('senhaN');
  const especial = document.getElementById('especial');

  if (min) min.style.color = senha.length >= 8 ? 'green' : 'red';
  if (letras) letras.style.color = /[A-Za-z]/.test(senha) ? 'green' : 'red';
  if (senhaN) senhaN.style.color = /\d/.test(senha) ? 'green' : 'red';
  if (especial) especial.style.color = /[\W_]/.test(senha) ? 'green' : 'red';
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

function validarUsuario() {
  const el = document.getElementById('usuario') || document.querySelector('input[name="usuario"]');
  if (!el) return true; 
  const usuario = el.value;
  const regex = /^[A-Za-z]{6}$/;
  if (!regex.test(usuario)) {
    el.setCustomValidity('Usuario inválido. Deve ter exatamente 6 letras.');
    return false;
  }
  el.setCustomValidity('');
  return true;
}

function validarSenhaAlfabetica() {
  const el = document.getElementById('senha') || document.querySelector('input[name="senha"]');
  if (!el) return true;
  const senha = el.value;
  const regex = /^[A-Za-z]{8}$/;
  if (!regex.test(senha)) {
    el.setCustomValidity('Senha inválida. Deve ter exatamente 8 letras.');
    return false;
  }
  el.setCustomValidity('');
  return true;
}

function validarFormulario(event) {
  event.preventDefault();

  const form = event.target;

  const camposObrigatorios = [
    'nome', 'data_nasc', 'sexo', 'nomeM', 'cpf', 'email',
    'celular', 'cep', 'rua', 'numero', 'bairro', 'cidade',
    'estado', 'usuario', 'senha', 'confirma_senha'
  ];

  for (const id of camposObrigatorios) {
    const campo = document.getElementById(id);
    if (!campo || !campo.value.trim()) {
      alert(`Por favor, preencha o campo "${campo ? campo.previousElementSibling?.textContent : id}" corretamente.`);
      if (campo) campo.focus();
      return false;
    }
  }

  
  if (!validarUsuario()) {
    const el = document.getElementById('usuario') || document.querySelector('input[name="usuario"]');
    if (el) el.focus();
    return false;
  }

  if (!validarSenhaAlfabetica()) {
    const el = document.getElementById('senha') || document.querySelector('input[name="senha"]');
    if (el) el.focus();
    return false;
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

setTimeout(() => {
  document.getElementById("msg1").style.display = "none";
  document.getElementById("msg2").style.display = "none";
}, 3000);
