<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ladame | Boutique de Lingerie</title>
    <!-- Favicons -->
    <link rel="shortcut icon" href="{{asset('useLadame/images/favicon.ico')}}">

    <!-- Vendor CSS (Icon Font) -->

    <link rel="stylesheet" href="{{asset('useLadame/css/vendor/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('useLadame/css/vendor/pe-icon-7-stroke.min.css')}}">


    <!-- Plugins CSS (All Plugins Files) -->

    <link rel="stylesheet" href="{{asset('useLadame/css/plugins/swiper-bundle.min.css')}}" />
    <link rel="stylesheet" href="{{asset('useLadame/css/plugins/animate.min.css')}}" />
    <link rel="stylesheet" href="{{asset('useLadame/css/plugins/aos.min.css')}}" />
    <link rel="stylesheet" href="{{asset('useLadame/css/plugins/nice-select.min.css')}}" />
    <link rel="stylesheet" href="{{asset('useLadame/css/plugins/jquery-ui.min.css')}}" />
    <link rel="stylesheet" href="{{asset('useLadame/css/plugins/lightgallery.min.css')}}" />


    <!-- Main Style CSS -->


    <link rel="stylesheet" href="{{asset('useLadame/css/style.css')}}" />

    @stack('css')


    <!-- Use the minified version files listed below for better performance and remove the files listed above -->


    <!--
    <link rel="stylesheet" href="assets/css/vendor.min.css">
    <link rel="stylesheet" href="assets/css/plugins.min.css">
    <link rel="stylesheet" href="assets/css/style.min.css">
    -->
