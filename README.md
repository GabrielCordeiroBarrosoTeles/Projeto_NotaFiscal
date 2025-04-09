# 🌟 **Sistema de Gerenciamento de Estoque e Impressão de Nota Fiscal**

---

## 🚀 **Próximas Atualizações!**

### ✅ **Ajustes Realizados**
1. **Ajuste de Arquivos**:  
   - `cadastrar_usuario.php`  
   - `cadastro.php`  

2. **Estruturação de Arquivos**:  
   - **Arquivos ajustados movidos para a pasta**:  
     - `adm/`  

### 🛠️ **Hierarquia de Usuários Implementada**
- **Níveis de Usuários e Permissões**:
  - **Usuário Comum**:
    - Apenas visualização de informações limitadas (acesso restrito a determinadas áreas).
  - **Operador**:
    - Realizar vendas (gerando notas fiscais).
    - Cadastrar clientes e produtos no estoque.
  - **Administrador (ADM)**:
    - Adicionar, editar e deletar:
      - Cadastros de clientes e usuários.
      - Produtos no estoque.
      - Notas fiscais geradas.

### ⚠️ **Objetivo**
- Melhorar o controle e a segurança do sistema, garantindo que cada tipo de usuário tenha permissões específicas de acordo com suas funções.

---

## 📌 Escopo da Próxima Atualização

Nesta atualização, o foco será na **migração dos arquivos** `produto.php` e `receber_login.php` para um **padrão MVC leve**. Essa reorganização visa:

- Separar as responsabilidades da aplicação (Model, View, Controller), facilitando a manutenção, escalabilidade e segurança do sistema.
- Centralizar o roteamento por meio de um front controller que direciona as requisições aos respectivos controllers.
- Modularizar a estrutura com diretórios específicos, como **Controllers**, **Models**, **Views** e **Config**.

Para conferir o documento completo com todas as etapas, objetivos, requisitos, estrutura de diretórios e cronograma, acesse:  

[Escopo do Projeto: Migração para Padrão MVC Leve](Antigo/escopo.md)


---

### O que foi feito:
1. **Ajuste nas permissões de usuário**: 
   - Agora, o sistema possui diferentes tipos de usuários: **usuário comum**, **operador** e **administrador (ADM)**, com permissões diferenciadas.
   - O **usuário comum** pode apenas visualizar informações.
   - O **operador** pode realizar operações como vendas e cadastros, enquanto o **administrador** tem permissões para gerenciar os dados do sistema, incluindo clientes, produtos e usuários.

2. **Hierarquia de usuários**:
   - Implementação de um sistema de controle de acessos, com base nos cargos dos usuários. O código agora controla o que cada tipo de usuário pode visualizar e acessar dentro do sistema.

3. **Segurança**:
   - Com a implementação de roles (cargos), o sistema garante que cada usuário só tenha acesso ao que é permitido para o seu cargo específico.


---

## Observação:
O arquivo SQL não foi enviado junto ao projeto, mas se você tiver interesse em mexer nele, pode me chamar no WhatsApp!

