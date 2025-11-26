document.addEventListener('DOMContentLoaded', () => {
    // Referências aos campos principais que precisam de listeners globais
    const cpfInput = document.getElementById('cpf');
    const celularInput = document.getElementById('celular');
    const cepInput = document.getElementById('cep');

    // 1. FUNCIONALIDADE DO CPF (Máscara)
    if (cpfInput) {
        cpfInput.addEventListener('input', () => {
            aplicarMascaraCPF(cpfInput);
            // Esconde o erro ao digitar
            const erroElement = document.getElementById('cpfErro');
            if (erroElement) erroElement.style.display = 'none';
            cpfInput.setCustomValidity('');
        });
        // Opcional: Chama a validação no blur (quando sai do campo)
        cpfInput.addEventListener('blur', validarCpf);
    }

    // 2. FUNCIONALIDADE DO CELULAR (Formatação)
    if (celularInput) {
        celularInput.addEventListener('input', () => {
            formatarTelefone(celularInput);
        });
    }

    // 3. FUNCIONALIDADE DO CEP (Busca de Endereço)
    if (cepInput) {
        // CORREÇÃO: Chama a função buscarEndereco() quando o campo CEP perde o foco ('blur')
        cepInput.addEventListener('blur', buscarEndereco);

        // Opcional: Adiciona máscara de CEP (XXXXX-XXX)
        cepInput.addEventListener('input', () => {
            let cep = cepInput.value.replace(/\D/g, '');
            if (cep.length > 8) cep = cep.slice(0, 8);
            if (cep.length > 5) {
                cepInput.value = cep.replace(/(\d{5})(\d)/, '$1-$2');
            } else {
                cepInput.value = cep;
            }
        });
    }

    // Outros listeners da página (como senha, se existirem)
    document.getElementById('senha')?.addEventListener('input', validarSenha);
    document.getElementById('confirma_senha')?.addEventListener('input', () => {
        const senha = document.getElementById('senha').value;
        const confirma = document.getElementById('confirma_senha').value;
        if (senha === confirma) {
            document.getElementById('confirma_senha').setCustomValidity('');
        }
    });

    // O listener do form.submit deve ficar na página específica (cadastro ou edição)
    // Se esta for uma biblioteca de funções, o listener do form deve estar fora.
});


/* ==========================================================
 * FUNÇÕES DE MÁSCARA E VALIDAÇÃO
 * ========================================================== */

// Função: Aplica máscara de CPF (XXX.XXX.XXX-XX)
function aplicarMascaraCPF(input) {
    let cpf = input.value.replace(/\D/g, '');

    if (cpf.length > 11) cpf = cpf.slice(0, 11);

    cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2');
    cpf = cpf.replace(/(\d{3})\.(\d{3})(\d)/, '$1.$2.$3');
    cpf = cpf.replace(/(\d{3})\.(\d{3})\.(\d{3})(\d{1,2})/, '$1.$2.$3-$4');

    input.value = cpf;
}

// Função: Verifica a validade do CPF
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

// Função: Aplica validação visual do CPF
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

// Função: Formata o telefone (ex: (+55)DD-XXXXXXXXX)
function formatarTelefone(input) {
    let tel = input.value.replace(/\D/g, '');

    // Adiciona o código do país se não estiver presente
    if (!tel.startsWith('55')) tel = '55' + tel;

    // Aplica a formatação (+55)DD-Número
    if (tel.length > 2) {
        let ddd = tel.slice(2, 4);
        let numero = tel.slice(4);
        input.value = `(+55)${ddd}-${numero}`;
    }
}

// Função: Limpa os campos de endereço
function limparEndereco() {
    document.getElementById('rua').value = '';
    document.getElementById('bairro').value = '';
    document.getElementById('cidade').value = '';
    document.getElementById('estado').value = '';
}

// Função: Busca o endereço na API ViaCEP
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
            // Preenche os campos
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

// Funções de Senha (mantidas para completude)
function validarSenha() {
    // ... Lógica de validação de senha
}

function confirmarSenha() {
    // ... Lógica de confirmação de senha
}