</head>
<body>
    <div class="header section">

        <!-- Header Top Start -->
        <div class="header-top bg-light">
            <div class="container">
                <div class="row row-cols-xl-2 align-items-center">

                    <!-- Header Top Language, Currency & Link Start -->
                    <div class="col d-none d-lg-block">
                        <div class="header-top-lan-curr-link">
                            {{-- <div class="header-top-lan dropdown">
                                <button class="dropdown-toggle" data-bs-toggle="dropdown">English <i class="fa fa-angle-down"></i></button>
                                <ul class="dropdown-menu dropdown-menu-right animate slideIndropdown">
                                    <li><a class="dropdown-item" href="#">English</a></li>
                                    <li><a class="dropdown-item" href="#">Japanese</a></li>
                                    <li><a class="dropdown-item" href="#">Arabic</a></li>
                                    <li><a class="dropdown-item" href="#">Romanian</a></li>
                                </ul>
                            </div>
                            <div class="header-top-curr dropdown">
                                <button class="dropdown-toggle" data-bs-toggle="dropdown">USD <i class="fa fa-angle-down"></i></button>
                                <ul class="dropdown-menu dropdown-menu-right animate slideIndropdown">
                                    <li><a class="dropdown-item" href="#">USD</a></li>
                                    <li><a class="dropdown-item" href="#">Pound</a></li>
                                </ul>
                            </div> --}}
                            <div class="header-top-links">
                                <span>Ligue pra nós!</span><a href="#"> (27) 9 9657-8957</a>
                            </div>
                        </div>
                    </div>
                    <!-- Header Top Language, Currency & Link End -->

                    <!-- Header Top Message Start -->
                    <div class="col">
                        <p class="header-top-message">Aproveite nossas promoçoes de inauguração!. <a href="{{route('products')}}">Ver agora</a></p>
                    </div>
                    <!-- Header Top Message End -->

                </div>
            </div>
        </div>
        <!-- Header Top End -->

        <!-- Header Bottom Start -->
        <div class="header-bottom">
            <div class="header-sticky">
                <div class="container">
                    <div class="row align-items-center">

                        <!-- Header Logo Start -->
                        <div class="col-xl-2 col-6">
                            <div class="header-logo">
                                <a href="{{route('home')}}"><img src="{{asset('useLadame/images/logo/logo.png')}}" alt="Site Logo" width="105px"/></a>
                            </div>
                        </div>
                        <!-- Header Logo End -->

                        <!-- Header Menu Start -->
                        <div class="col-xl-8 d-none d-xl-block">
                            <div class="main-menu position-relative">
                                <ul>
                                    <li><a href="{{route('home')}}"> <span>Home</span></a></li>
                                    <li><a href="{{route('products')}}"> <span>Produtos</span></a></li>
                                    <li class="has-children position-static">
                                        <a href="#"><span>Categorias</span> <i class="fa fa-angle-down"></i></a>
                                        <ul class="mega-menu row-cols-4">
                                            @forelse ($categories as $category)
                                                <li class="col">
                                                    <h4>
                                                        <a href="{{ route('products', [$category->slug]) }}">{{ $category->name }}</a>
                                                    </h4>
                                                    @if (!empty($category->subcategories))
                                                        <ul class="mb-n2">
                                                            @foreach ($category->subcategories as $subcategory)
                                                                <li><a href="{{ route('products', [$category->slug, $subcategory->slug]) }}">{{ $subcategory->name }}</a></li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </li>
                                            @empty
                                                
                                            @endforelse
                                        </ul>
                                    </li>
                                    <li><a href="{{route('about')}}"> <span>Sobre nós</span></a></li>
                                    <li><a href="{{route('contact')}}"> <span>Contato</span></a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- Header Menu End -->

                        <!-- Header Action Start -->
                        <div class="col-xl-2 col-6">
                            <div class="header-actions">

                                <!-- Search Header Action Button Start -->
                                {{-- <a href="javascript:void(0)" class="header-action-btn header-action-btn-search"><i class="pe-7s-search"></i></a> --}}
                                <!-- Search Header Action Button End -->

                                <!-- User Account Header Action Button Start -->
                                @if(Auth::check())
                                    <a href="{{route('panel.profile')}}" class="header-action-btn d-none d-md-block"><i class="pe-7s-user"></i></a>
                                @endif

                                @if(Auth::guest())
                                    <a href="{{route('login')}}" class="header-action-btn d-none d-md-block"><i class="pe-7s-user"></i></a>
                                @endif
                                <!-- User Account Header Action Button End -->

                                <!-- Wishlist Header Action Button Start -->
                                <a href="wishlist.html" class="header-action-btn header-action-btn-wishlist d-none d-md-block">
                                    <i class="pe-7s-like"></i>
                                </a>
                                <!-- Wishlist Header Action Button End -->

                                <!-- Shopping Cart Header Action Button Start -->
                                <a href="javascript:void(0)" class="header-action-btn header-action-btn-cart">
                                    <i class="pe-7s-shopbag"></i>
                                    <span class="header-action-num">{{ $totalCartQuantity }}</span>
                                </a>
                                <!-- Shopping Cart Header Action Button End -->

                                <!-- Mobile Menu Hambarger Action Button Start -->
                                <a href="javascript:void(0)" class="header-action-btn header-action-btn-menu d-xl-none d-lg-block">
                                    <i class="fa fa-bars"></i>
                                </a>

                                @if(Auth::check())
                                    <a href="{{route('customer.logout')}}" class="header-action-btn d-none d-md-block"><i class="fa fa-sign-out"></i></a>
                                @endif
                                <!-- Mobile Menu Hambarger Action Button End -->

                            </div>
                        </div>
                        <!-- Header Action End -->

                    </div>
                </div>
            </div>
        </div>
        <!-- Header Bottom End -->

        <!-- Mobile Menu Start -->
        <div class="mobile-menu-wrapper">
            <div class="offcanvas-overlay"></div>

            <!-- Mobile Menu Inner Start -->
            <div class="mobile-menu-inner">

                <!-- Button Close Start -->
                <div class="offcanvas-btn-close">
                    <i class="pe-7s-close"></i>
                </div>
                <!-- Button Close End -->

                <!-- Mobile Menu Start -->
                <div class="mobile-navigation">
                    <nav>
                        <ul class="mobile-menu">
                            <li><a href="{{route('home')}}">Home</a></li>
                            <li><a href="{{route('products')}}">Produtos</a></li>
                            <li class="has-children">
                                <a href="#">Categorias <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                <ul class="dropdown">
                                    @forelse ($categories as $category)
                                        <li class="col">
                                            <h3>
                                                <a style="font-weight: 700 !important; font-size: 15px !important;" href="{{ route('products', [$category->slug]) }}">{{ $category->name }}</a>
                                            </h3>
                                            @if (!empty($category->subcategories))
                                                <ul class="mb-n2 " style="margin-bottom: 15px !important; margin-left: 10px;">
                                                    @foreach ($category->subcategories as $subcategory)
                                                        <li><a href="{{ route('products', [$category->slug, $subcategory->slug]) }}">{{ $subcategory->name }}</a></li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                    @empty
                                        
                                    @endforelse
                                </ul>
                            </li>
                            <li><a href="{{route('about')}}">Sobre nós</a></li>
                            <li><a href="{{route('contact')}}">Contato</a></li>
                            @if(Auth::check())
                                <li><a href="{{route('customer.logout')}}">Sair</a></li>
                            @endif
                        </ul>
                    </nav>
                </div>
                <!-- Mobile Menu End -->

                <!-- Language, Currency & Link Start -->
                {{-- <div class="offcanvas-lag-curr mb-6">
                    <h2 class="title">Languages</h2>
                    <div class="header-top-lan-curr-link">
                        <div class="header-top-lan dropdown">
                            <button class="dropdown-toggle" data-bs-toggle="dropdown">English <i class="fa fa-angle-down"></i></button>
                            <ul class="dropdown-menu dropdown-menu-right animate slideIndropdown">
                                <li><a class="dropdown-item" href="#">English</a></li>
                                <li><a class="dropdown-item" href="#">Japanese</a></li>
                                <li><a class="dropdown-item" href="#">Arabic</a></li>
                                <li><a class="dropdown-item" href="#">Romanian</a></li>
                            </ul>
                        </div>
                        <div class="header-top-curr dropdown">
                            <button class="dropdown-toggle" data-bs-toggle="dropdown">USD <i class="fa fa-angle-down"></i></button>
                            <ul class="dropdown-menu dropdown-menu-right animate slideIndropdown">
                                <li><a class="dropdown-item" href="#">USD</a></li>
                                <li><a class="dropdown-item" href="#">Pound</a></li>
                            </ul>
                        </div>
                    </div>
                </div> --}}
                <!-- Language, Currency & Link End -->

                <!-- Contact Links/Social Links Start -->
                <div class="mt-auto">

                    <!-- Contact Links Start -->
                    <ul class="contact-links">
                        <li><i class="fa fa-phone"></i><a href="phone: (27)99999-9999"> (27) 99999-9999</a></li>
                        <li><i class="fa fa-envelope-o"></i><a href="#"> contato@useladame.com</a></li>
                        <li><i class="fa fa-clock-o"></i> <span>Segunda à Sexta 9:00 - 22:00</span> </li>
                    </ul>
                    <!-- Contact Links End -->

                    <!-- Social Widget Start -->
                    <div class="widget-social">
                        <a title="Facebook" href="https://www.facebook.com/useladame" target="_blank"><i class="fa fa-facebook-f"></i></a>
                        <a title="Instagram" href="https://www.instagram.com/useladame/" target="_blank"><i class="fa fa-instagram"></i></a>
                        <a title="WhatsApp" href="phone: (27)99999-9999"><i class="fa fa-whatsapp"></i></a>
                        {{-- {{-- <a title="Youtube" href="#"><i class="fa fa-youtube"></i></a> --}}
                        <a title="Email" href="mailto:contato@useladame.com"><i class="fa fa-envelope"></i></a>
                    </div>
                    <!-- Social Widget Ende -->
                </div>
                <!-- Contact Links/Social Links End -->
            </div>
            <!-- Mobile Menu Inner End -->
        </div>
        <!-- Mobile Menu End -->

        <!-- Offcanvas Search Start -->
        <div class="offcanvas-search">
            <div class="offcanvas-search-inner">

                <!-- Button Close Start -->
                <div class="offcanvas-btn-close">
                    <i class="pe-7s-close"></i>
                </div>
                <!-- Button Close End -->

                <!-- Offcanvas Search Form Start -->
                <form class="offcanvas-search-form" action="#">
                    <input type="text" placeholder="Search Here..." class="offcanvas-search-input">
                </form>
                <!-- Offcanvas Search Form End -->

            </div>
        </div>
        <!-- Offcanvas Search End -->

        <!-- Cart Offcanvas Start -->
        <div class="cart-offcanvas-wrapper">
            <div class="offcanvas-overlay"></div>

            <!-- Cart Offcanvas Inner Start -->
            <div class="cart-offcanvas-inner">

                <!-- Button Close Start -->
                <div class="offcanvas-btn-close">
                    <i class="pe-7s-close"></i>
                </div>
                <!-- Button Close End -->

                <!-- Offcanvas Cart Content Start -->
                <div class="offcanvas-cart-content">
                    <!-- Offcanvas Cart Title Start -->
                    <h2 class="offcanvas-cart-title mb-10">Seu Carrinho</h2>
                    <!-- Offcanvas Cart Title End -->
                    @forelse ($cartProducts as $cartProduct)
                        <div class="cart-product-wrapper mb-6">
                            <div class="single-cart-product">
                                <div class="cart-product-thumb">
                                    <a href="single-product.html"><img src="{{asset('useLadame/images/products/small-product/1.jpg')}}" alt="Cart Product"></a>
                                </div>
                                <div class="cart-product-content">
                                    <h3 class="title"><a href="single-product.html">{{ $cartProduct->product->name }}</a></h3>
                                    <span class="price">
                                    <span class="new">R$ {{ $cartProduct->variation->promotion_value_formated }}</span>
                                    <span class="old">R$ {{ $cartProduct->variation->value_formated }}</span>
                                    </span>
                                </div>
                            </div>
                            <div class="cart-product-remove">
                                <a href="{{ route('cart.product.remove', $cartProduct->id) }}"><i class="fa fa-trash"></i></a>
                            </div>
                        </div>
                    @empty
                        <p>Nenhum produto no carrinho</p>
                    @endforelse

                    <!-- Cart Product Total Start -->
                    <div class="cart-product-total">
                        <span class="value">Subtotal</span>
                        <span class="price">{{ $cartTotalValue }}</span>
                    </div>
                    <!-- Cart Product Total End -->

                    <!-- Cart Product Button Start -->
                    <div class="cart-product-btn mt-4">
                        <a href="{{route('cart')}}" class="btn btn-dark btn-hover-primary rounded-0 w-100">Ver Carrinho</a>
                        <a href="{{route('cart.confirm')}}" class="btn btn-dark btn-hover-primary rounded-0 w-100 mt-4">Finalizar Compra</a>
                    </div>
                    <!-- Cart Product Button End -->

                </div>
                <!-- Offcanvas Cart Content End -->

            </div>
            <!-- Cart Offcanvas Inner End -->
        </div>
        <!-- Cart Offcanvas End -->

    </div>


    @yield('content')
    @yield('clients-area')

    <!-- Footer Section Start -->
    <footer class="section footer-section">
        <!-- Footer Top Start -->
        <div class="footer-top section-padding">
            <div class="container">
                <div class="row mb-n10">
                    <div class="col-12 col-sm-6 col-lg-4 col-xl-4 mb-10" data-aos="fade-up" data-aos-delay="200">
                        <div class="single-footer-widget">
                            <h2 class="widget-title">Fale conosco</h2>
                            <p class="desc-content">Será um prazer poder falar com você. Estamos esperando seu contato e sua visita!</p>
                            <!-- Contact Address Start -->
                            <ul class="widget-address">
                                <li><span>Endereço: </span> Avenida Mário Gurgel, 5353. Shopping Moxuara. Loja __ Espírito Santo</li>
                                <li><span>Atendimento: </span> <a href="tel: (27)99555-8745"> (27) 99999-9999</a></li>
                                <li><span>E-mail: </span> <a href="mailto: contato@useladame.com"> contato@useladame.com</a></li>
                            </ul>
                            <!-- Contact Address End -->

                            <!-- Soclial Link Start -->
                            <div class="widget-social justify-content-start mt-4">
                                <a title="Facebook" href="https://www.facebook.com/useladame" target="_blank"><i class="fa fa-facebook-f"></i></a>
                                <a title="Instagram" href="https://www.instagram.com/useladame/" target="_blank"><i class="fa fa-instagram"></i></a>
                                {{-- <a title="Linkedin" href="#" target="_blank"><i class="fa fa-linkedin"></i></a>
                                <a title="Youtube" href="#" target="_blank"><i class="fa fa-youtube"></i></a>
                                <a title="Vimeo" href="#" target="_blank"><i class="fa fa-vimeo"></i></a> --}}
                            </div>
                            <!-- Social Link End -->
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-2 col-xl-2 mb-10" data-aos="fade-up" data-aos-delay="300">
                        <div class="single-footer-widget">
                            <h2 class="widget-title">Informações</h2>
                            <ul class="widget-list">
                                <li><a href="{{route('about')}}">Sobre nós</a></li>
                                {{-- <li><a href="about.html">Politicas de privacidade</a></li> --}}
                                <li><a href="about.html">Termos de uso</a></li>
                                <li><a href="about.html">Políticas de entrega</a></li>
                                <li><a href="about.html">Políticas de troca</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-2 col-xl-2 mb-10" data-aos="fade-up" data-aos-delay="400">
                        <div class="single-footer-widget aos-init aos-animate">
                            <h2 class="widget-title">Links Rápidos</h2>
                            <ul class="widget-list">
                                <li><a href="{{route('login')}}">Minha conta</a></li>
                                <li><a href="wishlist.html">Lista de desejos</a></li>
                                {{-- <li><a href="contact.html">Newsletter</a></li> --}}
                                <li><a href="contact.html">Canais de ajuda</a></li>
                                {{-- <li><a href="contact.html">Conditin</a></li> --}}
                                <li><a href="contact.html">Termos de uso</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-4 col-xl-4 mb-10" data-aos="fade-up" data-aos-delay="500">
                        <div class="single-footer-widget">
                            <h2 class="widget-title">Newsletter</h2>
                            <div class="widget-body">
                                <p class="desc-content mb-0">Assine nossa newsletter e receba nossas melhores ofertas no seu e-mail!</p>
                                <div class="newsletter-form-wrap pt-4">
                                    <form id="mc-form" class="mc-form">
                                        <input type="email" id="mc-email" class="form-control email-box mb-4" placeholder="Insira seu melhor e-mail" name="email">
                                        <button id="mc-submit" class="newsletter-btn btn btn-primary btn-hover-dark" type="submit">Assinar</button>
                                    </form>
                                    <div class="mailchimp-alerts text-centre">
                                        <div class="mailchimp-submitting"></div><!-- mailchimp-submitting end -->
                                        <div class="mailchimp-success text-success"></div><!-- mailchimp-success end -->
                                        <div class="mailchimp-error text-danger"></div><!-- mailchimp-error end -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer Top End -->

        <!-- Footer Bottom Start -->
        <div class="footer-bottom">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12 text-center">
                        <div class="copyright-content">
                            <p class="mb-0">© {{date('Y')}} <strong>UseLadame </strong> Desenvolvido <i class="fa fa-heart text-danger"></i> por: <a href="https://bckcode.com.br/">BCKCode</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer Bottom End -->
    </footer>
    <!-- Footer Section End -->

    <!-- Scroll Top Start -->
    <a href="#" class="scroll-top" id="scroll-top">
        <i class="arrow-top fa fa-long-arrow-up"></i>
        <i class="arrow-bottom fa fa-long-arrow-up"></i>
    </a>
    <!-- Scroll Top End -->

    <!-- Modal Start  -->
    <div class="modalquickview modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <button class="btn close" data-bs-dismiss="modal">×</button>
                <div class="row">
                    <div class="col-md-6 col-12">

                        <!-- Product Details Image Start -->
                        <div class="modal-product-carousel">

                            <!-- Single Product Image Start -->
                            <div class="swiper-container">
                                <div class="swiper-wrapper">
                                    <a class="swiper-slide" href="#">
                                        <img class="w-100" src="assets/images/products/large-size/1.jpg" alt="Product">
                                    </a>
                                    <a class="swiper-slide" href="#">
                                        <img class="w-100" src="assets/images/products/large-size/2.jpg" alt="Product">
                                    </a>
                                    <a class="swiper-slide" href="#">
                                        <img class="w-100" src="assets/images/products/large-size/3.jpg" alt="Product">
                                    </a>
                                    <a class="swiper-slide" href="#">
                                        <img class="w-100" src="assets/images/products/large-size/4.jpg" alt="Product">
                                    </a>
                                    <a class="swiper-slide" href="#">
                                        <img class="w-100" src="assets/images/products/large-size/5.jpg" alt="Product">
                                    </a>
                                    <a class="swiper-slide" href="#">
                                        <img class="w-100" src="assets/images/products/large-size/6.jpg" alt="Product">
                                    </a>
                                </div>

                                <!-- Swiper Pagination Start -->
                                <!-- <div class="swiper-pagination d-md-none"></div> -->
                                <!-- Swiper Pagination End -->

                                <!-- Next Previous Button Start -->
                                <div class="swiper-product-button-next swiper-button-next"><i class="pe-7s-angle-right"></i></div>
                                <div class="swiper-product-button-prev swiper-button-prev"><i class="pe-7s-angle-left"></i></div>
                                <!-- Next Previous Button End -->
                            </div>
                            <!-- Single Product Image End -->

                        </div>
                        <!-- Product Details Image End -->

                    </div>
                    <div class="col-md-6 col-12 overflow-hidden position-relative">

                        <!-- Product Summery Start -->
                        <div class="product-summery">

                            <!-- Product Head Start -->
                            <div class="product-head mb-3">
                                <h2 class="product-title">Sample product</h2>
                            </div>
                            <!-- Product Head End -->

                            <!-- Price Box Start -->
                            <div class="price-box mb-2">
                                <span class="regular-price">$80.00</span>
                                <span class="old-price"><del>$90.00</del></span>
                            </div>
                            <!-- Price Box End -->

                            <!-- Rating Start -->
                            <span class="ratings justify-content-start">
                        <span class="rating-wrap">
                            <span class="star" style="width: 100%"></span>
                            </span>
                            <span class="rating-num">(4)</span>
                            </span>
                            <!-- Rating End -->

                            <!-- SKU Start -->
                            <div class="sku mb-3">
                                <span>SKU: 12345</span>
                            </div>
                            <!-- SKU End -->

                            <!-- Description Start -->
                            <p class="desc-content mb-5">I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness.</p>
                            <!-- Description End -->

                            <!-- Product Meta Start -->
                            <div class="product-meta mb-3">
                                <!-- Product Size Start -->
                                <div class="product-size">
                                    <span>Size :</span>
                                    <a href=""><strong>S</strong></a>
                                    <a href=""><strong>M</strong></a>
                                    <a href=""><strong>L</strong></a>
                                    <a href=""><strong>XL</strong></a>
                                </div>
                                <!-- Product Size End -->
                            </div>
                            <!-- Product Meta End -->

                            <!-- Product Color Variation Start -->
                            <div class="product-color-variation mb-3">
                                <button type="button" class="btn bg-danger"></button>
                                <button type="button" class="btn bg-primary"></button>
                                <button type="button" class="btn bg-dark"></button>
                                <button type="button" class="btn bg-success"></button>
                            </div>
                            <!-- Product Color Variation End -->

                            <!-- Product Meta Start -->
                            <div class="product-meta mb-5">
                                <!-- Product Metarial Start -->
                                <div class="product-metarial">
                                    <span>Metarial :</span>
                                    <a href=""><strong>Metal</strong></a>
                                    <a href=""><strong>Resin</strong></a>
                                    <a href=""><strong>Lather</strong></a>
                                    <a href=""><strong>Polymer</strong></a>
                                </div>
                                <!-- Product Metarial End -->
                            </div>
                            <!-- Product Meta End -->

                            <!-- Quantity Start -->
                            <div class="quantity mb-5">
                                <div class="cart-plus-minus">
                                    <input class="cart-plus-minus-box" value="0" type="text">
                                    <div class="dec qtybutton"></div>
                                    <div class="inc qtybutton"></div>
                                </div>
                            </div>
                            <!-- Quantity End -->

                            <!-- Cart & Wishlist Button Start -->
                            <div class="cart-wishlist-btn pb-4 mb-n3">
                                <div class="add-to_cart mb-3">
                                    <a class="btn btn-outline-dark btn-hover-primary" href="cart.html">Add to cart</a>
                                </div>
                                <div class="add-to-wishlist mb-3">
                                    <a class="btn btn-outline-dark btn-hover-primary" href="wishlist.html">Add to Wishlist</a>
                                </div>
                            </div>
                            <!-- Cart & Wishlist Button End -->

                            <!-- Social Shear Start -->
                            <div class="social-share">
                                <span>Share :</span>
                                <a href="#"><i class="fa fa-facebook-square facebook-color"></i></a>
                                <a href="#"><i class="fa fa-twitter-square twitter-color"></i></a>
                                <a href="#"><i class="fa fa-linkedin-square linkedin-color"></i></a>
                                <a href="#"><i class="fa fa-pinterest-square pinterest-color"></i></a>
                            </div>
                            <!-- Social Shear End -->

                            <!-- Product Delivery Policy Start -->
                            <ul class="product-delivery-policy border-top pt-4 mt-4 border-bottom pb-4">
                                <li> <i class="fa fa-check-square"></i> <span>Security Policy (Edit With Customer Reassurance Module)</span></li>
                                <li><i class="fa fa-truck"></i><span>Delivery Policy (Edit With Customer Reassurance Module)</span></li>
                                <li><i class="fa fa-refresh"></i><span>Return Policy (Edit With Customer Reassurance Module)</span></li>
                            </ul>
                            <!-- Product Delivery Policy End -->

                        </div>
                        <!-- Product Summery End -->

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal End  -->

    <!-- Scripts -->
    <!-- Scripts -->
    <!-- Global Vendor, plugins JS -->

    <!-- Vendors JS -->


    <script src="{{asset('useLadame/js/vendor/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('useLadame/js/vendor/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('useLadame/js/vendor/jquery-migrate-3.3.2.min.js')}}"></script>
    <script src="{{asset('useLadame/js/vendor/modernizr-3.11.2.min.js')}}"></script>

    @stack('js')

    <!-- Plugins JS -->


    <script src="{{asset('useLadame/js/plugins/countdown.min.js')}}"></script>
    <script src="{{asset('useLadame/js/plugins/aos.min.js')}}"></script>
    <script src="{{asset('useLadame/js/plugins/swiper-bundle.min.js')}}"></script>
    <script src="{{asset('useLadame/js/plugins/nice-select.min.js')}}"></script>
    <script src="{{asset('useLadame/js/plugins/jquery.ajaxchimp.min.js')}}"></script>
    <script src="{{asset('useLadame/js/plugins/jquery-ui.min.js')}}"></script>
    <script src="{{asset('useLadame/js/plugins/lightgallery-all.min.js')}}"></script>
    <script src="{{asset('useLadame/js/plugins/thia-sticky-sidebar.min.js')}}"></script>


    <!-- Use the minified version files listed below for better performance and remove the files listed above -->


    <!--
   <script src="useLadame/js/vendor.min.js"></script>
   <script src="useLadame/js/plugins.min.js"></script>
   -->



    <!--Main JS-->
    <script src="{{asset('useLadame/js/main.js')}}"></script>



</body>

</html>
