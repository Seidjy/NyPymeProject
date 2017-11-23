<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    
    <title>NyPyme</title>
    <!-- stylesheets -->
    <link rel="stylesheet" href="/css/boots/bootstrap.min.css">
    <!-- Google Font  -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans|Roboto" rel="stylesheet">
    <!-- Font Icons -->
    <link rel="stylesheet" href="/css/fonts/css/font-awesome.min.css">
    <!-- Main Stylesheet -->
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    
</head>
<body>
    
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">

            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                
                <a class="navbar-brand" href="/">NyPyme</a>
            </div>

            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    @guest
                            <li><a href="{{ route('login') }}">Logar</a></li>
                            <li><a href="{{ route('register') }}">Registrar</a></li>
                        @else
                            
                            <li class="dropdown">
                                    <li>
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                            Conquistas <span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="{{ route('achieve.create') }}">Cadastrar Regras para Conquistar</a></li>
                                            <li><a href="{{ route('restricts.create') }}">Cadastrar Regras para Limitar</a></li>
                                            <li><a href="{{ route('awards.create') }}">Cadastrar Regras para Premiar</a></li>
                                            <li><a href="{{ route('goals.index') }}">Lista de Conquistas</a></li>
                                            <li><a href="{{ route('goals.create') }}">Cadastrar Conquista</a></li>
                                        </ul>                                        
                                    </li>
                                    <li>
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                            Transações <span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="/deal/createbygoal">Realizar Transação por Evento</a></li>
                                            <li><a href="{{ route('deal.create') }}">Realizar Transação</a></li>
                                        </ul>                                        
                                    </li>
                                    <li>
                                        <a href="{{ route('prizes.index') }}" >
                                            Prêmios 
                                        </a>                                     
                                    </li>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Deslogar
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>

    
    @yield('conteudo')


    <div class="container">
        <footer class="navbar navbar-default navbar-fixed-bottom">
            <p><span>© NyPyme</span> Todos os direitos reservados.</p>
        </footer>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>