📲 **Entre em contato no WhatsApp**:  
[Enviar mensagem para o WhatsApp](http://wa.me/5585997752571)

---

![Logo do Sistema](https://raw.githubusercontent.com/GabrielCordeiroBarrosoTeles/Imgs_repositorios/refs/heads/main/Sistema_NF/img0.png)

Bem-vindo ao **Sistema de Gerenciamento de Estoque e Impressão de Nota Fiscal**, uma solução desenvolvida para facilitar o controle de estoque e a emissão de notas fiscais de maneira prática e eficiente. Este sistema permite a gestão de produtos, clientes, vendas, e gera relatórios detalhados, incluindo gráficos de lucros, além de facilitar a integração com o WhatsApp para suporte ao cliente.

---

## 📸 **Imagens do Sistema**

### 1. **Modal de Login**
![Modal de Login](https://raw.githubusercontent.com/GabrielCordeiroBarrosoTeles/Imgs_repositorios/refs/heads/main/Sistema_NF/img1.png)

### 2. **Pop-up do WhatsApp**
![Pop-up do WhatsApp](https://raw.githubusercontent.com/GabrielCordeiroBarrosoTeles/Imgs_repositorios/refs/heads/main/Sistema_NF/img2.png)

### 3. **Área do Administrador**
![Área do Administrador](https://raw.githubusercontent.com/GabrielCordeiroBarrosoTeles/Imgs_repositorios/refs/heads/main/Sistema_NF/img3.png)

### 4. **Modal de Produto**
![Modal de Produto](https://raw.githubusercontent.com/GabrielCordeiroBarrosoTeles/Imgs_repositorios/refs/heads/main/Sistema_NF/img4.png)

### 5. **Cadastro do Produto no Estoque**
![Cadastro do Produto no Estoque](https://raw.githubusercontent.com/GabrielCordeiroBarrosoTeles/Imgs_repositorios/refs/heads/main/Sistema_NF/img5.png)

### 6. **Cadastro do Cliente**
![Cadastro do Cliente](https://raw.githubusercontent.com/GabrielCordeiroBarrosoTeles/Imgs_repositorios/refs/heads/main/Sistema_NF/img6.png)

### 7. **Exibição dos Clientes**
![Exibição dos Clientes](https://raw.githubusercontent.com/GabrielCordeiroBarrosoTeles/Imgs_repositorios/refs/heads/main/Sistema_NF/img7.png)

### 8. **Exibição do Estoque**
![Exibição do Estoque](https://raw.githubusercontent.com/GabrielCordeiroBarrosoTeles/Imgs_repositorios/refs/heads/main/Sistema_NF/img8.png)

### 9. **Detalhes de um Produto no Estoque**
![Detalhes de Produto no Estoque](https://raw.githubusercontent.com/GabrielCordeiroBarrosoTeles/Imgs_repositorios/refs/heads/main/Sistema_NF/img9.png)

### 10. **Edição de Produto**
![Edição de Produto](https://raw.githubusercontent.com/GabrielCordeiroBarrosoTeles/Imgs_repositorios/refs/heads/main/Sistema_NF/img10.png)

### 11. **Geração de Nota Fiscal**
![Geração de Nota Fiscal](https://raw.githubusercontent.com/GabrielCordeiroBarrosoTeles/Imgs_repositorios/refs/heads/main/Sistema_NF/img11.png)

### 12. **Exibição das Notas Fiscais**
![Exibição das Notas Fiscais](https://raw.githubusercontent.com/GabrielCordeiroBarrosoTeles/Imgs_repositorios/refs/heads/main/Sistema_NF/img12.png)
<p>Soma total do valor bruto e soma total do lucro líquido.</p>

### 13. **Nota Fiscal Gerada**
![Nota Fiscal Gerada](https://raw.githubusercontent.com/GabrielCordeiroBarrosoTeles/Imgs_repositorios/refs/heads/main/Sistema_NF/img13.png)

### 14. **Gráfico de Lucro** (dados fictícios)
![Gráfico de Lucro](https://raw.githubusercontent.com/GabrielCordeiroBarrosoTeles/Imgs_repositorios/refs/heads/main/Sistema_NF/img14.png)

---

## 🚀 **[Dev's tech]**

<div style="text-align: center;"> <img src="https://raw.githubusercontent.com/GabrielCordeiroBarrosoTeles/Imgs_repositorios/refs/heads/main/Sistema_NF/logo.png" alt="Logo da Equipe" style="width: 150px; height: auto;"> </div>

Somos a **[Dev's tech]**, uma equipe apaixonada por inovação e comprometida em oferecer soluções eficientes e eficazes. Nosso projeto visa melhorar a gestão de estoque e a geração de documentos fiscais, utilizando as tecnologias mais recentes para proporcionar uma experiência de usuário de alto nível.



---

## 👥 **Nossos Colaboradores**

<div style="display: flex; flex-wrap: wrap; justify-content: space-around; text-align: center;">

<div style="width: 45%; margin: 10px;">
  <img src="https://avatars.githubusercontent.com/u/98492418?v=4" alt="Foto de Gabriel" style="width: 150px; height: 150px; object-fit: cover; border-radius: 50%;">
  <p><strong>Gabriel Cordeiro Barroso Teles</strong></p>
  <p>
    <a href="https://github.com/GabrielCordeiroBarrosoTeles">GitHub</a> | 
    <a href="https://www.linkedin.com/in/gabriel-cordeiro-barroso">LinkedIn</a>
  </p>
</div>

<div style="width: 45%; margin: 10px;">
  <img src="https://avatars.githubusercontent.com/u/48100360?v=4" alt="Foto de Carlos" style="width: 150px; height: 150px; object-fit: cover; border-radius: 50%;">
  <p><strong>Carlos Henrique Rodrigues de Sousa</strong></p>
  <p>
    <a href="https://github.com/carlosbv1">GitHub</a> | 
    <a href="https://www.linkedin.com/in/carlos-henrique-rodrigues-de-sousa-68447468">LinkedIn</a>
  </p>
</div>

<div style="width: 45%; margin: 10px;">
  <img src="https://avatars.githubusercontent.com/u/106496648?v=4" alt="Foto de Eduardo" style="width: 150px; height: 150px; object-fit: cover; border-radius: 50%;">
  <p><strong>Eduardo Lima da Silva</strong></p>
  <p>
    <a href="https://github.com/Eduardo-L-Silva">GitHub</a> | 
    <a href="https://linkedin.com/in/eduardo-lima-3b967029a">LinkedIn</a>
  </p>
</div>

<div style="width: 45%; margin: 10px;">
  <img src="https://avatars.githubusercontent.com/u/124222592?v=4" alt="Foto de Matheus" style="width: 150px; height: 150px; object-fit: cover; border-radius: 50%;">
  <p><strong>Matheus Damasceno Rocha</strong></p>
  <p>
    <a href="https://github.com/MatheusDamascenoRocha">GitHub</a> | 
    <a href="https://www.linkedin.com/in/matheus-damasceno-648346272">LinkedIn</a>
  </p>
</div>

</div>

---



## 🌟 **Sobre a Equipe**

A **Dev's Tech** foi formada em 2023. Nossa missão é **transformar desafios em soluções ágeis e eficientes, automatizando processos por meio da criação de sistemas de software inovadores e funcionais**. 

Visamos **melhorar a produtividade das empresas, garantindo qualidade, desempenho e uma experiência do usuário excepcional**. Trabalhamos em equipe para entregar resultados que simplificam a rotina dos nossos clientes e impulsionam o crescimento dos negócios.

### 💡 **Nossos Valores**
- **Inovação**: Estamos sempre buscando novas formas de melhorar.
- **Colaboração**: O trabalho em equipe é nossa chave para o sucesso.
- **Qualidade**: Priorizamos a excelência em todos os aspectos do nosso trabalho.

---

## 👏 **Agradecimentos Especiais**

Queremos agradecer a todos os membros da equipe pelo seu esforço e dedicação. Cada contribuição é fundamental para o sucesso do projeto. Estamos muito orgulhosos do que alcançamos juntos!

---
<!--
## 🔗 **Links Importantes**
- **Repositório do Projeto**: [Link do Repositório](https://github.com/username/repository)
- **Site da Equipe**: [Link para o site (se houver)](https://site-da-equipe.com)

---
-->
