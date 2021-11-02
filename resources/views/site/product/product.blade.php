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
<!-- Shop Section Start -->
<div class="section section-margin">
    <div class="container">

        <div class="row">
            <div class="col-lg-5 offset-lg-0 col-md-8 offset-md-2 col-custom">

                <!-- Product Details Image Start -->
                <div class="product-details-img">

                    <!-- Single Product Image Start -->
                    <div class="single-product-img swiper-container gallery-top">
                        <div class="swiper-wrapper popup-gallery">

                            @if (count($product->images) > 0)
                                @foreach ($product->images as $image)
                                <a class="swiper-slide w-100" href="{{getFullUrl($image->file)}}">
                                    <img class="w-100" src="{{getFullUrl($image->file)}}" alt="{{ $product->name }}">
                                </a>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <!-- Single Product Image End -->

                    <!-- Single Product Thumb Start -->
                    <div class="single-product-thumb swiper-container gallery-thumbs">
                        <div class="swiper-wrapper">

                            @if (count($product->images) > 0)
                                @foreach ($product->images as $image)
                                <div class="swiper-slide">
                                    <img src="{{getFullUrl($image->file)}}" alt="{{ $product->name }}">
                                </div>
                                @endforeach
                            @endif
                        </div>

                        <!-- Next Previous Button Start -->
                        <div class="swiper-button-next swiper-button-white"><i class="pe-7s-angle-right"></i></div>
                        <div class="swiper-button-prev swiper-button-white"><i class="pe-7s-angle-left"></i></div>
                        <!-- Next Previous Button End -->

                    </div>
                    <!-- Single Product Thumb End -->

                </div>
                <!-- Product Details Image End -->

            </div>
            <div class="col-lg-7 col-custom">

                <!-- Product Summery Start -->
                <div class="product-summery position-relative">

                    <!-- Product Head Start -->
                    <div class="product-head mb-3">
                        <h2 class="product-title">{{ $product->name }}</h2>
                    </div>
                    <!-- Product Head End -->

                    <!-- Price Box Start -->
                    <div class="price-box mb-2">
                        <span class="regular-price">{{ $product->mainVariation->promotion_value_formated }}</span>
                        <span class="old-price"><del>{{ $product->mainVariation->value_formated }}</del></span>
                    </div>
                    <!-- Price Box End -->

                    <!-- Rating Start -->
                    <span class="ratings justify-content-start">
                            <span class="rating-wrap">
                                <span class="star" style="width: 100%"></span>
                    </span>
                    <span class="rating-num"></span>
                    </span>
                    <!-- Rating End -->

                    <!-- SKU Start -->
                    <div class="sku mb-3">
                        {{-- <span>Ref: 12345</span> --}}
                    </div>
                    <!-- SKU End -->

                    <!-- Description Start -->
                    <p class="desc-content mb-5">{!! $product->description !!}</p>
                    <!-- Description End -->

                    @if ($total_stock <= 0)
                        <div class="alert alert-warning">
                            Produto indisponível no momento.
                        </div>
                    @else
                        @if ($product->has_grid_variation !== 0)
                            <div id="valueDefault">
                                @if ($product->mainVariation->promotion_value > 0)
                                    <strong class="main-value">
                                        <small></small> {{ $product->mainVariation->promotion_value_formated }}
                                    </strong>
                                    <strike class="text-1">
                                        <small></small> {{ $product->mainVariation->value_formated }}
                                    </strike>
                                    <p>
                                        Economia de R$ {{ $product->mainVariation->value_saving_formated }}
                                    </p>
                                @else
                                    <strong class="main-value mb-4">
                                        <small></small> {{ $product->mainVariation->value_formated }}
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
                                    <div class="cart-wishlist-btn mb-4">
                                        <div class="col-md-5 mb-3">
                                            <div class="form-group">
                                                <label class="control-label font-weight-bold">{{ $grid->description }}</label>
                                                <select class="form-control" id="variation{{ $grid->id }}" data-id="{{ $grid->id }}" name="variation[{{ $grid->id }}]" required="required">
                                                    @foreach ($grid->variations as $variation)
                                                        <option value="{{ $variation->id }}" @if ($product->variation->items[$grid->grid_id]->grid_variation_id == $variation->id) selected="selected"@endif>{{ $variation->description }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <!-- Quantity Start -->
                                <div class="quantity mb-5">
                                    <div class="cart-plus-minus">
                                        <input class="cart-plus-minus-box" value="1"  name="qt" type="text" min="1" max="{{ $total_stock }}">
                                        <div class="dec qtybutton">-</div>
                                        <div class="inc qtybutton">+</div>
                                    </div>
                                </div>
                                <!-- Quantity End -->
                                {{-- <button type="submit" id="btnBuy" class="btn btn-primary btn-block">
                                    COMPRAR
                                </button> --}}
                                <!-- Cart & Wishlist Button Start -->
                                <div class="cart-wishlist-btn mb-4">
                                    <div class="add-to_cart">
                                        {{-- <a class="btn btn-outline-dark btn-hover-primary" href="cart.html">Adicionar ao carrinho</a> --}}
                                        <button class="btn btn-outline-dark btn-hover-primary" id="btnBuy">Adicionar ao carrinho</button>
                                    </div>
                                    {{-- <div class="add-to-wishlist">
                                        <a class="btn btn-outline-dark btn-hover-primary" href="wishlist.html">Adicionar a lista de desejos</a>
                                    </div> --}}
                                </div>
                                <!-- Cart & Wishlist Button End -->
                            </div>
                        </form>
                    @endif

                    <!-- Product Meta Start -->
                    <div class="product-meta mb-3">
                        <!-- Product Size Start --
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

                    <!-- Product Color Variation Start --
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
                            @if (!empty($product->category))
                                <span>Categoria :</span>
                                <strong><a rel="tag" href="{{ route('products', $product->category->slug) }}">{{ $product->category->name }}</a></strong>
                            @endif
                            @if (!empty($product->subcategory))
                                 <strong><a rel="tag" href="{{ route('products', [$product->category->slug, $product->subcategory->slug]) }}">{{ $product->subcategory->name }}</a>.</strong>
                            @endif
                        </div>
                        <!-- Product Metarial End -->
                    </div>
                    <!-- Product Meta End -->

                    <!-- Social Shear Start -->
                    <div class="social-share">
                        {{-- <span>Share :</span>
                        <a href="#"><i class="fa fa-facebook-square facebook-color"></i></a>
                        <a href="#"><i class="fa fa-twitter-square twitter-color"></i></a>
                        <a href="#"><i class="fa fa-linkedin-square linkedin-color"></i></a>
                        <a href="#"><i class="fa fa-pinterest-square pinterest-color"></i></a> --}}
                    </div>
                    <!-- Social Shear End -->

                    <!-- Product Delivery Policy Start -->
                    <ul class="product-delivery-policy border-top pt-4 mt-4 border-bottom pb-4">
                        <li> <i class="fa fa-check-square"></i> <span><strong>Compra 100% segura.</strong> (Você está em um ambiente seguro.)</span></li>
                        <li><i class="fa fa-truck"></i><span><strong>Entrega garantida.</strong> (Gartantimos a entrega do seu produto, ou seu dinheiro de volta.)</span></li>
                        <li><i class="fa fa-refresh"></i><span><strong>Políticas de devolução</strong> (Devolva ou troque seus produtos de acordo com nossas políticas.)</span></li>
                    </ul>
                    <!-- Product Delivery Policy End -->

                </div>
                <!-- Product Summery End -->

            </div>
        </div>

        <div class="row section-margin">
            <!-- Single Product Tab Start -->
            <div class="col-lg-12 col-custom single-product-tab">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active text-uppercase" id="home-tab" data-bs-toggle="tab" href="#connect-1" role="tab" aria-selected="true">Descrição</a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link text-uppercase" id="profile-tab" data-bs-toggle="tab" href="#connect-2" role="tab" aria-selected="false">Reviews</a>
                    </li> --}}
                    <li class="nav-item">
                        <a class="nav-link text-uppercase" id="contact-tab" data-bs-toggle="tab" href="#connect-3" role="tab" aria-selected="false">Políticas de entrega</a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link text-uppercase" id="review-tab" data-bs-toggle="tab" href="#connect-4" role="tab" aria-selected="false">Size Chart</a>
                    </li> --}}
                </ul>
                <div class="tab-content mb-text" id="myTabContent">
                    <div class="tab-pane fade show active" id="connect-1" role="tabpanel" aria-labelledby="home-tab">
                        <div class="desc-content border p-3">
                            <p class="mb-3">{!! $product->description !!}</p>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="connect-2" role="tabpanel" aria-labelledby="profile-tab">
                        <!-- Start Single Content -->
                        <div class="product_tab_content  border p-3">
                            <!-- Start Single Review -->
                            <div class="single-review d-flex mb-4">

                                <!-- Review Thumb Start -->
                                <div class="review_thumb">
                                    <img alt="review images" src="assets/images/review/1.jpg">
                                </div>
                                <!-- Review Thumb End -->

                                <!-- Review Details Start -->
                                <div class="review_details">
                                    <div class="review_info mb-2">

                                        <!-- Rating Start -->
                                        <span class="ratings justify-content-start mb-3">
                                                <span class="rating-wrap">
                                                    <span class="star" style="width: 100%"></span>
                                        </span>
                                        <span class="rating-num">(1)</span>
                                        </span>
                                        <!-- Rating End -->

                                        <!-- Review Title & Date Start -->
                                        <div class="review-title-date d-flex">
                                            <h5 class="title">Admin - </h5><span> January 19, 2021</span>
                                        </div>
                                        <!-- Review Title & Date End -->

                                    </div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin in viverra ex, vitae vestibulum arcu. Duis sollicitudin metus sed lorem commodo, eu dapibus libero interdum. Morbi convallis viverra erat, et aliquet orci congue vel. Integer in odio enim. Pellentesque in dignissim leo. Vivamus varius ex sit amet quam tincidunt iaculis.</p>
                                </div>
                                <!-- Review Details End -->

                            </div>
                            <!-- End Single Review -->

                            <!-- Rating Wrap Start -->
                            <div class="rating_wrap">
                                <h5 class="rating-title mb-2">Add a review </h5>
                                <p class="mb-2">Your email address will not be published. Required fields are marked *</p>
                                <h6 class="rating-sub-title mb-2">Your Rating</h6>

                                <!-- Rating Start -->
                                <span class="ratings justify-content-start mb-3">
                                        <span class="rating-wrap">
                                            <span class="star" style="width: 100%"></span>
                                </span>
                                <span class="rating-num">(2)</span>
                                </span>
                                <!-- Rating End -->

                            </div>
                            <!-- Rating Wrap End -->

                            <!-- Comments ans Replay Start -->
                            <div class="comments-area comments-reply-area">
                                <div class="row">
                                    <div class="col-lg-12 col-custom">

                                        <!-- Comment form Start -->
                                        <form action="#" class="comment-form-area">
                                            <div class="row comment-input">

                                                <!-- Input Name Start -->
                                                <div class="col-md-6 col-custom comment-form-author mb-3">
                                                    <label>Name <span class="required">*</span></label>
                                                    <input type="text" required="required" name="Name">
                                                </div>
                                                <!-- Input Name End -->

                                                <!-- Input Email Start -->
                                                <div class="col-md-6 col-custom comment-form-emai mb-3">
                                                    <label>Email <span class="required">*</span></label>
                                                    <input type="text" required="required" name="email">
                                                </div>
                                                <!-- Input Email End -->

                                            </div>
                                            <!-- Comment Texarea Start -->
                                            <div class="comment-form-comment mb-3">
                                                <label>Comment</label>
                                                <textarea class="comment-notes" required="required"></textarea>
                                            </div>
                                            <!-- Comment Texarea End -->

                                            <!-- Comment Submit Button Start -->
                                            <div class="comment-form-submit">
                                                <button class="btn btn-dark btn-hover-primary">Submit</button>
                                            </div>
                                            <!-- Comment Submit Button End -->

                                        </form>
                                        <!-- Comment form End -->

                                    </div>
                                </div>
                            </div>
                            <!-- Comments ans Replay End -->

                        </div>
                        <!-- End Single Content -->
                    </div>
                    <div class="tab-pane fade" id="connect-3" role="tabpanel" aria-labelledby="contact-tab">
                        <!-- Shipping Policy Start -->
                        <div class="shipping-policy mb-n2">
                            <h4 class="title-3 mb-4">Políticas de entrega</h4>
                            <p class="desc-content mb-2">Logo após que recebermos o seu pagamento, o seu pedido entrará no processo de separação. E será enviado em até dois dias úteis</p>
                            <p cçass="desc-content mb-2">
                                O prazo e o valor da entrega varia de acordo com a sua localização. Você pode obter uma estimativa informando o seu cep na tela de finalizar compras.
                            </p>
                        </div>
                        <!-- Shipping Policy End -->
                    </div>
                    <div class="tab-pane fade" id="connect-4" role="tabpanel" aria-labelledby="review-tab">
                        <div class="size-tab table-responsive-lg">
                            <h4 class="title-3 mb-4">Size Chart</h4>
                            <table class="table border mb-0">
                                <tbody>
                                    <tr>
                                        <td class="cun-name"><span>UK</span></td>
                                        <td>18</td>
                                        <td>20</td>
                                        <td>22</td>
                                        <td>24</td>
                                        <td>26</td>
                                    </tr>
                                    <tr>
                                        <td class="cun-name"><span>European</span></td>
                                        <td>46</td>
                                        <td>48</td>
                                        <td>50</td>
                                        <td>52</td>
                                        <td>54</td>
                                    </tr>
                                    <tr>
                                        <td class="cun-name"><span>usa</span></td>
                                        <td>14</td>
                                        <td>16</td>
                                        <td>18</td>
                                        <td>20</td>
                                        <td>22</td>
                                    </tr>
                                    <tr>
                                        <td class="cun-name"><span>Australia</span></td>
                                        <td>28</td>
                                        <td>10</td>
                                        <td>12</td>
                                        <td>14</td>
                                        <td>16</td>
                                    </tr>
                                    <tr>
                                        <td class="cun-name"><span>Canada</span></td>
                                        <td>24</td>
                                        <td>18</td>
                                        <td>14</td>
                                        <td>42</td>
                                        <td>36</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Single Product Tab End -->
        </div>

        {{-- TODO: GABRIEL 001. Caso for resolver essa listagem de produtos.. criei um arquivo com o html dessa area.. basta copiar e colar abaixo dessa linha e integrar com backend --}}

    </div>
</div>
<!-- Shop Section End -->
@endsection
