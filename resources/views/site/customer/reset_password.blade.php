@extends('site.main')

@section('content')
    <div class="section">
        <div class="breadcrumb-area bg-light">
            <div class="container-fluid">
                <div class="breadcrumb-content text-center">
                    <h1 class="title">Recuperar Senha</h1>
                </div>
            </div>
        </div>

    </div>
    <div class="section section-margin">
        <div class="container">
            <div class="row justify-content-center mb-n10">
                <div class="col-lg-6 col-md-8 m-auto m-lg-0 pb-10">
                    <div class="login-wrapper">
                        <div class="section-content text-center mb-5">
                            <p class="desc-content">Enviaremos um e-mail para o endereço abaixo:</p>
                        </div>

                        <form method="post" action="{{ route('customer.password.email') }}" name="reset-form">
                            @csrf
                            <div class="single-input-item mb-3">
                                <input type="email" placeholder="E-mail" name="email" value="{{old('email')}}">
                            </div>

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        {{ $error }} <br>
                                    @endforeach
                                </div>
                            @endif

                            <div class="single-input-item pull-right mb-3">
                                <button class="btn btn btn-dark btn-hover-primary rounded-0">Continuar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
