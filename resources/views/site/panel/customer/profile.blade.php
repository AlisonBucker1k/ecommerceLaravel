@extends('site.main')

@section('content')
    <div class="section">
        <div class="breadcrumb-area bg-light">
            <div class="container-fluid">
                <div class="breadcrumb-content text-center">
                    <h1 class="title">Perfil</h1>
                    <ul>
                        <li>
                            <a href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="active">Perfil</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Shopping Cart Section Start -->
    <div class="section section-margin">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 ms-auto col-custom">
                    <div class="profile-picture">
                        <div id="customer-photo">
                            <img src="{{ asset('/assets/img/no-image.jpg') }}" alt="">
                            {{-- TODO Corrigir foto de perfil --}}
                            {{-- <img src="{{ $customer->proifle->photo_or_default }}" alt=""> --}}
                        </div>
                    </div>
                    <div class="cart-calculator-wrapper" style="margin-top: 0 !important;">
                        <h3 class="title" style="text-align: left">{{ $customer->profile->full_name }}</h3>
                        <p class="text"><i class="fa fa-fw fa-star"></i> {{ dateSql2Br($customer->profile->birth_date) }}</p>
                        <p class="text"><i class="fa fa-fw fa-id-card"></i> {{ $customer->profile->cpf }}</p>
                        <p class="text"><i class="fa fa-fw fa-phone"></i> {{ $customer->profile->phone }}</p>
                        <p class="text"><i class="fa fa-fw fa-mobile"></i> {{ $customer->profile->cellphone }}</p>
                        <p class="text"><i class="fa fa-fw fa-envelope"></i> {{ $customer->email }}</p>
                        <small style="text-align: center; margin-bottom: 5px;"><p class="text">Cliente desde {{ dateSql2Br($customer->created_at) }}</p></small>
                    </div>
                </div>
                <div class="col-lg-8 ms-auto col-custom">
                    <div class="cart-calculator-wrapper" style="margin-top: 0 !important;">
                        <div class="cart-calculate-items">
                            <h3 class="title">Editar Perfil</h3>
                            <form style="padding: 15px;">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nome</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" value="{{ $customer->profile->name }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Sobrenome</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" value="{{ $customer->profile->last_name }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Celular</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" value="{{ $customer->profile->cellphone }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Telefone</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" value="{{ $customer->profile->phone }}">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Senha Atual</label>
                                    <input type="password" class="form-control" id="exampleInputPassword1" name="old_password" placeholder="Senha atual">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nova Senha</label>
                                    <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Nova senha">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Confirmação da Nova Senha</label>
                                    <input type="password" class="form-control" id="exampleInputPassword1" name="password_confirmation" placeholder="Confirmação da nova senha">
                                </div>
                                
                                <button type="submit" class="btn btn-primary pull-right">Salvar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shopping Cart Section End -->
@endsection

@push('css')
    <style>
        #customer-photo {
            background: #212121;
            display: flex;
            flex-direction: row;
            align-content: center;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        #customer-photo > img {
            max-width: 150px;
            border-radius: 100px;
        }

        p.text {
            padding: 1px 15px;
        }

        p > i {
            font-size: 20px;
        }
    </style>
@endpush

@push('js')
    <script type="text/javascript" src="/general/components/jquery-mask-plugin/src/jquery.mask.js"></script>
    <script type="text/javascript">
        $(function() {
            $('#phone').mask('(00) 0000-0000');
            $('#cellphone').mask('(00) 00000-0000');
        });
    </script>
@endpush