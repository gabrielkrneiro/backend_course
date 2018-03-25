<h1> Fundamentos de Backend </h1>

Facilitador: <b>Gabriel M. Carneiro</b> <br>
E-mail: <b>carneiro.development@gmail.com </b>
<hr>

<h4> Requisitos </h4>

* Apache, MySQL, Php
* <a href="https://www.python.org">Python 3.x</a>
* <a href="https://nodejs.org/en/download/">NodeJS</a>
* <a href="https://www.npmjs.com/get-npm">NPM</a>
* <a href="https://loopback.io/">Loopback.JS</a>
* <a href="https://getcomposer.org/download/">Composer</a>

<h4> Primeira seção </h4>
O objetivo da primeira seção é mostrar os conceitos e abordagens sobre Back-end, qual a importância de sua implementação bem estruturada e como construir a estrutura de um Back-end partindo do zero.

<h4> Configurando o servidor </h4>

* Para rodar o servidor da aplicação da primeira parte é necessário primeiramente criar o banco de dados. No <i> phpmyadmin </i> crie um banco chamado backend_course_1 e importe o arquivo <b> curso_backend.sql </b> que está contido na raiz da pasta part_1. 
* Configure o arquivo <b>  datasource.json </b> em <b> part_1/server/server </b> conforme os dados referentes a conexão com o seu banco de dados local.
* Execute o comando <kbd> npm install </kbd> na raiz da pasta <b> part_1/server </b>
* Na raiz da pasta <b> part_1/server </b> execute o comando <kbd> node .</kbd> ou <kbd> nodejs .</kbd> 

<h4> Configurando a aplicação </h4>

* A aplicação que consome o servidor é desenvolvido em Laravel e se encontra em <b> part_1/webapp </b>
* Dentro da pasta, execute o comando <kbd> composer install </kbd>
* Se todas as dependências forem instaladas normalmente, basta executar o comando <kbd> php artisan serve </kbd> na raiz da pasta <b>webapp</b>

