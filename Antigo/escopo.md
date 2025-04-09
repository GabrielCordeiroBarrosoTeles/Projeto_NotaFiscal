Segue abaixo um exemplo de escopo para migrar os arquivos “produto.php” e “receber_login.php” para um padrão MVC leve. Esse documento define as etapas, objetivos e entregáveis do projeto, servindo como guia para a reorganização da estrutura de código e facilitando a manutenção e evolução da aplicação.

---

# Escopo do Projeto: Migração para Padrão MVC Leve

## 1. Introdução

Este projeto tem como objetivo reorganizar a estrutura atual dos arquivos PHP, especificamente o “produto.php” e “receber_login.php”, migrando-os para um padrão MVC leve. O intuito é separar as responsabilidades da aplicação (modelo, visão e controle), promovendo uma organização modular que facilita futuras manutenções, escalabilidade e segurança.

## 2. Objetivos

- **Melhorar a Organização do Código:**  
  Estruturar o projeto em pastas segregadas conforme a responsabilidade (Controllers, Models, Views) para seguir boas práticas de desenvolvimento.

- **Centralizar o Roteamento:**  
  Implementar um front controller (ponto único de entrada) que direcione as requisições aos respectivos controllers.

- **Facilitar a Manutenção e a Escalabilidade:**  
  Permitir a evolução do sistema sem a necessidade de alterar scripts soltos na raiz, garantindo uma separação clara entre lógica de negócio, manipulação de dados e apresentação.

- **Melhorar a Segurança e Reutilização do Código:**  
  Separar a lógica de autenticação e listagem de produtos em classes e métodos específicos, reduzindo a duplicidade e aumentando a robustez da aplicação.

## 3. Requisitos do Projeto

- **Funcionalidades Existentes:**  
  - Listagem de produtos (atualmente em “produto.php”)
  - Processamento do login (atualmente em “receber_login.php”)

- **Infraestrutura Técnica:**  
  - Servidor com PHP (versão compatível com PDO e recursos modernos)
  - Banco de Dados MySQL (ou similar) configurado para a conexão via PDO
  - Composer para gerenciar o autoloading via PSR-4 (recomendado)

- **Requisitos de Estrutura:**  
  Criação de diretórios para separar:
  - **Public:** Arquivos públicos e ponto de entrada.
  - **Src/Controller:** Lógica de controle (Product e Login).
  - **Src/Model:** Regras de negócio e acesso ao banco de dados.
  - **Src/View:** Templates de exibição.
  - **Config:** Arquivos de configuração (conexão com o banco, variáveis de ambiente).

## 4. Estrutura de Diretórios Proposta

```
├── public/                          # Arquivos acessíveis publicamente
│   ├── index.php                    # Front controller (rota principal)
│   └── assets/                      # CSS, imagens, JavaScript, etc.
│
├── src/
│   ├── Controller/                  # Controllers (lógica de controle)
│   │   ├── ProdutoController.php    # Manipulação dos produtos
│   │   └── LoginController.php      # Processamento do login
│   │
│   ├── Model/                       # Modelos (regras de negócio, acesso a dados)
│   │   ├── Produto.php              # Acesso aos dados dos produtos
│   │   └── Usuario.php              # Acesso aos dados do usuário para login
│   │
│   └── View/                        # Templates de exibição (HTML)
│       ├── produtos/                
│       │   └── index.php            # View de listagem de produtos
│       └── login/
│           └── form.php             # Formulário de login e feedback
│
├── config/
│   ├── config.php                   # Configurações gerais
│   └── dbcon.php                    # Conexão com o banco de dados
│
├── vendor/                          # Autoload e dependências do Composer
└── composer.json
```

## 5. Descrição das Etapas

### 5.1. Configuração Inicial e Autoloading

- **Atividade:**  
  Configurar o arquivo `composer.json` para mapear o namespace “App” para o diretório `src/` (utilizando PSR-4).  
- **Resultado Esperado:**  
  Autoload funcional para carregar automaticamente as classes dos Controllers, Models e Views.

### 5.2. Criação do Front Controller

- **Atividade:**  
  Criar o arquivo `public/index.php` que atue como ponto de entrada para todas as requisições.  
- **Responsabilidades:**  
  - Receber a requisição via query string ou rota amigável.  
  - Delegar a requisição para o controller correspondente (exemplo: ‘?page=produtos’ ou ‘?page=login’).
