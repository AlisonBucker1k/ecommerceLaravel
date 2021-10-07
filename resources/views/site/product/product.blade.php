@extends('site.main')

@section('content')
    <div class="section">
        <div class="breadcrumb-area bg-light">
            <div class="container-fluid">
                <div class="breadcrumb-content text-center">
                    <h1 class="title">{{ $product->name }}</h1>
                    <ul>
                        <li>
                            <a href="{{ route('home') }}">Home </a>
                        </li>
                        <li class="active">{{ $product->name }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="section section-margin">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 offset-lg-0 col-md-8 offset-md-2 col-custom">
                    <div class="product-details-img">
                        <div class="single-product-thumb swiper-container gallery-thumbs">
                            <div class="swiper-wrapper">
                                @if (!empty($product->images))
                                    @foreach ($product->images as $image)
                                        <div class="swiper-slide">
                                            <img src="{{ $image->file }}" id="image{{ $image->id }}">
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="swiper-button-horizental-next  swiper-button-next"><i class="pe-7s-angle-right"></i></div>
                            <div class="swiper-button-horizental-prev swiper-button-prev"><i class="pe-7s-angle-left"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-custom">
                    <div class="product-summery position-relative">
                        <div class="product-head mb-3">
                            <h2 class="product-title">{{ $product->name }}</h2>
                        </div>
                        <div class="price-box mb-2">
                            <span class="regular-price">{{ $product->mainVariation->promotion_value_formated }}</span>
                            <span class="old-price"><del>{{ $product->mainVariation->value_formated }}</del></span>
                        </div>
{{--                            <span class="ratings justify-content-start">--}}
{{--                                <span class="rating-wrap">--}}
{{--                                    <span class="star" style="width: 100%"></span>--}}
{{--                                </span>--}}
{{--                        <span class="rating-num">(4)</span>--}}
{{--                            </span>--}}
{{--                        <div class="sku mb-3">--}}
{{--                            <span>SKU: 12345</span>--}}
{{--                        </div>--}}
{{--                        <p class="desc-content mb-5">asdasdasd</p>--}}
{{--                        <div class="product-meta mb-3">--}}
{{--                            <div class="product-size">--}}
{{--                                <span>Tamanho:</span>--}}
{{--                                <a href=""><strong>S</strong></a>--}}
{{--                                <a href=""><strong>M</strong></a>--}}
{{--                                <a href=""><strong>L</strong></a>--}}
{{--                                <a href=""><strong>XL</strong></a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="product-color-variation mb-3">--}}
{{--                            <button type="button" class="btn bg-danger"></button>--}}
{{--                            <button type="button" class="btn bg-primary"></button>--}}
{{--                            <button type="button" class="btn bg-dark"></button>--}}
{{--                            <button type="button" class="btn bg-success"></button>--}}
{{--                        </div>--}}
{{--                        <div class="product-meta mb-5">--}}
{{--                            <div class="product-metarial">--}}
{{--                                <span>Material:</span>--}}
{{--                                <a href=""><strong>Metal</strong></a>--}}
{{--                                <a href=""><strong>Resin</strong></a>--}}
{{--                                <a href=""><strong>Lather</strong></a>--}}
{{--                                <a href=""><strong>Polymer</strong></a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="quantity mb-5">
                            <div class="cart-plus-minus">
                                <input class="cart-plus-minus-box" value="0" type="text">
                                <div class="dec qtybutton"></div>
                                <div class="inc qtybutton"></div>
                            </div>
                        </div>

                        @if ($total_stock <= 0)
                            <div class="alert alert-warning">
                                Produto indisponível no momento.
                            </div>
                        @else
                            @if ($product->has_grid_variation == 0)
                                <div id="valueDefault">
                                    @if ($product->mainVariation->promotion_value > 0)
                                        <strong class="main-value">
                                            <small>R$</small> {{ $product->mainVariation->promotion_value_formated }}
                                        </strong>
                                        <strike class="text-1">
                                            <small>R$</small> {{ $product->mainVariation->value_formated }}
                                        </strike>
                                        <p>
                                            Economia de R$ {{ $product->mainVariation->value_saving_formated }}
                                        </p>
                                    @else
                                        <strong class="main-value mb-4">
                                            <small>R$</small> {{ $product->mainVariation->value_formated }}
                                        </strong>
                                    @endif
                                </div>
                            @endif

                            <div id="loadingValue" class="d-none">
                                <span class="fa fa-spin fa-spinner"></span>
                            </div>
                            <div id="currentValue" class="d-none">
                                <strong class="main-value is-promotion" id="promotionValue">
                                    <small>R$</small> <span class="value"></span>
                                </strong>
                                <div id="totalValue">
                                    <strike class="text-1 promotion">
                                        <small>R$</small> <span class="value"></span>
                                    </strike>
                                    <strong class="main-value no-promotion mb-4">
                                        <small>R$</small> <span class="value"></span>
                                    </strong>
                                </div>
                                <p class="is-promotion" id="discountDescription">
                                    Economia de R$ <span class="value"></span>
                                </p>
                            </div>
                            <form method="post" action="/carrinho/{{ $product->slug }}/add" id="addCartForm" class="form-bg">
                                @csrf
                                <input type="hidden" name="variation_id" id="variationId" value="{{ $product->mainVariation->id }}">
                                <div class="row">
                                    @foreach ($grids as $grid)
                                        <div class="col-md-12 mb-3">
                                            <div class="form-group">
                                                <label class="control-label font-weight-bold">{{ $grid->description }}</label>
                                                <select class="form-control select-variation" id="variation{{ $grid->id }}" data-id="{{ $grid->id }}" name="variation[{{ $grid->id }}]" required="required">
                                                    @foreach ($grid->variations as $variation)
                                                        <option value="{{ $variation->id }}" @if ($product->variation->items[$grid->grid_id]->grid_variation_id == $variation->id) selected="selected"@endif>{{ $variation->description }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    @endforeach
                                    <button type="submit" id="btnBuy" class="btn btn-primary btn-block">
                                        COMPRAR
                                    </button>
                                </div>
                            </form>
                        @endif

                        @if ($product->category->id != '' || $product->subcategory->id != '')
                            <div class="product-meta">
                                    <span class="posted-in">
                                        Categoria:
                                        @if ($product->category->id != '')
                                            <a rel="tag" href="{{ route('products', $product->category->slug) }}">{{ $product->category->name }}</a>
                                        @endif

                                        @if ($product->subcategory->id != '')
                                            , <a rel="tag" href="{{ route('products', [$product->category->slug, $product->subcategory->slug]) }}">{{ $product->subcategory->name }}</a>.
                                        @endif
                                    </span>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
            <div class="row section-margin">
                <div class="col-lg-12 col-custom single-product-tab">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active text-uppercase" id="home-tab" data-bs-toggle="tab" href="#connect-1" role="tab" aria-selected="true">Description</a>
                        </li>
{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link text-uppercase" id="profile-tab" data-bs-toggle="tab" href="#connect-2" role="tab" aria-selected="false">Reviews</a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link text-uppercase" id="contact-tab" data-bs-toggle="tab" href="#connect-3" role="tab" aria-selected="false">Shipping Policy</a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link text-uppercase" id="review-tab" data-bs-toggle="tab" href="#connect-4" role="tab" aria-selected="false">Size Chart</a>--}}
{{--                        </li>--}}
                    </ul>
                    <div class="tab-content mb-text" id="myTabContent">
                        <div class="tab-pane fade show active" id="connect-1" role="tabpanel" aria-labelledby="home-tab">
                            <div class="desc-content border p-3">
                                <p class="mb-3">{{ $product->description }}</p>
                            </div>
                        </div>
{{--                        <div class="tab-pane fade" id="connect-2" role="tabpanel" aria-labelledby="profile-tab">--}}
{{--                            <div class="product_tab_content  border p-3">--}}
{{--                                <div class="single-review d-flex mb-4">--}}
{{--                                    <div class="review_thumb">--}}
{{--                                        <img alt="review images" src="assets/images/review/1.jpg">--}}
{{--                                    </div>--}}
{{--                                    <div class="review_details">--}}
{{--                                        <div class="review_info mb-2">--}}
{{--                                            <span class="ratings justify-content-start mb-3">--}}
{{--                                                <span class="rating-wrap">--}}
{{--                                                <span class="star" style="width: 100%"></span>--}}
{{--                                            </span>--}}
{{--                                            <span class="rating-num">(1)</span>--}}
{{--                                            </span>--}}
{{--                                            <div class="review-title-date d-flex">--}}
{{--                                                <h5 class="title">Admin - </h5><span> January 19, 2021</span>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin in viverra ex, vitae vestibulum arcu. Duis sollicitudin metus sed lorem commodo, eu dapibus libero interdum. Morbi convallis viverra erat, et aliquet orci congue vel. Integer in odio enim. Pellentesque in dignissim leo. Vivamus varius ex sit amet quam tincidunt iaculis.</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="rating_wrap">--}}
{{--                                    <h5 class="rating-title mb-2">Add a review </h5>--}}
{{--                                    <p class="mb-2">Your email address will not be published. Required fields are marked *</p>--}}
{{--                                    <h6 class="rating-sub-title mb-2">Your Rating</h6>--}}
{{--                                    <span class="ratings justify-content-start mb-3">--}}
{{--                                        <span class="rating-wrap">--}}
{{--                                        <span class="star" style="width: 100%"></span>--}}
{{--                                    </span>--}}
{{--                                    <span class="rating-num">(2)</span>--}}
{{--                                    </span>--}}
{{--                                </div>--}}
{{--                                <div class="comments-area comments-reply-area">--}}
{{--                                    <div class="row">--}}
{{--                                        <div class="col-lg-12 col-custom">--}}
{{--                                            <form action="#" class="comment-form-area">--}}
{{--                                                <div class="row comment-input">--}}
{{--                                                    <div class="col-md-6 col-custom comment-form-author mb-3">--}}
{{--                                                        <label>Name <span class="required">*</span></label>--}}
{{--                                                        <input type="text" required="required" name="Name">--}}
{{--                                                    </div>--}}
{{--                                                    <div class="col-md-6 col-custom comment-form-emai mb-3">--}}
{{--                                                        <label>Email <span class="required">*</span></label>--}}
{{--                                                        <input type="text" required="required" name="email">--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="comment-form-comment mb-3">--}}
{{--                                                    <label>Comment</label>--}}
{{--                                                    <textarea class="comment-notes" required="required"></textarea>--}}
{{--                                                </div>--}}
{{--                                                <div class="comment-form-submit">--}}
{{--                                                    <button class="btn btn-dark btn-hover-primary">Submit</button>--}}
{{--                                                </div>--}}
{{--                                            </form>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="tab-pane fade" id="connect-3" role="tabpanel" aria-labelledby="contact-tab">--}}
{{--                            <div class="shipping-policy mb-n2">--}}
{{--                                <h4 class="title-3 mb-4">Shipping policy for our store</h4>--}}
{{--                                <p class="desc-content mb-2">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate</p>--}}
{{--                                <ul class="policy-list mb-2">--}}
{{--                                    <li>1-2 business days (Typically by end of day)</li>--}}
{{--                                    <li><a href="#">30 days money back guaranty</a></li>--}}
{{--                                    <li>24/7 live support</li>--}}
{{--                                    <li>odio dignissim qui blandit praesent</li>--}}
{{--                                    <li>luptatum zzril delenit augue duis dolore</li>--}}
{{--                                    <li>te feugait nulla facilisi.</li>--}}
{{--                                </ul>--}}
{{--                                <p class="desc-content mb-2">Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum</p>--}}
{{--                                <p class="desc-content mb-2">claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per</p>--}}
{{--                                <p class="desc-content mb-2">seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in futurum.</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="tab-pane fade" id="connect-4" role="tabpanel" aria-labelledby="review-tab">--}}
{{--                            <div class="size-tab table-responsive-lg">--}}
{{--                                <h4 class="title-3 mb-4">Size Chart</h4>--}}
{{--                                <table class="table border mb-0">--}}
{{--                                    <tbody>--}}
{{--                                        <tr>--}}
{{--                                            <td class="cun-name"><span>UK</span></td>--}}
{{--                                            <td>18</td>--}}
{{--                                            <td>20</td>--}}
{{--                                            <td>22</td>--}}
{{--                                            <td>24</td>--}}
{{--                                            <td>26</td>--}}
{{--                                        </tr>--}}
{{--                                        <tr>--}}
{{--                                            <td class="cun-name"><span>European</span></td>--}}
{{--                                            <td>46</td>--}}
{{--                                            <td>48</td>--}}
{{--                                            <td>50</td>--}}
{{--                                            <td>52</td>--}}
{{--                                            <td>54</td>--}}
{{--                                        </tr>--}}
{{--                                        <tr>--}}
{{--                                            <td class="cun-name"><span>usa</span></td>--}}
{{--                                            <td>14</td>--}}
{{--                                            <td>16</td>--}}
{{--                                            <td>18</td>--}}
{{--                                            <td>20</td>--}}
{{--                                            <td>22</td>--}}
{{--                                        </tr>--}}
{{--                                        <tr>--}}
{{--                                            <td class="cun-name"><span>Australia</span></td>--}}
{{--                                            <td>28</td>--}}
{{--                                            <td>10</td>--}}
{{--                                            <td>12</td>--}}
{{--                                            <td>14</td>--}}
{{--                                            <td>16</td>--}}
{{--                                        </tr>--}}
{{--                                        <tr>--}}
{{--                                            <td class="cun-name"><span>Canada</span></td>--}}
{{--                                            <td>24</td>--}}
{{--                                            <td>18</td>--}}
{{--                                            <td>14</td>--}}
{{--                                            <td>42</td>--}}
{{--                                            <td>36</td>--}}
{{--                                        </tr>--}}
{{--                                    </tbody>--}}
{{--                                </table>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="section-title aos-init aos-animate" data-aos="fade-up" data-aos-delay="300">
                        <h2 class="title pb-3">Você pode gostar também</h2>
                        <span></span>
                        <div class="title-border-bottom"></div>
                    </div>
                </div>
                <div class="col">
                    <div class="product-carousel">
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide product-wrapper">
                                    <div class="product product-border-left" data-aos="fade-up" data-aos-delay="300">
                                        <div class="thumb">
                                            <a href="single-product.html" class="image">
                                                <img class="first-image" src="assets/images/products/medium-size/1.jpg" alt="Product" />
                                                <img class="second-image" src="assets/images/products/medium-size/5.jpg" alt="Product" />
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
                                </div>
                                <div class="swiper-slide product-wrapper">
                                    <div class="product product-border-left" data-aos="fade-up" data-aos-delay="400">
                                        <div class="thumb">
                                            <a href="single-product.html" class="image">
                                                <img class="first-image" src="assets/images/products/medium-size/4.jpg" alt="Product" />
                                                <img class="second-image" src="assets/images/products/medium-size/10.jpg" alt="Product" />
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
                                </div>
                                <div class="swiper-slide product-wrapper">
                                    <div class="product product-border-left" data-aos="fade-up" data-aos-delay="500">
                                        <div class="thumb">
                                            <a href="single-product.html" class="image">
                                                <img class="first-image" src="assets/images/products/medium-size/7.jpg" alt="Product" />
                                                <img class="second-image" src="assets/images/products/medium-size/9.jpg" alt="Product" />
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
                                </div>
                                <div class="swiper-slide product-wrapper">
                                    <div class="product product-border-left" data-aos="fade-up" data-aos-delay="600">
                                        <div class="thumb">
                                            <a href="single-product.html" class="image">
                                                <img class="first-image" src="assets/images/products/medium-size/11.jpg" alt="Product" />
                                                <img class="second-image" src="assets/images/products/medium-size/10.jpg" alt="Product" />
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
                                </div>
                                <div class="swiper-slide product-wrapper">
                                    <div class="product product-border-left" data-aos="fade-up" data-aos-delay="700">
                                        <div class="thumb">
                                            <a href="single-product.html" class="image">
                                                <img class="first-image" src="assets/images/products/medium-size/7.jpg" alt="Product" />
                                                <img class="second-image" src="assets/images/products/medium-size/9.jpg" alt="Product" />
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
                                </div>
                            </div>
                            <div class="swiper-pagination d-md-none"></div>
                            <div class="swiper-product-button-next swiper-button-next swiper-button-white d-md-flex d-none"><i class="pe-7s-angle-right"></i></div>
                            <div class="swiper-product-button-prev swiper-button-prev swiper-button-white d-md-flex d-none"><i class="pe-7s-angle-left"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
