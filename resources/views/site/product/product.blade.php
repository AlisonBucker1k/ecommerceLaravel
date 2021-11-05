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
                        <div class="single-product-img swiper-container gallery-top">
                            <div class="swiper-wrapper popup-gallery">
                                <a class="swiper-slide w-100" href="{{asset('useLadame/images/products/medium-size/5.jpg')}}">
                                    <img class="w-100" src="{{asset('useLadame/images/products/medium-size/5.jpg')}}" alt="{{ $product->name }}">
                                </a>
                                <a class="swiper-slide w-100" href="{{asset('useLadame/images/products/medium-size/5.jpg')}}">
                                    <img class="w-100" src="{{asset('useLadame/images/products/medium-size/5.jpg')}}" alt="{{ $product->name }}">
                                </a>
                                <a class="swiper-slide w-100" href="{{asset('useLadame/images/products/medium-size/5.jpg')}}">
                                    <img class="w-100" src="{{asset('useLadame/images/products/medium-size/5.jpg')}}" alt="{{ $product->name }}">
                                </a>
                                <a class="swiper-slide w-100" href="{{asset('useLadame/images/products/medium-size/5.jpg')}}">
                                    <img class="w-100" src="{{asset('useLadame/images/products/medium-size/5.jpg')}}" alt="{{ $product->name }}">
                                </a>
                                <a class="swiper-slide w-100" href="{{asset('useLadame/images/products/medium-size/5.jpg')}}">
                                    <img class="w-100" src="{{asset('useLadame/images/products/medium-size/5.jpg')}}" alt="{{ $product->name }}">
                                </a>
                                <a class="swiper-slide w-100" href="{{asset('useLadame/images/products/medium-size/5.jpg')}}">
                                    <img class="w-100" src="{{asset('useLadame/images/products/medium-size/5.jpg')}}" alt="{{ $product->name }}">
                                </a>
                            </div>
                        </div>
                        <div class="single-product-thumb swiper-container gallery-thumbs">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <img src="{{asset('useLadame/images/products/medium-size/5.jpg')}}" alt="{{ $product->name }}">
                                </div>
                                <div class="swiper-slide">
                                    <img src="{{asset('useLadame/images/products/medium-size/5.jpg')}}" alt="{{ $product->name }}">
                                </div>
                                <div class="swiper-slide">
                                    <img src="{{asset('useLadame/images/products/medium-size/5.jpg')}}" alt="{{ $product->name }}">
                                </div>
                                <div class="swiper-slide">
                                    <img src="{{asset('useLadame/images/products/medium-size/5.jpg')}}" alt="{{ $product->name }}">
                                </div>
                                <div class="swiper-slide">
                                    <img src="{{asset('useLadame/images/products/medium-size/5.jpg')}}" alt="{{ $product->name }}">
                                </div>
                                <div class="swiper-slide">
                                    <img src="{{asset('useLadame/images/products/medium-size/5.jpg')}}" alt="{{ $product->name }}">
                                </div>
                            </div>
                            <div class="swiper-button-next swiper-button-white"><i class="pe-7s-angle-right"></i></div>
                            <div class="swiper-button-prev swiper-button-white"><i class="pe-7s-angle-left"></i></div>
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
                        <span class="ratings justify-content-start">
                            <span class="rating-wrap">
                                <span class="star" style="width: 100%"></span>
                            </span>
                            <span class="rating-num"></span>
                        </span>
                        <p class="desc-content mb-5">@php echo $product->description @endphp</p>

                        @if ($total_stock <= 0)
                            <div class="alert alert-warning">
                                Produto indisponível no momento.
                            </div>
                        @else
                            <div id="loadingValue" class="d-none">
                                <span class="fa fa-spin fa-spinner"></span>
                            </div>
                            <div id="currentValue" class="d-none">
                                <strong class="main-value is-promotion" id="promotionValue">
                                    <span class="value"></span>
                                </strong>
                                <div id="totalValue">
                                    <strike class="text-1 promotion">
                                        <span class="value"></span>
                                    </strike>
                                    <strong class="main-value no-promotion mb-4">
                                        <span class="value"></span>
                                    </strong>
                                </div>
                                <p class="is-promotion" id="discountDescription">
                                    Economia de <span class="value"></span>
                                </p>
                            </div>
                            <form method="post" action="/carrinho/{{ $product->slug }}/add" id="addCartForm" class="form-bg">
                                @csrf
                                <input type="hidden" name="variation_id" id="variationId" value="{{ $product->mainVariation->id }}">
                                <div class="row">
                                    @foreach ($grids as $grid)
                                        <div class="cart-wishlist-btn mb-4">
                                            <div class="col-md-5 mb-3 col-12">
                                                <div class="form-group">
                                                    <label class="control-label font-weight-bold">{{ $grid->description }}</label>
                                                    <select class="form-control select-variation" id="variation{{ $grid->id }}" data-id="{{ $grid->id }}" name="variation[{{ $grid->id }}]" required="required">
                                                        @foreach ($grid->variations as $variation)
                                                            <option value="{{ $variation->id }}" @if (isset($product->variation->items[$grid->grid_id]->grid_variation_id) && $product->variation->items[$grid->grid_id]->grid_variation_id == $variation->id) selected="selected" @endif>{{ $variation->description }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    
                                    <div class="quantity mb-5">
                                        <div class="cart-plus-minus">
                                            <input class="cart-plus-minus-box quantity-input" value="1"  name="quantity" type="text" min="1" max="{{ $total_stock }}">
                                            <a href="#" class="dec qtybutton decrease-quantity">
                                                <i class="fa fa-minus"></i>
                                            </a>
                                            <a href="#" class="inc qtybutton increase-quantity">
                                                <i class="fa fa-plus"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="cart-wishlist-btn mb-4">
                                        <div class="add-to_cart">
                                            <button class="btn btn-outline-dark btn-hover-primary" id="btnBuy">Adicionar ao carrinho</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        @endif

                        <div class="product-meta mb-5">
                            <div class="product-metarial">
                                @if (!empty($product->category))
                                    <span>Categoria:</span>
                                    <strong>
                                        <a rel="tag" href="{{ route('products', $product->category->slug) }}">
                                            {{ $product->category->name }}
                                        </a>
                                    </strong>
                                @endif

                                @if (!empty($product->subcategory))
                                    <br>
                                    <span>Subcategoria:</span>
                                    <strong>
                                        <a rel="tag" href="{{ route('products', [$product->category->slug, $product->subcategory->slug]) }}">
                                            {{ $product->subcategory->name }}</a>
                                    </strong>
                                @endif
                            </div>
                        </div>
                        <ul class="product-delivery-policy border-top pt-4 mt-4 border-bottom pb-4">
                            <li><i class="fa fa-check-square"></i> <span><strong>Compra 100% segura.</strong> (Você está em um ambiente seguro.)</span></li>
                            <li><i class="fa fa-truck"></i><span><strong>Entrega garantida.</strong> (Gartantimos a entrega do seu produto, ou seu dinheiro de volta.)</span></li>
                            <li><i class="fa fa-refresh"></i><span><strong>Políticas de devolução</strong> (Devolva ou troque seus produtos de acordo com nossas políticas.)</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row section-margin">
                <div class="col-lg-12 col-custom single-product-tab">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active text-uppercase" id="home-tab" data-bs-toggle="tab" href="#connect-1" role="tab" aria-selected="true">Description</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-uppercase" id="contact-tab" data-bs-toggle="tab" href="#connect-3" role="tab" aria-selected="false">Políticas de entrega</a>
                        </li>
                    </ul>
                    <div class="tab-content mb-text" id="myTabContent">
                        <div class="tab-pane fade show active" id="connect-1" role="tabpanel" aria-labelledby="home-tab">
                            <div class="desc-content border p-3">
                                <p class="mb-3">@php echo $product->description @endphp</p>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="connect-2" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="product_tab_content  border p-3">
                                <div class="single-review d-flex mb-4">
                                    <div class="review_thumb">
                                        <img alt="review images" src="assets/images/review/1.jpg">
                                    </div>
                                    <div class="review_details">
                                        <div class="review_info mb-2">
                                            <span class="ratings justify-content-start mb-3">
                                                <span class="rating-wrap">
                                                    <span class="star" style="width: 100%"></span>
                                                </span>
                                                <span class="rating-num">(1)</span>
                                            </span>
                                            <div class="review-title-date d-flex">
                                                <h5 class="title">Admin - </h5><span> January 19, 2021</span>
                                            </div>
                                        </div>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin in viverra ex, vitae vestibulum arcu. Duis sollicitudin metus sed lorem commodo, eu dapibus libero interdum. Morbi convallis viverra erat, et aliquet orci congue vel. Integer in odio enim. Pellentesque in dignissim leo. Vivamus varius ex sit amet quam tincidunt iaculis.</p>
                                    </div>
                                </div>
                                <div class="rating_wrap">
                                    <h5 class="rating-title mb-2">Add a review </h5>
                                    <p class="mb-2">Your email address will not be published. Required fields are marked *</p>
                                    <h6 class="rating-sub-title mb-2">Your Rating</h6>
                                    <span class="ratings justify-content-start mb-3">
                                        <span class="rating-wrap">
                                            <span class="star" style="width: 100%"></span>
                                        </span>
                                        <span class="rating-num">(2)</span>
                                    </span>
                                </div>
                                <div class="comments-area comments-reply-area">
                                    <div class="row">
                                        <div class="col-lg-12 col-custom">
                                            <form action="#" class="comment-form-area">
                                                <div class="row comment-input">
                                                    <div class="col-md-6 col-custom comment-form-author mb-3">
                                                        <label>Name <span class="required">*</span></label>
                                                        <input type="text" required="required" name="Name">
                                                    </div>
                                                    <div class="col-md-6 col-custom comment-form-emai mb-3">
                                                        <label>Email <span class="required">*</span></label>
                                                        <input type="text" required="required" name="email">
                                                    </div>
                                                </div>
                                                <div class="comment-form-comment mb-3">
                                                    <label>Comment</label>
                                                    <textarea class="comment-notes" required="required"></textarea>
                                                </div>
                                                <div class="comment-form-submit">
                                                    <button class="btn btn-dark btn-hover-primary">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="connect-3" role="tabpanel" aria-labelledby="contact-tab">
                            <div class="shipping-policy mb-n2">
                                <h4 class="title-3 mb-4">Políticas de entrega</h4>
                                <p class="desc-content mb-2">Logo após que recebermos o seu pagamento, o seu pedido entrará no processo de separação. E será enviado em até dois dias úteis</p>
                                <p cçass="desc-content mb-2">
                                    O prazo e o valor da entrega varia de acordo com a sua localização. Você pode obter uma estimativa informando o seu cep na tela de finalizar compras.
                                </p>
                            </div>
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
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        let inputQuantity = document.querySelector('.quantity-input');
        inputQuantity.addEventListener('blur', async event => {
            event.preventDefault();
            if (inputQuantity.value <= 0) {
                inputQuantity.value = 1;
            }
        });
        let btnDecreaseQuantity = document.querySelector('.decrease-quantity');
        btnDecreaseQuantity.addEventListener('click', async event => {
            event.preventDefault();
            if (inputQuantity.value == 0) {
                return false;
            }
            inputQuantity.value--;
        });
        let btnIncreaseQuantity = document.querySelector('.increase-quantity');
        btnIncreaseQuantity.addEventListener('click', async event => {
            event.preventDefault();
            inputQuantity.value++;
        });
    </script>

    @if($product->has_grid_variation)
        <script type="text/javascript">    
            $(function(){
                function changeVariation(id, value) {
                    $('.select-variation').attr('readonly', 'readonly');
                    $('#currentValue').addClass('d-none');
                    $('#loadingValue').removeClass('d-none');
                    $.ajax({
                        url: '{{ route('product.variations', [$product->slug]) }}',
                        dataType: 'json',
                        data: {
                            product_grid_id: id,
                            variation_id: value
                        },
                        success: function(data) {
                            $('#variationImage').html('');
                            $('.select-variation').removeAttr('readonly');
                            $('.select-variation').each(function(){
                                let gridObj = $(this);
                                let variationValue = gridObj.val();
                                let productGridId = gridObj.attr('data-id');
                                var selected = false;
                                gridObj.val('');
                                $(this).children('option').each(function(){
                                    let variationObj = $(this);
                                    let variationId = variationObj.attr('value');
                                    let grids = data.grids;
                                    variationObj.attr('disabled', 'disabled');
                                    if (grids != undefined && productGridId in grids) {
                                        let variations = data.grids[productGridId].variations;
                                        $.each(variations, function(index, value) {
                                            if (id == productGridId || variationId == '' || index == variationId) {
                                                variationObj.removeAttr('disabled');
                                                if (variationId != '' && (variationValue == variationId || selected === false)) {
                                                    selected = true;
                                                    gridObj.val(variationId);
                                                }
                                            }
                                        });
                                    }
                                });
                            });
                            findVariation();
                        }
                    });
                }
                function findVariation() {
                    console.log($('.select-variation').serialize());
                    $.ajax({
                        url: '{{ route('product.variations.find', [$product->slug]) }}',
                        dataType: 'json',
                        data: $('.select-variation').serialize(),
                        success: function(data) {
                            $('#variationImage').html('');
                            $('#loadingValue').addClass('d-none');
                            if (data.variation != null) {
                                let variation = data.variation;
                                $('#variationId').val(variation.id);
                                $('.is-promotion').addClass('d-none');
                                $('#currentValue #totalValue .value').text(variation.value);
                                $('#currentValue #totalValue .promotion').addClass('d-none');
                                $('#currentValue #totalValue .no-promotion').removeClass('d-none');
                                
                                if (variation.promotion_value != null) {
                                    $('#currentValue #totalValue .promotion').removeClass('d-none');
                                    $('#currentValue #totalValue .no-promotion').addClass('d-none');
                                    $('.is-promotion').removeClass('d-none');
                                    $('#currentValue #promotionValue .value').text(variation.promotion_value);
                                    $('#currentValue #discountDescription .value').text(variation.diff_value);
                                }
                                $('#loadingValue').addClass('d-none');
                                $('#currentValue').removeClass('d-none');
                            }
                        }
                    });
                }
                function isComplete() {
                    $('.select-variation').each(function(){
                        if ($(this).val() == '') {
                            return false;
                        }
                    });
                    return true;
                }
                $('#addCartForm').submit(function(){
                    if (isComplete() === false) {
                        alert('Informe todas as variações que deseja no produto');
                    }
                });
                let value = $('.select-variation').eq(0).val();
                let id = $('.select-variation').eq(0).attr('data-id');
                changeVariation(id, value);
                $('.select-variation').change(function() {
                    let self = $(this);
                    let id = self.attr('data-id');
                    let value = self.val();
                    changeVariation(id, value);
                });
            });
        </script>
    @endif
@endpush