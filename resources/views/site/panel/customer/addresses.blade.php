@extends('site.main')
@section('content')
     <!-- My Account Section Start -->
    <div class="section section-margin">
        <div class="container">

            <div class="row">
                <div class="col-lg-12">

                    <!-- My Account Page Start -->
                    <div class="myaccount-page-wrapper">
                        <!-- My Account Tab Menu Start -->
                        <div class="row">
                            <div class="col-lg-3 col-md-4">
                                <div class="myaccount-tab-menu nav" role="tablist">
                                    <a href="{{route('panel.profile')}}" ><i class="fa fa-dashboard"></i>
                                        Alterar Dados</a>
                                    <a href="{{route('panel.orders')}}" ><i class="fa fa-cart-arrow-down"></i> Minhas Compras</a>
                                    <a href="{{route('panel.addresses')}}" class="active"  class="active"><i class="fa fa-map-marker"></i> Endereços</a>
                                    <a href="{{route('customer.logout')}}"><i class="fa fa-sign-out"></i> Sair</a>
                                </div>
                            </div>
                            <!-- My Account Tab Menu End -->

                            <!-- My Account Tab Content Start -->
                            <div class="col-lg-9 col-md-8">
                                <div class="tab-content" id="myaccountContent">
                                    <!-- Single Tab Content Start -->
                                    <div class="tab-pane fade show active" id="dashboad" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h3 class="title">Seu Endereço</h3>
                                            @if (!$addresses)
                                                @foreach ($addresses as $address)
                                                    <address>
                                                        <p>{{$addresses->street}}, {{$addresses->number}} <br>
                                                        {{ $addresses->district }}, {{ $addresses->city }} - {{ $addresses->state }}, {{ $addresses->postal_code }}</p>
                                                        @if ($addresses->main)
                                                            <span class="px-2">
                                                                <i class="fas fa-star"></i>
                                                            </span>
                                                        @else
                                                        <a href="{{ route('panel.address.set_main', address.id) }}" class="px-2" data-toggle="tooltip" data-placement="left" title="Tornar principal">
                                                            <i class="fas fa-star"></i>
                                                        </a>
                                                        <a href="{{ route('panel.address.delete', address.id) }}" data-toggle="tooltip" data-placement="left" title="Remover" onclick="return confirm('Deseja realmente remover?')">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </a>
                                                        @endif
                                                    </address>
                                                    <hr>
                                                @endforeach
                                            @else 
                                                <p class="saved-message">Nenhum endereço cadastrado.</p>
                                            @endif
                                            
                                        </div>
                                    </div>
                                    <!-- Single Tab Content End -->

                                     <!-- Single Tab Content Start -->
                                     <div class="tab-pane fade" id="dashboard" role="tabpanel">
                                        <div class="myaccount-content">
                                            
                                        </div>
                                    </div>
                                    <!-- Single Tab Content End -->

                                    <!-- Single Tab Content Start -->
                                    <div class="tab-pane fade" id="payment-method" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h3 class="title">Payment Method</h3>
                                            <p class="saved-message">You Can't Saved Your Payment Method yet.</p>
                                        </div>
                                    </div>
                                    <!-- Single Tab Content End -->

                                    <!-- Single Tab Content Start -->
                                    <div class="tab-pane fade" id="address-edit" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h3 class="title">Billing Address</h3>
                                            <address>
                                                <p><strong>Alex Aya</strong></p>
                                                <p>1234 Market ##, Suite 900 <br>
                                                Lorem Ipsum, ## 12345</p>
                                                <p>Mobile: (123) 123-456789</p>
                                            </address>
                                            <a href="#" class="btn btn btn-dark btn-hover-primary rounded-0"><i class="fa fa-edit me-2"></i>Edit Address</a>
                                        </div>
                                    </div>
                                    <!-- Single Tab Content End -->

                                    <!-- Single Tab Content Start -->
                                    <div class="tab-pane fade" id="account-info" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h3 class="title">Account Details</h3>
                                            <div class="account-details-form">
                                                <form action="#">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="single-input-item mb-3">
                                                                <label for="first-name" class="required mb-1">First Name</label>
                                                                <input type="text" id="first-name" placeholder="First Name" />
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="single-input-item mb-3">
                                                                <label for="last-name" class="required mb-1">Last Name</label>
                                                                <input type="text" id="last-name" placeholder="Last Name" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="single-input-item mb-3">
                                                        <label for="display-name" class="required mb-1">Display Name</label>
                                                        <input type="text" id="display-name" placeholder="Display Name" />
                                                    </div>
                                                    <div class="single-input-item mb-3">
                                                        <label for="email" class="required mb-1">Email Addres</label>
                                                        <input type="email" id="email" placeholder="Email Address" />
                                                    </div>
                                                    <fieldset>
                                                        <legend>Password change</legend>
                                                        <div class="single-input-item mb-3">
                                                            <label for="current-pwd" class="required mb-1">Current Password</label>
                                                            <input type="password" id="current-pwd" placeholder="Current Password" />
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item mb-3">
                                                                    <label for="new-pwd" class="required mb-1">New Password</label>
                                                                    <input type="password" id="new-pwd" placeholder="New Password" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item mb-3">
                                                                    <label for="confirm-pwd" class="required mb-1">Confirm Password</label>
                                                                    <input type="password" id="confirm-pwd" placeholder="Confirm Password" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                    <div class="single-input-item single-item-button">
                                                        <button class="btn btn btn-dark btn-hover-primary rounded-0">Save Changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div> <!-- Single Tab Content End -->
                                </div>
                            </div> <!-- My Account Tab Content End -->
                        </div>
                    </div>
                    <!-- My Account Page End -->

                </div>
            </div>

        </div>
    </div>
    <!-- My Account Section End -->
@endsection