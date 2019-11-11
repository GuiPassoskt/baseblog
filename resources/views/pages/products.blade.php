@extends('layouts.page')

@section('content')

    @component('components.site_banner', ['image' => asset('/assets/site/img/10263.png')])
        @slot('title')
            Nossas<br>Linhas de Produtos
        @endslot
    @endcomponent



    <section class="site-container">
        <div class="row">
            @foreach($products as $product)
                <div class="col-xs-12 col-sm-6 col-md-3">
                    @include('components.product_info', ['product' => $product])
                </div>
            @endforeach
        </div>
    </section>

@stop
