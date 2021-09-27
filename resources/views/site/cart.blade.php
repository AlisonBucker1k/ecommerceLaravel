@extends('site.main')
@section('content')
    <!-- Breadcrumb Section Start -->
    <div class="section">

        <!-- Breadcrumb Area Start -->
        <div class="breadcrumb-area bg-light">
            <div class="container-fluid">
                <div class="breadcrumb-content text-center">
                    <h1 class="title">Shopping Cart</h1>
                    <ul>
                        <li>
                            <a href="index.html">Home </a>
                        </li>
                        <li class="active"> Shopping Cart</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Breadcrumb Area End -->

    </div>
    <!-- Breadcrumb Section End -->

    <!-- Shopping Cart Section Start -->
    <div class="section section-margin">
        <div class="container">

            <div class="row">
                <div class="col-12">

                    <!-- Cart Table Start -->
                    <div class="cart-table table-responsive">
                        <table class="table table-bordered">

                            <!-- Table Head Start -->
                            <thead>
                                <tr>
                                    <th class="pro-thumbnail">Image</th>
                                    <th class="pro-title">Product</th>
                                    <th class="pro-price">Price</th>
                                    <th class="pro-quantity">Quantity</th>
                                    <th class="pro-subtotal">Total</th>
                                    <th class="pro-remove">Remove</th>
                                </tr>
                            </thead>
                            <!-- Table Head End -->

                            <!-- Table Body Start -->
                            <tbody>
                                <tr>
                                    <td class="pro-thumbnail"><a href="#"><img class="img-fluid" src="assets/images/products/small-product/1.jpg" alt="Product" /></a></td>
                                    <td class="pro-title"><a href="#">Brother Hoddies in Grey <br> s / green</a></td>
                                    <td class="pro-price"><span>$95.00</span></td>
                                    <td class="pro-quantity">
                                        <div class="quantity">
                                            <div class="cart-plus-minus">
                                                <input class="cart-plus-minus-box" value="0" type="text">
                                                <div class="dec qtybutton">-</div>
                                                <div class="inc qtybutton">+</div>
                                                <div class="dec qtybutton"><i class="fa fa-minus"></i></div>
                                                <div class="inc qtybutton"><i class="fa fa-plus"></i></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="pro-subtotal"><span>$95.00</span></td>
                                    <td class="pro-remove"><a href="#"><i class="pe-7s-trash"></i></a></td>
                                </tr>
                                <tr>
                                    <td class="pro-thumbnail"><a href="#"><img class="img-fluid" src="assets/images/products/small-product/2.jpg" alt="Product" /></a></td>
                                    <td class="pro-title"><a href="#">Basic Jogging Shorts <br> Blue</a></td>
                                    <td class="pro-price"><span>$75.00</span></td>
                                    <td class="pro-quantity">
                                        <div class="quantity">
                                            <div class="cart-plus-minus">
                                                <input class="cart-plus-minus-box" value="0" type="text">
                                                <div class="dec qtybutton">-</div>
                                                <div class="inc qtybutton">+</div>
                                                <div class="dec qtybutton"><i class="fa fa-minus"></i></div>
                                                <div class="inc qtybutton"><i class="fa fa-plus"></i></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="pro-subtotal"><span>$75.00</span></td>
                                    <td class="pro-remove"><a href="#"><i class="pe-7s-trash"></i></a></td>
                                </tr>
                                <tr>
                                    <td class="pro-thumbnail"><a href="#"><img class="img-fluid" src="assets/images/products/small-product/10.jpg" alt="Product" /></a></td>
                                    <td class="pro-title"><a href="#">Lust For Life <br> Bulk/S</a></td>
                                    <td class="pro-price"><span>$295.00</span></td>
                                    <td class="pro-quantity">
                                        <div class="quantity">
                                            <div class="cart-plus-minus">
                                                <input class="cart-plus-minus-box" value="0" type="text">
                                                <div class="dec qtybutton">-</div>
                                                <div class="inc qtybutton">+</div>
                                                <div class="dec qtybutton"><i class="fa fa-minus"></i></div>
                                                <div class="inc qtybutton"><i class="fa fa-plus"></i></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="pro-subtotal"><span>$295.00</span></td>
                                    <td class="pro-remove"><a href="#"><i class="pe-7s-trash"></i></a></td>
                                </tr>
                                <tr>
                                    <td class="pro-thumbnail"><a href="#"><img class="img-fluid" src="assets/images/products/small-product/4.jpg" alt="Product" /></a></td>
                                    <td class="pro-title"><a href="#">Simple Woven Fabrics</a></td>
                                    <td class="pro-price"><span>$60.00</span></td>
                                    <td class="pro-quantity">
                                        <div class="quantity">
                                            <div class="cart-plus-minus">
                                                <input class="cart-plus-minus-box" value="2" type="text">
                                                <div class="dec qtybutton">-</div>
                                                <div class="inc qtybutton">+</div>
                                                <div class="dec qtybutton"><i class="fa fa-minus"></i></div>
                                                <div class="inc qtybutton"><i class="fa fa-plus"></i></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="pro-subtotal"><span>$110.00</span></td>
                                    <td class="pro-remove"><a href="#"><i class="pe-7s-trash"></i></a></td>
                                </tr>
                            </tbody>
                            <!-- Table Body End -->

                        </table>
                    </div>
                    <!-- Cart Table End -->

                    <!-- Cart Update Option Start -->
                    <div class="cart-update-option d-block d-md-flex justify-content-between">

                        <!-- Apply Coupon Wrapper Start -->
                        <div class="apply-coupon-wrapper">
                            <form action="{{ route('cart.confirm') }}" method="post" class=" d-block d-md-flex">
                                @csrf
                                <button class="btn btn-dark btn-hover-primary rounded-0">FINALIZAR!!!!</button>
                            </form>
                        </div>
                        <!-- Apply Coupon Wrapper End -->

                        <!-- Cart Update Start -->
                        <div class="cart-update mt-sm-16">
                            <a href="#" class="btn btn-dark btn-hover-primary rounded-0">Update Cart</a>
                        </div>
                        <!-- Cart Update End -->

                    </div>
                    <!-- Cart Update Option End -->

                </div>
            </div>

            <div class="row">
                <div class="col-lg-5 ms-auto col-custom">

                    <!-- Cart Calculation Area Start -->
                    <div class="cart-calculator-wrapper">

                        <!-- Cart Calculate Items Start -->
                        <div class="cart-calculate-items">

                            <!-- Cart Calculate Items Title Start -->
                            <h3 class="title">Cart Totals</h3>
                            <!-- Cart Calculate Items Title End -->

                            <!-- Responsive Table Start -->
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <td>Sub Total</td>
                                        <td>$230</td>
                                    </tr>
                                    <tr>
                                        <td>Shipping</td>
                                        <td>$70</td>
                                    </tr>
                                    <tr class="total">
                                        <td>Total</td>
                                        <td class="total-amount">$300</td>
                                    </tr>
                                </table>
                            </div>
                            <!-- Responsive Table End -->

                        </div>
                        <!-- Cart Calculate Items End -->

                        <!-- Cart Checktout Button Start -->
                        <a href="checkout.html" class="btn btn-dark btn-hover-primary rounded-0 w-100">Proceed To Checkout</a>
                        <!-- Cart Checktout Button End -->

                    </div>
                    <!-- Cart Calculation Area End -->

                </div>
            </div>

        </div>
    </div>
    <!-- Shopping Cart Section End -->
@endsection