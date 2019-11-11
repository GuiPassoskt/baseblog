<div class="product-item">
    <div class="product-item-image" style="background-image: url('{{ $product->image->url }}')"></div>
    <div class="product-item-x">
        <div class="x"></div>
        <div class="x"></div>
        <div class="x"></div>
    </div>
    <h4>{{ $product->name }}</h4>
    <a href="{{ $product->url_web }}" class="btn">Saiba Mais</a>
</div>