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
    <div class="section section-margin">
        <div class="container">
            <div class="row flex-row-reverse">
                <div class="col-lg-9 col-12 col-custom">
                    <div class="shop_toolbar_wrapper flex-column flex-md-row mb-10">
                        <div class="shop-top-bar-left mb-md-0 mb-2">
                            <div class="shop-top-show">
                                <span>Exibindo 1–12 de {{ $products->count() }} resultados</span>
                            </div>
                        </div>
                        <div class="shop-top-bar-right">
                            {{-- <div class="shop-short-by mr-4">
                                <select class="nice-select" aria-label=".form-select-sm example">
                                    <option selected>Exibir 24</option>
                                    <option value="2">Exibir 12</option>
                                    <option value="3">Exibir 15</option>
                                    <option value="4">Exibir 30</option>
                                </select>
                            </div> --}}
                            <div class="shop-short-by mr-4">
                                <select class="nice-select" aria-label=".form-select-sm example">
                                    <option selected>Ordenar por: </option>
                                    <option value="1">Ord. por recentes</option>
                                    <option value="2">Ord. por Maior Preço</option>
                                    <option value="3">Ord. por Menor Preço</option>
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
                            <!-- Single Product Start -->
                            @php $variation = $product->availableVariation(); @endphp
                            <div class="col-lg-4 col-md-4 col-sm-6 product" data-aos="fade-up" data-aos-delay="200">
                                <form action="{{ route('cart.product.add', $product->slug) }}" method="post">
                                    <div class="product-inner">
                                        <div class="thumb">
                                            <a href="{{ route('product.show', [$product->slug]) }}" class="image">
                                                <img class="first-image" src="{{asset('useLadame/images/products/medium-size/2.jpg')}}" alt="Product" />
                                                <img class="second-image" src="{{asset('useLadame/images/products/medium-size/2.jpg')}}" alt="Product" />
                                            </a>
                                            {{-- <div class="actions">
                                                <a href="wishlist.html" title="Wishlist" class="action wishlist"><i class="pe-7s-like"></i></a>
                                                <a href="#" title="Quickview" class="action quickview" data-bs-toggle="modal" data-bs-target="#exampleModalCenter"><i class="pe-7s-search"></i></a>
                                                <a href="compare.html" title="Compare" class="action compare"><i class="pe-7s-shuffle"></i></a>
                                            </div> --}}
                                        </div>
                                        <div class="content">
                                            <h4 class="sub-title"><a href="single-product.html"><a href="{{ route('product.show', [$product->slug]) }}">{{ $product->name }}</a></a></h4>
                                            <h5 class="title"><a href="{{ route('product.show', [$product->slug]) }}">{{ $product->name }}</a></h5>
                                        
                                            <span class="price">
                                                <span class="new">{{ $variation->final_price_formated }}</span>
                                                <span class="old">{{ $variation->final_price_formated }}</span>
                                            </span>
                                            <div class="shop-list-btn">
                                                <a title="Wishlist" href="#" class="btn btn-sm btn-outline-dark btn-hover-primary wishlist"><i class="fa fa-heart"></i></a>
                                                <button class="btn btn-sm btn-outline-dark btn-hover-primary" type="submit" title="Detalhes">Ver mais</button>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- Single Product End -->
                        @empty
                            <p>Nenhum produto encontrado</p>
                        @endforelse 

                    </div>
                    <div class="shop_toolbar_wrapper mt-10">
                        <div class="shop-top-bar-left">
                            <div class="shop-short-by mr-4">
                                <select class="nice-select rounded-0" aria-label=".form-select-sm example">
                                    <option selected>Exibir 10 por página</option>
                                    <option value="1">Exibir 25 por página</option>
                                    <option value="2">Exibir 50 por página</option>
                                    <option value="3">Exibir 100 por página</option>
                                </select>
                            </div>
                        </div>
                        <div class="shop-top-bar-right">
                            <nav>
                                <ul class="pagination">
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-12 col-custom">
                    <aside class="sidebar_widget mt-10 mt-lg-0">
                        <div class="widget_inner" data-aos="fade-up" data-aos-delay="200">
                            <div class="widget-list mb-10">
                                <h3 class="widget-title mb-4">Pesquisar</h3>
                                <div class="search-box">
                                    <input type="text" class="form-control" placeholder="Pesquisar em nossa loja" aria-label="Pesquisar em nossa loja">
                                    <button class="btn btn-dark btn-hover-primary" type="button">
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
                                <form method="get">
                                    <div id="slider-range"></div>
                                    {{-- TODO corrigir modo de filtrar: usando string '$1 - $200' nao vai rolar --}}
                                    {{-- <input class="slider-range-amount" type="start_value" name="text" id="amount" /> --}}
                                    {{-- <button class="slider-range-submit" type="submit">Filtrar</button> --}}
                                    <div class="col-lg-12">
                                        <input class="slider-range-amount" name="start_value" type="number" id="start-value" placeholder="mínimo" style="width: 100% !important;"/>
                                    </div>
                                    <div class="col-lg-12">
                                        <input class="slider-range-amount" type="number" name="end_value" id="end-value" placeholder="máximo" style="width: 100% !important;"/>
                                    </div>
                                    
                                    <br>
                                    <button class="slider-range-submit" type="submit">Filtrar</button>
                                </form>
                            </div>
                            {{-- <div class="widget-list mb-10">
                                <h3 class="widget-title">Categorias</h3>
                                <div class="sidebar-body">
                                    <ul class="sidebar-list">
                                        <li><a href="#">All Product</a></li>
                                        <li><a href="#">Best Seller (5)</a></li>
                                        <li><a href="#">Featured (4)</a></li>
                                        <li><a href="#">New Products (6)</a></li>
                                    </ul>
                                </div>
                            </div> --}}
                            {{-- <div class="widget-list mb-10">
                                <h3 class="widget-title">Cor</h3>
                                <div class="sidebar-body">
                                    <ul class="checkbox-container categories-list">
                                        <li>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck12">
                                                <label class="custom-control-label" for="customCheck12">black (20)</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck13">
                                                <label class="custom-control-label" for="customCheck13">red (6)</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck14">
                                                <label class="custom-control-label" for="customCheck14">blue (8)</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck11">
                                                <label class="custom-control-label" for="customCheck11">green (5)</label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck15">
                                                <label class="custom-control-label" for="customCheck15">pink (4)</label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div> --}}
                            {{-- <div class="widget-list mb-10">
                                <h3 class="widget-title mb-4">Tags</h3>
                                <div class="sidebar-body">
                                    <ul class="tags mb-n2">
                                        <li><a href="#">Men</a></li>
                                        <li><a href="#">Women</a></li>
                                        <li><a href="#">Fashion</a></li>
                                        <li><a href="#">Watch</a></li>
                                        <li><a href="#">Handmade</a></li>
                                        <li><a href="#">Lather</a></li>
                                        <li><a href="#">Fabrics</a></li>
                                    </ul>
                                </div>
                            </div> --}}
                            <div class="widget-list">
                                <h3 class="widget-title mb-4">Produtos Recentes</h3>
                                <div class="sidebar-body product-list-wrapper mb-n6">
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
                                                <img class="first-image" src="{{asset('useLadame/images/products/small-product/2.jpg')}}" alt="Product" />
                                                <img class="second-image" src="{{asset('useLadame/images/products/small-product/3.jpg')}}" alt="Product" />
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
                                                <img class="first-image" src="{{asset('useLadame/images/products/small-product/4.jpg')}}" alt="Product" />
                                                <img class="second-image" src="{{asset('useLadame/images/products/small-product/10.jpg')}}" alt="Product" />
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
@endsection