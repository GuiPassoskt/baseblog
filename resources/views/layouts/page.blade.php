<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Primor')</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,900&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" type="text/css" href="/assets/site/css/slick.css"/>
    <link rel="stylesheet" href="/assets/site/css/slick-theme.css">
    <link rel="stylesheet" href="/assets/site/css/global.css">
    <link rel="stylesheet" href="/assets/site/css/global_mobile.css">
    <link rel="stylesheet" href="/assets/site/css/components/product_info.css">
    <link rel="stylesheet" href="{{ asset('/assets/site/css/flexboxgrid.min.css') }}">
    @yield('styles')

</head>
<body>
    <header class="header site-container">

            <a href="/" class="brand">
                <span>Tintas</span>
                PRIMOR
            </a>
            <label for="toggle">&#9776;</label>
            <input type="checkbox" id="toggle">
            <nav class="navbar">
                <ul>
                    <li><a href="/sobre"><i class="material-icons">format_paint</i><span>Sobre a Primor</span></a></li>
                    <li><a href="/produtos"><i class="material-icons">style</i><span>Produtos</span></a></li>
                    <li><a href="/dicas"><i class="material-icons">question_answer</i><span>Dicas pra Você</span></a></li>
                    <li><a href="/tendencias"><i class="material-icons">palette</i><span>Tendências</span></a></li>
                    <li><a href="/contatos"><i class="material-icons">phone</i><span>Contato</span></a></li>
                </ul>
            </nav>
            <div class="paleta-container">
                <div class="paleta">
                    <div class="icon">
                        <img src="./assets/site/img/swatches.svg" alt="">
                    </div>
                    Encontre <br>Sua Cor
                </div>
            </div>
           
    </header>

    <section class="main-content">
        @yield('content')
    </section>


    <footer class="footer">
       <div>
           <h2>Acesso Rápido</h2>
       </div>
       <div>
           <h2>Produtos</h2>
           <div class="produtos">
                <a href="#">Coberturas</a>
                <a href="#">Texturas</a>
                <a href="#">Tintas</a>
                <a href="#">Celador</a>
           </div>
       </div>
       <div>
           <h2>Contato</h2>
           <div class="contato">
                <p>(31)3045-4444</p>
                <p>R. Salomão Camargos, 119</p>
                <p>Jardinópolis, Belo Horizonte</p>
           </div>
       </div>
    </footer>

    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    
    @yield('scripts')

    @if(app()->isLocal())
        <script>
        document.write(
            '<script src="http://' + location.host.split(':')[0] + ':35729/livereload.js?snipver=1"></' +
            'script>'
        );
        </script>
    @endif
</body>
</html>