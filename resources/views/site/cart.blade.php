@extends('site.main')

@section('content')
    <div class="section">
        <div class="breadcrumb-area bg-light">
            <div class="container-fluid">
                <div class="breadcrumb-content text-center">
                    <h1 class="title">Carrinho de Compras</h1>
                    <ul>
                        <li>
                            <a href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="active">Carrinho</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Shopping Cart Section Start -->
    <div class="section section-margin">
        <div class="container">
            <div class="row">
                <div class="col-12">

                    <!-- Cart Table Start -->
                    <div class="cart-table table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="pro-thumbnail">Image</th>
                                    <th class="pro-title">Produto</th>
                                    <th class="pro-price">Preço</th>
                                    <th class="pro-quantity">Quantidade</th>
                                    <th class="pro-subtotal">Total</th>
                                    <th class="pro-remove">Remover</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($cart->cartProducts as $cartProduct)
                                    @php $stockQuantity = $cartProduct->variation->stock_quantity; @endphp
                                    <tr>
                                        <td class="pro-thumbnail"><a href="#"><img class="img-fluid" src="{{ $cartProduct->variation->image }}" alt="Product" /></a></td>
                                        <td class="pro-title">
                                            <a href="{{ route('product.show', [$cartProduct->product->slug, $cartProduct->variation->id]) }}">
                                                {{ $cartProduct->product->name }} <br/>
                                                @foreach ($cartProduct->variation->items as $item)
                                                    {{ $item->productGrid->grid->description }}: {{ $item->gridVariation->description }} <br/>
                                                @endforeach
                                            </a>
                                        </td>
                                        <td class="pro-price"><span>R$ {{ $cartProduct->variation->value_formated }}</span></td>
                                        <td class="pro-quantity">
                                            <div class="quantity">
                                                <div class="cart-plus-minus">
                                                    <input class="cart-plus-minus-box" value="{{ $cartProduct->quantity }}" type="text">
                                                    <div class="dec qtybutton">-</div>
                                                    <div class="inc qtybutton">+</div>
                                                    <div class="dec qtybutton"><i class="fa fa-minus"></i></div>
                                                    <div class="inc qtybutton"><i class="fa fa-plus"></i></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="pro-subtotal">
                                            <span>
                                                R$ {{ $cartProduct->subtotal_value_formated }} 
                                                @if ($cartProduct->variation->discount_percent > 0)
                                                    <br/>
                                                    <small>Desconto de {{ $cartProduct->variation->discount_percent_formatted }}</small>
                                                @endif
                                            </span>
                                        </td>
                                        <td class="pro-remove"><a href="#"><i class="pe-7s-trash"></i></a></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">Nenhum produto no carrinho</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-5 ms-auto col-custom">
                    <div class="cart-calculator-wrapper">
                        <div class="cart-calculate-items">
                            <h3 class="title">Total</h3>
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <td>Subtotal</td>
                                        <td>$230</td>
                                    </tr>
                                    <tr>
                                        <td>Entrega</td>
                                        <td>-</td>
                                    </tr>
                                    <tr class="total">
                                        <td>Total</td>
                                        <td class="total-amount">{{ $cart->total_value_formated }}</td>
                                    </tr>
                                </table>
                            </div>
                            <!-- Responsive Table End -->

                        </div>
                        <!-- Cart Calculate Items End -->

                        <!-- Cart Checktout Button Start -->
                        <a href="#" id="btnFinalize" class="btn btn-dark btn-hover-primary rounded-0 w-100">Checkout <i class="fa fa-fw fa-arrow-right"></i></a>
                        <!-- Cart Checktout Button End -->

                    </div>
                    <!-- Cart Calculation Area End -->

                </div>
            </div>

        </div>
    </div>
    <!-- Shopping Cart Section End -->
@endsection

@push('js')
<script>
    $('#btnFinalize').click(() => {
        var teste = {
            "items": [],
            "customer": {},
            "payments": [
                {   
                    "amount" : 3000,
                    "payment_method":"checkout",
                    "checkout": {
                        "expires_in":120,
                        "billing_address_editable" : false,
                        "customer_editable" : true,
                        "accepted_payment_methods": ["credit_card"],
                        "success_url": "http://useladame.local/carrinho",
                        "credit_card": {}
                    }
                }
            ]
        };

        $.ajax({
            method: "POST",
            url: "https://api.pagar.me/core/v5/orders/",
            headers: {
                'Content-Type': 'application/json',
                'Authorization': 'Basic ak_test_BbNUx5jouhZpJnYLqURiQdPiXLpCIm',
                'Access-Control-Allow-Origin': 'http://useladame.local',
            },
            data: JSON.stringify(teste)
            })
            .done(function( msg ) {
                console.log(msg);
            });

        return false;
        // let response = await fetch('https://api.pagar.me/core/v5/orders/', {
        //         method: 'POST',
        //         headers: {
        //             'Content-Type': 'application/json',
        //             'Authorization': 'Basic ak_test_BbNUx5jouhZpJnYLqURiQdPiXLpCIm',
        //         },
        //         body: JSON.stringify({
        //                 "items": [],
        //                 "customer": {},
        //                 "payments": [
        //                     {   
        //                         "amount" : 3000,
        //                         "payment_method":"checkout",
        //                         "checkout": {
        //                             "expires_in":120,
        //                             "billing_address_editable" : false,
        //                             "customer_editable" : true,
        //                             "accepted_payment_methods": ["credit_card"],
        //                             "success_url": "http://useladame.local/carrinho",
        //                             "credit_card": {}
        //                         }
        //                     }
        //                 ]
        //             }),
        //     });

        //     if (response.ok) { // if HTTP-status is 200-299
        //     // get the response body (the method explained below)
        //     let json = await response.json();
        //     } else {
        //         alert("HTTP-Error: " + response.status);
        //     }
    });
</script>
@endpush