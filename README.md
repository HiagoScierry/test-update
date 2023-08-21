# Test Upd8

## Objetivo

Teste tecnico para vaga de desenvolvedor PHP pleno.

## Stack

O teste é uma aplicação fullstack utilizando :

-   Laravel
-   PHPUnit
-   Mysql
-   TailwindCSS

## Utilizando o projeto

O projeto consiste em duas partes, uma api que pode ser acessada por ```http://localhost:8000/api/``` apos digite a rota que você precisa apos o "/", e uma view aonde é possível fazer o crud de dados do sistemas de forma facilitada.

- Para executar o projeto tenha php e composer na sua maquina
- execute o comando ```composer install``` para instalação de dependencias
- e para execução do projeto ```php artisan serve```

## Testes

Foi desenvolvido toda a regra de negocio baseada em testes da aplicação em suas regras de negocio. Os testes funcionam independente do banco de dados mysql, utilizando um banco de dados em memoria (sqlite). Ao rodar a suit de teste estará utilizando sempre o banco de dados sqlite.


- se quiser rodar a suit de testes utilize ```php artisan test```
