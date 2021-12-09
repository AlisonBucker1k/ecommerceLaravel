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
                                            <option @if($address->main == \App\Enums\AddressMain::YES) selected="selected" @endif value="{{ $address->id }}" data-cep="{{ $address->postal_code }}" data-address="{{ $address }}">
                                                {{ $address->complete_address }}
                                            </option>
                                        @endforeach
                                    </select>
                                @else
                                    Nenhum endereço cadastrado
                                @endif
                            </div>
                        </div>
                        <div class="form-row mt-5">
                            <div class="form-group col-8">
                                <div id="shipping-options"></div>
                            </div>
                            <div class="form-group col-4 text-right mb-5">
                                <a href="#" class="btn btn-primary btn-modern text-uppercase btn-form-address">
                                    Novo Endereço <i class="fa fa-caret-down"></i>
                                </a>
                            </div>
                            <div class="address-form d-none">
                                <div class="create-address contact-form-wrapper">
                                    <form id="address-form" method="post">
                                        <input type="hidden" name="address_id" value="{{ $address->id ?? '' }}">
                                        <div class="form-group row">
                                            <div class="col-lg-4">
                                                <label>CEP</label>
                                                <input name="cep" id="cep" class="cep form-control" type="text" value="{{ old('cep') }}" onblur="findCep(this.value);" required="required">
                                            </div>
                                            <div class="col-lg-8">
                                                <label>Endereço</label>
                                                <input name="street" id="street" class="form-control" type="text" value="{{ old('street') }}" placeholder="" required="required">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-6">
                                                <label>Complemento</label>
                                                <input name="complement" class="form-control" type="text" value="{{ old('complement') }}" placeholder="">
                                            </div>
                                            <div class="col-lg-6">
                                                <label>Referência</label>
                                                <input name="reference" class="form-control" type="text" value="{{ old('reference') }}" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-3">
                                                <label>Número</label>
                                                <input name="number" class="form-control" type="text" value="{{ old('number') }}">
                                            </div>
                                            <div class="col-lg-3">
                                                <label>Cidade</label>
                                                <input name="city" id="city" class="form-control" type="text" value="{{ old('city') }}" required="required">
                                            </div>
                                            <div class="col-lg-3">
                                                <label>Estado</label>
                                                <input name="state" id="uf" class="form-control" type="text" value="{{ old('state') }}" required="required">
                                            </div>
                                            <div class="col-lg-3">
                                                <label>Bairro</label>
                                                <input name="district" id="district" class="form-control" type="text" value="{{ old('district') }}" required="required">
                                            </div>
                                        </div>
                                        <div class="row mt-5">
                                            <div class="col-12">
                                                <button type="submit" id="btn-add-address" name="submit" class="btn btn-dark btn-hover-primary rounded-0">Salvar</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                @push('js')
                                    <script>
                                        var addressForm = document.getElementById('address-form');
                                        addressForm.addEventListener('submit', async event => {
                                            event.preventDefault();

                                            var btn = $('#btn-add-address');
                                            btn
                                                .attr({'disabled': 'disabled'})
                                                .prepend($('<span>')
                                                    .addClass('fa fa-fw fa-spin fa-spinner loading'), ' ');

                                            await fetch('{{ route('panel.address.store.json') }}', {
                                                method: 'post',
                                                body: new FormData(addressForm),
                                                headers: {
                                                    'X-CSRF-Token':  '{{ csrf_token() }}'
                                                },
                                            }).then(response => {
                                                return response.json();
                                            }).then(data => {
                                                $('#address').append(
                                                    $('<option>')
                                                        .val(data.address.id)
                                                        .text(data.complete_address)
                                                        .attr({'data-cep': data.address.postal_code_formatted})
                                                        .attr({'data-address': JSON.stringify(data.address)})
                                                        .prop('selected', 'selected')
                                                );

                                                $('#address').change();

                                                addressForm.classList.add('d-none');
                                                btnAddressForm.innerHTML = 'Novo endereço <i class="fa fa-caret-down"></i>';

                                                alert('Endereço criado com sucesso!');
                                            });
                                        });

                                        function clearForm() {
                                            document.getElementById('district').value = ('');
                                            document.getElementById('city').value = ('');
                                            document.getElementById('street').value = ('');
                                            document.getElementById('uf').value = ('');
                                        }

                                        function callback(data) {
                                            if (!("erro" in data)) {
                                                document.getElementById('district').value=(data.bairro);
                                                document.getElementById('city').value=(data.localidade);
                                                document.getElementById('street').value=(data.logradouro);
                                                document.getElementById('uf').value=(data.uf);
                                            } else {
                                                clearForm();
                                                toastr.error("CEP não encontrado.");
                                            }
                                        }

                                        function findCep(valor) {
                                            var cep = valor.replace(/\D/g, '');
                                            if (!cep != '') {
                                                clearForm();
                                                return false;
                                            }

                                            var cepValidate = /^[0-9]{8}$/;
                                            if (!cepValidate.test(cep)) {
                                                clearForm();
                                                alert('Formato de CEP inválido.');

                                                return false;
                                            }

                                            document.getElementById('district').value = '...';
                                            document.getElementById('city').value = '...';
                                            document.getElementById('street').value = '...';
                                            document.getElementById('uf').value = '...';

                                            var script = document.createElement('script');
                                            script.src = `https://viacep.com.br/ws/${cep}/json/?callback=callback`;
                                            document.body.appendChild(script);
                                        }
                                    </script>
                                @endpush

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
                                        <th class="text-start ps-0">Frete</th>
                                        <td class="text-end pe-0"><span id="shipping-value">Selecione o endereço</span></td>
                                    </tr>
                                    <tr class="order-total">
                                        <th class="text-start ps-0">Total</th>
                                        <td class="text-end pe-0"><strong><span id="total-value">{{ $cart->total_value_formated }}</span></strong></td>
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
        let button = document.querySelector('.btn-pay');
        button.addEventListener('click', () => {
            let isShippingSelected = $('.form-check-input:checked').length > 0;
            if (!isShippingSelected) {
                alert('Selecione uma opção de entrega.');
                return false;
            }

            var checkout = new PagarMeCheckout.Checkout({
                encryption_key: 'ek_test_82pi8ALVpEwDL9cdx71PZzSKF4Pnv0',
                success: (response) => {
                    let formData = new FormData();
                    formData.append('transaction_token', response.token);
                    formData.append('address_id', $('#address').val());
                    formData.append('shipping_id', $('.form-check-input:checked').val());

                    $.ajax({
                        type: 'post',
                        url: '{{ route('cart.confirm') }}',
                        data: formData,
                        processData: false,
                        contentType: false,
                        headers: {
                            'X-CSRF-Token':  '{{ csrf_token() }}'
                        },
                        success: function(data) {
                            if (data.error) {
                                alert(data.message);
                                return false;
                            }

                            window.location = data.redirect_url;
                        }
                    });
                },
                error: (error) => {
                    console.log(error);
                },
            });

            let totalValueInCents = parseInt($('#total-value').text().replace(/\D/g, ''));
            let selectedAddress = $('#address option:selected').data('address');
            let addressComplement = selectedAddress.complement ? selectedAddress.complement : '-';

            let shippingFeeInCents = parseInt($('#shipping-value').text().replace(/\D/g, ''));
            if (typeof shippingFeeInCents == NaN) {
                shippingFeeInCents = parseInt('1,00');
            }

            let items = [];
            @foreach($cartProducts as $cartProduct)
                items.push({
                    id: {{ $cartProduct->product->id }},
                    title: '{{ $cartProduct->product->name }}',
                    unit_price: {{ getOnlyNumber($cartProduct->variation->value) }},
                    quantity: {{ $cartProduct->quantity }},
                    tangible: 'true',
                });
            @endforeach

            checkout.open({
                items: items,
                amount: totalValueInCents,
                maxInstallments: 3,
                defaultInstallment: 1,
                customerData: 'false',
                createToken: 'true',
                paymentMethods: 'boleto,credit_card',
                uiColor: '#1ea51c',
                boletoDiscountPercentage: 0,
                boleto_expiration_date: '{{ $billExpirationDate }}',
                postbackUrl: '{{ route('pagar_me.post_back') }}',
                customer: {
                    external_id: {{ $customer->id }},
                    name: '{{ $customer->profile->getFullNameShort() }}',
                    type: 'individual',
                    country: selectedAddress.country.toLowerCase(),
                    email: '{{ $customer->email }}',
                    birthday: '{{ $customer->profile->birth_date }}',
                    documents: [
                        {
                            type: 'cpf',
                            number: '{{ getOnlyNumber($customer->profile->cpf) }}',
                        },
                    ],
                    phone_numbers: [
                        '{{ $customer->profile->cellphone }}',
                    ],
                },
                billing: {
                    name: '{{ $customer->profile->getFullNameShort() }}',
                    address: {
                        street: selectedAddress.street,
                        street_number: selectedAddress.number,
                        zipcode: selectedAddress.postal_code.replace(/\D/g, ''),
                        country: selectedAddress.country.toLowerCase(),
                        state: selectedAddress.state,
                        city: selectedAddress.city,
                        neighborhood: selectedAddress.district,
                        complementary: addressComplement,
                    },
                },
                shipping: {
                    name: '{{ $customer->profile->getFullNameShort() }}',
                    fee: shippingFeeInCents,
                    address: {
                        street: selectedAddress.street,
                        street_number: selectedAddress.number,
                        zipcode: selectedAddress.postal_code.replace(/\D/g, ''),
                        country: selectedAddress.country.toLowerCase(),
                        state: selectedAddress.state,
                        city: selectedAddress.city,
                        neighborhood: selectedAddress.district,
                        complementary: addressComplement,
                    },
                },
            });
        });
    </script>

    <script type="text/javascript">
        localeSettings = {
            minimumFractionDigits: 2,
            style: 'currency',
            currency: 'BRL',
        };

        var btnAddressForm = document.querySelector('.btn-form-address');
        btnAddressForm.addEventListener('click', (event) => {
            event.preventDefault();

            var addressForm = document.querySelector('.address-form');
            if (addressForm.classList.contains('d-none')){
                addressForm.classList.remove('d-none');
                btnAddressForm.innerHTML = 'Novo endereço <i class="fa fa-caret-up"></i>';
            } else {
                addressForm.classList.add('d-none');
                btnAddressForm.innerHTML = 'Novo endereço <i class="fa fa-caret-down"></i>';
            }
        });

        function calculateShipping(cep) {
            $('#shipping-value').html('-');
            $('#total-value').html('-');
            $('#btn-create-order').attr({'disabled': 'disabled'});

            let shippingOptions = $('#shipping-options');
            shippingOptions.html('');

            $.ajax({
                type: 'get',
                url: '{{ route('cart.product.freight') }}',
                dataType: 'json',
                data: { cep: cep },
                beforeSend: function () {
                    let btn = $('#btn-add-address');
                    shippingOptions.attr({'disabled': 'disabled'}).prepend(
                        $('<div>').addClass('loading-shipping-calculate').append(
                            $('<span>').addClass('fa fa-fw fa-spin fa-spinner').text(),
                            ' Calculando...'
                        )
                    );
                },
                complete: function () {
                    shippingOptions.removeAttr('disabled').children('.loading-shipping-calculate').remove();
                },
                success: function (data) {
                    $('#btn-calculate-freight').html('Calcular').removeAttr('disabled');

                    if (data.error === true) {
                        alert(data.message);
                        $('#shipping-value').html('-');
                        $('#total-value').html('-');
                        shippingOptions.addClass('d-none');

                        return false;
                    }

                    for (let shippingType in data) {
                        let dataShipping = data[shippingType];
                        let value = dataShipping.value;
                        var brlValue = 'Grátis';
                        if (value > 0) {
                            brlValue = value.toLocaleString('pt-BR', localeSettings);
                        }

                        let html = dataShipping.description + ' - <strong class="value">' + brlValue + '</strong>';
                        if (!dataShipping.deadline == 0) {
                            html += ' - Prazo: ' + dataShipping.deadline + ' dias úteis';
                        }

                        if (typeof dataShipping.warning != undefined && dataShipping.warning != '') {
                            html += `<br/><small><i class="pe-7s-attention"></i> ${dataShipping.warning}</small>`;
                        }

                        shippingOptions.append(
                            $('<div>').addClass('mb-5 form-check').append(
                                $('<input>').addClass('form-check-input').attr({
                                    'type': 'radio',
                                    'name': 'shipping_id',
                                    'id': 'type' + shippingType,
                                    'data-value': dataShipping.value
                                }).val(shippingType),

                                $('<label>')
                                    .addClass('form-check-label')
                                    .attr({'for': 'type' + shippingType})
                                    .html(html)
                            )
                        );
                    }
                }
            });
        }

        function handleErrors(data) {
            let responseJson = data.responseJSON;
            if (typeof responseJson.errors !== 'object' && responseJson.message !== undefined) {
                alert(responseJson.message);

                return;
            }

            let errors = responseJson.errors;
            for (let field in errors) {
                alert(errors[field][0]);
            }
        }

        {{--$('#form-add-address').submit(function(e) {--}}
        {{--    e.preventDefault();--}}

        {{--    let btn = $('#btn-add-address');--}}
        {{--    btn.attr({'disabled': 'disabled'}).prepend(--}}
        {{--        $('<span>').addClass('fa fa-fw fa-spin fa-spinner loading'), ' '--}}
        {{--    );--}}

        {{--    $.ajax({--}}
        {{--        url: '{{ route('panel.address.store.json') }}',--}}
        {{--        type: 'POST',--}}
        {{--        dataType: 'json',--}}
        {{--        data: $(this).serialize(),--}}
        {{--        complete: function (data) {--}}
        {{--            btn.removeAttr('disabled').children('.loading').remove();--}}
        {{--        },--}}
        {{--        success: function (data) {--}}
        {{--            $('#address').append(--}}
        {{--                $('<option>')--}}
        {{--                    .val(data.id)--}}
        {{--                    .text(data.complete_address)--}}
        {{--                    .attr({'data-cep': data.postal_code})--}}
        {{--                    .prop('selected', 'selected')--}}
        {{--            );--}}

        {{--            addressForm.classList.add('d-none');--}}
        {{--            btnAddressForm.innerHTML = 'Novo endereço <i class="fa fa-caret-down"></i>';--}}

        {{--            calculateShipping(data.postal_code);--}}
        {{--            alert('Endereço criado com sucesso!');--}}
        {{--        },--}}
        {{--        error: function (data) {--}}
        {{--            handleErrors(data)--}}
        {{--        }--}}
        {{--    });--}}

        {{--    return false;--}}
        {{--});--}}

        $(document).on('change', '.form-check-input', function () {
            let value = parseFloat($(this).attr('data-value'));
            let subtotal = parseFloat('{{ $cart->total_value }}');
            let totalValue = value + subtotal;
            let shippingValue = 'Grátis';
            if (value > 0) {
                shippingValue = value.toLocaleString('pt-BR', localeSettings);
            }

            $('#shipping-value').html(shippingValue);
            $('#total-value').html(totalValue.toLocaleString('pt-BR', localeSettings));
            $('#btn-create-order').removeAttr('disabled');
        });

        $('#address').change(function () {
            let cep = $(this).children('option:selected').attr('data-cep');
            if (typeof cep == undefined || cep == '') {
                return false;
            }

            calculateShipping(cep);
        });

        let cep = $('#address option:selected').attr('data-cep');
        if (cep !== undefined && cep !== '') {
            calculateShipping(cep);
        }
    </script>
@endpush
