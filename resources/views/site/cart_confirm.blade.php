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
                        <div class="order-button-payment">
                            <button class="btn btn-dark btn-hover-primary rounded-0 w-100 btn-pay">Finalizar Compra</button>
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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="{{asset('useLadame/js/plugins/jquery.card.js')}}"></script>
    <script type="text/javascript" src="{{asset('useLadame/js/plugins/card.js')}}"></script>
    <script type="text/javascript" src="https://assets.pagar.me/checkout/1.1.0/checkout.js"></script>

    <script type="text/javascript">
        // TODO isso é necessário?
        // let card = new Card({
        //     form: 'form',
        //     container: '.card-wrapper',
        //     formSelectors: {
        //         nameInput: 'input#nome_cartao',
        //         numberInput: 'input#number',
        //         expiryInput: 'input#ccmonth, input#ccyear',
        //         cvcInput: 'input#cvv'
        //     }
        // });

        let button = document.querySelector('.btn-pay');

        button.addEventListener('click', () => {
            var checkout = new PagarMeCheckout.Checkout({
                encryption_key: 'ek_test_82pi8ALVpEwDL9cdx71PZzSKF4Pnv0',
                success: (data) => {
                    console.log(data);
                    alert('Deu certo!!! Criando pedido no banco de dados...');
                    // TODO chamar rota POST /carrinho/finalizar
                },
                error: (err) => {
                    console.log(err);
                },
            });

            checkout.open({
                amount: 10000,
                maxInstallments: 12,
                defaultInstallment: 1,
                customerData: 'true',
                createToken: 'true',
                paymentMethods: 'boleto,credit_card,pix',
                uiColor: '#1ea51c',
                boletoDiscountPercentage: 0,
                // TODO corrigir data do boleto -> deve ser de hoje até daqui 3 dias?
                boletoExpirationDate: '12/12/2022',
                postbackUrl: '{{ route('pagar_me.post_back') }}',
                items: [{
                    id: '1',
                    title: 'ItemZero',
                    unit_price: 10000,
                    quantity: 1,
                    tangible: 'false'
                }],
            });
        });
    </script>
@endpush
