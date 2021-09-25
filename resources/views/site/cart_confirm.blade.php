@extends('site.main')
@section('content')
   <!-- Breadcrumb Section Start -->
   <div class="section">

    <!-- Breadcrumb Area Start -->
    <div class="breadcrumb-area bg-light">
        <div class="container-fluid">
            <div class="breadcrumb-content text-center">
                <h1 class="title">Finalizar Pedido</h1>
                <ul>
                    <li>
                        <a href={{route('home')}}">Home </a>
                    </li>
                    <li class="active"> Finalizar Pedido</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area End -->

</div>
<!-- Breadcrumb Section End -->

<!-- Checkout Section Start -->
<div class="section section-margin">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- Coupon Accordion Start -->
                <div class="coupon-accordion">

                    <!-- Title Start -->
                    {{-- <h3 class="title">Returning customer? <span id="showlogin">Click here to login</span></h3> --}}
                    <!-- Title End -->

                    <!-- Checkout Login Start --
                    <div id="checkout-login" class="coupon-content">
                        <div class="coupon-info">
                            <p class="coupon-text mb-2">Já é cliente? Faça login para prosseguir</p>

                            <!-- Form Start --
                            <form action="#">
                                <!-- Input Email Start --
                                <p class="form-row-first">
                                    <label>Username or email <span class="required">*</span></label>
                                    <input type="text">
                                </p>
                                <!-- Input Email End --

                                <!-- Input Password Start --
                                <p class="form-row-last">
                                    <label>Password <span class="required">*</span></label>
                                    <input type="password">
                                </p>
                                <!-- Input Password End --

                                <!-- Remember Password Start --
                                <p class="form-row mb-2">
                                    <input type="checkbox" id="remember_me">
                                    <label for="remember_me" class="checkbox-label">Remember me</label>
                                </p>
                                <!-- Remember Password End -->

                                <!-- Lost Password Start --
                                <p class="lost-password"><a href="#">Lost your password?</a></p>
                                <!-- Lost Password End --

                            </form>
                            <!-- Form End --

                        </div>
                    </div>
                    <!-- Checkout Login End -->

                    <!-- Title Start -->
                    <h3 class="title">Tem um cupom de desconto?<span id="showcoupon">Clique aqui para inseri-lo</span></h3>
                    <!-- Title End -->

                    <!-- Checkout Coupon Start -->
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
                    <!-- Checkout Coupon End -->

                </div>
                <!-- Coupon Accordion End -->
            </div>
        </div>
        <div class="row mb-n4">
            <div class="col-lg-6 col-12 mb-4">

                <!-- Checkbox Form Start -->
                <form action="#">
                    <div class="checkbox-form">

                        <!-- Checkbox Form Title Start -->
                        <h3 class="title">Informações do comprador</h3>
                        <!-- Checkbox Form Title End -->

                        <div class="row">

                            <!-- Select Country Name Start -->
                            <div class="col-md-12 mb-6">
                                <div class="country-select">
                                    <label>País <span class="required">*</span></label>
                                    <select class="myniceselect nice-select wide rounded-0" disabled>
                                        <option data-display="Bangladesh">Brasil</option>
                                    </select>
                                </div>
                            </div>
                            <!-- Select Country Name End -->

                            <!-- First Name Input Start -->
                            <div class="col-md-6">
                                <div class="checkout-form-list">
                                    <label>Nome <span class="required">*</span></label>
                                    <input placeholder="" type="text">
                                </div>
                            </div>
                            <!-- First Name Input End -->

                            <!-- Last Name Input Start -->
                            <div class="col-md-6">
                                <div class="checkout-form-list">
                                    <label>Sobrenome <span class="required">*</span></label>
                                    <input placeholder="" type="text">
                                </div>
                            </div>
                            <!-- Last Name Input End -->

                            <!-- Company Name Input Start -->
                           
                            <!-- Company Name Input End -->

                            <!-- Address Input Start -->
                            <div class="col-md-12">
                                <div class="checkout-form-list">
                                    <label>Rua <span class="required">*</span></label>
                                    <input placeholder="Street address" type="text">
                                </div>
                            </div>
                            <!-- Address Input End -->

                            <!-- Optional Text Input Start -->
                            <div class="col-md-12">
                                <div class="checkout-form-list">
                                    <input placeholder="Apartment, suite, unit etc. (optional)" type="text">
                                </div>
                            </div>
                            <!-- Optional Text Input End -->

                            <!-- Town or City Name Input Start -->
                            <div class="col-md-12">
                                <div class="checkout-form-list">
                                    <label>Cidade <span class="required">*</span></label>
                                    <input type="text">
                                </div>
                            </div>
                            <!-- Town or City Name Input End -->

                            <!-- State or Country Input Start -->
                            <div class="col-md-6">
                                <div class="checkout-form-list">
                                    <label>Estado <span class="required">*</span></label>
                                    <input placeholder="" type="text">
                                </div>
                            </div>
                            <!-- State or Country Input End -->

                            <!-- Postcode or Zip Input Start -->
                            <div class="col-md-6">
                                <div class="checkout-form-list">
                                    <label>CEP <span class="required">*</span></label>
                                    <input placeholder="" type="text">
                                </div>
                            </div>
                            <!-- Postcode or Zip Input End -->

                            <!-- Email Address Input Start -->
                            <div class="col-md-6">
                                <div class="checkout-form-list">
                                    <label>Seu E-mail <span class="required">*</span></label>
                                    <input placeholder="" type="email">
                                </div>
                            </div>
                            <!-- Email Address Input End -->

                            <!-- Phone Number Input Start -->
                            <div class="col-md-6">
                                <div class="checkout-form-list">
                                    <label>Telefone <span class="required">*</span></label>
                                    <input type="text">
                                </div>
                            </div>
                            <!-- Phone Number Input End -->

                            <!-- Checkout Form List checkbox Start -->
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
                            <!-- Checkout Form List checkbox End -->

                        </div>

                        <!-- Different Address Start -->
                        <div class="different-address">
                            <!-- Ship Different Title Checkbox Start -->
                            <div class="ship-different-title">
                                {{-- <div>
                                    <input id="ship-box" type="checkbox">
                                    <label for="ship-box" class="checkbox-label">Ship to a different address?</label>
                                </div> --}}
                            </div>
                            <!-- Ship Different Title Checkbox End -->

                            <!-- Ship Box Info Start -->
                            <div id="ship-box-info" class="row mt-2">

                                <!-- Select Country Name Start -->
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
                                <!-- Select Country Name End -->

                                <!-- First Name Input Start -->
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>First Name <span class="required">*</span></label>
                                        <input placeholder="" type="text">
                                    </div>
                                </div>
                                <!-- First Name Input End -->

                                <!-- Last Name Input Start -->
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Last Name <span class="required">*</span></label>
                                        <input placeholder="" type="text">
                                    </div>
                                </div>
                                <!-- Last Name Input End -->

                                <!-- Company Name Start -->
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Company Name</label>
                                        <input placeholder="" type="text">
                                    </div>
                                </div>
                                <!-- Company Name End -->

                                <!-- Address Input Start -->
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Address <span class="required">*</span></label>
                                        <input placeholder="Street address" type="text">
                                    </div>
                                </div>
                                <!-- Address Input End -->

                                <!-- Optional Text Start -->
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <input placeholder="Apartment, suite, unit etc. (optional)" type="text">
                                    </div>
                                </div>
                                <!-- Optional Text End -->

                                <!-- Town or City Input Start -->
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Town / City <span class="required">*</span></label>
                                        <input type="text">
                                    </div>
                                </div>
                                <!-- Town or City Input End -->

                                <!-- State or Country Input Start -->
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>State / County <span class="required">*</span></label>
                                        <input placeholder="" type="text">
                                    </div>
                                </div>
                                <!-- State or Country Input End -->

                                <!-- Postcode or Zip Input Start -->
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Postcode / Zip <span class="required">*</span></label>
                                        <input placeholder="" type="text">
                                    </div>
                                </div>
                                <!-- Postcode or Zip Input End -->

                                <!-- Email Address Input Start -->
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Email Address <span class="required">*</span></label>
                                        <input placeholder="" type="email">
                                    </div>
                                </div>
                                <!-- Email Address Input End -->

                                <!-- Phone Number Input Start -->
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Phone <span class="required">*</span></label>
                                        <input type="text">
                                    </div>
                                </div>
                                <!-- Phone Number Input End -->

                            </div>
                            <!-- Ship Box Info End -->

                            <!-- Order Notes Textarea Start -->
                            {{-- <div class="order-notes mt-3 mb-n2">
                                <div class="checkout-form-list checkout-form-list-2">
                                    <label>Order Notes</label>
                                    <textarea id="checkout-mess" cols="30" rows="10" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                </div>
                            </div> --}}
                            <!-- Order Notes Textarea End -->

                        </div>
                        <!-- Different Address End -->
                    </div>
                </form>
                <!-- Checkbox Form End -->

            </div>

            <div class="col-lg-6 col-12 mb-4">

                <!-- Your Order Area Start -->
                <div class="your-order-area border">

                    <!-- Title Start -->
                    <h3 class="title">Seu Pedido</h3>
                    <!-- Title End -->

                    <!-- Your Order Table Start -->
                    <div class="your-order-table table-responsive">
                        <table class="table">

                            <!-- Table Head Start -->
                            <thead>
                                <tr class="cart-product-head">
                                    <th class="cart-product-name text-start">Produto</th>
                                    <th class="cart-product-total text-end">Total</th>
                                </tr>
                            </thead>
                            <!-- Table Head End -->

                            <!-- Table Body Start -->
                            <tbody>
                                <tr class="cart_item">
                                    <td class="cart-product-name text-start ps-0"> Some Winter Collections<strong class="product-quantity"> × 2</strong></td>
                                    <td class="cart-product-total text-end pe-0"><span class="amount">£145.00</span></td>
                                </tr>
                                <tr class="cart_item">
                                    <td class="cart-product-name text-start ps-0"> Small Scale Style<strong class="product-quantity"> × 4</strong></td>
                                    <td class="cart-product-total text-end pe-0"><span class="amount">£204.00</span></td>
                                </tr>
                            </tbody>
                            <!-- Table Body End -->

                            <!-- Table Footer Start -->
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
                            <!-- Table Footer End -->

                        </table>
                    </div>
                    <!-- Your Order Table End -->

                    <!-- Payment Accordion Order Button Start -->
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
                                        <div class="card-wrapper"></div>
                                        <div class="col-md-12">
                                            <div class="checkout-form-list">
                                               <form action="">
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
                            <button class="btn btn-dark btn-hover-primary rounded-0 w-100">Place Order</button>
                        </div>
                    </div>
                    <!-- Payment Accordion Order Button End -->
                </div>
                <!-- Your Order Area End -->
            </div>
        </div>
    </div>
</div>
<!-- Checkout Section End -->
@endsection

@push('css')
    <link rel="stylesheet" href="{{asset('useLadame/css/card.css')}}">
@endpush
@push('js')
    <script src="{{asset('useLadame/js/plugins/jquery.card.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.11.2/jquery.mask.min.js" integrity="sha512-Y/GIYsd+LaQm6bGysIClyez2HGCIN1yrs94wUrHoRAD5RSURkqqVQEU6mM51O90hqS80ABFTGtiDpSXd2O05nw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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