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
            <div class="row mb-10">
                <div class="col-lg-12 col-12 mb-4">
                    <div class="your-order-area border">
                        <h3 class="title">Endereço de entrega</h3>
                        <div class="form-row">
                            <div class="form-group col">
                                @if ($addresses != null)
                                    <select class="form-control" id="address" name="address_id">
                                        <option value="">Selecione</option>
                                        @foreach ($addresses as $address)
                                            <option value="{{ $address->id }}" data-cep="{{ $address->postal_code }}" >{{ $address->complete_address }}</option>
                                        @endforeach
                                    </select>
                                @else
                                    Nenhum endereço cadastrado
                                @endif
                            </div>
                        </div>
                        <br><br>
                        <div class="form-row">
                            <div class="form-group col-8">
                                <div id="shipping-options"></div>
                            </div>
                            <div class="form-group col-4 text-right">
                                <a href="#addAddress" data-toggle="modal" class="btn btn-primary btn-modern text-uppercase">
                                    Novo Endereço
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>




            <div class="row mb-n4">
                <div class="col-lg-12 col-12 mb-4">
                    <div class="your-order-area border">
                        <h3 class="title">Seu Pedido</h3>
                        <div class="your-order-table table-responsive">
                            <table class="table">
                                <thead>
                                    <tr class="cart-product-head">
                                        <th class="cart-product-name text-start">Produtos</th>
                                        <th class="cart-product-total text-end">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($cart->cartProducts as $cartProduct)
                                        @php $stockQuantity = $cartProduct->variation->stock_quantity @endphp
                                        <tr class="cart_item">
                                            <td class="cart-product-name text-start ps-0">
                                                {{--   <td class="product-thumbnail" width="100">--}}
                                                {{--       <img alt="" class="img-fluid" src="{{ $cartProduct->variation->image }}">--}}
                                                {{--   </td>--}}
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
                                                        <span class="amount">{{ $cartProduct->variation->final_price_formated }}</span>
                                                        @if ($cartProduct->variation->discount_percent > 0)
                                                            <br>
                                                            <del>
                                                                <small>
                                                                    <span class="amount">{{ $cartProduct->variation->value_formated }}</span>
                                                                </small>
                                                            </del>
                                                        @endif
                                                    </td>
                                                @endif
                                            </td>
                                            <td class="cart-product-total text-end pe-0">
                                                <span class="amount">{{ $cartProduct->subtotal_value_formated }}</span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2" class="text-center">Nenhum produto no carrinho</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                                <tfoot>
                                    <tr class="cart-subtotal">
                                        <th class="text-start ps-0">Subtotal</th>
                                        <td class="text-end pe-0"><span class="amount">{{ $cart->total_value_formated }}</span></td>
                                    </tr>
                                    <tr class="cart-subtotal">
                                        {{-- TODO fazer cálculo do frete nessa tela --}}
                                        <th class="text-start ps-0">Frete</th>
                                        <td class="text-end pe-0"><span class="amount">Selecione o endereço</span></td>
                                    </tr>
                                    <tr class="order-total">
                                        <th class="text-start ps-0">Total</th>
                                        <td class="text-end pe-0"><strong><span class="amount">{{ $cart->total_value_formated }}</span></strong></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
{{--                        <div class="payment-accordion-order-button">--}}
{{--                            <div class="payment-accordion">--}}
{{--                                <div class="single-payment">--}}
{{--                                    <h5 class="panel-title mb-3">--}}
{{--                                        <a class="collapse-off" data-bs-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">--}}
{{--                                           Boleto Bancário--}}
{{--                                        </a>--}}
{{--                                    </h5>--}}
{{--                                    <div class="collapse show" id="collapseExample">--}}
{{--                                        <div class="card card-body rounded-0">--}}
{{--                                            <p>Você poderá pagar em qualquer loteria, ou pelo aplicativo do seu banco. Seu pedido será confirmado após o periodo de compensação do boleto <strong>(Dois à 3 dias úteis)</strong>.</p>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="single-payment">--}}
{{--                                    <h5 class="panel-title mb-3">--}}
{{--                                        <a class="collapse-off" data-bs-toggle="collapse" href="#collapseExample-2" aria-expanded="false" aria-controls="collapseExample-2">--}}
{{--                                            Cartão de Crédito.--}}
{{--                                        </a>--}}
{{--                                    </h5>--}}
{{--                                    <div class="collapse" id="collapseExample-2">--}}
{{--                                        <div class="card card-body rounded-0">--}}
{{--                                            <div class="col-md-12">--}}
{{--                                                <div class="checkout-form-list">--}}
{{--                                                   <form action="">--}}
{{--                                                    <div class="card-wrapper"></div>--}}
{{--                                                    <label>Titular do Cartão <span class="required">*</span></label>--}}
{{--                                                    <input type="text" required id="nome_cartao">--}}
{{--                                                    <input class="form-control" placeholder="0000 0000 0000 0000" name="ccnumber" id="number">--}}
{{--                                                    <input type="text" name="ccmonth" id="ccmonth" class="form-control" placeholder="MM" maxlength="2" minlength="2" >--}}
{{--                                                    <input type="text"class="form-control" id="ccyear" name="ccyear" placeholder="AAAA">--}}
{{--                                                    <input class="form-control" id="cvv" name="cvv" type="number" placeholder="Dígito Verificador">--}}
{{--                                                   </form>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div class="order-button-payment">
                                <button class="btn btn-dark btn-hover-primary rounded-0 w-100">Finalizar Compra</button>
                            </div>
{{--                        </div>--}}
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
