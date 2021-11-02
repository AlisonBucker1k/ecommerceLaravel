@extends('site.main')

@section('content')
    <div class="section">
        <div class="breadcrumb-area bg-light">
            <div class="container-fluid">
                <div class="breadcrumb-content text-center">
                    <h1 class="title">Fale Conosco</h1>
                    <ul>
                        <li>
                            <a href="{{route('home')}}">Home </a>
                        </li>
                        <li class="active">Contato</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="section section-margin">
        <div class="container">
            <div class="row mb-n10">
                <div class="col-12 col-lg-8 mb-10">
                    <div class="section-title" data-aos="fade-up" data-aos-delay="300">
                        <h2 class="title pb-3">Envie-nos uma mensagem</h2>
                        <span></span>
                        <div class="title-border-bottom"></div>
                    </div>
                    <div class="contact-form-wrapper contact-form">
                        <form id="contact-form" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-md-6" data-aos="fade-up" data-aos-delay="300">
                                            <div class="input-item mb-4">
                                                <input class="input-item" type="text" placeholder="Seu nome*" name="name">
                                            </div>
                                        </div>
                                        <div class="col-md-6" data-aos="fade-up" data-aos-delay="400">
                                            <div class="input-item mb-4">
                                                <input class="input-item" type="email" placeholder="E-mail*" name="email">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <div class="input-item mb-4" data-aos="fade-up" data-aos-delay="400">
                                                    <select class="form-control" name="mail_subject" id="subject" required>
                                                        <option value="">Selecione</option>
                                                        <option @if (old('mail_subject') == 'Suporte')selected="selected"@endif>Suporte</option>
                                                        <option @if (old('mail_subject') == 'Financeiro')selected="selected"@endif>Financeiro</option>
                                                        <option @if (old('mail_subject') == 'Reclamação')selected="selected"@endif>Reclamação</option>
                                                        <option @if (old('mail_subject') == 'Sugestão')selected="selected"@endif>Sugestão</option>
                                                        <option @if (old('mail_subject') == 'Outros')selected="selected"@endif>Outros</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12" data-aos="fade-up" data-aos-delay="400">
                                            <div class="input-item mb-8">
                                                <textarea class="textarea-item" name="message" placeholder="Mensagem"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-12" data-aos="fade-up" data-aos-delay="500">
                                            <button type="submit" class="btn btn-dark btn-hover-primary rounded-0">Enviar Mensagem</button>
                                        </div>
                                        <p class="col-8 form-message mb-0"></p>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <p class="form-messege"></p>
                    </div>
                </div>
                <div class="col-12 col-lg-4 mb-10">
                    <div class="section-title" data-aos="fade-up" data-aos-delay="300">
                        <h2 class="title pb-3">Informações de contato</h2>
                        <span></span>
                        <div class="title-border-bottom"></div>
                    </div>
                    <div class="row contact-info-wrapper mb-n6">
                        <div class="col-lg-12 col-md-6 col-sm-12 col-12 single-contact-info mb-6" data-aos="fade-up" data-aos-delay="300">
                            <div class="single-contact-icon">
                                <i class="fa fa-map-marker"></i>
                            </div>
                            <div class="single-contact-title-content">
                                <h4 class="title">Endereço</h4>
                                <p class="desc-content">Avenida Mário Gurgel, 5353 <br>Shopping Moxuara Loja L3</p>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-6 col-sm-12 col-12 single-contact-info mb-6" data-aos="fade-up" data-aos-delay="400">
                            <div class="single-contact-icon">
                                <i class="fa fa-mobile"></i>
                            </div>
                            <div class="single-contact-title-content">
                                <h4 class="title">Telefone</h4>
                                <p class="desc-content">{{ env('COMPANY_WHATSAPP') }}</p>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-6 col-sm-12 col-12 single-contact-info mb-6" data-aos="fade-up" data-aos-delay="500">
                            <div class="single-contact-icon">
                                <i class="fa fa-envelope-o"></i>
                            </div>
                            <div class="single-contact-title-content">
                                <h4 class="title">E-mail</h4>
                                <p class="desc-content"><a href="#">{{ env('COMPANY_EMAIL') }}</a> <br><a href="#">{{ env('COMPANY_EMAIL_SAC') }}</a> </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section" data-aos="fade-up" data-aos-delay="300">
        <div class="section" style="margin-top: 10px;">
            <div class="container">
                <div class="row" style="margin-bottom: 0;">
                    <div class="col-12 col-lg-12">
                        <div class="section-title" data-aos="fade-up" data-aos-delay="300">
                            <h2 class="title pb-3">Onde nos encontrar</h2>
                            <span></span>
                            <div class="title-border-bottom"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="google-map-area w-100">
            <iframe class="contact-map" src=https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3740.944375116313!2d-40.4023542850787!3d-20.343916486373335!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xb8394ff46141bb%3A0x48c0d6a34f286085!2sShopping%20Moxuara!5e0!3m2!1spt-BR!2sbr!4v1632582926945!5m2!1spt-BR!2sbr"></iframe>
        </div>
    </div>
@endsection
