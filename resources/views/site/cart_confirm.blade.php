@extends('site.main')

@section('content')
    <div class="section">
        <div class="breadcrumb-area bg-light">
            <div class="container-fluid">
                <div class="breadcrumb-content text-center">
                    <h1 class="title">Finalizar Pedido</h1>
                    <ul>
                        <li>
                            <a href="{{route('home')}}">Home</a>
                        </li>
                        <li class="active">Finalizar Pedido</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="section section-margin">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="coupon-accordion">
                        <!--
                        <h3 class="title">Returning customer? <span id="showlogin">Click here to login</span></h3>

                        <div id="checkout-login" class="coupon-content">
                            <div class="coupon-info">
                                <p class="coupon-text mb-2">Já é cliente? Faça login para prosseguir</p>

                                <form action="#">
                                    <p class="form-row-first">
                                        <label>Username or email <span class="required">*</span></label>
                                        <input type="text">
                                    </p>

                                    <p class="form-row-last">
                                        <label>Password <span class="required">*</span></label>
                                        <input type="password">
                                    </p>

                                    <p class="form-row mb-2">
                                        <input type="checkbox" id="remember_me">
                                        <label for="remember_me" class="checkbox-label">Remember me</label>
                                    </p>

                                    <p class="lost-password"><a href="#">Lost your password?</a></p>

                                </form>

                            </div>
                        </div>

                        <h3 class="title">Tem um cupom de desconto?<span id="showcoupon">Clique aqui para inseri-lo</span></h3>
                        Title End -->

                        <div id="checkout_coupon" class="coupon-checkout-content">
                            <div class="coupon-info">
                                <form action="#">
                                    <p class="checkout-coupon d-flex">
                                        <input placeholder="Cupom de desconto code" type="text">
                                        <input class="btn btn-dark btn-hover-primary rounded-0" value="Aplicar Cupom" type="submit">
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-n4">
                <div class="col-lg-8 col-12 mb-4">
                    <div class="your-order-area border">
                        <h3 class="title">Seu Pedido</h3>
                        <div class="your-order-table table-responsive">
                            <table class="table">
                                <thead>
                                    <tr class="cart-product-head">
                                        <th class="cart-product-name text-start">Produto</th>
                                        <th class="cart-product-total text-end">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($cart->cartProducts as $cartProduct)
                                        @php $stockQuantity = $cartProduct->variation->stock_quantity @endphp
                                        <tr class="cart_item">
                                            <td class="cart-product-name text-start ps-0">
                                                <strong class="product-quantity">{{ $cartProduct->quantity }}x</strong>
                                                {{ $cartProduct->product->name }} <br/>
                                                @foreach ($cartProduct->variation->items as $item)
                                                    {{ $item->productGrid->grid->description }}: {{ $item->gridVariation->description }}<br>
                                                @endforeach
                                                <br>
                                                @if ($stockQuantity <= 0)
                                                    <div class="alert alert-info alert-sm">
                                                        Produto indisponível.
                                                        <a href="{{ route('cart.product.remove', $cartProduct->id) }}">Deseja remover do carrinho?</a>
                                                    </div>
                                                @else
                                                    <td class="product-price text-right">
                                                        <span class="amount">R$ {{ $cartProduct->variation->final_price_formated }}</span>
                                                        @if ($cartProduct->variation->discount_percent > 0)
                                                            <br>
                                                            <del>
                                                                <small>
                                                                    <span class="amount">R$ {{ $cartProduct->variation->value_formated }}</span>
                                                                </small>
                                                            </del>
                                                        @endif
                                                    </td>
                                                @endif

                                            </td>
                                            <td class="cart-product-total text-end pe-0"><span class="amount">R$ {{ $cartProduct->subtotal_value_formated }}</span></td>
                                        </tr>

                                        <tr class="cart_table_item">
                                            <td class="product-thumbnail" width="100">
                                                <img alt="" class="img-fluid" src="{{ $cartProduct->variation->image }}">
                                            </td>
                                            <td class="product-name">
                                                <strong>{{ $cartProduct->product->name }}</strong>
                                                <br>

                                            </td>

                                            <td class="product-quantity text-center" width="150">
                                                {{ $cartProduct->quantity }}
                                            </td>
                                            <td class="product-subtotal text-right">
                                                <span class="amount">R$ </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Nenhum produto no carrinho</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                                <tfoot>
                                    <tr class="cart-subtotal">
                                        <th class="text-start ps-0">Subtotal</th>
                                        <td class="text-end pe-0"><span class="amount">R$349.00</span></td>
                                    </tr>
                                    <tr class="cart-subtotal">
                                        <th class="text-start ps-0">Frete</th>
                                        <td class="text-end pe-0"><span class="amount">R$349.00</span></td>
                                    </tr>
                                    <tr class="order-total">
                                        <th class="text-start ps-0">Order Total</th>
                                        <td class="text-end pe-0"><strong><span class="amount">R$349.00</span></strong></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="payment-accordion-order-button">
                            <div class="payment-accordion">
                                <div class="single-payment">
                                    <h5 class="panel-title mb-3">
                                        <a class="collapse-off" data-bs-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                           Boleto Bancário
                                        </a>
                                    </h5>
                                    <div class="collapse show" id="collapseExample">
                                        <div class="card card-body rounded-0">
                                            <p>Você poderá pagar em qualquer loteria, ou pelo aplicativo do seu banco. Seu pedido será confirmado após o periodo de compensação do boleto <strong>(Dois à 3 dias úteis)</strong>.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-payment">
                                    <h5 class="panel-title mb-3">
                                        <a class="collapse-off" data-bs-toggle="collapse" href="#collapseExample-2" aria-expanded="false" aria-controls="collapseExample-2">
                                            Cartão de Crédito.
                                        </a>
                                    </h5>
                                    <div class="collapse" id="collapseExample-2">
                                        <div class="card card-body rounded-0">

                                            <div class="col-md-12">
                                                <div class="checkout-form-list">
                                                   <form action="">
                                                    <div class="card-wrapper"></div>
                                                    <label>Titular do Cartão <span class="required">*</span></label>
                                                    <input type="text" required id="nome_cartao">
                                                    <input class="form-control" placeholder="0000 0000 0000 0000" name="ccnumber" id="number">
                                                    <input type="text" name="ccmonth" id="ccmonth" class="form-control" placeholder="MM" maxlength="2" minlength="2" >
                                                    <input type="text"class="form-control" id="ccyear" name="ccyear" placeholder="AAAA">
                                                    <input class="form-control" id="cvv" name="cvv" type="number" placeholder="Dígito Verificador">
                                                   </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="order-button-payment">
                                <button class="btn btn-dark btn-hover-primary rounded-0 w-100">Finalizar Compra</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12 mb-4">
                    <div class="your-order-area border">
                        <div class="your-order-table table-responsive">
                            <form action="" method="post">
                                <div class="checkbox-form">
                                    <h3 class="title">Informações do comprador</h3>
                                    <div class="row">
                                        <div class="col-md-12 mb-6">
                                            <div class="country-select">
                                                <label>País <span class="required">*</span></label>
                                                <select class="myniceselect nice-select wide rounded-0" disabled>
                                                    <option data-display="Bangladesh">Brasil</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>Nome <span class="required">*</span></label>
                                                <input placeholder="" type="text">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>Sobrenome <span class="required">*</span></label>
                                                <input placeholder="" type="text">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="checkout-form-list">
                                                <label>Rua <span class="required">*</span></label>
                                                <input placeholder="Street address" type="text">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="checkout-form-list">
                                                <input placeholder="Apartment, suite, unit etc. (optional)" type="text">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="checkout-form-list">
                                                <label>Cidade <span class="required">*</span></label>
                                                <input type="text">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>Estado <span class="required">*</span></label>
                                                <input placeholder="" type="text">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>CEP <span class="required">*</span></label>
                                                <input placeholder="" type="text">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>Seu E-mail <span class="required">*</span></label>
                                                <input placeholder="" type="email">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>Telefone <span class="required">*</span></label>
                                                <input type="text">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="checkout-form-list create-acc">
                                                <input id="cbox" type="checkbox">
                                                <label for="cbox" class="checkbox-label">Quero criar minha conta</label>
                                            </div>
                                            <div id="cbox-info" class="checkout-form-list create-account">
                                                <p class="mb-2">Insira uma senha para a sua conta</p>
                                                <label>Sua senha <span class="required">*</span></label>
                                                <input placeholder="Password" type="password">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="different-address">
                                        <div class="ship-different-title">
                                            {{-- <div>
                                                <input id="ship-box" type="checkbox">
                                                <label for="ship-box" class="checkbox-label">Ship to a different address?</label>
                                            </div> --}}
                                        </div>
                                        <div id="ship-box-info" class="row mt-2">
                                            <div class="col-md-12">
                                                <div class="myniceselect country-select clearfix">
                                                    <label>Country <span class="required">*</span></label>
                                                    <select class="myniceselect nice-select wide rounded-0">
                                                        <option data-display="Bangladesh">Bangladesh</option>
                                                        <option value="uk">London</option>
                                                        <option value="rou">Romania</option>
                                                        <option value="fr">French</option>
                                                        <option value="de">Germany</option>
                                                        <option value="aus">Australia</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="checkout-form-list">
                                                    <label>First Name <span class="required">*</span></label>
                                                    <input placeholder="" type="text">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="checkout-form-list">
                                                    <label>Last Name <span class="required">*</span></label>
                                                    <input placeholder="" type="text">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="checkout-form-list">
                                                    <label>Company Name</label>
                                                    <input placeholder="" type="text">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="checkout-form-list">
                                                    <label>Address <span class="required">*</span></label>
                                                    <input placeholder="Street address" type="text">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="checkout-form-list">
                                                    <input placeholder="Apartment, suite, unit etc. (optional)" type="text">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="checkout-form-list">
                                                    <label>Town / City <span class="required">*</span></label>
                                                    <input type="text">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="checkout-form-list">
                                                    <label>State / County <span class="required">*</span></label>
                                                    <input placeholder="" type="text">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="checkout-form-list">
                                                    <label>Postcode / Zip <span class="required">*</span></label>
                                                    <input placeholder="" type="text">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="checkout-form-list">
                                                    <label>Email Address <span class="required">*</span></label>
                                                    <input placeholder="" type="email">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="checkout-form-list">
                                                    <label>Phone <span class="required">*</span></label>
                                                    <input type="text">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="{{asset('useLadame/css/card.css')}}">
@endpush

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="{{asset('useLadame/js/plugins/jquery.card.js')}}"></script>
    <script src="{{asset('useLadame/js/plugins/card.js')}}"></script>

    <script>
        var card = new Card({
            form: 'form',
            container: '.card-wrapper',
            formSelectors: {
                nameInput: 'input#nome_cartao',
                numberInput: 'input#number',
                expiryInput: 'input#ccmonth, input#ccyear',
                cvcInput: 'input#cvv'
            }
        });
    </script>
@endpush
