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
