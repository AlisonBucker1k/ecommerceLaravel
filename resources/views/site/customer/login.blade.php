@extends('site.main')

@section('content')
    <div class="section">
        <div class="breadcrumb-area bg-light">
            <div class="container-fluid">
                <div class="breadcrumb-content text-center">
                    <h1 class="title">Login | Cadastre-se</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="section section-margin">
        <div class="container">
            <div class="row mb-n10">
                <div class="col-lg-6 col-md-8 m-auto m-lg-0 pb-10">
                    <div class="login-wrapper">
                        <div class="section-content text-center mb-5">
                            <h2 class="title mb-2">Login</h2>
                            <p class="desc-content">Faça login em sua conta para acessar seus pedidos.</p>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $erro)
                                    {{$erro}} <br>
                                @endforeach
                            </div>
                        @endif

                        <form action="{{ route('login') }}" method="POST" id="frmSignIn" class="needs-validation">
                            @csrf
                            <div class="single-input-item mb-3">
                                <input type="email" placeholder="E-mail" name="email" value="{{old('email')}}">
                            </div>
                            <div class="single-input-item mb-3">
                                <input type="password" placeholder="Senha" name="password">
                            </div>
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
                            <div class="single-input-item mb-3">
                                <button class="btn btn btn-dark btn-hover-primary rounded-0">Entrar</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6 col-md-8 m-auto m-lg-0 pb-10">
                    <div class="register-wrapper">
                        <div class="section-content text-center mb-5">
                            <h2 class="title mb-2">Criar Conta</h2>
                            <p class="desc-content">Crie sua conta e vá às compras!</p>
                        </div>
                        <form action="{{ route('customer.store')}}" id="frmSignUp" method="post" class="needs-validation">
                            @csrf
                            @php
                            use Illuminate\Support\Facades\Cookie;
                            Cookie::queue(Cookie::make('redirectTo', back()->getTargetUrl(), 525600));
                            @endphp
                            <div class="single-input-item mb-3">
                                <input type="text" placeholder="Nome" name="name" value="{{old('name')}}" required>
                            </div>
                            <div class="single-input-item mb-3">
                                <input type="text" placeholder="Sobrenome" name="last_name" value="{{old('last_name')}}" required>
                            </div>
                            <div class="single-input-item mb-3">
                                <input type="text" placeholder="CPF" name="cpf" value="{{old('cpf')}}" required>
                            </div>
                            <div class="single-input-item mb-3">
                                <input type="email" placeholder="E-mail" name="email" value="{{old('email')}}" required>
                            </div>
                            <div class="single-input-item mb-3">
                                <input type="password" placeholder="Insira sua senha" name="password" required>
                            </div>
                            <div class="single-input-item mb-3">
                                <input type="password" placeholder="Confirme sua senha" name="password_confirmation" required>
                            </div>
                            <div class="single-input-item mb-3">
                                <div class="login-reg-form-meta d-flex align-items-center justify-content-between">
                                    <div class="remember-meta mb-3">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="terms" id="terms" required>
                                            <label class="custom-control-label" for="terms">Li e aceito os termos de uso</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single-input-item mb-3">
                                <button type="submit" class="btn btn btn-dark btn-hover-primary rounded-0">Criar Conta</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
