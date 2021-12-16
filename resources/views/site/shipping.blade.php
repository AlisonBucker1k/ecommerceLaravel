@extends('site.main')

@section('content')
    <div class="section">
        <div class="breadcrumb-area bg-light">
            <div class="container-fluid">
                <div class="breadcrumb-content text-center">
                    <h1 class="title" id="sobre">Políticas de Entrega</h1>
                    <ul>
                        <li>
                            <a href="{{route('home')}}">Home</a>
                        </li>
                        <li class="active">Políticas de Entrega</li>
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
                        <h2 class="title">Políticas de Entrega</h2>
                        <p>
                            A La Dame envia seus pedidos via Correios. O valor é calculado direto no site, sendo informado antes da finalização do pedido, e calculado de acordo com o peso e volume da mercadoria.
                            <br/>
                            <br/>
                            As modalidades de entrega disponíveis são PAC e SEDEX , serviços oferecidos de acordo pelo Correios em seu CEP de recebimento. Os pedidos são separados, embalados e enviados em até XX dias úteis após a confirmação de pagamento, aprovação do sistema antifraude e checagem de cadastro.
                            <br/>
                            <br/>
                            Você irá receberá por e-mail o código de rastreio dos Correios, onde poderá acompanhar a entrega de seu pedido. O prazo de entrega da sua compra começa a ser contato a partir do envio da mercadoria.
                            <br/>
                            <br/>
                            Os envios dos Correios possuem prazos de entrega variados após o despacho.
                            <br/>
                            Você poderá calcular o prazo e valor do frete ao finalizar a compra!
                            <br/>
                            <br/>
                            Caso ocorra algum tipo de atraso em sua entrega, orientamos que seja aberto chamado diretamente no site dos Correios
                            (<a href="http://www.correios.com.br/" target="_blank">correios.com.br</a>).
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
