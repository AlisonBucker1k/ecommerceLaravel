@extends('site.main')
@section('content')
    <!-- Breadcrumb Section Start -->
    <div class="section">

        <!-- Breadcrumb Area Start -->
        <div class="breadcrumb-area bg-light">
            <div class="container-fluid">
                <div class="breadcrumb-content text-center">
                    <h1 class="title" id="sobre">Sobre nós</h1>
                    <ul>
                        <li>
                            <a href="{{route('home')}}">Home </a>
                        </li>
                        <li class="active"> Sobre nós</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Breadcrumb Area End -->
    </div>
    <!-- Breadcrumb Section End -->

    <!-- About Section Start -->
    <div class="section section-margin overflow-hidden">
        <div class="container">
            <div class="row mb-n6">
                <div class="col-lg-6 align-self-center mb-6" data-aos="fade-right" data-aos-delay="600">
                    <div class="about_content">
                        <h2 class="title">Sobre nós</h2>
                        <h3 class="sub-title">A La Dame foi criada para a mulher moderna que busca produtos de alta qualidade e destaque em sua versatilidade e conforto.</h3>
                            <p>Pensado e selecionado com bastante carinho e atenção por nossa equipe, os produtos da La Dame compõe a essencialidade ideal para o dia a dia da mulher. Nosso lema já diz “COMECE A VESTIR-SE BEM PELA LINGERIE”, inspirado na melhor forma de oferecer as mulheres produtos diversificados, de fina qualidade e delicadeza íntima.</p>
                    </div>
                </div>
                <div class="col-lg-6 mb-6" data-aos="fade-left" data-aos-delay="600">
                    <div class="about_thumb">
                        <img class="fit-image" src="{{asset('useLadame/images/about/useladame.png')}}" alt="About Image">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About Section End -->

    
@endsection


<!-- Feature Section Start -->
    <div class="section about-feature-bg section-padding">
        <div class="container">
            <div class="row mb-n5">
                <!-- Feature Start -->
                <div class="col-lg-3 col-md-6 mb-5" data-aos="fade-up" data-aos-delay="300">
                    <div class="feature flex-column text-center">
                        <div class="icon w-100 mb-4">
                            <img src="{{asset('useLadame/images/icons/feature-icon-2.png')}}" alt="Feature Icon">
                        </div>
                        <div class="content ps-0 w-100">
                            <h5 class="title mb-2">Free Shipping</h5>
                            <p>Erat metus sodales eget dolor consectetuer, porta ut purus at et alias, nulla ornare velit</p>
                        </div>
                    </div>
                </div>
                <!-- Feature End -->

                <!-- Feature Start -->
                <div class="col-lg-3 col-md-6 mb-5" data-aos="fade-up" data-aos-delay="400">
                    <div class="feature flex-column text-center">
                        <div class="icon w-100 mb-4">
                            <img src="{{asset('useLadame/images/icons/feature-icon-3.png')}}" alt="Feature Icon">
                        </div>
                        <div class="content ps-0 w-100">
                            <h5 class="title mb-2">Support 24/7</h5>
                            <p>Erat metus sodales eget dolor consectetuer, porta ut purus at et alias, nulla ornare velit</p>
                        </div>
                    </div>
                </div>
                <!-- Feature End -->
                <!-- Feature Start -->
                <div class="col-lg-3 col-md-6 mb-5" data-aos="fade-up" data-aos-delay="500">
                    <div class="feature flex-column text-center">
                        <div class="icon w-100 mb-4">
                            <img src="{{asset('useLadame/images/icons/feature-icon-4.png')}}" alt="Feature Icon">
                        </div>
                        <div class="content ps-0 w-100">
                            <h5 class="title mb-2">Money Return</h5>
                            <p>Erat metus sodales eget dolor consectetuer, porta ut purus at et alias, nulla ornare velit</p>
                        </div>
                    </div>
                </div>
                <!-- Feature End -->

                <!-- Feature Start -->
                <div class="col-lg-3 col-md-6 mb-5" data-aos="fade-up" data-aos-delay="600">
                    <div class="feature flex-column text-center">
                        <div class="icon w-100 mb-4">
                            <img src="{{asset('useLadame/images/icons/feature-icon-1.png')}}" alt="Feature Icon">
                        </div>
                        <div class="content ps-0 w-100">
                            <h5 class="title mb-2">Order Discount</h5>
                            <p>Erat metus sodales eget dolor consectetuer, porta ut purus at et alias, nulla ornare velit</p>
                        </div>
                    </div>
                </div>
                <!-- Feature End -->
            </div>
        </div>
    </div>
    <!-- Feature Section End -->

    <!-- Service Section Start -->
    <div class="section section-margin" id="missao">
        <div class="container">
            <div class="row mb-n6">
                <div class="col-lg-4 col-md-6 text-center mb-6" data-aos="fade-up" data-aos-delay="200">
                    <!-- Single Service Start -->
                    <div class="single-service">
                        <h2 class="title">What Do We Do</h2>
                        <p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam. Lorem ipsum dolor sit amet conse ctetur.</p>
                    </div>
                    <!-- Single Service End -->
                </div>
                <div class="col-lg-4 col-md-6 text-center mb-6" data-aos="fade-up" data-aos-delay="400">
                    <!-- Single Service Start -->
                    <div class="single-service">
                        <h2 class="title">Our Mission</h2>
                        <p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam. Lorem ipsum dolor sit amet conse ctetur.</p>
                    </div>
                    <!-- Single Service End -->
                </div>
                <div class="col-lg-4 col-md-6 text-center mb-6" data-aos="fade-up" data-aos-delay="600">
                    <!-- Single Service Start -->
                    <div class="single-service">
                        <h2 class="title">History of Us</h2>
                        <p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam. Lorem ipsum dolor sit amet conse ctetur.</p>
                    </div>
                    <!-- Single Service End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Service Section End -->
