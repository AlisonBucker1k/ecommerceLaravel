@if (!empty($product))
    <div class="product product-border-left mb-10" data-aos="fade-up" data-aos-delay="300">
        @php $variation = $product->availableVariation(); @endphp
        <form method="post" action="{{ route('cart.product.add', [$product->slug]) }}">
            <input type="hidden" name="variation_id" id="variationId" value="{{  $variation->id }}">
            @csrf
            <div class="thumb">
                <a href="{{ route('product.show', [$product->slug]) }}" class="image">
{{--                    <img class="first-image" src="{{ getFullFtpUrl($variation->image) }}" alt="{{ $product->name }}" />--}}
{{--                    <img class="second-image" src="{{ getFullFtpUrl($variation->image) }}" alt="{{ $product->name }}" />--}}
                </a>
            </div>
            <div class="content">
                <h4 class="sub-title"><a href="{{ route('product.show', [$product->slug]) }}">{{ $product->slug }}</a></h4>
                <h5 class="title"><a href="{{ route('product.show', [$product->slug]) }}">{{ $product->name }}</a></h5>
                <span class="price">
                    <span class="new">{{ $variation->final_price_formated }}</span>
                    <span class="old">{{ $variation->final_price_formated }}</span>
                </span>
                <a href="{{ route('product.show', [$product->slug]) }}" class="btn btn-sm btn-outline-dark btn-hover-primary">
                    Ver mais
                </a>
            </div>
        </form>
    </div>
@endif
