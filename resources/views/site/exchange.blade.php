@extends('site.main')

@section('content')
    <div class="section">
        <div class="breadcrumb-area bg-light">
            <div class="container-fluid">
                <div class="breadcrumb-content text-center">
                    <h1 class="title" id="sobre">Políticas de Troca</h1>
                    <ul>
                        <li>
                            <a href="{{route('home')}}">Home</a>
                        </li>
                        <li class="active">Políticas de Troca</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="section section-margin overflow-hidden">
        <div class="container">
            <div class="row mb-n6 justify-content-center">
                <div class="col-lg-6  mb-6" data-aos="fade-right" data-aos-delay="600">
                    <div class="about_content">
                        <h2 class="title">Políticas de Troca</h2>
                        <p>
                            Você poderá trocar os itens da sua compra realizada via nosso e-commerce até XX dias após recebê-la, ou devolver um ou mais itens até 7 dias após recebê-la, desde que o produto esteja com: <br/>
                            - Etiqueta afixada; <br/>
                            - Acompanhado de todos os acessórios; <br/>
                            - Não tenha sido usado, lavado ou alterado. <br/> <br/>

                            Os produtos que não atenderem tais condições mencionadas acima não serão aceitos como troca ou devolução e automaticamente serão enviados de volta ao endereço de origem sem consulta prévia e com cobrança de frete.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
