@extends('site.main')
@section('content')
    <!-- Breadcrumb Section Start -->
    <div class="section">

        <!-- Breadcrumb Area Start -->
        <div class="breadcrumb-area bg-light">
            <div class="container-fluid">
                <div class="breadcrumb-content text-center">
                    <h1 class="title">Login | Cadastrar</h1>
                    <ul>
                        <li>
                            <a href="index.html">Home </a>
                        </li>
                        <li class="active"> Login | Cadastrar</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Breadcrumb Area End -->

    </div>
    <!-- Breadcrumb Section End -->

    <!-- Login | Register Section Start -->
    <div class="section section-margin">
        <div class="container">

            <div class="row mb-n10">
                <div class="col-lg-6 col-md-8 m-auto m-lg-0 pb-10">
                    <!-- Login Wrapper Start -->
                    <div class="login-wrapper">

                        <!-- Login Title & Content Start -->
                        <div class="section-content text-center mb-5">
                            <h2 class="title mb-2">Login</h2>
                            <p class="desc-content">Faça login em sua conta para acessar seus pedidos.</p>
                        </div>
                        <!-- Login Title & Content End -->

                        <!-- Form Action Start -->

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $erro)
                                    {{$erro}} <br>
                                @endforeach
                            </div>
                        @endif

                        <form action="{{ route('login') }}" method="POST" id="frmSignIn" class="needs-validation">
                            @csrf
                            <!-- Input Email Start -->
                            <div class="single-input-item mb-3">
                                <input type="email" placeholder="E-mail" name="email" value="{{old('email')}}">
                            </div>
                            <!-- Input Email End -->

                            <!-- Input Password Start -->
                            <div class="single-input-item mb-3">
                                <input type="password" placeholder="Senha" name="password">
                            </div>
                            <!-- Input Password End -->

                            <!-- Checkbox/Forget Password Start -->
                            <div class="single-input-item mb-3">
                                <div class="login-reg-form-meta d-flex align-items-center justify-content-between">
                                    <div class="remember-meta mb-3">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="rememberMe">
                                            <label class="custom-control-label" for="rememberMe">Lembrar de mim</label>
                                        </div>
                                    </div>
                                    <a href="{{route('customer.password.request')}}" class="forget-pwd mb-3">Esqueceu sua senha?</a>
                                </div>
                            </div>
                            <!-- Checkbox/Forget Password End -->

                            <!-- Login Button Start -->
                            <div class="single-input-item mb-3">
                                <button class="btn btn btn-dark btn-hover-primary rounded-0">Entrar</button>
                            </div>
                            <!-- Login Button End -->

                            <!-- Lost Password & Creat New Account Start -->
                            <div class="lost-password">
                                {{-- <a href="login-register.html">Create Account</a> --}}
                            </div>
                            <!-- Lost Password & Creat New Account End -->

                        </form>
                        <!-- Form Action End -->

                    </div>
                    <!-- Login Wrapper End -->
                </div>
                <div class="col-lg-6 col-md-8 m-auto m-lg-0 pb-10">
                    <!-- Register Wrapper Start -->
                    <div class="register-wrapper">

                        <!-- Login Title & Content Start -->
                        <div class="section-content text-center mb-5">
                            <h2 class="title mb-2">Criar Conta</h2>
                            <p class="desc-content">Crie sua conta e vá as compras!</p>
                        </div>
                        <!-- Login Title & Content End -->

                        <!-- Form Action Start -->
                        <form action="{{ route('customer.store')}}" id="frmSignUp" method="post" class="needs-validation">
                            @csrf
                            <!-- Input First Name Start -->
                            <div class="single-input-item mb-3">
                                <input type="text" placeholder="Nome" name="name" value="{{old('name')}}" required>
                            </div>
                            <!-- Input First Name End -->

                            <!-- Input Last Name Start -->
                            <div class="single-input-item mb-3">
                                <input type="text" placeholder="Sobrenome" name="last_name" value="{{old('last_name')}}" required>
                            </div>
                            <!-- Input Last Name End -->

                            <div class="single-input-item mb-3">
                                <input type="text" placeholder="CPF" name="cpf" value="{{old('cpf')}}" required>
                            </div>

                            <!-- Input Email Or Username Start -->
                            <div class="single-input-item mb-3">
                                <input type="email" placeholder="E-mail" name="email" value="{{old('email')}}" required>
                            </div>
                            <!-- Input Email Or Username End -->

                            <!-- Input Password Start -->
                            <div class="single-input-item mb-3">
                                <input type="password" placeholder="Insira sua senha" name="password" required>
                            </div>
                            <div class="single-input-item mb-3">
                                <input type="password" placeholder="Confirme sua senha" name="password_confirmation" required>
                            </div>
                            <!-- Input Password End -->

                            <!-- Checkbox & Subscribe Label Start -->
                            <div class="single-input-item mb-3">
                                <div class="login-reg-form-meta d-flex align-items-center justify-content-between">
                                    <div class="remember-meta mb-3">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="rememberMe-2" name="terms" id="terms" required>
                                            <label class="custom-control-label" for="rememberMe-2">Li e aceito os termos de uso</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Checkbox & Subscribe Label End -->

                            <!-- Register Button Start -->
                            <div class="single-input-item mb-3">
                                <button class="btn btn btn-dark btn-hover-primary rounded-0">Criar Conta</button>
                            </div>
                            <!-- Register Button End -->

                        </form>
                        <!-- Form Action End -->

                    </div>
                    <!-- Register Wrapper End -->
                </div>
            </div>

        </div>
    </div>
    <!-- Login | Register Section End -->
@endsection