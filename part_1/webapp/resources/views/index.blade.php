<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/css/app.css">
    <script
            src="https://code.jquery.com/jquery-3.2.1.slim.js"
            integrity="sha256-tA8y0XqiwnpwmOIl3SGAcFl2RvxHjA8qp0+1uCGmRmg="
            crossorigin="anonymous"></script>
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="/">HomePage</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="/author">Authors</a></li>
            <li><a href="/book">Books</a></li>
            <li><a href="/bookstore">Bookstore</a></li>
        </ul>
    </div>
</nav>

@yield('conteudo')

</body>
</html>