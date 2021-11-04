@extends('site.main')

@section('content')
    <div class="section">
        <div class="breadcrumb-area bg-light">
            <div class="container-fluid">
                <div class="breadcrumb-content text-center">
                    <h1 class="title">Nossos Produtos</h1>
                    <ul>
                        <li>
                            <a href="{{route('home')}}">Home</a>
                        </li>
                        <li class="active">Produtos</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <form method="get" class="products-search-form">
        <div class="section section-margin">
            <div class="container">
                <div class="row flex-row-reverse">
                    <div class="col-lg-9 col-12 col-custom">
                        <div class="shop_toolbar_wrapper flex-column flex-md-row mb-10">
                            <div class="shop-top-bar-left mb-md-0 mb-2">
                                <div class="shop-top-show">
                                    <span>Exibindo {{ $products->firstItem() }}–{{ $products->lastItem() }} de {{ $products->total() }} resultados</span>
                                </div>
                            </div>
                            <div class="shop-top-bar-right">
                                <div class="shop-short-by mr-4">
                                    <select name="order" class="nice-select order-select">
                                        <option selected>Ordenar por: </option>
                                        <option value="recents" @if(request()->input('order') == 'recents') selected @endif>Ord. por recentes</option>
{{--                                        <option value="higher_price">Ord. por Maior Preço</option>--}}
{{--                                        <option value="lowest_price">Ord. por Menor Preço</option>--}}
                                    </select>
                                </div>
                                <div class="shop_toolbar_btn">
                                    <button data-role="grid_3" type="button" class="active btn-grid-4" title="Grid"><i class="fa fa-th"></i></button>
                                    <button data-role="grid_list" type="button" class="btn-list" title="List"><i class="fa fa-th-list"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="row shop_wrapper grid_3">
                            @forelse ($products as $product)
                                @php $variation = $product->availableVariation(); @endphp
                                <div class="col-lg-4 col-md-4 col-sm-6 product" data-aos="fade-up" data-aos-delay="200">
                                    <div class="product-inner">
                                        <div class="thumb">
                                            <a href="{{ route('product.show', [$product->slug]) }}" class="image">
                                                <img class="first-image" src="{{getFullUrl($product->mainImage->file)}}" alt="{{ $product->name }}" />
                                                <img class="second-image" src="{{getFullUrl($product->mainImage->file)}}" alt="{{ $product->name }}" />
                                            </a>
                                        </div>
                                        <div class="content">
                                            <h4 class="sub-title"><a href="{{ route('product.show', [$product->slug]) }}">{{ $product->name }}</a></h4>
                                            <h5 class="title"><a href="{{ route('product.show', [$product->slug]) }}">{{ $product->name }}</a></h5>
                                            <span class="price">
                                                <span class="new">{{ $variation->final_price_formated }}</span>
                                                <span class="old">{{ $variation->final_price_formated }}</span>
                                            </span>
                                            <div class="shop-list-btn">
                                                <a href="{{ route('product.show', [$product->slug]) }}" class="btn btn-sm btn-outline-dark btn-hover-primary">Ver mais</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p>Nenhum produto encontrado</p>
                            @endforelse
                        </div>

                        @if ($products->links()->toHtml())
                            <div class="shop_toolbar_wrapper mt-10">
                                <div class="shop-top-bar-left">
                                    &nbsp;
                                </div>
                                <div class="shop-top-bar-right">
                                    <nav>
                                        <ul class="pagination">
                                            {{ $products->links() }}
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="col-lg-3 col-12 col-custom">
                        <aside class="sidebar_widget mt-10 mt-lg-0">
                            <div class="widget_inner" data-aos="fade-up" data-aos-delay="200">
                                <div class="widget-list mb-10">
                                    <h3 class="widget-title mb-4">Pesquisar</h3>
                                    <div class="search-box">
                                        <input name="search_term" value="{{ request()->input('search_term') }}" type="text" class="form-control" placeholder="Pesquisar em nossa loja" aria-label="Pesquisar em nossa loja">
                                        <button class="btn btn-dark btn-hover-primary" type="submit">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="widget-list mb-10">
                                    <h3 class="widget-title mb-4">Categorias</h3>
                                    <nav>
                                        <ul class="category-menu mb-n3">
                                            @forelse ($categoriesWithProduct as $category)
                                                @php $subcategories = $category->subcategories; @endphp
                                                <li class="menu-item-has-children pb-4">
                                                    <a href="#">{{ $category->name }} <i class="fa fa-angle-down"></i></a>

                                                    @if (count($subcategories) > 0)
                                                        <ul class="dropdown">
                                                            @foreach ($subcategories as $subcategory)
                                                                <li>
                                                                    <a href="{{ route('products', $category->slug) }}">{{ $subcategory->name }}</a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </li>
                                            @empty
                                                <p>Nenhuma categoria encontrada</p>
                                            @endforelse
                                        </ul>
                                    </nav>
                                </div>
                                <div class="widget-list mb-10">
                                    <h3 class="widget-title mb-5">Filtrar por preço</h3>
                                    <div class="row">
                                        <div class="col-lg-6 pr-1">
                                            <input class="slider-range-amount" name="start_value" type="number" id="start-value" placeholder="mínimo" value="{{ request()->input('start_value') }}" style="width: 100% !important;"/>
                                        </div>
                                        <div class="col-lg-6 pl-1">
                                            <input class="slider-range-amount" type="number" name="end_value" id="end-value" placeholder="máximo" value="{{ request()->input('end_value') }}" style="width: 100% !important;"/>
                                        </div>
                                    </div>
                                    <br/>
                                    <button class="slider-range-submit" type="submit">Filtrar</button>
                                </div>
                                <div class="widget-list">
                                    <h3 class="widget-title mb-4">Produtos Recentes</h3>
                                    <div class="sidebar-body product-list-wrapper mb-n6">
                                        <div class="single-product-list product-hover mb-6">
                                            <div class="thumb">
                                                <a href="single-product.html" class="image">
                                                    <img class="first-image" src="{{asset('useLadame/images/products/small-product/1.jpg')}}" alt="{{ $product->name }}" />
                                                    <img class="second-image" src="{{asset('useLadame/images/products/small-product/5.jpg')}}" alt="{{ $product->name }}" />
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
                                        <div class="single-product-list product-hover mb-6">
                                            <div class="thumb">
                                                <a href="single-product.html" class="image">
                                                    <img class="first-image" src="{{asset('useLadame/images/products/small-product/2.jpg')}}" alt="{{ $product->name }}" />
                                                    <img class="second-image" src="{{asset('useLadame/images/products/small-product/3.jpg')}}" alt="{{ $product->name }}" />
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
                                        <div class="single-product-list product-hover mb-6">
                                            <div class="thumb">
                                                <a href="single-product.html" class="image">
                                                    <img class="first-image" src="{{asset('useLadame/images/products/small-product/4.jpg')}}" alt="{{ $product->name }}" />
                                                    <img class="second-image" src="{{asset('useLadame/images/products/small-product/10.jpg')}}" alt="{{ $product->name }}" />
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
                                </div>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('js')
    <script>
        $('.order-select').change(() => {
            $('.products-search-form').submit();
        });

        $(document).ready(() => {
            // TODO finalizar script
            {{--$('.order-select option[value=' + {{ request()->input('order') }} + ']').attr('selected', 'selected');--}}
            // $(`.order-select`).val(optionToSelect).attr('selected', 'selected');
        });
    </script>
@endpush


