@extends('site.main')

@section('content')
    <div class="section">
        <div class="breadcrumb-area bg-light">
            <div class="container-fluid">
                <div class="breadcrumb-content text-center">
                    <h1 class="title" id="sobre">Canais de Ajuda</h1>
                    <ul>
                        <li>
                            <a href="{{route('home')}}">Home</a>
                        </li>
                        <li class="active">Canais de Ajuda</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="section section-margin overflow-hidden">
        <div class="container">
            <div class="row mb-n6 justify-content-center">
                <div class="col-lg-8  mb-6" data-aos="fade-right" data-aos-delay="600">
                    <div class="about_content">
                        <h2 class="title">Canais de Ajuda</h2>
                        <p>
                            Nossa central de ajuda está à disposição solucionar sua dúvida. Atendemos on-line, por e-mail ou pelo telefone.
                            <br/>
                            De segunda a sexta, das XX:XX às XX:XX horas.
                            <br/><br/>
                            SAC: (27) XXXX-XXXX
                            <br/>
                            WhatsApp: (27) XXXX-XXXX
                            <br/>
                            E-mail: XXXXX@useladame.com
                            <br/>
                            Instagram: [link Instagram]
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
