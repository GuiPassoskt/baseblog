@extends('layouts.page')

@section('content')


    <section class="banner">
        <div class="slider">

            <div class="item" style="
                background: url(/assets/site/img/10263.png);
                background-repeat: no-repeat;
                background-size: cover;
                background-position: center center;">
                <div class="site-container">
                    <h1>ola tudo bein</h1>
                </div>
            </div>

            {{-- <div class="item" style="
            background: url(/assets/site/img/10263.png);
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center center;">
            <h1>ola tudo bein</h1> --}}
        </div>

        <div class="info site-container">
            <div class="content">
                <div class="card">
                    <div class="card_border"></div>
                    <div class="text">
                        Linha Master
                    </div>
                    <div class="itens">
                        <div class="point"></div>
                        <div class="point"></div>
                        <div class="point"></div>
                    </div>
                    <p>
                        Qualidade Superior em Rendimento e Durabilidade.
                    </p>
                </div>
            </div>
            <div class="box">
                <div class="image home"></div>
                <span>
                    Interior/exterior
                    <p>Aplicável sobre: reboco, gesso, massa corrida, entre outras superfícies</p>
                </span>
                
            </div>
            <div class="box">
                <div class="image drop"></div>
                <span>
                    Alto Rendimento
                    <p>Rendimento de até 500 m²/18L</p>
                </span>
            </div>
            <div class="box">
                <div class="image lines"></div>
                <span>
                    Cobertura Uniforme
                    <p>Excelente poder de cobertura Ampla durabilidade</p>
                </span>
            </div>
        </div>
        
    </section>

    <section class="texto">
        <p>
            Nossa linha de produtos é admirada pelos mais exigentes profissionais 
            de pintura e da indústria químida. A Baytek Químida dispõe de<br> laboratórios 
            especiais, voltados ao controle de qualidade de seus produtos e rigorosa verificação 
            antes de adentrar o mercado.
        </p>
    </section>

    <section class="utilitarios">
        <div class="border"></div>
        <h2>O que vamos usar hoje?</h2>
        <div class="itens">
            <div class="box">
                <div class="image cobertura"></div>
                Coberturas
            </div>
            <div class="box">
                <div class="image textura"></div>
                Texturas
            </div>
            <div class="box">
                <div class="image tinta"></div>
                Tintas
            </div>
            <div class="box">
                <div class="image selador"></div>
                Selador
            </div>
        </div>
    </section>

    <section class="slide">
        <div class="border"></div>
        <h2>Nosssa Linha de Tintas Imobiliárias</h2>
        <div class="itens">
            @foreach($products as $product)
                @include('components.product_info', ['product' => $product])
            @endforeach
        </div>
        <p>Feitas à base de água, as Tintas Primor geram resíduos mais limpos e contribuem para a sustentabilidade do nosso planeta.</p>
        <p>Sua escolha gera um impacto maior do que você imagina.</p>
    </section>

    <section class="dicas">
        <div class="icons">
            <img src="/assets/site/img/communication.svg">
            <h2>Dicas exclusivas pra você!</h2>
        </div>
        <div class="itens">
            @foreach($posts as $post)
                @include('components.post', ['post' => $post])
            @endforeach
        </div>
    </section>


@stop

@section('scripts')
<script type="text/javascript" src="{{ asset('assets/site/js/slick.min.js') }}"></script>
<script>
    $(document).ready(function(){
        $('.slider').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2000,
            adaptiveHeight: true
        });
    });
</script>

@endsection


@section('styles')
<link rel="stylesheet" href="{{ asset('/assets/site/css/pages/home.css') }}">
@stop