- **Resultado Esperado:**  
  Um roteador simples que direciona corretamente para os controllers de Produto e Login.

### 5.3. Implementação dos Controllers

- **ProdutoController:**  
  - Migrar a lógica do “produto.php” para um método (ex. `index()`) que interaja com o Model e inclua a View correta.  
- **LoginController:**  
  - Adaptar a lógica do “receber_login.php” para realizar o processamento do login, validando os dados recebidos, iniciando a sessão e redirecionando o usuário.
- **Resultado Esperado:**  
  Controllers que encapsulem a lógica de controle e chamem os modelos e views conforme necessário.

### 5.4. Criação dos Models

- **Produto Model:**  
  - Encapsular a lógica de acesso aos dados dos produtos, utilizando PDO para consultas ao banco de dados.  
- **Usuario Model:**  
  - Encapsular a lógica para recuperar os dados de usuário, inclusive a verificação de senha utilizando `password_hash()` e `password_verify()`.
- **Resultado Esperado:**  
  Models independentes que ofereçam métodos como `getAll()` para produtos e `getByUsername()` para usuário, permitindo fácil manutenção e testes unitários.

### 5.5. Desenvolvimento das Views

- **View para Produtos:**  
  - Criar um template que receba os dados dos produtos e os exiba de forma organizada (exemplo: uma lista simples).  
- **View para Login:**  
  - Criar um formulário de login que permita a entrada dos dados do usuário e apresente mensagens de erro quando necessário.
- **Resultado Esperado:**  
  Templates limpos e separados da lógica de negócio, focados apenas na apresentação dos dados.

### 5.6. Testes e Validação

- **Atividades:**  
  - Testar o roteamento verificando se as requisições são encaminhadas ao Controller correto.  
  - Realizar testes de autenticação, garantindo que dados válidos redirecionem o usuário, enquanto dados inválidos apresentem mensagens de erro.  
  - Testar a listagem dos produtos para confirmar que o Model está recuperando os dados corretamente.
- **Resultado Esperado:**  
  Aplicação funcional com cada camada (Controller, Model e View) interagindo conforme o esperado.

### 5.7. Documentação e Comentários

- **Atividade:**  
  Inserir comentários e documentação básica dentro do código, explicando a finalidade de cada método e classe.  
- **Resultado Esperado:**  
  Código legível e de fácil manutenção por outros desenvolvedores.

## 6. Cronograma e Entregáveis

- **Fase 1: Planejamento e Configuração**  
  - Configuração do Composer e definição da estrutura de diretórios.
  - **Prazo:** 1 dia

- **Fase 2: Desenvolvimento do Front Controller e Controllers**  
  - Criação do `public/index.php`.  
  - Implementação dos `ProdutoController` e `LoginController`.
  - **Prazo:** 2-3 dias

- **Fase 3: Implementação dos Models e Views**  
  - Criação dos arquivos `Produto.php` e `Usuario.php`.  
  - Desenvolvimento dos templates em `src/View/produtos/index.php` e `src/View/login/form.php`.
  - **Prazo:** 2-3 dias

- **Fase 4: Testes e Documentação**  
  - Realização dos testes de funcionalidade e ajustes.  
  - Documentação e comentários no código.
  - **Prazo:** 1-2 dias

- **Entrega Final:**  
  Consolidação do projeto com a estrutura MVC e homologação do ambiente funcional.

## 7. Considerações Finais

- **Escalabilidade:**  
  O padrão MVC adotado permite que novas funcionalidades sejam implementadas por meio da criação de novos controllers, models e views, mantendo a organização e a modularidade da aplicação.

- **Segurança:**  
  Centralizando o acesso ao banco de dados e o processamento de dados de entrada, o sistema fica mais protegido contra ataques comuns (injeção de SQL, vulnerabilidades de sessão, etc.).

- **Manutenibilidade:**  
  A separação clara entre responsabilidades facilita a identificação e correção de problemas, além de possibilitar testes unitários e de integração de forma mais efetiva.

---

Este escopo serve como um guia para a migração dos scripts existentes para uma estrutura MVC leve, aumentando a qualidade do código e preparando a aplicação para futuras expansões. Caso necessário, cada etapa pode ser detalhada ainda mais conforme o andamento do projeto ou a necessidade de customizações específicas no ambiente atual.