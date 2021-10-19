@extends('site.main')

@section('content')
    <div class="section section-margin">
        <div class="container">
            <div class="col-lg-12">
                <div class="col">
                    <div class="featured-boxes">
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="featured-box featured-box-primary text-left mt-5">
                                    <div class="box-content">
                                        <h4 class="color-primary font-weight-semibold text-4 text-uppercase mb-3">Preencha os campos abaixo</h4>
                                        <div class="signin-form-container">
                                            <form method="post" action="{{ route('customer.password.reset') }}" name="reset-form">
                                                @csrf
                                                <input type="hidden" name="token" value="{{ $token }}">
                                                <input type="hidden" name="email" value="{{ $email }}">
                                                <div class="form-group">
                                                    <label for="password">Senha</label>
                                                    <input type="password" class="form-control margin-bottom-20" name="password">
                                                </div>
                                                <div class="form-group">
                                                    <label for="confirm_password">Confirme a Senha</label>
                                                    <input type="password" class="form-control margin-bottom-20" name="password_confirmation">
                                                </div>
                                                <button class="btn btn-lg btn-block btn-primary btn-modern">Alterar Senha</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Login | Register Section End -->
@endsection
