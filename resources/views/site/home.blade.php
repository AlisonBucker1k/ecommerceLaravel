@extends('site.main')

@section('content')
    <!-- Hero/Intro Slider Start -->
    <div class="section">
        <div class="hero-slider">
            <div class="swiper-container">
                <div class="swiper-wrapper">

                    <!-- Hero Slider Item Start -->
                    <div class="hero-slide-item swiper-slide">
                        <!-- Hero Slider Bg Image Start -->
                        <div class="hero-slide-bg">
                            <img src="{{asset('useLadame/images/slider/slide-1.jpg')}}" alt="Slider Image" />
                        </div>
                        <!-- Hero Slider Bg image End -->

                        <!-- Hero Slider Content Start -->
                        <div class="container">
                            <div class="hero-slide-content">
                                <h2 class="title">
                                    Women New <br />
										Collection
                                </h2>
                                <p>Up to 70% off selected Product</p>
                                <a href="shop-grid.html" class="btn btn-lg btn-primary btn-hover-dark">Shop Now</a>
                            </div>
                        </div>
                        <!-- Hero Slider Content End -->
                    </div>
                    <!-- Hero Slider Item End -->

                    <!-- Hero Slider Item Start -->
                    <div class="hero-slide-item swiper-slide">

                        <!-- Hero Slider Bg Image Start -->
                        <div class="hero-slide-bg">
                            <img src="{{asset('useLadame/images/slider/slide-1-2.jpg')}}" alt="Slider Image" />
                        </div>
                        <!-- Hero Slider Bg Image End -->

                        <!-- Hero Slider Content Start -->
                        <div class="container">
                            <div class="hero-slide-content">
                                <h2 class="title">
                                    Trend Fashion<br />
										Collection
                                </h2>
                                <p>Up to 40% off selected Product</p>
                                <a href="shop-grid.html" class="btn btn-lg btn-primary btn-hover-dark">Shop Now</a>
                            </div>
                        </div>
                        <!-- Hero Slider Content End -->

                    </div>
                    <!-- Hero Slider Item End -->

                </div>

                <!-- Swiper Pagination Start -->
                <div class="swiper-pagination d-md-none"></div>
                <!-- Swiper Pagination End -->

                <!-- Swiper Navigation Start -->
                <div class="home-slider-prev swiper-button-prev main-slider-nav d-md-flex d-none"><i class="pe-7s-angle-left"></i></div>
                <div class="home-slider-next swiper-button-next main-slider-nav d-md-flex d-none"><i class="pe-7s-angle-right"></i></div>
                <!-- Swiper Navigation End -->

            </div>
        </div>
    </div>
    <!-- Hero/Intro Slider End -->

    <!-- Banner Section Start -->
    <div class="section section-margin">
        <div class="container">

            <!-- Banners Start -->
            <div class="row mb-n6">
                <!-- Banner Start -->
                <div class="col-lg-4 col-md-6 col-12 mb-6">
                    <div class="banner" data-aos="fade-up" data-aos-delay="300">
                        <div class="banner-image">
                            <a href=""><img src="{{asset('useLadame/images/banner/banner-1.jpg')}}" alt=""></a>
                        </div>
                        <div class="info">
                            <div class="small-banner-content">
                                <h4 class="sub-title">Sun Hat</h4>
                                <h3 class="title">Get Offer <br />For Summer</h3>
                                <a href="shop-grid.html" class="btn btn-dark btn-sm">Shop Now</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Banner End -->

                <!-- Banner Start -->
                <div class="col-lg-4 col-md-6 col-12 mb-6">
                    <div class="banner" data-aos="fade-up" data-aos-delay="500">
                        <div class="banner-image">
                            <a href=""><img src="{{asset('useLadame/images/banner/banner-2.jpg')}}" alt=""></a>
                        </div>
                        <div class="info">
                            <div class="small-banner-content">
                                <h4 class="sub-title">Ladies Bag</h4>
                                <h3 class="title">Buy One <br />Get One Free</h3>
                                <a href="shop-grid.html" class="btn btn-dark btn-sm">Shop Now</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Banner End -->

                <!-- Banner Start -->
                <div class="col-lg-4 col-md-6 col-12 mb-6">
                    <div class="banner" data-aos="fade-up" data-aos-delay="700">
                        <div class="banner-image">
                            <a href=""><img src="{{asset('useLadame/images/banner/banner-3.jpg')}}" alt=""></a>
                        </div>
                        <div class="info">
                            <div class="small-banner-content">
                                <h4 class="sub-title">Smart Watch</h4>
                                <h3 class="title">20% Off <br />Smart Watch</h3>
                                <a href="shop-grid.html" class="btn btn-dark btn-sm">Shop Now</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Banner End -->

            </div>
            <!-- Banners End -->
        </div>
    </div>
    <!-- Banner Section End -->

    <!-- Feature Section Start -->
    <div class="section">
        <div class="container">
            <div class="feature-wrap">
                <div class="row row-cols-lg-4 row-cols-xl-auto row-cols-sm-2 row-cols-1 justify-content-between mb-n5">
                    <!-- Feature Start -->
                    <div class="col mb-5" data-aos="fade-up" data-aos-delay="300">
                        <div class="feature">
                            <div class="icon text-primary align-self-center">
                                <img src="{{asset('useLadame/images/icons/feature-icon-2.png')}}" alt="Feature Icon">
                            </div>
                            <div class="content">
                                <h5 class="title">Free Shipping</h5>
                                <p>Free shipping on all order</p>
                            </div>
                        </div>
                    </div>
                    <!-- Feature End -->

                    <!-- Feature Start -->
                    <div class="col mb-5" data-aos="fade-up" data-aos-delay="500">
                        <div class="feature">
                            <div class="icon text-primary align-self-center">
                                <img src="{{asset('useLadame/images/icons/feature-icon-3.png')}}" alt="Feature Icon">
                            </div>
                            <div class="content">
                                <h5 class="title">Support 24/7</h5>
                                <p>Support 24 hours a day</p>
                            </div>
                        </div>
                    </div>
                    <!-- Feature End -->
                    <!-- Feature Start -->
                    <div class="col mb-5" data-aos="fade-up" data-aos-delay="700">
                        <div class="feature">
                            <div class="icon text-primary align-self-center">
                                <img src="{{asset('useLadame/images/icons/feature-icon-4.png')}}" alt="Feature Icon">
                            </div>
                            <div class="content">
                                <h5 class="title">Money Return</h5>
                                <p>Back guarantee under 5 days</p>
                            </div>
                        </div>
                    </div>
                    <!-- Feature End -->

                    <!-- Feature Start -->
                    <div class="col mb-5" data-aos="fade-up" data-aos-delay="900">
                        <div class="feature">
                            <div class="icon text-primary align-self-center">
                                <img src="{{asset('useLadame/images/icons/feature-icon-1.png')}}" alt="Feature Icon">
                            </div>
                            <div class="content">
                                <h5 class="title">Order Discount</h5>
                                <p>Onevery order over $150</p>
                            </div>
                        </div>
                    </div>
                    <!-- Feature End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Feature Section End -->

    <!-- Product Section Start -->
    <div class="section section-padding mt-0">
        <div class="container">
            <!-- Section Title & Tab Start -->
            <div class="row">
                <!-- Tab Start -->
                <div class="col-12">
                    <ul class="product-tab-nav nav justify-content-center mb-10 title-border-bottom mt-n3">
                        <li class="nav-item" data-aos="fade-up" data-aos-delay="300"><a class="nav-link active mt-3" data-bs-toggle="tab" href="#tab-product-all">Destaques</a></li>
                        <li class="nav-item" data-aos="fade-up" data-aos-delay="400"><a class="nav-link mt-3" data-bs-toggle="tab" href="#tab-product-clothings">Mais Vendidos</a></li>
                        <li class="nav-item" data-aos="fade-up" data-aos-delay="500"><a class="nav-link mt-3" data-bs-toggle="tab" href="#tab-product-all">Promoção</a></li>
                    </ul>
                </div>
                <!-- Tab End -->
            </div>
            <!-- Section Title & Tab End -->

            <!-- Products Tab Start -->
            <div class="row">
                <div class="col">
                    <div class="tab-content position-relative">
                        <div class="tab-pane fade show active" id="tab-product-all">
                            <div class="product-carousel">
                                <div class="swiper-container">
                                    <div class="swiper-wrapper mb-n10">

                                        <!-- Product Start -->
                                        <div class="swiper-slide product-wrapper">

                                            <!-- Single Product Start -->
                                            <div class="product product-border-left mb-10" data-aos="fade-up" data-aos-delay="300">
                                                <div class="thumb">
                                                    <a href="/produto/ut-adipisci-sed-suscit-libero/20" class="image">
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
                                                    <h4 class="sub-title"><a href="single-product.html">Studio Design</a></h4>
                                                    <h5 class="title"><a href="produto/ut-adipisci-sed-suscipit-libero/20">Brother Hoddies in Grey</a></h5>
                                                    <span class="ratings">
															<span class="rating-wrap">
																<span class="star" style="width: 100%"></span>
                                                    </span>
                                                    <span class="rating-num">(4)</span>
                                                    </span>
                                                    <span class="price">
															<span class="new">$38.50</span>
                                                    <span class="old">$42.85</span>
                                                    </span>
                                                    <button class="btn btn-sm btn-outline-dark btn-hover-primary">Add To Cart</button>
                                                </div>
                                            </div>
                                            <!-- Single Product End -->

                                            <!-- Single Product Start -->
                                            <div class="product product-border-left mb-10" data-aos="fade-up" data-aos-delay="400">
                                                <div class="thumb">
                                                    <a href="single-product.html" class="image">
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
                                                    <h4 class="sub-title"><a href="single-product.html">Studio Design</a></h4>
                                                    <h5 class="title"><a href="single-product.html">Basic Jogging Shorts</a></h5>
                                                    <span class="ratings">
															<span class="rating-wrap">
																<span class="star" style="width: 100%"></span>
                                                    </span>
                                                    <span class="rating-num">(4)</span>
                                                    </span>
                                                    <span class="price">
															<span class="new">$14.50</span>
                                                    <span class="old">$18.00</span>
                                                    </span>
                                                    <button class="btn btn-sm btn-outline-dark btn-hover-primary">Add To Cart</button>
                                                </div>
                                            </div>
                                            <!-- Single Product End -->

                                        </div>
                                        <!-- Product End -->

                                        <!-- Product Start -->
                                        <div class="swiper-slide product-wrapper">

                                            <!-- Single Product Start -->
                                            <div class="product product-border-left mb-10" data-aos="fade-up" data-aos-delay="400">
                                                <div class="thumb">
                                                    <a href="single-product.html" class="image">
                                                        <img class="first-image" src="{{asset('useLadame/images/products/medium-size/1.jpg')}}" alt="Product" />
                                                        <img class="second-image" src="{{asset('useLadame/images/products/medium-size/5.jpg')}}" alt="Product" />
                                                    </a>
                                                    <span class="badges">
															<span class="sale">New</span>
                                                    </span>
                                                    <div class="actions">
                                                        <a href="#" class="action wishlist"><i class="pe-7s-like"></i></a>
                                                        <a href="#" class="action quickview" data-bs-toggle="modal" data-bs-target="#exampleModalCenter"><i class="pe-7s-search"></i></a>
                                                        <a href="#" class="action compare"><i class="pe-7s-shuffle"></i></a>
                                                    </div>
                                                </div>
                                                <div class="content">
                                                    <h4 class="sub-title"><a href="single-product.html">Studio Design</a></h4>
                                                    <h5 class="title"><a href="single-product.html">Simple Woven Fabrics</a></h5>
                                                    <span class="ratings">
															<span class="rating-wrap">
																<span class="star" style="width: 67%"></span>
                                                    </span>
                                                    <span class="rating-num">(2)</span>
                                                    </span>
                                                    <span class="price">
															<span class="new">$45.50</span>
                                                    <span class="old">$48.85</span>
                                                    </span>
                                                    <button class="btn btn-sm btn-outline-dark btn-hover-primary">Add To Cart</button>
                                                </div>
                                            </div>
                                            <!-- Single Product End -->

                                            <!-- Single Product Start -->
                                            <div class="product product-border-left mb-10" data-aos="fade-up" data-aos-delay="500">
                                                <div class="thumb">
                                                    <a href="single-product.html" class="image">
                                                        <img class="first-image" src="{{asset('useLadame/images/products/medium-size/1.jpg')}}" alt="Product" />
                                                        <img class="second-image" src="{{asset('useLadame/images/products/medium-size/5.jpg')}}" alt="Product" />
                                                    </a>
                                                    <span class="badges">
															<span class="sale">Sold</span>
                                                    </span>
                                                    <div class="actions">
                                                        <a href="#" class="action wishlist"><i class="pe-7s-like"></i></a>
                                                        <a href="#" class="action quickview" data-bs-toggle="modal" data-bs-target="#exampleModalCenter"><i class="pe-7s-search"></i></a>
                                                        <a href="#" class="action compare"><i class="pe-7s-shuffle"></i></a>
                                                    </div>
                                                </div>
                                                <div class="content">
                                                    <h4 class="sub-title"><a href="single-product.html">Studio Design</a></h4>
                                                    <h5 class="title"><a href="single-product.html">Make Thing Happen T-Shirt</a></h5>
                                                    <span class="ratings">
															<span class="rating-wrap">
																<span class="star" style="width: 80%"></span>
                                                    </span>
                                                    <span class="rating-num">(2)</span>
                                                    </span>
                                                    <span class="price">
															<span class="new">$16.00</span>
                                                    <span class="old">$18.00</span>
                                                    </span>
                                                    <button class="btn btn-sm btn-outline-dark btn-hover-primary">Add To Cart</button>
                                                </div>
                                            </div>
                                            <!-- Single Product End -->

                                        </div>
                                        <!-- Product End -->

                                        <!-- Product Start -->
                                        <div class="swiper-slide product-wrapper">

                                            <!-- Single Product Start -->
                                            <div class="product product-border-left mb-10" data-aos="fade-up" data-aos-delay="500">
                                                <div class="thumb">
                                                    <a href="single-product.html" class="image">
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
                                                    <h4 class="sub-title"><a href="single-product.html">Lather Design</a></h4>
                                                    <h5 class="title"><a href="single-product.html">Basic Lather Sneaker</a></h5>
                                                    <span class="ratings">
															<span class="rating-wrap">
																<span class="star" style="width: 100%"></span>
                                                    </span>
                                                    <span class="rating-num">(12)</span>
                                                    </span>
                                                    <span class="price">
															<span class="new">$65.00</span>
                                                    </span>
                                                    <button class="btn btn-sm btn-outline-dark btn-hover-primary">Add To Cart</button>
                                                </div>
                                            </div>
                                            <!-- Single Product End -->

                                            <!-- Single Product Start -->
                                            <div class="product product-border-left mb-10" data-aos="fade-up" data-aos-delay="600">
                                                <div class="thumb">
                                                    <a href="single-product.html" class="image">
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
                                                    <h4 class="sub-title"><a href="single-product.html">Fabric Design</a></h4>
                                                    <h5 class="title"><a href="single-product.html">Simple Woven Fashion</a></h5>
                                                    <span class="ratings">
															<span class="rating-wrap">
																<span class="star" style="width: 70%"></span>
                                                    </span>
                                                    <span class="rating-num">(09)</span>
                                                    </span>
                                                    <span class="price">
															<span class="new">$27.00</span>
                                                    <span class="old">$29.50</span>
                                                    </span>
                                                    <button class="btn btn-sm btn-outline-dark btn-hover-primary">Add To Cart</button>
                                                </div>
                                            </div>
                                            <!-- Single Product End -->

                                        </div>
                                        <!-- Product End -->

                                        <!-- Product Start -->
                                        <div class="swiper-slide product-wrapper">

                                            <!-- Single Product Start -->
                                            <div class="product product-border-left mb-10" data-aos="fade-up" data-aos-delay="600">
                                                <div class="thumb">
                                                    <a href="single-product.html" class="image">
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
                                                    <h4 class="sub-title"><a href="single-product.html">Design Source</a></h4>
                                                    <h5 class="title"><a href="single-product.html">Handmade Shoulder Bag</a></h5>
                                                    <span class="ratings">
															<span class="rating-wrap">
																<span class="star" style="width: 100%"></span>
                                                    </span>
                                                    <span class="rating-num">(06)</span>
                                                    </span>
                                                    <span class="price">
															<span class="new">$96.50</span>
                                                    <span class="old">$100.00</span>
                                                    </span>
                                                    <button class="btn btn-sm btn-outline-dark btn-hover-primary">Add To Cart</button>
                                                </div>
                                            </div>
                                            <!-- Single Product End -->

                                            <!-- Single Product Start -->
                                            <div class="product product-border-left mb-10" data-aos="fade-up" data-aos-delay="700">
                                                <div class="thumb">
                                                    <a href="single-product.html" class="image">
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
                                                    <h4 class="sub-title"><a href="single-product.html">Studio Design</a></h4>
                                                    <h5 class="title"><a href="single-product.html">Enjoy The Rest T-Shirt</a></h5>
                                                    <span class="ratings">
															<span class="rating-wrap">
																<span class="star" style="width: 100%"></span>
                                                    </span>
                                                    <span class="rating-num">(4)</span>
                                                    </span>
                                                    <span class="price">
															<span class="new">$22.00</span>
                                                    </span>
                                                    <button class="btn btn-sm btn-outline-dark btn-hover-primary">Add To Cart</button>
                                                </div>
                                            </div>
                                            <!-- Single Product End -->

                                        </div>
                                        <!-- Product End -->

                                        <!-- Product Start -->
                                        <div class="swiper-slide product-wrapper">

                                            <!-- Single Product Start -->
                                            <div class="product product-border-left mb-10" data-aos="fade-up" data-aos-delay="700">
                                                <div class="thumb">
                                                    <a href="single-product.html" class="image">
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
                                                    <h4 class="sub-title"><a href="single-product.html">Lather Design</a></h4>
                                                    <h5 class="title"><a href="single-product.html">Basic Lather Sneaker</a></h5>
                                                    <span class="ratings">
															<span class="rating-wrap">
																<span class="star" style="width: 100%"></span>
                                                    </span>
                                                    <span class="rating-num">(12)</span>
                                                    </span>
                                                    <span class="price">
															<span class="new">$65.00</span>
                                                    </span>
                                                    <button class="btn btn-sm btn-outline-dark btn-hover-primary">Add To Cart</button>
                                                </div>
                                            </div>
                                            <!-- Single Product End -->

                                            <!-- Single Product Start -->
                                            <div class="product product-border-left mb-10" data-aos="fade-up" data-aos-delay="800">
                                                <div class="thumb">
                                                    <a href="single-product.html" class="image">
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
                                                    <h4 class="sub-title"><a href="single-product.html">Fabric Design</a></h4>
                                                    <h5 class="title"><a href="single-product.html">Simple Woven Fashion</a></h5>
                                                    <span class="ratings">
															<span class="rating-wrap">
																<span class="star" style="width: 70%"></span>
                                                    </span>
                                                    <span class="rating-num">(09)</span>
                                                    </span>
                                                    <span class="price">
															<span class="new">$27.00</span>
                                                    <span class="old">$29.50</span>
                                                    </span>
                                                    <button class="btn btn-sm btn-outline-dark btn-hover-primary">Add To Cart</button>
                                                </div>
                                            </div>
                                            <!-- Single Product End -->

                                        </div>
                                        <!-- Product End -->

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
                        <div class="tab-pane fade" id="tab-product-clothings">
                            <div class="product-carousel">
                                <div class="swiper-container">
                                    <div class="swiper-wrapper mb-n10">

                                        <!-- Product Start -->
                                        <div class="swiper-slide product-wrapper">

                                            <!-- Single Product Start -->
                                            <div class="product product-border-left mb-10">
                                                <div class="thumb">
                                                    <a href="single-product.html" class="image">
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
                                                    <h4 class="sub-title"><a href="single-product.html">Studio Design</a></h4>
                                                    <h5 class="title"><a href="single-product.html">Basic Jogging Shorts</a></h5>
                                                    <span class="ratings">
															<span class="rating-wrap">
																<span class="star" style="width: 100%"></span>
                                                    </span>
                                                    <span class="rating-num">(4)</span>
                                                    </span>
                                                    <span class="price">
															<span class="new">$14.50</span>
                                                    <span class="old">$18.00</span>
                                                    </span>
                                                    <button class="btn btn-sm btn-outline-dark btn-hover-primary">Add To Cart</button>
                                                </div>
                                            </div>
                                            <!-- Single Product End -->

                                            <!-- Single Product Start -->
                                            <div class="product product-border-left mb-10">
                                                <div class="thumb">
                                                    <a href="single-product.html" class="image">
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
                                                    <h4 class="sub-title"><a href="single-product.html">Studio Design</a></h4>
                                                    <h5 class="title"><a href="single-product.html">Brother Hoddies in Grey</a></h5>
                                                    <span class="ratings">
															<span class="rating-wrap">
																<span class="star" style="width: 100%"></span>
                                                    </span>
                                                    <span class="rating-num">(4)</span>
                                                    </span>
                                                    <span class="price">
															<span class="new">$38.50</span>
                                                    <span class="old">$42.85</span>
                                                    </span>
                                                    <button class="btn btn-sm btn-outline-dark btn-hover-primary">Add To Cart</button>
                                                </div>
                                            </div>
                                            <!-- Single Product End -->

                                        </div>
                                        <!-- Product End -->

                                        <!-- Product Start -->
                                        <div class="swiper-slide product-wrapper">

                                            <!-- Single Product Start -->
                                            <div class="product product-border-left mb-10">
                                                <div class="thumb">
                                                    <a href="single-product.html" class="image">
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
                                                    <h4 class="sub-title"><a href="single-product.html">Design Source</a></h4>
                                                    <h5 class="title"><a href="single-product.html">Handmade Shoulder Bag</a></h5>
                                                    <span class="ratings">
															<span class="rating-wrap">
																<span class="star" style="width: 100%"></span>
                                                    </span>
                                                    <span class="rating-num">(06)</span>
                                                    </span>
                                                    <span class="price">
															<span class="new">$96.50</span>
                                                    <span class="old">$100.00</span>
                                                    </span>
                                                    <button class="btn btn-sm btn-outline-dark btn-hover-primary">Add To Cart</button>
                                                </div>
                                            </div>
                                            <!-- Single Product End -->

                                            <!-- Single Product Start -->
                                            <div class="product product-border-left mb-10">
                                                <div class="thumb">
                                                    <a href="single-product.html" class="image">
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
                                                    <h4 class="sub-title"><a href="single-product.html">Studio Design</a></h4>
                                                    <h5 class="title"><a href="single-product.html">Enjoy The Rest T-Shirt</a></h5>
                                                    <span class="ratings">
															<span class="rating-wrap">
																<span class="star" style="width: 100%"></span>
                                                    </span>
                                                    <span class="rating-num">(4)</span>
                                                    </span>
                                                    <span class="price">
															<span class="new">$22.00</span>
                                                    </span>
                                                    <button class="btn btn-sm btn-outline-dark btn-hover-primary">Add To Cart</button>
                                                </div>
                                            </div>
                                            <!-- Single Product End -->

                                        </div>
                                        <!-- Product End -->

                                        <!-- Product Start -->
                                        <div class="swiper-slide product-wrapper">

                                            <!-- Single Product Start -->
                                            <div class="product product-border-left mb-10">
                                                <div class="thumb">
                                                    <a href="single-product.html" class="image">
                                                       <img class="first-image" src="{{asset('useLadame/images/products/medium-size/1.jpg')}}" alt="Product" />
                                                        <img class="second-image" src="{{asset('useLadame/images/products/medium-size/5.jpg')}}" alt="Product" />
                                                    </a>
                                                    <span class="badges">
															<span class="sale">New</span>
                                                    </span>
                                                    <div class="actions">
                                                        <a href="#" class="action wishlist"><i class="pe-7s-like"></i></a>
                                                        <a href="#" class="action quickview" data-bs-toggle="modal" data-bs-target="#exampleModalCenter"><i class="pe-7s-search"></i></a>
                                                        <a href="#" class="action compare"><i class="pe-7s-shuffle"></i></a>
                                                    </div>
                                                </div>
                                                <div class="content">
                                                    <h4 class="sub-title"><a href="single-product.html">Studio Design</a></h4>
                                                    <h5 class="title"><a href="single-product.html">Simple Woven Fabrics</a></h5>
                                                    <span class="ratings">
															<span class="rating-wrap">
																<span class="star" style="width: 67%"></span>
                                                    </span>
                                                    <span class="rating-num">(2)</span>
                                                    </span>
                                                    <span class="price">
															<span class="new">$45.50</span>
                                                    <span class="old">$48.85</span>
                                                    </span>
                                                    <button class="btn btn-sm btn-outline-dark btn-hover-primary">Add To Cart</button>
                                                </div>
                                            </div>
                                            <!-- Single Product End -->

                                            <!-- Single Product Start -->
                                            <div class="product product-border-left mb-10">
                                                <div class="thumb">
                                                    <a href="single-product.html" class="image">
                                                       <img class="first-image" src="{{asset('useLadame/images/products/medium-size/1.jpg')}}" alt="Product" />
                                                        <img class="second-image" src="{{asset('useLadame/images/products/medium-size/5.jpg')}}" alt="Product" />
                                                    </a>
                                                    <span class="badges">
															<span class="sale">Sold</span>
                                                    </span>
                                                    <div class="actions">
                                                        <a href="#" class="action wishlist"><i class="pe-7s-like"></i></a>
                                                        <a href="#" class="action quickview" data-bs-toggle="modal" data-bs-target="#exampleModalCenter"><i class="pe-7s-search"></i></a>
                                                        <a href="#" class="action compare"><i class="pe-7s-shuffle"></i></a>
                                                    </div>
                                                </div>
                                                <div class="content">
                                                    <h4 class="sub-title"><a href="single-product.html">Studio Design</a></h4>
                                                    <h5 class="title"><a href="single-product.html">Make Thing Happen T-Shirt</a></h5>
                                                    <span class="ratings">
															<span class="rating-wrap">
																<span class="star" style="width: 80%"></span>
                                                    </span>
                                                    <span class="rating-num">(2)</span>
                                                    </span>
                                                    <span class="price">
															<span class="new">$16.00</span>
                                                    <span class="old">$18.00</span>
                                                    </span>
                                                    <button class="btn btn-sm btn-outline-dark btn-hover-primary">Add To Cart</button>
                                                </div>
                                            </div>
                                            <!-- Single Product End -->

                                        </div>
                                        <!-- Product End -->

                                        <!-- Product Start -->
                                        <div class="swiper-slide product-wrapper">

                                            <!-- Single Product Start -->
                                            <div class="product product-border-left mb-10">
                                                <div class="thumb">
                                                    <a href="single-product.html" class="image">
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
                                                    <h4 class="sub-title"><a href="single-product.html">Lather Design</a></h4>
                                                    <h5 class="title"><a href="single-product.html">Basic Lather Sneaker</a></h5>
                                                    <span class="ratings">
															<span class="rating-wrap">
																<span class="star" style="width: 100%"></span>
                                                    </span>
                                                    <span class="rating-num">(12)</span>
                                                    </span>
                                                    <span class="price">
															<span class="new">$65.00</span>
                                                    </span>
                                                    <button class="btn btn-sm btn-outline-dark btn-hover-primary">Add To Cart</button>
                                                </div>
                                            </div>
                                            <!-- Single Product End -->

                                            <!-- Single Product Start -->
                                            <div class="product product-border-left mb-10">
                                                <div class="thumb">
                                                    <a href="single-product.html" class="image">
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
                                                    <h4 class="sub-title"><a href="single-product.html">Fabric Design</a></h4>
                                                    <h5 class="title"><a href="single-product.html">Simple Woven Fashion</a></h5>
                                                    <span class="ratings">
															<span class="rating-wrap">
																<span class="star" style="width: 70%"></span>
                                                    </span>
                                                    <span class="rating-num">(09)</span>
                                                    </span>
                                                    <span class="price">
															<span class="new">$27.00</span>
                                                    <span class="old">$29.50</span>
                                                    </span>
                                                    <button class="btn btn-sm btn-outline-dark btn-hover-primary">Add To Cart</button>
                                                </div>
                                            </div>
                                            <!-- Single Product End -->

                                        </div>
                                        <!-- Product End -->

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
            <!-- Products Tab End -->
        </div>
    </div>
    <!-- Product Section End -->

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
    <div class="section">
        <div class="container">

            <!-- Banners Start -->
            <div class="row mb-n6 overflow-hidden">
                <!-- Banner Start -->
                <div class="col-md-6 col-12 mb-6" data-aos="fade-right" data-aos-delay="300">
                    <div class="banner">
                        <div class="banner-image">
                            <a href="shop-grid.html"><img src="{{asset('useLadame/images/banner/banner-4.jpg')}}" alt="Banner Image"></a>
                        </div>
                        <div class="info">
                            <div class="small-banner-content">
                                <h4 class="sub-title">Up to <span>50%</span> Off</h4>
                                <h3 class="title">Office Dress</h3>
                                <a href="shop-grid.html" class="btn btn-primary btn-hover-dark btn-sm">Shop Now</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Banner End -->

                <!-- Banner Start -->
                <div class="col-md-6 col-12 mb-6" data-aos="fade-left" data-aos-delay="300">
                    <div class="banner">
                        <div class="banner-image">
                            <a href="shop-grid.html"><img src="{{asset('useLadame/images/banner/banner-5.jpg')}}" alt="Banner Image"></a>
                        </div>
                        <div class="info">
                            <div class="small-banner-content">
                                <h4 class="sub-title">Up to <span>40%</span> Off</h4>
                                <h3 class="title">All Products</h3>
                                <a href="shop-grid.html" class="btn btn-primary btn-hover-dark btn-sm">Shop Now</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Banner End -->

            </div>
            <!-- Banners End -->
        </div>
    </div>
    <!-- Banner Section End -->

    <!-- Product List Start -->
    <div class="section section-padding">
        <div class="container">
            <div class="row mb-n8">
                <div class="col-md-6 col-lg-4 col-12 mb-8" data-aos="fade-up" data-aos-delay="300">
                    <!-- Product List Title Start -->
                    <div class="product-list-title">
                        <h2 class="title pb-3 mb-0">Best Offer</h2>
                        <span></span>
                    </div>
                    <!-- Product List Title End -->

                    <!-- Product List Carousel Start -->
                    <div class="product-list-carousel">
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
    </div>
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