# TODO App
Projeto para cadastro de listas de tarefas. Onde o usuário poderá adicionar tarefas na lista, categorizar as tarefas, adicionar lembretes, Data da Tarefa.

## Documentação da API
A documentação da api foi criada utilizando o Postman, e encontra-se disponível
através deste [link](https://documenter.getpostman.com/view/11654668/SztK35W4?version=latest).

## Tecnologias utilizadas
- PHP
- Laravel
- Vue.js
- MySQL
- Autenticação JWT

## Requisitos
- PHP >= 7.4
- Banco de Dados MySQL

## Opcional
- Docker

## Configuração do projeto com Docker
- Montar os containers `` docker-compose up``;
- Instalar as dependências do composer `` docker-compose exec app composer install ``;
- Instalar as dependências do composer `` docker-compose exec app php artisan migrate --seed ``;
- Acessar a página inicial do projeto em http://localhost:8010/

## Configuração sem Docker
1. Clonar o repositório do projeto: `git clone git@github.com:pedrodalvy/todo_app.git`
2. Acessar o diretório `todo_app`: `cd todo_app`
3. Instalar as dependências do projeto: `composer install`
4. No arquivo `.env`, informar os dados de conexão com o banco de dados.
5. Executar o comando `php artisan migrate --seed` para geração das tabelas com dados populados.

### Observações
- Inicialmente o projeto foi criado como teste de desenvolvimento para entrar na empresa [Before](https://www.before.com.br/), 
 e como houve uma alteração no teste do processo seletivo da empresa, resolvi deixar o repositório como público.