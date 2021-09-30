@extends('site.main')

@section('content')
    <div class="section">
        <div class="hero-slider">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <div class="hero-slide-item swiper-slide">
                        <div class="hero-slide-bg" style="height: auto;">
                            <img src="{{asset('assets/img/modelos.jpeg')}}" alt="Slider Image" />
                        </div>
                        <div class="container">
                            <div class="hero-slide-content">
                                <h2 class="title">
                                    Women New <br />Collection
                                </h2>
                                <p>Ganhe 50% de desconto em produtos selecionados</p>
                                <a href="{{ route('products') }}" class="btn btn-lg btn-primary btn-hover-dark">Ver Produtos</a>
                            </div>
                        </div>
                    </div>
                    <div class="hero-slide-item swiper-slide">
                        <div class="hero-slide-bg">
                            <img src="{{asset('assets/img/no-image.jpg')}}" alt="Slider Image" />
                        </div>
                        <div class="container">
                            <div class="hero-slide-content">
                                <h2 class="title">
                                    Trend Fashion<br />
										Collection
                                </h2>
                                <p>Up to 40% off selected Product</p>
                                <a href="{{ route('products') }}" class="btn btn-lg btn-primary btn-hover-dark">Ver Produtos</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-pagination d-md-none"></div>
                <div class="home-slider-prev swiper-button-prev main-slider-nav d-md-flex d-none"><i class="pe-7s-angle-left"></i></div>
                <div class="home-slider-next swiper-button-next main-slider-nav d-md-flex d-none"><i class="pe-7s-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="section section-margin">
        <div class="container">
            <div class="row mb-n6"></div>
        </div>
    </div>
    <div class="section">
        <div class="container">
            <div class="feature-wrap">
                <div class="row row-cols-lg-4 row-cols-xl-auto row-cols-sm-2 row-cols-1 justify-content-between mb-n5">
                    <div class="col mb-5" data-aos="fade-up" data-aos-delay="300">
                        <div class="feature">
                            <div class="icon text-primary align-self-center">
                                <img src="{{asset('useLadame/images/icons/feature-icon-2.png')}}" alt="Feature Icon">
                            </div>
                            <div class="content">
                                <h5 class="title">Entrega Grátis</h5>
                                <p>Para todos os pedidos</p>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-5" data-aos="fade-up" data-aos-delay="500">
                        <div class="feature">
                            <div class="icon text-primary align-self-center">
                                <img src="{{asset('useLadame/images/icons/feature-icon-3.png')}}" alt="Feature Icon">
                            </div>
                            <div class="content">
                                <h5 class="title">Suporte 24/7</h5>
                                <p>Suporte 24 horas por dia</p>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-5" data-aos="fade-up" data-aos-delay="700">
                        <div class="feature">
                            <div class="icon text-primary align-self-center">
                                <img src="{{asset('useLadame/images/icons/feature-icon-4.png')}}" alt="Feature Icon">
                            </div>
                            <div class="content">
                                <h5 class="title">Dinheiro de Volta</h5>
                                <p>Se não gostar do produto</p>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-5" data-aos="fade-up" data-aos-delay="900">
                        <div class="feature">
                            <div class="icon text-primary align-self-center">
                                <img src="{{asset('useLadame/images/icons/feature-icon-1.png')}}" alt="Feature Icon">
                            </div>
                            <div class="content">
                                <h5 class="title">Descontos</h5>
                                <p>Para pedidos acima de R$299,00</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section section-padding mt-0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <ul class="product-tab-nav nav justify-content-center mb-10 title-border-bottom mt-n3">
                        <li class="nav-item" data-aos="fade-up" data-aos-delay="300"><a class="nav-link active mt-3" data-bs-toggle="tab" href="#tab-highlighted-products">Destaques</a></li>
                        {{-- <li class="nav-item" data-aos="fade-up" data-aos-delay="400"><a class="nav-link mt-3" data-bs-toggle="tab" href="#tab-product-clothings">Mais Vendidos</a></li> --}}
                        <li class="nav-item" data-aos="fade-up" data-aos-delay="500"><a class="nav-link mt-3" data-bs-toggle="tab" href="#tab-promotion-products">Promoção</a></li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="tab-content position-relative">
                        <div class="tab-pane fade show active" id="tab-highlighted-products">
                            <div class="product-carousel">
                                <div class="swiper-container">
                                    <div class="swiper-wrapper mb-n10">
                                        <div class="swiper-slide product-wrapper">
                                            @forelse ($highlightedProducts as $highlightedProduct)
                                                @php $variation = $highlightedProduct->availableVariation(); @endphp
                                                <form method="post" action="{{ route('cart.product.add', [$highlightedProduct->slug, $variation->id]) }}">
                                                    @csrf
                                                    <div class="product product-border-left mb-10" data-aos="fade-up" data-aos-delay="300">
                                                        <div class="thumb">
                                                            <a href="{{ route('product.show', [$highlightedProduct->slug, $variation->id]) }}" class="image">
                                                                <img class="first-image" src="{{asset('useLadame/images/products/medium-size/1.jpg')}}" alt="Product" />
                                                                <img class="second-image" src="{{asset('useLadame/images/products/medium-size/5.jpg')}}" alt="Product" />
                                                            </a>
                                                            <div class="actions">
                                                                <a href="#" class="action wishlist"><i class="pe-7s-like"></i></a>
                                                                <a href="#" class="action quickview" data-bs-toggle="modal" data-bs-target="#exampleModalCenter"><i class="pe-7s-search"></i></a>
                                                                <a href="#" class="action compare"><i class="pe-7s-shuffle"></i></a>
                                                            </div>
                                                        </div>
                                                        <div class="content">
                                                            <h4 class="sub-title"><a href="{{ route('product.show', [$highlightedProduct->slug, $variation->id]) }}">{{ $highlightedProduct->slug }}</a></h4>
                                                            <h5 class="title"><a href="{{ route('product.show', [$highlightedProduct->slug, $variation->id]) }}">{{ $highlightedProduct->slug }}</a></h5>
{{--                                                            <span class="ratings">--}}
{{--                                                            <span class="rating-wrap">--}}
{{--                                                            <span class="star" style="width: 100%"></span>--}}
                                                        </span>
{{--                                                        <span class="rating-num">(4)</span>--}}
                                                        </span>
                                                            <span class="price">
                                                            <span class="new">{{ $variation->final_price_formated }}</span>
                                                            <span class="old">{{ $variation->final_price_formated }}</span>
                                                        </span>
                                                            <button type="submit" class="btn btn-sm btn-outline-dark btn-hover-primary">Adicionar ao Carrinho</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            @empty
                                                <p>Nenhum produto disponível</p>
                                            @endforelse
                                        </div>
                                    </div>
                                    <div class="swiper-pagination d-md-none"></div>
                                    <div class="swiper-product-button-next swiper-button-next swiper-button-white d-md-flex d-none"><i class="pe-7s-angle-right"></i></div>
                                    <div class="swiper-product-button-prev swiper-button-prev swiper-button-white d-md-flex d-none"><i class="pe-7s-angle-left"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-promotion-products">
                            <div class="product-carousel">
                                <div class="swiper-container">
                                    <div class="swiper-wrapper mb-n10">
                                        <div class="swiper-slide product-wrapper">
                                            @forelse ($promotionProducts as $productVariation)
                                                <form method="post" action="{{ route('cart.product.add', [$productVariation->product->slug, $productVariation->id]) }}">
                                                    @csrf
                                                    <div class="product product-border-left mb-10" data-aos="fade-up" data-aos-delay="300">
                                                        <div class="thumb">
                                                            <a href="{{ route('product.show', [$productVariation->product->slug, $productVariation->id]) }}" class="image">
                                                                <img class="first-image" src="{{asset('useLadame/images/products/medium-size/1.jpg')}}" alt="Product" />
                                                                <img class="second-image" src="{{asset('useLadame/images/products/medium-size/5.jpg')}}" alt="Product" />
                                                            </a>
                                                            <div class="actions">
                                                                <a href="#" class="action wishlist"><i class="pe-7s-like"></i></a>
                                                                <a href="#" class="action quickview" data-bs-toggle="modal" data-bs-target="#exampleModalCenter"><i class="pe-7s-search"></i></a>
                                                                <a href="#" class="action compare"><i class="pe-7s-shuffle"></i></a>
                                                            </div>
                                                        </div>
                                                        <div class="content">
                                                            <h4 class="sub-title"><a href="{{ route('product.show', [$productVariation->product->slug, $productVariation->id]) }}">{{ $productVariation->product->slug }}</a></h4> <h5 class="title"><a href="produto/ut-adipisci-sed-suscipit-libero/20">{{ $highlightedProduct->slug }}</a></h5>
{{--                                                            <span class="ratings">--}}
{{--                                                                <span class="rating-wrap">--}}
{{--                                                                    <span class="star" style="width: 100%"></span>--}}
{{--                                                                </span>--}}
{{--                                                                <span class="rating-num">(4)</span>--}}
{{--                                                            </span>--}}
                                                            <span class="price">
                                                                <span class="new">{{ $productVariation->value_formated }}</span>
                                                                <span class="old">{{ $productVariation->final_price_formated }}</span>
                                                            </span>
                                                            <button class="btn btn-sm btn-outline-dark btn-hover-primary">Adicionar ao Carrinho</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            @empty
                                                <p>Nenhum produto disponível</p>
                                            @endforelse
                                        </div>
                                    </div>

                                    <!-- Swiper Pagination Start -->
                                    <div class="swiper-pagination d-md-none"></div>
                                    <!-- Swiper Pagination End -->

                                    <!-- Next Previous Button Start -->
                                    <div class="swiper-product-button-next swiper-button-next swiper-button-white d-md-flex d-none"><i class="pe-7s-angle-right"></i></div>
                                    <div class="swiper-product-button-prev swiper-button-prev swiper-button-white d-md-flex d-none"><i class="pe-7s-angle-left"></i></div>
                                    <!-- Next Previous Button End -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Banner Fullwidth Start -->
    {{-- <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-12" data-aos="fade-up" data-aos-delay="300">
                    <div class="banner">
                        <div class="banner-image">
                            <a href="shop-grid.html"><img src="{{asset('useLadame/images/banner/big-banner.jpg')}}" alt="Banner"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Banner Fullwidth End -->

   {{-- Product deal contador (Futuramente) --}}

    <!-- Banner Section Start -->

    <!-- Banner Section End -->

    <!-- Product List Start -->
    {{-- <div class="section section-padding">
        <div class="container">
            <div class="row mb-n8">
                <div class="col-md-6 col-lg-4 col-12 mb-8" data-aos="fade-up" data-aos-delay="300">
                    <!-- Product List Title Start -->
                    <div class="product-list-title">
                        <h2 class="title pb-3 mb-0">Destaques</h2>
                        <span></span>
                    </div>
                    <div class="product-list-carousel">
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide product-list-wrapper mb-n6">
                                    @forelse ($highlightedProducts as $highlightedProduct)
                                        @php
                                            $variation = $highlightedProduct->availableVariation();
                                        @endphp

                                        <div class="single-product-list product-hover mb-6">
                                            <div class="thumb">
                                                <a href="single-product.html" class="image">
                                                    <img class="first-image" src="{{asset('useLadame/images/products/small-product/1.jpg')}}" alt="Product" />
                                                    <img class="second-image" src="{{asset('useLadame/images/products/small-product/5.jpg')}}" alt="Product" />
                                                </a>
                                            </div>
                                            <div class="content">
                                                <h5 class="title"><a href="single-product.html">Make Thing Happen T-Shirt</a></h5>
                                                <span class="price">
                                                        <span class="new">$66.50</span>
                                                <span class="old">{{ $variation->id }}</span>
                                                </span>
                                                <span class="ratings">
                                                    <span class="rating-wrap">
                                                    <span class="star" style="width: 100%"></span>
                                                </span>
                                                <span class="rating-num">(4)</span>
                                                </span>
                                            </div>
                                        </div>
                                    @empty
                                        <p>Nenhum produto disponível</p>
                                    @endforelse
                                </div>
                            </div>

                            <!-- Swiper Pagination Start -->
                            <!-- <div class="swiper-pagination d-md-none"></div> -->
                            <!-- Swiper Pagination End -->

                            <!-- Next Previous Button Start -->
                            <div class="swiper-product-list-next swiper-button-next"><i class="pe-7s-angle-right"></i></div>
                            <div class="swiper-product-list-prev swiper-button-prev"><i class="pe-7s-angle-left"></i></div>
                            <!-- Next Previous Button End -->

                        </div>
                    </div>
                    <!-- Product List Carousel End -->

                </div>
                <div class="col-md-6 col-lg-4 col-12 mb-8" data-aos="fade-up" data-aos-delay="500">
                    <!-- Product List Title Start -->
                    <div class="product-list-title">
                        <h2 class="title pb-3 mb-0">New Products</h2>
                        <span></span>
                    </div>
                    <!-- Product List Title End -->

                    <!-- Product List Start -->
                    <div class="product-list-carousel-2">
                        <div class="swiper-container">
                            <div class="swiper-wrapper">

                                <!-- Product List Wrapper Start -->
                                <div class="swiper-slide product-list-wrapper mb-n6">

                                    <!-- Single Product List Start -->
                                    <div class="single-product-list product-hover mb-6">
                                        <div class="thumb">
                                            <a href="single-product.html" class="image">
                                                <img class="first-image" src="{{asset('useLadame/images/products/small-product/1.jpg')}}" alt="Product" />
                                                <img class="second-image" src="{{asset('useLadame/images/products/small-product/5.jpg')}}" alt="Product" />
                                            </a>
                                        </div>
                                        <div class="content">
                                            <h5 class="title"><a href="single-product.html">Make Thing Happen T-Shirt</a></h5>
                                            <span class="price">
													<span class="new">$66.50</span>
                                            <span class="old">$70.55</span>
                                            </span>
                                            <span class="ratings">
													<span class="rating-wrap">
														<span class="star" style="width: 100%"></span>
                                            </span>
                                            <span class="rating-num">(4)</span>
                                            </span>
                                        </div>
                                    </div>
                                    <!-- Single Product List End -->

                                    <!-- Single Product List Start -->
                                    <div class="single-product-list product-hover mb-6">
                                        <div class="thumb">
                                            <a href="single-product.html" class="image">
                                                <img class="first-image" src="{{asset('useLadame/images/products/small-product/1.jpg')}}" alt="Product" />
                                                <img class="second-image" src="{{asset('useLadame/images/products/small-product/5.jpg')}}" alt="Product" />
                                            </a>
                                        </div>
                                        <div class="content">
                                            <h5 class="title"><a href="single-product.html">Simple Woven Fabrics</a></h5>
                                            <span class="price">
													<span class="new">$86.00</span>
                                            <span class="old">$90.00</span>
                                            </span>
                                            <span class="ratings">
													<span class="rating-wrap">
														<span class="star" style="width: 80%"></span>
                                            </span>
                                            <span class="rating-num">(1)</span>
                                            </span>
                                        </div>
                                    </div>
                                    <!-- Single Product List End -->

                                    <!-- Single Product List Start -->
                                    <div class="single-product-list product-hover mb-6">
                                        <div class="thumb">
                                            <a href="single-product.html" class="image">
                                                <img class="first-image" src="{{asset('useLadame/images/products/small-product/1.jpg')}}" alt="Product" />
                                                <img class="second-image" src="{{asset('useLadame/images/products/small-product/5.jpg')}}" alt="Product" />
                                            </a>
                                        </div>
                                        <div class="content">
                                            <h5 class="title"><a href="single-product.html">Brother Hoddies in Grey</a></h5>
                                            <span class="price">
													<span class="new">$38.00</span>
                                            <span class="old">$42.50</span>
                                            </span>
                                            <span class="ratings">
													<span class="rating-wrap">
														<span class="star" style="width: 100%"></span>
                                            </span>
                                            <span class="rating-num">(4)</span>
                                            </span>
                                        </div>
                                    </div>
                                    <!-- Single Product List End -->

                                </div>
                                <!-- Product List Wrapper End -->

                                <!-- Product List Wrapper Start -->
                                <div class="swiper-slide product-list-wrapper mb-n6">

                                    <!-- Single Product List Start -->
                                    <div class="single-product-list product-hover mb-6">
                                        <div class="thumb">
                                            <a href="single-product.html" class="image">
                                                <img class="first-image" src="{{asset('useLadame/images/products/small-product/1.jpg')}}" alt="Product" />
                                                <img class="second-image" src="{{asset('useLadame/images/products/small-product/5.jpg')}}" alt="Product" />
                                            </a>
                                        </div>
                                        <div class="content">
                                            <h5 class="title"><a href="single-product.html">Basic Lather Sneaker</a></h5>
                                            <span class="price">
													<span class="new">$65.00</span>
                                            </span>
                                            <span class="ratings">
													<span class="rating-wrap">
														<span class="star" style="width: 100%"></span>
                                            </span>
                                            <span class="rating-num">(4)</span>
                                            </span>
                                        </div>
                                    </div>
                                    <!-- Single Product List End -->

                                    <!-- Single Product List Start -->
                                    <div class="single-product-list product-hover mb-6">
                                        <div class="thumb">
                                            <a href="single-product.html" class="image">
                                                <img class="first-image" src="{{asset('useLadame/images/products/small-product/1.jpg')}}" alt="Product" />
                                                <img class="second-image" src="{{asset('useLadame/images/products/small-product/5.jpg')}}" alt="Product" />
                                            </a>
                                        </div>
                                        <div class="content">
                                            <h5 class="title"><a href="single-product.html">Handmade Shoulder Bag</a></h5>
                                            <span class="price">
													<span class="new">$86.00</span>
                                            </span>
                                            <span class="ratings">
													<span class="rating-wrap">
														<span class="star" style="width: 80%"></span>
                                            </span>
                                            <span class="rating-num">(1)</span>
                                            </span>
                                        </div>
                                    </div>
                                    <!-- Single Product List End -->

                                    <!-- Single Product List Start -->
                                    <div class="single-product-list product-hover mb-6">
                                        <div class="thumb">
                                            <a href="single-product.html" class="image">
                                                <img class="first-image" src="{{asset('useLadame/images/products/small-product/1.jpg')}}" alt="Product" />
                                                <img class="second-image" src="{{asset('useLadame/images/products/small-product/5.jpg')}}" alt="Product" />
                                            </a>
                                        </div>
                                        <div class="content">
                                            <h5 class="title"><a href="single-product.html">Enjoy The Rest T-Shirt</a></h5>
                                            <span class="price">
													<span class="new">$44.00</span>
                                            <span class="old">$48.50</span>
                                            </span>
                                            <span class="ratings">
													<span class="rating-wrap">
														<span class="star" style="width: 100%"></span>
                                            </span>
                                            <span class="rating-num">(4)</span>
                                            </span>
                                        </div>
                                    </div>
                                    <!-- Single Product List End -->

                                </div>
                                <!-- Product List Wrapper End -->

                            </div>

                            <!-- Swiper Pagination Start -->
                            <!-- <div class="swiper-pagination d-md-none"></div> -->
                            <!-- Swiper Pagination End -->

                            <!-- Next Previous Button Start -->
                            <div class="swiper-product-list-next swiper-button-next"><i class="pe-7s-angle-right"></i></div>
                            <div class="swiper-product-list-prev swiper-button-prev"><i class="pe-7s-angle-left"></i></div>
                            <!-- Next Previous Button End -->
                        </div>
                    </div>
                    <!-- Product List End -->
                </div>
                <div class="col-md-6 col-lg-4 col-12 mb-8" data-aos="fade-up" data-aos-delay="700">
                    <!-- Product List Title Start -->
                    <div class="product-list-title">
                        <h2 class="title pb-3 mb-0">Best Sellers</h2>
                        <span></span>
                    </div>
                    <!-- Product List Title End -->

                    <!-- Product List Start -->
                    <div class="product-list-carousel-3">
                        <div class="swiper-container">
                            <div class="swiper-wrapper">

                                <!-- Product List Wrapper Start -->
                                <div class="swiper-slide product-list-wrapper mb-n6">

                                    <!-- Single Product List Start -->
                                    <div class="single-product-list product-hover mb-6">
                                        <div class="thumb">
                                            <a href="single-product.html" class="image">
                                                <img class="first-image" src="{{asset('useLadame/images/products/small-product/1.jpg')}}" alt="Product" />
                                                <img class="second-image" src="{{asset('useLadame/images/products/small-product/5.jpg')}}" alt="Product" />
                                            </a>
                                        </div>
                                        <div class="content">
                                            <h5 class="title"><a href="single-product.html">Basic Lather Sneaker</a></h5>
                                            <span class="price">
													<span class="new">$65.00</span>
                                            </span>
                                            <span class="ratings">
													<span class="rating-wrap">
														<span class="star" style="width: 100%"></span>
                                            </span>
                                            <span class="rating-num">(4)</span>
                                            </span>
                                        </div>
                                    </div>
                                    <!-- Single Product List End -->

                                    <!-- Single Product List Start -->
                                    <div class="single-product-list product-hover mb-6">
                                        <div class="thumb">
                                            <a href="single-product.html" class="image">
                                                <img class="first-image" src="{{asset('useLadame/images/products/small-product/1.jpg')}}" alt="Product" />
                                                <img class="second-image" src="{{asset('useLadame/images/products/small-product/5.jpg')}}" alt="Product" />
                                            </a>
                                        </div>
                                        <div class="content">
                                            <h5 class="title"><a href="single-product.html">Handmade Shoulder Bag</a></h5>
                                            <span class="price">
													<span class="new">$86.00</span>
                                            </span>
                                            <span class="ratings">
													<span class="rating-wrap">
														<span class="star" style="width: 80%"></span>
                                            </span>
                                            <span class="rating-num">(1)</span>
                                            </span>
                                        </div>
                                    </div>
                                    <!-- Single Product List End -->

                                    <!-- Single Product List Start -->
                                    <div class="single-product-list product-hover mb-6">
                                        <div class="thumb">
                                            <a href="single-product.html" class="image">
                                                <img class="first-image" src="{{asset('useLadame/images/products/small-product/1.jpg')}}" alt="Product" />
                                                <img class="second-image" src="{{asset('useLadame/images/products/small-product/5.jpg')}}" alt="Product" />
                                            </a>
                                        </div>
                                        <div class="content">
                                            <h5 class="title"><a href="single-product.html">Enjoy The Rest T-Shirt</a></h5>
                                            <span class="price">
													<span class="new">$44.00</span>
                                            <span class="old">$48.50</span>
                                            </span>
                                            <span class="ratings">
													<span class="rating-wrap">
														<span class="star" style="width: 100%"></span>
                                            </span>
                                            <span class="rating-num">(4)</span>
                                            </span>
                                        </div>
                                    </div>
                                    <!-- Single Product List End -->

                                </div>
                                <!-- Product List Wrapper End -->

                                <!-- Product List Wrapper Start -->
                                <div class="swiper-slide product-list-wrapper mb-n6">

                                    <!-- Single Product List Start -->
                                    <div class="single-product-list product-hover mb-6">
                                        <div class="thumb">
                                            <a href="single-product.html" class="image">
                                                <img class="first-image" src="{{asset('useLadame/images/products/small-product/1.jpg')}}" alt="Product" />
                                                <img class="second-image" src="{{asset('useLadame/images/products/small-product/5.jpg')}}" alt="Product" />
                                            </a>
                                        </div>
                                        <div class="content">
                                            <h5 class="title"><a href="single-product.html">Brother Hoddies in Grey</a></h5>
                                            <span class="price">
													<span class="new">$38.00</span>
                                            <span class="old">$42.50</span>
                                            </span>
                                            <span class="ratings">
													<span class="rating-wrap">
														<span class="star" style="width: 100%"></span>
                                            </span>
                                            <span class="rating-num">(4)</span>
                                            </span>
                                        </div>
                                    </div>
                                    <!-- Single Product List End -->

                                    <!-- Single Product List Start -->
                                    <div class="single-product-list product-hover mb-6">
                                        <div class="thumb">
                                            <a href="single-product.html" class="image">
                                                <img class="first-image" src="{{asset('useLadame/images/products/small-product/1.jpg')}}" alt="Product" />
                                                <img class="second-image" src="{{asset('useLadame/images/products/small-product/5.jpg')}}" alt="Product" />
                                            </a>
                                        </div>
                                        <div class="content">
                                            <h5 class="title"><a href="single-product.html">Basic Jogging Shorts</a></h5>
                                            <span class="price">
													<span class="new">$21.00</span>
                                            <span class="old">$22.50</span>
                                            </span>
                                            <span class="ratings">
													<span class="rating-wrap">
														<span class="star" style="width: 60%"></span>
                                            </span>
                                            <span class="rating-num">(4)</span>
                                            </span>
                                        </div>
                                    </div>
                                    <!-- Single Product List End -->

                                    <!-- Single Product List Start -->
                                    <div class="single-product-list product-hover mb-6">
                                        <div class="thumb">
                                            <a href="single-product.html" class="image">
                                                <img class="first-image" src="{{asset('useLadame/images/products/small-product/1.jpg')}}" alt="Product" />
                                                <img class="second-image" src="{{asset('useLadame/images/products/small-product/5.jpg')}}" alt="Product" />
                                            </a>
                                        </div>
                                        <div class="content">
                                            <h5 class="title"><a href="single-product.html">Simple Woven Fabrics</a></h5>
                                            <span class="price">
													<span class="new">$86.00</span>
                                            <span class="old">$90.00</span>
                                            </span>
                                            <span class="ratings">
													<span class="rating-wrap">
														<span class="star" style="width: 80%"></span>
                                            </span>
                                            <span class="rating-num">(1)</span>
                                            </span>
                                        </div>
                                    </div>
                                    <!-- Single Product List End -->

                                </div>
                                <!-- Product List Wrapper End -->

                            </div>

                            <!-- Swiper Pagination Start -->
                            <!-- <div class="swiper-pagination d-md-none"></div> -->
                            <!-- Swiper Pagination End -->

                            <!-- Next Previous Button Start -->
                            <div class="swiper-product-list-next swiper-button-next"><i class="pe-7s-angle-right"></i></div>
                            <div class="swiper-product-list-prev swiper-button-prev"><i class="pe-7s-angle-left"></i></div>
                            <!-- Next Previous Button End -->

                        </div>
                    </div>
                    <!-- Product List End -->
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Product List End -->
@endsection

@section('clients-area')
    <!-- Brand Logo Start -->
    <div class="section">
        <div class="container">
            <div class="border-top">
                <div class="row">
                    <div class="col-12">
                        <!-- Brand Logo Wrapper Start -->
                        <div class="brand-logo-carousel">
                            <div class="swiper-container">
                                <div class="swiper-wrapper">

                                    <!-- Single Brand Logo Start -->
                                    <div class="swiper-slide single-brand-logo" data-aos="fade-up" data-aos-delay="300">
                                        <a href="https://bckcode.com.br" target="_blank"><img style="width: 200px;" src="{{asset('useLadame/images/logo/marca-dagua-dourada.png')}}" alt="Brand Logo"></a>
                                    </div>
                                    <!-- Single Brand Logo End -->

                                    <!-- Single Brand Logo Start -->
                                    <div class="swiper-slide single-brand-logo" data-aos="fade-up" data-aos-delay="400">
                                        {{-- <a href="#"><img src="assets/images/brand-logo/2.png" alt="Brand Logo"></a> --}}
                                        <a href="https://bckcode.com.br" target="_blank"><img style="width: 200px;" src="{{asset('useLadame/images/logo/marca-dagua-preta.png')}}" alt="Brand Logo"></a>
                                    </div>
                                    <!-- Single Brand Logo End -->

                                    <!-- Single Brand Logo Start -->
                                    <div class="swiper-slide single-brand-logo" data-aos="fade-up" data-aos-delay="500">
                                        {{-- <a href=""><img src="assets/images/brand-logo/3.png" alt="Brand Logo"></a> --}}
                                        <a href="https://bckcode.com.br" target="_blank"><img style="width: 200px;" src="{{asset('useLadame/images/logo/marca-dagua-dourada.png')}}" alt="Brand Logo"></a>
                                    </div>
                                    <!-- Single Brand Logo End -->

                                    <!-- Single Brand Logo Start -->
                                    <div class="swiper-slide single-brand-logo" data-aos="fade-up" data-aos-delay="600">
                                        {{-- <a href="#"><img src="assets/images/brand-logo/4.png" alt="Brand Logo"></a> --}}
                                        <a href="https://bckcode.com.br" target="_blank"><img style="width: 200px;" src="{{asset('useLadame/images/logo/marca-dagua-preta.png')}}" alt="Brand Logo"></a>
                                    </div>
                                    <!-- Single Brand Logo End -->

                                    <!-- Single Brand Logo Start -->
                                    <div class="swiper-slide single-brand-logo" data-aos="fade-up" data-aos-delay="700">
                                        {{-- <a href="#"><img src="assets/images/brand-logo/5.png" alt="Brand Logo"></a> --}}
                                        <a href="https://bckcode.com.br" target="_blank"><img style="width: 200px;" src="{{asset('useLadame/images/logo/marca-dagua-dourada.png')}}" alt="Brand Logo"></a>
                                    </div>
                                    <!-- Single Brand Logo End -->

                                </div>
                            </div>
                        </div>
                        <!-- Brand Logo Wrapper End -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Brand Logo End -->
@endsection
