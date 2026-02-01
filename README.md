# Sistema de Gerenciamento de Biblioteca | Projeto de Back-end

📖 Sobre o Projeto

Este repositório contém o código-fonte do projeto de back-end para um **sistema de gerenciamento de acervo de uma biblioteca**. Desenvolvido como parte da disciplina de Projeto de Desenvolvimento em Back-End do curso de Análise e Desenvolvimento de Sistemas da UNISUAM, o objetivo principal é criar uma aplicação web robusta e segura para a **visualização de livros e a administração de usuários**.

A aplicação simula um ambiente real onde uma biblioteca busca digitalizar seu catálogo e gerenciar seus membros, preparando-se para otimizar o processo de empréstimos. O sistema conta com diferentes níveis de acesso, garantindo que as operações sensíveis sejam restritas a usuários autorizados.

---

✨ Funcionalidades Principais

O sistema foi projetado com as seguintes funcionalidades em mente:

* **Visualização do Acervo:** Uma página principal que exibe o catálogo de livros disponíveis para empréstimo, com suas respectivas descrições e informações de disponibilidade.
* **Sistema de Autenticação Completo:**
    * **Login Seguro:** Autenticação de usuários com validação de credenciais.
    * **Autenticação de Dois Fatores (2FA):** Uma camada extra de segurança para todos os usuários após o login.
* **Gerenciamento de Usuários:**
    * **Dois Níveis de Acesso:**
        * **Usuário Comum (Membro):** Pode se cadastrar, visualizar o acervo e alterar a própria senha.
        * **Usuário Master (Bibliotecário):** Tem acesso a funcionalidades restritas, como consultar, pesquisar e excluir membros.
    * **Cadastro de Novos Usuários:** Um formulário completo e intuitivo para o registro de novos membros da biblioteca.
* **Painel Administrativo:**
    * **Consulta de Membros:** Ferramenta de busca para que o bibliotecário encontre membros cadastrados.
    * **Logs de Acesso:** Tela para monitorar os registros de login dos usuários comuns no sistema, permitindo auditorias de segurança.
* **Modelo do Banco de Dados:** Acesso a uma visualização do Diagrama Entidade-Relacionamento (DER) para fácil compreensão da arquitetura dos dados.

---

🛠️ Tecnologias Utilizadas

Este projeto foi construído utilizando as seguintes tecnologias:

* **Back-end:** PHP
* **Banco de Dados:** MySQL
* **Front-end:** HTML5, CSS3, JavaScript (com suporte para framework Bootstrap).

---

👨‍💻 Autores

* Davi Ferreira Barros da Silva
* João Pedro da Fonseca Coelho
* Fernando Mateus Anulino da Silva
* Fernando Silva de Almeida

Professor Orientador: Artur Brandt
