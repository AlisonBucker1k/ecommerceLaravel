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
    <div class="section section-margin">
        <div class="container">
            <form method="get" action="{{ route('cart.confirm') }}">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="cart-table table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="pro-thumbnail">Imagem</th>
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
                                            <td class="pro-price"><span>{{ $cartProduct->variation->value_formated }}</span></td>
                                            <td class="--pro-quantity">
                                                @include('site.elements.product_quantity_form', ['cartProduct' => $cartProduct])
                                            </td>
                                            <td class="pro-subtotal">
                                                <span>
                                                    <p class="product-quantity">{{ $cartProduct->subtotal_value_formated }}</p>
                                                    @if ($cartProduct->variation->discount_percent > 0)
                                                        <br/>
                                                        <small>Desconto de {{ $cartProduct->variation->discount_percent_formatted }}</small>
                                                    @endif
                                                </span>
                                            </td>
                                            <td class="pro-remove">
                                                <a href="{{ route('cart.product.remove', $cartProduct->id) }}">
                                                    <i class="pe-7s-trash"></i>
                                                </a>
                                            </td>
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
                                <h3 class="title">Finalizar Compra</h3>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <td>Subtotal</td>
                                            <td>{{ $cart->total_value_formated }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-dark btn-hover-primary rounded-0 w-100">Checkout <i class="fa fa-fw fa-arrow-right"></i></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
