# 🎭 Arte News

<p align="center">
  <img src="https://img.shields.io/badge/PHP-Backend-blue?style=for-the-badge&logo=php"/>
  <img src="https://img.shields.io/badge/MySQL-Database-orange?style=for-the-badge&logo=mysql"/>
  <img src="https://img.shields.io/badge/Bootstrap-Responsive-purple?style=for-the-badge&logo=bootstrap"/>
  <img src="https://img.shields.io/badge/Status-Concluído-green?style=for-the-badge"/>
</p>

<p align="center">
  <b>Portal moderno de notícias sobre Cultura e Arte</b><br>
  <i>Desenvolvido com PHP e MySQL, com CRUD completo, autenticação e categorias</i>
</p>

---

## 🚀 Sobre o Projeto

O Arte News é um portal de notícias desenvolvido em PHP e MySQL. Permite que usuários criem contas, publiquem notícias com imagens e organizem conteúdos por categorias como teatro, cinema e música. O projeto foi desenvolvido com foco em CRUD completo, autenticação de usuários, organização por categorias e interface moderna responsiva.

---

## ✨ Funcionalidades

Cadastro de usuários, login e logout com sessão ativa. Criação de notícias com título, conteúdo e imagem. Listagem de notícias na página inicial ordenadas por mais recentes. Visualização de notícia completa. Edição e exclusão de notícias pelo autor. Sistema de categorias com Teatro, Cinema e Música e filtro por categoria.

---

## 🛠️ Tecnologias

PHP, MySQL, HTML5, CSS3 e Bootstrap.

---

## 🗄️ Banco de Dados

Tabela usuarios: id, nome, email, senha.  
Tabela noticias: id, titulo, conteudo, imagem, categoria_id, usuario_id, data_criacao.  
Tabela categorias: id, nome.

---

## 📁 Estrutura do Projeto

portal/  
├── backend/ (conexao.php, funcoes.php, verifica_login.php)  
├── private/ (dashboard.php, nova_noticia.php, editar_noticia.php, excluir_noticia.php)  
├── usuarios/ (editar_usuario.php, excluir_usuario.php)  
├── imagens/  
├── index.php  
├── noticia.php  
├── login.php  
├── cadastro.php  
├── logout.php  
├── navbar.php  
├── style.css  

---

## ⚙️ Como Executar

Instale o XAMPP. Coloque o projeto em htdocs/portal. Inicie Apache e MySQL. Crie o banco de dados chamado portal no phpMyAdmin. Importe o arquivo SQL caso exista. Configure a conexão no arquivo backend/conexao.php usando:

$pdo = new PDO("mysql:host=localhost;dbname=portal;charset=utf8","root","");

Depois acesse no navegador: http://localhost/portal

---

## 🎨 Interface

Layout moderno, responsivo, estilo portal de notícias, com foco em leitura e organização de conteúdo.

---

## 🚀 Melhorias Futuras

Sistema de busca, comentários, curtidas, paginação e perfil de usuário.

---

## 👩‍💻 Desenvolvedora

Rafaela Cardoso – Desenvolvedora Web em formação

---

## 🏆 Status

Concluído ✔ Funcional ✔ Pronto para portfólio ✔
