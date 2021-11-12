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
                                            <td class="pro-thumbnail"><a href="#"><img width="100px" class="img-fluid" src="{{ getFullFtpUrl($cartProduct->variation->image) }}" alt="{{ $cartProduct->product->name }}" /></a></td>
                                            <td class="pro-title">
                                                <a href="{{ route('product.show', [$cartProduct->product->slug, $cartProduct->variation->id]) }}">
                                                    {{ $cartProduct->product->name }} <br/>
                                                    @foreach ($cartProduct->variation->items as $item)
                                                        {{ $item->productGrid->grid->description }}: {{ $item->gridVariation->description }} <br/>
                                                    @endforeach
                                                </a>
                                            </td>
                                            <td class="pro-price"><span>{{ $cartProduct->variation->final_price_formated }}</span></td>
                                            <td class="--pro-quantity">
                                                <div class="quantity mb-5">
                                                    <form id="product-quantity-form" action="{{ route('cart_product.change_quantity', [$cartProduct->id]) }}" method="post">
                                                        <div class="cart-plus-minus">
                                                            <input class="cart-plus-minus-box new-quantity-input" value="{{ $cartProduct->quantity }}" type="number" name="quantity" minlength="0">
                                                            <a href="#" class="dec qtybutton decrease-quantity">
                                                                <i class="fa fa-minus"></i>
                                                            </a>
                                                            <a href="#" class="inc qtybutton increase-quantity">
                                                                <i class="fa fa-plus"></i>
                                                            </a>
                                                        </div>
                                                    </form>
                                                </div>
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

@push('js')
    <script>
        async function changeQuantity(quantity) {
            let form = new FormData();
            form.append('new_quantity', quantity);

            await fetch('{{ route('cart_product.change_quantity', [$cartProduct->id]) }}', {
                method: 'post',
                body: form,
                headers: {
                    'X-CSRF-Token':  '{{ csrf_token() }}'
                },
            }).then(response => {
                return response.json();
            }).then(data => {
                if (data.error) {
                    alert(data.message);
                    return false;
                }

                location.reload();
            });
        }

        let btnDecreaseQuantity = document.querySelector('.decrease-quantity');
        btnDecreaseQuantity.addEventListener('click', async event => {
            event.preventDefault();

            inputQuantity.value--;
            if (inputQuantity.value == 0) {
                if (!confirm('Deseja remover o produto?')) {
                    inputQuantity.value++;
                    return false;
                }
            }

            await changeQuantity(inputQuantity.value);
        });

        let btnIncreaseQuantity = document.querySelector('.increase-quantity');
        btnIncreaseQuantity.addEventListener('click', async event => {
            event.preventDefault();
            inputQuantity.value++;
            await changeQuantity(inputQuantity.value);
        });

        let inputQuantity = document.querySelector('.new-quantity-input');
        inputQuantity.addEventListener('blur', async event => {
            event.preventDefault();
            changeQuantity(inputQuantity.value);
        });
    </script>
@endpush
