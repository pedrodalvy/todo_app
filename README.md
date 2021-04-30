# Prova de Avaliação Técnica
Foi criado um projeto utilizando Laravel e Vue, para cadatro de Listas de Tarefas. 
A aplicação possui todos os requisitos solicitados, inclusive a maioria dos itens adicionais.


## Requisitos solicitados para projeto
- Capacidade de criar Tarefas :heavy_check_mark:
- Categorizar Tarefas :heavy_check_mark:
- Adicionar uma Data na Tarefa :heavy_check_mark:


## Itens Adicionais
- Utilização de Framework PHP :heavy_check_mark:
- Utilização de Framework Javascript :heavy_check_mark:
- Utilização de Padrões de Projetos :heavy_check_mark:
- <s>Utilização de Testes Automatizados</s> :x:


## Requisitos para executar a aplicação
- PHP >= 7.3
- Banco de Dados


## Instalação
1. Clonar o repositório do projeto: `git clone https://github.com/pedrodalvy/prova-pedro-dalvy.git`
2. Acessar o diretório `prova-pedro-dalvy`: `cd prova-pedro-dalvy`
3. Instalar as dependências do projeto: `composer install`
4. No arquivo `.env`, informar os dados de conexão com o banco de dados.
5. Executar o comando `php artisan migrate --seed` para geração das tabelas com dados populados.


## Configuração do projeto com Docker
- Montar os containers `` docker compose up``;
- Instalar as dependências do composer `` docker-compose exec app composer install ``;
- Instalar as dependências do composer `` docker-compose exec app php artisan migrate --seed ``;
- Acessar a página inicial do projeto em http://localhost:8010/


## Documentação da API
A documentação da api foi criada utilizando o Postman, e encontra-se disponível 
através deste [link](https://documenter.getpostman.com/view/11654668/SztK35W4?version=latest).


## Recursos utilizados no projeto
- [Laravel](https://laravel.com/)
- [Vue](https://vuejs.org/)
- [tymondesigns/jwt-auth](http://jwt-auth.com/)