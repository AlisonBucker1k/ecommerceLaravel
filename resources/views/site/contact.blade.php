@extends('site.main')
@section('content')
    <!-- Breadcrumb Section Start -->
    <div class="section">

        <!-- Breadcrumb Area Start -->
        <div class="breadcrumb-area bg-light">
            <div class="container-fluid">
                <div class="breadcrumb-content text-center">
                    <h1 class="title">Fale Conosco</h1>
                    <ul>
                        <li>
                            <a href="{{route('home')}}">Home </a>
                        </li>
                        <li class="active"> Contato</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Breadcrumb Area End -->

    </div>
    <!-- Breadcrumb Section End -->

    <!-- Contact Us Section Start -->
    <div class="section section-margin">
        <div class="container">
            <div class="row mb-n10">
                <div class="col-12 col-lg-8 mb-10">
                    <!-- Section Title Start -->
                    <div class="section-title" data-aos="fade-up" data-aos-delay="300">
                        <h2 class="title pb-3">Envie-nos uma mensagem</h2>
                        <span></span>
                        <div class="title-border-bottom"></div>
                    </div>
                    <!-- Section Title End -->
                    <!-- Contact Form Wrapper Start -->
                    <div class="contact-form-wrapper contact-form">
                        <form action="assets/php/destry.php" id="contact-form" method="post">
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
                                        <div class="col-12" data-aos="fade-up" data-aos-delay="300">
                                            <div class="input-item mb-4">
                                                <input class="input-item" type="text" placeholder="Assunto *" name="subject">
                                            </div>
                                        </div>
                                        <div class="col-12" data-aos="fade-up" data-aos-delay="400">
                                            <div class="input-item mb-8">
                                                <textarea class="textarea-item" name="message" placeholder="Sua Mensagem"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-12" data-aos="fade-up" data-aos-delay="500">
                                            <button type="submit" id="submit" name="submit" class="btn btn-dark btn-hover-primary rounded-0">Enviar Mensagem</button>
                                        </div>
                                        <p class="col-8 form-message mb-0"></p>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <p class="form-messege"></p>
                    </div>
                    <!-- Contact Form Wrapper End -->
                </div>
                <div class="col-12 col-lg-4 mb-10">
                    <!-- Section Title Start -->
                    <div class="section-title" data-aos="fade-up" data-aos-delay="300">
                        <h2 class="title pb-3">Informações de contato</h2>
                        <span></span>
                        <div class="title-border-bottom"></div>
                    </div>
                    <!-- Section Title End -->

                    <!-- Contact Information Wrapper Start -->
                    <div class="row contact-info-wrapper mb-n6">

                        <!-- Single Contact Information Start -->
                        <div class="col-lg-12 col-md-6 col-sm-12 col-12 single-contact-info mb-6" data-aos="fade-up" data-aos-delay="300">

                            <!-- Single Contact Icon Start -->
                            <div class="single-contact-icon">
                                <i class="fa fa-map-marker"></i>
                            </div>
                            <!-- Single Contact Icon End -->

                            <!-- Single Contact Title Content Start -->
                            <div class="single-contact-title-content">
                                <h4 class="title">Endereço</h4>
                                <p class="desc-content">Avenida Mário Gurgel, 5353 <br>Shopping Moxuara Loja __</p>
                            </div>
                            <!-- Single Contact Title Content End -->

                        </div>
                        <!-- Single Contact Information End -->

                        <!-- Single Contact Information Start -->
                        <div class="col-lg-12 col-md-6 col-sm-12 col-12 single-contact-info mb-6" data-aos="fade-up" data-aos-delay="400">

                            <!-- Single Contact Icon Start -->
                            <div class="single-contact-icon">
                                <i class="fa fa-mobile"></i>
                            </div>
                            <!-- Single Contact Icon End -->

                            <!-- Single Contact Title Content Start -->
                            <div class="single-contact-title-content">
                                <h4 class="title">Telefone:</h4>
                                <p class="desc-content">Mobile: 012 345 678 <br>Fax: 123 456 789</p>
                            </div>
                            <!-- Single Contact Title Content End -->

                        </div>
                        <!-- Single Contact Information End -->

                        <!-- Single Contact Information Start -->
                        <div class="col-lg-12 col-md-6 col-sm-12 col-12 single-contact-info mb-6" data-aos="fade-up" data-aos-delay="500">

                            <!-- Single Contact Icon Start -->
                            <div class="single-contact-icon">
                                <i class="fa fa-envelope-o"></i>
                            </div>
                            <!-- Single Contact Icon End -->

                            <!-- Single Contact Title Content Start -->
                            <div class="single-contact-title-content">
                                <h4 class="title">Support Overall</h4>
                                <p class="desc-content"><a href="#">Support24/7@example.com</a> <br><a href="#">info@example.com</a> </p>
                            </div>
                            <!-- Single Contact Title Content End -->

                        </div>
                        <!-- Single Contact Information End -->

                    </div>
                    <!-- Contact Information Wrapper End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Contact us Section End -->
    

    <!-- Contact Map Start -->
    <div class="section" data-aos="fade-up" data-aos-delay="300">
        <!-- Google Map Area Start -->
        <div class="google-map-area w-100">
            <iframe class="contact-map" src=https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3740.944375116313!2d-40.4023542850787!3d-20.343916486373335!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xb8394ff46141bb%3A0x48c0d6a34f286085!2sShopping%20Moxuara!5e0!3m2!1spt-BR!2sbr!4v1632582926945!5m2!1spt-BR!2sbr"></iframe>
        </div>
        <!-- Google Map Area Start -->
    </div>
    <!-- Contact Map End -->
@endsection

