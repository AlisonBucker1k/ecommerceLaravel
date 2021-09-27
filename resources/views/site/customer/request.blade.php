@extends('site.main')
@section('content')
<div class="section">
    <!-- Breadcrumb Area Start -->
    <div class="breadcrumb-area bg-light">
        <div class="container-fluid">
            <div class="breadcrumb-content text-center">
                <h1 class="title">Recuperar senha</h1>
                <ul>
                    <li>
                        <a href="{{route('home')}}">Home </a>
                    </li>
                    <li class="active"> Recuperar Senha</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area End -->
</div>

<div class="section section-margin">
    <div class="container">
        <div class="row mb-n10">
            <div class="col-lg-12 col-md-12 m-auto m-lg-0 pb-10">
                <div class="login-wrapper">
                    <div class="section-content text-center mb-5">
                        <h2 class="title mb-2">Recupere sua senha</h2>
                        <p class="desc-content">Insira o email de sua conta para recuperar sua senha.</p>
                    </div>

                    <form action="{{route('customer.password.email')}}" name="reset-form" method="POST" id="frmSignIn" class="needs-validation">
                        @csrf
                        <!-- Input Email Start -->
                        <div class="single-input-item mb-3">
                            <input type="email" placeholder="E-mail" name="email" value="{{ old('email') }}">
                        </div>
                        <!-- Input Email End -->

                        <!-- Login Button Start -->
                        <div class="single-input-item mb-3">
                            <button class="btn btn btn-dark btn-hover-primary rounded-0">Recuperar senha</button>
                        </div>
                        <!-- Login Button End -->

                        <!-- Lost Password & Creat New Account Start -->
                        <div class="lost-password">
                            
                        </div>
                        <!-- Lost Password & Creat New Account End -->

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection